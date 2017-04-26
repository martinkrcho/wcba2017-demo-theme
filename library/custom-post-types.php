<?php

add_action('init', 'fp_register_post_types');

// Register Custom Post Type
function fp_register_post_types() {

	$labels = array(
		'name' => _x('Autá', 'Post Type General Name', 'foundationpress'),
		'singular_name' => _x('Auto', 'Post Type Singular Name', 'foundationpress'),
		'menu_name' => __('Autá', 'foundationpress'),
		'name_admin_bar' => __('Auto', 'foundationpress'),
		'archives' => __('Zoznam áut', 'foundationpress'),
		'attributes' => __('Parametre auta', 'foundationpress'),
		'parent_item_colon' => __('Nadradené auto:', 'foundationpress'),
		'all_items' => __('Všetky autá', 'foundationpress'),
		'add_new_item' => __('Pridať nové auto', 'foundationpress'),
		'add_new' => __('Pridať nové', 'foundationpress'),
		'new_item' => __('Nové auto', 'foundationpress'),
		'edit_item' => __('Upraviť auto', 'foundationpress'),
		'update_item' => __('Aktualizovať auto', 'foundationpress'),
		'view_item' => __('Zobraziť auto', 'foundationpress'),
		'view_items' => __('Zobraziť autá', 'foundationpress'),
		'search_items' => __('Hľadať auto', 'foundationpress'),
		'not_found' => __('Nenašlo sa', 'foundationpress'),
		'not_found_in_trash' => __('Nenašlo sa v koši', 'foundationpress'),
		'featured_image' => __('Featured Image', 'foundationpress'),
		'set_featured_image' => __('Set featured image', 'foundationpress'),
		'remove_featured_image' => __('Remove featured image', 'foundationpress'),
		'use_featured_image' => __('Use as featured image', 'foundationpress'),
		'insert_into_item' => __('Vložiť k autu', 'foundationpress'),
		'uploaded_to_this_item' => __('Nahrané k tomuto autu', 'foundationpress'),
		'items_list' => __('Zoznam áut', 'foundationpress'),
		'items_list_navigation' => __('Items list navigation', 'foundationpress'),
		'filter_items_list' => __('Filter items list', 'foundationpress'),
	);
	$args = array(
		'label' => __('Auto', 'foundationpress'),
		'description' => __('Katalóg automobilov.', 'foundationpress'),
		'labels' => $labels,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'revisions',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-menu',
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'show_in_rest' => true,
	);
	register_post_type('car', $args);
}

