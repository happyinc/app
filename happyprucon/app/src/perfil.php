<?php
error_reporting(E_ALL ^ E_NOTICE);
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
    include("../../../externo/plugins/PDOModel.php");
    ?>
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
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
                                $directorio = "usuarios/" . $id_usuario . "/perfil/"; // directorio de tu elección
                                if (file_exists($directorio)) {

                                } else {
                                    mkdir($directorio, 0777, true);
                                }

                                // almacenar imagen en el servidor
                                move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . '/' . $foto);
                                $minFoto = 'min_' . $foto;
                                $resFoto = 'res_' . $foto;
                                resizeImagen($directorio . '/', $foto, 65, 65, $minFoto, $extension);
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
                        window.location.assign('../../app/src/perfil.php');</script>";
                        } else {
                            echo "<script> alert('No se pudo actualizar');</script>";
                        }
                    }


                }
                ?>

                <!-- BEGIN FORM-->
                <form role="form" action="perfil.php" class="form-horizontal" name="upd_datos" id="upd_datos" enctype="multipart/form-data" method="post">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                        <h3 class="block bold" style="color: #520d9b">DATOS PERSONALES</h3>
                        <div class="form-group form-md-line-input has-info form-md-floating-label">
                            <label class="control-label col-md-4 col-xs-2"></label>
                            <div class="input-group left-addon col-md-4 col-xs-2">
                                <div class="fileinput fileinput-new img-circle" data-provides="fileinput" style="border-radius: 50%;">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px; border-radius: 50%;">
                                        <img src="<? echo "usuarios/".$usu_id."/perfil/res_perfil.jpg"?>" alt="" class="img-circle" style="border-radius: 50%;"> </div>
                                    <div class="fileinput-preview fileinput-exists" style="max-width: 200px; max-height: 200px; border-radius: 50%;"> </div>
                                    <div>
													<span class="btn default btn-file">
														<span class="fileinput-new"> Seleccionar </span>
														<span class="fileinput-exists"> Cambiar </span>
														<input type="file" name="foto" id="foto" value="<? echo "usuarios/".$usu_id."/".$resFoto?>"> </span>

                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Quitar </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nombres</label>
                            <div class="col-md-4">
                                <input name="iduser" id="iduser" type="hidden" class="form-control" value="<?php echo $usu_id; ?>"/>
                                <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $name; ?>" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Apellidos</label>
                            <div class="col-md-4">
                                <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname; ?>" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Celular</label>
                            <div class="col-md-4">
                                <input name="cell" id="cell" type="text" class="form-control" value="<?php echo $tel; ?>"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Correo electrónico</label>
                            <div class="col-md-4">
                                <input name="username" id="username" type="email" class="form-control" value="<?php echo $correo; ?>"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Genero</label>
                            <div class="col-md-4">
                                <div class="radio-list">
                                    <label>
                                        <input type="radio" name="genero" value="Masculino" <?php echo $chequeado;?> class="icheck" > Masculino </label>
                                    <label>
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
                <form role="form" action="" class="form-horizontal" name="fotos_sitio" id="fotos_sitio" enctype="multipart/form-data" method="post"style="padding-top: 20px;">
                    <div class="form-body">
                        <h3 class="block bold" style="color: #520d9b">ACTUALIZAR FOTOS DEL SITIO</h3>
                        <script type="text/javascript">
                            // para buscar e insertar composiciones
                            $(document).ready(function(){
                                var maxField = 7; //Input fields increment limitation
                                var addButton = $('.add_button'); //Add button selector
                                var wrapper = $('.field_wrapper'); //Input field wrapper
                                var fieldHTML = '<div>'+
                                    '<div class="fileinput fileinput-new" data-provides="fileinput">'+
                                    '<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">'+
                                    '<img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>'+
                                    '<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"> </div>'+
                                    '<div>'+
                                    '<span class="btn default btn-file">'+
                                    '<span class="fileinput-new"> Seleccionar </span>'+
                                    '<span class="fileinput-exists"> Cambiar </span>'+
                                    '<input type="file" name="fotos[]" id="fotos[]"/> </span>'+

                                    '<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Quitar </a>'+
                                    '</div>'+
                                    '</div>'+
                                    <?
                                    if(isset($_POST["btn2"])) {
                                        $btn = $_POST["btn2"];

                                        if ($btn == "Cambiar") {

                                            if ($_FILES['fotos']["size"] >= 1) {
                                                // Primero, hay que validar que se trata de un JPG/GIF/PNG
                                                $allowedExts = array("jpg", "jpeg", "gif", "png", "bmp", "JPG", "JPEG", "GIF", "PNG", "BMP");
                                                $extension = end(explode(".", $_FILES["fotos"]["name"]));
                                                if ((($_FILES["fotos"]["type"] == "image/gif")
                                                        || ($_FILES["fotos"]["type"] == "image/jpeg")
                                                        || ($_FILES["fotos"]["type"] == "image/png")
                                                        || ($_FILES["fotos"]["type"] == "image/gif")
                                                        || ($_FILES["fotos"]["type"] == "image/bmp"))
                                                    && in_array($extension, $allowedExts)
                                                ) {
                                                    // el archivo es un JPG/GIF/PNG, entonces...

                                                    $extension = end(explode('.', $_FILES['fotos']['name']));
                                                    $foto = substr(md5(uniqid(rand())), 0, 10) . "." . $extension;
                                                    $directorio = "usuarios/" . $id_usuario . "/sitio/"; // directorio de tu elección
                                                    if (file_exists($directorio)) {

                                                    } else {
                                                        mkdir($directorio, 0777, true);
                                                    }

                                                    // almacenar imagen en el servidor
                                                    move_uploaded_file($_FILES['fotos']['tmp_name'], $directorio . '/' . $foto);
                                                    $minFoto = 'min_' . $foto;
                                                    $resFoto = 'res_' . $foto;
                                                    resizeImagen($directorio . '/', $foto, 65, 65, $minFoto, $extension);
                                                    resizeImagen($directorio . '/', $foto, 500, 500, $resFoto, $extension);
                                                    unlink($directorio . '/' . $foto);

                                                } else { // El archivo no es JPG/GIF/PNG
                                                    $malformato = $_FILES["fotos"]["type"];

                                                    echo "<script type='text/javascript'>alert('La imagen se encuentra con formato incorrecto')</script>";

                                                    //header("Location: crear_producto.php?id=echo $usu_id");
                                                }

                                            } else { // El campo foto NO contiene una imagen


                                                echo "<script type='text/javascript'>
                                                                alert('No se ha seleccionado imagenes');
                                                            </script>";

                                            }
                                        }
                                    }
                                    ?>
                                    '<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle fa-2"></i></a></div>';
                                var x = 1; //Initial field counter is 1
                                $(addButton).click(function(){ //Once add button is clicked
                                    if(x < maxField){ //Check maximum number of input fields
                                        x++; //Increment field counter
                                        $(wrapper).append(fieldHTML); // Add field html
                                    }
                                });
                                $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                                    e.preventDefault();
                                    $(this).parent('div').remove(); //Remove field html
                                    x--; //Decrement field counter
                                });
                            });
                        </script>



                        <div class="form-group form-md-line-input has-info form-md-floating-label">
                            <label class="control-label col-md-4 col-xs-4"></label>
                            <div class="input-group left-addon col-md-4 col-xs-4">
                                <div class="field_wrapper">
                                    Seleccione las fotos del sitio
                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus-circle fa-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="submit" id="register-submit-btn" class="btn blue" name="btn2" value="Cambiar"/>
                            </div>
                        </div>
                    </div>
                </form>
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
<?
include "include_js.php";
?>
</body>

</html>