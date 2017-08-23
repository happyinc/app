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
    elseif(isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "")
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
                                                <form role="form" action="perfil_cliente.php" class="form-horizontal" name="upd_datos" id="upd_datos" enctype="multipart/form-data" method="post">
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
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info form-md-floating-label" style="margin-top: 20px;">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $fullname; ?>" placeholder="Nombres" readonly>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-1"></div>
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-tablet"></i>
                                                    </span>
                                                            <input type="number" class="form-control" name="cell" id="cell" value="<?php echo $tel; ?>" placeholder="Celular" readonly>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-1"></div>
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                            <input type="email" class="form-control" name="username" id="username" value="<?php echo $correo; ?>" placeholder="Correo electrónico" readonly>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-1"></div>
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                                                            <input type="password" class="form-control" placeholder="*********" readonly>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-1"></div>
                                                    </div>

                                                </form>

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