<?php

include_once '../entity/class.address.php';
include_once '../entity/class.user.php';
include_once '../api/class.userapi.php';

/**
 * Enter description here ...
 * @author tsuyu
 *
 */
class Facade {

    private $user;
    private $address;
    private $userapi;
    private $util;

    public function __construct($class) {
        foreach ($class as $key => $value) {
            $invoke = strtolower($value);
            $this->$invoke = new $value();
        }
    }

    public function userInstance() {
        return $this->user;
    }

    public function addressInstance() {
        return $this->address;
    }
    
    public function utilInstance() {
        return $this->util;
    }

    public function saveUser($user) {
        $this->userapi->saveUser($user);
    }

    public function __destruct() {
        unset($this->user);
        unset($this->address);
        unset($this->userapi);
    }

}

?>
