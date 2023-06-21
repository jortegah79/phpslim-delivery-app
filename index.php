<?php

require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->setBasePath('/delivery');

$middlewares=require("./app/Middlewares.php");
$middlewares($app);

$routes=require("./app/Routes.php");
$routes($app);



$app->run();

