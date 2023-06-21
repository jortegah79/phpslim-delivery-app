<?php

namespace App\Model;

require_once("./app/funciones.php");
use App\Model\MysqlModel;

class UserModel extends MysqlModel
{

    static $tabla = "users";

    public static function getAll()
    {

        $sql = "select * from users";

        return static::executeGetQuery($sql);
    }
    public static function create($user)
    {
        $sql="Select * from ".static::$tabla." where email='".$user['email']."'";

        $data=static::executeGetQuery($sql);

        if(count($data)==0){
            
        $sql = "insert into users(email,name,lastname,phone,password,created_at,updated_at) values('" . $user['email'] . "','" .
            $user['name'] . "','" . $user['lastname'] . "','" . $user['phone'] . "','" . encriptar($user['password']) . "',
    '" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')";

        static::executeQuery($sql);

        $data = static::getLast();

        return $data['email'] == $user['email'] ? $data['id'] : 0;

        }else{
            return 0;
        }
    }
}
