<?php

include '../entity/class.address.php';
include '../entity/class.user.php';
include '../api/class.userapi.php';
/**
 * Enter description here ...
 * @author tsuyu
 *
 */
class Facade {

    private $user;
    private $address;
    private $userapi;

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
    
    public function saveUser($user){
        $this->userapi->saveUser($user);
    }
    
    public function __destruct() {
        unset($this->user);
        unset($this->address);
        unset($this->userapi);
    }

}

?>
