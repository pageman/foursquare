<?php
	/**
	 *
	 * @author tanaka-m
	 * @date 12/11/30 15:53
	 */
class Controller_User extends ApplicationController
{
	public function action_show($id)
	{
		$endpoint = "/users/{$id}";

		$params = array();

		$this->foursquare->SetAccessToken(Session::get('token'));
		$response = $this->foursquare->GetPrivate($endpoint,$params);
		$user = json_decode($response, 999);

		var_dump($user);
		exit;
	}
}