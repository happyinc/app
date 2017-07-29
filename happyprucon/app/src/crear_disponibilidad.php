<?php
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once'../../externo/plugins/PDOModel.php';
	require'../class/sessions.php';
	$objSe = new Sessions();
	$objSe->init();

	$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
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
		$id_producto = "";
    
        if(isset($_POST["id_producto"]) && $_POST["id_producto"] != "")
        {
            $id_producto = $_POST["id_producto"];
        }
        elseif(isset($_GET["id_producto"]) && $_GET["id_producto"] != "")
        {
             $id_producto = $_GET["id_producto"];
        }
        
		include "include_css.php";
		
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
        $id_disponibilidad=0;
        if(isset($_POST["formulario"]) && $_POST["formulario"] == "crear_disponibilidad")
        {
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
                $insertData["id_usuario"] = $usu_id ;
                $objConn->insert('disponibilidad', $insertData);

                $id_disponibilidad= $objConn->lastInsertId;
                //print_r($objConn->error);

                if($id_disponibilidad!= "")
                {
                    //insert a la tabla producto_disponibilidad
                    $insertPd["id_producto"] = $id_producto;
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
        ?>

        <script>
        function alertaDisponibilidadCreada() 
        {
            var id_disponibilidad=<?echo $id_disponibilidad?>;
            if(id_disponibilidad >=1)
            {
                        swal({
                                title:"Se registro la disponibilidad:" + <? echo $id_disponibilidad?>,
                                text: "para el producto:"+<? echo $id_producto?>,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Aceptar",
                                cancelButtonText: "No",
                                closeOnConfirm: false,
                                closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                swal("", "Disponibilidad creada y asignada al producto"+<? echo $id_producto?>, "success");
                                location.href="gestion_producto.php";
                            }
                        });
            }
        }
        </script>
		
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md" onload="alertaDisponibilidadCreada()">
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
                    <h1 class="page-title"> Crear disponibilidad
                        <small>creacion de disponibilidades</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="gestion_pedido.php">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Crear disponibilidad</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Creacion de disponibilidades</span>
                            </li>
                        </ul>
                        
                    <!-- END PAGE HEADER-->
					</div>
					<div class="portlet light">
						<div class="portlet-body form">
							<form role="form" class="form-horizontal" name="crear_disponibilidad"  id="crear_disponibilidad" action="crear_disponibilidad.php" enctype="multipart/form-data" method="post">
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <label class="control-label col-md-4">Seleccione la vigencia de la disponibilidad</label>
											<div class="col-md-3">
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
                                             
                                            <div class="col-md-3">
                                                <div class="input-group date form_datetime bs-datetime" data-date-format="yyyy mm dd HH:ii p"><!--Y-m-d H:i:s-->
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
										<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <label class="col-md-4 control-label">Seleccione la cantidad disponible</label>
                                                <div class="col-md-8">
                                                    <input id="cantidad" name="cantidad_disponible"  value="" type="text" />
                                                    <span class="help-block"> Establezca la cantidad disponible</span>
                                                </div>
										</div>
									</div>

                                    <div class="form-group">
                                        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                            <label class="col-md-4 control-label">Seleccione la forma de adquisicion</label>
                                                <div class="col-md-8">
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
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle purple" name="guardar" id="guardar" value="guardar"> Crear disponibilidad </button>
                                            <input type="hidden" id="formulario" name="formulario" value="crear_disponibilidad"/>
                                            <input type="hidden" id="id_producto" name="id_producto" value="<? echo $id_producto ?>" />
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
                    from: 1,
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