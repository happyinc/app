<!DOCTYPE html>
<html lang="en">
    <head>  
        <?
            require_once'../../externo/plugins/PDOModel.php';
            require'../class/sessions.php';
            $objSe = new Sessions();
            $objSe->init();
			include "funciones.php";
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
					$fullname = $usuarios["nombre_completo"] ;                                                        
			}
            include("include_css.php");
            include("nombre_cabezera.php");
            include("menu_modal.php");
            
			 $fecha=date("Y-m-d H:i:s");

			//informacion de todos los productos del emprendedor
			$objProd = new PDOModel();
			$result =  $objProd->executeQuery("SELECT A.*, B.*, C.*  FROM producto A, producto_disponibilidad B, disponibilidad C WHERE A.id_usuario = '".$id_usuario."' AND B.id_producto = A.id AND B.cantidad_disponible > 0 AND B.id_estado = 1 AND B.id_disponibilidad= C.id AND '".$fecha."' BETWEEN C.fecha_inicio AND C.fecha_fin;");
		?>
	
        <title><? echo $nombre_pagina ?></title>
        
    </head>
    <!-- END HEAD -->
    <body class="page-header-default page-sidebar-closed-hide-logo page-container-bg-solid" style="text-align: center;background-color:white;" bgcolor="#ffffff">

        <!-- BEGIN HEADER -->
        <div class="">
            <!-- BEGIN HEADER INNER -->
            <?
            include("header.php");
            ?>
            <!-- END HEADER INNER -->
        </div>

        <!-- BEGIN CONTAINER -->
        <div class="page-content" style="text-align: center;background-color:white;">

            <div class="page-wrapper-row full-height" style="text-align: center;background-color:white;">
                <div class="page-wrapper-middle" style="text-align: center;background-color:white;">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container" style="text-align: center;background-color:white;">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper" style="text-align: center;background-color:white;">
                            <!-- BEGIN CONTENT BODY -->
                            <!-- BEGIN PAGE HEAD-->
                            <div class="page-head" style="text-align: center;background-color:white;">
                                <div class="container" style="text-align: center;background-color:white;">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <!--
                                        <h1>Dashboard
                                            <small>dashboard & statistics</small>
                                        </h1>
                                        -->
                                    </div>
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- AQUI EMPIEZA EL CONTENIDO-->
                                                <div class="portlet light ">
                                                    <div class="portlet-body form">

														<form role="form" class="form-horizontal" name="disponibilidad_emprendedor"  id="disponibilidad_emprendedor" action="disponibilidad_emprendedor.php" enctype="multipart/form-data" method="post">
															<div class="form-body">
																<div class="row">
																	<div class="col-lg-4"></div>
																	<div class="col-md-4" align="center">
																		<div class="mt-widget-1" style=" border: 0px !important;">
																			<div class="mt-img" style="margin-bottom: 10px !important;">
																					<img src="<? echo "usuarios/".$id_usuario."/perfil/res_perfil.jpg"?>" width="150" class="img-circle" style="border-radius: 50%;">  
																			</div>
																			<div class="mt-body">
																				<h3 class="mt-username"><? echo calificacion_usuario($id_usuario); ?></h3>
																					<div class="row" style="padding-top: 20px;">
																						<label class="font-yellow" style="margin-right: 5px;"><? echo nombre_usuario_new($id_usuario) ?></label>
																					</div>
																					<div class="row" style="padding-top: 20px;">

																						<label class="font-yellow" style="margin-right: 5px;"><? echo calificacion_usu($id_usuario); ?></label>
																						<i class="fa fa-star font-yellow" style="margin-right: 10px;"></i>|

																						<label class="font-green" style="margin-left: 10px; margin-right: 5px;"><? echo cantidad_coment_usu($id_usuario); ?></label>
																						<i class="fa fa-comments font-green" style="margin-right: 10px;"></i>|

																						<label class="font-purple" style="margin-left: 10px; margin-right: 5px;">1,7k</label>
																						<i class="fa fa-group font-purple" style="margin-right: 10px;"></i>
																					</div>
																					 <div class="row" style="padding-top: 20px;">
																						<p><b>Lo que quiero:</b></p><?
																						/*$pdomodel->where("id", $id_usuario);
																						$pdomodel->columns = array("meta");
																						$result =  $pdomodel->select("usuarios");*/
																						echo  ($usuarios["meta"])?>  </span>
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
																									<span class="mt-user-name"><?echo  nombre_usuario_new($item["id_usuario"])?></span>
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
                                                <!-- AQUI TERMINA EL CONTENIDO -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <!-- END CONTAINER -->

            <!-- BEGIN CORE PLUGINS -->
            <?
            include("include_js.php");
            ?>
    </body>
</html>