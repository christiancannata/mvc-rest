<?php

namespace Christiancannata\PhpApi\System;

class Router
{
    public $routes;

    public function __construct()
    {
        $this->routes = include $_SERVER['DOCUMENT_ROOT'] . '/../config/routes.php';
    }


    public function handle(Request $request)
    {

        /*
         * Logica per smistare la richiesta ricevuta in input all'interno di un controller
         *
         *
         */

        $controllerName = null;
        $methodName = null;
        $param = null;

        foreach ($this->routes as $route) {
            if ($route['method'] == $request->getMethod() && $route['uri'] == $request->getUri()) {
                $controllerName = $route['controller'];
                $methodName = $route['action'];
            }
        }

        if (!$controllerName && !$methodName) {

            $uri = $request->getUri();
            $uri = explode("/", $uri);

            if (count($uri) == 4) {
                $param = $uri[count($uri) - 1];
                $uri[count($uri) - 1] = '{id}';
            }

            $uri = implode("/", $uri);

            foreach ($this->routes as $route) {
                if ($route['method'] == $request->getMethod() && $route['uri'] == $uri) {
                    $controllerName = $route['controller'];
                    $methodName = $route['action'];
                }
            }

        }

        if ($controllerName && $methodName) {
            $controller = new $controllerName();
            $controller->$methodName($request, $param);
        }


    }

    public function getRoutes()
    {
        return $this->routes;
    }

}