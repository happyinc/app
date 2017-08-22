<!DOCTYPE html>
<html lang="en">
<head>
    <?
    require_once'../../externo/plugins/PDOModel.php';
    require'../class/sessions.php';
    $objSe = new Sessions();
    $objSe->init();
    $usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
    $rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
    $fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']:null;
    if($rol!=2 ){
        echo "<script> alert('Usuario no autorizado');
                        window.location.assign('logueo.html');</script>";
    }


    $objConn = new PDOModel();

    $id_pedido = "";
    if(isset($_POST["id_pedido"]) && $_POST["id_pedido"] != "")
    {
        $id_pedido = $_POST["id_pedido"];
    }
    else if(isset($_GET["id_pedido"]) && $_GET["id_pedido"] != "")
    {
        $id_pedido = $_GET["id_pedido"];
    }
    //manejo de la fecha para hacer el insert en la tabla detalle pedido
    $fecha = date("Y-m-d H:i:s");
    $fecha1 = explode(" ", $fecha);
    $fecha_act=$fecha1[0];
    $hora=$fecha1[1];


    if($id_pedido != "" && isset($_GET["tipo"]) && $_GET["tipo"] != "")
    {

        if($_GET["tipo"] == "despachar" )
        {

            $updateData["id_estado"] = 8;
            $objConn->where("id",   $id_pedido);
            $objConn->update('pedido', $updateData);




            $pedido_actualizado= $objConn->rowsChanged;

        if($pedido_actualizado == 1)
        {
            //insert en la tabla detalle_pedido
            $insertDet["id_pedido"] = $id_pedido;
            $insertDet["id_estado"] = 8;
            $insertDet["fecha"] = $fecha_act;
            $insertDet["hora"] = $hora;
            $objConn->insert('detalle_pedido', $insertDet);

            $id_pedido_detalle= $objConn->lastInsertId;
        }
        else
        {
            ?>
            <script type="text/javascript">alert("No se pudo actualizar el pedido")
            </script>
        <?
        }
        }
        else if($_GET["tipo"] == "entregar" )
        {

        $updateData["id_estado"] = 9;
        $objConn->where("id", $id_pedido);
        $objConn->update('pedido', $updateData);

        $pedido_actualizado= $objConn->rowsChanged;
        if($pedido_actualizado == 1)
        {
            //insert en la tabla detalle_pedido
            $insertDet["id_pedido"] =  $id_pedido;
            $insertDet["id_estado"] = 9;
            $insertDet["fecha"] = $fecha_act;
            $insertDet["hora"] = $hora;
            $objConn->insert('detalle_pedido', $insertDet);

            $id_pedido_detalle= $objConn->lastInsertId;
        }
        else
        {
        ?>
            <script type="text/javascript">alert("No se pudo actualizar el pedido")
            </script>
            <?
        }

        }
    }

    include "funciones.php";
    include("include_css.php");
    include("nombre_cabezera.php");
    include("menu_modal.php");

    ?>
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
                                        <div class="portlet light portlet-fit " style="margin-bottom: 1px !important;">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-microphone font-dark hide"></i>
                                                    <span class="caption-subject bold font-dark uppercase"> GESTION PEDIDOS</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <form role="form" class="form-horizontal" action="gestion_pedido_detalle.php" name="ges_pedido" id="ges_pedido" method="POST">
                                                    <div class="row">
                                                        <?
                                                        $objGes = new PDOModel();
                                                        $result = $objGes->executeQuery("SELECT A.id_producto , B.nombre, B.descripcion, count(*) as pedido FROM pedido as A, producto as B WHERE A.id_producto = B.id and A.id_estado = '7' and B.id_usuario = '".$usu_id."' group by A.id_producto");
                                                        foreach ($result as $item) {
                                                            ?>
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="margin-top: 10px;">
                                                                <div class="mt-widget-2" >
                                                                    <div class="mt-head" style="background-image: url(<? echo "usuarios/".$usu_id."/bienes/".$item["id_producto"]."/res_producto.jpg"?>); height: 190px;" >
                                                                        <div class="mt-head-user" >
                                                                            <div class="mt-head-user-img"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-body" style="padding-top: 70px !important;">
                                                                        <h3 class="mt-body-title"> <? echo $item['nombre']; ?> </h3>
                                                                        <p class="mt-body-description" style="margin: 0 !important;"> <? echo $item['descripcion']; ?> </p>
                                                                        <ul class="mt-body-stats">
                                                                            <li class="font-purple">
                                                                                <i class="fa fa-check"></i> <? echo $item['pedido']; ?> </li>
                                                                            <li class="font-red">
                                                                                <i class="  icon-bubbles"></i> <? echo cantidad_coment_prod($item['id_producto']); ?> </li>
                                                                        </ul>
                                                                        <div class="btn-group-circle" style="margin-bottom: 20px;">
                                                                            <a href="gestion_pedido_detalle.php?id_usuario=<? echo $usu_id;?>&id_producto=<? echo $item['id_producto'];?>" type="submit"
                                                                               class="btn btn-default mt-ladda-btn ladda-button" style="border-radius: 10px;">VER DETALLE
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="portlet light portlet-fit " style="margin-bottom: 0 !important;">
                                            <div class="portlet-title" style="margin-bottom: 0 !important;">
                                                <form role="form" class="form-horizontal" action="gestion_pedido_detalle.php" name="adquisicion" id="adquisicion" method="POST">




                                                    <div class="row">
                                                        <center>
                                                            <?
                                                            $objGes = new PDOModel();
                                                            $result1 = $objGes->executeQuery("SELECT A.id_producto , A.forma_adquisicion, B.nombre, B.descripcion, count(*) as adquirido FROM pedido as A, producto as B WHERE A.id_producto = B.id and A.id_estado = '7' and B.id_usuario = '".$usu_id."' group by A.forma_adquisicion");
                                                            foreach ($result1 as $item1) {
                                                                if($item1['forma_adquisicion'] == 1){
                                                                    $icono = "fa fa-motorcycle fa-2x";
                                                                }
                                                                if($item1['forma_adquisicion'] == 2){
                                                                    $icono = "fa fa-ship fa-2x";
                                                                }
                                                                if($item1['forma_adquisicion'] == 4){
                                                                    $icono = "fa fa-home fa-2x";
                                                                }
                                                                ?>

                                                                <a href="gestion_pedido_detalle.php?id_usuario=<? echo $usu_id;?>&id_forma_adquisicion=<? echo $item1['forma_adquisicion'];?>" ><i class="<? echo $icono; ?>" style="color: purple"></i></a>
                                                                <span class="badge badge-danger" style="margin-top: -30px; margin-left: -12px; margin-right: 20px;"><? echo $item1['adquirido'];?></span>
                                                                <?
                                                            }
                                                            ?>

                                                        </center>
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
<script src="../assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js" type="text/javascript"></script>
</body>
</html>