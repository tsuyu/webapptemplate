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

    private $instance;

    public function __construct($mode) {
        parent::__construct();
        $this->instance = array();
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

    public function retrieveUser() {
        $this->instance['userapi']->retrieveUser();
    }

    public function updateUser($user) {
        $this->instance['userapi']->updateUser($user);
    }

    public function deleteUser($username) {
        $this->instance['userapi']->deleteUser($username);
    }

    public function init($mode) {
        if (in_array($mode, array_keys($this->class))) {
            foreach ($this->class[$mode] as $class) {
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
