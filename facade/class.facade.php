<?php

require_once 'abstract.classes.php';
require_once '../entity/class.address.php';
require_once '../entity/class.user.php';
require_once '../util/class.util.php';
require_once '../api/class.userapi.php';

/**
 * Enter description here ...
 * @author tsuyu
 *
 */
class Facade extends Classes {

    private $user;
    private $address;
    private $userapi;
    private $util;

    public function __construct($mode) {
        parent::__construct();
        $this->init($mode);
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
    
    public function updateUser($user) {
        $this->userapi->updateUser($user);
    }
    
    public function deleteUser($username) {
        $this->userapi->deleteUser($username);
    }

    public function init($mode) {
        $split = explode(':', $mode);
        foreach ($this->class[$split[0]] as $key => $value) {
            foreach ($value as $key2 => $class) {
                if ($key == $split[1]) {
                    $invoke = strtolower($class);
                    $this->$invoke = new $class();
                }
            }
        }
    }
    
    public function __destruct() {
        unset($this->user);
        unset($this->address);
        unset($this->userapi);
        unset($this->util);
    }

}

?>
