<?php

use Firebase\JWT\Key;
use Firebase\JWT\JWT;
require_once "keys.php";

class Token
{
    public static function tokenizar($user)
    {
        $key = SECRET_OR_KEY;
        $payload = [
            'id' => $user['id'],
            'email' => $user['email'],
            'exp' => strtotime(date('Y-m-d H:i:s')) + (60 * 60)
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }

    public static function destokenizar($jwt)
    {
        $key = SECRET_OR_KEY;

        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        
        return $decoded;

       // $decoded_array = (array) $decoded;

    }
}
