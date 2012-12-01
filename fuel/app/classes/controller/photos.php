<?php

class Controller_Photos extends ApplicationController
{


	public function action_index()
	{
		return Response::forge(View::forge('photos/index'));
	}

	
}
