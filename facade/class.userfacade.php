<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

require SERVER_ROOT.'facade'.DS.'abstract.facade.php';
require SERVER_ROOT.'entity'.DS.'class.address.php';
require SERVER_ROOT.'entity'.DS.'class.user.php';
require SERVER_ROOT.'api'.DS.'class.userapi.php';

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
