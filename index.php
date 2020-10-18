<?php

use Firebase\JWT\JWT;
require "vendor/autoload.php";
require 'App.php';
$app = new App();

$method = false;

if (key_exists("method", $_GET)) {
    $method = $_GET["method"];
}

if (key_exists("page", $_GET)) {
    $page = ucfirst($_GET["page"]);
   
    require $page.".php";
    $class = new $page();

    $token = "";
    if (key_exists("token", $_COOKIE)) {
       $token = $_COOKIE["token"];
       $decoded = JWT::decode($token, "demo", array('HS256'));
       if ($decoded->exp > time()) {
        var_dump($decoded);
       }
    }

    require 'routerUser.php';
    
} else {
    $app->sendData("Erreur de choix de table");
}
