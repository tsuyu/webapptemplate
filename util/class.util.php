<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Util {
    
    public function validate_email($email) {
        return preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);
    }
}

?>
