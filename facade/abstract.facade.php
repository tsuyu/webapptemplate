<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

abstract class Facade {

    protected $instance;
    protected $classes;

    protected function init($mode = NULL) {
        if (is_null($mode)) {
            foreach ($this->classes as $class) {
                $invoke = strtolower($class);
                if (!isset($this->instance[$invoke]) && empty($this->instance[$invoke])) {
                    $this->instance[$invoke] = new $class();
                }
            }
        } else {
            $classes = explode(":", $mode);
            foreach ($classes as $class) {
                $invoke = strtolower($class);
                if (!isset($this->instance[$invoke]) && empty($this->instance[$invoke])) {
                    $this->instance[$invoke] = new $class();
                }
            }
        }
    }

}

?>
