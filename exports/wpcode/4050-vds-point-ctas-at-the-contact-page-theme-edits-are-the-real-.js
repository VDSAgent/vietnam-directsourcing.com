document.addEventListener('DOMContentLoaded', function () {
  var BOOK = '/contact-for-sourcing/';

  // 1. Closing CTA banner: ensure it is a link, point it at the booking page, retitle it.
  var box = document.querySelector('section.call-to-action .cta-border');
  if (box) {
    var link = null, kids = box.children, i;
    for (i = 0; i < kids.length; i++) { if (kids[i].tagName === 'A') { link = kids[i]; } }
    if (!link) {
      link = document.createElement('a');
      while (box.firstChild) { link.appendChild(box.firstChild); }
      box.appendChild(link);
    }
    link.setAttribute('href', BOOK);
    var h = box.querySelector('.cta-title h2');
    if (h) { h.textContent = "Let's talk about what you're sourcing"; }
  }

  // 2. Header button: /get-a-quote/ has no page behind it and returns 404.
  var btns = document.querySelectorAll('.right-btn a, a.theme_btn');
  for (var k = 0; k < btns.length; k++) {
    if ((btns[k].getAttribute('href') || '').indexOf('/get-a-quote/') > -1) {
      btns[k].setAttribute('href', BOOK);
      btns[k].textContent = 'BOOK A CALL';
    }
  }
});