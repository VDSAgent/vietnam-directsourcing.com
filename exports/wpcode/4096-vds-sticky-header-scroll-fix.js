/**
 * VDS - Sticky header scroll fix.
 *
 * The theme's handler in assets/js/main.js compares pageYOffset between scroll
 * events to hide/show #hideshow-sticky-menu. Two faults:
 *   1. Rubber-band overscroll at the very top drives pageYOffset negative; the
 *      spring-back then reads as "scrolling down", so the header hides while the
 *      visitor is sitting at the top of the page and only returns after they
 *      scroll down a full screen and carefully back up.
 *   2. It re-registers a jQuery scroll handler on every downward scroll event,
 *      piling up duplicate handlers.
 * This disables that handler and replaces it with a clamped, direction-aware
 * version that always shows the header near the top of the page.
 */
(function () {
  var HIDE_TOP  = '-200px';
  var TOP_ZONE  = 80;   // px from the top where the header is always visible
  var DELTA     = 5;    // ignore jitter smaller than this
  var STICKY_AT = 200;  // matches the theme's .sticky-menu threshold

  var bar = null, area = null, lastY = 0, started = false;

  function currentY() {
    var y = window.pageYOffset || document.documentElement.scrollTop || 0;
    return y < 0 ? 0 : y;   // clamp rubber-band overscroll
  }

  function apply() {
    if (!bar)  { bar  = document.getElementById('hideshow-sticky-menu'); }
    if (!area) { area = document.querySelector('.main-header-area'); }
    var y = currentY();

    if (area) {
      if (y < STICKY_AT) { area.classList.remove('sticky-menu'); }
      else { area.classList.add('sticky-menu'); }
    }

    if (bar) {
      if (y <= TOP_ZONE) {
        bar.style.top = '0';
      } else {
        var delta = y - lastY;
        if (delta > DELTA) { bar.style.top = HIDE_TOP; }
        else if (delta < -DELTA) { bar.style.top = '0'; }
      }
    }
    lastY = y;
  }

  function onScroll() {
    if (window.onscroll) { window.onscroll = null; }
    apply();
  }

  function init() {
    window.onscroll = null;
    if (started) { return; }
    started = true;
    bar  = document.getElementById('hideshow-sticky-menu');
    area = document.querySelector('.main-header-area');
    lastY = currentY();
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', function () {
      if (bar && currentY() <= TOP_ZONE) { bar.style.top = '0'; }
    }, { passive: true });
    apply();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
  window.addEventListener('load', init);
})();