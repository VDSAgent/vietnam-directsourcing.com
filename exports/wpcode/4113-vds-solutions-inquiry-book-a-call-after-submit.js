/* VDS - Solutions inquiry: offer a call booking after submit
   The theme's services-tpl.php handler emails the inquiry and redirects to
   /global-sourcing-solutions/?inquiry=sent. This snippet remembers the
   name/email/service on submit, then on the redirect opens a thank-you
   modal with the Calendly 30-min booking, prefilled and UTM-tagged by service. */
(function () {
  var modal = document.getElementById('vds-inquiry-modal');
  if (!modal) return;
  var KEY = 'vdsInquiry';
  var form = modal.querySelector('form');
  if (form) {
    form.addEventListener('submit', function () {
      try {
        sessionStorage.setItem(KEY, JSON.stringify({
          name: (form.elements.inquiry_name || {}).value || '',
          email: (form.elements.inquiry_email || {}).value || '',
          service: (form.elements.service_name || {}).value || ''
        }));
      } catch (e) {}
    });
  }

  var params = new URLSearchParams(location.search);
  if (params.get('inquiry') !== 'sent') return;

  var d = {};
  try { d = JSON.parse(sessionStorage.getItem(KEY) || '{}'); sessionStorage.removeItem(KEY); } catch (e) {}
  try { history.replaceState(null, '', location.pathname + location.hash); } catch (e) {}

  var slug = (d.service || 'general').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
  var q = new URLSearchParams({
    utm_source: 'website',
    utm_medium: 'solutions-inquiry',
    utm_campaign: slug
  });
  var calUrl = 'https://book.vietnam-directsourcing.com/appointment/1?' + q.toString();
  var first = (d.name || '').trim().split(/\s+/)[0];
  var esc = function (s) { var t = document.createElement('div'); t.textContent = s; return t.innerHTML; };

  var ov = document.createElement('div');
  ov.id = 'vds-booking-modal';
  ov.setAttribute('role', 'dialog');
  ov.setAttribute('aria-modal', 'true');
  ov.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.65);z-index:9999;display:flex;align-items:center;justify-content:center;';
  ov.innerHTML =
    '<div style="background:#fff;border-radius:12px;padding:36px 32px 24px;max-width:760px;width:94%;position:relative;max-height:92vh;overflow-y:auto;">' +
      '<button type="button" class="vds-bk-close" aria-label="Close" style="position:absolute;top:14px;right:18px;background:none;border:none;font-size:26px;cursor:pointer;color:#999;line-height:1;">&times;</button>' +
      '<p style="color:#16243D;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:6px;">Inquiry received</p>' +
      '<h3 style="color:#16243D;font-size:24px;margin-bottom:6px;">Thanks' + (first ? ', ' + esc(first) : '') + '. We\'ll reply within 24 business hours.</h3>' +
      '<p style="color:#5B6675;font-size:15px;margin-bottom:16px;">Want to skip the wait? Pick a time for a 30-minute call now' + (d.service ? ' to talk through <strong>' + esc(d.service.replace(/ \u2192$/, '')) + '</strong>' : '') + '.</p>' +
      '<div class="vds-bk-widget" style="min-width:280px;height:660px;"></div>' +
      '<p style="text-align:center;margin:12px 0 0;"><a href="#" class="vds-bk-close" style="color:#5B6675;font-size:14px;text-decoration:underline;">No thanks, I\'ll wait for your email</a></p>' +
    '</div>';
  document.body.appendChild(ov);
  document.body.style.overflow = 'hidden';

  var close = function (e) { if (e) e.preventDefault(); ov.remove(); document.body.style.overflow = ''; };
  ov.addEventListener('click', function (e) {
    if (e.target === ov || (e.target.closest && e.target.closest('.vds-bk-close'))) close(e);
  });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && document.body.contains(ov)) close(); });

  var holder = ov.querySelector('.vds-bk-widget');
  if (window.matchMedia('(max-width: 767px)').matches) holder.style.height = '1000px';
  holder.innerHTML = '<iframe src="' + calUrl + '" title="Book a call with Vietnam Direct Sourcing" style="width:100%;height:100%;border:0;"></iframe>';
})();