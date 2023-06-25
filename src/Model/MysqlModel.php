<?php

namespace App\Model;

use mysqli;

require_once "config.php";

class MysqlModel
{

  static $tabla = "";

  public static function get_conection()
  {
    return new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
  }

  public static function executeGetQuery($query)
  {
    $data = [];
    $res = static::get_conection()->query($query);
    while ($r = $res->fetch_assoc()) {
      $data[] = $r;
    }
    return count($data) > 0 ? $data : [];
  }
  public static function executeQuery($query)
  {

    $conection = static::get_conection();

    $conection->query($query);
  }

  public static function getLast(String $order = "updated_at")
  {

    $sql = "select * from " . static::$tabla . " order by $order desc limit 1";

    return static::executeGetQuery($sql)[0];
  }

/**
 * Funcion para encriptar
 */
public static function encriptar($pass){

    return password_hash($pass,CRYPT_MD5);

}
public static function verifica_password($pass_login,$pass_bbdd){

  return password_verify($pass_login,$pass_bbdd);

}


}
