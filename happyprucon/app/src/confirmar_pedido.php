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
    <link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAOTpZg3Uhl0AItmrXORFIsGfJQNJiLHGg" type="text/javascript"></script>
    
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

        // poceso para confirmar el pedido

        if(isset($_POST["formulario"]) && $_POST["formulario"] == "confirmar_pedido")
        {
            $fecha = date("Y-m-d H:i:s");
            $fecha1 = explode(" ", $fecha);
            $fecha_act=$fecha1[0];
            $hora=$fecha1[1];


            $objConn = new PDOModel();

            // si el pedido va con domicilio
            if($_POST['forma_adquisicion']==1 || $_POST['forma_adquisicion']==4)
            {
                if ($_POST['direccion'] != "" && $_POST['tipodom'] != "" && $_POST['descripcion'] != "")
                {
                    ?>
                         <script type="text/javascript">alert("campos no estan vacios") </script><?
                    //se realiza el insert en la tabla ubicacion_cliente
                    $insertUbi["id_usuario"] = $usu_id;
                    $insertUbi["direccion"] = $_POST['direccion'];
                    $insertUbi["latitud"] = $_POST['latitud'];
                    $insertUbi["longitud"] = $_POST['longitu'];
                    $insertUbi["fecha"] = $fecha;
                    $insertUbi["detalle_direccion"] = $_POST['tipodom'];
                    $insertUbi["descripcion"] = $_POST['descripcion'];
                    $objConn->insert('ubicaciones_cliente', $insertUbi);
                    $errorubi=$objConn->error;

                    
                         
                    $id_ubicacion= $objConn->lastInsertId;

                }
                else
                {
                     $id_ubicacion= $_POST['ubicacion'];

                }

                $updateData["id_zona"] = $_POST["zona"]; 
                $updateData["id_estado"] = 5;
                $updateData["forma_adquisicion"] = $_POST["forma_adquisicion"];
                $updateData["id_ubicacion_cliente"] = $id_ubicacion;
                $updateData["precio"] = $_POST["total"];
                $objConn->where("id", $id_pedido);
                $objConn->update('pedido', $updateData);
            }

            else
            {

                //actualizacio en la tabla pedido si el pedido no contiene domicilio
                
                $updateData["id_estado"] = 5;
                $updateData["forma_adquisicion"] = $_POST["forma_adquisicion"];
                $updateData["precio"] = $_POST["total"];
                $objConn->where("id", $id_pedido);
                $objConn->update('pedido', $updateData);
            }
            

            $pedido_actualizado= $objConn->rowsChanged;

            if($pedido_actualizado == 1)
                {
                    //insert en la tabla detalle_pedido
                    $insertDet["id_pedido"] = $id_pedido;
                    $insertDet["id_estado"] = 5;
                    $insertDet["fecha"] = $fecha_act; 
                    $insertDet["hora"] = $hora; 
                    $objConn->insert('detalle_pedido', $insertDet);

                     $id_pedido_detalle= $objConn->lastInsertId;


                     //////////////////////////
                     // insert en la tabla ticket
                    $insertTicket["fecha_i"] = $fecha;
                    $insertTicket["id_usuario_o"] = $usu_id;
                    $insertTicket["id_usuario_d"] = $producto[0]['id_usuario'];
                    $insertTicket["id_pedido"] = $id_pedido; 
                    $insertTicket["estado"] = 1;
                    $objConn->insert('ticket', $insertTicket);
                    $id_ticket= $objConn->lastInsertId;

                    //se consulta en la tabla producto_disponibilidad
                    $objConn->andOrOperator = "AND";
                    $objConn->where("id_estado", 1);
                    $objConn->where("id_producto", $id_producto);
                    $disponibilidad =  $objConn->select("producto_disponibilidad");
                    

                    // se calcula el nuevo valor para la cantidad disponible y la cantidad despachada;
                    $cantidad_disponible=$disponibilidad[0]['cantidad_disponible'] - $pedido[0]['cantidad'];
                    $cantidad_pedida=$disponibilidad[0]['cantidad_despachada'] + $pedido[0]['cantidad'];

                     // actualizar tabla producto_disponibilidad 
                    $updateProd["cantidad_disponible"] = $cantidad_disponible; 
                    $updateProd["cantidad_despachada"] = $cantidad_pedida;
                    $objConn->where("id_producto", $id_producto);
                    $objConn->update('producto_disponibilidad', $updateProd);
                    
                }
        }

        ?>
           <script type="text/javascript">
        
            //funcion que oculta y muestra div teniendo en cuenta la opcion seleccionada por el usuario
            function mostrarReferencia(id){

                var id_disponibilidad = id;
              
                if(id_disponibilidad == 1 || id_disponibilidad == 4 ) {
                    document.getElementById('dat_com').style.display='block';
                } 
                else{
                    document.getElementById('dat_com').style.display='none';
                }
                  
            } 


          /*  function alertaPedidoCofirmado() 
        {
            var id_pedido=<?echo $id_pedido?>;
            if(id_pedido >=1)
            {
                        swal({
                                title:"El pedido con el id:" + <? echo $id_pedido?>,
                                text: "Ha sido confirmado",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Si, deseo hacerlo!",
                                cancelButtonText: "No",
                                closeOnConfirm: false,
                                closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                swal("", "", "success");
                                location.href="estado_pedido.php?id_pedido="+<? echo $id_pedido?>;
                            } 
                        });
            }
        }*/
   
        </script>
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md"  ><!-- onload="alertaPedidoCofirmado()"-->
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
                            <form role="form" class="form-horizontal" name="confirmar_pedido"  id="confirmar_pedido" action="confirmar_pedido.php" enctype="multipart/form-data" method="post">
                                <div class="form-body">
                                   <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Seleccione la forma de adquisicion</label>
                                                 <!--<div class="input-group">
                                                    <div class="icheck-list">-->
                                                    <div class="radio-list">
                                                        <?
                                                            $result3 =  $objProd->executeQuery("SELECT A. id_disponibilidad, B. id_forma_adquisicion, C.* FROM producto_disponibilidad A, disponibilidad_forma_adquisicion B, forma_adquisicion C WHERE A. id_producto= '".$id_producto."' and A.id_disponibilidad = B.id_disponibilidad and B.id_forma_adquisicion = C.id;");
                                                            foreach ($result3 as $key) 
                                                                {?>
                                                                    <label> <input type="radio" id="forma_adquisicion" name="forma_adquisicion" value="<?php echo $key["id"]?>" data-title="si" onclick="mostrarReferencia(<?php echo $key["id"]?>);"/><? echo $key["descripcion"]?></label>
                                                                  <!--<label>
                                                                    <input type="radio" name="forma_adquisicion" id="forma_adquisicion" class="icheck" data-radio="iradio_line-purple" data-label="<?echo $key["descripcion"]?>" style="position: absolute; opacity: 0;"  value="<?php echo $key["id"]?>" onclick="mostrarReferencia(<?php echo $key["id"]?>);">
                                                                  </label>-->
                                                                <?
                                                                }?>
                                                        </div>
                                                    <!--</div>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div id="dat_com" style="display:none;" >
                                        <div class="form-group form-md-line-input">
                                            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                    <script type="text/javascript">
                                                        function initialize() {
                                                            var options = {
                                                            types: ['(regions)'],
                                                            componentRestrictions: {country: "co"}
                                                            };
                                                            var input = document.getElementById('ciudad');
                                                            var autocomplete = new google.maps.places.Autocomplete(input , options);
                                                        }
                                                        google.maps.event.addDomListener(window, 'load', initialize);


                                                        var mostrarUbicacion = function() {
                                                            var ciudade;
                                                            ciudade = document.getElementById('resciu').value = document.getElementById('ciudad').value;
                                                            var dir;
                                                            dir = document.getElementById('resdir').value = document.getElementById('direccion').value;

                                                            var ubica = ciudade+","+dir;
                                                            // Creamos el objeto geodecoder
                                                            var geocoder = new google.maps.Geocoder();

                                                            address = document.getElementById('search').value=ubica;
                                                            if (address != '') 
                                                            {
                                                                // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
                                                                geocoder.geocode({'address': address}, function (results, status) {
                                                                    if (status == 'OK') 
                                                                    {
                                                                        // Mostramos las coordenadas obtenidas en el p con id coordenadas
                                                                        document.getElementById('latitud').value = results[0].geometry.location.lat();
                                                                        document.getElementById('longitu').value = results[0].geometry.location.lng();
                                                                    }
                                                                });
                                                            }
                                                        }
                                                    </script>
                                                        <?
                                                            $objUbicacion = new PDOModel();
                                                            $objUbicacion->where("id_usuario", $usu_id);
                                                            $objUbicacion->columns = array("count(*) direccion");
                                                            $cuentaTotal =  $objUbicacion->select("ubicaciones_cliente");
                                                            foreach ($cuentaTotal as $cuentaTot)
                                                            {
                                                                    foreach ($cuentaTot as $cuentaTo)
                                                                    {
                                                                        $cuenta= $cuentaTo;
                                                                    }
                                                            }

                                                             if ($cuenta > 0)
                                                             {
                                                               ?><div class="form-group">
                                                                    <div class="input-icon">
                                                                         <i class="fa fa-map-signs"></i> 
                                                                           <select class="form-control" id="ubicacion" name="ubicacion"> 
                                                                        <?

                                                                            $objUbicacion->where("id_usuario", $usu_id);
                                                                            $result4 =  $objUbicacion->select("ubicaciones_cliente");
                                                                            foreach ($result4 as $key) 
                                                                            {
                                                                                ?>
                                                                                   <option value="<?php echo $key["id"]?>"><?php echo $key["direccion"]?></option>
                                                                                <?
                                                                            }

                                                                         ?>
                                                                         </select>
                                                                     </div>
                                                                 </div>
                                                                 <label class="control-label">Si desea agregar una nueva ubicacion, escriba la siguiente informacion</label>

                                                </div>
                                            </div>

                                                                        <div class="form-group form-md-line-input">
                                                                            <label class="col-md-10 col-lg-10 col-xs-12 col-sm-12"></label>
                                                                            <div class="input-group left-addon col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                                                    <span class="required input-group-addon">
                                                                                    <i class="fa fa-flag"></i>
                                                                                    </span>
                                                                                <input class="form-control" name="ciudad" id="ciudad" type="text" size="50" autocomplete="on" placeholder="Ciudad" />
                                                                                <!-- Campo escondido que toma valor de ciudad -->
                                                                                <input type="hidden" name="resciu" id="resciu" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group form-md-line-input">
                                                                            <label class="col-md-10 col-lg-10 col-xs-12 col-sm-12"></label>
                                                                            <div class="input-group left-addon col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                                                    <span class="required input-group-addon">
                                                                                    <i class="fa fa-home"></i>
                                                                                    </span>
                                                                                <select name="tipodom" id="tipodom" class="form-control">
                                                                                    <option value="">Tipo vivienda</option>
                                                                                    <option value="Apartamento">Apartamento</option>
                                                                                    <option value="Casa">Casa</option>
                                                                                    <option value="Oficina">Oficina</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group form-md-line-input">
                                                                            <label class="col-md-10 col-lg-10 col-xs-12 col-sm-12"></label>
                                                                            <div class="input-group left-addon col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                                                    <span class="required input-group-addon">
                                                                                    <i class="fa fa-map-signs"></i>
                                                                                    </span>
                                                                                <input type="text" class="form-control" name="direccion" id="direccion" onchange="mostrarUbicacion();" placeholder="Dirección"/>
                                                                                <span class="help-block"></span>
                                                                                <!-- Campo escondido que toma valor de direccion -->
                                                                                <input type="hidden" name="resdir" id="resdir">
                                                                            </div>
                                                                            <!-- Campos escondidos que toman valores de coordenadas -->
                                                                            <div><input type="hidden" id="search"/></div>
                                                                            <div><input type="hidden" id="latitud" name="latitud"/></div>
                                                                            <div><input type="hidden" id="longitu" name="longitu"/></div>
                                                                        </div>


                                                                        <div class="form-group form-md-line-input">
                                                                            <label class="col-md-10 col-lg-10 col-xs-12 col-sm-12"></label>
                                                                            <div class="input-group left-addon col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                                                    <span class="required input-group-addon">
                                                                                    <i class="fa fa-location-arrow"></i>
                                                                                    </span>
                                                                                    <textarea class="form-control" rows="2" name="descripcion" id="descripcion"  placeholder="Descripcion de la direccion"></textarea>
                                                                                <span class="help-block"></span>
                                                                            </div>
                                                                        </div>



                                                            <?
                                                            }

                                                            else if ($cuenta <= 0)
                                                            {
                                                                ?>
                                                                     <label class="control-label">Escriba la informacion de su ubicacion</label>

                                                </div>
                                            </div>

                                                                        <div class="form-group form-md-line-input">
                                                                            <label class="col-md-10 col-lg-10 col-xs-12 col-sm-12"></label>
                                                                            <div class="input-group left-addon col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                                                    <span class="required input-group-addon">
                                                                                    <i class="fa fa-flag"></i>
                                                                                    </span>
                                                                                <input class="form-control" name="ciudad" id="ciudad" type="text" size="50" autocomplete="on" placeholder="Ciudad" />
                                                                                <!-- Campo escondido que toma valor de ciudad -->
                                                                                <input type="hidden" name="resciu" id="resciu" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group form-md-line-input">
                                                                            <label class="col-md-10 col-lg-10 col-xs-12 col-sm-12"></label>
                                                                            <div class="input-group left-addon col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                                                    <span class="required input-group-addon">
                                                                                    <i class="fa fa-home"></i>
                                                                                    </span>
                                                                                <select name="tipodom" id="tipodom" class="form-control">
                                                                                    <option value="">Tipo vivienda</option>
                                                                                    <option value="Apartamento">Apartamento</option>
                                                                                    <option value="Casa">Casa</option>
                                                                                    <option value="Oficina">Oficina</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group form-md-line-input">
                                                                            <label class="col-md-10 col-lg-10 col-xs-12 col-sm-12"></label>
                                                                            <div class="input-group left-addon col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                                                    <span class="required input-group-addon">
                                                                                    <i class="fa fa-map-signs"></i>
                                                                                    </span>
                                                                                <input type="text" class="form-control" name="direccion" id="direccion" onchange="mostrarUbicacion();" placeholder="Dirección"/>
                                                                                <span class="help-block"></span>
                                                                                <!-- Campo escondido que toma valor de direccion -->
                                                                                <input type="hidden" name="resdir" id="resdir">
                                                                            </div>
                                                                            <!-- Campos escondidos que toman valores de coordenadas -->
                                                                            <div><input type="hidden" id="search"/></div>
                                                                            <div><input type="hidden" id="latitud" name="latitud"/></div>
                                                                            <div><input type="hidden" id="longitu" name="longitu"/></div>
                                                                        </div>


                                                                        <div class="form-group form-md-line-input">
                                                                            <label class="col-md-10 col-lg-10 col-xs-12 col-sm-12"></label>
                                                                            <div class="input-group left-addon col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                                                                    <span class="required input-group-addon">
                                                                                    <i class="fa fa-location-arrow"></i>
                                                                                    </span>
                                                                                    <textarea class="form-control" rows="2" name="descripcion" id="descripcion"  placeholder="Descripcion de la direccion"></textarea>
                                                                                <span class="help-block"></span>
                                                                            </div>
                                                                        </div>

                                                                <?
                                                            }
                                                        ?>
                                                    
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
                                            <label class="control-label">Valor del producto </label>
                                             <label class="control-label"><?php echo $producto[0]['precio'] ?></label>
                                             
                                         </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        <?
                                            //calculo del total que debe pagar el cliente tniendo en cunta el precio del 
                                            //producto y la cantidad solicitada
                                            $total=  $pedido[0]['cantidad'] * $producto[0]['precio'];?>
                                             <label class="control-label"><b>Total a pagar     </b></label>
                                             <label class="control-label"><?php echo $total ?></label>
                                         </div>
                                    </div>
                                    
                                    <div class="form-group form-md-line-input">
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
                                                            $cuentaTar= $cuentaTo;
                                                        }
                                                    }

                                                    if ($cuentaTar > 0)
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
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="btn purple" name="crear" type="button" id="crear" value="Agregar" href="crear_tarjeta.php?id_usuario=<? echo $usu_id ?>">
                                                        </div>
                                                        <?
                                                    }

                                                    else if ($cuentaTar <= 0)
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
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <input class="btn red" name="confirmar" type="submit" id="confirmar" value="Confirmar pedido">
                                            <input type="hidden" id="id_pedido" name="id_pedido" value="<? echo  $id_pedido ?>" />
                                            <input type="hidden" id="total" name="total" value="<? echo  $total ?>" />
                                            <input type="hidden" id="formulario" name="formulario" value="confirmar_pedido"/>
                                        </div>
                                    </div>
                                    <?//echo "<pre>";print_r($GLOBALS); echo "<pre>"; ?>
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
            <script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script> 
            <script src="../assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>


    </body>

</html>