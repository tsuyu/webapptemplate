<?php

require_once '../datasource/class.adapter.php';
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
        
        $this->db->commitStart();
        
        $query = sprintf('INSERT INTO `user` (`username`, `name`,`email`,`telno`,' .
                '`password`,`isactive`,`permission`) VALUES ("%s", "%s", "%s", "%s", "%s", %d, %d)', 
                $this->db->sanitize($user->userInstance()->getUsername()),
                $this->db->sanitize($user->userInstance()->getName()),
                $this->db->sanitize($user->userInstance()->getEmail()),
                $this->db->sanitize($user->userInstance()->getTelNo()),
                $this->db->sanitize($user->userInstance()->getPassword()),
                $this->db->sanitize($user->userInstance()->getIsActive()),
                $this->db->sanitize($user->userInstance()->getPermission())
        );
        
        if (!$this->db->query($query)) {
            echo 'failed';
            exit ();
        }

        $query = sprintf('INSERT INTO `address` (`address1`,`username`) VALUES ("%s", "%s")', 
                $this->db->sanitize($user->addressInstance()->getAddress1()), 
                $this->db->sanitize($user->userInstance()->getUsername())
        );
      
        if (!$this->db->query($query)) {
            echo 'failed';
            exit ();
        } else {
            $this->db->commit();
            echo 'success';
        }
    }
    
    public function retrieveUser(){
        $query = "SELECT * FROM `user`";
        $this->db->query($query);
        echo $this->db->countRows();
    }
    
    public function updateUser($user){
        
        $this->db->commitStart();
        
        $query = sprintf('UPDATE `user` SET `name` = "%s", `email` = "%s", `telno` = "%s",' .
			'`password` = "%s", `isactive` = %d, `permission` = %d WHERE `username` = "%s"', 
                $this->db->sanitize($user->userInstance()->getName()),
                $this->db->sanitize($user->userInstance()->getEmail()),
                $this->db->sanitize($user->userInstance()->getTelNo()),
                $this->db->sanitize($user->userInstance()->getPassword()),
                $this->db->sanitize($user->userInstance()->getIsActive()),
                $this->db->sanitize($user->userInstance()->getPermission()),
                $this->db->sanitize($user->userInstance()->getUsername())
        );
        
        if (!$this->db->query($query)) {
            echo 'failed';
            exit ();
        } else {
            echo 'success';
            exit ();
        }
        
        $query = sprintf('UPDATE `address` SET `address1` = "%s" WHERE `username` = "%s"', 
                $this->db->sanitize($user->addressInstance()->getAddress1()), 
                $this->db->sanitize($user->userInstance()->getUsername())
        );
        
        if (!$this->db->query($query)) {
            echo 'failed';
            exit ();
        } else {
            echo 'success';
            $this->db->commit();
        }
                 
    }
    
    public function deleteUser($username){
        
        $query = sprintf('DELETE FROM `user` WHERE `username` = "%s"', 
               $this->db->sanitize($username)
        );
        
        if (!$this->db->query($query)) {
            echo 'failed';
            exit ();
        } else {
            echo 'success';
        }
    }

}
?>
