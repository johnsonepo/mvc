<?php

namespace App;
use App\Core\MatchedRoute;
use App\Core\Router;

class App
{
    private function handleException(\Exception $e)
    {
        error_log($e->getMessage(), 0);
        echo 'An error occurred: ' . $e->getMessage();
    }
    public function run()
    {
        // Get request URI and method
        $uri = $_SERVER['REQUEST_URI'];
        $isLocalhost = (
            strpos($_SERVER['SERVER_NAME'], 'localhost') !== false ||
            $_SERVER['SERVER_NAME'] === '127.0.0.1'
        );
        
        // Modify URI only if it's localhost and starts with "/mvc/"
        if ($isLocalhost && strpos($uri, '/mvc/') === 0) {
            $uri = str_replace('/mvc', '', $uri);
        }
        
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        
        // Match route
        $route = Router::match($uri, $requestMethod);
        
        
        // Default to HomeController for root path
        if ($route === null && ($uri === '/' || $uri === '' || $uri === 'home')) {
            $route = new MatchedRoute('/', 'app\controllers\homecontroller', 'index');
        }
        if ($route == null){
            print "No route found for URI: $uri" . PHP_EOL;
            die();
        }
    
        // Ensure route found
        try {
            $this->executeRoute($route);
        } catch (\Exception $e) { 
            $this->handleException($e);
        }
    }

    private function executeRoute(MatchedRoute $route)
    {
        echo "<pre>";
        print_r($route);

        echo $controllerName = 'homecontroller'; //$route->getController();
        $actionName = $route->getAction();
        $parameters = $route->getParameters();
        
        try {
            $controller = new $controllerName;
            $controller->$actionName($parameters);
        } catch (\Exception $e) {
            // Handle exception
            echo $e->getMessage();
        }
    }
}
