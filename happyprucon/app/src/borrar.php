<?php
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
$objSe->init();

$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;

$carpetaAdjunta = "usuarios/$usu_id/sitio/";

if($_GET["d"] != "")
{
    unlink($carpetaAdjunta.$_GET["d"]);

    echo 0;
}




?>