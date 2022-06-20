<?php

ini_set('display_errors', 1);

include __DIR__  . "/vendor/autoload.php";

include 'src/View/shared/head.php';
include 'src/View/shared/menu.php';

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

include 'src/View/shared/footer.php';
