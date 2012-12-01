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
        return json_encode(sq4hack\sq4hack::puke_recommends('14.5583092,121.0185147'));
    }
    
    public function action_photos(){
        return json_encode(sq4hack\sq4hack::puke_group_photos('4fda95dde4b036cbf8a92501'));
        //return sq4hack\sq4hack::puke_group_photos('4fda95dde4b036cbf8a92501');
    }
}

