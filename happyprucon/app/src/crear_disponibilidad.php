<?php
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once'../../externo/plugins/PDOModel.php';
	require'../class/sessions.php';
	$objSe = new Sessions();
	$objSe->init();

	$usu_id = isset($_SESSION['id']) ? $_SESSION['id'] : null ;
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
		
		include "include_css.php";
		
		?>
		<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <script>
        function alertadisponibilidadCreada() 
        {
            var id_producto=<?echo $id_producto?>;
            if(id_producto >=1)
            {
                        swal({
                                title:"Producto registrado con el id:" + <? echo $id_producto?>,
                                text: "¿Desea crear la disponibilidad al producto?",
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
                                swal("Ir", "En un momento sera dirigido a la pagina para crear disponibilidades.", "success");
                                //location.href="gestion_disponibilidad.php?id_producto="+<? echo $id_producto?>;
                            } else {
                                swal("Cancelar","se cancelo la creacion de la disponibilidad del producto");
                                location.href="gestion_producto.php"
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
							<form role="form" class="form-horizontal" name="crear_disponibilidad"  id="crear_disponibilidad" action="crear_disponibilidad.php" enctype="multipart/form-data" method="post">
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        <label class="control-label col-md-4">Seleccione la vigencia de la disponibilidad</label>
											<div class="col-md-4">
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control" readonly="" name="datepicker" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div><span id="datepicker-error" class="help-block help-block-error"></span>
                                                    <!-- /input-group -->
                                                    <span class="help-block"> seleccione la fecha de inicio</span>
                                            </div>
											
											<div class="col-md-4">
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control" readonly="" name="datepicker" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div><span id="datepicker-error" class="help-block help-block-error"></span>
                                                    <!-- /input-group -->
                                                    <span class="help-block"> seleccione la fecha de fin </span>
                                            </div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
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
			<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
			
			
    </body>

</html>