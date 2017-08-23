<?
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?
    require_once'../../externo/plugins/PDOModel.php';
    require'../class/sessions.php';
    $objSe = new Sessions();
    $objSe->init();

    $id_usuario= "";
    if(isset($_POST["id_usuario"]) && $_POST["id_usuario"] != "")
    {
        $id_usuario = $_POST["id_usuario"];
    }
    else if(isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "")
    {
        $id_usuario = $_GET["id_usuario"];
    }

    $objUbicacion = new PDOModel();
    $objUbicacion->where("id", $id_usuario);
    $res_usuarios =  $objUbicacion->select("usuarios");
    foreach ($res_usuarios as $usuarios)
    {
        $rol = $usuarios["id_roles"] ;
        $fullname = $usuarios["nombre_completo"] ;
        $name = $usuarios["nombre"] ;
        $lastname = $usuarios["apellido"] ;
        $genero = $usuarios["genero"] ;
        $tel = $usuarios["telefono"] ;
        $correo = $usuarios["correo"] ;
        $meta = $usuarios["meta"];
    }

    include "funciones.php";
    include("include_css.php");
    include("nombre_cabezera.php");
    include("menu_modal.php");

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

    <title><? echo $nombre_pagina ?></title>

</head>
<!-- END HEAD -->
<body class="page-header-default page-sidebar-closed-hide-logo page-container-bg-solid" style="text-align: center;background-color:white;" bgcolor="#ffffff">

<!-- BEGIN HEADER -->
<div class="">
    <!-- BEGIN HEADER INNER -->
    <?
    include("header.php");
    ?>
    <!-- END HEADER INNER -->
</div>

<!-- BEGIN CONTAINER -->
<div class="page-content" style="text-align: center;background-color:white;">

    <div class="page-wrapper-row full-height" style="text-align: center;background-color:white;">
        <div class="page-wrapper-middle" style="text-align: center;background-color:white;">
            <!-- BEGIN CONTAINER -->
            <div class="page-container" style="text-align: center;background-color:white;">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper" style="text-align: center;background-color:white;">
                    <!-- BEGIN CONTENT BODY -->
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head" style="text-align: center;background-color:white;">
                        <div class="container" style="text-align: center;background-color:white;">
                            <!-- BEGIN PAGE TITLE -->
                            <div class="page-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- AQUI EMPIEZA EL CONTENIDO-->
                                        <div class="portlet light ">

                                            <div class="portlet-body">

                                                <!-- BEGIN FORM-->
                                                <form role="form" action="perfil.php" class="form-horizontal" name="upd_datos" id="upd_datos" enctype="multipart/form-data" method="post">
                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4"></div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="mt-widget-1" style=" border: 0px !important;">
                                                                    <div class="mt-img" style="margin-bottom: 10px !important; margin-top: 0 !important;">
                                                                        <img src="<? echo "usuarios/".$id_usuario."/perfil/res_perfil.jpg"?>" width="150" class="img-circle" style="border-radius: 50%;">  </div>
                                                                    <div class="mt-body">
                                                                        <h3 class="mt-username"><? echo calificacion_usuario($id_usuario); ?></h3>

                                                                        <div class="row" style="padding-top: 20px;">

                                                                            <label class="font-yellow" style="margin-right: 5px;"><? echo calificacion_usu($id_usuario); ?></label>
                                                                            <i class="fa fa-star font-yellow" style="margin-right: 10px;"></i>|

                                                                            <label class="font-green" style="margin-left: 10px; margin-right: 5px;"><? echo cantidad_coment_usu($id_usuario); ?></label>
                                                                            <i class="fa fa-comments font-green" style="margin-right: 10px;"></i>|

                                                                            <label class="font-purple" style="margin-left: 10px; margin-right: 5px;">1,7k</label>
                                                                            <i class="fa fa-group font-purple" style="margin-right: 10px;"></i>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <?
                                                        $archivos = "";
                                                        $directory = "usuarios/$id_usuario/sitio";
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
                                                        <div style="margin-top: 20px; margin-bottom: 30px;">
                                                            <h3><p style="color: #5F059E" class="bold">Lo que quiero:</p></h3>
                                                            <h4><p class="font-grey-silver" style="margin: -10px !important;"><? echo $meta?></p></h4>

                                                        </div>
                                                        <hr>
                                                        <div class="col-lg-2 col-md-2 col-sm-1"></div>
                                                        <div id="jssor_1" style="position:relative;margin:0;auto;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
                                                            <!-- Loading Screen -->
                                                            <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
                                                                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px; padding-right: 5px;" src="img/double-tail-spin.svg" />
                                                            </div>
                                                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                                                                <? foreach ($recorrido_archivos as $vfotos){ ?>
                                                                    <div>
                                                                        <img data-u="image" src="<? echo 'usuarios/'.$id_usuario.'/sitio/'.$vfotos ?>"/>
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
                                                        <div class="col-lg-2 col-md-2 col-sm-1"></div>
                                                        <hr>
                                                        <!-- #endregion Jssor Slider End -->
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2"></div>
                                                            <div class="col-lg-8" >
                                                                <div class="portlet-title tabbable-line">
                                                                    <div class="caption">
                                                                        <span class="caption-subject"><h3 class="block bold" style="color: grey">COMENTARIOS</h3></span>
                                                                    </div>

                                                                </div>
                                                                <div class="portlet-body">
                                                                    <div class="tab-content">
                                                                        <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                                <!-- BEGIN: Comments -->
                                                                                <?
                                                                                $objCon=new PDOModel();
                                                                                $res_califica = $objCon->executeQuery("select A.* , B.* from usuarios A , calificacion_usuario B where A.id = B.id_usuario AND  A.id= '".$id_usuario."' limit 0,4");

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
                                        <!-- AQUI TERMINA EL CONTENIDO -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTAINER -->

<!-- BEGIN CORE PLUGINS -->
<?
include("include_js.php");
?>
</body>
</html>