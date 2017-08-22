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
				?><script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
                <link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" /><?	
				include("nombre_cabezera.php");
				include("menu_modal.php");
				
			//INICIO DEL CODIGO PHP PARA EL ARCHIVO GESTION_PRODUCTO
			//elimina el producto
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
			
			//crea la disponibilidad
			if(isset($_POST["formulario"]) && $_POST["formulario"] == "crear_disponibilidad" && isset($_POST["id_producto"]) && $_POST["id_producto"] != "" && $id_usuario != "")
			{
				$id_disponibilidad=0;
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
					$insertData["id_usuario"] = $id_usuario ;
					$objConn->insert('disponibilidad', $insertData);

					$id_disponibilidad= $objConn->lastInsertId;
					$error=$objConn->error;

					if($id_disponibilidad!= "")
					{
						//insert a la tabla producto_disponibilidad
						$insertPd["id_producto"] =  $_POST["id_producto"];
						$insertPd["id_disponibilidad"] = $id_disponibilidad; 
						$insertPd["cantidad_disponible"] = $_POST["cantidad_disponible"];
						$insertPd["cantidad_despachada"] = 0;
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
                                                    <div class="portlet-title" style="text-align: left;">
                                                        
                                                        <div class='fuente-2'>
	                                                            <div class="row">
	                                                            	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3" align="center">
																		<a href="../src/crear_producto.php?id_usuario=<? echo $id_usuario?>"><i class="fa fa-plus-circle fa-5x" style="color:#868889" aria-hidden="true"></i></a>
																	</div>
																	<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9">
																		Crear Bien o Servicio
																	</div>
	                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                    	<?
                                                    	$objProd = new PDOModel();
														$objProd->andOrOperator = "AND";
														$objProd->where("id_estado", 1);
														$objProd->where("id_usuario", $id_usuario);
														$producto =  $objProd->select("producto");

																	foreach($producto as $item)
																	{
																		?>
																		<div class="form-group form-md-line-input">
																			<div class="row">
																			<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3" align="center">
																					<a href="../src/editar_producto.php?id_usuario=<? echo $id_usuario?>&id_producto=<? echo $item["id"]?>"><img src="<? echo "usuarios/".$id_usuario."/bienes/".$item["id"]."/res_producto.jpg"?>" width="100 px" height="70 px" alt="" class="img-responsive">
																					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn purple-studio">Editar</div> </a>
																		    </div>
																			
																			<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
																				<div class="row">
																					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" align="left" >
																						<div class="fuente-2"></b><?php echo $item["nombre"]?></b></div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" align="left">
																						<div class="fuente-11"><?php echo $item["descripcion"]?></div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" align="left" >
																						<div class="fuente-11"></b><?php echo "$ ".number_format($item["precio"],0)?></b></div>
																					</div>
																				</div>	
																				
																				
																				
																			</div>
																			
																			<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3" align="center">
																				<?php
																				$validacion = "NO";
																				$fecha=date("Y-m-d H:i:s");
																		        $objConn = new PDOModel();
																		        $objConn->andOrOperator = "AND";
																		        $objConn->where("cantidad_disponible", 1,">=");
																		        $objConn->where("id_producto", $item["id"]);
																		        $result =  $objConn->select("producto_disponibilidad");
																		        foreach ($result as $productos ) 
																		        {
																		        		$objConna = new PDOModel();
																		        		$objConna->andOrOperator = "AND";
																				        $objConna->where("id", $productos["id_disponibilidad"]);
																				        $objConn->where("fecha_inicio", "$fecha" ,"<=");
																				        $objConn->where("fecha_fin", "$fecha" ,">=");
																				        $resulta =  $objConn->select("disponibilidad");
																				        foreach ($resulta as $disp ) 
																				        {	
																				        	$validacion = "SI";	
																				        }
																		        	
																		        }

																		       
																				//echo "<pre>";print_r($cuenta); echo"<pre>";
																				if($validacion == "SI")
																				{
																					?>
																					
																					<a  href="gestion_producto.php?id_usuario=<? echo $id_usuario?>&anular=<? echo $item["id"] ?>" onclick="eliminarDisponibilidad(<? echo $item["id"] ?>);">
																						<i class="fa fa-toggle-on fa-4x" style="color:green" aria-hidden="true"></i></a>
																					 <?php
																				}
																				else if($validacion == "NO")
																				{
																					?><a  href="../src/crear_disponibilidad.php?id_usuario=<? echo $id_usuario?>&id_producto=<? echo $item["id"]?>">
																						<i class="fa fa-toggle-off fa-4x" style="color:red" aria-hidden="true"></i></a>
																				<?php
																				}
																				?>
																			</div>
																			</div>
																		</div>
																		<hr style="color: #868889;" />
																		<?php
																	}
																	
                                                    	?>

                                                    </div>
                                                </div>
                                                <!-- AQUI TERMINA EL CONTENIDO -->

                                                <!-- AQUI EMPIEZA EL CONTENIDO-->
                                                <div class="portlet light ">
                                                    <div class="portlet-body form">
														<form role="form" class="form-horizontal" name="gestion_producto"  id="gestion_producto" action="gestion_producto.php" enctype="multipart/form-data" method="post">
															<div class="form-body">

																
																<input type="hidden" id="formulario" name="formulario" value="gestion_producto"/>
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