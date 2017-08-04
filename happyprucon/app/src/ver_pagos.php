<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require_once'../../externo/plugins/PDOModel.php';
    require'../class/sessions.php';
    $id_usuario = "";
    
        if(isset($_POST["id_usuario"]) && $_POST["id_usuario"] != "")
        {
            $id_usuario = $_POST["id_usuario"];
        }
        elseif(isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "")
        {
             $id_usuario = $_GET["id_usuario"];
        }


        $objUbicacion = new PDOModel();
        $objUbicacion->where("id", $id_usuario);
        $res_usuarios =  $objUbicacion->select("usuarios");
        foreach ($res_usuarios as $usuarios)
        {
                $rol = $usuarios["rol"] ;
                $fullname = $usuarios["fullname"] ;                                                        
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
        <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />

        <?php


        include "include_css.php";
        include "funciones.php";

        $objConn = new PDOModel();
        
        $comodin = " AND 2=1";

        if(isset($_POST["formulario"]) && $_POST["formulario"] == "ver_pagos" )
        {
            if($_POST["fecha_i"]!= "" && $_POST["fecha_f"]!=""  )
            {

                $date1 = new DateTime("".$_POST["fecha_i"]."");
                $date2 = new DateTime("".$_POST["fecha_f"]."");

                if($date1 <=  $date2)
                {
                    $fecha_i=$_POST["fecha_i"];
                    $fecha_f=$_POST["fecha_f"];

                  
                    $comodin = "AND A.fecha BETWEEN '".$fecha_i."' AND '".$fecha_f."'" ;
                } 
                else
                {
                    ?><script type="text/javascript">alert("La fecha final no puede ser menor que la fecha de inicio");
                      location.href="ver_pagos.php?id_usuario=<? echo $id_usuario ?>";
                    </script><?

                }  
            }
            else 
            {
               $comodin = "";
            } 
         
        }       
    
        ?>
        <script type="text/javascript">
        
   
        </script>


    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md" >
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
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
               
                <!-- END PAGE ACTIONS -->
                <!-- BEGIN HEADER -->
                    <?php
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
            <?php
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
                    <h1 class="page-title"> Ver Pagos
                        <small>Ver Pagos </small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="gestion_pedido.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Ver Pagos</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Ver Pagos</span>
                            </li>
                        </ul>
                        
                    <!-- END PAGE HEADER-->
                    </div>
                    <div class="portlet light">
                        <div class="portlet-body form">
                            <form role="form" class="form-horizontal" name="ver_pagos"  id="ver_pagos" action="ver_pagos.php" enctype="multipart/form-data" method="post">
                                <div class="form-body">
                                    
                                    <div class="form-group"  align="center">
                                        <label class="control-label col-md-2">Fecha Inicio</label>
                                        <div class="col-md-2">
                                            <input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy-mm-dd" name="fecha_i" id="fecha_i" size="16" type="text" value="">
                                            <span class="help-block"> Seleccione la fecha de inicio </span>
                                        </div>
                                    
                                        <label class="control-label col-md-2">Fecha Fin</label>
                                        <div class="col-md-2">
                                            <input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy-mm-dd" name="fecha_f" id="fecha_f" size="16" type="text" value="">
                                            <span class="help-block"> Seleccione la fecha fin </span>
                                        </div>
                                    </div>
                                    

                                    <div class="form-actions">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"  align="center">
                                            <input class="btn  btn-circle purple" name="consultar" type="submit" id="consultar" value="Consultar">
                                            <input type="hidden" id="formulario" name="formulario" value="ver_pagos"/>
                                            <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario ?>" />
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </form>
                            <div class="portlet box purple">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-money"></i>Pagos de Happy
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th class="numeric"> No pedido </th>
                                                <th> Fecha pedido </th>
                                                <th> Cliente </th>
                                                <th> Producto o servicio </th>
                                                <th class="numeric"> Valor unitario </th>
                                                <th class="numeric"> Valor total </th>
                                                <th class="numeric"> Comision Happy </th>
                                                <th class="numeric"> Valor a pagar </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?

                                            
                                            $result1 = $objConn->executeQuery("SELECT A.id, A.id_usuario, A.fecha, A.precio as total, A.cantidad, A.comision, A.cxp, B.nombre, B.precio FROM pedido A, producto B WHERE A.id_producto= B.id AND A.id_estado=9 $comodin AND B.id_usuario= '".$id_usuario."';");
                                            foreach($result1 as $item)
                                            {
                                            ?>
                                                <tr>
                                                    <td class="numeric"> <? echo $item["id"]?> </td>
                                                    <td> <? echo $item["fecha"]?> </td>
                                                    <td> <? echo  nombre_usuario($item["id_usuario"])?> </td>
                                                    <td> <? echo $item["nombre"]?> </td>
                                                    <td class="numeric"><? echo $item["precio"]?> </td>
                                                    <td class="numeric"><? echo $item["total"]?> </td>
                                                    <td class="numeric"><? echo $item["comision"]?> </td>
                                                    <td class="numeric"><? echo $item["cxp"]?> </td>
                                                </tr>
                                                <?
                                             
                                            }; 
                                            ?>
                                        </tbody>
                                    </table>
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
        <?php
            include "footer.php";
        ?>
        <!-- END FOOTER -->
            <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <?php
            include "include_js.php";
            ?>
            <script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

    </body>

</html>