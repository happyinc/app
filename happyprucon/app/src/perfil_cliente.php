<?php
error_reporting(0);
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
$objSe->init();

$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
$fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;
$tel = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : null ;
$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : null ;

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
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
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
    include "funciones.php";
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
            <div class="portlet light">
                <!-- BEGIN FORM-->
                <form role="form" action="perfil_cliente.php" class="form-horizontal" name="upd_datos" id="upd_datos" enctype="multipart/form-data" method="post">
                    <div class="form-body">

                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-md-3">
                                <div class="mt-widget-1" style=" border: 0px !important;">
                                    <div class="mt-icon">
                                        <a href="editar_perfil.php">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="mt-img" style="margin-bottom: 10px !important;">
                                        <img src="<? echo "usuarios/".$usu_id."/perfil/res_perfil.jpg"?>" width="150" class="img-circle" style="border-radius: 50%;">  </div>
                                    <div class="mt-body">
                                        <h3 class="mt-username"><? echo calificacion_usuario($usu_id); ?></h3>

                                        <div class="row" style="padding-top: 20px;">

                                            <label class="font-yellow" style="margin-right: 5px;"><? echo calificacion_usu($usu_id); ?></label>
                                            <i class="fa fa-star font-yellow" style="margin-right: 10px;"></i>|

                                            <label class="font-green" style="margin-left: 10px; margin-right: 5px;"><? echo cantidad_coment_usu($usu_id); ?></label>
                                            <i class="fa fa-comments font-green" style="margin-right: 10px;"></i>|

                                            <label class="font-purple" style="margin-left: 10px; margin-right: 5px;">1,7k</label>
                                            <i class="fa fa-group font-purple" style="margin-right: 10px;"></i>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-info form-md-floating-label" style="margin-top: 20px;">
                        <div class="col-lg-3 col-sm-4 col-xs-1"></div>
                        <div class="input-group left-addon col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $fullname; ?>" placeholder="Nombres" readonly>
                        </div>
                        <div class="col-sm-4 col-xs-1"></div>
                    </div>
                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                        <div class="col-lg-3 col-sm-4 col-xs-1"></div>
                        <div class="input-group left-addon col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-tablet"></i>
                                                    </span>
                            <input type="number" class="form-control" name="cell" id="cell" value="<?php echo $tel; ?>" placeholder="Celular" readonly>
                        </div>
                        <div class="col-sm-4 col-xs-1"></div>
                    </div>
                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                        <div class="col-lg-3 col-sm-4 col-xs-1"></div>
                        <div class="input-group left-addon col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                            <input type="email" class="form-control" name="username" id="username" value="<?php echo $correo; ?>" placeholder="Correo electrónico" readonly>
                        </div>
                        <div class="col-sm-4 col-xs-1"></div>
                    </div>
                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                        <div class="col-lg-3 col-sm-4 col-xs-1"></div>
                        <div class="input-group left-addon col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                            <input type="password" class="form-control" placeholder="*********" readonly>
                        </div>
                        <div class="col-sm-4 col-xs-1"></div>
                    </div>
            </div>
                </form>
                <!-- END FORM-->
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