<?php

use App\Application;
use App\Http\Request;

require __DIR__ . '/../bootstrap/bootstrap.php';

$router = require __DIR__ . '/../routes/routes.php';

$app = new Application($router);

$request = new Request;
$app->handleRequest($request);
