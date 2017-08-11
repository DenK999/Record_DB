<?php

namespace Solveo;

class Controller {

    public $model;
    public $view;

    function __construct() {
        $this->view = new View();
        $this->model = new Model();
    }

    public function indexAction() {
        
    }

}
