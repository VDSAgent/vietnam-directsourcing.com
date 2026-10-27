add_action('wp_head', function () {
    if ( ! is_page(1296) ) return;
    if ( ! function_exists('get_field') ) return;
    $rows = get_field('field_66e58d8dceaa5', 1296);
    if ( empty($rows) || ! is_array($rows) ) return;
    $items = array();
    foreach ($rows as $row) {
        if ( ! is_array($row) ) continue;
        $vals = array_values($row);
        $q = isset($vals[0]) ? trim( wp_strip_all_tags($vals[0]) ) : '';
        $a = isset($vals[1]) ? trim( wp_strip_all_tags($vals[1]) ) : '';
        if ($q === '' || $a === '') continue;
        $items[] = array(
            '@type' => 'Question',
            'name'  => $q,
            'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $a ),
        );
    }
    if ( empty($items) ) return;
    $schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $items,
    );
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
}, 20);