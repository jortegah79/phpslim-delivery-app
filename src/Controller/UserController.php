<?php

namespace App\Controller;
require_once "../delivery/app/Token.php";

use App\Model\MysqlModel;
use App\Model\UserModel;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Token;

class   UserController
{

  public function getAll(Request $request, Response $response, $args)
  {
    $data = UserModel::getAll();

    $response->getBody()->write(json_encode($data), JSON_PRETTY_PRINT);

    return $response->withStatus(200);
  }

  public function findById(Request $request, Response $response, $args)
  {
    $data = (array)$request->getParsedBody();

    $data = $args;

    $user = UserModel::finById($data['id']);

               $id = UserModel::create($data);
                     
                $response->getBody()->write(strval($id));

                return $response->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'POST');
                              
        }
}
