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
				?>
				<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
				<?
				include("nombre_cabezera.php");
				include("menu_modal.php");
				
				$objConn = new PDOModel();
        
				$comodin = " AND 2=1";

				if(isset($_POST["formulario"]) && $_POST["formulario"] == "ver_pagos" )
				{
					if($_POST["fecha_i"]!= "" && $_POST["fecha_f"]!=""  )
					{

						$date1 = new DateTime("".$_POST["fecha_i"]."");
						$date2 = new DateTime("".$_POST["fecha_f"]."");

						if($date1 <=  $date2)
						{
							$fecha_i=$_POST["fecha_i"];
							$fecha_f=$_POST["fecha_f"];

						  
							$comodin = "AND A.fecha BETWEEN '".$fecha_i."' AND '".$fecha_f."'" ;
						} 
						else
						{
							?><script type="text/javascript">alert("La fecha final no puede ser menor que la fecha de inicio");
							  location.href="ver_pagos.php?id_usuario=<? echo $id_usuario ?>";
							</script><?

						}  
					}
					else 
					{
					   $comodin = "";
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
														<form role="form" class="form-horizontal" name="ver_pagos"  id="ver_pagos" action="ver_pagos.php" enctype="multipart/form-data" method="post">
															<div class="form-body">
																
																<div class="form-group"  align="center">
																	<label class="control-label col-md-2">Fecha Inicio</label>
																	<div class="col-md-2">
																		<input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy-mm-dd" name="fecha_i" id="fecha_i" size="16" type="text" value="">
																		<span class="help-block"> Seleccione la fecha de inicio </span>
																	</div>
																
																	<label class="control-label col-md-2">Fecha Fin</label>
																	<div class="col-md-2">
																		<input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy-mm-dd" name="fecha_f" id="fecha_f" size="16" type="text" value="">
																		<span class="help-block"> Seleccione la fecha fin </span>
																	</div>
																</div>
																

																<div class="form-actions">
																	<div class="col-md-4"></div>
																	<div class="col-md-4"  align="center">
																		<input class="btn  btn-circle" name="consultar" type="submit" id="consultar" value="Consultar" style="background-color:#5F059E; color: white; padding: 10px; font-size: 13px;">
																		<input type="hidden" id="formulario" name="formulario" value="ver_pagos"/>
																		<input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario ?>" />
																	</div>
																	<div class="col-md-4"></div>
																</div>
															</div>
														</form>
														<div class="portlet box" style="background-color:#5F059E;">
															<div class="portlet-title">
																<div class="caption">
																	<i class="fa fa-money" style="color:white;"></i>Pagos de Happy
																</div>
															</div>
															<div class="portlet-body flip-scroll">
																<table class="table table-bordered table-striped table-condensed flip-content">
																	<thead class="flip-content">
																		<tr>
																			<th class="numeric"> No pedido </th>
																			<th> Fecha pedido </th>
																			<th> Cliente </th>
																			<th> Producto o servicio </th>
																			<th class="numeric"> Valor unitario </th>
																			<th class="numeric"> Valor total </th>
																			<th class="numeric"> Comision Happy </th>
																			<th class="numeric"> Valor a pagar </th>
																		</tr>
																	</thead>
																	<tbody>
																		<?

																		
																		$result1 = $objConn->executeQuery("SELECT A.id, A.id_usuario, A.fecha, A.precio as total, A.cantidad, A.comision, A.cxp, B.nombre, B.precio FROM pedido A, producto B WHERE A.id_producto= B.id AND A.id_estado=9 $comodin AND B.id_usuario= '".$id_usuario."';");
																		foreach($result1 as $item)
																		{
																		?>
																			<tr>
																				<td class="numeric"> <? echo $item["id"]?> </td>
																				<td> <? echo $item["fecha"]?> </td>
																				<td> <? echo  nombre_usuario_new($item["id_usuario"])?> </td>
																				<td> <? echo $item["nombre"]?> </td>
																				<td class="numeric"><? echo $item["precio"]?> </td>
																				<td class="numeric"><? echo $item["total"]?> </td>
																				<td class="numeric"><? echo $item["comision"]?> </td>
																				<td class="numeric"><? echo $item["cxp"]?> </td>
																			</tr>
																			<?
																		 
																		}; 
																		?>
																	</tbody>
																</table>
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
			<script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    </body>
</html>