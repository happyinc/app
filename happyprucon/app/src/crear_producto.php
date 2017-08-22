
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
			?><link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
			  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
			 <script type="text/javascript">
				 //funcion que oculta y muestra div eniendo en cuenta la opcion seleccionada por el usuario
				function mostrarReferencia(){
					if (document.crear_producto.composicion[0].checked == true) {
						document.getElementById('dat_com').style.display='block';
					} 
					else if (document.crear_producto.composicion[0].checked == false || document.crear_producto.composicion[1].checked == true){
						document.getElementById('dat_com').style.display='none';
					}
					
					else {
						document.getElementById('dat_com').style.display='none';
					}	
				}
				
				// para buscar e insertar composiciones 
				$(document).ready(function(){
					var maxField = 10; //Input fields increment limitation
					var addButton = $('.add_button'); //Add button selector
					var wrapper = $('.field_wrapper'); //Input field wrapper
					var fieldHTML = '<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">'+
					'<select class="form-control" id="field_name[]" name="field_name[]">'+
					'<option selected="selected" value=""></option>'+
						<?
						$objConn1 = new PDOModel();
						//$objConn1->andOrOperator = "AND";
						$objConn1->where("id_estado", 1);
						//$objConn1->where("id_bienes", $item["id"]);
						$objConn1->orderByCols = array("nombre");
						$result2 =  $objConn1->select("composicion");
						foreach($result2 as $item2)
						{
							?>'<option value="<?php echo $item2["id"]?>"><?php echo $item2["nombre"]?></option>'+<?php
						}
						?>
					'</select>'+
					'<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle fa-1x"></i></a></div>'; 
					var x = 0; //Initial field counter is 1
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
            
			
		
			$id_producto=0;
		if(isset($_POST["formulario"]) && $_POST["formulario"] == "crear_producto" ){
		
				$objConn = new PDOModel();
				$insertData["id_categoria"] = $_POST["categoria"];
				$insertData["id_estado"] = 1;
				$insertData["nombre"] = $_POST["nombre"]; 
				$insertData["descripcion"] = $_POST["descripcion"];
				$insertData["especial"] = $_POST["especialidad"];
				$insertData["precio"] = $_POST["precio"];
				$insertData["fecha"] = date("Y-m-d H:i:s"); 
				$insertData["id_usuario"] = $id_usuario ;
				$objConn->insert('producto', $insertData);

				$id_producto= $objConn->lastInsertId;
				
				if($id_producto!= ""){
					
					if($_FILES['foto']["size"]>=1){
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
							$extension = end(explode('.', $_FILES['foto']['name']));
							$foto = "producto.jpg";
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
							
						} else { // El archivo no es JPG/GIF/PNG
							$malformato = $_FILES["foto"]["type"];
							?>
							<script type="text/javascript">
								alert("La imagen se encuentra con formato incorrecto")
								window.history.back();
							</script>
							<?	
						  }
						
					} else { // El campo foto NO contiene una imagen
							
							?>
							<script type="text/javascript">
							alert("No se ha seleccionado imagenes");
							window.history.back();
							</script>
							<?	
						}
					
					if($_POST["composicion"]=="si"){
						
						foreach($_POST['field_name'] as $clave => $valor)
						{
							$insertDataComp["id_composicion"] = $valor;
							$insertDataComp["id_producto"] = $id_producto;
							$objConn->insert('composicion_producto', $insertDataComp);
						}
					}	
				}
				else{
					?>
						<script type="text/javascript">alert("No se pudo guardar el producto")</script>
					<?
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
		<script>
		function alertaProductoCreado() 
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
								location.href="crear_disponibilidad.php?id_usuario=<? echo $id_usuario?>&id_producto="+<? echo $id_producto?>;
							} else {
								swal("Cancelar","se cancelo la creacion de la disponibilidad del producto");
								location.href="gestion_producto.php?id_usuario=<? echo $id_usuario ?>"
							}
						});
			}
		}
		</script>
        
        <title><? echo $nombre_pagina ?></title>
        
    </head>
    <!-- END HEAD -->
    <body class="page-header-default page-sidebar-closed-hide-logo page-container-bg-solid" style="text-align: center;background-color:white;" bgcolor="#ffffff" onload="alertaProductoCreado()">

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
														<form role="form" class="form-horizontal" name="crear_producto"  id="crear_producto" action="crear_producto.php" enctype="multipart/form-data" method="post">
															<div class="form-body">
																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<select class="form-control" id="categoria" name="categoria">
																				<?php
																					$objCat = new PDOModel();
																					$objCat->where("id_estado", 1);
																					$objCat->orderByCols = array("nombre");
																					$result =  $objCat->select("bienes");
																					foreach($result as $item){
																						?><optgroup label="<?php echo $item["nombre"]?>"> <?php
																							$objCat->andOrOperator = "AND";
																							$objCat->where("id_bienes", $item["id"]);
																							$objCat->where("id_estado", 1);
																							$objCat->orderByCols = array("descripcion");
																							$result1 =  $objCat->select("categoria");
																							
																							foreach($result1 as $item1){
																								?><option value="<?php echo $item1["id"]?>"><?php echo $item1["descripcion"]?></option><?php
																							}
																						?></optgroup><?php
																					}
																				?>
																				<!--hacer input hidden-->
																			</select>
																			<div class="form-control-focus"> </div>
																			<span class="help-block">Seleccione la categoria del producto a crear</span>
																			<i class="fa fa-clone"></i>
																		</div>
																	</div>
																</div>

																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del bien o servicio">
																				<div class="form-control-focus"> </div>
																				<span class="help-block required">Nombre del bien o servicio *</span>
																				<i class="fa fa-tags"></i>
																		</div>
																	</div>
																</div>

																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripcion"></textarea>
																				<div class="form-control-focus"> </div>
																				<span class="help-block">Descripcion</span>
																				<i class="fa fa-file-text-o"></i>
																		</div>
																	</div>
																</div>

																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<input type="number" class="form-control" id="precio" name="precio" placeholder="Valor del bien o servicio" data-toggle="tooltip" data-placement="top" title="De este valor digitado a happy le corresponde el 2%.">
																				<div class="form-control-focus"> </div>
																				<span class="help-block required">Valor del bien o servicio *</span>
																				<i class="fa fa-money"></i>
																		</div>
																	</div>
																</div>

																<div class="form-group form-md-line-input">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="input-icon">
																			<div>
																				<label class="control-label col-md-3">¿Tiene composicion?
																					<span class="required"> * </span>
																				</label>
																			</div>
																			<div class="row radio-list">
																				<label class="radio-inline"> <input type="radio" id="composicion_0" name="composicion" value="si" data-title="si" onclick="mostrarReferencia();"/>Si</label>
																				<label class="radio-inline"> <input type="radio" id="composicion_1" name="composicion" value="no" data-title="no" onclick="mostrarReferencia();"/> No </label>
																			</div>
																			<i class="fa fa-list-alt"></i>
																		</div>
																	</div>
																</div>
																<div id="dat_com" style="display:none;" >
																	<div class="form-group form-md-line-input">
																		<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																			<div class="field_wrapper">
																				Seleccione la composicion del producto
																				<span class="required"> * </span>
																				<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus-circle fa-1x"></i></a>
																			</div>
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
																				<label class="radio-inline"> <input type="radio" id="especialidad_0" name="especialidad" value="s" data-title="si"/>Si</label>
																				<label class="radio-inline"> <input type="radio" id="especialidad_1" name="especialidad" value="n" data-title="no"/> No </label>
																			</div>
																			<i class="fa fa-star"></i>
																		</div>
																	</div>
																</div>
																<div class="form-group form-md-line-input dropzone">
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																			<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
																				<img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"> </div>
																			<div>
																				<span class="btn default btn-file">
																					<span class="fileinput-new"> Seleccione la imagen </span>
																					<span class="fileinput-exists"> Cambiar </span>
																					<input type="file" name="foto" id="foto"> 
																				</span>
																				
																				<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
																			</div> 
																		</div>
																	</div>
																</div>
																<div class="form-actions">
																	<div class="col-md-offset-3 col-md-9" align="center">
																		<button type="submit" class="btn btn-circle" style="background-color: #5F059E;  color: white; padding: 10px; font-size: 13px;"  name="guardar" id="guardar" value="guardar"> Guardar </button>
																		<input type="hidden" id="formulario" name="formulario" value="crear_producto"/>
																		<input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario ?>" />
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
			<script src="../assets/global/plugins/bootstrap-selectsplitter/bootstrap-selectsplitter.min.js" type="text/javascript"></script>
			<script src="../assets/pages/scripts/components-bootstrap-select-splitter.min.js" type="text/javascript"></script>
			<script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
			<script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
			<script>
				// fucion que persnaliza el select dependiente de la categoria
				var ComponentsBootstrapSelectSplitter = function() {
					var selectSplitter = function() {
						$('#categoria').selectsplitter({
							selectSize: 1
						});
					}

					return {
						//main function to initiate the module
						init: function() {
							selectSplitter();
						}
					};

				}();
			</script>
    </body>
</html> 
