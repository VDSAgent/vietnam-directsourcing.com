// VDS: real, crawlable pagination for /podcast/ (template podcast-tpl.php hard-codes 'paged' => 1).

add_action('pre_get_posts', function ($q) {
    if (is_admin() || $q->is_main_query() || !is_page_template('podcast-tpl.php')) return;
    if ($q->get('post_type') !== 'podcast' || (int) $q->get('posts_per_page') !== 10) return;
    $paged = (int) get_query_var('paged');
    if ($paged > 1) $q->set('paged', $paged);
});

add_filter('wpseo_canonical', function ($canonical) {
    if (is_page_template('podcast-tpl.php')) {
        $p = (int) get_query_var('paged');
        if ($p > 1) return trailingslashit(get_permalink()) . 'page/' . $p . '/';
    }
    return $canonical;
});

add_action('template_redirect', function () {
    if (!is_page_template('podcast-tpl.php')) return;
    $p = (int) get_query_var('paged');
    if ($p < 2) return;
    if ($p > (int) ceil(wp_count_posts('podcast')->publish / 10)) {
        wp_safe_redirect(get_permalink(), 301);
        exit;
    }
});

add_action('get_footer', function () {
    if (!is_page_template('podcast-tpl.php')) return;
    $max = (int) ceil(wp_count_posts('podcast')->publish / 10);
    if ($max < 2) return;
    $cur  = max(1, (int) get_query_var('paged'));
    $base = trailingslashit(get_permalink());
    echo '<nav class="vds-pager" aria-label="Podcast pages" style="text-align:center;margin:0 0 60px;">';
    for ($i = 1; $i <= $max; $i++) {
        $url = $i === 1 ? $base : $base . 'page/' . $i . '/';
        echo $i === $cur
            ? '<span aria-current="page" style="margin:0 8px;font-weight:700;">' . $i . '</span>'
            : '<a href="' . esc_url($url) . '" style="margin:0 8px;">' . $i . '</a>';
    }
    echo '</nav>';
    if ($cur > 1) echo '<style>.readmore{display:none!important}</style>';
});
