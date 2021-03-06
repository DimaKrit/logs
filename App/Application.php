<?php

namespace App;

use App\Http\RequestInterface;
use App\Http\RouteInterface;
use App\Http\RouterInterface;
use App\Logs\FileLogger;
use App\Views\ViewInterface;

class Application
{
    /**
     * @var RouterInterface
     */
    protected $router;
	protected $logger;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
		$this->logger = new FileLogger();
    }

    public function handleRequest(RequestInterface $request)
    {
        $route = $this->router->resolve($request);
        $controller = $this->resolveControllerClass($route);
        $action = $this->resolveControllerAction($route, $controller);

        $result = $this->runControllerAction($controller, $action, $request);
        $this->render($result);
    }

    protected function resolveControllerClass(RouteInterface $route)
    {
        $class = $route->getClass();

        if (!class_exists($class)) {
			$this->logger->log(FileLogger::ERROR, 'Controller ' . $class . ' does not exists');
            throw new \Exception('Controller class does not exists');
        }

        return new $class;
    }

    protected function resolveControllerAction(RouteInterface $route, $controller)
    {
        $action = $route->getAction();

        if (!method_exists($controller, $action)) {
			$this->logger->log(FileLogger::ERROR, $action . ' does not exists');
            throw new \Exception('Action does not exists');
        }

        return $action;
    }

    protected function runControllerAction($controller, $action, RequestInterface $request)
    {
        $params = $request->getQueryParams();
        $postData = $request->getPostData();

        return $controller->$action($params, $postData);
    }

    protected function render($result)
    {
        if ($result instanceof ViewInterface) {
            $result->render();
        } elseif (is_string($result)) {
            echo $result;
        } else {
			$this->logger->log(FileLogger::ERROR, 'Unsuported type');
            throw new \Exception('Unsuported type');
        }
    }
}
