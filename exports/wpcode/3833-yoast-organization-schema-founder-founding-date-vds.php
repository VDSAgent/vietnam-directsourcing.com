add_filter( 'wpseo_schema_organization', function ( $data ) {
    $data['foundingDate'] = '2024';
    $data['founder'] = array(
        '@type'    => 'Person',
        'name'     => 'Rod Smith',
        'jobTitle' => 'Sourcing Manager',
        'sameAs'   => array( 'https://www.linkedin.com/in/roddouglassmith/' ),
    );
    $data['@type'] = array( 'Organization', 'LocalBusiness' );
    $data['address'] = array(
        '@type'           => 'PostalAddress',
        'streetAddress'   => 'Suite 504, Level 3, 74 Bach Dang, Hai Chau 1, Hai Chau',
        'addressLocality' => 'Da Nang',
        'postalCode'      => '550000',
        'addressCountry'  => 'VN',
    );
    return $data;
} );