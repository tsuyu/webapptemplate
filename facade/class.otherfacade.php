<?php

/**
 * example facade template
 * 
 * @author tsuyu
 *
 */

require_once 'abstract.facade.php';
require_once '../../entity/class..php';
require_once '../../api/class.otherapi.php';

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
