<?php

class FoundationPress_RestAPI {

	public static function init() {
		add_action('rest_api_init', array(__CLASS__, 'initializeEndpoints'));
	}

	public static function initializeEndpoints() {

		register_rest_route('foundationpress/v1', '/cars/', array(
			'methods' => 'POST',
			'callback' => array(__CLASS__, 'handleGetCarsRequest')
		));
	}

	public static function getCarData($carId) {

		if (intval($carId) == 0) {
			$carId = get_the_ID();
		}

		$result = array(
			'id' => $carId,
			'title' => get_the_title($carId),
			'permalink' => get_permalink($carId),
			'thumbnail_url' => get_the_post_thumbnail_url($carId, 'medium')
		);

		$metaFields = array('engine_size', 'mileage', 'consumption');
		foreach ($metaFields as $metaField) {
			$result[$metaField] = get_field($metaField, $carId);
		}

		$taxonomies = array('manufacturer', 'year');
		foreach ($taxonomies as $taxonomy) {

			$terms = get_the_terms($carId, $taxonomy);
			if (!empty($terms)) {
				$result[$taxonomy] = $terms[0]->name;
			}
		}

		return $result;
	}

	public static function handleGetCarsRequest(WP_REST_Request $request) {

		$cars = array();
		$parameters = $request->get_params();
		$queryArgs = self::buildCarsQueryArguments($parameters);
		$query = NULL;

		if ($queryArgs !== FALSE) {

			//	load the cars
			$query = new WP_Query($queryArgs);

			while ($query->have_posts()) {

				$query->the_post();
				array_push($cars, self::getCarData($carId));
			}
		}
		$result = array(
			'cars' => $cars,
			//'data' => $parameters,
			'total_pages' => ($query === NULL) ? 0 : $query->max_num_pages,
			//'query' => $queryArgs
		);

		wp_reset_postdata();
		return $result;
	}

	public static function buildCarsQueryArguments($parameters) {

		$metaQuery = array();
		$taxQuery = array();
		$queryArgs = array(
			'post_type' => 'car',
			'post_status' => 'publish'
		);

		//	pagination
		$page = array_key_exists('page', $parameters) ? intval($parameters['page']) : 1;
		$queryArgs['paged'] = $page;
		if (array_key_exists('per_page', $parameters) && !empty($parameters['per_page'])) {
			$queryArgs['posts_per_page'] = intval($parameters['per_page']);
		}

		//	ordering
		$orderby = array_key_exists('orderby', $parameters) ? $parameters['orderby'] : 'date';
		$allowedOrderOptions = array('date', 'age', 'title', 'mileage', 'rand');
		if (in_array($orderby, $allowedOrderOptions)) {

			if (in_array($orderby, array('title', 'rand', 'date'))) {
				$queryArgs['orderby'] = $orderby;
			} else {

				$queryArgs['meta_key'] = $orderby;
				$queryArgs['orderby'] = 'meta_value';
			}

			$queryArgs['order'] = ($orderby == 'title') ? 'ASC' : 'DESC';
		}

		//	year taxonomy filter
		if (array_key_exists('year', $parameters) && 'all' != $parameters['year']) {

			array_push($taxQuery, array(
				'taxonomy' => 'year',
				'field' => 'term_id',
				'terms' => intval($parameters['year'])
			));
		}

		//	manufacturer taxonomy filter
		if (array_key_exists('manufacturer', $parameters) && 'all' !== $parameters['manufacturer']) {

			array_push($taxQuery, array(
				'taxonomy' => 'manufacturer',
				'field' => 'term_id',
				'terms' => intval($parameters['manufacturer'])
			));
		}

		if (!empty($metaQuery)) {
			$queryArgs['meta_query'] = $metaQuery;
		}

		if (!empty($taxQuery)) {

			if (count($taxQuery) > 1) {
				$taxQuery['relation'] = 'AND';
			}

			$queryArgs['tax_query'] = $taxQuery;
		}

		return $queryArgs;
	}

}

FoundationPress_RestAPI::init();
