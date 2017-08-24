<?php
/**
 * Created by PhpStorm.
 * User: DESARROLLO HAPPY INC
 * Date: 19/08/2017
 * Time: 9:48 AM
 */

include "connect.php";

$conexionHappy = AbrirConexionHappy();

function nombre_usuario($id_usuario)
{
    $sql = "select nombre_completo from usuarios where id = $id_usuario";
    $rs = mysql_query($sql);

    $nombre = mysql_fetch_array($rs);
    return $nombre["nombre_completo"];
}

function direccion_cliente($id_ubicacion_cliente)
{
    $sql = "select direccion from ubicaciones_cliente where id = $id_ubicacion_cliente";
    $rs = mysql_query($sql);

    $direccion = mysql_fetch_array($rs);
    return $direccion["direccion"];
}

function nombre_producto($id_producto)
{
    $sql = "select nombre from producto where id = $id_producto";
    $rs = mysql_query($sql);

    $nombre = mysql_fetch_array($rs);
    return $nombre["nombre"];
}

function nombre_estado($id_estado)
{
    $sql = "select descripcion from estado where id = $id_estado";
    $rs = mysql_query($sql);

    $nombre = mysql_fetch_array($rs);
    return $nombre["descripcion"];
}

function id_asociado_new($id_producto)
{
    $sql = "select id_usuario from producto where id = $id_producto";
    $rs = mysql_query($sql);

    $nombre = mysql_fetch_array($rs);
    return $nombre["id_usuario"];
}