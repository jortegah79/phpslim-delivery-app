<?php

namespace App\Model;


use App\Model\MysqlModel;

class UserModel extends MysqlModel
{

    static $tabla = "users";

    public static function getAll()
    {

        $sql = "select * from ". static::$tabla;

        return static::executeGetQuery($sql);
    }

    public static function finById($id)
    {

        $sql = "select id,email,name,lastname,image,phone,password,session_token from ".static::$tabla ." where id='".$id."'";

        return static::executeGetQuery($sql);
    }

    public static function create($user)
    {
        $sql = "Select * from users where email='" . $user['email'] . "'";

        $data = static::executeGetQuery($sql);

        if (count($data) > 0) {

            return "0";
        } else {

            $pass = static::encriptar($user['password']);

            $sql = "insert into users(email,name,lastname,phone,password,created_at,updated_at) values('" . $user['email'] . "','" .
                $user['name'] . "','" . $user['lastname'] . "','" . $user['phone'] . "','" . $pass . "',
    '" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')";

            static::executeQuery($sql);

            $data = static::getLast();

            return $data['id'] > 0 ? $data['id'] : "0";
        }
    }
    public static function getByEmail($email)
    {

        $sql = "select * from ". static::$tabla . " where email='".$email."'";;

        return static::executeGetQuery($sql);
    }
    public static function login()
    {
        $sql = "select * from ". static::$tabla;

        return static::executeGetQuery($sql);
    }
}
