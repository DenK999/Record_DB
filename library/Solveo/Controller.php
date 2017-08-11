<?php

namespace Solveo;

class Controller {

    /**
     *
     * @var object Model 
     */
    public $model;

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
        $this->model = new Model();
    }

    /**
     * function indexAction to Base Controller
     */
    public function indexAction() {
        
    }

}
