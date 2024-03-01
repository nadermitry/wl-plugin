<?php
/**
 * @package   wlPlugin
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {

		
			
		
		}

		function custom_post_type_wl_item() {

		
			$labels = array(
				'name'                  => _x( 'Wish List Items', 'Post Type General Name', 'text_domain' ),
				'singular_name'         => _x( 'Wish List Item', 'Post Type Singular Name', 'text_domain' ),
				'menu_name'             => __( 'Wish List Items', 'text_domain' ),
				'name_admin_bar'        => __( 'Wish List Item', 'text_domain' ),
				'archives'              => __( 'Wish List Item Archives', 'text_domain' ),
				'attributes'            => __( 'Wish List Item Attributes', 'text_domain' ),
				'parent_item_colon'     => __( 'Parent Wish List Item:', 'text_domain' ),
				'all_items'             => __( 'All Wish List Items', 'text_domain' ),
				'add_new_item'          => __( 'Add New Wish List Item', 'text_domain' ),
				'add_new'               => __( 'Add New', 'text_domain' ),
				'new_item'              => __( 'New Book', 'text_domain' ),
				'edit_item'             => __( 'Edit Wish List Item', 'text_domain' ),
				'update_item'           => __( 'Update Wish List Item', 'text_domain' ),
				'view_item'             => __( 'View Wish List Item', 'text_domain' ),
				'view_items'            => __( 'View Wish List Items', 'text_domain' ),
				'search_items'          => __( 'Search Wish List Item', 'text_domain' ),
				'not_found'             => __( 'Not found', 'text_domain' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
				'featured_image'        => __( 'Featured Image', 'text_domain' ),
				'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
				'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
				'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
				'insert_into_item'      => __( 'Insert into Wish List Item', 'text_domain' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Wish List Item', 'text_domain' ),
				'items_list'            => __( 'Wish List Items list', 'text_domain' ),
				'items_list_navigation' => __( 'Wish List Items list navigation', 'text_domain' ),
				'filter_items_list'     => __( 'Filter Wish List Items list', 'text_domain' ),
			);
			$args = array(
				'label'                 => __( 'Wish List Item', 'text_domain' ),
				'description'           => __( 'Wish List Items', 'text_domain' ),
				'labels'                => $labels,
				'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-book', // Dashicons: https://developer.wordpress.org/resource/dashicons/
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'post',
			);

			register_post_type( 'wishlist_items', $args );
		
        //echo 'fffffffffffffffffffffff';





		add_action1( 'init', 'custom_post_type_wl_item', 0 );


		flush_rewrite_rules();
	}
}