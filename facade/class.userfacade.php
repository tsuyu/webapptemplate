<?php

require_once 'abstract.facade.php';
require_once '../../entity/class.address.php';
require_once '../../entity/class.user.php';
require_once '../../api/class.userapi.php';

/**
 * Enter description here ...
 * @author tsuyu
 *
 */
class UserFacade extends Facade {

    public function __construct($mode) {
        $this->instance = array();
        //default class
        $this->classes = array("User", "Address", "UserApi");
        $this->init($mode);
    }

    public function userInstance() {
        return $this->instance['user'];
    }

    public function addressInstance() {
        return $this->instance['address'];
    }

    public function createUser($user) {
        $this->instance['userapi']->createUser($user);
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

    public function __destruct() {
        unset($this->instance);
    }

}

?>
