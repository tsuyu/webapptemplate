<?php

require_once 'abstract.facade.php';
require_once 'entity/class.address.php';
require_once 'entity/class.user.php';
require_once 'api/class.userapi.php';

/**
 * example facade template
 * 
 * @author tsuyu
 *
 */
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
