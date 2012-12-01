<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of debug
 *
 * @author 4sq hackathon
 */
class Controller_Debug extends Fuel\Core\Controller {
   public function action_index(){
       $view = \Fuel\Core\View::forge('debug');
       return $view;
   }
}

