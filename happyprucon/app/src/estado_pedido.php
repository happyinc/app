<!DOCTYPE html>
<html lang="en">
    <head>  
        <?
            require_once'../../externo/plugins/PDOModel.php';
            require'../class/sessions.php';
            $objSe = new Sessions();
            $objSe->init();
			include "funciones.php";
			 $usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
			$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
			$fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;
            include("include_css.php");
            include("nombre_cabezera.php");
            include("menu_modal.php");
            
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
                                                <div class="portlet box red">
													<div class="portlet-title">
														<div class="caption">
															<span>Estado pedido</span>
														</div>
													</div>
													<div class="portlet-body form">
														<form role="form" class="form-horizontal" name="estado_pedido"  id="estado_pedido" action="estado_pedido.php" enctype="multipart/form-data" method="post">
															<div class="form-body">
																<div class="form-group form-md-line-input">
																	<div class="col-lg-4"></div>
																		<div class="col-md-4" align="center">
																			<img src="<? echo 'usuarios/'.$producto[0]['id_usuario'].'/bienes/'.$producto[0]['id'].'/res_producto.jpg'?>" class="img-responsive pic-bordered">
																		</div>
																	<div class="col-lg-4"></div>
																</div>

															   <div class="form-group form-md-line-input">
																	<div class="col-lg-4"></div>
																	<div class="col-md-4">
																		<label class="control-label">Precio: $</label>
																		 <label class="control-label"><?php echo $pedido[0]['precio'] ?></label>
																	</div>
																	<div class="col-lg-4"></div>
																</div>

																<div class="form-group form-md-line-input">
																   <div class="col-lg-4"></div>
																		 <div class="col-md-4">
																		<label class="control-label">Nombre del plato: </label>
																	</div>
																	<div class="col-lg-4"></div>
																</div>
																
																<div class="form-group form-md-line-input">
																	<div class="col-lg-4"></div>
																	<div class="col-md-4">
																		<label class="control-label">Cantidad: </label>
																		 <label class="control-label"><?php echo $pedido[0]['cantidad'] ?></label>
																		 
																	</div>
																	<div class="col-lg-4"></div>
																</div>

																
															  
															  <div class="form-group form-md-line-input">
																	<div class="col-lg-4"></div>
																	<div class="col-md-4">
																		<label class="control-label">Direccion:</label>
																		<?
																			$objDir = new PDOModel();
																			$objDir->where("id",  $pedido[0]['cantidad']);
																			$direccion =  $objDir->select("ubicaciones_cliente");
																		?>
																		 <label class="control-label"><?php echo $direccion[0]['direccion'] ?></label>
																		 
																	</div>
																	<div class="col-lg-4"></div>
																</div>

																<div class="form-group form-md-line-input">
																	<div class="col-lg-4"></div>
																	<div class="col-md-4">
																		<label class="control-label">Estado: </label>
																		<?php
																			$objEst = new PDOModel();
																			$objEst->where("id",  $pedido[0]['id_estado']);
																			$estado =  $objEst->select("estado");
																		?>

																		 <label class="control-label"><?php echo $estado[0]['descripcion'] ?></label>
																		 
																	</div>
																	 <div class="col-lg-4"></div>
																</div>

																<div class="form-actions">
																	<div class="col-lg-4"></div>
																	<div class="col-md-4"  align="center">
																		<a href="main.php"><input  name="navegar" type="button" class="btn btn-circle red" id="navegar" value="Seguir navegando" /></a>
																		<input type="hidden" id="formulario" name="formulario" value="estado_pedido"/>
																	</div>
																	<div class="col-md-4"></div>
																</div>
															</div>
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