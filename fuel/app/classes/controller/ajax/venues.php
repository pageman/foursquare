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
        $lat    = Fuel\Core\Input::post('lat');
        $long   = Fuel\Core\Input::post('lng');
        $location = "$lat,$long";
            
        return json_encode(sq4hack\sq4hack::puke_recommends($location));
    }
    
    public function action_photos(){
        $id     = Fuel\Core\Input::post('id');
        $limit  = Fuel\Core\Input::post('limit');
        $offset = Fuel\Core\Input::post('offset');
        
        if(is_null($limit) Or is_null($offset)):
            return json_encode(sq4hack\sq4hack::puke_group_photos($id,100,0));
        else:
            return json_encode(sq4hack\sq4hack::puke_group_photos($id,$limit,$offset));
        endif;
    }
}