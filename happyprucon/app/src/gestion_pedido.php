<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("../../externo/plugins/PDOModel.php");
require'../class/sessions.php';
$objSe = new Sessions();
$objSe->init();
$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
$fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;
if($rol!=2 ){
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

    <head><?php
        include "include_css.php";
        include "funciones.php";
        ?> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="index.html">
                        <img src="../assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" /> </a>
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
                <div class="page-actions">
                    <div class="btn-group">
                        <button type="button" class="btn btn-circle btn-outline red dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i>&nbsp;
                            <span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-docs"></i> New Post </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-tag"></i> New Comment </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-share"></i> Share </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-flag"></i> Comments
                                    <span class="badge badge-success">4</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-users"></i> Feedbacks
                                    <span class="badge badge-danger">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
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
                    <div class="theme-panel">
                        <div class="toggler tooltips" data-container="body" data-placement="left" data-html="true" data-original-title="Click to open advance theme customizer panel">
                            <i class="icon-settings"></i>
                        </div>
                        <div class="toggler-close">
                            <i class="icon-close"></i>
                        </div>
                        <div class="theme-options">
                            <div class="theme-option theme-colors clearfix">
                                <span> THEME COLOR </span>
                                <ul>
                                    <li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default"> </li>
                                    <li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey"> </li>
                                    <li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue"> </li>
                                    <li class="color-dark tooltips" data-style="dark" data-container="body" data-original-title="Dark"> </li>
                                    <li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light"> </li>
                                </ul>
                            </div>
                            <div class="theme-option">
                                <span> Layout </span>
                                <select class="layout-option form-control input-small">
                                    <option value="fluid" selected="selected">Fluid</option>
                                    <option value="boxed">Boxed</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Header </span>
                                <select class="page-header-option form-control input-small">
                                    <option value="fixed" selected="selected">Fixed</option>
                                    <option value="default">Default</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Top Dropdown</span>
                                <select class="page-header-top-dropdown-style-option form-control input-small">
                                    <option value="light" selected="selected">Light</option>
                                    <option value="dark">Dark</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Sidebar Mode</span>
                                <select class="sidebar-option form-control input-small">
                                    <option value="fixed">Fixed</option>
                                    <option value="default" selected="selected">Default</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Sidebar Style</span>
                                <select class="sidebar-style-option form-control input-small">
                                    <option value="default" selected="selected">Default</option>
                                    <option value="compact">Compact</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Sidebar Menu </span>
                                <select class="sidebar-menu-option form-control input-small">
                                    <option value="accordion" selected="selected">Accordion</option>
                                    <option value="hover">Hover</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Sidebar Position </span>
                                <select class="sidebar-pos-option form-control input-small">
                                    <option value="left" selected="selected">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Footer </span>
                                <select class="page-footer-option form-control input-small">
                                    <option value="fixed">Fixed</option>
                                    <option value="default" selected="selected">Default</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END THEME PANEL -->
                    <h1 class="page-title"> Blank Page Layout
                        <small>blank page layout</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.html">Home</a>
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
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="#">
                                            <i class="icon-bell"></i> Action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-shield"></i> Another action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-user"></i> Something else here</a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="../class/log_out.php">
                                            <i class="icon-bag"></i> Separated link</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <div class="portlet light portlet-fit " style="margin-bottom: 1px !important;">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-microphone font-dark hide"></i>
                                <span class="caption-subject bold font-dark uppercase"> HAPPY FOOD </span>
                            </div>
                        </div>
                            <div class="portlet-body">
                                <form role="form" class="form-horizontal" action="gestion_pedido_detalle.php" name="ges_pedido" id="ges_pedido" method="POST">
                                    <div class="row">
                                        <?
                                        $objGes = new PDOModel();
                                        $result = $objGes->executeQuery("SELECT A.id_producto , B.nombre, B.descripcion, count(*) as pedido FROM pedido as A, producto as B WHERE A.id_producto = B.id and A.id_estado = '7' and B.id_usuario = '".$usu_id."' group by A.id_producto");
                                        foreach ($result as $item) {
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4" style="margin-top: 10px;">
                                            <div class="mt-widget-2" >
                                                <div class="mt-head" style="background-image: url(<? echo "usuarios/".$usu_id."/bienes/".$item["id_producto"]."/res_producto.jpg"?>); height: 190px;" >
                                                   <div class="mt-head-user" >
                                                        <div class="mt-head-user-img"></div>
                                                    </div>
                                                </div>
                                                <div class="mt-body" style="padding-top: 70px !important;">
                                                    <h3 class="mt-body-title"> <? echo $item['nombre']; ?> </h3>
                                                    <p class="mt-body-description" style="margin: 0 !important;"> <? echo $item['descripcion']; ?> </p>
                                                    <ul class="mt-body-stats">
                                                        <li class="font-purple">
                                                            <i class="fa fa-check"></i> <? echo $item['pedido']; ?> </li>
                                                        <li class="font-red">
                                                            <i class="  icon-bubbles"></i> <? echo cantidad_coment_prod($item['id_producto']); ?> </li>
                                                    </ul>
                                                    <div class="btn-group-circle" style="margin-bottom: 20px;">
                                                        <a href="gestion_pedido_detalle.php?id_usuario=<? echo $usu_id;?>&id_producto=<? echo $item['id_producto'];?>" type="submit"
                                                                class="btn btn-default mt-ladda-btn ladda-button" style="border-radius: 10px;">VER DETALLE
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                    </div>
                    <div class="portlet light portlet-fit " style="margin-bottom: 0 !important;">
                        <div class="portlet-title" style="margin-bottom: 0 !important;">
                            <form role="form" class="form-horizontal" action="gestion_pedido_detalle.php" name="adquisicion" id="adquisicion" method="POST">




                                    <div class="row">
                                        <center>
                                            <?
                                            $objGes = new PDOModel();
                                            //$result1 =  $objCat->executeQuery("SELECT * FROM producto A, pedido B WHERE A.id= B.id_producto and B.id_estado = '7' and A.id_usuario = '".$usu_id."' ");
                                            $result1 = $objGes->executeQuery("SELECT A.id_producto , A.forma_adquisicion, B.nombre, B.descripcion, count(*) as adquirido FROM pedido as A, producto as B WHERE A.id_producto = B.id and A.id_estado = '7' and B.id_usuario = '".$usu_id."' group by A.forma_adquisicion");
                                            foreach ($result1 as $item1) {
                                                if($item1['forma_adquisicion'] == 1){
                                                    $icono = "fa fa-home fa-2x";
                                                }
                                                if($item1['forma_adquisicion'] == 2){
                                                    $icono = "fa fa-ship fa-2x";
                                                }
                                            ?>

                                                           <a href="gestion_pedido_detalle.php?id_usuario=<? echo $usu_id;?>&id_forma_adquisicion=<? echo $item1['forma_adquisicion'];?>" ><i class="<? echo $icono; ?>" style="color: purple"></i></a>
                                                <span class="badge badge-danger" style="margin-top: -30px; margin-left: -12px; margin-right: 20px;"><? echo $item1['adquirido'];?></span>
                                            <?
                                            }
                                            ?>

                                        </center>
                                    </div>




                            </form>

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
            <!-- BEGIN CORE PLUGINS -->
            <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="../assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
            <script src="../assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
            <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
            <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
            <!-- END THEME LAYOUT SCRIPTS -->
            <script>
                $(document).ready(function()
                {
                    $('#clickmewow').click(function()
                    {
                        $('#radio1003').attr('checked', 'checked');
                    });
                })
            </script>
    </body>

</html>