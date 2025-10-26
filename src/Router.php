<?php

namespace App;

class Router
{
    private $routes = [];
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove trailing slash except for root
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }

        if (isset($this->routes[$method][$path])) {
            return call_user_func($this->routes[$method][$path], $this->twig);
        }

        // 404 - redirect to home
        header('Location: /');
        exit;
    }
}