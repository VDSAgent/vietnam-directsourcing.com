#!/usr/bin/env python3
"""Read-only inventory of the Odoo database's configuration for the wholesale shop build.

Usage:
    export ODOO_URL=https://<database>.odoo.com ODOO_DB=<database>
    export ODOO_LOGIN=<your login email> ODOO_API_KEY=<API key>   # never commit these
    python3 scripts/odoo_probe.py > probes/<copy|prod>-<phase>-$(date +%F-%H%M).json

It only calls version, fields_get, search_count and search_read, and reads configuration
records (no customers, orders or messages). Run it at the start and end of every phase and
diff the two files: the diff must show only what the phase intended, and nothing about
website 1 (the booking site) may change.
Models or fields that do not exist in this Odoo version are reported as unavailable.
"""
import json
import os
import re
import sys
import xmlrpc.client

RELEVANT_MODULES = {
    'website', 'website_sale', 'website_sale_stock', 'website_crm', 'website_appointment',
    'sale', 'sale_management', 'stock', 'purchase', 'stock_dropshipping', 'delivery',
    'delivery_starshipit', 'account', 'payment', 'payment_stripe', 'payment_custom',
    'crm', 'appointment', 'auth_signup', 'portal', 'web_studio',
}
WEBSITE_SETTING_PATTERN = re.compile(r'price|pricelist|checkout|signup|ecommerce|cart|shop|zero|contact_us|b2b', re.I)


def main():
    try:
        url = os.environ['ODOO_URL'].rstrip('/')
        db, login, key = os.environ['ODOO_DB'], os.environ['ODOO_LOGIN'], os.environ['ODOO_API_KEY']
    except KeyError as missing:
        sys.exit(f'Set {missing} (see the docstring).')

    common = xmlrpc.client.ServerProxy(f'{url}/xmlrpc/2/common', allow_none=True)
    uid = common.authenticate(db, login, key, {})
    if not uid:
        sys.exit('Authentication failed: check ODOO_DB, ODOO_LOGIN and ODOO_API_KEY.')
    models = xmlrpc.client.ServerProxy(f'{url}/xmlrpc/2/object', allow_none=True)

    def call(model, method, *args, **kwargs):
        return models.execute_kw(db, uid, key, model, method, list(args), kwargs)

    field_cache = {}

    def fields_of(model):
        if model not in field_cache:
            field_cache[model] = call(model, 'fields_get', attributes=['type'])
        return field_cache[model]

    def read(model, domain, wanted, order='id'):
        have = fields_of(model)
        return call(model, 'search_read', domain, fields=[f for f in wanted if f in have], order=order)

    def first_model(*names):
        for name in names:
            if call('ir.model', 'search_count', [('model', '=', name)]):
                return name
        raise LookupError('none of ' + ', '.join(names) + ' exists')

    out = {'server_version': common.version()}

    def section(name, fn):
        try:
            out[name] = fn()
        except Exception as exc:  # report and carry on: one missing app must not stop the probe
            text = getattr(exc, 'faultString', None) or str(exc)
            out[name] = {'unavailable': text.strip().splitlines()[-1][:300]}

    section('modules_installed', lambda: sorted(
        m['name'] for m in read('ir.module.module', [('state', '=', 'installed')], ['name'])))
    section('relevant_modules_state', lambda: {
        m['name']: m['state'] for m in read('ir.module.module', [('name', 'in', sorted(RELEVANT_MODULES))], ['name', 'state'])})
    section('companies', lambda: read('res.company', [], [
        'name', 'currency_id', 'country_id', 'account_fiscal_country_id', 'vat', 'email', 'website']))
    section('currencies_active', lambda: [c['name'] for c in read('res.currency', [('active', '=', True)], ['name'])])

    def websites():
        have = fields_of('website')
        settings = sorted(f for f in have if WEBSITE_SETTING_PATTERN.search(f))
        rows = read('website', [], ['name', 'domain', 'company_id', 'default_lang_id', 'language_ids', 'theme_id'] + settings)
        for row in rows:
            wid = row['id']
            for model, key_name in (('website.page', 'pages'), ('website.menu', 'menus'), ('website.rewrite', 'redirects')):
                try:
                    row[key_name] = call(model, 'search_count', [('website_id', '=', wid)])
                except Exception:
                    row[key_name] = 'unavailable'
        return {'setting_fields_in_this_version': settings, 'websites': rows}
    section('websites', websites)
    section('redirects', lambda: read('website.rewrite', [], ['name', 'website_id', 'redirect_type', 'url_from', 'url_to']))

    section('pricelists', lambda: read('product.pricelist', ['|', ('active', '=', True), ('active', '=', False)], [
        'name', 'active', 'currency_id', 'company_id', 'website_id', 'selectable', 'country_group_ids']))
    section('payment_providers', lambda: read(first_model('payment.provider', 'payment.acquirer'), [], [
        'name', 'code', 'state', 'company_id', 'website_id', 'maximum_amount', 'available_currency_ids',
        'available_country_ids', 'custom_mode']))
    section('payment_terms', lambda: [t['name'] for t in read('account.payment.term', [], ['name'])])
    section('warehouses', lambda: read('stock.warehouse', [], ['name', 'code', 'company_id', 'partner_id']))
    section('routes', lambda: read(first_model('stock.route', 'stock.location.route'), [], [
        'name', 'active', 'product_selectable', 'sale_selectable', 'company_id']))
    section('delivery_methods', lambda: read('delivery.carrier', [], [
        'name', 'delivery_type', 'website_id', 'is_published', 'company_id', 'country_ids']))

    def taxes():
        rows = read('account.tax', [], ['name', 'type_tax_use', 'amount', 'country_id', 'company_id', 'active'])
        summary = {}
        for row in rows:
            country = row.get('country_id') and row['country_id'][1] or 'no country'
            summary.setdefault(country, {}).setdefault(row.get('type_tax_use') or '?', 0)
            summary[country][row.get('type_tax_use') or '?'] += 1
        return {'count_by_country_and_use': summary, 'sale_taxes': [r for r in rows if r.get('type_tax_use') == 'sale'][:60]}
    section('taxes', taxes)
    section('fiscal_positions', lambda: read('account.fiscal.position', [], [
        'name', 'country_id', 'foreign_vat', 'auto_apply', 'company_id']))
    section('sales_teams', lambda: read('crm.team', [], ['name', 'company_id', 'website_ids', 'alias_name']))

    def products():
        result = {'templates_total': call('product.template', 'search_count', [])}
        have = fields_of('product.template')
        if 'website_id' in have:
            for site in read('website', [], ['name']):
                result[f"website {site['id']} ({site['name']})"] = call('product.template', 'search_count', [('website_id', '=', site['id'])])
            if 'is_published' in have:
                result['published_on_all_websites'] = call('product.template', 'search_count', [
                    ('website_id', '=', False), ('is_published', '=', True)])
        return result
    section('products', products)
    section('ecommerce_categories', lambda: read('product.public.category', [], ['name', 'parent_id', 'website_id']))
    section('uom_cartons', lambda: read('uom.uom', [('name', 'ilike', 'carton')], [
        'name', 'category_id', 'uom_type', 'factor_inv', 'relative_factor']))
    section('config_parameters', lambda: read('ir.config_parameter', [('key', 'like', 'auth_signup.%')], ['key', 'value']))

    json.dump(out, sys.stdout, indent=1, sort_keys=True, default=str)
    sys.stdout.write('\n')


if __name__ == '__main__':
    main()
