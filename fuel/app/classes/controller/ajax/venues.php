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
        return json_encode(sq4hack\sq4hack::puke_recommends('11.8494,121.8862'));
    }
}

