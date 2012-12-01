<?php
require_once(DOCROOT.'assets/lib/FoursquareAPI.class.php');

class Controller_4square extends ApplicationController
{

	public function __construct(Request $request)
	{
	
		parent::__construct($request);
	
		$this->client_id 		= "GBLVA50KNXBDTRB1CR3AM1JELE305ENDQSXE3M0KV03FKRK3";
		$this->client_secret	= "4CNKIJD2F0FAZQNPVE2WKMPIUGWAFRH5XPGHRE2GPGBJ2EAU";
		$this->site				= "http://4sqhack.local/public/4square/user";
		$this->redirect 		= 'http://4sqhack.local/public/4square/user/callback';
		$this->foursquare 		= new FoursquareApi($this->client_id,$this->client_secret);
	}

	public function action_index()
	{
		Session::instance();
		$link = $this->foursquare->AuthenticationLink($this->redirect);
		echo \Fuel\core\response::redirect($link);
	}
	
	
	public function action_venue()
	{
		return Response::forge(View::forge('venue/search'));
	}

	public function action_user()
	{
		$code = input::get('code');
		$token = $this->foursquare->GetToken($code,$this->redirect);
		Session::set('token',$token);		
		
		return Response::forge(View::forge('sample/user'));

	}
	
	public function action_check_in()
	{
		return Response::forge(View::forge('checkin/search'));
	}

	public function action_search_venue()
	{
	
		$endpoint = "/venues/explore";
		
		list($lat,$long) = $this->get_ll(input::post('location'));
		
		$params = array('near'=>input::post('location'),'radius'=>10,'limit'=>10,'section'=>input::post('section'));
		
		$response = $this->foursquare->GetPublic($endpoint,$params);
		
		$venue_list = json_decode($response);
		
		//print_r($venue_list);
		
		$view = View::forge('venue/search');
		$view->venue = $venue_list;
		$view->post	 = input::post('location');
		$view->post_section = input::post('section');
		return $view;
	}
	
	public function action_search_user()
	{
		$token = Session::get('token');
		$name = input::post('name');
		
		$endpoint = "users/search?name=$name&oauth_token=$token&client_secret=$this->client_secret&client_id=$this->client_id&limit=10";
		
		$response = $this->foursquare->GetPublic($endpoint);
		
		$user_list	= json_decode($response);
		
		$view = View::forge('sample/user');
		$view->user = $user_list;
		$view->post	 = input::post('name');
		
		return $view;
	}
	
	public function get_ll($location)
	{
		return $this->foursquare->GeoLocate($location);
	}
	
	

	public function action_404()
	{
		return Response::forge(ViewModel::forge('welcome/404'), 404);
	}
}
