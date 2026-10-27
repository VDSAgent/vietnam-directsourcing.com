// VDS: make /vietnam-sourcing-articles/page/N/ show real, crawlable pages.
// The theme template (blog-tpl.php) runs its WP_Query without 'paged', so every page showed page 1.

// 1. Pass the page number to the template's own query.
add_action('pre_get_posts', function ($q) {
    if (is_admin() || $q->is_main_query() || !is_page_template('blog-tpl.php')) return;
    if ($q->get('post_type') !== 'post' || (int) $q->get('posts_per_page') !== 9 || $q->get('paged')) return;
    $paged = (int) get_query_var('paged');
    if ($paged > 1) $q->set('paged', $paged);
});

// 2. Self-referencing canonical on paginated pages (Yoast).
add_filter('wpseo_canonical', function ($canonical) {
    if (is_page_template('blog-tpl.php')) {
        $p = (int) get_query_var('paged');
        if ($p > 1) return trailingslashit(get_permalink()) . 'page/' . $p . '/';
    }
    return $canonical;
});

// 3. Send out-of-range page numbers back to the first page.
add_action('template_redirect', function () {
    if (!is_page_template('blog-tpl.php')) return;
    $p = (int) get_query_var('paged');
    if ($p < 2) return;
    if ($p > (int) ceil(wp_count_posts('post')->publish / 9)) {
        wp_safe_redirect(get_permalink(), 301);
        exit;
    }
});

// 4. Crawlable numbered links under the grid; hide the JS button on /page/N/ to avoid duplicates.
add_action('get_footer', function () {
    if (!is_page_template('blog-tpl.php')) return;
    $max = (int) ceil(wp_count_posts('post')->publish / 9);
    if ($max < 2) return;
    $cur  = max(1, (int) get_query_var('paged'));
    $base = trailingslashit(get_permalink());
    echo '<nav class="vds-pager" aria-label="Article pages" style="text-align:center;margin:0 0 60px;">';
    for ($i = 1; $i <= $max; $i++) {
        $url = $i === 1 ? $base : $base . 'page/' . $i . '/';
        if ($i === $cur) {
            echo '<span aria-current="page" style="margin:0 8px;font-weight:700;">' . $i . '</span>';
        } else {
            echo '<a href="' . esc_url($url) . '" style="margin:0 8px;">' . $i . '</a>';
        }
    }
    echo '</nav>';
    if ($cur > 1) echo '<style>#load-more{display:none!important}</style>';
});
