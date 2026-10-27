// VDS: search box + topic pills on /podcast/ (server-side, no JS needed).
// Uses ?ps=keyword. Search views are noindex and canonical to /podcast/.

function vds_podcast_term() {
    return isset($_GET['ps']) ? trim(sanitize_text_field(wp_unslash($_GET['ps']))) : '';
}

add_action('pre_get_posts', function ($q) {
    if (is_admin() || $q->is_main_query() || !is_page_template('podcast-tpl.php')) return;
    $term = vds_podcast_term();
    if ($term === '' || $q->get('post_type') !== 'podcast') return;
    $q->set('s', $term);
    $q->set('posts_per_page', 100);
    $q->set('paged', 1);
}, 5);

add_filter('wpseo_robots', function ($robots) {
    return (is_page_template('podcast-tpl.php') && vds_podcast_term() !== '') ? 'noindex, follow' : $robots;
});
add_filter('wpseo_canonical', function ($canonical) {
    return (is_page_template('podcast-tpl.php') && vds_podcast_term() !== '') ? get_permalink() : $canonical;
}, 20);

// Print the search box and pills once, before the first episode.
function vds_podcast_filter_ui() {
    global $vds_pf_done;
    if (!empty($vds_pf_done) || !is_page_template('podcast-tpl.php')) return;
    $vds_pf_done = true;
    $term  = vds_podcast_term();
    $base  = trailingslashit(get_permalink());
    $pills = array('Quality' => 'quality', 'Logistics' => 'logistics', 'Trade agreements' => 'trade agreement', 'Certification' => 'certification',
                   'Australia' => 'Australia', 'Packaging' => 'packaging', 'Textiles' => 'textile', 'Furniture' => 'furniture', 'Electronics' => 'electronic', 'Customs' => 'customs');
    echo '<div class="vds-podcast-filter" style="margin:0 0 40px;text-align:center;">';
    echo '<form role="search" method="get" action="' . esc_url($base) . '" style="margin-bottom:16px;">';
    echo '<input type="search" name="ps" value="' . esc_attr($term) . '" placeholder="Search episodes" aria-label="Search episodes" style="padding:10px 14px;min-width:260px;max-width:100%;border:1px solid #ccc;border-radius:4px;"> ';
    echo '<button type="submit" style="padding:10px 18px;border:0;border-radius:4px;background:#e5a63a;font-weight:600;">Search</button>';
    echo '</form><div class="vds-pills">';
    foreach ($pills as $label => $kw) {
        $on = (strcasecmp($term, $kw) === 0);
        echo '<a href="' . esc_url(add_query_arg('ps', rawurlencode($kw), $base)) . '" style="display:inline-block;margin:4px;padding:6px 14px;border:1px solid #e5a63a;border-radius:20px;text-decoration:none;'
           . ($on ? 'background:#e5a63a;color:#fff;' : '') . '"' . ($on ? ' aria-current="true"' : '') . '>' . esc_html($label) . '</a>';
    }
    echo '</div>';
    if ($term !== '') echo '<p style="margin-top:16px;">Showing episodes matching <strong>' . esc_html($term) . '</strong> &middot; <a href="' . esc_url($base) . '">Show all episodes</a></p>';
    echo '</div>';
}
add_action('get_template_part_loop/podcast', 'vds_podcast_filter_ui');

// Zero results: the loop never runs, so show the box with a message before the footer.
add_action('get_footer', function () {
    global $vds_pf_done;
    if (!empty($vds_pf_done) || !is_page_template('podcast-tpl.php') || vds_podcast_term() === '') return;
    echo '<div class="container" style="padding:40px 0;text-align:center;"><p>No episodes found for <strong>' . esc_html(vds_podcast_term()) . '</strong>.</p>';
    vds_podcast_filter_ui();
    echo '</div>';
}, 5);

// On search views the pager and Load More would be misleading: hide them.
add_action('wp_head', function () {
    if (is_page_template('podcast-tpl.php') && vds_podcast_term() !== '') echo '<style>.vds-pager,.readmore{display:none!important}</style>';
});
