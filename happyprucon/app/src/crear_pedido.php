<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require_once'../../externo/plugins/PDOModel.php';
    require'../class/sessions.php';
    $objSe = new Sessions();
    $objSe->init();

    $usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
    $rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
    $fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;


    if($rol!=3){
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
    <link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <?
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

        // insert del pedido
        $id_pedido=0;
        if(isset($_POST["formulario"]) && $_POST["formulario"] == "crear_pedido")
        {
            $fecha = date("Y-m-d H:i:s");
            $fecha1 = explode(" ", $fecha);
            $fecha_act=$fecha1[0];
            $hora=$fecha1[1];

            $objConn = new PDOModel();
            $insertData["id_usuario"] = $usu_id;
            $insertData["id_estado"] = 3;
            $insertData["id_producto"] = $id_producto; 
            $insertData["fecha"] = $fecha;
            $insertData["cantidad"] = $_POST['cantidad_despachada'] ;
            $objConn->insert('pedido', $insertData);

            $id_pedido= $objConn->lastInsertId;

            if ($id_pedido !="")
            {
                $insertDet["id_pedido"] = $id_pedido;
                $insertDet["id_estado"] = 3;
                $insertDet["fecha"] = $fecha_act; 
                $insertDet["hora"] = $hora; 
                $objConn->insert('detalle_pedido', $insertDet);

                 $id_pedido_detalle= $objConn->lastInsertId;
           
            }

            if($id_pedido =="" || $id_pedido_detalle =="")
            {
                    echo  $objConn->error;
            }
        }

    ?>
    <script>
        function alertaPedidoCreado() 
        {
            var id_pedido=<?echo $id_pedido?>;
            if(id_pedido >=1)
            {
                        swal({
                                title:"El pedido haa sido creado con el id:" + <? echo $id_pedido?>,
                                text: "¿Desea continuar con la confirmacion del pedido?",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Si, deseo hacerlo!",
                                cancelButtonText: "No",
                                closeOnConfirm: false,
                                closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                swal("Ir", "En un momento sera dirigido a la pagina para continuar con el pedido.", "success");
                                location.href="confirmar_pedido.php?id_pedido="+<? echo $id_pedido?>;
                            } else {
                                swal("Cancelar","se cancelo la confirmacion del pedido");
                                location.href="crear_pedido.php?id_producto="+<? echo $id_producto?>
                            }
                        });
            }
        }
        </script>
       
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md" onload="alertaPedidoCreado()">
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
                    <h1 class="page-title"> Hacer pedido
                        <small>Hacer pedido</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="gestion_pedido.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Hacer pedido</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Hacer pedido</span>
                            </li>
                        </ul>
                        
                    <!-- END PAGE HEADER-->
                    </div>
                    <div class="col-md-12">
                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span><? echo $producto[0]['nombre']; ?></span>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form role="form" class="form-horizontal" name="crear_pedido"  id="crear_pedido" action="crear_pedido.php" enctype="multipart/form-data" method="post">
                                    <div class="form-body">
                                    
                                        <div class="form-group form-md-line-input">
                                            <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
                                                <img src="<? echo 'usuarios/'.$producto[0]['id_usuario'].'/bienes/'.$producto[0]['id'].'/res_producto.jpg'?>" class="img-responsive pic-bordered">
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                <div class="well">
                                                    <ul class="list-inline">
                                                        <li class="font-purple">
                                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?
                                                            $result1 =  $objProd->executeQuery("SELECT A. id, B. cantidad_despachada  FROM producto A, producto_disponibilidad B WHERE A.id = '".$id_producto."' AND B.id_producto = A.id AND  B.id_estado = 1;");

                                                            foreach ($result1 as $key) 
                                                            {
                                                                $cantidad_des= $key['cantidad_despachada'];
                                                                echo $cantidad_des;
                                                            }
                                                            ?>
                                                        </li>
                                                        <li class="font-yellow"><i class="fa fa-star"></i> <?echo  calificacion_prod($producto[0]['id'])?></li>
                                                        <li class="font-red"><?echo  "$".$producto[0]['precio']?></li>
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
                                                <div class="form-group">
                                                    <label class="control-label">Seleccione la cantidad a solicitar</label>
                                                        <select class="form-control" id="cantidad_despachada" name="cantidad_despachada">
                                                            <?
                                                            $result2 =  $objProd->executeQuery("SELECT A. id, B. cantidad_disponible FROM producto A, producto_disponibilidad B WHERE A.id = '".$id_producto."' AND B.id_producto = A.id AND  B.id_estado = 1;");
                                                            foreach ($result2 as $key) 
                                                            {
                                                                for ($i = 1; $i <= $key['cantidad_disponible']; $i++)
                                                                {
                                                                    ?>
                                                                        <option value="<?php echo $i ?>"><?php echo $i?></option>
                                                                    <?
                                                                }
                                                            }

                                                            ?>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="col-md-offset-3 col-md-9">
                                                <input class="btn btn btn-circle red" name="pedido" type="submit" id="pedido" value="Realizar pedido">
                                                <input type="hidden" id="id_producto" name="id_producto" value="<? echo  $id_producto ?>" />
                                                <input type="hidden" id="formulario" name="formulario" value="crear_pedido"/>
                                            </div>
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
            <script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
    </body>

</html>