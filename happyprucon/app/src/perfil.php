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

$usu_id = "";
    
        if(isset($_POST["id_usuario"]) && $_POST["id_usuario"] != "")
        {
            $usu_id = $_POST["id_usuario"];
        }
        elseif(isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "")
        {
             $usu_id = $_GET["id_usuario"];
        }
$objUbicacion = new PDOModel();
$objUbicacion->where("id_usuario", $usu_id);
$res_usuarios =  $objUbicacion->select("usuarios");
foreach ($res_usuarios as $usuarios)
{
        $rol = $usuarios["rol"] ;
        $fullname = $usuarios["fullname"] ;
        $name = $usuarios["name"] ;
        $lastname = $usuarios["lastname"] ;
        $genero = $usuarios["genero"] ;
        $tel = $usuarios["tel"] ;
        $correo = $usuarios["correo"] ;                                                         
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
                    refSize = Math.min(refSize, 780);
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
                        <a href="gestion_pedido.php">Home</a>
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
                <!-- BEGIN FORM-->
                <form role="form" action="perfil.php" class="form-horizontal" name="upd_datos" id="upd_datos" enctype="multipart/form-data" method="post">
                    <div class="form-body">

                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-md-3">
                            <div class="mt-widget-1" style=" border: 0px !important;">
                                <div class="mt-icon">
                                    <a href="editar_perfil.php">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <div class="mt-img" style="margin-bottom: 10px !important;">
                                        <img src="<? echo "usuarios/".$usu_id."/perfil/res_perfil.jpg"?>" width="150" class="img-circle" style="border-radius: 50%;">  </div>
                                <div class="mt-body">
                                    <h3 class="mt-username"><? echo calificacion_usuario($usu_id); ?></h3>

                                        <div class="row" style="padding-top: 20px;">

                                            <label class="font-yellow" style="margin-right: 5px;"><? echo calificacion_usu($usu_id); ?></label>
                                            <i class="fa fa-star font-yellow" style="margin-right: 10px;"></i>|

                                            <label class="font-green" style="margin-left: 10px; margin-right: 5px;"><? echo cantidad_coment_usu($usu_id); ?></label>
                                            <i class="fa fa-comments font-green" style="margin-right: 10px;"></i>|

                                            <label class="font-purple" style="margin-left: 10px; margin-right: 5px;">1,7k</label>
                                            <i class="fa fa-group font-purple" style="margin-right: 10px;"></i>

                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                        <?
                        $archivos = "";
                        $directory = "usuarios/$usu_id/sitio";
                        $recorrido_archivos = "";
                        if (file_exists($directory))
                        {
                            $direct=opendir($directory);
                            while ($archivo = readdir($direct))
                            {
                                if($archivo=='.' or $archivo=='..')
                                {

                                }
                                else
                                {
                                    $rut = $directory."/".$archivo;
                                    $archivos .= $rut;
                                    $recorrido_archivos[] = $archivo;
                                }
                            }
                            closedir($directory);
                        }




?>
                            <div id="jssor_1" style="position:relative;margin:0;auto;top:40px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
                            <!-- Loading Screen -->
                            <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
                                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
                            </div>
                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                                <? foreach ($recorrido_archivos as $vfotos){ ?>
                                <div>
                                    <img data-u="image" src="<? echo 'usuarios/'.$usu_id.'/sitio/'.$vfotos ?>" />
                                </div>

                                    <?
                                }
                                ?>
                            </div>
                            <!-- Bullet Navigator -->
                                <!--<div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                    <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                        </svg>
                                    </div>
                                </div>-->
                            <!-- Arrow Navigator-->
                                <!--<div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:45px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                                    </svg>
                                </div>
                                <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:45px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                                    </svg>
                                </div>-->
                        </div>
                        <!-- #endregion Jssor Slider End -->
                        <div class="row"  style="padding-top: 40px;">
                            <div class="portlet light col-lg-8">
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
                                                $res_califica = $objCon->executeQuery("select A.* , B.* from usuarios A , calificacion_usuario B where A.id = B.id_usuario AND  A.id= '".$usu_id."' limit 0,4");

                                                foreach ($res_califica as $valor){
                                                    ?>
                                                    <div class="mt-comments">
                                                    <div class="mt-comment">
                                                        <div class="mt-comment-img">
                                                            <img src="<? echo 'usuarios/'.$valor['id_usuario_califica'].'/perfil/min_perfil.jpg' ?>" /> </div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author"><? echo nombre_usuario($valor['id_usuario_califica']);?></span>
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