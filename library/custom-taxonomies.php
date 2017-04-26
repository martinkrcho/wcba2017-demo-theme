<?php

add_action('init', 'fp_create_custom_taxonomies');

function fp_create_custom_taxonomies() {

	fp_create_manufacturer_taxonomy();
	fp_create_year_taxonomy();
}

function fp_create_manufacturer_taxonomy() {

	$labels = array(
		'name' => _x('Výrobcovia', 'Taxonomy General Name', 'foundationpress'),
		'singular_name' => _x('Výrobca', 'Taxonomy Singular Name', 'foundationpress'),
		'menu_name' => __('Výrobca', 'foundationpress'),
		'all_items' => __('Všetci výrobcovia', 'foundationpress'),
		'parent_item' => __('Nadradená výrobca', 'foundationpress'),
		'parent_item_colon' => __('Nadradená výrobca:', 'foundationpress'),
		'new_item_name' => __('Nová výrobca', 'foundationpress'),
		'add_new_item' => __('Pridať nového výrobcu', 'foundationpress'),
		'edit_item' => __('Upraviť výrobcu', 'foundationpress'),
		'update_item' => __('Aktualizovať výrobcu', 'foundationpress'),
		'view_item' => __('Zobraziť výrobcu', 'foundationpress'),
		'separate_items_with_commas' => __('Oddeľte výrobcov čiarkami', 'foundationpress'),
		'add_or_remove_items' => __('Pridať alebo odobrať výrobcov', 'foundationpress'),
		'choose_from_most_used' => __('Choose from the most used', 'foundationpress'),
		'popular_items' => __('Populárni výrobcovi', 'foundationpress'),
		'search_items' => __('Nájsť výrobcu', 'foundationpress'),
		'not_found' => __('Not Found', 'foundationpress'),
		'no_terms' => __('No items', 'foundationpress'),
		'items_list' => __('Items list', 'foundationpress'),
		'items_list_navigation' => __('Items list navigation', 'foundationpress'),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_rest' => true,
	);
	register_taxonomy('manufacturer', array('car'), $args);
}

function fp_create_year_taxonomy() {

	$labels = array(
		'name' => _x('Rok výroby', 'Taxonomy General Name', 'foundationpress'),
		'singular_name' => _x('Rok výroby', 'Taxonomy Singular Name', 'foundationpress'),
		'menu_name' => __('Rok výroby', 'foundationpress'),
		'all_items' => __('Všetky roky', 'foundationpress'),
		'parent_item' => __('Nadradený rok výroby', 'foundationpress'),
		'parent_item_colon' => __('Nadradený rok výroby:', 'foundationpress'),
		'new_item_name' => __('Nový rok výroby', 'foundationpress'),
		'add_new_item' => __('Pridať nový rok výroby', 'foundationpress'),
		'edit_item' => __('Upraviť rok výroby', 'foundationpress'),
		'update_item' => __('Aktualizovať rok výroby', 'foundationpress'),
		'view_item' => __('Zobraziť rok výroby', 'foundationpress'),
		'separate_items_with_commas' => __('Oddeľte roky výroby čiarkami', 'foundationpress'),
		'add_or_remove_items' => __('Pridať alebo odobrať roky výroby', 'foundationpress'),
		'choose_from_most_used' => __('Choose from the most used', 'foundationpress'),
		'popular_items' => __('Populárne roky výroby', 'foundationpress'),
		'search_items' => __('Nájsť rok výroby', 'foundationpress'),
		'not_found' => __('Not Found', 'foundationpress'),
		'no_terms' => __('No items', 'foundationpress'),
		'items_list' => __('Items list', 'foundationpress'),
		'items_list_navigation' => __('Items list navigation', 'foundationpress'),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_rest' => true,
	);
	register_taxonomy('year', array('car'), $args);
}
