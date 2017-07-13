
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
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
	
	date_default_timezone_set("America/Bogota");
	
	include "include_css.php";
	require_once'../../externo/plugins/PDOModel.php';

		?>
		<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>	
		<?
		$objProd = new PDOModel();
		$objProd->where("id_usu_crea", $usu_id);
		$producto =  $objProd->select("producto");

        $accion=$_POST["accion"];
		if(isset($_POST["formulario"]) && $_POST["formulario"] == "editar_producto" )
		{

			if(isset($accion) && $accion== "Editar")
			{
					if($_FILES['foto']["size"]>=1)
					{
						 // Primero, hay que validar que se trata de un JPG/GIF/PNG
						$allowedExts = array("jpg", "jpeg", "gif", "png", "bmp", "JPG", "JPEG", "GIF", "PNG", "BMP");
						$extension = end(explode(".", $_FILES["foto"]["name"]));
						if ((($_FILES["foto"]["type"] == "image/gif")
								|| ($_FILES["foto"]["type"] == "image/jpeg")
								|| ($_FILES["foto"]["type"] == "image/png")
								|| ($_FILES["foto"]["type"] == "image/gif")
								|| ($_FILES["foto"]["type"] == "image/bmp"))
								&& in_array($extension, $allowedExts)) 
						{
							// el archivo es un JPG/GIF/PNG, entonces...
							$extension = end(explode('.', $_FILES['foto']['name']));
							$foto = "producto".".".$extension;
							$directorio = "usuarios/".$usu_id."/bienes/".$id_producto.""; // directorio de tu elección
							if(file_exists($directorio)) 
							{
												
							} 
							else 
							{
								mkdir($directorio, 0777, true);
							}
							// almacenar imagen en el servidor
							move_uploaded_file($_FILES['foto']['tmp_name'], $directorio.'/'.$foto);
							$minFoto = 'min_'.$foto;
							$resFoto = 'res_'.$foto;
							resizeImagen($directorio.'/', $foto, 65, 65,$minFoto,$extension);
							resizeImagen($directorio.'/', $foto, 500, 500,$resFoto,$extension);
							unlink($directorio.'/'.$foto);
						} else 
						{ // El archivo no es JPG/GIF/PNG
							$malformato = $_FILES["foto"]["type"];
							?>
							<script type="text/javascript">
							alert("La imagen se encuentra con formato incorrecto")
							window.history.back();
							</script>
							<?	
						}
					} 
			}
			
		}		
		  
		####
		## Función para redimencionar las imágenes
		## utilizando las librerías de GD de PHP
		####

		function resizeImagen($ruta, $nombre, $alto, $ancho,$nombreN,$extension){
			$rutaImagenOriginal = $ruta.$nombre;
			if($extension == 'GIF' || $extension == 'gif'){
			$img_original = imagecreatefromgif($rutaImagenOriginal);
			}
			if($extension == 'jpg' || $extension == 'JPG'){
			$img_original = imagecreatefromjpeg($rutaImagenOriginal);
			}
			if($extension == 'png' || $extension == 'PNG'){
			$img_original = imagecreatefrompng($rutaImagenOriginal);
			}
			if($extension == 'bmp' || $extension == 'BMP'){
			$img_original = imagecreatefrombmp($rutaImagenOriginal);
			}
			if($extension == 'jpeg' || $extension == 'JPEG'){
			$img_original = imagecreatefromjpeg($rutaImagenOriginal);
			}
			$max_ancho = $ancho;
			$max_alto = $alto;
			list($ancho,$alto)=getimagesize($rutaImagenOriginal);
			$x_ratio = $max_ancho / $ancho;
			$y_ratio = $max_alto / $alto;
			if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
			$ancho_final = $ancho;
				$alto_final = $alto;
			} elseif (($x_ratio * $alto) < $max_alto){
				$alto_final = ceil($x_ratio * $alto);
				$ancho_final = $max_ancho;
			} else{
				$ancho_final = ceil($y_ratio * $ancho);
				$alto_final = $max_alto;
			}
			$tmp=imagecreatetruecolor($ancho_final,$alto_final);
			imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
			imagedestroy($img_original);
			$calidad=70;
			imagejpeg($tmp,$ruta.$nombreN,$calidad);
			
		}
		?>
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md" onload="alertaProducto()" >
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
                    <h1 class="page-title"> Crear producto
                        <small>creacion de producto</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Crear producto</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Creacion de productos</span>
                            </li>
                        </ul>
                        
                    <!-- END PAGE HEADER-->
					</div>
					<div class="portlet light">
						<div class="portlet-body form">
							<form role="form" class="form-horizontal" name="gestion_producto"  id="gestion_producto" action="gestion_producto.php" enctype="multipart/form-data" method="post">
								<div class="form-body">
									<div class="form-group form-md-line-input">
										<div class="col-md-3 col-lg-3 col-xs-2 col-sm-2">
											<i class="fa fa-plus-circle fa-5x" aria-hidden="true"></i>
										</div>
										<div class="col-md-9 col-lg-9 col-xs-8 col-sm-8">
											<a href="../src/crear_producto.php"  >Crear Bien o Servicio</a>
										</div>
									</div>
									
									<div class="form-group form-md-line-input">
										<div class="col-md-3 col-lg-3 col-xs-2 col-sm-2">
											
										</div>
										<div class="col-md-9 col-lg-9 col-xs-8 col-sm-8">
											
										</div>
									</div>

									<div class="form-group form-md-line-input">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
											<input type="hidden" id="formulario" name="formulario" value="gestion_producto"/>
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
    </body>

</html>