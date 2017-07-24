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
    <script src="../../externo/plugins/slider-js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../../externo/plugins/slider-js/jssor.slider-25.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_1_options = {
                $AutoPlay: 1,
                $SlideWidth: 640,
                $Cols: 2,
                $Align: 170,
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 980);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        });
    </script>
    <style>
        /* jssor slider loading skin double-tail-spin css */

        .jssorl-004-double-tail-spin img {
            animation-name: jssorl-004-double-tail-spin;
            animation-duration: 1.2s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-004-double-tail-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        .jssorb051 .i {position:absolute;cursor:pointer;}
        .jssorb051 .i .b {fill:#fff;fill-opacity:0.5;stroke:#000;stroke-width:400;stroke-miterlimit:10;stroke-opacity:0.5;}
        .jssorb051 .i:hover .b {fill-opacity:.7;}
        .jssorb051 .iav .b {fill-opacity: 1;}
        .jssorb051 .i.idn {opacity:.3;}

        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>
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
    include "funciones.php";
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
                            <label class="control-label col-lg-3 col-md-3 col-xs-2"></label>
                            <div class="input-group left-addon col-lg-3 col-md-3 col-xs-2">
                                <div class="fileinput fileinput-new img-circle" data-provides="fileinput" style="border-radius: 50%;">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px; border-radius: 50%;">
                                        <img src="<? echo "usuarios/".$usu_id."/perfil/res_perfil.jpg"?>" alt="" class="img-circle" style="border-radius: 50%;"> </div>
                                    <div class="fileinput-preview fileinput-exists" style="max-width: 200px; max-height: 200px; border-radius: 50%;"></div>
                                    <div>
													<span class="btn default btn-file" style="visibility: hidden;" >
														<input type="file" name="foto" id="foto" value="<? echo "usuarios/".$usu_id."/".$resFoto?>"> </span>
                                        <? echo calificacion_usuario($usu_id); ?>
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
                                <input type="text" class="form-control" name="usern" id="usern" value="<?php echo $fullname; ?>" readonly>
                            </div>
                            <div class="col-sm-4 col-xs-1"></div>
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
                                    $archivos .= $rut;
                                    $recorrido_archivos[] = $archivo;
                                }
                            }
                            closedir($directorio);
                        }

                        foreach ($recorrido_archivos as $vfotos){


?>
                            <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
                            <!-- Loading Screen -->
                            <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
                                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
                            </div>
                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                                <div>
                                    <img data-u="image" src="<? echo 'usuarios/'.$usu_id.'/sitio/'.$vfotos ?>" />
                                </div>
                                <div>
                                    <img data-u="image" src="usuarios/9/sitio/images.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="usuarios/9/sitio/digital_marketing.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/004.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/005.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/006.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/007.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/008.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/009.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/010.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/011.jpg" />
                                </div>
                                <div>
                                    <img data-u="image" src="img/012.jpg" />
                                </div>
                                <a data-u="any" href="https://www.jssor.com" style="display:none">image gallery</a>
                            </div>
                            <!-- Bullet Navigator -->
                            <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                    </svg>
                                </div>
                            </div>
                            <!-- Arrow Navigator -->
                            <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:45px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                    <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                                </svg>
                            </div>
                            <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:45px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                    <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                                </svg>
                            </div>
                        </div>
                        <!-- #endregion Jssor Slider End -->


                            <?



                        }

                        echo "<pre>";print_r($GLOBALS);echo "</pre>";
                        ?>












                        <div class="form-actions">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-bubbles font-dark hide"></i>
                                        <span class="caption-subject"><h3 class="block bold" style="color: #520d9b">COMENTARIOS</h3></span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                            <div class="tab-pane active" id="portlet_comments_1">
                                                <!-- BEGIN: Comments -->
                                                <?
                                                $objCon=new PDOModel();
                                                $res_califica = $objCon->executeQuery("select A.* , B.* from usuarios A , calificacion_usuario B where A.id = B.id_usuario AND  A.id= '".$usu_id."' ");

                                                foreach ($res_califica as $valor){
                                                    ?>
                                                    <div class="mt-comments">
                                                    <div class="mt-comment">
                                                        <div class="mt-comment-img">
                                                            <img src="<? echo 'usuarios/'.$valor['id_usuario_califica'].'/perfil/min_perfil.jpg' ?>" /> </div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author"><? echo $valor['nombre_completo'] ;?></span>
                                                                <span class="mt-comment-date"><? echo $valor['fecha'];?></span>
                                                            </div>
                                                            <div class="mt-comment-text"><? echo $valor['comentario'] ;?></div>
                                                            <div class="mt-comment-details">
                                                                <span class="mt-comment-status mt-comment-status-pending"><? echo print_calificacion($valor['calificacion']); ?></span>
                                                                <!--<ul class="mt-comment-actions">
                                                                    <li>
                                                                        <a href="#">Quick Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#">View</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#">Delete</a>
                                                                    </li>
                                                                </ul>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><?
                                                }
                                                ?>

                                                <!-- END: Comments -->
                                            </div>
                                        </div>

                                    </div>
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