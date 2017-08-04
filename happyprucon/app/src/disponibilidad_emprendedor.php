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
    /*
	if($rol!=3){
		echo "<script> alert('Usuario no autorizado');
						window.location.assign('logueo.html');</script>";
	}	*/
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


        //informacion de todos los productos del emprendedor
		$objProd = new PDOModel();
        $result =  $objProd->executeQuery("SELECT A.*, B.*  FROM producto A, producto_disponibilidad B WHERE A.id_usuario =  '".$id_usuario."' AND B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1;");

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
                                <a href="gestion_pedido.php">Home</a>
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

							<form role="form" class="form-horizontal" name="disponibilidad_emprendedor"  id="disponibilidad_emprendedor" action="disponibilidad_emprendedor.php" enctype="multipart/form-data" method="post">
								<div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-md-4" align="center">
                                            <div class="mt-widget-1" style=" border: 0px !important;">
                                                <div class="mt-img" style="margin-bottom: 10px !important;">
                                                        <img src="<? echo "usuarios/".$id_usuario."/perfil/res_perfil.jpg"?>" width="150" class="img-circle" style="border-radius: 50%;">  </div>
                                                <div class="mt-body">
                                                    <h3 class="mt-username"><? echo calificacion_usuario($id_usuario); ?></h3>
                                                        <div class="row" style="padding-top: 20px;">
                                                            <label class="font-yellow" style="margin-right: 5px;"><? echo nombre_usuario($id_usuario) ?></label>                                       
                                                        </div>
                                                        <div class="row" style="padding-top: 20px;">

                                                            <label class="font-yellow" style="margin-right: 5px;"><? echo calificacion_usu($id_usuario); ?></label>
                                                            <i class="fa fa-star font-yellow" style="margin-right: 10px;"></i>|

                                                            <label class="font-green" style="margin-left: 10px; margin-right: 5px;"><? echo cantidad_coment_usu($id_usuario); ?></label>
                                                            <i class="fa fa-comments font-green" style="margin-right: 10px;"></i>|

                                                            <label class="font-purple" style="margin-left: 10px; margin-right: 5px;">1,7k</label>
                                                            <i class="fa fa-group font-purple" style="margin-right: 10px;"></i>

                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4"></div>
                                    </div>
                                        </br>
                                    <div class="form-group form-md-line-input">
                                    <?
                                     foreach ($result as $item ) 
                                     {
                                        ?>  
                                            <div class="portlet light portlet-fit ">
                                                <div class="row">
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-md-6" align="center">
                                                        <div class="mt-widget-2" >
                                                            <div class="mt-head" style="background-image: url(<? echo 'usuarios/'.$item['id_usuario'].'/bienes/'.$item['id_producto'].'/res_producto.jpg'?>);" >
                                                                <div class="mt-head-label">
                                                                    <button type="button" class="btn btn-success">$ <?echo number_format($item["precio"],0)?></button>
                                                                </div>
                                                                <div class="mt-head-user" >
                                                                    <div class="mt-head-user-img">
                                                                        <img src="<? echo 'usuarios/'.$item['id_usuario'].'/perfil/'.'/res_perfil.jpg'?>"> </div>
                                                                    <div class="mt-head-user-info" >
                                                                        <span class="mt-user-name"><?echo  nombre_usuario($item["id_usuario"])?></span>
                                                                        <span class="mt-user-time">
                                                                            <i class="fa fa-star"></i><?echo  calificacion_usu($item["id_usuario"])?>  </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-body" >
                                                                <h3 class="mt-body-title" > <?echo $item["nombre"]?> </h3>
                                                                <p class="mt-body-description"> <?echo $item["descripcion"]?> </p>
                                                                <ul class="mt-body-stats">
                                                                    <li class="font-yellow">
                                                                        <i class="fa fa-star" aria-hidden="true"></i> <?echo  calificacion_prod($item["id_producto"])?></li>
                                                                    <li class="font-green">
                                                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?echo $item["cantidad_despachada"]?></li>
                                                                    <li class="font-red">
                                                                        <i class="icon-bubbles" aria-hidden="true"></i> <?echo  cantidad_coment_prod($item["id_producto"])?></li>
                                                                </ul>
                                                                <div class="mt-body-actions">
                                                                    <div class="btn-group btn-group btn-group-justified">
                                                                        <a href="../src/crear_pedido.php?id_producto=<? echo $item["id_producto"]?>" class="btn">Hacer pedido </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="id_producto" name="id_producto" value="<? echo $item["id_producto"] ?>" />
                                            </br></br>
                                        <?     
                                    }?>
                                    </div>
								 </div>
                                <input type="hidden" id="formulario" name="formulario" value="disponibilidad_emprendedor"/>
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