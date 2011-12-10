<?php

require_once 'abstract.model.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserApi extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function saveUser($user) {

        $this->db->commit_start();

        $query = sprintf('INSERT INTO `user` (`username`, `name`,`email`,`telno`,' .
                '`password`,`isactive`,`permission`) VALUES ("%s", "%s", "%s", "%s", "%s", %d, %d)', $this->db->string_escape($user->userInstance()->getUsername()), $this->db->string_escape($user->userInstance()->getName()), $this->db->string_escape($user->userInstance()->getEmail()), $this->db->string_escape($user->userInstance()->getTelNo()), $this->db->string_escape($user->userInstance()->getPassword()), $this->db->string_escape($user->userInstance()->getIsActive()), $this->db->string_escape($user->userInstance()->getPermission())
        );

        if (!$this->db->query($query)) {
            echo 'failed';
            exit;
        }

        $query = sprintf('INSERT INTO `address` (`address1`,`username`) VALUES ("%s", "%s")', $this->db->string_escape($user->addressInstance()->getAddress1()), $this->db->string_escape($user->userInstance()->getUsername())
        );

        if (!$this->db->query($query)) {
            echo 'failed';
            exit;
        } else {
            $this->db->commit();
            echo 'success';
        }
        
        $this->db->close();
    }

}

?>
