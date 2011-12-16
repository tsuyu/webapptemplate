<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

class Address {

    private $uid;
    private $address1;
    private $address2;
    private $address3;
    private $username;

    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function getAddress1() {
        return $this->address1;
    }

    public function setAddress1($address1) {
        $this->address1 = $address1;
    }

    public function getAddress2() {
        return $this->address2;
    }

    public function setAddress2($address2) {
        $this->address2 = $address2;
    }

    public function getAddress3() {
        return $this->address3;
    }

    public function setAddress3($address3) {
        $this->address3 = $address3;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

}

?>
