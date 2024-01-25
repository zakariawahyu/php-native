<?php

require "../app/Bootstrap.php";

use app\Controller\TransactionController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[1] !== 'transaction') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$referenceID = null;
if (isset($uri[2])) {
    $referenceID = (string) $uri[2];
}

$merchantID = null;
if (isset($uri[3])) {
    $merchantID = (string) $uri[3];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$controller = new TransactionController($dbConnection, $requestMethod, $referenceID, $merchantID, '');
$controller->routes();
