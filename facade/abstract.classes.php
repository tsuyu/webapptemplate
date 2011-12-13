<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Classes {

    protected $class;

    public function __construct() {
        //set the default class instance
        $this->class = array("user:default" => array("User", "Address", "UserApi"));
    }

}

?>
