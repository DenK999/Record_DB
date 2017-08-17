<?php

namespace Solveo;

abstract class Model {

    /**
     * @var Db 
     */
    protected $db;

    /**
     * construct to Base Model
     */
    function __construct() {

        $this->db = new Db();
    } 
}
