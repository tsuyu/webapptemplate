<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

class User {

    private $uid;
    private $username;
    private $name;
    private $email;
    private $telno;
    private $password;
    private $isActive;
    private $permission;

    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelno() {
        return $this->telno;
    }

    public function setTelno($telno) {
        $this->telno = $telno;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    public function getPermission() {
        return $this->permission;
    }

    public function setPermission($permission) {
        $this->permission = $permission;
    }

}

?>
