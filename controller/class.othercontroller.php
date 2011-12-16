<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * example controller template
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

require SERVER_ROOT.'facade'.DS.'class.otherfacade.php';
require SERVER_ROOT.'controller'.DS.'abstract.controller.php';

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
