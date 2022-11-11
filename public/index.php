<?php

include_once '../vendor/autoload.php';

use \Christiancannata\PhpApi\System\Request;
use \Christiancannata\PhpApi\System\Router;

$request = new Request();

$router = new Router();
$router->handle($request);
