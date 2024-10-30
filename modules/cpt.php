<?php
function at_add_post_type() {
  $labels = array(
    'name' => _x('Tooltips', 'ta_domain'),
    'singular_name' => _x('Tooltip', 'ta_domain'),
    'add_new' => _x('Add New', 'ta_domain'),
    'add_new_item' => __('Add New Tooltip', 'ta_domain'),
    'edit_item' => __('Edit Tooltip', 'ta_domain'),
    'new_item' => __('New Tooltip', 'ta_domain'),
    'all_items' => __('All Tooltips', 'ta_domain'),
    'view_item' => __('View Tooltip', 'ta_domain'),
    'search_items' => __('Search Tooltip', 'ta_domain'),
    'not_found' =>  __('No Tooltip found', 'ta_domain'),
    'not_found_in_trash' => __('No Tooltip found in Trash', 'ta_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Tooltips', 'ta_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
	'menu_icon' => plugins_url('/images/tooltip-icon.png', __FILE__ ),
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor','custom-fields' )
  ); 
  register_post_type('single_data', $args);
}
add_action( 'init', 'at_add_post_type' );
?>