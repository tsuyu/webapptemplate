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

    private $connection;
    private $queries_count;
    private $result;

    public function __construct($config) {
        try {
            $this->connection = new PDO("mysql:host=" . $config['dbhost'] . ";dbname=" . $config['dbschema'] . "", $config['dbuser'], $config['dbpassword']);
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
    public function query($query, $verbose = FALSE) {
        
        try {
            if ($verbose) {
                echo $query;
            }

            $this->result = $this->connection->query($this->injection($query));

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
        return $this->result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function fetchArray() {
        return $this->result->fetch(PDO::FETCH_NUM);
    }

    /**
     * Fetch a result row as an object
     * @param  string  The query which we send.
     * @return array
     */
    public function fetchObject() {
        return $this->result->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Enter description here ...
     * @param unknown_type $query
     * @return unknown
     */
    public function countRows() {
        return count($this->result->fetchAll());
    }

    /**
     * Not all database engines support this feature.
     * @return unknown
     */
    public function createdId() {
        return $this->result->lastInsertId();
    }

    /**
     * Enter description here ...
     */
    public function commitStart() {
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
        
        return trim($string);
    }

}

?>