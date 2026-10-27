// VDS: podcast episode pages - players, related article link, PodcastEpisode / PodcastSeries schema.
// The theme has no single-podcast template, so the ACF players only render on the /podcast/ list.

// 1. Append YouTube + Spotify players and a link to the matching article on single episode pages.
add_filter('the_content', function ($content) {
    if (!is_singular('podcast') || !in_the_loop() || !is_main_query() || !function_exists('get_field')) return $content;
    $id  = get_the_ID();
    $out = '';
    foreach ((array) get_field('youtube_links', $id) as $row) {
        if (!empty($row['yt_iframe'])) $out .= '<div class="vds-ep-player vds-ep-youtube" style="margin:24px 0;">' . $row['yt_iframe'] . '</div>';
    }
    foreach ((array) get_field('podcast_links', $id) as $row) {
        if (!empty($row['iframe'])) $out .= '<div class="vds-ep-player vds-ep-spotify" style="margin:24px 0;">' . $row['iframe'] . '</div>';
    }
    // Episodes whose article was merged into a newer guide (option vds_redirect_map = old post ID => new post ID, see snippet 4301):
    // once the new guide is live, point to it. Map = podcast page ID => old article ID (Ep 10, 17, 20, 25, 28).
    $merged = array(2801 => 472, 2809 => 2683, 2812 => 2697, 3129 => 2759, 3384 => 2842);
    $map    = (array) get_option('vds_redirect_map', array());
    $new_id = (isset($merged[$id]) && isset($map[$merged[$id]])) ? (int) $map[$merged[$id]] : 0;
    $done   = false;
    if ($new_id && 'publish' === get_post_status($new_id)) {
        $out .= '<p class="vds-ep-article"><strong>Updated guide:</strong> <a href="' . esc_url(get_permalink($new_id)) . '">' . esc_html(get_the_title($new_id)) . '</a></p>';
        $done = true;
    }
    $title = trim(preg_replace('/^Episode\s*\d+\s*[\x{2013}\x{2014}-]\s*/u', '', get_the_title($id)));
    if (!$done && $title !== '') {
        $q = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 20, 's' => $title, 'no_found_rows' => true));
        foreach ($q->posts as $p) {
            if (html_entity_decode(get_the_title($p), ENT_QUOTES) === html_entity_decode($title, ENT_QUOTES)) {
                $out .= '<p class="vds-ep-article"><strong>Read the article:</strong> <a href="' . esc_url(get_permalink($p)) . '">' . esc_html(get_the_title($p)) . '</a></p>';
                break;
            }
        }
        wp_reset_postdata();
    }
    return $content . $out;
}, 20);

// 2. PodcastEpisode schema on episodes, PodcastSeries schema on the /podcast/ page.
add_action('wp_head', function () {
    $series = array('@type' => 'PodcastSeries', 'name' => 'Vietnam Direct Sourcing Podcast', 'url' => home_url('/podcast/'),
        'publisher' => array('@type' => 'Organization', 'name' => 'Vietnam Direct Sourcing', 'url' => home_url('/')));
    $data = null;
    if (is_singular('podcast')) {
        $id    = get_queried_object_id();
        $desc  = wp_strip_all_tags(get_post_field('post_content', $id));
        $media = array();
        foreach ((array) (function_exists('get_field') ? get_field('youtube_links', $id) : array()) as $row) {
            if (!empty($row['link'])) {
            $vo = array('@type' => 'VideoObject', 'name' => get_the_title($id), 'contentUrl' => esc_url_raw($row['link']), 'uploadDate' => get_the_date('c', $id), 'description' => wp_trim_words($desc, 40));
            if (preg_match('~(?:youtu\.be/|/shorts/|[?&]v=|/embed/)([A-Za-z0-9_-]{11})~', $row['link'], $vm)) {
                $vo['thumbnailUrl'] = 'https://i.ytimg.com/vi/' . $vm[1] . '/hqdefault.jpg';
                $vo['embedUrl']     = 'https://www.youtube.com/embed/' . $vm[1];
            }
            $media[] = $vo; break;
        }
        }
        $data = array('@context' => 'https://schema.org', '@type' => 'PodcastEpisode', 'name' => get_the_title($id), 'url' => get_permalink($id),
            'description' => wp_trim_words($desc, 60), 'datePublished' => get_the_date('c', $id), 'partOfSeries' => $series);
        if ($media) $data['associatedMedia'] = $media[0];
    } elseif (is_page_template('podcast-tpl.php')) {
        $data = array_merge(array('@context' => 'https://schema.org'), $series, array('description' => 'Conversations about sourcing from Vietnam: manufacturers, trade agreements, quality control and procurement.'));
    }
    if ($data) echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}, 30);

