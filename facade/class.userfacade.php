<?php

require_once 'entity/class.address.php';
require_once 'entity/class.user.php';
require_once 'util/class.util.php';
require_once 'api/class.userapi.php';

/**
 * Enter description here ...
 * @author tsuyu
 *
 */
class UserFacade {

    private $instance;
    private $classes;

    public function __construct($mode) {
        $this->instance = array();
        //default class instance
        $this->classes = array("User", "Address", "UserApi");
        $this->init($mode);
    }

    public function userInstance() {
        return $this->instance['user'];
    }

    public function addressInstance() {
        return $this->instance['address'];
    }

    public function utilInstance() {
        return $this->instance['util'];
    }

    public function saveUser($user) {
        $this->instance['userapi']->saveUser($user);
    }

    public function retrieveUser($username) {
        return $this->instance['userapi']->retrieveUser($username);
    }

    public function updateUser($user) {
        $this->instance['userapi']->updateUser($user);
    }

    public function deleteUser($username) {
        $this->instance['userapi']->deleteUser($username);
    }

    public function init($mode = NULL) {
        if (is_null($mode)) {
            foreach ($this->classes as $class) {
                $invoke = strtolower($class);
                if (!isset($this->instance[$invoke]) && empty($this->instance[$invoke])) {
                    $this->instance[$invoke] = new $class();
                }
            }
        } else {
            $classes = explode(",", $mode);
            foreach ($classes as $class) {
                $invoke = strtolower($class);
                if (!isset($this->instance[$invoke]) && empty($this->instance[$invoke])) {
                    $this->instance[$invoke] = new $class();
                }
            }
        }
    }

    public function __destruct() {
        unset($this->instance);
    }

}

?>
