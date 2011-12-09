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

class mysqlid {

    private $dbhost;
    private $dbuser;
    private $dbpassword;
    private $dbschema;
    private $dbprefix;
    private $connection;
    private $queries_count;
    private $result;

    /**
     * Enter description here ...
     * @var unknown_type
     */
    private $config;

    /**
     * Is there any locked tables right now?
     * @var boolean
     */
    private $is_locked = false;

    public function __construct() {

        $this->config = parse_ini_file('config.ini', 1);
        $this->dbhost = $this->config['mysql']['dbhost'];
        $this->dbuser = $this->config['mysql']['dbuser'];
        $this->dbpassword = $this->config['mysql']['dbpassword'];
        $this->dbschema = $this->config['mysql']['dbschema'];
        $this->dbprefix = $this->config['mysql']['dbprefix'];
        $this->open_connection();
    }

    /**
     * Enter description here ...
     */
    private function open_connection() {
        try {
            $this->connection = mysqli_connect($this->dbhost, $this->dbuser, $this->
                    dbpassword, $this->dbschema);
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
            mysqli_close($this->connection);
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
            $this->result = mysqli_query($this->connection, $query);
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
    public function fetchArray($query) {
        $row = mysqli_fetch_assoc($query);
        return $row;
    }

    /**
     * Fetch a result row as an object
     * @param  string  The query which we send.
     * @return array
     */
    function fetchObject($query) {
        return mysqli_fetch_object();
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function count_rows($query) {
        $row = mysqli_num_rows($query);
        return $row;
    }

    /**
     * Enter description here ...
     * @return unknown
     */
    public function rows_affected() {
        $row = mysqli_affected_rows($this->connection);
        return $row;
    }

    /**
     * Enter description here ...
     * @return unknown
     */
    public function created_id() {
        $row = mysqli_insert_id($this->connection);
        return $row;
    }

    /**
     * Enter description here ...
     */
    public function commit_start() {
        mysqli_autocommit($this->connection, FALSE);
    }

    /**
     * Enter description here ...
     */
    public function commit() {
        mysqli_commit($this->connection);
    }

    /**
     * Enter description here ...
     */
    public function rollback() {
        $this->connection->rollback();
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
        mysqli_free_result($this->result);
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

        $str = $string;

        if ($full_escape)
            $string = str_replace(array('%', '_'), array('\%', '\_'), $string);

        if (function_exists('mysqli_real_escape_string')) {
            $str = mysqli_real_escape_string($this->connection, $string);
        } else {
            $str = mysqli_escape_string($string);
        }

        return $str;
    }
}

?>