<?php
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once'../../externo/plugins/PDOModel.php';
	require'../class/sessions.php';
	$objSe = new Sessions();
	$objSe->init();

	$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
	$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
	$fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;


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
		$id_producto = "";
    
        if(isset($_POST["id_producto"]) && $_POST["id_producto"] != "")
        {
            $id_producto = $_POST["id_producto"];
        }
        elseif(isset($_GET["id_producto"]) && $_GET["id_producto"] != "")
        {
             $id_producto = $_GET["id_producto"];
        }
        
		include "include_css.php";
		
		?>
        <link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
		
             
        <?php
        $id_disponibilidad=0;
        if(isset($_POST["formulario"]) && $_POST["formulario"] == "crear_disponibilidad")
        {
            // conversion de las fechas para realizar el insert en la tabla
            $varini = explode("-",$_POST["fecha_inicio"]);
            $horaini =$varini[1];
            $fechaini=$varini[0];
            $testini = new DateTime($fechaini);
            $fecini=date_format($testini, 'Y-m-d');
            $fec_inicio= $fecini."". $horaini;

            $varfin = explode("-",$_POST["fecha_fin"]);
            $horafin =$varfin[1];
            $fechafin=$varfin[0];
            $testfin = new DateTime($fechafin);
            $fecfin=date_format($testfin, 'Y-m-d');
            $fec_fin= $fecfin."". $horafin;

            //insert a la tabla disponibilidad
            $objConn = new PDOModel();
                //$insertData["id_tipo_disponibilidad"] = $_POST["categoria"];//pdt cambiar
                $insertData["id_estado"] = 1;
                $insertData["fecha_inicio"] = $fec_inicio;
                $insertData["fecha_fin"] = $fec_fin;
                $insertData["fecha"] = date("Y-m-d H:i:s"); 
                $insertData["id_usuario"] = $usu_id ;
                $objConn->insert('disponibilidad', $insertData);

                $id_disponibilidad= $objConn->lastInsertId;
                //print_r($objConn->error);

                if($id_disponibilidad!= "")
                {
                    //insert a la tabla producto_disponibilidad
                    $insertPd["id_producto"] = $id_producto;
                    $insertPd["id_disponibilidad"] = $id_disponibilidad; 
                    $insertPd["cantidad_disponible"] = $_POST["cantidad_disponible"];
                    $insertPd["id_estado"] = 1;
                    $insertPd["fecha"] = date("Y-m-d H:i:s"); 
                    $objConn->insert('producto_disponibilidad', $insertPd);

                    $id_prod_dis= $objConn->lastInsertId;
                     //insert a la tabla disponibilidad_forma_adquisicion
                    foreach($_POST['forma_adquisicion'] as $clave => $valor)
                        {
                            $insertDf["id_forma_adquisicion"] = $valor;
                            $insertDf["id_disponibilidad"] = $id_disponibilidad;
                            $objConn->insert('disponibilidad_forma_adquisicion', $insertDf);

                             $id_dis_forma= $objConn->lastInsertId;
                        }
                    if($id_prod_dis== "")
                    {
                       ?>
                        <script type="text/javascript">alert("No se pudo asignar la disponibilidad al producto <?echo $id_producto?>")</script>
                        <? 
                    }
                }
                else
                {
                    ?>
                        <script type="text/javascript">alert("No se pudo crear la disponibilidad")</script>
                    <?
                }

        }
        ?>

        <script>
        function alertaDisponibilidadCreada() 
        {
            var id_disponibilidad=<?echo $id_disponibilidad?>;
            if(id_disponibilidad >=1)
            {
                        swal({
                                title:"Se registro la disponibilidad:" + <? echo $id_disponibilidad?>,
                                text: "para el producto:"+<? echo $id_producto?>,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Aceptar",
                                cancelButtonText: "No",
                                closeOnConfirm: false,
                                closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                swal("", "Disponibilidad creada y asignada al producto"+<? echo $id_producto?>, "success");
                                location.href="gestion_producto.php";
                            }
                        });
            }
        }
        </script>
		
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md" onload="alertaDisponibilidadCreada()">
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
                    <h1 class="page-title"> Crear disponibilidad
                        <small>creacion de disponibilidades</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Crear disponibilidad</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Creacion de disponibilidades</span>
                            </li>
                        </ul>
                        
                    <!-- END PAGE HEADER-->
					</div>
					<div class="portlet light">
						<div class="portlet-body form">
							<form role="form" class="form-horizontal" name="crear_pedido"  id="crear_pedido" action="crear_pedido.php" enctype="multipart/form-data" method="post">
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">

                                          </div>
									</div>
									
                                    <div class="form-group">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            
										</div>
									</div>

                                    <div class="form-group">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <button type="submit" class="btn purple" name="guardar" id="guardar" value="guardar"> Realizar pedido </button>
                                            <input type="hidden" id="formulario" name="formulario" value="crear_disponibilidad"/>
                                            <input type="hidden" id="id_producto" name="id_producto" value="<? echo $id_producto ?>" />
                                        </div>
                                    </div>

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
            <!--alertas-->
            <script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
            
	
    </body>

</html>