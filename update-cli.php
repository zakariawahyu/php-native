<?php
require "./app/Bootstrap.php";

use app\Controller\TransactionController;

$id = array_slice($argv, 1)[0];
$status = array_slice($argv, 1)[1];

$controller = new TransactionController($dbConnection, "PUT", $id, '', $status);
$controller->routes();

