<?php
require_once "app/Router.php";
session_start();
$router = new Router();
$router->routeRequest();
