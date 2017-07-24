<?php
error_reporting(0);
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
$objSe->init();

$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
$fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;
$name = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null ;
$lastname = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : null ;
$genero = isset($_SESSION['genero']) ? $_SESSION['genero'] : null ;
$tel = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : null ;
$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : null ;

if($rol==2){

}else{
    echo "<script> alert('Usuario no autorizado');
					window.location.assign('logueo.html');</script>";

}


if($genero=="Masculino")
{
    $chequeado="checked";
}


if($genero=="Femenino"){
    $chequeada="checked";
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
    include "include_css.php";
    ?>
    <!--Inicio Archivos para bootstrap file input -->
    <link href="../../externo/plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../externo/plugins/fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <?
    include "include_js.php";
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../../externo/plugins/fileinput/js/plugins/purify.min.js"></script>
    <script src="../../externo/plugins/fileinput/js/plugins/piexif.js"></script>
    <script src="../../externo/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="../../externo/plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../../externo/plugins/fileinput/themes/explorer/theme.js" type="text/javascript"></script>
    <script src="../../externo/plugins/fileinput/js/locales/es.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    <!--FIN Archivos para bootstrap file input -->


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

            <!-- END THEME PANEL -->
            <h1 class="page-title"> Blank Page Layout
                <small>blank page layout</small>
            </h1>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="index.php">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Blank Page</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Page Layouts</span>
                    </li>
                </ul>

            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN BOX BODY     CONTENIDO AQUI !!!!!!!!!! -->
            <div class="portlet light">
                <?php
                if(isset($_POST["btn1"])) {
                    $btn = $_POST["btn1"];

                    if ($btn == "Cambiar") {
                        $objConn = new PDOModel();
                        $updateUserData["password"] = md5($_POST['password']);
                        $objConn->where("id", $usu_id);
                        $objConn->update("usuarios", $updateUserData);

                        if ($objConn != "") {
                            echo "<script> alert('Cambio exitoso');</script>";
                        } else {
                            echo "<script> alert('Error: La contraseña no se pudo actualizar');</script>";
                        }
                    }

                    if ($btn == "Actualizar"){
                        $objConn = new PDOModel();
                        $updateUserData["nombre_completo"] = $_POST['fullname']." ".$_POST['lastname'];
                        $updateUserData["nombre"] = $_POST['fullname'];
                        $updateUserData["apellido"] = $_POST['lastname'];
                        $updateUserData["genero"] = $_POST['genero'];
                        $updateUserData["telefono"] = $_POST['cell'];
                        $updateUserData["correo"] = $_POST['username'];
                        $objConn->where("id", $_POST['iduser']);
                        $objConn->update("usuarios", $updateUserData);

                        if($objConn != ""){
                            $objConn = new PDOModel();
                            $objConn->where("id",$_POST['iduser']);
                            $res_usu =  $objConn->select("usuarios");

                            $objSe->init();
                            $objSe->set('id_usuario', $res_usu[0]['id']);
                            $objSe->set('id_roles', $res_usu[0]['id_roles']);
                            $objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
                            $objSe->set('nombre', $res_usu[0]['nombre']);
                            $objSe->set('apellido', $res_usu[0]['apellido']);
                            $objSe->set('genero', $res_usu[0]['genero']);
                            $objSe->set('telefono', $res_usu[0]['telefono']);
                            $objSe->set('correo', $res_usu[0]['correo']);


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
                                $directorio = "usuarios/" . $usu_id. "/perfil/"; // directorio de tu elección
                                if (file_exists($directorio)) {

                                } else {
                                    mkdir($directorio, 0777, true);
                                }

                                // almacenar imagen en el servidor
                                move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . '/' . $foto);
                                $minFoto = 'min_' . $foto;
                                $resFoto = 'res_' . $foto;
                                resizeImagen($directorio . '/', $foto, 200, 200, $minFoto, $extension);
                                resizeImagen($directorio . '/', $foto, 500, 500, $resFoto, $extension);
                                unlink($directorio . '/' . $foto);

                            } else { // El archivo no es JPG/GIF/PNG
                                $malformato = $_FILES["foto"]["type"];
                                ?>
                                <script type="text/javascript">alert("La imagen se encuentra con formato incorrecto")</script>
                            <?
                            //header("Location: crear_producto.php?id=echo $usu_id");
                            }

                            } else { // El campo foto NO contiene una imagen

                            ?>
                                <script type="text/javascript">
                                    alert("No se ha seleccionado imagenes");
                                    window.history.back();
                                </script>
                                <?
                            }

                            echo "<script> alert('Usuario actualizado correctamente');
                        window.location.assign('../../app/src/editar_perfil.php');</script>";
                        } else {
                            echo "<script> alert('No se pudo actualizar');</script>";
                        }
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

                <!-- BEGIN FORM-->
                <form role="form" action="editar_perfil.php" class="form-horizontal" name="upd_datos" id="upd_datos" enctype="multipart/form-data" method="post">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                        <h3 class="block bold" style="color: #520d9b">DATOS PERSONALES</h3>
                        <div class="form-group form-md-line-input has-info form-md-floating-label">
                            <label class="control-label col-lg-4 col-md-4 col-xs-2"></label>
                            <div class="input-group left-addon col-lg-4 col-md-4 col-xs-2">
                                <div class="fileinput fileinput-new img-circle" data-provides="fileinput" style="border-radius: 50%;">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px; border-radius: 50%;">
                                        <img src="<? echo "usuarios/".$usu_id."/perfil/min_perfil.jpg"?>" alt="" class="img-circle" style="border-radius: 50%;"> </div>
                                    <div class="fileinput-preview fileinput-exists" style="max-width: 200px; max-height: 200px; border-radius: 50%;"> </div>
                                    <div>
													<span class="btn default btn-file">
														<span class="fileinput-new"> Seleccionar </span>
														<span class="fileinput-exists"> Cambiar </span>
														<input type="file" name="foto" id="foto" value="<? echo "usuarios/".$usu_id."/".$minFoto?>"> </span>

                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Quitar </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-info form-md-floating-label">
                            <div class="col-lg-3 col-sm-4 col-xs-1"></div>
                            <div class="input-group left-addon col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                <input name="iduser" id="iduser" type="hidden" class="form-control" value="<?php echo $usu_id; ?>"/>
                                <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $name; ?>" placeholder="Nombres">
                            </div>
                            <div class="col-sm-4 col-xs-1"></div>
                        </div>
                        <div class="form-group form-md-line-input has-info form-md-floating-label">
                            <div class="col-lg-3 col-sm-4 col-xs-1"></div>
                            <div class="input-group left-addon col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $lastname; ?>" placeholder="Apellidos">
                            </div>
                            <div class="col-sm-4 col-xs-1"></div>
                        </div>
                        <div class="form-group form-md-line-input has-info form-md-floating-label">
                            <div class="col-lg-3 col-sm-4 col-xs-1"></div>
                            <div class="input-group left-addon col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-tablet"></i>
                                                    </span>
                                <input type="number" class="form-control" name="cell" id="cell" value="<?php echo $tel; ?>" placeholder="Celular">
                            </div>
                            <div class="col-sm-4 col-xs-1"></div>
                        </div>
                        <div class="form-group form-md-line-input has-info form-md-floating-label">
                            <div class="col-lg-3 col-sm-4 col-xs-1"></div>
                            <div class="input-group left-addon col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                <input type="email" class="form-control" name="username" id="username" value="<?php echo $correo; ?>" placeholder="Correo electrónico">
                            </div>
                            <div class="col-sm-4 col-xs-1"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-1"></label>
                            <div>
                                <div class="radio-list">
                                    <label class="col-lg-2 col-md-2">
                                        <input type="radio" name="genero" value="Masculino" <?php echo $chequeado;?> class="icheck" > Masculino </label>
                                    <label class="col-lg-2 col-md-4">
                                        <input type="radio" name="genero" value="Femenino" <?php echo $chequeada;?> class="icheck" > Femenino </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="submit" id="register-submit-btn" class="btn blue" name="btn1" value="Actualizar"/>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
                <!-- BEGIN FORM PASSWORD-->
                <script language="JavaScript">
                    function validar(f) {
                        if(f.password.value != "" && (f.password.value == f.repassword.value)){
                            return true;
                        }
                        else{
                            alert("Las contraseñas no coinciden");
                            return false;
                        }

                    }

                </script>

                <form onSubmit="return validar(this)" action="" class="form-horizontal" method="post"style="padding-top: 20px;">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> Contraseñas no coinciden </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                        <h3 class="block bold" style="color: #520d9b">CAMBIO DE CONTRASEÑA</h3>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contraseña</label>
                            <div class="col-md-4">
                                <input name="password" id="password" type="password" class="form-control"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Repite contraseña</label>
                            <div class="col-md-4">
                                <input name="repassword" id="repassword" type="password" class="form-control"/> </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="submit" id="register-submit-btn" class="btn blue" name="btn1" value="Cambiar"/>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM PASSWORD-->
                <!-- BEGIN FORM FOTOS SITIO -->
                <?
                $archivos = "";
                $directorio = "usuarios/$usu_id/sitio";
                $recorrido_archivos = "";
                if (file_exists($directorio))
                {
                    $direct=opendir($directorio);
                    while ($archivo = readdir($direct))
                    {
                        if($archivo=='.' or $archivo=='..')
                        {

                        }
                        else
                        {
                            $rut = $directorio."/".$archivo;
                            $archivos .= "'".$rut."',";
                            $recorrido_archivos[] = $archivo;
                        }
                    }
                    closedir($directorio);
                }

                ?>
                <form role="form" enctype="multipart/form-data" class="form-horizontal col-lg-12">
                <div class="form-body">
                       <h3 class="block bold" style="color: #520d9b">CAMBIAR FOTOS DEL SITIO</h3>
                    <div class="col-lg-3"></div>
                    <div class="form-group col-lg-6">
                        <input id="fotos" name="fotos[]" type="file" accept="image/*" multiple>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                </form>
                <script>
                    $(document).ready(function () {
                        $("#test-upload").fileinput({
                            'showPreview': false,
                            'allowedFileExtensions': ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'JPG', 'JPEG', 'GIF', 'PNG', 'BMP'],
                            'elErrorContainer': '#errorBlock'
                        });
                        $("#fotos").fileinput({
                            language: 'es',
                            'theme': 'explorer',
                            'uploadUrl': 'upload.php',
                            uploadAsync: false,
                            minFileCount: 1,
                            maxFileCount: 6,
                            showUpload: true,
                            showRemove: false,
                            maxImageWidth: 600,
                            resizeImage: true,
                            overwriteInitial: false,
                            initialPreviewAsData: true,
                            browseOnZoneClick: true,
                            initialPreview: [
                                <? echo $archivos ?>
                            ],
                            initialPreviewConfig: [
                                <?
                                foreach ($recorrido_archivos as $clave => $valor) {
                                    ?>
                                        {caption: "<? echo $valor ?>", width: "120px", url: "borrar.php?d=<? echo $valor ?>", key: "<? echo $valor ?>"},
                                    <?
                                }
                                ?>
                            ],
                            purifyHtml: true,
                        });
                    });
                </script>

                <div class="row">
                </div>
                <!-- END FORM FOTOS SITIO -->
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

</body>
</html>