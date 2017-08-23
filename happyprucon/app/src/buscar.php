<?
error_reporting(0);
?>
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
			$name = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null ;
			$lastname = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : null ;
			$genero = isset($_SESSION['genero']) ? $_SESSION['genero'] : null ;
			$tel = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : null ;
			$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : null ;
			$meta = isset($_SESSION['suenos']) ? $_SESSION['suenos'] : null ;

			$id_user = "";

			if(isset($_POST["id_usuario"]) && $_POST["id_usuario"] != "")
			{
				$id_user = $_POST["id_usuario"];
			}
			elseif(isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "")
			{
				$id_user = $_GET["id_usuario"];
			}
			$objUbicacion = new PDOModel();
			$objUbicacion->where("id", $id_user);
			$res_usuarios =  $objUbicacion->select("usuarios");
			foreach ($res_usuarios as $usuarios)
			{
				$rol = $usuarios["id_roles"] ;
				$fullname = $usuarios["nombre_completo"] ;
				$name = $usuarios["nombre"] ;
				$lastname = $usuarios["apellido"] ;
				$genero = $usuarios["genero"] ;
				$tel = $usuarios["tel"] ;
				$correo = $usuarios["correo"] ;
			}

			$buscar = "";

			if(isset($_POST["buscar"]) && $_POST["buscar"] != "")
			{
				$buscar = $_POST["buscar"];
			}
			elseif(isset($_GET["buscar"]) && $_GET["buscar"] != "")
			{
				$buscar = $_GET["buscar"];
			}
            include("include_css.php");
			?><link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
			<link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" /><?
            include("nombre_cabezera.php");
            include("menu_modal.php");
            
			$result="";
			$fecha=date("Y-m-d H:i:s");
			$objConn = new PDOModel();
			$query_todos = "SELECT A.*, B.*, C.*  FROM producto A, producto_disponibilidad B, disponibilidad C WHERE B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1 and B.id_disponibilidad= C.id and '".$fecha."' between C.fecha_inicio and C.fecha_fin ";
			

				if(isset($_POST["buscar"]) && $_POST["buscar"] != "")
				{
					
					$query_todos = $query_todos."AND (A.nombre LIKE '%$buscar%' OR A.descripcion LIKE '%$buscar%')";

				}

			if(isset($_POST["formulario"]) && $_POST["formulario"] == "fbuscar")
			{

				if(isset($_POST["categoria"]) && $_POST["categoria"] != "")
				{
					$query_todos = $query_todos." AND A.id_categoria = '".$_POST["categoria"]."' ";
				}

				if(isset($_POST["emprendedor"]) && $_POST["emprendedor"] != "")
				{
					$query_todos = $query_todos." AND A.id_usuario = '".$_POST["emprendedor"]."' ";
				}

				 if(isset($_POST["precio"]) && $_POST["precio"] != "")
				{
					$techo = $_POST["precio"]+2000;

					$query_todos = $query_todos." AND A.precio BETWEEN '".$_POST["precio"]."' AND '".$techo."'  ";
				}

			}
			
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
														<div class="form-body"> 
															<form role="form" class="form-horizontal" name="1buscar" id="1buscar" action="buscar.php" enctype="multipart/form-data" method="POST">
                                                                <div class="col-md-4">
                                                                    <div class="input-group" style="box-shadow: 0px 0px 3px 1px #999; border-top-left-radius: 15px; border-bottom-left-radius: 15px; border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
                                                                        <span class="input-group-btn">
                                                                            <a class="btn bold disabled" style="background-color:transparent; color:#5F059E; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">Buscar</a>
                                                                        </span>
                                                                        <input type="search" name="buscar" id="buscar" class="form-control" style="border-top: 0; border-bottom: 0; border-color: #5F059E; " value="<? echo $buscar ?>">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn" type="submit" name="buscarb" value="buscarb" style="background-color: transparent; color:#5F059E; border-top-right-radius: 15px; border-bottom-right-radius: 15px;"><i class="fa fa-search bold"></i></button>
                                                                        </span>
                                                                    </div>
                                                                    <!-- /input-group -->
                                                                </div>
																<input type="hidden" id="formulario" name="formulario" value="1buscar"/>
															</form>
															<!-- Trigger the modal with a button -->
															<!--<button type="button" class="btn  btn-circle" data-toggle="modal" data-target="#myModal" style="background-color:#5F059E; color: white; padding: 10px; font-size: 13px;">Filtros</button>-->

															<!-- Modal -->
															<div id="myModal" class="modal fade" role="dialog">
															  <div class="modal-dialog">
                                                                  <div class="col-md-5"></div>

																<!-- Modal content-->
																<div class="modal-content col-md-6">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title bold" style="color: #5F059E;">Filtros de busqueda</h4>
																  </div>
																  <div class="modal-body" style="margin-left: 10px !important; ">
																	<form role="form" class="form-horizontal" name="fbuscar" id="fbuscar" action="buscar.php" enctype="multipart/form-data" method="POST">
																		<?
																			$categoria_f = "";
																			$asociado_f = "";
																			$precio_max = 0;
																			$precio_min = 0;
																			$contador = 0;
																			$result =  $objConn->executeQuery($query_todos);
																			foreach ($result as $item ) 
																			{
																				$categoria_f["".$item["id_categoria"].""] = $categoria_f["".$item["id_categoria"].""]+1;
																				$asociado_f["".$item["id_usuario"].""] = $asociado_f["".$item["id_usuario"].""]+1;

																				if($contador == 0)
																				{
																					$precio_max = $item["precio"];
																					$precio_min = $item["precio"];
																				}
																				else
																				{
																					if($item["precio"] < $precio_min)  
																					{
																						$precio_min = $item["precio"];
																					}
																					else if($item["precio"] > $precio_max)  
																					{
																						$precio_max = $item["precio"];
																					}
																				}
																				$contador++;
																			}

																		?>
																		<p>Seleccione el filtro de busqueda.</p>

																			<div class="form-group">
																				<label for="categoria" class="control-label col-md-3">Categoria</label>
																				
																				<select id="categoria" class="form-control col-md-9" style="width: 250px;" tabindex="-1" aria-hidden="true" name="categoria" ">
																					<option value= "" disabled selected>Seleccione la categoria</option>
																						<?
																						foreach ($categoria_f as $key => $value) {
																							?>
																							<option value="<? echo $key ?>"><? echo nombre_categoria($key) . "- $value Productos"?></option>
																							<?
																						}
																						?>
																				 </select>
																				
																			</div>

																			 <div class="form-group">
																				<label for="emprendedor" class="control-label col-md-3">Emprendedor</label>
																				<select id="emprendedor" class="form-control col-md-9" style="width: 250px;" tabindex="-1" aria-hidden="true" name="emprendedor">
																					 <option value= "" disabled selected>Seleccione la categoria</option>
																						 <?
																						foreach ($asociado_f as $key => $value) {
																							?>
																							<option value="<? echo $key?>"><? echo  nombre_usuario_new($key) . "- $value Productos"?></option>
																							<?
																						}
																						?>
																				 </select>
																			</div>

																			 <div class="form-group">
																				<label for="precio" class="control-label col-md-3">Precio</label>
																				<select id="precio" class="form-control col-md-9" style="width: 250px;" tabindex="-1" aria-hidden="true" name="precio" >
																					<option value= "" disabled selected>Seleccione el precio</option>
																						<?
																						$i=0;
																						for ($i=$precio_min; $i<= $precio_max; $i=$i+2000) {
																							?>
																							<option value="<? echo $i ?>"><? echo "$".number_format($i,0)." - $".number_format($i+2000,0)?></option>
																							<?
																						}
																						?>
																						
																				 </select>
																			</div>

																			<div class="form-actions">
																				<div class="col-md-offset-3 col-md-6">
																					<button type="submit" class="btn btn-circle" name="enviar" id="enviar" value="enviar" style="background-color: #5F059E; color: white; "> Enviar </button>
																				</div>
																			</div>

																	
																	<input type="hidden" id="formulario" name="formulario" value="fbuscar"/>
																	<input type="hidden" name="buscar" id="buscar" value="<? echo $buscar ?>">
																  </div>
																</div>
																	</form>
															  </div>
															</div>

															<div class="form-group form-md-line-input" style="margin-top:30px;">
																	<div class="portlet light portlet-fit ">
																		<div class="row">
																			<div class="col-lg-3"></div>
                                                                            <?

                                                                            $result =  $objConn->executeQuery($query_todos);
                                                                            foreach ($result as $item )
                                                                            {
                                                                            ?>
                                                                            <div class="col-md-4" align="center">
																				<div class="mt-widget-2" >
																					<div class="mt-head" style="background-image: url(<? echo 'usuarios/'.$item['id_usuario'].'/bienes/'.$item['id_producto'].'/res_producto.jpg'?>);" >
																						<div class="mt-head-label">
																							<a type="button" class="btn bold" style="background-color:#00F85B; border-color: #5F059E; color: #5F059E; padding: 10px; font-size: 13px; border-radius: 10px;">$ <?echo number_format($item["precio"],0)?></a>
																						</div>
																						<div class="mt-head-user" >
																							<div class="mt-head-user-img">
																								<img src="<? echo 'usuarios/'.$item['id_usuario'].'/perfil'.'/res_perfil.jpg'?>"> </div>
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
                                                                                        <div class="btn-group-circle" style="margin-bottom: 20px;">
                                                                                            <a href="../src/crear_pedido.php?id_producto=<? echo $item["id_producto"]?>" class="btn btn-circle purple-studio bold" style="text-align: center; background-color: transparent; color: #5F059E; font-size: 13px;">Hacer pedido </a>
                                                                                        </div>
																					</div>
																				</div>
																			</div>
                                                                                <?//echo "<pre>";print_r($GLOBALS); echo "</pre>";?>
                                                                                <input type="hidden" id="id_producto" name="id_producto" value="<? echo $item["id_producto"] ?>" />
                                                                                </br></br>
                                                                                <?
                                                                            }?>
																			<div class="col-lg-3"></div>
																		</div>
																	</div>
															</div>
														</div> 
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
			 <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
			<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    </body>
</html>