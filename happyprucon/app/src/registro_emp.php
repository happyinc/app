<?php
error_reporting(E_ALL ^ E_NOTICE);
include '../class/sessions.php';
require_once'../../externo/plugins/PDOModel.php';
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
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
    <script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAOTpZg3Uhl0AItmrXORFIsGfJQNJiLHGg" type="text/javascript"></script>
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


<script type="text/javascript">//alert("el tamaño de la imagen es: <? echo $aa?> ")</script>
<script type="text/javascript">//alert("el tamaño de la imagen es: <? echo $archivo_size?> ")</script>
<?
if(isset($_POST['foto'])&& $_FILES['foto']['size'] > 0777){
    $ruta_archivo_a_subir = $_FILES['foto']['tmp_name'];

    $directorio = "usuario/".$usuario."/".$id_producto."";
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

?>
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
                    <div class="portlet light " id="form_wizard_1">
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
                                                    <label class="control-label col-md-4 col-xs-2"></label>
                                                    <div class="input-group left-addon col-md-4 col-xs-2">
                                                        <div class="fileinput fileinput-new img-circle" data-provides="fileinput" style="border-radius: 50%;">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px; border-radius: 50%;">
                                                                <img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" class="img-circle" style="border-radius: 50%;"> </div>
                                                            <div class="fileinput-preview fileinput-exists" style="max-width: 200px; max-height: 200px; border-radius: 50%;"> </div>
                                                            <div>
													<span class="btn default btn-file">
														<span class="fileinput-new"> Select image </span>
														<span class="fileinput-exists"> Change </span>
														<input type="file" name="foto" id="foto"> </span>

                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-newspaper-o"></i>
                                                        </span>
                                                        <select name="tipodoc" id="tipodoc" class="form-control">
                                                            <option></option >
                                                            <?php
                                                            $objDoc = new PDOModel();
                                                            $objDoc->where("id_estado", 1);
                                                            $objDoc->orderByCols = array("descripcion");
                                                            $result =  $objDoc->select("tipos_doc");
                                                            foreach($result as $item){
                                                                ?><option value="<?php echo $item["id"]?>"><?php echo $item["descripcion"]?></option><?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-cc"></i>
                                                        </span>
                                                        <input type="number" class="form-control" name="cedula" id="cedula" placeholder="Identificación" />
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <!--Campos escondidos de rol y aceptacion de terminos-->
                                                <input class="form-control placeholder-no-fix" type="hidden" name="roles" value="<?php echo $rol; ?>"/>
                                                <input class="form-control placeholder-no-fix" type="hidden" name="acep-terms" value="<?php echo $acep_terms; ?>"/>

                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $user_face; ?>" placeholder="Nombres" />
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $ape_face; ?>" placeholder="Apellidos"/>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-tablet"></i>
                                                        </span>
                                                        <input type="number" class="form-control" name="cell" id="cell" value="<?php echo $cell; ?>" placeholder="Celular"/>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" name="username" value="<?php echo $mail; ?>" placeholder="Correo electrónico" />
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-unlock-alt"></i>
                                                        </span>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" />
                                                        <span class="help-block"></span>
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
                                                <h3 class="block bold" style="color: #520d9b">TU ESPECIALIDAD</h3>
                                                <div style="padding-bottom: 50px">
                                                    <h4>
                                                        <p class="font-grey-gallery bold">
                                                            Lo que quieres con lo que tienes
                                                        </p>
                                                    </h4>
                                                </div>
                                                <!-- BEGIN ACCORDION PORTLET-->
                                                    <div class="portlet-body">
                                                        <div class="panel-group accordion" id="accordion1">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <?php
                                                                    $objCat = new PDOModel();
                                                                    $objCat->where("id", 1);
                                                                    $result =  $objCat->select("bienes");
                                                                    foreach($result as $item){
                                                                        ?><h4  class="panel-title bold">
                                                                        <a class="bg-yellow-crusta bg-font-yellow-crusta accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1" value="<?php echo $item["id"]?>"><img src="../../externo/img/logo-default.png"  alt="" /><?php echo $item["nombre"]?></a>
                                                                        </h4><?php

                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div id="collapse_1" class="panel-collapse collapse">
                                                                    <div class="icheck-inline panel-body">
                                                                        <?php
                                                                        $objCat->andOrOperator = "AND";
                                                                        $objCat->where("id_bienes", $item["id"]);
                                                                        $objCat->where("id_estado", 1);
                                                                        $objCat->orderByCols = array("descripcion");
                                                                        $result1 =  $objCat->select("categoria");
                                                                        foreach($result1 as $item1){
                                                                            ?>
                                                                            <label>
                                                                                <input type="checkbox" class="icheck" data-checkbox="icheckbox_line-purple" value="<?php echo $item1["id"]?>" data-label="<?php echo $item1["descripcion"]?>" /></label><?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <?php
                                                                    $objCat = new PDOModel();
                                                                    $objCat->where("id", 2);
                                                                    $result =  $objCat->select("bienes");
                                                                    foreach($result as $item){
                                                                        ?><h4 class="panel-title bold">
                                                                        <a class="bg-yellow-crusta bg-font-yellow-crusta accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2" value="<?php echo $item["id"]?>"><?php echo $item["nombre"]?></a>
                                                                        </h4><?php

                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div id="collapse_2" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        <?php
                                                                        $objCat->andOrOperator = "AND";
                                                                        $objCat->where("id_bienes", $item["id"]);
                                                                        $objCat->where("id_estado", 1);
                                                                        $objCat->orderByCols = array("descripcion");
                                                                        $result1 =  $objCat->select("categoria");
                                                                        foreach($result1 as $item1){
                                                                            ?><label>
                                                                                <input type="checkbox" class="icheck" data-checkbox="icheckbox_line-purple" value="<?php echo $item1["id"]?>" data-label="<?php echo $item1["descripcion"]?>" /></label><?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>
                                                    </div>

                                                <!-- END ACCORDION PORTLET-->
                                            </div>
                                            <div class="tab-pane" id="tab3">
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


                                                    var mostrarUbicacion = function() {
                                                        var ciudade;
                                                        ciudade = document.getElementById('resciu').value = document.getElementById('ciudad').value;
                                                        var dir;
                                                        dir = document.getElementById('resdir').value = document.getElementById('direccion').value;

                                                        var ubica = ciudade+","+dir;
                                                        // Creamos el objeto geodecoder
                                                        var geocoder = new google.maps.Geocoder();

                                                        address = document.getElementById('search').value=ubica;
                                                        if (address != '') {
                                                            // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
                                                            geocoder.geocode({'address': address}, function (results, status) {
                                                                if (status == 'OK') {
                                                                    // Mostramos las coordenadas obtenidas en el p con id coordenadas
                                                                    document.getElementById('latitud').value = results[0].geometry.location.lat();
                                                                    document.getElementById('longitu').value = results[0].geometry.location.lng();

                                                                }
                                                            });
                                                        }
                                                    }


                                                </script>
                                                <h3 class="block bold" style="color: #520d9b">TU UBICACIÓN</h3>
                                                <div style="padding-bottom: 50px">
                                                    <h4>
                                                        <p class="font-grey-gallery bold">
                                                            Lo que quieres con lo que tienes
                                                        </p>
                                                    </h4>
                                                </div>
                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-flag"></i>
                                                        </span>
                                                        <input class="form-control" name="ciudad" id="ciudad" type="text" size="50" autocomplete="on" placeholder="Ciudad" />
                                                        <!-- Campo escondido que toma valor de ciudad -->
                                                        <input type="text" name="resciu" id="resciu" >
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-home"></i>
                                                        </span>
                                                        <select name="tipodom" id="tipodom" class="form-control">
                                                            <option value="">Tipo vivienda</option>
                                                            <option value="1">Apartamento</option>
                                                            <option value="2">Casa</option>
                                                            <option value="3">Oficina</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input has-info">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="input-group left-addon col-md-4">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-map-signs"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="direccion" id="direccion" onchange="mostrarUbicacion();" placeholder="Dirección"/>
                                                        <span class="help-block"></span>
                                                        <!-- Campo escondido que toma valor de direccion -->
                                                        <input type="text" name="resdir" id="resdir">
                                                    </div>
                                                    <div><input type="text" id="search"/></div>
                                                    <!-- Campos escondidos que toman valores de coordenadas -->
                                                    <div><input type="text" id="latitud" name="latitud"/></div>
                                                    <div><input type="text" id="longitu" name="longitu"/></div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <h3 class="block bold" style="color: #520d9b">FOTOS DEL SITIO</h3>
                                                <div style="padding-bottom: 50px">
                                                    <h4>
                                                        <p class="font-grey-gallery bold">
                                                            Lo que quieres con lo que tienes
                                                        </p>
                                                    </h4>
                                                </div>
                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                    <label class="control-label col-md-4 col-xs-4"></label>
                                                    <div class="input-group left-addon col-md-4 col-xs-4">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                                <img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"> </div>
                                                            <div>
													<span class="btn default btn-file">
														<span class="fileinput-new"> Select image </span>
														<span class="fileinput-exists"> Change </span>
														<input type="file" name="foto" id="foto"> </span>

                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    <script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
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