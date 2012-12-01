<?php
/**
 *
 * @author tanaka-m
 * @date 12/11/30 15:53
 */
class Controller_OAuth extends ApplicationController
{
	public function action_start()
	{
		Response::redirect($this->foursquare->AuthenticationLink(Config::get('callback_url')));
		exit;
	}

	public function action_callback()
	{
		if(array_key_exists("code", $_GET)){
			$token = $this->foursquare->GetToken($_GET['code'], Config::get('callback_url'));
		}
		Session::set('token', $token);

		if(empty($token))
		{
			echo "oops! something wrong.";
		}
		else
		{
			echo "successfully obtained token. token: {$token}";
		}

		exit;
	}

	public function action_checktoken()
	{
		var_dump(Session::get('token'));
		exit;
	}

	public function action_sessionset()
	{
		Session::set('foo', 'bar');
		echo "@";exit;
	}

	public function action_sessionget()
	{
		echo Session::get('foo');exit;
	}

}
