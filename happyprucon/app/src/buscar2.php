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
$meta = isset($_SESSION['suenos']) ? $_SESSION['suenos'] : null ;

$id_user = "";

if(isset($_POST["id_usuario"]) && $_POST["id_usuario"] != "")
{
    $id_user = $_POST["id_usuario"];
}
elseif(isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "")
{
    $id_user = $_GET["id_usuario"];
}
$objUbicacion = new PDOModel();
$objUbicacion->where("id", $id_user);
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

$buscar = "";

if(isset($_POST["buscar"]) && $_POST["buscar"] != "")
{
    $buscar = $_POST["buscar"];
}
elseif(isset($_GET["buscar"]) && $_GET["buscar"] != "")
{
    $buscar = $_GET["buscar"];
}
/*if($rol!=2){

}else{
    echo "<script> alert('Usuario no autorizado');
					window.location.assign('logueo.html');</script>";

}*/
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
    include "funciones.php";
    ?>

        <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />


    <?php
    $result="";
    $fecha=date("Y-m-d H:i:s");
    $objConn = new PDOModel();
    $query_todos = "SELECT A.*, B.*, C.*  FROM producto A, producto_disponibilidad B, disponibilidad C WHERE B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1 and B.id_disponibilidad= C.id and '".$fecha."' between C.fecha_inicio and C.fecha_fin ";
    

        if(isset($_POST["buscar"]) && $_POST["buscar"] != "")
        {
            
            $query_todos = $query_todos."AND (A.nombre LIKE '%$buscar%' OR A.descripcion LIKE '%$buscar%')";

        }

    if(isset($_POST["formulario"]) && $_POST["formulario"] == "fbuscar")
    {

        if(isset($_POST["categoria"]) && $_POST["categoria"] != "")
        {
            $query_todos = $query_todos." AND A.id_categoria = '".$_POST["categoria"]."' ";
        }

        if(isset($_POST["emprendedor"]) && $_POST["emprendedor"] != "")
        {
            $query_todos = $query_todos." AND A.id_usuario = '".$_POST["emprendedor"]."' ";
        }

         if(isset($_POST["precio"]) && $_POST["precio"] != "")
        {
            $techo = $_POST["precio"]+2000;

            $query_todos = $query_todos." AND A.precio BETWEEN '".$_POST["precio"]."' AND '".$techo."'  ";
        }

    }

    ?>
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
                <div class="portlet-body form">
                    <div class="form-body"> 
                        <form role="form" class="form-horizontal" name="1buscar" id="1buscar" action="buscar.php" enctype="multipart/form-data" method="POST">  
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="search" name="buscar" id="buscar" class="form-control" value="<? echo $buscar ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" name="buscarb" value="buscarb"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" id="formulario" name="formulario" value="1buscar"/>
                        </form>
                        
                         
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Filtros</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Filtros de busqueda</h4>
                              </div>
                              <div class="modal-body">
                                <form role="form" class="form-horizontal" name="fbuscar" id="fbuscar" action="buscar.php" enctype="multipart/form-data" method="POST">
                                    <?
                                        $categoria_f = "";
                                        $asociado_f = "";
                                        $precio_max = 0;
                                        $precio_min = 0;
                                        $contador = 0;
                                        $result =  $objConn->executeQuery($query_todos);
                                        foreach ($result as $item ) 
                                        {
                                            $categoria_f["".$item["id_categoria"].""] = $categoria_f["".$item["id_categoria"].""]+1;
                                            $asociado_f["".$item["id_usuario"].""] = $asociado_f["".$item["id_usuario"].""]+1;

                                            if($contador == 0)
                                            {
                                                $precio_max = $item["precio"];
                                                $precio_min = $item["precio"];
                                            }
                                            else
                                            {
                                                if($item["precio"] < $precio_min)  
                                                {
                                                    $precio_min = $item["precio"];
                                                }
                                                else if($item["precio"] > $precio_max)  
                                                {
                                                    $precio_max = $item["precio"];
                                                }
                                            }
                                            $contador++;
                                        }

                                    ?>
                                    <p>Seleccione el filtro de busqueda.</p>

                                        <div class="form-group">
                                            <label for="categoria" class="control-label col-md-3">categoria</label>
                                            
                                            <select id="categoria" class="form-control col-md-9" style="width: 250px;" tabindex="-1" aria-hidden="true" name="categoria" ">
                                                <option value= "" disabled selected>Seleccione la categoria</option>
                                                    <?
                                                    foreach ($categoria_f as $key => $value) {
                                                        ?>
                                                        <option value="<? echo $key ?>"><? echo nombre_categoria($key) . "- $value Productos"?></option>
                                                        <?
                                                    }
                                                    ?>
                                             </select>
                                            
                                        </div>

                                         <div class="form-group">
                                            <label for="emprendedor" class="control-label col-md-3">emprendedor</label>
                                            <select id="emprendedor" class="form-control col-md-9" style="width: 250px;" tabindex="-1" aria-hidden="true" name="emprendedor">
                                                 <option value= "" disabled selected>Seleccione la categoria</option>
                                                     <?
                                                    foreach ($asociado_f as $key => $value) {
                                                        ?>
                                                        <option value="<? echo $key?>"><? echo  nombre_usuario_new($key) . "- $value Productos"?></option>
                                                        <?
                                                    }
                                                    ?>
                                             </select>
                                        </div>

                                         <div class="form-group">
                                            <label for="precio" class="control-label col-md-3">precio</label>
                                            <select id="precio" class="form-control col-md-9" style="width: 250px;" tabindex="-1" aria-hidden="true" name="precio" >
                                                <option value= "" disabled selected>Seleccione el precio</option>
                                                    <?
                                                    $i=0;
                                                    for ($i=$precio_min; $i<= $precio_max; $i=$i+2000) {
                                                        ?>
                                                        <option value="<? echo $i ?>"><? echo "$".number_format($i,0)." - $".number_format($i+2000,0)?></option>
                                                        <?
                                                    }
                                                    ?>
                                                    
                                             </select>
                                        </div>

                                        <div class="form-actions">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle purple" name="enviar" id="enviar" value="enviar"> Enviar </button>
                                            </div>
                                        </div>

                                
                                <input type="hidden" id="formulario" name="formulario" value="fbuscar"/>
                                <input type="hidden" name="buscar" id="buscar" value="<? echo $buscar ?>">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div>
                                </form>
                          </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <?

                            $result =  $objConn->executeQuery($query_todos);
                            foreach ($result as $item ) 
                            {
                            ?>  
                                <div class="portlet light portlet-fit ">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-md-6" align="center">
                                            <div class="mt-widget-2" >
                                                <div class="mt-head" style="background-image: url(<? echo 'usuarios/'.$item['id_usuario'].'/bienes/'.$item['id_producto'].'/res_producto.jpg'?>);" >
                                                    <div class="mt-head-label">
                                                        <button type="button" class="btn btn-success">$ <?echo number_format($item["precio"],0)?></button>
                                                    </div>
                                                    <div class="mt-head-user" >
                                                        <div class="mt-head-user-img">
                                                            <img src="<? echo 'usuarios/'.$item['id_usuario'].'/perfil'.'/res_perfil.jpg'?>"> </div>
                                                        <div class="mt-head-user-info" >
                                                            <span class="mt-user-name"><?echo  nombre_usuario_new($item["id_usuario"])?></span>
                                                            <span class="mt-user-time">
                                                                    <i class="fa fa-star"></i><?echo  calificacion_usu($item["id_usuario"])?>  </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-body" >
                                                    <h3 class="mt-body-title" > <?echo $item["nombre"]?> </h3>
                                                    <p class="mt-body-description"> <?echo $item["descripcion"]?> </p>
                                                    <ul class="mt-body-stats">
                                                        <li class="font-yellow">
                                                            <i class="fa fa-star" aria-hidden="true"></i> <?echo  calificacion_prod($item["id_producto"])?></li>
                                                        <li class="font-green">
                                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?echo $item["cantidad_despachada"]?></li>
                                                        <li class="font-red">
                                                            <i class="icon-bubbles" aria-hidden="true"></i> <?echo  cantidad_coment_prod($item["id_producto"])?></li>
                                                    </ul>
                                                    <div class="mt-body-actions">
                                                        <div class="btn-group btn-group btn-group-justified">
                                                            <a href="../src/crear_pedido.php?id_producto=<? echo $item["id_producto"]?>" class="btn">Hacer pedido </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                </div>
                                <?//echo "<pre>";print_r($GLOBALS); echo "</pre>";?>
                                <input type="hidden" id="id_producto" name="id_producto" value="<? echo $item["id_producto"] ?>" />
                                </br></br>
                            <?     
                            }?>
                        </div>
                    </div> 
                </div> 
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
 <!--<script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>-->
 <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

 <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

</body>

</html>