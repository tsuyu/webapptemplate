<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

require SERVER_ROOT.'datasource'.DS.'class.adapter.php';

abstract class Model {

    protected $db;

    public function __construct() {
        $this->db = Db::getInstance();
    }

}

?>
