<?php

require __DIR__ . '/../vendor/autoload.php';

use app\Connection;

Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

$dbConnection = (new Connection())->getConnection();