document.addEventListener('DOMContentLoaded', function () {
  var b = document.body;
  if (!b.classList.contains('page-id-18') && !b.classList.contains('search')) { return; }
  var host = document.querySelector('section.comic-blog .container') || document.querySelector('section.blog-area .container');
  if (!host || host.querySelector('.vds-article-search')) { return; }

  var q = '';
  try { q = new URLSearchParams(window.location.search).get('s') || ''; } catch (e) {}

  var form = document.createElement('form');
  form.className = 'vds-article-search';
  form.setAttribute('role', 'search');
  form.setAttribute('method', 'get');
  form.setAttribute('action', '/');

  var input = document.createElement('input');
  input.type = 'search';
  input.name = 's';
  input.value = q;
  input.placeholder = 'Search articles';
  input.setAttribute('aria-label', 'Search articles');

  var btn = document.createElement('button');
  btn.type = 'submit';
  btn.textContent = 'Search';

  form.appendChild(input);
  form.appendChild(btn);
  host.insertBefore(form, host.firstChild);
});