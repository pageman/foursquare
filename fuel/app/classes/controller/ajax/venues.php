<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of venues
 *
 * @author 4sq hackathon
 */
class Controller_Ajax_Venues extends \Fuel\Core\Controller {

    public function action_recomends(){
        $lat    = Fuel\Core\Input::post('lang');
        $long   = Fuel\Core\Fuel::post('long');
        $location = "$lat,$long";
        
        return json_encode(sq4hack\sq4hack::puke_recommends($location));
    }
    
    public function action_photos(){
        $id = Fuel\Core\Input::post('id');
        return json_encode(sq4hack\sq4hack::puke_group_photos($id));
    }
}

