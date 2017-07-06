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
		require_once'../../externo/plugins/PDOModel.php';
		?>
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
			
			//funcion que comprueba el tipo de archivo permitido a subir
			function comprueba_extension(formulario, archivo) { 
			   extensiones_permitidas = new Array(".png", ".jpg", ".jpeg", ".bmp"); 
			   mierror = ""; 
			   if (!archivo) { 
				  //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario 
					mierror = "No has seleccionado ningún archivo"; 
			   }else{ 
				  //recupero la extensión de este nombre de archivo 
				  extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
				  //alert (extension); 
				  //compruebo si la extensión está entre las permitidas 
				  permitida = false; 
				  for (var i = 0; i < extensiones_permitidas.length; i++) { 
					 if (extensiones_permitidas[i] == extension) { 
					 permitida = true; 
					 break; 
					 } 
				  } 
				  if (!permitida) { 
					 mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
					}else{
					 //alert ("Todo correcto."); 
					 formulario.submit(); 
					 return 1; 
					} 
			   } 
			   //si estoy aqui es que no se ha podido hace el submit
			   alert (mierror); 
			   return 0; 
			} 
			
			// para buscar e insertar composiciones 
			$(document).ready(function(){
				var maxField = 10; //Input fields increment limitation
				var addButton = $('.add_button'); //Add button selector
				var wrapper = $('.field_wrapper'); //Input field wrapper
				var fieldHTML = '<form role="form" class="form-horizontal" name="lista_composicion"  id="lista_composicion" action="crear_producto.php" enctype="multipart/form-data" method="post"><div>'+
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
				'<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle fa-2"></i></a></div></form>'; 
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
			</script>
			
	    <?
		
	 //$usuario=5;
	
		if(isset($_POST["formulario"]) && $_POST["formulario"] == "crear_producto" ){
			
			?>
			   <script type="text/javascript">//alert("foto: <? echo $_POST['foto']?> ")</script>
               <? 
				$objConn = new PDOModel();
				$insertData["id_categoria"] = $_POST["categoria"];
				$insertData["id_estado"] = 1;
				$insertData["nombre"] = $_POST["nombre"]; 
				$insertData["descripcion"] = $_POST["descripcion"];
				$insertData["precio"] = $_POST["precio"];
				$insertData["fecha"] = date("Y-m-d H:i:s"); 
				$insertData["id_usu_crea"] = $usu_id ;
				$objConn->insert('producto', $insertData);
				//$aa=filesize($_POST['foto']);
				//$archivo_size
				$id_producto= $objConn->lastInsertId;
													
				
				if(isset($_POST['foto'])&& $_FILES['foto']['size'] > 0777){
					$ruta_archivo_a_subir = $_FILES['foto']['tmp_name'];

                    $directorio = "producto/".$usuario."/".$id_producto."";
                    if(file_exists($directorio)) 
                    {
                                  
                    } 
                    else 
                    {
                        mkdir($directorio, 0777, true);
                    }
                        
                    $ruta_destino = $directorio. '/' . $_FILES['foto']['name'];
                    if( move_uploaded_file($ruta_archivo_a_subir, $ruta_destino))
                    {
 
                    }
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
		 
		?>
		
		</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
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
																?>
															</optgroup><?php
														}
													?>
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
												<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto">
													<div class="form-control-focus"> </div>
													<span class="help-block required">Digite el nombre del producto a crear *</span>
													<i class="fa fa-tags"></i>
											</div>
										</div>
									</div>

									<div class="form-group form-md-line-input">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
											<div class="input-icon">
												<textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripcion del producto"></textarea>
													<div class="form-control-focus"> </div>
													<span class="help-block">Digite la descripcion del producto a crear</span>
													<i class="fa fa-file-text-o"></i>
											</div>
										</div>
									</div>

									<div class="form-group form-md-line-input">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
											<div class="input-icon">
												<input type="number" class="form-control" id="precio" name="precio" placeholder="Valor del producto">
													<div class="form-control-focus"> </div>
													<span class="help-block required">Digite el valor del producto a crear *</span>
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
												<div class="radio-list">
													<label> <input type="radio" id="composicion_0" name="composicion" value="si" data-title="si" onclick="mostrarReferencia();"/>Si</label>
													<label> <input type="radio" id="composicion_1" name="composicion" value="no" data-title="no" checked onclick="mostrarReferencia();"/> No </label>
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
													<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus-circle fa-2"></i></a>
												</div>
											</div>
										</div>
										
										<div class="form-group form-md-line-input">
											<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
												<div class="input-icon">
													<textarea class="form-control" rows="3" id="lista" name="lista"><? echo "pp"?></textarea>
														
												</div>
											</div>
										</div>
										
									</div>
									<div class="form-group form-md-line-input">
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
														<input  class="btn blue" type=button name="Submit" value="Enviar" onclick="comprueba_extension(this.form, this.form.foto.value)"> 
													<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
												</div> 
											</div>
										</div>
									</div>
									<div class="form-group form-md-line-input">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
											<button type="submit" class="btn blue" name="guardar" id="guardar" value="guardar"> Crear producto </button>
											<input type="hidden" id="formulario" name="formulario" value="crear_producto"/>
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
			<script src="../assets/global/plugins/bootstrap-selectsplitter/bootstrap-selectsplitter.min.js" type="text/javascript"></script>
			<script src="../assets/pages/scripts/components-bootstrap-select-splitter.min.js" type="text/javascript"></script>
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