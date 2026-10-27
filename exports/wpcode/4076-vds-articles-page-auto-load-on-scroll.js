document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('load-more');
    var container = document.getElementById('posts-container');
    if (!btn || !container) { return; }

    var sentinel = document.createElement('div');
    sentinel.id = 'vds-load-more-sentinel';
    sentinel.style.cssText = 'height:1px;';
    btn.parentNode.insertBefore(sentinel, btn);
    btn.style.display = 'none';

    var busy = false;
    var done = false;
    var lastCount = container.children.length;
    var noChangeTimer = null;
    var seenLinks = {};

    Array.prototype.forEach.call(container.children, function (child) {
        var a = child.querySelector('a[href]');
        if (a) { seenLinks[a.href.split('#')[0]] = true; }
    });

    function dedupeNewChildren(beforeCount) {
        var children = Array.prototype.slice.call(container.children, beforeCount);
        children.forEach(function (child) {
            var a = child.querySelector('a[href]');
            var key = a ? a.href.split('#')[0] : null;
            if (key && seenLinks[key]) {
                child.parentNode.removeChild(child);
            } else if (key) {
                seenLinks[key] = true;
            }
        });
    }

    function isNearViewport() {
        var rect = sentinel.getBoundingClientRect();
        return rect.top < window.innerHeight + 600;
    }

    function maybeLoadMore() {
        if (busy || done) { return; }
        if (!isNearViewport()) { return; }
        busy = true;
        lastCount = container.children.length;
        btn.click();
        clearTimeout(noChangeTimer);
        noChangeTimer = setTimeout(function () {
            if (container.children.length === lastCount) {
                done = true;
                observer.disconnect();
            }
            busy = false;
        }, 4000);
    }

    var mo = new MutationObserver(function () {
        var rawNewCount = container.children.length;
        if (rawNewCount > lastCount) {
            dedupeNewChildren(lastCount);
            clearTimeout(noChangeTimer);
            busy = false;
            lastCount = container.children.length;
            setTimeout(function () {
                if (isNearViewport()) { maybeLoadMore(); }
            }, 250);
        }
    });
    mo.observe(container, { childList: true });

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) { maybeLoadMore(); }
        });
    }, { rootMargin: '600px 0px 0px 0px' });
    observer.observe(sentinel);
});