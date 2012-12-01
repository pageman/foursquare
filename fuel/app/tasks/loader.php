<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package	   Fuel
 * @version	   1.0
 * @author	   Fuel Development Team
 * @license	   MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link	   http://fuelphp.com
 */

namespace Fuel\Tasks;

/**
 * Loader task
 *
 * @package		Fuel
 * @version		1.0
 * @author		masayukitanaka
 */
class Loader
{

	/**
	 * Help method
	 * @author masayukitanaka
	 * @return string
	 */
	public static function run()
	{

		return <<<EOS
--------------
Loader task
$ php oil refine loader:<category> <table>

<category>
  - master
  - dummy

<table>
  not implemented
--------------
EOS;
	}

	public static function dummy()
	{
		/*
		$dummy_user = Model_User::find_by_pk(1);
		if(empty($dummy_user)){
			$dummy_user = new \Model_User();
			$dummy_user->id		   = 1;
		}

		$dummy_user->platform_id   = "apple";
		$dummy_user->name		   = "dummy";
		$dummy_user->gender		   = 1;
		$dummy_user->age		   = 29;
		$dummy_user->level		   = 1;
		$dummy_user->exp		   = 0;
		$dummy_user->vitality	   = 0;
		$dummy_user->max_vitality  = 10;
		$dummy_user->deck_id	   = 1;
		$dummy_user->tutorial_id   = 1;
		$dummy_user->money		   = 1;
		$dummy_user->guild_point   = 1;
		$dummy_user->save();

		return <<<EOS
--------------
created dummy user.
--------------
EOS;
		*/
		return '<not implemented>';

	}
}

/* End of file tasks/robots.php */
