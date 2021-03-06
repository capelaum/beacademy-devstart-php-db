<?php

ini_set('display_errors', 1);

include __DIR__  . "/vendor/autoload.php";

use App\Controller\ErrorController;

$url = explode('?', $_SERVER['REQUEST_URI'])[0];
$routes = getRoutes();

if (!isset($routes[$url])) {
  (new ErrorController())->notFoundAction();
  exit;
}

$controllerName = $routes[$url]['controller'];
$actionName = $routes[$url]['action'];

(new $controllerName())->$actionName();
