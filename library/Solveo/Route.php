<?php

namespace Solveo;

class Route {

    static function start() {
        $controllerName = 'index';
        $actionName = 'index'; 

        $routes = explode('/', $_SERVER['REDIRECT_URL']);
        

        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        $controllerName = ucfirst($controllerName) . 'Controller';
        $actionName = $actionName . 'Action';
        $controllerFile = $controllerName . '.php';
        $controllerFilePath = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $controllerFile;

        if (file_exists($controllerFilePath)) {
            include $controllerFilePath;
        } else {
            header("HTTP/1.0 404 Not Found");
        }

        if (__NAMESPACE__ != "") {
            $controllerName = '\\' . __NAMESPACE__ . '\\' . $controllerName;
        }

        $controller = new $controllerName;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

}
