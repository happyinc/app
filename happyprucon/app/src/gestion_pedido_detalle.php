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
			?><link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" /><?
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

			$id_forma_adquisicion = "";
		
			if(isset($_POST["id_forma_adquisicion"]) && $_POST["id_forma_adquisicion"] != "")
			{
				$id_forma_adquisicion = $_POST["id_forma_adquisicion"];
			}
			elseif(isset($_GET["id_forma_adquisicion"]) && $_GET["id_forma_adquisicion"] != "")
			{
				 $id_forma_adquisicion = $_GET["id_forma_adquisicion"];
			}
			
			$result1="";
        $objConn = new PDOModel();



        if($id_producto !="")
        {
            $result1 = $objConn->executeQuery("SELECT C.* FROM (SELECT A.id, A.id_usuario,A.id_zona, A.id_estado,A.id_producto,A.id_ubicacion_cliente,A.fecha,A.precio,A.forma_adquisicion,A.cantidad,A.comision,A.cxp, B.id_categoria,B.nombre,B.descripcion  FROM pedido A, producto B WHERE B.id_usuario = '".$id_usuario."' AND B.id = A.id_producto AND A.id_estado = 7 ) C WHERE C.id_producto = '".$id_producto."';");
        }

        if($id_forma_adquisicion !="")
        {
            $result1 = $objConn->executeQuery("SELECT C.* FROM (SELECT A.id, A.id_usuario,A.id_zona, A.id_estado,A.id_producto,A.id_ubicacion_cliente,A.fecha,A.precio,A.forma_adquisicion,A.cantidad,A.comision,A.cxp, B.id_categoria,B.nombre,B.descripcion  FROM pedido A, producto B WHERE B.id_usuario = '".$id_usuario."' AND B.id = A.id_producto AND A.id_estado = 7) C WHERE C.forma_adquisicion = '".$id_forma_adquisicion."';");
        }



        //manejo de la fecha para hacer el insert en la tabla detalle pedido
        $fecha = date("Y-m-d H:i:s");
        $fecha1 = explode(" ", $fecha);
        $fecha_act=$fecha1[0];
        $hora=$fecha1[1];
        

        if(isset($_POST["formulario"]) && $_POST["formulario"] == "gestion_pedido_detalle" )
        {
    
            $id_pedido=$_POST['id_pedido'];
            if(isset($_POST["despachar"]) && $_POST["despachar"]== "Despachar" )
            {
                $updateData["id_estado"] = 8; 
                $objConn->where("id",   $id_pedido);
                $objConn->update('pedido', $updateData);

                
                $pedido_actualizado= $objConn->rowsChanged;

                if($pedido_actualizado == 1)
                {
                    //insert en la tabla detalle_pedido
                    $insertDet["id_pedido"] = $id_pedido;
                    $insertDet["id_estado"] = 8;
                    $insertDet["fecha"] = $fecha_act; 
                    $insertDet["hora"] = $hora; 
                    $objConn->insert('detalle_pedido', $insertDet);

                     $id_pedido_detalle= $objConn->lastInsertId;
                }
                else 
                {
                    ?>
                        <script type="text/javascript">alert("No se pudo actualizar el pedido")
                        </script>
                    <?
                }
            }


            if(isset($_POST["entregar"]) && $_POST["entregar"]== "Entregar")
            {

                $updateData["id_estado"] = 9; 
                $objConn->where("id", $id_pedido);
                $objConn->update('pedido', $updateData);

                $pedido_actualizado= $objConn->rowsChanged;
                if($pedido_actualizado == 1)
                {
                    //insert en la tabla detalle_pedido
                    $insertDet["id_pedido"] =  $id_pedido;
                    $insertDet["id_estado"] = 9;
                    $insertDet["fecha"] = $fecha_act; 
                    $insertDet["hora"] = $hora; 
                    $objConn->insert('detalle_pedido', $insertDet);

                     $id_pedido_detalle= $objConn->lastInsertId;
                }
                else 
                {
                    ?>
                        <script type="text/javascript">alert("No se pudo actualizar el pedido")
                        </script>
                    <?
                }

            }
        }       
    
        ?>
        <script type="text/javascript">
        
            function alertaPedido(id,tipo) 
            {
                
                var id = id;
                var tipo = tipo;
                swal({
                        title:"Desea "+ tipo + " el Pedido con el id:" + id +"?",
                        text: "",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Si, Deseo Gestionar!",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("", "", "success");
                        location.href="gestion_pedido.php?id_pedido="+id+"&tipo="+tipo;
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
                                                    <div class="portlet-body form">
														<div class="form-body">
																<?
																$i = 0;
																foreach($result1 as $item)
																	{
																	?>
																		
																			<div class="row">
																				<div class="col-lg-4"></div>
																				<div class="col-md-4 well well-lg">
																					<div class="col-md-3" align="center">
																							<img src="<? echo 'usuarios/'.$item["id_usuario"].'/perfil/'.'mid_perfil.jpg'?>" class="img-responsive pic-bordered">
																					</div>
																						<div class="col-md-6">
																							<div class="row">
																								<label class="control-label"><?php echo nombre_usuario_new( $item['id_usuario'] ) ?></label>
																							</div>
																							<div class="row">
																								<label class="control-label"><?

																									$objConn->where("id", $item["id_producto"]);
																									$producto =  $objConn->select("producto"); 
																									echo $producto[0]['nombre'];
																									echo " "."-"." ";
																									echo $item['cantidad'];  ?>
																								</label>
																							</div>
																							<div class="row">
																								<label class="control-label"><?php 
																									$objConn->where("id", $item["forma_adquisicion"]);
																									$forma_adquisicion =  $objConn->select("forma_adquisicion"); 
																									echo $forma_adquisicion[0]['descripcion']; ?>
																									
																								</label>
																							</div>
																						</div>
																						<div class="col-md-3">
																							<div class="row">
																								<label class="control-label"><?php echo  $item['id']  ?></label>
																							</div>
																							<div class="row"></div>
																							<div class="row">
																								<?
																								if($item['forma_adquisicion']== 1)
																								{
																									?>
																										<input class="btn  btn-circle purple" name="despachar" type="button" id="despachar" value="Despachar" onclick="alertaPedido(<? echo $item['id'] ?>, 'despachar')">
																										 
																									<?
																								}
																								else if ($item['forma_adquisicion']== 2 || $item['forma_adquisicion']== 3 )
																								{
																									?>
																										<input class="btn  btn-circle purple" name="entregar" type="button" id="entregar" value="Entregar" onclick="alertaPedido(<? echo $item['id'] ?>, 'entregar')">
																									   
																											
																									<?
																								}
																								?>
																							</div>
																						</div>
																				</div>
																				<div class="col-lg-4"></div>
																			</div> 
																			<input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario ?>" />
																		
																	<?
																		$i++;
																	}
																 ?>
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
			 <script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
    </body>
</html>