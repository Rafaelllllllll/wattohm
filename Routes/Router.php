<?php

namespace Router;
// la classe Router permet de selectionner la bonne route en fonction de la route voulu
class Router {

    public $url;
    public $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route ($path, $action);
    }

    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                return $route->execute();
            }
        }

        return header('http/1.0 404 Not Found');
    }
}