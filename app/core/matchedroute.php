<?php

namespace App\Core;

class MatchedRoute
{
    protected $url;
    protected $controller;
    protected $action;
    protected $parameters;
    protected $methods;

    public function __construct($url, $controller, $action, $parameters = [], $methods = [])
    {
        $this->url = $url;
        $this->controller = $controller;
        $this->action = $action;
        $this->parameters = $parameters;
        $this->methods = $methods;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getMethods()
    {
        return $this->methods;
    }
}
