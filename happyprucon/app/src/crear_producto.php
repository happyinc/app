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
        <meta charset="utf-8" />
        <title>Metronic Admin Theme #2 | Blank Page Layout</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for blank page layout" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../../assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../../assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../../assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../../assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
		 <?
		 include ("../../../externo/plugins/PDOModel.php");
		 
		/* if(isset($_POST["formulario"]) && $_POST["formulario"] == "crear_producto")
		 {
			 var_dump();
			$insertEmpData["categoria"] = $_POST["categoria"];
			$insertEmpData["nombre"] = $_POST["nombre"]; 
			$insertEmpData["descripcion"] = $_POST["descripcion"];
			$insertEmpData["precio"] = $_POST["precio"];
			//$insertEmpData["foto"] = $_POST["foto"];
			$insertEmpData["fecha"] = date("Y-m-d H:i:s"); 
			$insertEmpData["estado"] = 1; 
			$pdomodel->insert("producto", $insertEmpData);
			
		 }*/
			
		 
		?>
		
		</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="index.html">
                        <img src="../../assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" /> </a>
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
                <div class="page-actions">
                    <div class="btn-group">
                        <button type="button" class="btn btn-circle btn-outline red dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i>&nbsp;
                            <span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-docs"></i> New Post </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-tag"></i> New Comment </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-share"></i> Share </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-flag"></i> Comments
                                    <span class="badge badge-success">4</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-users"></i> Feedbacks
                                    <span class="badge badge-danger">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END PAGE ACTIONS -->
				<!-- BEGIN HEADER -->
					<?
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
			<?
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
                        <div class="toggler tooltips" data-container="body" data-placement="left" data-html="true" data-original-title="Click to open advance theme customizer panel">
                            <i class="icon-settings"></i>
                        </div>
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

                    <div class="portlet-body form">
						<form role="form" class="form-horizontal" name="crear_producto"  id="crear_producto" action="crear_producto.php" enctype="multipart/form-data" method="post">
                            <div class="form-body">

                                <div class="form-group form-md-line-input has-danger">
                                    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        <div class="input-icon">
                                            <select class="form-control" id="categoria" name="categoria">
                                                    <option value="">Seleccione la categoria</option>
                                                    <?
														$pdomodel = new PDOModel();
														$pdomodel->columns = array("id,nombre");
														$pdomodel->where("estado", 1);
														$pdomodel->orderByCols = array("nombre");
														$result =  $pdomodel->select("bienes");
                                                        var_dump($pdomodel); die;
                                                        while($rs2=mysql_fetch_array($result))
                                                        {
                                                                ?><option value="<? echo $rs2["id"]?>"><? echo $rs2["nombre"] ?></option><?
                                                        }
                                                    ?>
                                                </select>
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block">Seleccione la categoria del producto a crear</span>
                                                <i class="fa fa-clone"></i>
									
                                        </div>
                                    </div>
                                </div>
								
								<div class="form-group form-md-line-input has-danger">
                                    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        <div class="input-icon">
                                            <select class="form-control" id="subcategoria" name="subcategoria">
                                                    <option value="">Seleccione la subcategoria</option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block">Seleccione la subcategoria del producto a crear</span>
                                                <i class="fa fa-clone"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input has-danger">
                                    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block required">Digite el nombre del producto a crear *</span>
                                                <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input has-danger">
                                    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        <div class="input-icon">
                                            <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripcion del producto"></textarea>
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block">Digite la descripcion del producto a crear</span>
                                                <i class="fa fa-file-text-o"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input has-danger">
                                    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        <div class="input-icon">
                                            <input type="number" class="form-control" id="precio" name="precio" placeholder="Valor del producto">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block required">Digite el valor del producto a crear *</span>
                                                <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input has-danger">
                                    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                        <div class="input-icon">
                                            <div>
                                            <label class="control-label col-md-3">¿Tiene composicion?
                                                <span class="required"> * </span>
                                            </label>
                                            </div>
                                            <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="si" name="si" class="md-radiobtn" value="si">
                                                        <label for="radio6">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Si</label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="no" name="no" class="md-radiobtn" value="no"checked="">
                                                        <label for="radio7">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> No </label>
                                                    </div>
                                            </div>
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
									<input type="button" class="btn green button-submit" onclick="javascript: validar();" name="guardar" id="guardar" value="Crear producto"/>
                                    <input type="hidden" id="formulario" name="formulario" value="crear_producto"/>
								</div>
                                
                            </div>
                        </form>
                    </div>
                    
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
        </div>
        <!-- END CONTAINER -->
		 <!-- BEGIN FOOTER -->
        <?
            include "footer.php";
        ?>
        <!-- END FOOTER -->
            <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
            <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
            <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="../../assets/global/scripts/app.min.js" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="../../assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
            <script src="../../assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
            <script src="../../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
            <script src="../../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
            <!-- END THEME LAYOUT SCRIPTS -->
            <script>
                $(document).ready(function()
                {
                    $('#clickmewow').click(function()
                    {
                        $('#radio1003').attr('checked', 'checked');
                    });
                })
            </script>
    </body>

</html>