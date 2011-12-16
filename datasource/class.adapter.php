<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

class Db {

    final public function &getInstance() {

        static $obj;
        $config = array();
        $parse_ini = parse_ini_file('config.ini', TRUE);
        $config['dbhost'] = $parse_ini['mysql']['dbhost'];
        $config['dbuser'] = $parse_ini['mysql']['dbuser'];
        $config['dbpassword'] = $parse_ini['mysql']['dbpassword'];
        $config['dbschema'] = $parse_ini['mysql']['dbschema'];
        $config['dbprefix'] = $parse_ini['mysql']['dbprefix'];
        $driver = $parse_ini['dbdriver']['dbdriver'];

        require_once SERVER_ROOT.'datasource'.DS.'class.' . $driver . '.php';

        if (!isset($obj)) {
            $obj = new $driver($config);
        }
        return $obj;
    }

}

?>
