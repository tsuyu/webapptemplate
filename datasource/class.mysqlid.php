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
 * 
 *      @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

class mysqlid {

    /**
     * 	Connection link.
     * 	@var string
     */
    private $connection;

    /**
     * 	Total query
     * 	@var string
     */
    private $queries_count;

    /**
     * 	Result of query
     * 	@var string
     */
    private $result;

    /**
     * The Constructor. Initializes a database connection and selects database.
     * @param  array  config
     */
    public function __construct($config) {
        try {
            $this->connection = mysqli_connect($config['dbhost'], $config['dbuser'], $config['dbpassword'], $config['dbschema']);
        } catch (exception $e) {
            throw $e;
        }
    }

    /**
     * Closes the MySQL connection.
     * @param  none
     * @return boolean
     */
    public function close() {
        try {
            mysqli_close($this->connection);
        } catch (exception $e) {
            throw $e;
        }
    }

    /**
     * Send a MySQL query.
     * @param  string  Query to run
     * @return mixed
     */
    public function query($query, $verbose = FALSE) {
        try {
            if ($verbose) {
                echo $query;
            }
            $this->result = mysqli_query($this->connection, Util::injection($query));
            if ($this->result) {
                $this->queries_count++;
                return $this->result;
            } else {
                return FALSE;
            }
        } catch (exception $e) {
            throw $e;
        }
    }

    /**
     * Fetch a result row as an associative array.
     * @return array
     */
    public function fetchAssoc() {
        return mysqli_fetch_assoc($this->result);
    }

    /**
     * Fetch a result row as a numeric array.
     * @return array
     */
    public function fetchArray() {
        return mysqli_fetch_array($this->result, MYSQLI_NUM);
    }

    /**
     * Fetch a result row as an object
     * @return array
     */
    public function fetchObject() {
        return mysqli_fetch_object($this->result);
    }
    
    /**
     * Fetch a result row as an associative array.
     * @return array
     */
    public function fetchAll() {
        $rows = array();

        while ($row = $this->fetchAssoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * Returns the number of rows from the executed query.
     * @return integer
     */
    public function countRows() {
        return mysqli_num_rows($this->result);
    }

    /**
     * Returns the last unique ID (auto_increment field) from the last inserted row.
     * @return  integer
     */
    public function createdId() {
        return (int) mysqli_insert_id();
    }

    /**
     * Enter description here ...
     */
    public function commitStart() {
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
     * Returns the total number of executed queries. Usually goes to the end of scripts.
     * @return integer
     */
    public function numQueries() {
        return $this->queries_count;
    }

    /**
     * Retuns the number of rows affected by last used query.
     * @return integer
     */
    public function rowsAffected() {
        return (int) mysqli_affected_rows($this->connection);
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
        } elseif (get_magic_quotes_gpc()) {
            $string = stripslashes($string);
        } elseif (function_exists('mysqli_real_escape_string')) {
            return trim(mysqli_real_escape_string($this->connection, $string));
        }
    }

}

?>