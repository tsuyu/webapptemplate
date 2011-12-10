<?php

require_once 'class.mysql.php';
require_once 'class.mysqli.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Db {

    private $config;

    public function &getInstance() {
        static $obj;
        $this->config = parse_ini_file('config.ini', 1);
        $driver = $this->config['driver']['driver'];
        if (!isset($obj)) {
            $obj = &new $driver();
        }
        return $obj;
    }
}

?>
