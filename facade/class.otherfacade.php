<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * example facade template
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

require SERVER_ROOT.'facade'.DS.'abstract.facade.php';
require SERVER_ROOT.'api'.DS.'class.otherapi.php';

class OtherFacade extends Facade {

    public function __construct($mode) {
        $this->instance = array();
        //default class
        $this->classes = array("");
        $this->init($mode);
    }

    public function __destruct() {
        unset($this->instance);
    }

}

?>
