<?php
/**
 *
 * @author tanaka-m
 * @date 12/11/30 16:17
 */
class ApplicationController extends \Fuel\Core\Controller_Template
{
	public function __construct(\Request $request)
	{
		parent::__construct($request);

		$this->foursquare = new FoursquareApi(Config::get('client_id'), Config::get('client_secret'));
	}

}
