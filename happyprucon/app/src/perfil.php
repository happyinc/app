<?php
error_reporting(E_ALL ^ E_NOTICE);
include '../class/sessions.php';
require_once'../../externo/plugins/PDOModel.php';
$objSe = new Sessions();
$objSe->init();

$usu_id = isset($_SESSION['id']) ? $_SESSION['id'] : null ;
$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
$fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;
$name = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null ;
$lastname = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : null ;
$genero = isset($_SESSION['genero']) ? $_SESSION['genero'] : null ;
$tel = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : null ;
$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : null ;

if($rol==2){

}else{
    echo "<script> alert('Usuario no autorizado');
					window.location.assign('logueo.html');</script>";

}


if($genero=="Masculino")
{
    $chequeado="checked";
}


if($genero=="Femenino"){
    $chequeada="checked";
}

?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <?php
    include "include_css.php";
    include("../../../externo/plugins/PDOModel.php");
    ?>
</head>
<!-- END HEAD -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
                <img src="../../assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->

        <!-- END PAGE ACTIONS -->
        <!-- BEGIN HEADER -->
        <?
        include "cabecera.php";
        ?>
        <!-- END HEADER -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?
    include "menu.php";
    ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->

            <!-- END THEME PANEL -->
            <h1 class="page-title"> Blank Page Layout
                <small>blank page layout</small>
            </h1>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="index.php">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Blank Page</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Page Layouts</span>
                    </li>
                </ul>

            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN BOX BODY     CONTENIDO AQUI !!!!!!!!!! -->
            <div class="portlet light">
                <?php
                if(isset($_POST["btn1"])) {
                    $btn = $_POST["btn1"];

                    if ($btn == "Cambiar") {
                        $objConn = new PDOModel();
                        $updateUserData["password"] = md5($_POST['password']);
                        $objConn->where("id", $usu_id);
                        $objConn->update("usuarios", $updateUserData);

                        if ($objConn != "") {
                            echo "<script> alert('Cambio exitoso');</script>";
                        } else {
                            echo "<script> alert('Error: La contraseña no se pudo actualizar');</script>";
                        }
                    }

                    if ($btn == "Actualizar"){
                        $objConn = new PDOModel();
                        $updateUserData["nombre_completo"] = $_POST['fullname']." ".$_POST['lastname'];
                        $updateUserData["nombre"] = $_POST['fullname'];
                        $updateUserData["apellido"] = $_POST['lastname'];
                        $updateUserData["genero"] = $_POST['genero'];
                        $updateUserData["telefono"] = $_POST['cell'];
                        $updateUserData["correo"] = $_POST['username'];
                        $objConn->where("id", $_POST['iduser']);
                        $objConn->update("usuarios", $updateUserData);

                        if($objConn != ""){
                            $objConn = new PDOModel();
                            $objConn->where("id",$_POST['iduser']);
                            $res_usu =  $objConn->select("usuarios");

                            $objSe->init();
                            $objSe->set('id', $res_usu[0]['id']);
                            $objSe->set('id_roles', $res_usu[0]['id_roles']);
                            $objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
                            $objSe->set('nombre', $res_usu[0]['nombre']);
                            $objSe->set('apellido', $res_usu[0]['apellido']);
                            $objSe->set('genero', $res_usu[0]['genero']);
                            $objSe->set('telefono', $res_usu[0]['telefono']);
                            $objSe->set('correo', $res_usu[0]['correo']);

                            echo "<script> alert('Usuario actualizado correctamente');
                        window.location.assign('../../app/src/perfil.php');</script>";
                        }else{
                            echo "<script> alert('No se pudo actualizar');</script>";
                        }
                    }




                }
                ?>

                <!-- BEGIN FORM-->
                <form action="" class="form-horizontal" method="post">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nombres</label>
                           <div class="col-md-4">
                               <input name="iduser" id="iduser" type="hidden" class="form-control" value="<?php echo $usu_id; ?>"/>
                                <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $name; ?>" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Apellidos</label>
                            <div class="col-md-4">
                                <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname; ?>" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Celular</label>
                            <div class="col-md-4">
                                <input name="cell" id="cell" type="text" class="form-control" value="<?php echo $tel; ?>"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Correo electrónico</label>
                            <div class="col-md-4">
                                <input name="username" id="username" type="email" class="form-control" value="<?php echo $correo; ?>"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Genero</label>
                            <div class="col-md-4">
                                <div class="radio-list">
                                    <label>
                                        <input type="radio" name="genero" value="Masculino" <?php echo $chequeado;?> class="icheck" > Masculino </label>
                                    <label>
                                        <input type="radio" name="genero" value="Femenino" <?php echo $chequeada;?> class="icheck" > Femenino </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="submit" id="register-submit-btn" class="btn blue" name="btn1" value="Actualizar"/>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
                <!-- BEGIN FORM PASSWORD-->
                <script language="JavaScript">
                    function validar(f) {
                        if(f.password.value != "" && (f.password.value == f.repassword.value)){
                            return true;
                        }
                        else{
                            alert("Las contraseñas no coinciden");
                            return false;
                        }

                    }

                </script>

                <form onSubmit="return validar(this)" action="" class="form-horizontal" method="post"style="padding-top: 20px;">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> Contraseñas no coinciden </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contraseña</label>
                            <div class="col-md-4">
                                <input name="password" id="password" type="password" class="form-control"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Repite contraseña</label>
                            <div class="col-md-4">
                                <input name="repassword" id="repassword" type="password" class="form-control"/> </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="submit" id="register-submit-btn" class="btn blue" name="btn1" value="Cambiar"/>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM PASSWORD-->
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?
include "footer.php";
?>
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<?
include "include_js.php";
?>
</body>

</html>