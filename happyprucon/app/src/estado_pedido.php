<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require_once'../../externo/plugins/PDOModel.php';
    require'../class/sessions.php';
    $objSe = new Sessions();
    $objSe->init();

    $usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
    $rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
    $fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;


    if($rol !=3){
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
    include "funciones.php";
    ?>
    
    <?
        $id_pedido = "";
    
        if(isset($_POST["id_pedido"]) && $_POST["id_pedido"] != "")
        {
            $id_pedido = $_POST["id_pedido"];
        }
        elseif(isset($_GET["id_pedido"]) && $_GET["id_pedido"] != "")
        {
             $id_pedido = $_GET["id_pedido"];
        }


        //informacion del pedido
        $objPedido = new PDOModel();
        $objPedido->where("id", $id_pedido);
        $pedido =  $objPedido->select("pedido");

        $id_producto=$pedido[0]['id_producto'];

        //informacion de todos los productos seleccionado por parte del cliente
        $objProd = new PDOModel();
        $objProd->where("id", $id_producto);
        $producto =  $objProd->select("producto");


        ?>
           <script type="text/javascript">

        </script>
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
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
                    <h1 class="page-title"> Estado pedido
                        <small>Estado pedido</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="gestion_pedido.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Estado pedido</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Estado pedido</span>
                            </li>
                        </ul>
                        
                    <!-- END PAGE HEADER-->
                    </div>
                        <div class="col-md-12">
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span>Estado pedido</span>
                                    </div>
                                </div>
                            <div class="portlet-body form">
                                <form role="form" class="form-horizontal" name="estado_pedido"  id="estado_pedido" action="estado_pedido.php" enctype="multipart/form-data" method="post">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <div class="col-lg-4"></div>
                                                <div class="col-md-4" align="center">
                                                    <img src="<? echo 'usuarios/'.$producto[0]['id_usuario'].'/bienes/'.$producto[0]['id'].'/res_producto.jpg'?>" class="img-responsive pic-bordered">
                                                </div>
                                            <div class="col-lg-4"></div>
                                        </div>

                                       <div class="form-group form-md-line-input">
                                            <div class="col-lg-4"></div>
                                            <div class="col-md-4">
                                                <label class="control-label">Precio: $</label>
                                                 <label class="control-label"><?php echo $pedido[0]['precio'] ?></label>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                           <div class="col-lg-4"></div>
                                                 <div class="col-md-4">
                                                <label class="control-label">Nombre del plato: </label>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                        
                                        <div class="form-group form-md-line-input">
                                            <div class="col-lg-4"></div>
                                            <div class="col-md-4">
                                                <label class="control-label">Cantidad: </label>
                                                 <label class="control-label"><?php echo $pedido[0]['cantidad'] ?></label>
                                                 
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>

                                        
                                      
                                      <div class="form-group form-md-line-input">
                                            <div class="col-lg-4"></div>
                                            <div class="col-md-4">
                                                <label class="control-label">Direccion:</label>
                                                <?
                                                    $objDir = new PDOModel();
                                                    $objDir->where("id",  $pedido[0]['cantidad']);
                                                    $direccion =  $objDir->select("ubicaciones_cliente");
                                                ?>
                                                 <label class="control-label"><?php echo $direccion[0]['direccion'] ?></label>
                                                 
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <div class="col-lg-4"></div>
                                            <div class="col-md-4">
                                                <label class="control-label">Estado: </label>
                                                <?
                                                    $objEst = new PDOModel();
                                                    $objEst->where("id",  $pedido[0]['id_estado']);
                                                    $estado =  $objEst->select("estado");
                                                ?>

                                                 <label class="control-label"><?php echo $estado[0]['descripcion'] ?></label>
                                                 
                                            </div>
                                             <div class="col-lg-4"></div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="col-lg-4"></div>
                                            <div class="col-md-4"  align="center">
                                                <a href="disponibilidad_emprendedor.php"><input  name="navegar" type="button" class="btn btn-circle red" id="navegar" value="Seguir navegando" /></a>
                                                <input type="hidden" id="formulario" name="formulario" value="estado_pedido"/>
                                            </div>
                                            <div class="col-md-4">
                                        </div>
                                    </div>
                                    
                                </form>
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

    </body>

</html>