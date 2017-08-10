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

        <link href="../assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />

    <?php
    $objConn = new PDOModel();
    $result =  $objConn->executeQuery("SELECT A.*, B.*  FROM producto A, producto_disponibilidad B WHERE B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1;");

    if(isset($_POST["formulario"]) && $_POST["formulario"] == "buscar" )
    {
         $result1 =  $objConn->executeQuery("SELECT A.*, B.*  FROM producto A, producto_disponibilidad B WHERE B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1 AND ( A.nombre LIKE '%xxx%'  OR A.descripcion LIKE '%ham%' );");
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
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

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
                                        <label class="control-label col-md-3">Categoria</label>
                                        <div class="col-md-4">
                                            <div class="btn-group bootstrap-select bs-select form-control"><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="Mustard"><span class="filter-option pull-left">Mustard</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" role="combobox"><ul class="dropdown-menu inner" role="listbox" aria-expanded="false"><li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">Mustard</span><span class="fa fa-check check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Ketchup</span><span class="fa fa-check check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Relish</span><span class="fa fa-check check-mark"></span></a></li></ul></div>
                                                <select class="bs-select form-control" tabindex="-98">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Emprendedor</label>
                                        <div class="col-md-4">
                                            <div class="btn-group bootstrap-select bs-select form-control"><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="Mustard"><span class="filter-option pull-left">Mustard</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" role="combobox"><ul class="dropdown-menu inner" role="listbox" aria-expanded="false"><li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">Mustard</span><span class="fa fa-check check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Ketchup</span><span class="fa fa-check check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Relish</span><span class="fa fa-check check-mark"></span></a></li></ul></div>
                                                <select class="bs-select form-control" tabindex="-98">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Rango de precio</label>
                                        <div class="col-md-4">
                                            <div class="btn-group bootstrap-select bs-select form-control"><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="Mustard"><span class="filter-option pull-left">Mustard</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" role="combobox"><ul class="dropdown-menu inner" role="listbox" aria-expanded="false"><li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">Mustard</span><span class="fa fa-check check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Ketchup</span><span class="fa fa-check check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Relish</span><span class="fa fa-check check-mark"></span></a></li></ul></div>
                                                <select class="bs-select form-control" tabindex="-98">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                            </form>
                            <input type="hidden" id="formulario" name="formulario" value="buscar"/>
                            <input type="hidden" id="buscarf" name="buscarf" value="buscarf"/>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
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
<script src="../assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>


</body>

</html>