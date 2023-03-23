<?php

use App\Router;

require __DIR__ . "/vendor/autoload.php";

header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

Router::route();
