<?php
//error_reporting(E_ALL ^ E_NOTICE);

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
		<link href="../assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css"/>
		 
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
			
			//funcion que comprueba el tipo de archivo permitid a subir
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
						//submito! 
					 //alert ("Todo correcto."); 
					 formulario.submit(); 
					 return 1; 
					} 
			   } 
			   //si estoy aqui es que no se ha podido hace el submit
			   alert (mierror); 
			   return 0; 
			} 
			
			$(function() {
				$('#comp').autocomplete({
					source: 'completar.php'
				});
				
			});
			</script>
			
	    <?
		 $usuario=$_SESSION["id_usuario"];
	
	
		if(isset($_POST["guardar"])&& isset($_POST["formulario"]) && $_POST["formulario"] == "crear_producto" ){
			if($_POST["guardar"] == 'crear_producto'){
				$objConn = new PDOModel();
				$insertEmpData["categoria"] = $_POST["categoria"];
				$insertEmpData["nombre"] = $_POST["nombre"]; 
				$insertEmpData["descripcion"] = $_POST["descripcion"];
				$insertEmpData["precio"] = $_POST["precio"];
				$insertEmpData["fecha"] = date("Y-m-d H:i:s"); 
				$insertEmpData["id_estado"] = 1; 
				$objConn->insert('producto', $insertEmpData);
				//$aa=filesize($_POST['foto']);
				$archivo_size
				?>
               <script type="text/javascript">//alert("el tamaño de la imagen es: <? echo $aa?> ")</script>
			   <script type="text/javascript">//alert("el tamaño de la imagen es: <? echo $archivo_size?> ")</script>
               <? 
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
												<div class="input-icon">
												<input type="text" class="form-control" id="comp" name="comp" autocomplete="off" spellcheck="false" dir="auto" placeholder="Seleccione la composicion">
													<div class="form-control-focus"> </div>
													<span class="help-block required">Seleccionne la composicion del producto *</span>
													<i class="fa fa-list-ul"></i>
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
														<span class="fileinput-new"> Select image </span>
														<span class="fileinput-exists"> Change </span>
														<input type="file" name="foto" id="foto"> </span>
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
			<script src="../assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
			 <!--<script src="../assets/pages/scripts/components-typeahead.js" type="text/javascript"></script>
			<script src="../assets/pages/scripts/select-input.js" type="text/javascript"></script>-->
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
		
			//select que busca e inserta
			 //var handleTwitterTypeahead = function() {
				
				// Example #1
				// instantiate the bloodhound suggestion engine
				/*var numbers = new Bloodhound({
				  datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
				  queryTokenizer: Bloodhound.tokenizers.whitespace,
				  local: [
					{ num: 'metronic' },
					{ num: 'keenthemes' },
					{ num: 'metronic theme' },
					{ num: 'metronic template' },
					{ num: 'keenthemes team' }
				  ]
				});
				 
				// initialize the bloodhound suggestion engine
				numbers.initialize();
				 
				// instantiate the typeahead UI
				if (App.isRTL()) {
				  $('#comp').attr("dir", "rtl");  
				}
				$('#comp').typeahead(null, {
				  displayKey: 'num',
				  hint: (App.isRTL() ? false : true),
				  source: numbers.ttAdapter()
				});

			}*/
	</script>
    </body>

</html>