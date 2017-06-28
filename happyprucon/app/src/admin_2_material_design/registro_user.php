<?php
error_reporting(E_ALL ^ E_NOTICE);
include '../../class/sessions.php';
$objSe = new Sessions();
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
        <meta charset="utf-8" />
        <title>Logueo</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for " name="description" />
        <meta content="" name="author" />
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../../assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../../assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../../assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="../../assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
	<?php 
	   
$objSe->init();
		
		
		$cell = $_SESSION['phone']['national_number'];	
		
		$correo = $_SESSION['email']['address'];
		
		$rol_emp = $_POST['emprende'];
		if($rol_emp != ""){
			$rol = $rol_emp;
		}
		
		$rol_cli = $_POST['cliente'];
		if($rol_cli != ""){
			$rol = $rol_cli;
		}
		
?>
    <body class=" login">
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="../../class/registrar.php" method="post">
                <h3>Regístrate</h3>
                <br />
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Seleccione tipo documento</label>
                    <select name="tipodoc" class="form-control">
                        <option value="">Seleccione tipo documento</option>
                        <option value="1">Cedula de ciudadania</option>
                        <option value="2">Cedula de extranjeria</option>
                        <option value="3">Pasaporte</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Identificación</label>
                    <input class="form-control placeholder-no-fix" type="number" placeholder="Identificación" name="cedula" />
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Nombres</label>
					<input class="form-control placeholder-no-fix" type="hidden" name="roles" value="<?php echo $rol; ?>"/>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Nombres" name="fullname" />
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Apellidos</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Apellidos" name="lastname" />
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Celular</label>
                    <input class="form-control placeholder-no-fix" type="number" placeholder="Celular" name="cell" value="<?php echo $cell; ?>" />
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Correo Electrónico</label>
                    <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Correo Electrónico" name="username" value="<?php echo $correo; ?>" />
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Contraseña" name="password" />
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="icheck-inline">
                                <label>
                                    <input type="radio" name="genero" value="Masculino" class="icheck"> Masculino </label>
                                <label>
                                    <input type="radio" name="genero" value="Femenino" checked class="icheck"> Femenino </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="selec_log.html" id="register-back-btn" type="button" class="btn grey-salsa btn-outline"> Atras </a>
                    <button type="submit" id="register-submit-btn" class="btn blue pull-right" name="registrar" id="registrar"> Regístrate </button>
                </div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <!-- END LOGIN -->
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
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../../assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
        <script src="../../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../../assets/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
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