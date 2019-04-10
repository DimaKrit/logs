<?php

namespace App\Http;

class Router implements RouterInterface
{
    protected $routes = [];

    public function add(string $method, string $path, string $controller, string $action)
    {
        $method = strtoupper($method);

        $this->routes[$method][$path] = new Route($controller, $action);
    }

    public function resolve(RequestInterface $request) : RouteInterface
    {
        $method = $request->getMethod();
        $path = $request->getPath();

        if (!isset($this->routes[$method][$path])) {
            throw new \Exception('Route not found');
        }

        return $this->routes[$method][$path];
    }
}
