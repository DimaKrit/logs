<?php

use App\Controllers\FormController;
use App\Controllers\IndexController;
use App\Controllers\ApiController;
use App\Http\Router;

$router = new Router();

$router->add('get', '/', IndexController::class, 'index');
$router->add('get', '/forms', FormController::class, 'index');
$router->add('get', '/forms/view', FormController::class, 'view');
$router->add('post', '/forms/create', FormController::class, 'create');
$router->add('get', '/forms/delete', FormController::class, 'delete');

$router->add('get', '/api/forms', ApiController::class, 'index');
$router->add('post', '/api/forms', ApiController::class, 'create');
$router->add('post', '/api/forms/delete', ApiController::class, 'delete');
$router->add('post', '/api/forms/update', ApiController::class, 'update');


return $router;
