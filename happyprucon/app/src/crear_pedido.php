<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require_once'../../externo/plugins/PDOModel.php';
    require'../class/sessions.php';
    $objSe = new Sessions();
    $objSe->init();

    $usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
    $rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
    $fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;


    /*if($rol!=3){
        echo "<script> alert('Usuario no autorizado');
                        window.location.assign('logueo.html');</script>";
    }   */
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
    include "funciones.php";
    
        $id_producto = "";
    
        if(isset($_POST["id_producto"]) && $_POST["id_producto"] != "")
        {
            $id_producto = $_POST["id_producto"];
        }
        elseif(isset($_GET["id_producto"]) && $_GET["id_producto"] != "")
        {
             $id_producto = $_GET["id_producto"];
        }

        //informacion de todos los productos seleccionado por parte del cliente
        $objProd = new PDOModel();
        $objProd->where("id", $id_producto);
        $producto =  $objProd->select("producto");
        ?>
        <script>
            
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
                    <h1 class="page-title"> Productos disponibles
                        <small>Productos disponibles</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Productos disponibles</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Productos disponibles</span>
                            </li>
                        </ul>
                        
                    <!-- END PAGE HEADER-->
                    </div>
                    <div class="portlet light">
                        <div class="portlet-body form">
                            <form role="form" class="form-horizontal" name="crear_pedido"  id="crear_pedido" action="crear_pedido.php" enctype="multipart/form-data" method="post">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <div class=" portlet box red">
                                                <div class="portlet-title portlet box red">
                                                    <div class="caption" >
                                                        <span align><? echo $producto[0]['nombre']; ?> </span>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <img src="<? echo 'usuarios/'.$producto[0]['id_usuario'].'/bienes/'.$producto[0]['id'].'/res_producto.jpg'?>">
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <div class="well">
                                                <ul class="list-inline">
                                                    <li class="font-green">
                                                        <i class="fa fa-check-circle-o" style="color:purple" aria-hidden="true"></i> <?
                                                        $result1 =  $objProd->executeQuery("SELECT A.id, B. cantidad_despachada  FROM producto A, producto_disponibilidad B WHERE A.id_usuario = '".$id_producto."' AND B.id_producto = A.id AND  B.id_estado = 1;");

                                                        foreach ($result1 as $key) {
                                                            $cantidad_des= $key['cantidad_despachada'];
                                                            echo $cantidad_des;
                                                        }
                                                        ?></li>
                                                    <li class="font-yellow">
                                                        <i class="fa fa-star"></i> <?echo  calificacion_prod($producto[0]['id'])?></li>
                                                    <li class="font-red">
                                                        <?echo  cantidad_coment_prod($producto[0]['precio'])?></li>
                                                </ul>
                                                <h4><b>Ingredientes:</b></h4>
                                                <?
                                                    $result2 =  $objProd->executeQuery("SELECT A.*, B.*  FROM composicion_producto A, composicion B WHERE A.id_producto = '".$id_producto."' AND B.id = A.id_composicion AND B.id_estado = 1;");
                                                    foreach ($result2 as $key) {
                                                        $composicion= $key['nombre'];
                                                        echo '-'.' '.$composicion.'<br>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <input class="btn red" name="editar" type="submit" id="pedido" value="Realizar pedido">
                                            <input type="hidden" id="id_producto" name="id_producto" value="<? echo  $producto[0]['id'] ?>" />
                                            <input type="hidden" id="formulario" name="formulario" value="crear_pedido"/>
                                        </div>
                                    </div>
                                    
                                    <div class="portlet light">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption">
                                                    <i class="icon-bubbles font-dark hide"></i>
                                                    <span class="caption-subject"><h3 class="block bold" style="color: #520d9b">COMENTARIOS</h3></span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                        <div class="tab-pane active" id="portlet_comments_1">
                                                            <!-- BEGIN: Comments -->
                                                            <?
                                                            $objCon=new PDOModel();
                                                            $res_califica = $objCon->executeQuery("select A.* , B.* from producto A , calificacion_producto B where A.id = B.id_producto AND  A.id= '".$id_producto."' ");

                                                            foreach ($res_califica as $valor)
                                                            {
                                                                ?>
                                                                <div class="mt-comments">
                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-img">
                                                                            <img src="<? echo 'usuarios/'.$valor['id_usuario_califica'].'/perfil/min_perfil.jpg' ?>" /> 
                                                                        </div>
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author"><? echo $valor['nombre_completo'] ;?></span>
                                                                                <span class="mt-comment-date"><? echo $valor['fecha'];?></span>
                                                                            </div>
                                                                            <div class="mt-comment-text"><? echo $valor['comentario'] ;?></div>
                                                                            <div class="mt-comment-details">
                                                                                <span class="mt-comment-status mt-comment-status-pending"><? echo print_calificacion($valor['calificacion']); ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><?
                                                            }
                                                            ?>

                                                            <!-- END: Comments -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <?// echo "<pre>";print_r($GLOBALS); echo "<pre>"; ?>
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
    </body>

</html>