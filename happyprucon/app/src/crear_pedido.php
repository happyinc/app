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
    ?>
     <link href="../assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
     <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
        <script type="text/javascript">
        
            //funcion que oculta y muestra div teniendo en cuenta la opcion seleccionada por el usuario
            function mostrarReferencia(){
                if (document.crear_pedido.forma_adquisicion[1].checked == true || document.crear_pedido.forma_adquisicion[4].checked == true) {
                    document.getElementById('dat_com').style.display='block';
                } 
                else if (document.crear_pedido.forma_adquisicion[1].checked == false || document.crear_pedido.forma_adquisicion[4].checked == false){
                    document.getElementById('dat_com').style.display='none';
                }
                
                else {
                    document.getElementById('dat_com').style.display='none';
                }   
            }    
        </script>
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

        // insert del producto
        ?>
       
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
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Seleccione la forma de adquisicion</label>
                                                <div class="input-group">
                                                    <div class="icheck-list">
                                                        <?
                                                            $result3 =  $objProd->executeQuery("SELECT A. id_disponibilidad, B. id_forma_adquisicion, C.* FROM producto_disponibilidad A, disponibilidad_forma_adquisicion B, forma_adquisicion C WHERE A. id_producto= '".$id_producto."' and A.id_disponibilidad = B.id_disponibilidad and B.id_forma_adquisicion = C.id;");
                                                            foreach ($result3 as $key) 
                                                                {?>
                                                                  <label>
                                                                    <input type="radio" name="forma_adquisicion" id="forma_adquisicion[<?php echo $key["id"]?>]" class="icheck" data-radio="iradio_line-purple" data-label="<?echo $key["descripcion"]?>" style="position: absolute; opacity: 0;"  value="<?php echo $key["id"]?>" onclick="mostrarReferencia();">
                                                                  </label>
                                                                <?
                                                        }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="dat_com" style="display:none;" >
                                        <div class="form-group form-md-line-input">
                                            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">

                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="input-icon">
                                                     <i class="fa fa-map"></i>
                                                        <select class="form-control" id="zona" name="zona">
                                                         <?
                                                            $objFor = new PDOModel();
                                                            $objFor->where("id_estado", 1);
                                                            $result3 =  $objFor->select("zonas");
                                                            foreach ($result3 as $key) 
                                                            {
                                                                ?>
                                                                   <option value="<?php echo $key["id"]?>"><?php echo $key["descripcion"]?></option>
                                                                <?
                                                            }

                                                         ?>
                                                         </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                        
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                             <label class="control-label"><?echo  "Valor del producto     $".$producto[0]['precio']?></label>
                                         </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <?
                                                $total= $producto[0]['precio'];
                                            ?>
                                             <label class="control-label"><b><?echo  "Total      $".$total?></b></label>
                                         </div>
                                    </div>
                                    
                                    <!-- <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <div class="input-icon">
                                                <i class="fa fa-credit-card-alt"></i>
                                                <label class="control-label">Seleccione el metodo de pago</label>
                                                
                                                <?
                                                    $objTarjeta = new PDOModel();
                                                    $objTarjeta->where("id_usuario", $usu_id);
                                                    $objTarjeta->columns = array("count(*) tarjeta");
                                                    $cuentaTotal =  $objTarjeta->select("usuarios_pagos");
                                                    foreach ($cuentaTotal as $cuentaTot)
                                                    {
                                                        foreach ($cuentaTot as $cuentaTo)
                                                        {
                                                            $cuenta= $cuentaTo;
                                                        }
                                                    }

                                                    if ($cuenta > 0)
                                                    {
                                                        ?>
                                                         <div class="form-group">
                                                            <label class="control-label">Seleccione la tarjeta</label>
                                                            <select class="form-control" id="tarjeta" name="tarjeta">
                                                                    <?
                                                                        $objTarjeta->andOrOperator = "AND";
                                                                        $objTarjeta->where("id_estado", 1);
                                                                        $objTarjeta->where("id_usuario", $usu_id);
                                                                        $info_tarjeta =  $objTarjeta->select("usuarios_pagos");

                                                                        foreach ($info_tarjeta as $key) 
                                                                            {
                                                                                ?>
                                                                                     <option value="<?php echo $item1["id"]?>"><?php echo "******".$key["tarjeta"]?></option>
                                                                                <?
                                                                            }
                                                                    ?>
                                                            </select>
                                                            <input class="btn purple" name="crear" type="button" id="crear" value="Agregar" href="crear_tarjeta.php?id_usuario=<? echo $usu_id ?>">
                                                        </div>
                                                        <?
                                                    }

                                                    else if ($cuenta <= 0)
                                                    {
                                                        ?>
                                                        <div class="form-group">
                                                            <input class="btn purple" name="crear" type="button" id="crear" value="Agregar" href="crear_tarjeta.php?id_usuario=<? echo $usu_id ?>">
                                                        </div>
                                                        <?
                                                    }
                                                ?>
                                            </div>  
                                        </div>
                                    </div>-->

                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <input class="btn red" name="pedido" type="submit" id="pedido" value="Realizar pedido">
                                            <input type="hidden" id="id_producto" name="id_producto" value="<? echo  $id_producto ?>" />
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
                                                                                <span class="mt-comment-author"><? echo nombre_usuario($valor['id_usuario']) ;?></span>
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
            <script src="../assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
    </body>

</html>