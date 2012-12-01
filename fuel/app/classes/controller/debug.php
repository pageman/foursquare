<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Controller_Debug extends \Fuel\Core\Controller {
    public function action_index() {
        $view = Fuel\Core\View::forge('debug');
        return $view;
    }
}
