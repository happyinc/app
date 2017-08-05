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
               $rol = $usuarios["id_roles"] ;
                $fullname = $usuarios["fullname"] ;                                                        
        }

        if($rol!=2){

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
    
    

        $id_producto = "";

    
        if(isset($_POST["id_producto"]) && $_POST["id_producto"] != "")
        {
            $id_producto = $_POST["id_producto"];
        }
        elseif(isset($_GET["id_producto"]) && $_GET["id_producto"] != "")
        {
             $id_producto = $_GET["id_producto"];
        }

        $id_forma_adquisicion = "";
    
        if(isset($_POST["id_forma_adquisicion"]) && $_POST["id_forma_adquisicion"] != "")
        {
            $id_forma_adquisicion = $_POST["id_forma_adquisicion"];
        }
        elseif(isset($_GET["id_forma_adquisicion"]) && $_GET["id_forma_adquisicion"] != "")
        {
             $id_forma_adquisicion = $_GET["id_forma_adquisicion"];
        }

        ?>
        <link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
        
            
        <?
        $result1="";
        $objConn = new PDOModel();

        if($id_producto !="")
        {
            $result1 = $objConn->executeQuery("SELECT C.* FROM (SELECT A.id, A.id_usuario,A.id_zona, A.id_estado,A.id_producto,A.id_ubicacion_cliente,A.fecha,A.precio,A.forma_adquisicion,A.cantidad,A.comision,A.cxp, B.id_categoria,B.nombre,B.descripcion  FROM pedido A, producto B WHERE B.id_usuario = '".$id_usuario."' AND B.id = A.id_producto AND A.id_estado = 7 ) C WHERE C.id_producto = '".$id_producto."';");
        }

        if($id_forma_adquisicion !="")
        {
            $result1 = $objConn->executeQuery("SELECT C.* FROM (SELECT A.id, A.id_usuario,A.id_zona, A.id_estado,A.id_producto,A.id_ubicacion_cliente,A.fecha,A.precio,A.forma_adquisicion,A.cantidad,A.comision,A.cxp, B.id_categoria,B.nombre,B.descripcion  FROM pedido A, producto B WHERE B.id_usuario = '".$id_usuario."' AND B.id = A.id_producto AND A.id_estado = 7) C WHERE C.forma_adquisicion = '".$id_forma_adquisicion."';");
        }



        //manejo de la fecha para hacer el insert en la tabla detalle pedido
        $fecha = date("Y-m-d H:i:s");
        $fecha1 = explode(" ", $fecha);
        $fecha_act=$fecha1[0];
        $hora=$fecha1[1];
        

        if(isset($_POST["formulario"]) && $_POST["formulario"] == "gestion_pedido_detalle" )
        {
    
            $id_pedido=$_POST['id_pedido'];
            if(isset($_POST["despachar"]) && $_POST["despachar"]== "Despachar" )
            {
                $updateData["id_estado"] = 8; 
                $objConn->where("id",   $id_pedido);
                $objConn->update('pedido', $updateData);

                
                $pedido_actualizado= $objConn->rowsChanged;

                if($pedido_actualizado == 1)
                {
                    //insert en la tabla detalle_pedido
                    $insertDet["id_pedido"] = $id_pedido;
                    $insertDet["id_estado"] = 8;
                    $insertDet["fecha"] = $fecha_act; 
                    $insertDet["hora"] = $hora; 
                    $objConn->insert('detalle_pedido', $insertDet);

                     $id_pedido_detalle= $objConn->lastInsertId;
                }
                else 
                {
                    ?>
                        <script type="text/javascript">alert("No se pudo actualizar el pedido")
                        window.history.back();
                        </script>
                    <?
                }
            }


            if(isset($_POST["entregar"]) && $_POST["entregar"]== "Entregar")
            {

                $updateData["id_estado"] = 9; 
                $objConn->where("id", $id_pedido);
                $objConn->update('pedido', $updateData);

                $pedido_actualizado= $objConn->rowsChanged;
                if($pedido_actualizado == 1)
                {
                    //insert en la tabla detalle_pedido
                    $insertDet["id_pedido"] =  $id_pedido;
                    $insertDet["id_estado"] = 9;
                    $insertDet["fecha"] = $fecha_act; 
                    $insertDet["hora"] = $hora; 
                    $objConn->insert('detalle_pedido', $insertDet);

                     $id_pedido_detalle= $objConn->lastInsertId;
                }
                else 
                {
                    ?>
                        <script type="text/javascript">alert("No se pudo actualizar el pedido")
                        window.history.back();
                        </script>
                    <?
                }

            }
        }       
    
        ?>
        <script type="text/javascript">
        
            function alertaPedido(id) 
            {
                
                var id = id;
                swal({
                        title:"Pedido con el id:" + id +"ha sido gestionado",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Pedido actualizado!",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("", "", "success");
                        location.href="gestion_pedido_detalle.php?id_usuario=<? echo $id_usuario ?>";
                    } 
                });
                    
            }
                
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
                    <h1 class="page-title"> Gestion pedido
                        <small>Gestion de pedidos </small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="gestion_pedido.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Gestion pedido</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Gestion pedido</span>
                            </li>
                        </ul>
                        
                    <!-- END PAGE HEADER-->
                    </div>
                    <div class="portlet light">
                        <div class="portlet-body form">
                            <div class="form-body">
                                    <?
                                    $i = 0;
                                    foreach($result1 as $item)
                                        {
                                        ?>
                                            <form role="form" class="form-horizontal" name="gestion_pedido_detalle<?echo $i?>"  id="gestion_pedido_detalle<?echo $i?>" action="gestion_pedido_detalle.php" enctype="multipart/form-data" method="post">
                                                <div class="form-group form-md-line-input">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-md-4 well well-lg">
                                                        <div class="col-md-3" align="center">
                                                                <img src="<? echo 'usuarios/'.$item["id_usuario"].'/perfil/'.'mid_perfil.jpg'?>" class="img-responsive pic-bordered">
                                                        </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <label class="control-label"><?php echo nombre_usuario( $item['id_usuario'] ) ?></label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="control-label"><?

                                                                        $objConn->where("id", $item["id_producto"]);
                                                                        $producto =  $objConn->select("producto"); 
                                                                        echo $producto[0]['nombre'];
                                                                        echo " "."-"." ";
                                                                        echo $item['cantidad'];  ?>
                                                                    </label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="control-label"><?php 
                                                                        $objConn->where("id", $item["forma_adquisicion"]);
                                                                        $forma_adquisicion =  $objConn->select("forma_adquisicion"); 
                                                                        echo $forma_adquisicion[0]['descripcion']; ?>
                                                                        
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row">
                                                                    <label class="control-label"><?php echo  $item['id']  ?></label>
                                                                </div>
                                                                <div class="row"></div>
                                                                <div class="row">
                                                                    <?
                                                                    if($item['forma_adquisicion']== 1 || $item['forma_adquisicion']== 4 )
                                                                    {
                                                                        ?>
                                                                            <input class="btn  btn-circle purple" name="despachar" type="submit" id="despachar" value="Despachar" onclick="alertaPedido(<? echo $item['id'] ?>)">
                                                                            <input type="hidden" id="id_pedido" name="id_pedido" value="<? echo $item['id'] ?>" />
                                                                            <input type="hidden" id="forma_ad" name="forma_ad" value="<? echo $item['forma_adquisicion'] ?>" />
                                                                            <input type="hidden" id="formulario" name="formulario" value="gestion_pedido_detalle"/>
                                                                             
                                                                                
                                                                             
                                                                        <?
                                                                    }
                                                                    else if ($item['forma_adquisicion']== 2 || $item['forma_adquisicion']== 3 )
                                                                    {
                                                                        ?>
                                                                            <input class="btn  btn-circle purple" name="entregar" type="submit" id="entregar" value="Entregar" onclick="alertaPedido(<? echo $item['id'] ?>)">
                                                                            <input type="hidden" id="id_pedido" name="id_pedido" value="<? echo $item['id'] ?>" />
                                                                            <input type="hidden" id="forma_ad" name="forma_ad" value="<? echo $item['forma_adquisicion'] ?>" />
                                                                            <input type="hidden" id="formulario" name="formulario" value="gestion_pedido_detalle"/>
                                                                           
                                                                                
                                                                        <?
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-lg-4"></div>
                                                </div> 
                                                <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario ?>" />
                                            </form>
                                        <?
                                            $i++;
                                        }

                                        //echo "<pre>"; print_r($GLOBALS); echo "</pre>";
                                     ?>
                            </div>
                                     
                                    ?>
                                   
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