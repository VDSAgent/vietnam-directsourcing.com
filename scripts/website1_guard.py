#!/usr/bin/env python3
"""Read-only record of what website 1 (the booking site) must keep doing while the shop is built.

Run it with the probe at the start and end of every phase and diff the JSON (the diff must be empty
for website 1). It makes public GET requests only (no form is ever submitted) and a few read-only
JSON-2 reads of view sources; it stores hashes of view sources, never the sources themselves.

Usage:
    export ODOO_URL=https://<database>.odoo.com ODOO_API_KEY=<API key>
    python3 scripts/website1_guard.py > probes/<copy|prod>-<phase>-website1-guard-$(date +%F-%H%M).json

The requests identify as a bot, so Odoo does not create visitor records. The one side effect is
Odoo's own sitemap cache: fetching /sitemap.xml makes Odoo store (or refresh) its generated sitemap
as an ir.attachment named /sitemap-<website>-<hash>.xml, which it also does for any crawler.
Exit code 1 means a must-keep check failed; "informational" checks never fail the run.
"""
import hashlib
import json
import os
import re
import sys
import urllib.error
import urllib.parse
import urllib.request
from html.parser import HTMLParser

UA = 'website1-guard/1.0 (monitoring bot)'
PAGES = ['/', '/appointment', '/appointment/1', '/quote', '/rfi-thank-you', '/privacy',
         '/service-requests', '/contactus', '/terms', '/helpdesk/customer-care-1', '/shop', '/shop/cart', '/web/login',
         '/web/signup', '/my']
PHONE = re.compile(r'(?<![\w@./:-])(\+?\d[\d\s().\-]{6,}\d)(?![\w-])')
DATE = re.compile(r'^\d{4}-\d{2}-\d{2}$')
HIDES_HEADER = re.compile(r'(?:header|#top|\.o_header_standard)[^{}]*\{[^}]*display\s*:\s*none', re.I)


def header_hidden_by_inline_css(html):
    return any(HIDES_HEADER.search(css) for css in re.findall(r'<style[^>]*>(.*?)</style>', html, re.S))


class _NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, *args, **kwargs):
        return None


class Page(HTMLParser):
    """Collects what the guard checks: title, header links, forms, tel: links, visible text."""

    SKIP = {'script', 'style', 'noscript', 'template'}

    def __init__(self):
        super().__init__(convert_charrefs=True)
        self.title = ''
        self._in_title = False
        self._skip = 0
        self.text = []
        self.body_class = ''
        self.header_depth = 0
        self.header_links = []   # (text, href) of links inside <header>
        self.header_text = []
        self.header_classes = []
        self._link = None
        self.tel_links = 0
        self.forms = []          # {'action', 'class', 'send_button_class'}
        self.inputs = []
        self.logo_images = 0
        self.shop_icons = []     # header cart / wishlist items: {'item', 'hidden'}

    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        if tag in self.SKIP:
            self._skip += 1
        if tag == 'title':
            self._in_title = True
        if tag == 'body':
            self.body_class = a.get('class', '')
        if tag == 'header':
            self.header_depth += 1
        if self.header_depth and a.get('class'):
            self.header_classes.append(a['class'])
        if tag == 'li' and self.header_depth:
            cls = a.get('class', '').split()
            for marker, item in (('o_wsale_my_cart', 'cart'), ('o_wsale_my_wish', 'wishlist')):
                if marker in cls:
                    self.shop_icons.append({'item': item, 'hidden': 'd-none' in cls})
        if tag == 'a':
            href = a.get('href', '')
            if href.startswith('tel:'):
                self.tel_links += 1
            if self.header_depth:
                self._link = [href, []]
        if tag == 'img' and self.header_depth and 'logo' in (a.get('src', '') + a.get('class', '') + a.get('alt', '')).lower():
            self.logo_images += 1
        if tag == 'form':
            self.forms.append({'action': urllib.parse.urlsplit(a.get('action', '')).path, 'class': a.get('class', ''),
                               'send_button_class': None})
        if self.forms and tag in ('a', 'button') and 's_website_form_send' in a.get('class', ''):
            self.forms[-1]['send_button_class'] = a['class']
        if tag in ('input', 'select', 'textarea') and a.get('name') and a.get('type') != 'hidden':
            self.inputs.append(a['name'])

    def handle_endtag(self, tag):
        if tag in self.SKIP and self._skip:
            self._skip -= 1
        if tag == 'title':
            self._in_title = False
        if tag == 'header' and self.header_depth:
            self.header_depth -= 1
        if tag == 'a' and self._link:
            self.header_links.append((' '.join(''.join(self._link[1]).split()), self._link[0]))
            self._link = None

    def handle_data(self, data):
        if self._in_title:
            self.title += data
        if self._skip:
            return
        self.text.append(data)
        if self.header_depth:
            self.header_text.append(data)
            if self._link:
                self._link[1].append(data)


def masked_phone_candidates(text):
    found = []
    for m in PHONE.finditer(text):
        raw = m.group(1).strip()
        digits = re.sub(r'\D', '', raw)
        if 8 <= len(digits) <= 15 and not DATE.match(raw):
            found.append(re.sub(r'\d', '#', raw))
    return found


def main():
    try:
        base = os.environ['ODOO_URL'].rstrip('/')
        key = os.environ['ODOO_API_KEY']
    except KeyError as missing:
        sys.exit(f'Set {missing} (see the docstring).')

    def fetch(path, follow=True):
        opener = urllib.request.build_opener() if follow else urllib.request.build_opener(_NoRedirect)
        req = urllib.request.Request(base + path, headers={'User-Agent': UA})
        try:
            with opener.open(req, timeout=60) as resp:
                return resp.status, urllib.parse.urlsplit(resp.geturl()).path, resp.headers, resp.read()
        except urllib.error.HTTPError as exc:
            return exc.code, urllib.parse.urlsplit(exc.headers.get('Location', '')).path, exc.headers, exc.read()

    def rpc(model, method, **kwargs):
        req = urllib.request.Request(
            f'{base}/json/2/{model}/{method}', data=json.dumps(kwargs).encode(), method='POST',
            headers={'Authorization': f'bearer {key}', 'Content-Type': 'application/json; charset=utf-8'})
        with urllib.request.urlopen(req, timeout=60) as resp:
            return json.loads(resp.read().decode() or 'null')

    out = {'pages': {}, 'sitemaps': {}, 'views': {}, 'checks': []}

    def check(name, ok, detail='', informational=False):
        out['checks'].append({'name': name, 'ok': bool(ok), 'informational': informational, 'detail': detail})

    # --- public pages -------------------------------------------------------------------------
    parsed = {}
    for path in PAGES:
        status, location, _, _ = fetch(path, follow=False)
        final_status, final_path, _, body = fetch(path)
        info = {'status': status, 'redirects_to': location if 300 <= status < 400 else None,
                'final_status': final_status, 'final_path': final_path}
        if final_status == 200 and body[:15].lower().lstrip().startswith((b'<!doctype', b'<html')):
            page = Page()
            html_text = body.decode('utf-8', errors='replace')
            page.feed(html_text)
            text = ' '.join(' '.join(page.text).split())
            header_text = ' '.join(' '.join(page.header_text).split())
            info.update({
                'title': ' '.join(page.title.split()),
                'logged_in_view': 'o_connected_user' in page.body_class,
                'header_links': sorted({f'{t} -> {h}' for t, h in page.header_links if t or h}),
                'header_has_contact_us': 'contact us' in header_text.lower(),
                'header_hidden_by_inline_css': header_hidden_by_inline_css(html_text),
                'header_shop_icons_visible': sorted({i['item'] for i in page.shop_icons if not i['hidden']}),
                'header_shop_icons_hidden': sorted({i['item'] for i in page.shop_icons if i['hidden']}),
                'header_logo_images': page.logo_images,
                'tel_links': page.tel_links,
                'phone_like_text_masked': masked_phone_candidates(text),
                'forms': page.forms,
                'form_field_names': sorted(set(page.inputs)),
            })
            parsed[path] = info
        out['pages'][path] = info

    # --- sitemap and robots -------------------------------------------------------------------
    status, _, _, body = fetch('/sitemap.xml')
    sitemap_paths = []
    if status == 200:
        locs = re.findall(r'<loc>([^<]+)</loc>', body.decode(errors='replace'))
        children = [l for l in locs if l.endswith('.xml')]
        for loc in (children or []):
            c_status, _, _, c_body = fetch(urllib.parse.urlsplit(loc).path)
            if c_status == 200:
                sitemap_paths += [urllib.parse.urlsplit(l).path for l in re.findall(r'<loc>([^<]+)</loc>', c_body.decode(errors='replace'))]
        if not children:
            sitemap_paths = [urllib.parse.urlsplit(l).path for l in locs]
    out['sitemaps'] = {'status': status, 'paths': sorted(set(sitemap_paths))}
    status, _, _, body = fetch('/robots.txt')
    out['robots_txt'] = {'status': status, 'lines': [re.sub(r'https?://[^/\s]+', '', l.strip()) for l in body.decode(errors='replace').splitlines() if l.strip()]}

    # --- logo ---------------------------------------------------------------------------------
    status, _, headers, body = fetch('/web/image/website/1/logo')
    out['logo'] = {'status': status, 'content_type': headers.get('Content-Type'), 'bytes': len(body),
                   'sha256': hashlib.sha256(body).hexdigest() if status == 200 else None}

    # --- view sources (hashes only) -----------------------------------------------------------
    def view_record(label, domain):
        rows = rpc('ir.ui.view', 'search_read', domain=domain, fields=['key', 'name', 'active', 'website_id', 'arch_db'], limit=1)
        if not rows:
            out['views'][label] = {'found': False}
            return None
        row = rows[0]
        arch = row['arch_db'] or ''
        info = {'found': True, 'id': row['id'], 'key': row['key'], 'active': row['active'],
                'website_id': row['website_id'] and row['website_id'][0], 'arch_chars': len(arch),
                'arch_sha256': hashlib.sha256(arch.encode()).hexdigest()}
        out['views'][label] = info
        return arch

    for label, url in (('quote_form', '/quote'), ('rfi_thank_you', '/rfi-thank-you')):
        pages = rpc('website.page', 'search_read', domain=[('url', '=', url), ('website_id', '=', 1)], fields=['view_id'], limit=1)
        arch = view_record(label, [('id', '=', pages[0]['view_id'][0])]) if pages else view_record(label, [('id', '=', 0)])
        if label == 'quote_form' and arch is not None:
            form = re.search(r'<form\b[^>]*>', arch)
            out['views'][label]['form_tag_has_s_website_form'] = bool(form and re.search(r'class="[^"]*\bs_website_form\b', form.group(0)))
            out['views'][label]['has_s_website_form_send_button'] = bool(re.search(r'class="[^"]*\bs_website_form_send\b', arch))
            out['views'][label]['field_names_in_source'] = sorted(set(re.findall(r'<(?:input|select|textarea)\b[^>]*\bname="([^"]+)"', arch)))
    footer = view_record('footer_website_1', [('key', '=', 'website.footer_custom'), ('website_id', '=', 1)])
    if footer is not None:
        out['views']['footer_website_1']['tel_link_in_source'] = 'href="tel:' in footer
        out['views']['footer_website_1']['phone_like_text_masked'] = masked_phone_candidates(re.sub(r'<[^>]+>', ' ', footer))

    # --- checks -------------------------------------------------------------------------------
    quote = out['views'].get('quote_form', {})
    check('/quote loads (200)', out['pages']['/quote']['final_status'] == 200)
    check('/quote form tag has class s_website_form', quote.get('form_tag_has_s_website_form'), 'view source')
    check('/quote submit button has class s_website_form_send', quote.get('has_s_website_form_send_button'), 'view source')
    live_form = [f for f in out['pages']['/quote'].get('forms', []) if 's_website_form' in f['class'].split()]
    check('/quote served page has the s_website_form form and its send button',
          bool(live_form) and bool(live_form[0]['send_button_class']))
    check('/rfi-thank-you loads (200)', out['pages']['/rfi-thank-you']['final_status'] == 200)
    check('booking page /appointment/1 loads (200)', out['pages']['/appointment/1']['final_status'] == 200)
    check('website logo file is served', out['logo']['status'] == 200 and out['logo']['bytes'] > 0, f"{out['logo']['bytes']} bytes")
    hidden = sorted(p for p, i in parsed.items() if i['header_hidden_by_inline_css'])
    check('pages that hide their own header and logo with inline CSS (embed pages)', True, ', '.join(hidden), informational=True)
    public_pages = {p: i for p, i in parsed.items() if i['final_path'] not in ('/web/login', '/web/signup')}
    check('no page is served as a logged-in user', not any(i['logged_in_view'] for i in parsed.values()))
    check('no "Contact Us" in any public page header', not any(i['header_has_contact_us'] for i in parsed.values()))
    check('no tel: links on public pages', not any(i['tel_links'] for i in parsed.values()) and not out['views'].get('footer_website_1', {}).get('tel_link_in_source'))
    phones = {p: i['phone_like_text_masked'] for p, i in parsed.items() if i['phone_like_text_masked']}
    check('no phone-like numbers in public page text', not phones, json.dumps(phones) if phones else '')
    check('header links (public view of /appointment)', True, '; '.join(out['pages']['/appointment'].get('header_links', [])), informational=True)
    shop = out['pages']['/shop']
    check('/shop on website 1 is hidden or redirected', shop['final_status'] != 200 or shop['final_path'] != '/shop',
          f"status {shop['status']}, final {shop['final_status']} {shop['final_path']}", informational=True)
    check('no shop URLs in the website 1 sitemap', not [p for p in out['sitemaps']['paths'] if p.startswith('/shop')],
          ', '.join(p for p in out['sitemaps']['paths'] if p.startswith('/shop')), informational=True)
    check('cart and wishlist icons are hidden in the header (empty cart)',
          not any(i['header_shop_icons_visible'] for i in parsed.values()))
    signup = out['pages']['/web/signup']
    check('free sign-up form is NOT offered at /web/signup', not (signup['final_status'] == 200 and signup['final_path'] == '/web/signup'),
          f"status {signup['status']}, final {signup['final_status']} {signup['final_path']}", informational=True)

    json.dump(out, sys.stdout, indent=1, sort_keys=True, default=str)
    sys.stdout.write('\n')
    failed = [c for c in out['checks'] if not c['ok'] and not c['informational']]
    for c in out['checks']:
        mark = 'ok  ' if c['ok'] else ('info' if c['informational'] else 'FAIL')
        print(f"[{mark}] {c['name']}" + (f" ({c['detail']})" if c['detail'] else ''), file=sys.stderr)
    sys.exit(1 if failed else 0)


if __name__ == '__main__':
    main()
