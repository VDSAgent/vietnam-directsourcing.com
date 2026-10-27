/*
 * Articles page (blog-tpl.php): more article cards as the visitor scrolls.
 *
 * The #load-more button stays in the markup (it is the no-JS fallback and the AJAX
 * trigger); with JS it is hidden and pressed automatically when the end of the grid
 * comes into view. Cards already on the page are never added twice.
 * Formerly js/load-more-posts.js + WPCode snippet 4076.
 */
jQuery(function ($) {
	var $btn = $('#load-more');
	var container = document.getElementById('posts-container');
	if (!$btn.length || !container) {
		return;
	}

	var paged = 2; // the grid shows page 1
	var busy = false;
	var done = false;
	var seen = {};
	var sentinel = null;

	function keyOf(card) {
		var a = card.querySelector('a[href]');
		return a ? a.href.split('#')[0] : null;
	}
	Array.prototype.forEach.call(container.children, function (card) {
		var k = keyOf(card);
		if (k) { seen[k] = true; }
	});

	function loadMore() {
		if (busy || done) {
			return;
		}
		busy = true;
		$.post(loadMoreParams.ajaxUrl, {
			action: 'load_more_posts_new',
			paged: paged,
			postsPerPage: loadMoreParams.postsPerPage
		}).done(function (response) {
			if ($.trim(response) === 'no more posts') {
				done = true;
				$btn.hide();
				return;
			}
			var before = container.children.length;
			$(container).append(response);
			Array.prototype.slice.call(container.children, before).forEach(function (card) {
				var k = keyOf(card);
				if (k && seen[k]) {
					card.parentNode.removeChild(card);
				} else if (k) {
					seen[k] = true;
				}
			});
			paged++;
		}).always(function () {
			busy = false;
			// Still at the end of the grid (short pages, tall screens): keep going.
			if (sentinel && !done && sentinel.getBoundingClientRect().top < window.innerHeight + 600) {
				setTimeout(loadMore, 250);
			}
		});
	}

	$btn.on('click', function (e) {
		e.preventDefault();
		loadMore();
	});

	if ('IntersectionObserver' in window) {
		sentinel = document.createElement('div');
		sentinel.className = 'vds-load-more-sentinel';
		$btn[0].parentNode.insertBefore(sentinel, $btn[0]);
		$btn.hide();
		new IntersectionObserver(function (entries) {
			if (entries[0].isIntersecting) {
				loadMore();
			}
		}, { rootMargin: '600px 0px' }).observe(sentinel);
	}
});
