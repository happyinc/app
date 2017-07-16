<?php
require_once'../../externo/plugins/PDOModel.php';
require'sessions.php';

$objSe = new Sessions();
$objSe->init();

$ultima_sesion = isset($_SESSION['sesion_activa']) ? $_SESSION['sesion_activa'] : null ;

$objConn = new PDOModel();
$updateSe["f_logout"] = date("Y-m-d H:i:s");
$objConn->where("id", $ultima_sesion);
$objConn->update("sesion", $updateSe);

$objSe->destroy();



header('Location: ../src/logueo.html');

?>