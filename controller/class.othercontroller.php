<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * example controller template
 */
include '../../facade/class.otherfacade.php';
include 'abstract.controller.php';

class OtherController {

    public function __construct() {
        session_start();
        $this->com = $_GET['com'];
        $this->action = $_GET['action'];
        $this->message = NULL;
        $this->_init();
    }

    private function _init() {
        
    }

    public function loadMenu() {
        
    }

    public function loadForm() {
        
    }

}

?>
