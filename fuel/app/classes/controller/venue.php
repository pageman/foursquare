<?php
/**
 *
 * @author tanaka-m
 * @date 12/11/30 15:53
 */
class Controller_Venue extends ApplicationController
{

	/**
	 * Search Venues
	 *
	 * e.g.) http://4sqhack.local/venue/search
	 *
	 * @return mixed
	 */
	public function action_search()
	{
		$endpoint = "/venues/explore";

		//list($lat,$long) = $this->get_ll(input::post('location'));
		list($lat,$lon) = array('35.690115', '139.701141');

		//$params = array('near'=>input::post('location'),'radius'=>10,'limit'=>10, );
		$params = array('ll' => $lat.','.$lon, 'limit' => 3 );

		$response = $this->foursquare->GetPublic($endpoint,$params);

		$venue_list = json_decode($response, 999);

		var_dump($venue_list);
		exit;

		$view = View::forge('venue/search');
		$view->venue = $venue_list;
		$view->post	 = input::post('location');
		$view->post_section = input::post('section');
		return $view;
	}

	/**
	 * Fetch photos
	 *
	 * e.g.) http://4sqhack.local/venue/photos/4b166583f964a520acb823e3
	 *
	 * @param $id
	 */
	public function action_photos($id)
	{
		$endpoint = "/venues/{$id}/photos";
		$params = array('group' => 'venue', 'limit' => 20 );

		$response = $this->foursquare->GetPublic($endpoint, $params);
		$photos = json_decode($response, 999);

		var_dump($photos);
		exit;

	}

}