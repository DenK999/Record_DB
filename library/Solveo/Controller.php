<?php

namespace Solveo;

class Controller {


    /**
     *
     * @var object Viev 
     */
    public $view;

    /**
     * construct to controller
     */
    function __construct() {
        $this->view = new View();
    }
}
