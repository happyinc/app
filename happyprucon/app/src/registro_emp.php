<?php
error_reporting(E_ALL ^ E_NOTICE);
include '../class/sessions.php';
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
    <title>Metronic Admin Theme #2 | Bootstrap Form Wizard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #2 for bootstrap form wizard demos using Twitter Bootstrap Wizard Plugin" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="../assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="../assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="../assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<?php
$acep_terms = $_POST['acepta'];

$objSe->init();
//variables recibidas para registro facebook
$user_face = isset($_SESSION['nom-face']) ? $_SESSION['nom-face'] : null ;
$ape_face = isset($_SESSION['ape-face']) ? $_SESSION['ape-face'] : null ;
$mail_face = isset($_SESSION['mail']) ? $_SESSION['mail'] : null ;

//variables de sesion para accounkit
$cell = $_SESSION['phone']['national_number'];

$correo = $_SESSION['email']['address'];

$rol_emp = isset($_SESSION['emprende']) ? $_SESSION['emprende'] : null ;
$rol_cli = isset($_SESSION['cliente']) ? $_SESSION['cliente'] : null ;

//variables recibidas del rol escogido
if($rol_emp != ""){
    $rol = $rol_emp;
}

if($rol_cli != ""){
    $rol = $rol_cli;
}

//condicionales para unificar variables de correo
if($correo != ""){
    $mail = $correo;
}

if($mail_face != ""){
    $mail = $mail_face;
}


?>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-content">
    <!-- BEGIN CONTENT -->

        <!-- BEGIN CONTENT BODY -->
        <div class="page-content col-lg-12">
            <!-- BEGIN PAGE HEADER-->

            <!-- END PAGE HEADER-->
            <div class="col-lg-12">
                <div class="col-md-12">
                    <div class="portlet light " id="">
                        <div class="portlet-title">


                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" action="../class/registrar.php" id="submit_form" method="POST">
                                <div class="form-wizard">
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li>
                                                <a href="#tab1" data-toggle="tab" class="step">
                                                    <span class="number"> 1 </span>
                                                    <span class="desc">
                                                                <i class="fa fa-check"></i> Datos </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab2" data-toggle="tab" class="step">
                                                    <span class="number"> 2 </span>
                                                    <span class="desc">
                                                                <i class="fa fa-check"></i> Especialidad </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab3" data-toggle="tab" class="step active">
                                                    <span class="number"> 3 </span>
                                                    <span class="desc">
                                                                <i class="fa fa-check"></i> Ubicación </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab4" data-toggle="tab" class="step">
                                                    <span class="number"> 4 </span>
                                                    <span class="desc">
                                                                <i class="fa fa-check"></i> Fotos </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div id="bar" class="progress progress-striped" role="progressbar">
                                            <div class="progress-bar progress-bar-success"> </div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="alert alert-danger display-none">
                                                <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-none">
                                                <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                            <div class="tab-pane active" id="tab1">

                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-newspaper-o"></i>
                                                        </span>
                                                        <select name="tipodoc" id="tipodoc" class="form-control">
                                                            <option value=""></option>
                                                            <option value="1">Cedula de ciudadania</option>
                                                            <option value="2">Cedula de extranjeria</option>
                                                            <option value="3">Pasaporte</option>
                                                        </select>
                                                        <label>Tipo documento</label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3">

                                                    </label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-cc"></i>
                                                        </span>
                                                        <input type="number" class="form-control" name="cedula" id="cedula" />
                                                        <label>Identificación</label>
                                                    </div>
                                                </div>

                                                <!--Campos escondidos de rol y aceptacion de terminos-->
                                                <input class="form-control placeholder-no-fix" type="hidden" name="roles" value="<?php echo $rol; ?>"/>
                                                <input class="form-control placeholder-no-fix" type="hidden" name="acep-terms" value="<?php echo $acep_terms; ?>"/>

                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $user_face; ?>" />
                                                        <label>Nombres</label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $ape_face; ?>" />
                                                        <label>Apellidos</label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-tablet"></i>
                                                        </span>
                                                        <input type="number" class="form-control" name="cell" id="cell" value="<?php echo $cell; ?>" />
                                                        <label>Celular</label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" name="username" value="<?php echo $mail; ?>"  />
                                                        <label>Correo electrónico</label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-unlock-alt"></i>
                                                        </span>
                                                        <input type="password" class="form-control" id="password" name="password" />
                                                        <label>Contraseña</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">

                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="radio-list">
                                                            <label>
                                                                <input type="radio" name="genero" value="Masculino" class="icheck"> Masculino </label>
                                                            <label>
                                                                <input type="radio" name="genero" value="Femenino" checked class="icheck"> Femenino </label>
                                                        </div>
                                                        <div id="form_gender_error"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <h3 class="block">TU ESPECIALIDAD</h3>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Fullname
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="fullname" />
                                                        <span class="help-block"> Provide your fullname </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Phone Number
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="phone" />
                                                        <span class="help-block"> Provide your phone number </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Gender
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="radio-list">
                                                            <label>
                                                                <input type="radio" name="gender" value="M" data-title="Male" /> Male </label>
                                                            <label>
                                                                <input type="radio" name="gender" value="F" data-title="Female" /> Female </label>
                                                        </div>
                                                        <div id="form_gender_error"> </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Address
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="address" />
                                                        <span class="help-block"> Provide your street address </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">City/Town
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="city" />
                                                        <span class="help-block"> Provide your city or town </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Country</label>
                                                    <div class="col-md-4">
                                                        <select name="country" id="country_list" class="form-control">
                                                            <option value=""></option>
                                                            <option value="AF">Afghanistan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Remarks</label>
                                                    <div class="col-md-4">
                                                        <textarea class="form-control" rows="3" name="remarks"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab3">

                                                <h3 class="block">TU UBICACIÓN</h3>
                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-flag"></i>
                                                        </span>
                                                        <input class="form-control" name="ciudad" id="ciudad" type="text" size="50" autocomplete="on">
                                                        <script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAOTpZg3Uhl0AItmrXORFIsGfJQNJiLHGg" type="text/javascript"></script>
                                                        <script type="text/javascript">
                                                            function initialize() {
                                                                var options = {
                                                                    types: ['(regions)'],
                                                                    componentRestrictions: {country: "co"}
                                                                };
                                                                var input = document.getElementById('ciudad');
                                                                var autocomplete = new google.maps.places.Autocomplete(input , options);
                                                            }
                                                            google.maps.event.addDomListener(window, 'load', initialize);
                                                        </script>

                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-home"></i>
                                                        </span>
                                                        <select name="tipo-dom" id="tipo-dom" class="form-control">
                                                            <option value=""></option>
                                                            <option value="1">Apartamento</option>
                                                            <option value="2">Casa</option>
                                                            <option value="3">Oficina</option>
                                                        </select>
                                                        <label>Tipo de Domicilio</label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-map-signs"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="direccion" id="direccion"/>
                                                        <label>Dirección</label>
                                                    </div>
                                                </div>


                                                <script>

                                                    mapa = {
                                                        // función que se ejecuta al pulsar el botón buscar dirección
                                                        getCoords : function()
                                                        {
                                                            // Creamos el objeto geodecoder
                                                            var geocoder = new google.maps.Geocoder();

                                                            address = document.getElementById('search').value;
                                                            if(address!='')
                                                            {
                                                                // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
                                                                geocoder.geocode({ 'address': address}, function(results, status)
                                                                {
                                                                    if (status == 'OK')
                                                                    {
                                                                        // Mostramos las coordenadas obtenidas en el p con id coordenadas
                                                                        document.getElementById("coordenadas").innerHTML='Coordenadas:   '+results[0].geometry.location.lat()+', '+results[0].geometry.location.lng();
                                                                        // Posicionamos el marcador en las coordenadas obtenidas
                                                                        mapa.marker.setPosition(results[0].geometry.location);
                                                                        // Centramos el mapa en las coordenadas obtenidas
                                                                        mapa.map.setCenter(mapa.marker.getPosition());
                                                                        agendaForm.showMapaEventForm();
                                                                    }
                                                                });
                                                            }
                                                        }
                                                    }
                                                </script>
                                                <div><p id="coordenadas"></p></div>
                                                <input type="text" id="search"> <input type="button" value="Buscar Dirección" onClick="mapa.getCoords()">
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <h3 class="block">FOTOS DEL SITIO</h3>






                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="javascript:;" class="btn default button-previous">
                                                    <i class="fa fa-angle-left"></i> Atras </a>
                                                <a href="javascript:;" class="btn btn-outline green button-next"> Siguiente
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <a href="javascript:;" class="btn green button-submit"> Submit
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->

    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
    <!--[if lt IE 9]>
    <script src="../assets/global/plugins/respond.min.js"></script>
    <script src="../assets/global/plugins/excanvas.min.js"></script>
    <script src="../assets/global/plugins/ie8.fix.min.js"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/wizard-user.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
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