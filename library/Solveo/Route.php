<?php

namespace Solveo;

/**
 * class to route
 */
class Route {

    /**
     * function start to route
     */
    static function start() {
        $controllerName = 'index';
        $actionName = 'index';        

        if (!empty($_SERVER['REDIRECT_URL'])) {
            $routes = explode('/', $_SERVER['REDIRECT_URL']);
            if (!empty($routes[1])) {
                $controllerName = $routes[1];
            }
            if (!empty($routes[2])) {
                $actionName = $routes[2];
            }
        }

        $controllerName = "\\Solveo\\Controller\\".ucfirst($controllerName) . "Controller";
        $actionName = $actionName . 'Action';

        $controller = new $controllerName;
        $action = $actionName;
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
}
