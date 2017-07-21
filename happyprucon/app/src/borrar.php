<?php
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
$objSe->init();

$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;

$carpetaAdjunta = "usuarios/$usu_id/sitio/";

if($_SERVER['REQUEST_METHOD']=="DELETE"){

    parse_str(file_get_contents("php://input"),$datosDELETE);

    $key = $datosDELETE['key'];

    unlink($carpetaAdjunta.$key);

    echo 0;

}

?>