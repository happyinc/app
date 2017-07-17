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
													<span class="btn default btn-file" style="visibility: hidden;" >
														<input type="file" name="foto" id="foto" value="<? echo "usuarios/".$usu_id."/".$resFoto?>"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Nombres</label>
                            <div class="col-md-4">
                                <label name="fullname" id="fullname" class="form-control"><?php echo $name; ?></label></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Apellidos</label>
                            <div class="col-md-4">
                                <label name="lastname" id="lastname" class="form-control"><?php echo $lastname; ?></label></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Celular</label>
                            <div class="col-md-4">
                                <label name="cell" id="cell" class="form-control"><?php echo $tel; ?></label></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Correo electrónico</label>
                            <div class="col-md-4">
                                <label name="username" id="username" class="form-control" ><?php echo $correo; ?> </label></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Genero</label>
                            <div class="col-md-4">
                                <label name="genero" id="genero" class="form-control" ><?php echo $genero; ?> </label></div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="editar_perfil.php" class="btn blue button-previous">
                                        <i class="fa fa-list-ul"></i> Editar perfil </a>
                                </div>
                            </div>
                        </div>
                        <h3 class="block bold" style="color: #520d9b">COMENTARIOS</h3>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="editar_perfil.php" class="btn blue button-previous">
                                        <i class="fa fa-list-ul"></i> Editar perfil </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
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