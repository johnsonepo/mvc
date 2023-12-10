<?php

namespace App\Core;

class Router
{
    protected static $routes = [];

    public static function get($path, $action)
    {
        $sp = explode('@', $action);
        $route = [
            'controller' => $sp[0],
            'method' => $sp[1],
            'path' => $path,
            'request' =>'GET'
        ];
        self::$routes[$sp[0]] = $route;
        
    }
    public static function post($path, $action)
    {
        $sp = explode('@', $action);
        self::$routes[$path] = [
            'controller' => $sp[0],
            'method' => $sp[1],
            'path' => $path,
            'request' =>'POST'
        ];
        
    }
  

    public static function match($url, $requestMethod)
    {
        // Split the URL into parts
        $urlParts = explode("/", $url);
        $url = rtrim($url, '/');

        // Check if the URL has a trailing slash after removing it
        if (substr($url, -1) === '/') {
            // Remove the remaining trailing slash
            $url = substr($url, 0, -1);
        }

        $route = self::getRoute($url);

        if (is_array($route)) {
            $route = (object)$route;
            return new MatchedRoute($url, $route->controller, $route->method, $route->parameters, $requestMethod);
        }

        // No matching route found
        return $route. ' route not found';
    }
    private static function getRoute($url){
        $route = [];
        $urlParts = explode('/', trim($url, '/'));
        if (strpos($url, "/admin") === 0) 
        {
            $requested_route = '/'.$urlParts[1];
            $fnd = null;

            foreach (self::$routes as $route) {
                if ($route['path'] === $requested_route) {
                    $fnd = $route;
                    break; 
                }
            }

            if(!$fnd)return $requested_route;

            $route['controller'] = "app\\controllers\\admin\\" . $urlParts[1] . "controller";
            $route['method'] = $fnd['method'];
            $route['parameters'] = array_slice($urlParts, 3);
            $route['url'] = $url;
            $route['request'] = $fnd['request'];

            return $route;
        } 
        else 
        {
            $requested_route = '/'.$urlParts[0];
            $fnd = null;

            foreach (self::$routes as $route) {
                if ($route['path'] === $requested_route) {
                    $fnd = $route;
                    break; 
                }
            }

            if(!$fnd)return $requested_route;

            $route['controller'] = "app\\controllers\\" . $urlParts[0] . "controller";
            $route['method'] = $fnd['method'];
            $route['parameters'] = array_slice($urlParts, 1);
            $route['url'] = $url;
            $route['request'] = $fnd['request'];


            return $route;
        }
    }

}
