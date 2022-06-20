<?php

use App\Controller\IndexController;
use App\Controller\ProductController;
use App\Controller\CategoryController;

/**
 * ##################
 * ###   ROUTES   ###
 * ##################
 */

function createRoute(string $controllerName, string $actionName)
{
  return [
    'controller' => $controllerName,
    'action' => $actionName
  ];
}

function getRoutes()
{
  return [
    BASE_URL . "/" => createRoute(IndexController::class, 'indexAction'),
    BASE_URL . "/login" => createRoute(IndexController::class, 'loginAction'),
    BASE_URL . "/products" => createRoute(ProductController::class, 'listAction'),
    BASE_URL . "/products/add" => createRoute(ProductController::class, 'addAction'),
    BASE_URL . "/products/edit" => createRoute(ProductController::class, 'editAction'),
    BASE_URL . "/categories" => createRoute(CategoryController::class, 'listAction'),
    BASE_URL . "/categories/add" => createRoute(CategoryController::class, 'addAction'),
    BASE_URL . "/categories/edit" => createRoute(CategoryController::class, 'editAction'),
  ];
}

/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * @param string $path
 * @return string
 */
function url(string $path = null): string
{
  if ($path) {
    return BASE_URL . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
  }

  return BASE_URL;
}

/**
 * @return string
 */
function url_back(): string
{
  return ($_SERVER['HTTP_REFERER'] ?? url());
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
  header("HTTP/1.1 302 Redirect");
  if (filter_var($url, FILTER_VALIDATE_URL)) {
    header("Location: {$url}");
    exit;
  }

  if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
    $location = url($url);
    header("Location: {$location}");
    exit;
  }
}

/**
 * ################
 * ###   DATE   ###
 * ################
 */

/**
 * @param string $date
 * @param string $format
 * @return string
 */
function date_fmt(?string $date, string $format = "d/m/Y H\hi"): string
{
  $date = empty($date) ? "now" : $date;
  return (new DateTime($date))->format($format);
}

/**
 * @param string $date
 * @return string
 */
function date_fmt_br(?string $date): string
{
  $date = empty($date) ? "now" : $date;
  return (new DateTime($date))->format(DATE_BR);
}

/**
 * @param string $date
 * @return string
 */
function date_fmt_app(?string $date): string
{
  $date = empty($date) ? "now" : $date;
  return (new DateTime($date))->format(DATE_APP);
}

/**
 * @param string|null $date
 * @return string|null
 */
function date_fmt_back(?string $date): ?string
{
  if (!$date) {
    return null;
  }

  if (strpos($date, " ")) {
    $date = explode(" ", $date);
    return implode("-", array_reverse(explode("/", $date[0]))) . " " . $date[1];
  }

  return implode("-", array_reverse(explode("/", $date)));
}
