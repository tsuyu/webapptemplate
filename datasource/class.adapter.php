<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Db {

    public function &getInstance() {
        
        static $obj;
        $config = array();
        $parse_ini = parse_ini_file('config.ini', 1);
        
        $config['dbhost'] = $parse_ini['mysql']['dbhost'];
        $config['dbuser'] = $parse_ini['mysql']['dbuser'];
        $config['dbpassword'] = $parse_ini['mysql']['dbpassword'];
        $config['dbschema'] = $parse_ini['mysql']['dbschema'];
        $config['dbprefix'] = $parse_ini['mysql']['dbprefix'];
        $driver = $parse_ini['dbdriver']['dbdriver'];
        require_once 'class.'.$driver.'.php';
            
        if (!isset($obj)) {
            $obj = &new $driver($config);
        }
        return $obj;
    }
}

?>
