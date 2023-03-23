<?php

namespace App;
class Router
{
    public static function route()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        require_once('routes.php');

        if (!isset($routes[$requestMethod])) {
            throw new \Exception();
        }

        $route = self::getRoute($routes[$requestMethod]);
        $output = self::runAction($route);
        echo json_encode($output);
    }

    /**
     * @param $routes
     * @return array
     * @throws \Exception
     */
    private static function getRoute($routes)
    {
        $request = $_SERVER['REQUEST_URI'];

        $route = null;
        foreach ($routes as $pattern => $handler) {
            if (preg_match("#^{$pattern}$#", $request, $matches)) {
                array_shift($matches);
                $route = [
                    'handler' => $handler,
                    'args' => $matches
                ];
                break;
            }
        }
        if (is_null($route)) {
            throw new \Exception();
        }
        return $route;
    }

    private static function runAction($route)
    {
        $controllerName = $route['handler']['controller'];
        $actionName = $route['handler']['action'];
        $controller = new $controllerName;

        if (!empty($route['args'])) {
            return $controller->$actionName(...$route['args']);
        }
        return $controller->$actionName();
    }
}
