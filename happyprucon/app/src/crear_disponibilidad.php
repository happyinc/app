<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            .icheckbox_line-purple, .iradio_line-purple{
                background: #5F059E !important;
                border-radius: 15px !important;
            }

        </style>
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
				<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css"/>
				<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
				<link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
				<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
				<link href="../assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
				<link href="../assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
					 
				<?php
				include("nombre_cabezera.php");
				include("menu_modal.php");
				
			?>
		<title><? echo $nombre_pagina ?></title>
        
    </head>
    <!-- END HEAD -->
    <body class="page-header-default page-sidebar-closed-hide-logo page-container-bg-solid" style="text-align: center;background-color:white;" bgcolor="#ffffff" ><!--onload="alertaDisponibilidadCreada()-->

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
                                                            <!-- se neceita un icono, aqui !! -->
                                                            <? echo nombre_producto($id_producto)?>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body form">
														<form role="form" class="form-horizontal" name="crear_disponibilidad"  id="crear_disponibilidad" action="gestion_producto.php" enctype="multipart/form-data" method="post">
															<div class="form-body">
																<div class="form-group">
                                                                    <div class="col-lg-1 col-md-1 col-sm-1"></div>
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<label class="control-label col-md-4 col-sm-3">Seleccione la vigencia de la disponibilidad</label>
																		<div class="col-md-4 col-sm-4">
																			<div class="input-group date form_datetime bs-datetime" data-date-format="yyyy mm dd HH:ii p">
																				<input class="form-control" size="16" type="text" name="fecha_inicio" id="fecha_inicio" value="" readonly="">
																				<span class="input-group-addon">
																					<button class="btn default date-reset" type="button">
																						<i class="fa fa-times"></i>
																					</button>
																				</span>
																				<span class="input-group-addon">
																					<button class="btn default date-set" type="button">
																						<i class="fa fa-calendar"></i>
																					</button>
																				</span>
																			</div>
																			<span class="help-block">fecha inicio</span>
																		</div>
																		 
																		<div class="col-md-4 col-sm-4">
																			<div class="input-group date form_datetime bs-datetime" data-date-format="yyyy mm dd HH:ii p">
																				<input class="form-control" size="16" type="text" name="fecha_fin" id="fecha_fin" value="" readonly="">
																				<span class="input-group-addon">
																					<button class="btn default date-reset" type="button">
																						<i class="fa fa-times"></i>
																					</button>
																				</span>
																				<span class="input-group-addon">
																					<button class="btn default date-set" type="button">
																						<i class="fa fa-calendar"></i>
																					</button>
																				</span>
																			</div>
																			<span class="help-block">fecha fin</span>
																		</div>

																	</div>
																</div>
																
																<div class="form-group">
                                                                    <div class="col-lg-1 col-md-1"></div>
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<label class="col-md-4 col-sm-3 control-label">Seleccione la cantidad disponible</label>
																			<div class="col-md-8 col-sm-9">
																				<input id="cantidad" name="cantidad_disponible"  value="" type="text" />
																				<span class="help-block"> Establezca la cantidad disponible</span>
																			</div>
																	</div>
																</div>

																<div class="form-group">
                                                                    <div class="col-lg-1 col-md-1"></div>
																	<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
																		<label class="col-md-4 col-sm-3 control-label">Seleccione la forma de adquisicion</label>
																			<div class="col-md-8 col-sm-9">
																				<div class="input-group">
																					<div class="icheck-list">
																					   <?php
																							$objFor = new PDOModel();
																							$objFor->where("id_estado", 1);
																							$objFor->orderByCols = array("descripcion");
																							$result1 =  $objFor->select("forma_adquisicion");
																							foreach($result1 as $item1){
																								?>
																								<label>
																									<input type="checkbox" class="icheck" name="forma_adquisicion[]" id="forma_adquisicion[]" data-checkbox="icheckbox_line-purple" value="<?php echo $item1["id"]?>" data-label="<?php echo $item1["descripcion"]?>" />
																								</label>
																								<?php
																							} 
																						?>
																					</div>
																				</div>
																			</div>
																	</div>
																</div>
															   <div class="form-actions">
																	<div class="col-md-offset-3 col-md-6">
																		<button type="submit" class="btn btn-circle" name="guardar" id="guardar" value="guardar" style="background-color: #5F059E; color:white;"> Crear disponibilidad </button>
																		<input type="hidden" id="formulario" name="formulario" value="crear_disponibilidad"/>
																		<input type="hidden" id="id_producto" name="id_producto" value="<? echo $id_producto ?>" />
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
			 <!--alertas-->
            <script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
            <!--fechas-->
			<script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
             <!--rango-->
            <script src="../assets/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
            <script src="./../assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/components-ion-sliders.js" type="text/javascript"></script>
             <!--checkbox-->
            <script src="../assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
            <script src="../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
            <script type="text/javascript">
			  // demo 5
                $("#cantidad").ionRangeSlider({
                    grid: true,
                    from: 0,
                    to: 5,
                    values: [1, 2, 3, 4, 5]
                });


                 $(function () {
                    $('#datetimepicker6').datetimepicker();
                    $('#datetimepicker7').datetimepicker({
                        useCurrent: false //Important! See issue #1075
                    });
                    $("#datetimepicker6").on("dp.change", function (e) {
                        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                    });
                    $("#datetimepicker7").on("dp.change", function (e) {
                        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                    });
                });
            </script>
    </body>
</html>