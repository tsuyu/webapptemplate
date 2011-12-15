<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @author tsuyu
 */

abstract class Controller {

    protected $com;
    protected $action;
    protected $message;

    public function logout() {
        $_SESSION = array();
        session_unset();
        session_destroy();
        Util::redirect("index.php");
        exit();
    }

}

?>
