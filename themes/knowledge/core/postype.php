<?php
add_action('init', 'add_custom_post_type');
function add_custom_post_type() 
{
	$args = array(
		'labels' => array('name' => __('Team')),
		'public' => true,
		'supports'      => array(
								'title',
								'editor',
								'thumbnail',
								'custom-fields',
								'author',
								'comments'
							   ),
	);
	register_post_type('team',$args);
}

function add_team_taxonomy() {
	register_taxonomy('team_taxonomy', 'team', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Category', 'Team general name' ),
			'singular_name' => _x( 'Category', 'team singular name' ),
			'search_items' =>  __( 'Search Team Categories' ),
			'all_items' => __( 'Team Categories' ),
			'parent_item' => __( 'Parent Team Category' ),
			'parent_item_colon' => __( 'Parent Team Category:' ),
			'edit_item' => __( 'Edit Team Category' ),
			'update_item' => __( 'Update Team Category' ),
			'add_new_item' => __( 'Add New Team Category' ),
			'new_item_name' => __( 'New Team Category Name' ),
			'menu_name' => __( 'Team Categories' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'team-category', // This controls the base slug that will display before each term
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_team_taxonomy', 0 );


function prefix_register_post_type(){   
//     register_post_type(
//     'testimonial',
//     array(
//       'labels'        => array(
//         'name'               => __('Testimonial'),
//         'singular_name'      => __('Testimonial'),
//         'menu_name'          => __('Testimonial'),
//         'name_admin_bar'     => __('Testimonial Item'),
//         'all_items'          => __('All Items'),
//         'add_new'            => __('Add New'),
//         'add_new_item'       => __('Add New Item'),
//         'edit_item'          => __('Edit Item'),
//         'new_item'           => __('New Item'),
//         'view_item'          => __('View Item'),
//         'search_items'       => __('Search Items'),
//         'not_found'          => __('No items found.'),
//         'not_found_in_trash' => __('No items found in Trash.'),
//         'parent_item_colon'  => __('Parent Items:'),
//       ),
//       'public'        => true,  
//       'menu_position' => 4,
//       'menu_icon'     =>'dashicons-image-filter',
//       'taxonomies'          => array('testimonial-taxanomy'),
//       'supports'      => array('title','editor','thumbnail', 'custom-fields', 'author'),      
//       'has_archive'   => true,
//       'rewrite'       => array(
//         'slug' => 'testimonial',
//       ),
//     )
//   );
  register_post_type(
    'podcast',
    array(
      'labels'        => array(
        'name'               => __('Podcast'),
        'singular_name'      => __('Podcast'),
        'menu_name'          => __('Podcast'),
        'name_admin_bar'     => __('Case Item'),
        'all_items'          => __('All Podcasts'),
        'add_new'            => __('Add Podcast'),
        'add_new_item'       => __('Add New Podcast'),
        'edit_item'          => __('Edit Podcast'),
        'new_item'           => __('New Podcast'),
        'view_item'          => __('View Podcast'),
        'search_items'       => __('Search Podcast'),
        'not_found'          => __('No Podcast found.'),
        'not_found_in_trash' => __('No Podcast found in Trash.'),
        'parent_item_colon'  => __('Parent Podcast:'),
      ),
      'public'        => true,  
      'menu_position' => 5,
      'menu_icon'     =>'dashicons-image-filter',
    'taxonomies'          => array('case-taxanomy'),
      'supports'      => array('title','editor','thumbnail', 'custom-fields', 'author'),      
      'has_archive'   => true,
      'rewrite'       => array(
        'slug' => 'Podcast',
      ),
    )
  );
    register_post_type(
    'our-services',
    array(
      'labels'        => array(
        'name'               => __('Services'),
        'singular_name'      => __('Services'),
        'menu_name'          => __('Services'),
        'name_admin_bar'     => __('Services Item'),
        'all_items'          => __('All Items'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Item'),
        'edit_item'          => __('Edit Item'),
        'new_item'           => __('New Item'),
        'view_item'          => __('View Item'),
        'search_items'       => __('Search Items'),
        'not_found'          => __('No items found.'),
        'not_found_in_trash' => __('No items found in Trash.'),
        'parent_item_colon'  => __('Parent Items:'),
      ),
      'public'        => true,  
      'menu_position' => 5,
      'menu_icon'     =>'dashicons-image-filter',
    'taxonomies'          => array('services-taxanomy'),
      'supports'      => array('title','editor','thumbnail', 'custom-fields', 'author'),      
      'has_archive'   => true,
      'rewrite'       => array(
        'slug' => 'our-services',
      ),
    )
  );
  
}
add_action('init', 'prefix_register_post_type');
function crunchify_create_deals_custom_taxonomy() { 
  $labels = array(
    'name' => _x( 'Case taxonomy', 'taxonomy general name' ),
    'singular_name' => _x( 'Case', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Case' ),
    'all_items' => __( 'All Case' ),
    'parent_item' => __( 'Parent Case' ),
    'parent_item_colon' => __( 'Parent Case:' ),
    'edit_item' => __( 'Edit Case' ), 
    'update_item' => __( 'Update Case' ),
    'add_new_item' => __( 'Add New Case' ),
    'new_item_name' => __( 'New Case Name' ),
    'menu_name' => __( 'Case taxonomy' ),
  );   
 
  register_taxonomy('case-taxanomy',array('case'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'case-taxanomy' ),
  ));
}