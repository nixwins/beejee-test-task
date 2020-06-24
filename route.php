<?php

use Core\Router;

$router = new Router();

$router->routeMap('GET', '/', ["controller" => "HomeController", "action" => "index"]);
$router->routeMap('GET', '/page/[:page]', ["controller" => "HomeController", "action" => "page"]);


$router->routeMap('POST', '/task/create', ["controller" => "TaskController", "action" => "create"]);
$router->routeMap('GET', '/tasks/filter', ["controller" => "TaskController", "action" => "filter"]);
$router->routeMap('POST', '/task/update/status', ["controller" => "TaskController", "action" => "updateStatus"]);
$router->routeMap('POST', '/task/edit', ["controller" => "TaskController", "action" => "editTask"]);
$router->routeMap('GET', '/task/edit/show/[:id]', ["controller" => "TaskController", "action" => "showTaskEditForm"]);

$router->routeMap('POST', '/user/login', ["controller" => "UserController", "action" => "login"]);
$router->routeMap('GET', '/user/profile', ["controller" => "UserController", "action" => "showProfile"]);
//$router->routeMap('GET', '/user/profile/page/[:page]', ["controller" => "UserController", "action" => "adminPage"]);
$router->routeMap('GET', '/user/logout', ["controller" => "UserController", "action" => "logout"]);


$router->dispatch();
