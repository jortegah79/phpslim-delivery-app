<?php

use App\Controller\UserController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function(App $app){

   
    //usuarios
    $app->group('/api/users', function(RouteCollectorProxy $group){
       
        $group->get('/all',UserController::class.':getAll'); 
        $group->post('/register',UserController::class.':register'); 
    });  



};
