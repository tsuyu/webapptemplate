<?php

/*
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

class mysqld {

    private $dbhost;
    private $dbuser;
    private $dbpassword;
    private $dbschema;
    private $dbprefix;
    private $connection;
    private $queries_count;
    private $result;

    /**
     * Is there any locked tables right now?
     * @var boolean
     */
    private $is_locked = false;

    public function __construct($config) {
        $this->dbhost = $config['dbhost'];
        $this->dbuser = $config['dbuser'];
        $this->dbpassword = $config['dbpassword'];
        $this->dbschema = $config['dbschema'];
        $this->dbprefix = $config['dbprefix'];
        $this->open_connection();
    }

    /**
     * Enter description here ...
     */
    private function open_connection() {
        try {
            $this->connection = mysql_connect($this->dbhost, $this->dbuser, $this->
                    dbpassword);
            mysql_select_db($this->dbschema);
        } catch (exception $e) {
            throw $e;
        }
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     */
    public function close() {
        try {
            mysql_close($this->connection);
        } catch (exception $e) {
            throw $e;
        }
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function query($query) {
        try {
            $this->result = mysql_query($query, $this->connection);
            if ($this->result) {
                $this->queries_count++;
                return $this->result;
            }
        } catch (exception $e) {
            throw $e;
        }
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function fetchAssoc() {
        return mysql_fetch_assoc($this->result);
    }
    
     /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function fetchArray() {
        return mysql_fetch_array($this->result,MYSQL_NUM);
    }

    /**
     * Fetch a result row as an object
     * @param  string  The query which we send.
     * @return array
     */
    public function fetchObject() {
        return mysql_fetch_object($this->result);
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function countRows() {
        return mysql_num_rows($this->result);
    }

    /**
     * Enter description here ...
     * @return unknown
     */
    public function rows_affected() {
        
    }

    /**
     * Enter description here ...
     * @return unknown
     */
    public function created_id() {
        
    }

    /**
     * Enter description here ...
     */
    public function commit_start() {
        mysql_query("SET autocommit=0", $this->connection);
    }

    /**
     * Enter description here ...
     */
    public function commit() {
        mysql_query("SET autocommit=1", $this->connection);
    }

    /**
     * Enter description here ...
     */
    public function rollback() {
        mysql_query("ROLLBACK", $this->connection);
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return Ambigous <multitype:, unknown>
     */
    public function arrayData($query) {
        $data = array();
        $this->result = $this->query($query);
        while ($row = $this->fetchArray($this->result)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Returns the total number of executed queries. Usually goes to the end of scripts.
     * @return integer
     */
    public function num_queries() {
        return $this->queries_count;
    }

    public function free_result() {
        mysql_free_result($this->result);
    }

    /**
     * Lock database table(s)
     * @param unknown_type $tables
     */
    public function lock_tables($tables) {
        if (is_array($tables) && count($tables) > 0) {
            $mysql = '';

            foreach ($tables as $name => $type) {
                $mysql.=(!empty($mysql) ? ', ' : '') . '' . $name . ' ' . $type . '';
            }

            $this->rq('LOCK TABLES ' . $mysql . '');
            $this->is_locked = true;
        }
    }

    /**
     * Unlock database table(s)
     * @param unknown_type $tables
     */
    public function unlock_tables() {
        if ($this->is_locked) {
            $this->rq('UNLOCK TABLES');
            $this->is_locked = false;
        }
    }

    /**
     * Escapes a value to make it safe for using in queries.
     * @param  string  String to be escaped
     * @param  bool    If escaping of % and _ is also needed
     * @return string
     */
    public function string_escape($string, $full_escape=false) {

        if ($full_escape)
            $string = str_replace(array('%', '_'), array('\%', '\_'), $string);

        if (function_exists('mysqli_real_escape_string')) {
            return mysql_real_escape_string($string, $this->connection);
        } else {
            return mysql_escape_string($string);
        }
    }

}
?>

