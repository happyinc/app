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
			?>
			<link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
			<?
            include("nombre_cabezera.php");
            include("menu_modal.php");
            
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

			// insert del pedido
			$id_pedido=0;
			if(isset($_POST["formulario"]) && $_POST["formulario"] == "crear_pedido")
			{
				$fecha = date("Y-m-d H:i:s");
				$fecha1 = explode(" ", $fecha);
				$fecha_act=$fecha1[0];
				$hora=$fecha1[1];

				$objConn = new PDOModel();
				$insertData["id_usuario"] = $usu_id;
				$insertData["id_estado"] = 3;
				$insertData["id_producto"] = $id_producto; 
				$insertData["fecha"] = $fecha;
				$insertData["cantidad"] = $_POST['cantidad_despachada'] ;
				$objConn->insert('pedido', $insertData);

				$id_pedido= $objConn->lastInsertId;

				if ($id_pedido !="")
				{
					$insertDet["id_pedido"] = $id_pedido;
					$insertDet["id_estado"] = 3;
					$insertDet["fecha"] = $fecha_act; 
					$insertDet["hora"] = $hora; 
					$objConn->insert('detalle_pedido', $insertDet);

					 $id_pedido_detalle= $objConn->lastInsertId;
			   
				}

				if($id_pedido =="" || $id_pedido_detalle =="")
				{
						echo  $objConn->error;
				}
			}

		?>
		<script>
			function alertaPedidoCreado() 
			{
				var id_pedido=<?echo $id_pedido?>;
				if(id_pedido >=1)
				{
							swal({
									title:"El pedido ha sido creado con el id:" + <? echo $id_pedido?>,
									text: "¿Desea continuar con la confirmacion del pedido?",
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
									swal("Ir", "En un momento sera dirigido a la pagina para continuar con el pedido.", "success");
									location.href="confirmar_pedido.php?id_pedido="+<? echo $id_pedido?>;
								} else {
									swal("Cancelar","se cancelo la confirmacion del pedido");
									location.href="main.php";
								}
							});
				}
			}
			</script>
        <title><? echo $nombre_pagina ?></title>
        
    </head>
    <!-- END HEAD -->
    <body class="page-header-default page-sidebar-closed-hide-logo page-container-bg-solid" style="text-align: center;background-color:white;" bgcolor="#ffffff" onload="alertaPedidoCreado()">

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
															<span><? echo $producto[0]['nombre']; ?></span>
														</div>
													</div>
													<div class="portlet-body form">
														<form role="form" class="form-horizontal" name="crear_pedido"  id="crear_pedido" action="crear_pedido.php" enctype="multipart/form-data" method="post">
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
																	<div class="col-md-4" align="center">
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
																				</li>|
																				<li class="font-yellow"><i class="fa fa-star"></i> <?echo  calificacion_prod($producto[0]['id'])?></li>|
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
																	<div class="col-lg-4"></div>
																</div>
																<div class="form-group form-md-line-input">
																	<div class="col-lg-4"></div>
																	 <div class="col-md-4" align="center">
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
																	<div class="col-lg-4"></div>
																</div>
																
																<div class="form-actions">
																	<div class="col-lg-4"></div>
																	<div class="col-md-4" align="center">
																		<input class="btn btn btn-circle red" name="pedido" type="submit" id="pedido" value="Realizar pedido">
																		<input type="hidden" id="id_producto" name="id_producto" value="<? echo  $id_producto ?>" />
																		<input type="hidden" id="formulario" name="formulario" value="crear_pedido"/>
																	</div>
																	<div class="col-lg-4"></div>
																</div>
																 <?// echo "<pre>";print_r($GLOBALS);echo "</pre>";?>
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
			<script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
    </body>
</html>