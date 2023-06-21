<?php

namespace App\Controller;

use App\Model\UserModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class   UserController
{


        public function getAll(Request $request, Response $response, $args)
        {
                $data = UserModel::getAll();

                $response->getBody()->write(json_encode($data), JSON_PRETTY_PRINT);

                return $response->withStatus(200);
        }
        public function register(Request $request, Response $response, $args)
        {
                $data = (array)$request->getParsedBody();

                $id = UserModel::create($data);

                $response->getBody()->write(strval($id));

                return $response;
            
        }
}
