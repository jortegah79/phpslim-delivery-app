<?php 

/**
 * Funcion para encriptar
 */
function encriptar($pass){

    return password_hash($pass,PASSWORD_BCRYPT,["cost"=>20]);

}
