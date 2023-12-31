<?php

namespace App\Controller;
require_once "../delivery/app/Token.php";

use App\Model\MysqlModel;
use App\Model\RolModel;
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

    $response->getBody()->write(json_encode($user), JSON_PRETTY_PRINT);

    return $response->withStatus(200);
  }

  public function register(Request $request, Response $response, $args)
  {
    $data = (array)$request->getParsedBody();

    $id = UserModel::create($data);

    if ($id == 0) {

      $response->getBody()->write(strval($id));

      return $response->withStatus(401);

    } else {

      RolModel::create($id);

      $response->getBody()->write(strval($id));

      return $response->withStatus(201);
    } 

    $response->getBody()->write(strval($id));

    return $response;
  }

  public function login(Request $request, Response $response, $args)
  {
    $data = (array)$request->getParsedBody();

    $datos = UserModel::getByEmail($data['email']);

    if (count($datos) > 0) {

      if (MysqlModel::verifica_password($data['password'], $datos[0]['password'])) {
    $datos[0]['roles']=[];
       
    $datos[0]['roles']['id']=$datos[0]['rid'];
    $datos[0]['roles']['name']=$datos[0]['rname'];
    $datos[0]['roles']['image']=$datos[0]['rimage'];
    $datos[0]['roles']['route']=$datos[0]['route'];
    
    unset($datos[0]['rid']);
    unset($datos[0]['rname']);
    unset($datos[0]['rimage']);
    unset($datos[0]['route']);

        $datos[0]['session_token']=Token::tokenizar($datos[0]);
        

        $response->getBody()->write(json_encode($datos[0]));

        return $response->withStatus(200);

      } else {

        
        $response->getBody()->write("La contraseña és incorrecta");

        return $response->withStatus(401);
      }

    }else{

      $response->getBody()->write("El usuario no existe.");

      return $response->withStatus(401);
    }

  }



}
