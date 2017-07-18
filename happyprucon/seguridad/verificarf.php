<?php
require_once'../externo/plugins/PDOModel.php';
require'../app/class/sessions.php';
$objSe = new Sessions();
$objSe->init();

date_default_timezone_set("America/Bogota");
//date_default_timezone_get();

$user_face = $_POST['nom-face'];
$ape_face = $_POST['ape-face'];
$mail_face = $_POST['mail'];


$objConn = new PDOModel();
$objConn->columns = array("count(*)");
$objConn->where("correo",$mail_face);
$result =  $objConn->select("usuarios");

if($result[0]['count(*)'] == 1){
    $objConn = new PDOModel();
    $objConn->where("correo",$mail_face);
    $res_usu =  $objConn->select("usuarios");

    $rol = $res_usu[0]['id_roles'];
    $id_usu = $res_usu[0]['id'];

    $updateUser["ultimo_acceso"] = date("Y-m-d H:i:s");
    $objConn->where("id", $res_usu[0]['id']);
    $objConn->update("usuarios", $updateUser);

    if($rol == 2)
    {
        $objConn = new PDOModel();
        $insertSe["id_usuario"] = $id_usu;
        $insertSe["origen"] = "W";
        $insertSe["f_login"] = date("Y-m-d H:i:s");
        $insertSe["estado"] = "A";
        $insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
        $objConn->insert("sesion", $insertSe);
        $ultima_sesion = $objConn->lastInsertId;

        $objSe->init();
        $objSe->set('sesion_activa',$ultima_sesion);
        $objSe->set('id_usuario', $res_usu[0]['id']);
        $objSe->set('id_roles', $res_usu[0]['id_roles']);
        $objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
        $objSe->set('nombre', $res_usu[0]['nombre']);
        $objSe->set('apellido', $res_usu[0]['apellido']);
        $objSe->set('genero', $res_usu[0]['genero']);
        $objSe->set('telefono', $res_usu[0]['telefono']);
        $objSe->set('correo', $res_usu[0]['correo']);
        $objSe->set('origen',$_POST['form_login_face']);

        echo "<script> window.location.assign('../app/src/index.php'); </script>";
    }
    else if($rol == 3)
    {
        $objConn = new PDOModel();
        $insertSe["id_usuario"] = $id_usu;
        $insertSe["origen"] = "W";
        $insertSe["f_login"] = date("Y-m-d H:i:s");
        $insertSe["estado"] = "A";
        $insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
        $objConn->insert("sesion", $insertSe);
        $ultima_sesion = $objConn->lastInsertId;

        $objSe->init();
        $objSe->set('sesion_activa',$ultima_sesion);
        $objSe->set('id_usuario', $res_usu[0]['id']);
        $objSe->set('id_roles', $res_usu[0]['id_roles']);
        $objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
        $objSe->set('nombre', $res_usu[0]['nombre']);
        $objSe->set('apellido', $res_usu[0]['apellido']);
        $objSe->set('genero', $res_usu[0]['genero']);
        $objSe->set('telefono', $res_usu[0]['telefono']);
        $objSe->set('correo', $res_usu[0]['correo']);
        $objSe->set('origen',$_POST['form_login']);

        echo "<script> window.location.assign('../app/src/index.php'); </script>";
    }

}else{
    echo "<script> alert('Email no se encuentra registrado');
                                window.location.assign('../app/src/sel_rol.php');</script>";

    $objSe->set('nom-face',$user_face);
    $objSe->set('ape-face',$ape_face);
    $objSe->set('mail',$mail_face);

}


?>