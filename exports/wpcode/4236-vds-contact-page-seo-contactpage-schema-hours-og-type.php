// VDS: contact page SEO - ContactPage schema, opening hours on the business record, og:type website. No phone number by design.

function vds_is_contact_page() { return is_page('contact-for-sourcing'); }

// 1. Mark the page as a ContactPage (keeps WebPage).
add_filter('wpseo_schema_webpage', function ($data) {
    if (vds_is_contact_page()) $data['@type'] = array('WebPage', 'ContactPage');
    return $data;
});

// 2. Opening hours on the LocalBusiness / Organization node (Vietnam time, Mon-Thu 08:00-11:00, Fri 08:00-17:00).
add_filter('wpseo_schema_graph', function ($graph) {
    $hours = array(
        array('@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday'), 'opens' => '08:00', 'closes' => '11:00'),
        array('@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Friday', 'opens' => '08:00', 'closes' => '17:00'),
    );
    foreach ($graph as $i => $node) {
        $types = isset($node['@type']) ? (array) $node['@type'] : array();
        if (in_array('LocalBusiness', $types, true) && empty($node['openingHoursSpecification'])) {
            $graph[$i]['openingHoursSpecification'] = $hours;
        }
    }
    return $graph;
}, 20);

// 3. A contact page is a website page, not an article.
add_filter('wpseo_opengraph_type', function ($type) {
    return vds_is_contact_page() ? 'website' : $type;
});

