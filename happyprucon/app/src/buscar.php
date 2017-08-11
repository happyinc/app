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
$objUbicacion->where("id", $id_user);
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
/*if($rol!=2){

}else{
    echo "<script> alert('Usuario no autorizado');
					window.location.assign('logueo.html');</script>";

}*/
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

        <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />


    <?php
    $objConn = new PDOModel();
    $result =  $objConn->executeQuery("SELECT A.*, B.*  FROM producto A, producto_disponibilidad B WHERE B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1;");

    if(isset($_POST["buscarb"]) && $_POST["buscarb"] != "" )
    {
         $result1 =  $objConn->executeQuery("SELECT A.*, B.*  FROM producto A, producto_disponibilidad B WHERE B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1 AND ( A.nombre LIKE '%'".$POST['buscar']."'%'  OR A.descripcion LIKE '%'".$POST['buscar']."'%' );");///preguntar
    }
    
    $consulta=$result1;

    if(isset($_POST["buscarf"]) && $_POST["buscarf"] != "" )
    {
         $result1 =  $objConn->executeQuery("SELECT A.*, B.*  FROM producto A, producto_disponibilidad B WHERE B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1 AND ( A.nombre LIKE '%'".$POST['buscar']."'%'  OR A.descripcion LIKE '%'".$POST['buscar']."'%' );");
    
    }

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

            <div class="portlet light">
                    
                      <div class="col-md-4">
                        <div class="input-group">
                          <input type="search" name="buscar" id="buscar" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="buscarb" value="buscarb"><i class="fa fa-search"></i></button>
                          </span>
                        </div>
                      </div>
                    
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Filtros</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Filtros de busqueda</h4>
                          </div>
                          <div class="modal-body">
                            <form role="form" class="form-horizontal" name="buscar" id="buscar" action="buscar.php" enctype="multipart/form-data" method="POST">

                                <p>Seleccione el filtro de busqueda.</p>

                                    <div class="form-group">
                                        <label for="categoria" class="control-label">categoria</label>
                                        <select id="categoria" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="categoria">
                                            <option></option>
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                         </select>
                                         
                                    </div>

                                     <div class="form-group">
                                        <label for="emprendedor" class="control-label">emprendedor</label>
                                        <select id="emprendedor" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="emprendedor">
                                            <option></option>
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                         </select>
                                    </div>

                                     <div class="form-group">
                                        <label for="precio" class="control-label">precio</label>
                                        <select id="precio" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="precio">
                                            <option></option>
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                         </select>
                                    </div>

                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle purple" name="enviar" id="enviar" value="enviar"> Enviar </button>
                                        </div>
                                    </div>

                            </form>
                            <input type="hidden" id="formulario" name="formulario" value="buscar"/>
                           <!-- <input type="hidden" id="buscarf" name="buscarf" value="buscarf"/>
                            <input type="hidden" id="emprendedor" name="emprendedor" value="buscarf"/>
                            <input type="hidden" id="categoria" name="categoria" value="buscarf"-->
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>

                    <?
                        echo "la categoria es:"."".$_POST["categoria"]."</br>";
                        echo "el emprendedor es:"."".$_POST["emprendedor"]."</br>";
                        echo "el precio es:"."".$_POST["precio"];

                    ?>
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
 <!--<script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>-->
 <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

 <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>




</body>

</html>