<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
$objSe->init();

$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
$fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;
$name = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null ;
$lastname = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : null ;
$genero = isset($_SESSION['genero']) ? $_SESSION['genero'] : null ;
$tel = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : null ;
$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : null ;
$meta = isset($_SESSION['suenos']) ? $_SESSION['suenos'] : null ;

$id_user = "";

if(isset($_POST["id_usuario"]) && $_POST["id_usuario"] != "")
{
    $id_user = $_POST["id_usuario"];
}
elseif(isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "")
{
    $id_user = $_GET["id_usuario"];
}
$objUbicacion = new PDOModel();
$objUbicacion->where("id_usuario", $id_user);
$res_usuarios =  $objUbicacion->select("usuarios");
foreach ($res_usuarios as $usuarios)
{
    $rol = $usuarios["rol"] ;
    $fullname = $usuarios["fullname"] ;
    $name = $usuarios["name"] ;
    $lastname = $usuarios["lastname"] ;
    $genero = $usuarios["genero"] ;
    $tel = $usuarios["tel"] ;
    $correo = $usuarios["correo"] ;
}
if($rol==2){

}else{
    echo "<script> alert('Usuario no autorizado');
					window.location.assign('logueo.html');</script>";

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
                        <a href="gestion_pedido.php">Home</a>
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
            <?php
            if(isset($_POST["btn1"])) {
            $btn = $_POST["btn1"];

                if ($btn == "Buscar"){

                    $selbus = $_POST['sel-bus'];

                    if($selbus == "Categoria"){

                    }
                    else if($selbus == "Emprendedor"){

                    }
                    else if($selbus == "Producto"){

                    }
                    else{

                    }

                }
            }

            ?>


            <div class="portlet light">
                <form role="form" class="form-horizontal" name="buscar" id="buscar" enctype="multipart/form-data" method="POST">
                    <div class="form-group form-md-line-input has-info col-lg-3" style="margin-top: 20px;">
                        <label class="control-label"></label>
                        <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-newspaper-o"></i>
                                                        </span>
                            <select name="sel-bus" id="sel-bus" class="form-control">
                                <option></option >
                                <option>Categoria</option >
                                <option>Emprendedor</option >
                                <option>Producto</option >
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-md-line-input has-info col-lg-3">
                        <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-cc"></i>
                                                        </span>
                            <input type="text" class="form-control" name="buscar" id="buscar" placeholder="Busqueda" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-9 col-sm-offset-4 col-sm-9">
                                <input type="submit" id="register-submit-btn" class="btn purple" name="btn1" value="Buscar"/>
                            </div>
                        </div>
                    </div>
                </form>
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