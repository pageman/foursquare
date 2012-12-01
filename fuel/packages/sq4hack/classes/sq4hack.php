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
    private static $url  = 'https://api.foursquare.com/v2/';
    private static $auth;
    private static $oauth;
    

    
    public static function puke_group_photos($id,$limit,$offset){
        $places_photos      = self::puke_venue_photos($id,$limit,$offset);
        $places             = json_decode($places_photos);
        $photos             = $places->response->photos->items;
        $photos_filtered    = array();
        $c                  = 0;
        
        foreach ($photos as $photo):
            $photos_filtered[$c]['url']         = 'https://is1.4sqi.net/pix/'.$photo->suffix;
            $photos_filtered[$c]['height']      = $photo->height;
            $photos_filtered[$c]['width']       = $photo->width;
            $photos_filtered[$c]['firstName']   = trim($photo->user->firstName);
            $photos_filtered[$c]['avatar']      = 'https://is0.4sqi.net/userpix_thumbs/'.$photo->user->photo->suffix;
            $photos_filtered[$c]['id']          = $photo->user->id;   
            $c++;
        endforeach;
        return $photos_filtered;
    }
    
    public static function puke_venue_photos($id,$limit,$offset) {
        self::load_auth();
        $page   = "&limit=$limit&offset=$offset";
        $uri    = self::$url . 'venues/'.$id.'/photos'.self::$auth.'group=venue'.$page;
        return self::rest_gen($uri);
    }
    
    public static function puke_recommends($near) {
        $places_json    = self::puke_venue($near);
        $places         = json_decode($places_json);
        $venues         = $places->response->groups[0]->items;
        $venues_filter  = array();
        $c              = 0;
        foreach ($venues as $venue):
            $venues_filter[$c]['name'] = $venue->venue->name;
            $venues_filter[$c]['id']   = $venue->venue->id;
            $c++;
        endforeach;
        return $venues_filter;
    }

    public static function puke_venue($near){
        self::load_auth();
        $uri = self::$url . 'venues/explore' . self::$auth . "ll=$near";
        return self::rest_gen($uri);
    }
    
    private static function oauth_token_url() {
        $token = \Fuel\Core\Session::get('token');
        if(!is_null($token)):
            self::$oauth = "?oauth_token=$token";
        else:
            return null;
        endif;
    }
    
    private static function rest_gen ($uri) {        
        return file_get_contents($uri);
    }
    
    private static function get_config() {
        if(is_null(self::$config)):
            self::$config = \Fuel\Core\Config::load('sq4');
        endif;
    }
    
    private static function load_auth() {
        if(is_null(self::$config)):
            self::get_config();
        endif;
        $client_id      = self::$config['client_key'];
        $client_secret  = self::$config['client_secret'];
        $date           = date('Ymd');
        self::$auth = "?client_id=$client_id&client_secret=$client_secret&v=$date&";
    }
}
