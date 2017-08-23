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
					$id_usuario =$usuarios["id"] ;                                                     
			}
			
			$id_producto = "";
	
			if(isset($_POST["id_producto"]) && $_POST["id_producto"] != "")
			{
				$id_producto = $_POST["id_producto"];
			}
			elseif(isset($_GET["id_producto"]) && $_GET["id_producto"] != "")
			{
				 $id_producto = $_GET["id_producto"];
        	}
            include("include_css.php");
			?>
			<link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
			<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
			<script type="text/javascript">
				// para buscar e insertar composiciones 
				$(document).ready(function(){
					var maxField = 10; //Input fields increment limitation
					var addButton = $('.add_button'); //Add button selector
					var wrapper = $('.field_wrapper'); //Input field wrapper
					var fieldHTML = '<div>'+
					'<select class="form-control" id="field_name[]" name="field_name[]">'+
					'<option selected="selected" value=""></option>'+
						<?
						$objConn1 = new PDOModel();
						$objConn1->where("id_estado", 1);
						$objConn1->orderByCols = array("nombre");
						$result2 =  $objConn1->select("composicion");
						foreach($result2 as $item2)
						{
							?>'<option value="<?php echo $item2["id"]?>"><?php echo $item2["nombre"]?></option>'+<?php
						}
						?>
					'</select>'+
					'<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle fa-1x"></i></a></div>'; 
					var x = 1; //Initial field counter is 1
					$(addButton).click(function(){ //Once add button is clicked
						if(x < maxField){ //Check maximum number of input fields
							x++; //Increment field counter
							$(wrapper).append(fieldHTML); // Add field html
						}
					});
					$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
					e.preventDefault();
					$(this).parent('div').remove(); //Remove field html
					x--; //Decrement field counter
					});
				});
				//tooltip de nootificacion para el porcentaje correspondiente a happy
					$(document).ready(function(){
						$('[data-toggle="tooltip"]').tooltip(); 
					});
			</script>
			<?
            include("nombre_cabezera.php");
            include("menu_modal.php");
            
			//$product=0;
		//$accion="";
		$objProd = new PDOModel();
		$objProd->where("id", $id_producto);
		$producto =  $objProd->select("producto");

        
		if(isset($_POST["formulario"]) && $_POST["formulario"] == "editar_producto" )
		{ 
			if(isset($_POST["editar"]) && $_POST["editar"]== "Actualizar")
			{
				
				$objConn = new PDOModel();
				$updateData["nombre"] = $_POST["nombre"]; 
				$updateData["descripcion"] = $_POST["descripcion"];
				$updateData["especial"] = $_POST["especialidad"];
				$updateData["precio"] = $_POST["precio"];
				$updateData["fecha"] = date("Y-m-d H:i:s"); 
				$objConn->where("id", $id_producto);
				$objConn->update('producto', $updateData);

				$error=$objConn->error;
				
				$producto_actualizado= $objConn->rowsChanged;
				

				if($producto_actualizado == 1)
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
							$directorio = "usuarios/".$id_usuario."/bienes/".$id_producto.""; // directorio de tu elección
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
							$midFoto = 'mid_'.$foto;
							$resFoto = 'res_'.$foto;
							resizeImagen($directorio.'/', $foto, 45, 45,$minFoto,$extension);
							resizeImagen($directorio.'/', $foto, 85, 85,$minFoto,$extension);
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
					else 
					{ // El campo foto NO contiene una imagen
							?>
							<script type="text/javascript">
							alert("No se ha seleccionado imagenes");
							</script>
							<?	
					}
						
						$objConn = new PDOModel();
						$objConn->where("id_producto", $id_producto);//setting where condition
						$objConn->delete("composicion_producto");
						$act=$objConn->rowsChanged;
						if($_POST['field_name'] != "")
						{
							foreach($_POST['field_name'] as $clave => $valor)
							{
								$insertDataComp["id_composicion"] = $valor;
								$insertDataComp["id_producto"] = $id_producto;
								$objConn->insert('composicion_producto', $insertDataComp);
							}
						}

						?>
						<script type="text/javascript">alert("EXITO: EL producto ha sido actualizado")
						window.location.assign("gestion_producto.php?id_usuario=<? echo $id_usuario ?>");
						</script>
					    <?


							
				}
				else
				{
					?>
						<script type="text/javascript">alert("No se pudo actualizar el producto");
						
						</script>
					<?
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
		<script type="text/javascript">
		
			/*function alertaProducto(producto_actualizado) 
			{
				
				var producto = producto_actualizado;
				
				
					if(producto >= 1)
					{
						swal({
							title:"Producto con el id:" + <? echo $id_producto ?>+"ha sido actualizado",
							text: "",
							type: "success",
							showCancelButton: false,
							confirmButtonClass: "btn-success",
							confirmButtonText: "Producto actualizado!",
							cancelButtonText: "No",
							closeOnConfirm: false,
							closeOnCancel: false
						},
						function(isConfirm) {
							if (isConfirm) {
								swal("", "", "success");
								location.href="gestion_producto.php?id_usuario=<? echo $id_usuario ?>";
							} 
						});
					}
			}
		  	
		  	function eliminarProducto()
		  	{
		  		
		  				swal({
							title:"¿Desea eliminar el producto:" + <? echo $id_producto?>+"?",
							text: "Si elimina el producto no se podra recuperar",
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
								swal("Ir", "El producto ha sido eliminado", "success");
								location.href="gestion_producto.php?id_usuario="+<? echo $id_usuario?>+"&eliminar=<? echo $id_producto?>";
							
							} else {
								swal("Cancelar","se cancelo la eliminacion del producto");
								location.href="editar_producto.php?id_usuario=<? echo $id_usuario?>"+"&id_producto=<? echo $id_producto?>"
							}
						});
					
		  	}*/
		</script>
        <title><? echo $nombre_pagina ?></title>
        
    </head>
    <!-- END HEAD -->
    <body class="page-header-default page-sidebar-closed-hide-logo page-container-bg-solid" style="text-align: center;background-color:white;" bgcolor="#ffffff" ><!--  onload="alertaProducto(<? echo $producto_actualizado?>)"-->

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
														<form role="form" class="form-horizontal" name="editar_producto"  id="editar_producto" action="editar_producto.php" enctype="multipart/form-data" method="post">
															<div class="form-body">
																<div class="form-group form-md-line-input dropzone">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																			<div class="fileinput-new thumbnail img-circle" style="width: 200px; height: 200px;">
																				<img src="<? echo "usuarios/".$id_usuario."/bienes/".$id_producto."/res_producto.jpg"?>" alt=""> </div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"> </div>
																			<div>
																				<span class="btn default btn-file">
																					<span class="fileinput-new"> Seleccione la imagen </span>
																					<span class="fileinput-exists"> Cambiar </span>
																					<input type="file" name="foto" id="foto" value="<?echo "usuarios/".$id_usuario."/bienes/".$id_producto."/".$resFoto?>"> 
																				</span>
																				<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
																			</div> 
																		</div>
																	</div>
																	<br>
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<?
																		echo calificacion_producto($id_producto);
																		?>
																	</div>
																</div>
																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripcion del producto"><? echo $producto[0]['descripcion']; ?></textarea>
																				<div class="form-control-focus"> </div>
																				<span class="help-block">Digite la descripcion del producto</span>
																				<i class="fa fa-file-text-o"></i>
																		</div>
																	</div>
																</div>
																
																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" value ="<? echo $producto[0]['nombre']; ?>">
																				<div class="form-control-focus"> </div>
																				<span class="help-block required">Digite el nombre del producto *</span>
																				<i class="fa fa-tags"></i>
																		</div>
																	</div>
																</div>
																
																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<input type="number" class="form-control" id="precio" name="precio" placeholder="Valor del producto" data-toggle="tooltip" data-placement="top" title="De este valor digitado a happy le corresponde el 2%." value ="<? echo $producto[0]['precio']; ?>">
																				<div class="form-control-focus"> </div>
																				<span class="help-block required">Digite el valor del producto * </span>
																				<i class="fa fa-money"></i>
																		</div>
																	</div>
																</div>
																	<div class="form-group form-md-line-input">
																		<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																			<div class="field_wrapper">
																				Actualice la composicion del producto
																				<span class="required"> * </span>
																				<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus-circle fa-1x"></i></a>
																				<option selected="selected" value=""></option>
																					<?
																					$objConn1 = new PDOModel();
																					$objConn1->where("id_producto", $id_producto);
																					$result2 =  $objConn1->select("composicion_producto");
																					
																					$totfilas=$objConn1->totalRows;
																					if($totfilas >=1)
																					{
																						foreach($result2 as $item2)
																						{
																							$objConn1->where("id", $item2["id_composicion"]);
																							$objConn1->orderByCols = array("nombre");
																							$result3 =  $objConn1->select("composicion");
																							foreach($result3 as $item3)
																							{
																								?>
																								<div>
																								<select class="form-control" id="field_name[]" name="field_name[]">
																								<option selected="selected" value="<?php echo $item3["id"]?>"><?php echo $item3["nombre"]?></option>
																								<?
																									$objConn1->where("id_estado", 1);
																									$objConn1->orderByCols = array("nombre");
																									$result2 =  $objConn1->select("composicion");
																									foreach($result2 as $item2)
																									{
																										?><option value="<?php echo $item2["id"]?>"><?php echo $item2["nombre"]?></option> <?php
																									}
																								?>
																								</select>
																								<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle fa-2"></i></a>
																								</div>
																								<?
																							}
																						}	
																					}														
																					?>
																				</select>
																			</div>
																		</div>
																	</div>
																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<div>
																			<label class="control-label col-md-3">¿El producto es su especialidad?
																				<span class="required"> * </span>
																			</label>
																			</div>
																			<div class="radio-list">
																				<?if($producto[0]['especial'] == "s") 
																				{?> 
																					<label> <input type="radio" id="especialidad_0" name="especialidad" value="s" data-title="si" checked />Si</label>
																					<label> <input type="radio" id="especialidad_1" name="especialidad" value="n" data-title="no"/> No</label>
																				<?}
																				else if ($producto[0]['especial'] == "n")
																				{?>
																					<label> <input type="radio" id="especialidad_0" name="especialidad" value="s" data-title="si"/>Si</label>
																					<label> <input type="radio" id="especialidad_1" name="especialidad" value="n" data-title="no" checked /> No</label>
																				<?}?>
																			
																			</div>
																			<i class="fa fa-star"></i>
																		</div>
																	</div>
																</div>
																<div class="form-actions">
																	<div class="col-md-offset-3 col-md-9">
																	
																		<input class="btn  btn-circle purple" name="editar" type="submit" id="editar" value="Actualizar">
																		<input class="btn btn-circle red" name="eliminar" type="button" id="eliminar" value="Eliminar" onclick="window.location.href = 'gestion_producto.php?id_usuario=<? echo $id_usuario?>&eliminar=<? echo $id_producto?>';">
																		<input type="hidden" id="formulario" name="formulario" value="editar_producto"/>
																		<input type="hidden" id="id_producto" name="id_producto" value="<? echo $id_producto ?>" />
																		<input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario ?>" />
																	</div>
																</div>


																	<div class="portlet light ">
																		<div class="portlet-title tabbable-line">
																			<div class="caption">
																				<i class="icon-bubbles font-dark hide"></i>
																				<span class="caption-subject"><h3 class="block bold" style="color: #520d9b">COMENTARIOS</h3></span>
																			</div>

																		</div>
																		<div class="portlet-body">
																			<div class="tab-content">
																				<div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
																					<div class="tab-pane active" id="portlet_comments_1">
																						<!-- BEGIN: Comments -->
																						<?
																						$objCon=new PDOModel();
																						$res_califica = $objCon->executeQuery("select A.* , B.* from producto A , calificacion_producto B where A.id = B.id_producto AND  A.id= '".$id_producto."' ");

																						foreach ($res_califica as $valor){
																							?>
																							<div class="mt-comments">
																								<div class="mt-comment">
																									<div class="mt-comment-img">
																										<img src="<? echo 'usuarios/'.$valor['id_usuario_califica'].'/perfil/min_perfil.jpg' ?>" /> </div>
																									<div class="mt-comment-body">
																										<div class="mt-comment-info">
																											<span class="mt-comment-author"><? echo nombre_usuario_new($valor['id_usuario_califica']);?></span>
																											<span class="mt-comment-date"><? echo $valor['fecha'];?></span>
																										</div>
																										<div class="mt-comment-text"><? echo $valor['comentario'] ;?></div>
																										<div class="mt-comment-details">
																											<span class="mt-comment-status mt-comment-status-pending"><? echo print_calificacion($valor['calificacion']); ?></span>
																										   
																										</div>
																									</div>
																								</div>
																							</div><?
																						}
																						?>

																						<!-- END: Comments -->
																						<input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario ?>" />
																					</div>
																				</div>
																				<? //echo "<pre>";print_r($GLOBALS);echo "</pre>";?>
																			</div>
																		</div>
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