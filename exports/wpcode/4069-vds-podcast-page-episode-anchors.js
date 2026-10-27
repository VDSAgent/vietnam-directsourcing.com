document.addEventListener('DOMContentLoaded', function () {
    if (!document.body.classList.contains('page-id-2431')) { return; }
    var container = document.querySelector('.blog_lists');
    if (!container) { return; }
    function tagEpisodes() {
        var wraps = container.querySelectorAll('.chose-wrapper');
        for (var i = 0; i < wraps.length; i++) {
            var wrap = wraps[i];
            if (wrap.id) { continue; }
            var h = wrap.querySelector('h1, h2, h3, h4');
            if (!h) { continue; }
            var m = h.textContent.match(/Episode\s*(\d+)/i);
            if (m) { wrap.id = 'episode-' + m[1]; }
        }
    }
    function scrollToHash() {
        if (!location.hash) { return false; }
        var target = document.querySelector(location.hash);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            return true;
        }
        return false;
    }
    tagEpisodes();
    var observer = new MutationObserver(function () {
        tagEpisodes();
        if (location.hash) { scrollToHash(); }
    });
    observer.observe(container, { childList: true });
    if (location.hash && !document.querySelector(location.hash)) {
        var attempts = 0;
        var tryLoadMore = function () {
            if (document.querySelector(location.hash) || attempts >= 15) {
                scrollToHash();
                return;
            }
            var candidates = document.querySelectorAll('a, button');
            var btn = null;
            for (var j = 0; j < candidates.length; j++) {
                if (/load more/i.test(candidates[j].textContent.trim())) { btn = candidates[j]; break; }
            }
            if (!btn) { return; }
            attempts++;
            btn.click();
            setTimeout(tryLoadMore, 900);
        };
        setTimeout(tryLoadMore, 500);
    } else if (location.hash) {
        scrollToHash();
    }
});