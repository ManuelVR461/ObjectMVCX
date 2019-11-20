<?php
require_once './core/Autoload.php';
$autoload = new Autoload;

$route = (isset($_GET['url']))?$_GET['url']:'home';
$router = new Router($route);