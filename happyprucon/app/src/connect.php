<?php
/**
 * Created by PhpStorm.
 * User: DESARROLLO HAPPY INC
 * Date: 19/08/2017
 * Time: 9:26 AM
 */

function AbrirConexionHappy()
{

    $conexion = mysql_connect("happyhappyinc.com","bd_happy", "bd_happy2017*");
    mysql_select_db("bd_happy", $conexion);
    return $conexion;
}