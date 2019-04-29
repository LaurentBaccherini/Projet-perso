<?php

session_start();

var_dump($_SESSION);

$controllerName = "annonce";
$action = "homepage";

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

if(!empty($_GET['controller'])){
    $controllerName = $_GET['controller'];
}

// annonce => AnnonceController
$controllerClassName = ucfirst($controllerName) . 'Controller';

require_once('libraries/controllers/'.$controllerClassName.'.php');
$controller = new $controllerClassName();
$controller->$action();



?>