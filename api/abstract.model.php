<?php

include '../datasource/class.adapter.php';

abstract class Model {

    protected $db;

    public function __construct() {
        $this->db = Db::getInstance();
    }
}

?>
