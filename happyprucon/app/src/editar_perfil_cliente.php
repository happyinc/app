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

    $id_usuario = "";

    if(isset($_POST["id_usuario"]) && $_POST["id_usuario"] != "")
    {
        $id_usuario = $_POST["id_usuario"];
    }
    else if(isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "")
    {
        $id_usuario = $_GET["id_usuario"];
    }

    include "funciones.php";
    include("include_css.php");
    include("nombre_cabezera.php");
    include("menu_modal.php");

    ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="../assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
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
                            <div class="page-title">
                                <!--
                                <h1>Dashboard
                                    <small>dashboard & statistics</small>
                                </h1>
                                -->
                            </div>
                            <div class="page-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- AQUI EMPIEZA EL CONTENIDO-->

                                        <div class="portlet-body">


                                            <?php
                                            if(isset($_POST["btn1"])) {
                                                $btn = $_POST["btn1"];

                                                if ($btn == "Guardar") {
                                                    $objConn = new PDOModel();
                                                    $updateUserData["password"] = md5($_POST['password']);
                                                    $objConn->where("id", $id_usuario);
                                                    $objConn->update("usuarios", $updateUserData);

                                                    if ($objConn != "") {
                                                        echo "<script> alert('Actualizado correctamente'); window.location.assign('editar_perfil_cliente.php');</script>";
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
                                                    $updateUserData["meta"] = $_POST['meta'];
                                                    $objConn->where("id", $_POST['iduser']);
                                                    $objConn->update("usuarios", $updateUserData);

                                                    if($objConn != ""){
                                                        $objConn = new PDOModel();
                                                        $objConn->where("id",$_POST['iduser']);
                                                        $res_usu =  $objConn->select("usuarios");

                                                        $usuario = $res_usu[0]['id'];

                                                        $objConn->where("id_usuario", $usuario);
                                                        $objConn->delete(gustos);

                                                        //Recorre el array para insertar los datos en la tabla de gustos
                                                        $bienes = $_POST["categoria"];

                                                        foreach ($bienes  as $clave => $valor){
                                                            $id_catagoria = $valor;
                                                            $objConn = new PDOModel();
                                                            $insertUserGusto["id_usuario"] = $usuario;
                                                            $insertUserGusto["id_categoria"] = $id_catagoria;
                                                            $insertUserGusto["id_estado"] = 1;
                                                            $objConn->insert("gustos", $insertUserGusto);
                                                        }


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
                                                                $directorio = "usuarios/" . $id_usuario. "/perfil/"; // directorio de tu elección
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
                                                                resizeImagen($directorio . '/', $foto, 500, 500, $resFoto, $extension);
                                                                unlink($directorio . '/' . $foto);

                                                            } else { // El archivo no es JPG/GIF/PNG
                                                                $malformato = $_FILES["foto"]["type"];
                                                                ?>
                                                                <script type="text/javascript">alert("La imagen se encuentra con formato incorrecto")</script>
                                                                <?
                                                                //header("Location: crear_producto.php?id=echo $id_usuario");
                                                            }

                                                        } else { // El campo foto NO contiene una imagen


                                                        }
                                                        ?>
                                                        <script>
                                                            alert('Actualizado correctamente');
                                                            window.location.assign('editar_perfil.php?id_usuario=<? echo $id_usuario?>');
                                                        </script>
                                                        <?
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

                                            $chequeado="";
                                            if($genero=="Masculino")
                                            {
                                                $chequeado="checked";
                                            }

                                            $chequeada="";
                                            if($genero=="Femenino"){
                                                $chequeada="checked";
                                            }
                                            ?>

                                            <!-- BEGIN FORM-->
                                            <form role="form" action="editar_perfil_cliente.php" class="form-horizontal" name="upd_datos" id="upd_datos" enctype="multipart/form-data" method="post">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                            <div class="mt-widget-1" style=" border: 0px !important;">

                                                                <div class="img-circle fileinput fileinput-new" data-provides="fileinput" style="border-radius: 50%;">
                                                                    <div class="mt-icon">
                                                                        <!--<a href="editar_perfil_cliente.php">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>-->
                                                                        <div>
													<span class="btn btn-circle grey-gallery btn-file" style="border-radius: 50%; margin: 33px; margin-top: -18px;">
														<span class="fileinput-new fa fa-camera" style="margin: -4px;"></span>
														<span class="fileinput-exists"></span>
														<input type="file" name="foto" id="foto" value="<? echo "usuarios/".$id_usuario."/perfil/".$resFoto?>"> </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="img-circle fileinput-new thumbnail" style="width: 170px; height: 170px; border-radius: 50%;">
                                                                        <img src="<? echo "usuarios/".$id_usuario."/perfil/res_perfil.jpg"?>" class="img-circle" style="border-radius: 50%;"> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 170px; max-height: 170px; border-radius: 50%;"> </div>

                                                                </div>
                                                                <div class="mt-body">
                                                                    <h3 class="mt-username"><? echo calificacion_usuario($id_usuario); ?></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                            <input name="iduser" id="iduser" type="hidden" class="form-control" value="<?php echo $id_usuario; ?>"/>
                                                            <input name="id_usuario" id="id_usuario" type="hidden" class="form-control" value="<?php echo $id_usuario; ?>"/>
                                                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $name; ?>" placeholder="Nombres">
                                                        </div>
                                                        <div class="col-sm-4 col-xs-1"></div>
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $lastname; ?>" placeholder="Apellidos">
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-1"></div>
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-tablet"></i>
                                                    </span>
                                                            <input type="number" class="form-control" name="cell" id="cell" value="<?php echo $tel; ?>" placeholder="Celular">
                                                        </div>
                                                        <div class="col-sm-4 col-xs-1"></div>
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                            <input type="email" class="form-control" name="username" id="username" value="<?php echo $correo; ?>" placeholder="Correo electrónico">
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
                                                            <span class="input-group-addon"><a data-toggle="modal" href="#responsiveC"  style="text-decoration: none;">CAMBIAR</a></span>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-1"></div>
                                                    </div>
                                                    <div class="form-group form-md-line-input has-info">
                                                        <div class="col-lg-4 col-sm-4 col-xs-1"></div>
                                                        <div class="input-group left-addon col-lg-4 col-md-4 col-sm-4 col-xs-10">
                                                        <span class="required input-group-addon">
                                                        <i class="fa fa-cloud"></i>
                                                        </span>
                                                            <textarea class="form-control" name="meta" id="meta"><?php echo $meta; ?></textarea>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-1"></div>
                                                    </div>
                                                    <?
                                                    $sel_gusto = array();
                                                    $objCon=new PDOModel();
                                                    $res_gustos = $objCon->executeQuery("select A.* , B.* from categoria A , gustos B where A.id = B.id_categoria AND  B.id_usuario = '".$id_usuario."' ");

                                                    foreach ($res_gustos as $valor){

                                                        $sel_gusto[] = $valor["id_categoria"];
                                                    }
                                                    ?>

                                                    <!-- BEGIN ACCORDION PORTLET-->
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3"></div>
                                                        <div class="portlet-body col-lg-6 col-md-6 col-sm-6">
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
                                                                        <div id="collapse_<?php echo $item["id"]?>" class="panel-collapse in collapse">
                                                                            <div class="panel-body"><?php

                                                                                $objCat->andOrOperator = "AND";
                                                                                $objCat->where("id_bienes", $item["id"]);
                                                                                $objCat->where("id_estado", 1);
                                                                                $objCat->orderByCols = array("descripcion");
                                                                                $result1 =  $objCat->select("categoria");
                                                                                foreach($result1 as $item1){
                                                                                    ?>
                                                                                    <label>
                                                                                    <input type="checkbox" class="icheck" name="categoria[]" data-checkbox="icheckbox_line-purple" value="<?php echo $item1["id"]?>" data-label="<?php echo $item1["descripcion"]?>" <? if (in_array($item1["id"], $sel_gusto)){echo "checked";}?>/>
                                                                                    </label><?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>  <?
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END ACCORDION PORTLET-->

                                                    <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4"></label>
                                                        <div class="col-md-4 col-sm-4">
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
                                                        <div class="col-lg-offset-5 col-lg-2 col-md-offset-5 col-md-2 col-sm-offset-4 col-sm-3 col-xs-offset-2 col-xs-6">
                                                            <input type="submit" id="register-submit-btn" class="btn btn-circle btn-block bold" name="btn1" value="Actualizar" style="background-color: #00F85B; color: #5F059E; padding: 10px; font-size: 13px;"/>
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

                                                    <div id="responsiveC" class="modal fade" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content col-lg-6"  style="border-radius: 10px;">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title bold" style="color: #5F059E;">CAMBIAR CONTRASEÑA</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="scroller" style="height:150px" data-always-visible="1">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                                                    <div style="margin-left: 20px;">
                                                                                        <div class="input-group left-addon ">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-unlock-alt"></i>
                                                                </span>
                                                                                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña nueva">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                                                                    <div style="margin-left: 20px;">
                                                                                        <div class="input-group left-addon">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </span>
                                                                                            <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Repite contraseña">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer" align="center">
                                                                    <input type="submit" id="register-submit-btn" class="btn btn-circle btn-block bold" style="background-color: #00F85B; color: #5F059E; padding: 10px; font-size: 13px;" name="btn1" value="Guardar"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- END FORM PASSWORD-->

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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
</body>
</html>