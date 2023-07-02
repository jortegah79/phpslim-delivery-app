<?php

namespace App\Model;


use App\Model\MysqlModel;

class RolModel extends MysqlModel
{

    static $tabla = "users";

    /**
     * Pasamos por defecto el valor 1 que es el rol de cliente
     */
    public static function create($id_user,$id_rol=1){

    $sql="insert into  user_has_roles(id_user,id_rol,created_at,updated_at) values('".$id_user."','".$id_rol."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";

    static::executeQuery($sql);
}



}
