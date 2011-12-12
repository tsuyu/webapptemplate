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

class pdod {

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
            $this->connection = new PDO("mysql:host=" . $this->dbhost . ";dbname=" . $this->dbschema . "", $this->dbuser, $this->dbpassword);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     */
    public function close() {
        try {
            $this->connection = NULL;
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
            $this->result = $this->connection->query($query);
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
    public function fetchAssoc($result) {
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function fetchArray($result) {
        return $result->fetch(PDO::FETCH_NUM);
    }

    /**
     * Fetch a result row as an object
     * @param  string  The query which we send.
     * @return array
     */
    public function fetchObject($result) {
       return $result->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function countRows($result) {
        return count($result->fetchAll());
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
        $this->connection->beginTransaction();
    }

    /**
     * Enter description here ...
     */
    public function commit() {
        $this->connection->commit();
    }

    /**
     * Enter description here ...
     */
    public function rollback() {
        $this->connection->rollBack();
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return Ambigous <multitype:, unknown>
     */
    public function arrayData($query) {
       
    }

    /**
     * Returns the total number of executed queries. Usually goes to the end of scripts.
     * @return integer
     */
    public function num_queries() {
        return $this->queries_count;
    }

    public function free_result() {
       
    }

    /**
     * Lock database table(s)
     * @param unknown_type $tables
     */
    public function lock_tables($tables) {
        
    }

    /**
     * Unlock database table(s)
     * @param unknown_type $tables
     */
    public function unlock_tables() {
        
    }

    /**
     * Escapes a value to make it safe for using in queries.
     * @param  string  String to be escaped
     * @param  bool    If escaping of % and _ is also needed
     * @return string
     */
    public function string_escape($string, $full_escape=false) {
        return trim($string);
    }

}

?>