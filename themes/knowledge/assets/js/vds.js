/*
 * Vietnam Direct Sourcing: site behaviour (no jQuery needed).
 *
 * Formerly WPCode snippets 4069, 4096, 4113 and inline <script> blocks in templates.
 */
(function () {
	'use strict';

	function ready(fn) {
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', fn);
		} else {
			fn();
		}
	}

	/*
	 * Sticky header. Hides on scroll down, shows on scroll up, always visible near the
	 * top. Clamps rubber-band overscroll so the header does not hide at the top of the page.
	 */
	function stickyHeader() {
		var bar = document.getElementById('hideshow-sticky-menu');
		var area = document.querySelector('.main-header-area');
		if (!bar && !area) { return; }
		var HIDE_TOP = '-200px', TOP_ZONE = 80, DELTA = 5, STICKY_AT = 200;
		var lastY = currentY();

		function currentY() {
			var y = window.pageYOffset || document.documentElement.scrollTop || 0;
			return y < 0 ? 0 : y;
		}
		function apply() {
			var y = currentY();
			if (area) { area.classList.toggle('sticky-menu', y >= STICKY_AT); }
			if (bar) {
				if (y <= TOP_ZONE) {
					bar.style.top = '0';
				} else if (y - lastY > DELTA) {
					bar.style.top = HIDE_TOP;
				} else if (y - lastY < -DELTA) {
					bar.style.top = '0';
				}
			}
			lastY = y;
		}
		window.addEventListener('scroll', apply, { passive: true });
		window.addEventListener('resize', function () {
			if (bar && currentY() <= TOP_ZONE) { bar.style.top = '0'; }
		}, { passive: true });
		apply();
	}

	/* Solutions page: inquiry modal opened by any [data-vds-inquiry] button. */
	function inquiryModal() {
		var modal = document.getElementById('vds-inquiry-modal');
		if (!modal) { return; }
		function close() { modal.style.display = 'none'; document.body.style.overflow = ''; }
		document.addEventListener('click', function (e) {
			var btn = e.target.closest && e.target.closest('[data-vds-inquiry]');
			if (btn) {
				var service = btn.getAttribute('data-vds-inquiry');
				document.getElementById('vds-service-name').value = service;
				document.getElementById('vds-modal-title').textContent = service;
				modal.style.display = 'flex';
				document.body.style.overflow = 'hidden';
				return;
			}
			if (e.target === modal || (e.target.closest && e.target.closest('.vds-inquiry-close'))) { close(); }
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && modal.style.display === 'flex') { close(); }
		});
	}

	/*
	 * Solutions page: after an inquiry (services-tpl.php emails it and redirects to
	 * ?inquiry=sent), offer a 30-minute call in the Odoo booking page, prefilled with the
	 * visitor's first name and UTM-tagged by service.
	 */
	function bookingAfterInquiry() {
		var modal = document.getElementById('vds-inquiry-modal');
		if (!modal) { return; }
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

		if (new URLSearchParams(location.search).get('inquiry') !== 'sent') { return; }
		var d = {};
		try { d = JSON.parse(sessionStorage.getItem(KEY) || '{}'); sessionStorage.removeItem(KEY); } catch (e) {}
		try { history.replaceState(null, '', location.pathname + location.hash); } catch (e) {}

		var slug = (d.service || 'general').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
		var q = new URLSearchParams({ utm_source: 'website', utm_medium: 'solutions-inquiry', utm_campaign: slug });
		var calUrl = 'https://book.vietnam-directsourcing.com/appointment/1?' + q.toString();
		var first = (d.name || '').trim().split(/\s+/)[0];
		var esc = function (s) { var t = document.createElement('div'); t.textContent = s; return t.innerHTML; };

		var ov = document.createElement('div');
		ov.className = 'vds-booking-modal';
		ov.setAttribute('role', 'dialog');
		ov.setAttribute('aria-modal', 'true');
		ov.innerHTML =
			'<div class="vds-booking-modal__box">' +
				'<button type="button" class="vds-booking-modal__close vds-bk-close" aria-label="Close">&times;</button>' +
				'<p class="vds-booking-modal__eyebrow">Inquiry received</p>' +
				'<h3>Thanks' + (first ? ', ' + esc(first) : '') + '. We\'ll reply within 24 business hours.</h3>' +
				'<p class="vds-booking-modal__lede">Want to skip the wait? Pick a time for a 30-minute call now' +
					(d.service ? ' to talk through <strong>' + esc(d.service.replace(/ →$/, '')) + '</strong>' : '') + '.</p>' +
				'<div class="vds-booking-modal__widget"><iframe src="' + calUrl + '" title="Book a call with Vietnam Direct Sourcing"></iframe></div>' +
				'<p class="vds-booking-modal__skip"><a href="#" class="vds-bk-close">No thanks, I\'ll wait for your email</a></p>' +
			'</div>';
		document.body.appendChild(ov);
		document.body.style.overflow = 'hidden';

		var close = function (e) { if (e) { e.preventDefault(); } ov.remove(); document.body.style.overflow = ''; };
		ov.addEventListener('click', function (e) {
			if (e.target === ov || (e.target.closest && e.target.closest('.vds-bk-close'))) { close(e); }
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && document.body.contains(ov)) { close(); }
		});
	}

	/*
	 * Podcast page: links like /podcast/#episode-12 (from articles) may point at an episode
	 * that is not on the first page yet. Press Load More until it is, then scroll to it.
	 * Episode anchors are printed by loop/podcast.php.
	 */
	function podcastEpisodeHash() {
		var list = document.querySelector('.blog_lists');
		if (!list || !/^#episode-\d+$/.test(location.hash)) { return; }
		var attempts = 0;
		function target() { return document.getElementById(location.hash.slice(1)); }
		function seek() {
			var el = target();
			if (el) { el.scrollIntoView({ behavior: 'smooth', block: 'start' }); return; }
			var more = document.querySelector('.readmore a');
			if (!more || attempts >= 15) { return; }
			attempts++;
			more.click();
			setTimeout(seek, 900);
		}
		setTimeout(seek, 300);
	}

	ready(function () {
		stickyHeader();
		inquiryModal();
		bookingAfterInquiry();
		podcastEpisodeHash();
	});
})();
