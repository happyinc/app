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
	<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />	
        <?

        if(isset($_GET["eliminar"]) && $_GET["eliminar"] >= 1 && $id_usuario != "")
            {
                
                $objConn = new PDOModel();
                $updateData["id_estado"] = 2;
                $objConn->where("id",$_GET["eliminar"]);
                $objConn->update('producto', $updateData);

                $producto_eliminado= $objConn->rowsChanged;
                if($producto_eliminado < 1){
                    ?>
                        <script type="text/javascript">alert("EXITO: Producto Eliminado Satisfactoriamente");</script>
                    <?
                }

            }
        ?>
		<?
		$objProd = new PDOModel();
		$objProd->andOrOperator = "AND";
		$objProd->where("id_estado", 1);
		$objProd->where("id_usuario", $id_usuario);
		$producto =  $objProd->select("producto");

        if ( isset($_GET["anular"]) && $_GET["anular"] != '')
        {
                                                                
           $updateData["id_estado"] = 2; 
           $objProd->where("id_producto", $_GET["anular"] );
           $objProd->update('producto_disponibilidad', $updateData);
           $disponibilidad_eliminado= $objProd->rowsChanged;
           if($disponibilidad_eliminado > 1)
            {
                ?><script type="text/javascript">
                    alert("ERROR: No se elimino la disponibilidad del producto");</script>
                <?
            }
        }
       
		?>
		<script>
		function eliminarDisponibilidad(id)
		  	{
                 var id = id
		  		swal({
						title:"¿Desea eliminar la disponibilidad del producto:"+id+"?",
						text: "",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						confirmButtonText: "Si, deseo hacerlo!",
						cancelButtonText: "No",
						closeOnConfirm: false,
						closeOnCancel: false
				},
				function(isConfirm) 
				{
					if (isConfirm) {
						swal("Ir", "La disponibilidad ha sido eliminada del producto", "success");
						location.href="gestion_producto.php?id_usuario=<? echo $id_usuario ?>";
					}
					else 
                    {
						swal("Cancelar","se cancelo la eliminacion de la disponibilidad del producto");
						location.href="gestion_producto.php?id_usuario=<? echo $id_usuario ?>";
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
                    <h1 class="page-title"> Gestion del producto
                        <small>Gestion de los productos</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="gestion_pedido.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Gestion del producto</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Gestion de los productos</span>
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
											<a href="../src/crear_producto.php?id_usuario=<? echo $id_usuario?>"><i class="fa fa-plus-circle fa-5x" style="color:gray" aria-hidden="true"></i></a>
										</div>
										<div class="col-md-9 col-lg-9 col-xs-8 col-sm-8">
											Crear Bien o Servicio
										</div>
									</div>
									<?php
									foreach($producto as $item)
										{
											?>
											<div class="form-group form-md-line-input">
												<div class="col-md-3 col-lg-3 col-xs-2 col-sm-2">

													<div class="fileinput-new thumbnail img-circle" style="width: 150px; height: 150px;">
                                                        <a href="../src/editar_producto.php?id_usuario=<? echo $id_usuario?>&id_producto=<? echo $item["id"]?>"><img src="<? echo "usuarios/".$id_usuario."/bienes/".$item["id"]."/res_producto.jpg"?>" alt="">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn purple-studio">Editar</div> </a>

													</div>
												</div>
												<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
													<?php echo $item["nombre"]?><br>
													<?php echo $item["descripcion"]?><br>
													<?php echo "$ ".$item["precio"]?>
												</div>
												<div class="col-md-3 col-lg-3 col-xs-2 col-sm-2">
													<?php
													
													$objProd->where("id_producto", $item["id"]);
													$relacion =  $objProd->select("producto_disponibilidad");
													$result=$objProd->totalRows;
													if($relacion[0]["id_estado"]==1)
													{
														?>
                                                        
                                                        <a  href="gestion_producto.php?id_usuario=<? echo $id_usuario?>&anular=<? echo $item["id"] ?>" onclick="eliminarDisponibilidad(<? echo $item["id"] ?>);">
                                                            <i class="fa fa-toggle-on fa-4x" style="color:green" aria-hidden="true"></i></a>
                                                         <?php
                                                    }
													else if($result <= 0 || $relacion[0]["id_estado"]==2)
													{
														?><a  href="../src/crear_disponibilidad.php?id_usuario=<? echo $id_usuario?>&id_producto=<? echo $item["id"]?>">
															<i class="fa fa-toggle-off fa-4x" style="color:red" aria-hidden="true"></i></a>
                                                    <?php
													}
													?>
												</div>
                                                <input type="hidden" id="id_producto" name="id_producto" value="<? echo $item["id"] ?>" />
                                                <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo  $item["id_usuario"] ?>" />
											</div><?php
										}
										?>
									<input type="hidden" id="formulario" name="formulario" value="gestion_producto"/>
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
			<script src="../assets/pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
    </body>

</html>