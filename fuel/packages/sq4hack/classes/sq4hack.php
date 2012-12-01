<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sq4hack;
include('eden.php');
include('FoursquareAPI.class.php');

class sq4hack {
    private static $instance;
    private static $config;
    
    public static function forge() {
        self::$config = \Fuel\Core\Config::load('sq4');
        if(is_null(self::$instance)):
            self::$instance = new \FoursquareApi(self::$config['client_key'],self::$config['client_secret']);
        endif;
        return self::$instance;
    }
}
