<?php
	/**
	 *
	 * @author tanaka-m
	 * @date 12/11/30 15:53
	 */
class Controller_Checkin extends ApplicationController
{
	public function action_recent()
	{
		$endpoint = "/checkins/recent";

		list($lat,$lon) = array('35.690115', '139.701141');

		$params = array('ll' => $lat.','.$lon, 'limit' => 10 );

		$this->foursquare->SetAccessToken(Session::get('token'));
		$response = $this->foursquare->GetPrivate($endpoint,$params);
		$checkins = json_decode($response, 999);

		var_dump($checkins);
		exit;
	}
}