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

    private $connection;
    private $queries_count;
    private $result;

    public function __construct($config) {
        try {
            $this->connection = mysql_connect($config['dbhost'], $config['dbuser'], $config['dbpassword']);
            mysql_select_db($config['dbschema']);
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
    public function query($query, $verbose = FALSE) {
        try {
            if ($verbose) {
                echo $query;
            }
            
            $this->result = mysql_query($this->injection($query), $this->connection);
            
            if ($this->result) {
                $this->queries_count++;
                return $this->result;
            }else{
                return $this->result;
            }
        } catch (exception $e) {
            throw $e;
        }
    }

    public function injection($query) {
        $array_injection = array("#", "--", "\\", "//", ";", "/*", "*/", "drop", "truncate");
        return trim(str_replace($array_injection, "", strtolower($query)));
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
        return mysql_fetch_array($this->result, MYSQL_NUM);
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
    public function createdId() {
        mysql_insert_id();
    }

    /**
     * Enter description here ...
     */
    public function commitStart() {
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
     * Returns the total number of executed queries. Usually goes to the end of scripts.
     * @return integer
     */
    public function numQueries() {
        return $this->queries_count;
    }

    /**
     * Escapes a value to make it safe for using in queries.
     * @param  string  String to be escaped
     * @param  bool    If escaping of % and _ is also needed
     * @return string
     */
    public function sanitize($string, $full_escape=false) {

        if ($full_escape) {
            $string = str_replace(array('%', '_'), array('\%', '\_'), $string);
        }

        if (get_magic_quotes_gpc()) {
            $string = stripslashes($string);
        }

        if (function_exists('mysql_real_escape_string')) {
            return trim(mysql_real_escape_string($string, $this->connection));
        }
    }

}
?>

