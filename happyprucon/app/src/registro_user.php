<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once'../../externo/plugins/PDOModel.php';
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
    <title>Logueo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #2 for " name="description" />
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
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="../assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="../assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAOTpZg3Uhl0AItmrXORFIsGfJQNJiLHGg" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
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
    $gustos = "TU ESPECIALIDAD";
    $escoge_gusto = "Cuales son tus especialidades";
    $fotos_sitio = "Ya casi terminas, sube las fotos del sitio";
    $index = "fotos_sitio.php";
}

if($rol_cli != ""){
    $rol = $rol_cli;
    $gustos = "TUS GUSTOS";
    $escoge_gusto = "Cuales son tus gustos";
    $index = "main.php";
}

//condicionales para unificar variables de correo
if($correo != ""){
    $mail = $correo;
}

if($mail_face != ""){
    $mail = $mail_face;
}
$id_usuario = 0;
if(isset($_POST["formulario"]) && $_POST["formulario"] == "Registrar" ) {


    $objConn = new PDOModel();
    $insertUserData["id_doc"] = $_POST['tipodoc'];
    $insertUserData["id_termino"] = $_POST['acep-terms'];
    $insertUserData["id_estado"] = 1;
    $insertUserData["id_roles"] = $_POST['roles'];
    $insertUserData["nombre_completo"] = $_POST['fullname'] . " " . $_POST['lastname'];
    $insertUserData["nombre"] = $_POST['fullname'];
    $insertUserData["apellido"] = $_POST['lastname'];
    $insertUserData["genero"] = $_POST['genero'];
    $insertUserData["telefono"] = $_POST['cell'];
    $insertUserData["correo"] = $_POST['username'];
    $insertUserData["password"] = md5($_POST['password']);
    $insertUserData["numero_doc"] = $_POST['cedula'];
    $insertUserData["direccion"] = $_POST['direccion'];
    $insertUserData["latitud"] = $_POST['latitud'];
    $insertUserData["longitud"] = $_POST['longitu'];
    $insertUserData["meta"] = $_POST['meta'];
    $objConn->insert("usuarios", $insertUserData);
    $id_usuario = $objConn->lastInsertId;

    $insertSe["id_usuario"] = $id_usuario;
    $insertSe["origen"] = "W";
    $insertSe["f_login"] = date("Y-m-d H:i:s");
    $insertSe["estado"] = "A";
    $insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
    $objConn->insert("sesion", $insertSe);
    $ultima_sesion = $objConn->lastInsertId;

    if ($id_usuario != "") {

        $objConn->where("id",$id_usuario);
        $res_usu =  $objConn->select("usuarios");

        $objSe->init();
        $objSe->set('sesion_activa',$ultima_sesion);
        $objSe->set('id_usuario', $res_usu[0]['id']);
        $objSe->set('id_roles', $res_usu[0]['id_roles']);
        $objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
        $objSe->set('nombre', $res_usu[0]['nombre']);
        $objSe->set('apellido', $res_usu[0]['apellido']);
        $objSe->set('genero', $res_usu[0]['genero']);
        $objSe->set('telefono', $res_usu[0]['telefono']);
        $objSe->set('correo', $res_usu[0]['correo']);
        $objSe->set('suenos', $res_usu[0]['meta']);
        $objSe->set('origen',$_POST['form_login']);


        //Recorre el array para insertar los datos en la tabla de gustos
        $bienes = $_POST["categoria"];

        foreach ($bienes  as $clave => $valor){
            $id_catagoria = $valor;
            $objConn = new PDOModel();
            $insertUserGusto["id_usuario"] = $id_usuario;
            $insertUserGusto["id_categoria"] = $id_catagoria;
            $insertUserGusto["id_estado"] = 1;
            $objConn->insert("gustos", $insertUserGusto);
        }

        $objConn = new PDOModel();
        $insertVigenciAcepta["id_usuario"] = $id_usuario;
        $insertVigenciAcepta["termino_condicion_id"] = $_POST['acep-terms'];
        $insertVigenciAcepta["rol_id"] = $_POST['roles'];
        $objConn->insert("vigencias_aceptadas", $insertVigenciAcepta);

        if ($_FILES['foto']["size"] >= 1) {
            // Primero, hay que validar que se trata de un JPG/GIF/PNG
            $allowedExts = array("jpg", "jpeg", "gif", "png", "bmp", "JPG", "JPEG", "GIF", "PNG", "BMP");
            $extension = end(explode(".", $_FILES["foto"]["name"]));
            if ((($_FILES["foto"]["type"] == "image/gif")
                    || ($_FILES["foto"]["type"] == "image/jpeg")
                    || ($_FILES["foto"]["type"] == "image/png")
                    || ($_FILES["foto"]["type"] == "image/gif")
                    || ($_FILES["foto"]["type"] == "image/bmp"))
                && in_array($extension, $allowedExts)) {
                // el archivo es un JPG/GIF/PNG, entonces...

                $extension = end(explode('.', $_FILES['foto']['name']));
                $foto = "perfil". "." . $extension;
                $directorio = "usuarios/" . $id_usuario . "/perfil/"; // directorio de tu elección
                if (file_exists($directorio)) {

                } else {
                    mkdir($directorio, 0777, true);
                }

                // almacenar imagen en el servidor
                move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . '/' . $foto);
                $minFoto = 'min_' . $foto;
                $midFoto = 'mid_' . $foto;
                $resFoto = 'res_' . $foto;
                resizeImagen($directorio . '/', $foto, 45, 45, $minFoto, $extension);
                resizeImagen($directorio . '/', $foto, 80, 80, $midFoto, $extension);
                resizeImagen($directorio . '/', $foto, 600, 600, $resFoto, $extension);
                unlink($directorio . '/' . $foto);

            } else { // El archivo no es JPG/GIF/PNG
                $malformato = $_FILES["foto"]["type"];
                ?>
                <script type="text/javascript">alert("La imagen se encuentra con formato incorrecto")</script>
                <?
                //header("Location: crear_producto.php?id=echo $usu_id");
            }

        } else { // El campo foto NO contiene una imagen

        }


    } else {

    }
}

function resizeImagen($ruta, $nombre, $alto, $ancho,$nombreN,$extension){
    $rutaImagenOriginal = $ruta.$nombre;
    if($extension == 'GIF' || $extension == 'gif'){
        $img_original = imagecreatefromgif($rutaImagenOriginal);
    }
    if($extension == 'jpg' || $extension == 'JPG'){
        $img_original = imagecreatefromjpeg($rutaImagenOriginal);
    }
    if($extension == 'png' || $extension == 'PNG'){
        $img_original = imagecreatefrompng($rutaImagenOriginal);
    }
    if($extension == 'bmp' || $extension == 'BMP'){
        $img_original = imagecreatefrombmp($rutaImagenOriginal);
    }
    if($extension == 'jpeg' || $extension == 'JPEG'){
        $img_original = imagecreatefromjpeg($rutaImagenOriginal);
    }
    $max_ancho = $ancho;
    $max_alto = $alto;
    list($ancho,$alto)=getimagesize($rutaImagenOriginal);
    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;
    if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho
        $ancho_final = $ancho;
        $alto_final = $alto;
    } elseif (($x_ratio * $alto) < $max_alto){
        $alto_final = ceil($x_ratio * $alto);
        $ancho_final = $max_ancho;
    } else{
        $ancho_final = ceil($y_ratio * $ancho);
        $alto_final = $max_alto;
    }
    $tmp=imagecreatetruecolor($ancho_final,$alto_final);
    imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
    imagedestroy($img_original);
    $calidad=70;
    imagejpeg($tmp,$ruta.$nombreN,$calidad);

}


?>

<script>
    function alertaUsuarioCreado()
    {
        var id_usu=<?echo $id_usuario?>;
        if(id_usu >=1)
        {
            swal({
                    title:"Registro exitoso",
                    text: "<? echo $fotos_sitio;?>",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("", "En un momento sera dirigido a la pagina.", "success");
                        location.href="<?echo $index?>";
                    }
                });
        }
        else if(id_usu == 0)
        {
            swal({
                    title:"Usuario ya existe",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("", "Verifique sus datos y vuelva a intentarlo.", "success");
                        location.href="selec_reg.php";
                    }
                });
        }
    }
</script>
<body class=" login" onload="alertaUsuarioCreado()">
<div class="content" style="padding-bottom: 0 !important; padding-top: 5px !important; padding-left: 20px !important; padding-right: 20px !important;">
    <!-- BEGIN LOGIN FORM -->
    <div class="portlet light " id="form_wizard_1" style="box-shadow: none !important; margin-bottom: 0 !important; ">
        <div class="portlet-title" hidden>


        </div>
        <div class="portlet-body form">
            <form role="form" class="form-horizontal" action="registro_user.php" name="registro_user" id="registro_user" enctype="multipart/form-data" method="POST">
                <div class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps" hidden>
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
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">

                                <div class="row">
                                    <div class="">
                                        <div class="mt-widget-1" style=" border: 0px !important;">

                                            <div class="img-circle fileinput fileinput-new" data-provides="fileinput" style="border-radius: 50%;">
                                                <div class="mt-icon">
                                                    <div>
													<span class="btn btn-circle grey-gallery btn-file" style="border-radius: 50%; margin: 33px; margin-top: -18px;">
														<span class="fileinput-new fa fa-camera" style="margin: -4px;"></span>
														<span class="fileinput-exists"></span>
														<input type="file" name="foto" id="foto"> </span>
                                                    </div>
                                                </div>

                                                <div class="img-circle fileinput-new thumbnail" style="width: 200px; height: 200px; border-radius: 50%;">
                                                    <img src="../../externo/img/foto-perfil.jpg" class="img-circle" style="border-radius: 50%;"> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px; border-radius: 50%;"> </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input has-info" style="margin-top: 20px;">
                                    <label class="control-label"></label>
                                    <div class="input-group left-addon">
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
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-cc"></i>
                                                        </span>
                                        <input type="number" class="form-control" name="cedula" id="cedula" placeholder="Identificación" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <input type="hidden" id="form_login" name="form_login" value="W">
                                <!--Campos escondidos de rol y aceptacion de terminos-->
                                <input class="form-control placeholder-no-fix" type="hidden" name="roles" value="<?php echo $rol; ?>"/>
                                <input class="form-control placeholder-no-fix" type="hidden" name="acep-terms" value="<?php echo $acep_terms; ?>"/>

                                <div class="form-group form-md-line-input has-info">
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                        </span>
                                        <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $user_face; ?>" placeholder="Nombres" />
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input has-info">
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                        </span>
                                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $ape_face; ?>" placeholder="Apellidos"/>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input has-info">
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-tablet"></i>
                                                        </span>
                                        <input type="number" class="form-control" name="cell" id="cell" value="<?php echo $cell; ?>" placeholder="Celular"/>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input has-info">
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                        <input type="email" class="form-control" name="username" value="<?php echo $mail; ?>" placeholder="Correo electrónico" />
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input has-info">
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-unlock-alt"></i>
                                                        </span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input has-info">
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-line-chart"></i>
                                                        </span>
                                        <textarea class="form-control" name="meta" id="meta" rows="5" placeholder="Sueños"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">

                                    </label>
                                    <div class="row">
                                        <div class="radio-list">
                                            <label class="col-xs-6">
                                                <input type="radio" name="genero" value="Masculino" class="icheck"> Masculino </label>
                                            <label class="col-xs-6">
                                                <input type="radio" name="genero" value="Femenino" checked class="icheck"> Femenino </label>
                                        </div>
                                        <div id="form_gender_error"> </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab2">
                                <h3 class="block bold" style="color: #520d9b"><? echo $gustos; ?></h3>
                                <div style="padding-bottom: 50px">
                                    <h4>
                                        <p class="font-grey-gallery bold">
                                            <? echo $escoge_gusto; ?>
                                        </p>
                                    </h4>
                                </div>
                                <!-- BEGIN ACCORDION PORTLET-->
                                <div class="portlet-body">
                                    <div class="panel-group accordion" id="accordion1">
                                        <?php
                                        $objCat = new PDOModel();
                                        $objCat->where("id_estado", 1);
                                        $result =  $objCat->select("bienes");
                                        foreach($result as $item){
                                            ?>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title bold">
                                                        <a class="accordion-toggle" style="background-color: #<? echo $item['color'] ?>;" data-toggle="collapse" data-parent="#accordion1" href="#collapse_<?php echo $item["id"]?>" value="<?php echo $item["id"]?>">

                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                    <img src="bienes/<?php echo $item["id"]?>/bien.png" width="60px" class="img-responsive"/>
                                                                </div>
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="display: flex; justify-content: center; align-content: center; flex-direction: column;">
                                                                    <b class="font-white"><?php echo $item["nombre"]?></b>
                                                                </div>
                                                            </div>

                                                        </a>
                                                    </h4>

                                                </div>
                                                <div id="collapse_<?php echo $item["id"]?>" class="panel-collapse collapse">
                                                    <div class="panel-body"><?php

                                                        $objCat->andOrOperator = "AND";
                                                        $objCat->where("id_bienes", $item["id"]);
                                                        $objCat->where("id_estado", 1);
                                                        $objCat->orderByCols = array("descripcion");
                                                        $result1 =  $objCat->select("categoria");
                                                        foreach($result1 as $item1){
                                                            ?><label>
                                                            <input type="checkbox" class="icheck" name="categoria[]" data-checkbox="icheckbox_line-purple" value="<?php echo $item1["id"]?>" data-label="<?php echo $item1["descripcion"]?>" /></label><?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>  <?
                                        }
                                        ?>

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
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-flag"></i>
                                                        </span>
                                        <input class="form-control" name="ciudad" id="ciudad" type="text" size="50" autocomplete="on" placeholder="Ciudad" />
                                        <!-- Campo escondido que toma valor de ciudad -->
                                        <input type="hidden" name="resciu" id="resciu" >
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input has-info">
                                    <div class="input-group left-addon">
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
                                    <div class="input-group left-addon">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-map-signs"></i>
                                                        </span>
                                        <input type="text" class="form-control" name="direccion" id="direccion" onchange="mostrarUbicacion();" placeholder="Dirección"/>
                                        <span class="help-block"></span>
                                        <!-- Campo escondido que toma valor de direccion -->
                                        <input type="hidden" name="resdir" id="resdir">
                                    </div>
                                    <!-- Campos escondidos que toman valores de coordenadas -->
                                    <div><input type="hidden" id="search"/></div>
                                    <div><input type="hidden" id="latitud" name="latitud"/></div>
                                    <div><input type="hidden" id="longitu" name="longitu"/></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions" style="border-bottom: 0 !important;">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="javascript:;" class="btn default button-previous">
                                    <i class="fa fa-angle-left"></i> Atras </a>
                                <a href="javascript:;" class="btn btn-outline green button-next"> Siguiente
                                    <i class="fa fa-angle-right"></i>
                                </a>
                                <button type="submit" class="btn green button-submit" id="formulario" name="formulario" value="Registrar"> Registrar
                                    <i class="fa fa-check"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- END LOGIN FORM -->

</div>
<!-- END LOGIN -->
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
<script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/wizard-user.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
<script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../assets/pages/scripts/login.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="../assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
<script src="../assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
<script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
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