<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Classes {
    
    protected $class;
    
    public function __construct() {
        $this->class = array("user"=> array("default" => array("User", "Address", "UserApi"),
                                            "retrieve" => array("UserApi"),
                                            "delete" => array("UserApi")),
                             "other"=>array("default"=>array()));
    }
}

?>
