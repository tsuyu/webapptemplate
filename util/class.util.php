<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Util {
    
    public function emailValid($email) {
        return preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);
    }
    
    public function redirect($url = NULL)
    {
        if(is_null($url)) $url = $_SERVER['PHP_SELF'];
        header("Location: $url");
        exit();
    }
  
}
?>
