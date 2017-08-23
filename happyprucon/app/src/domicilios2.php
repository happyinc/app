<!DOCTYPE html>
<html lang="en">
<head>
    <?
    require_once '../../externo/plugins/PDOModel.php';
    require '../class/sessions.php';
    $objSe = new Sessions();
    $objSe->init();
    include "funciones.php";
    include "funciones_new.php";
    include("include_css.php");
    include("nombre_cabezera.php");
    include("menu_modal.php");

    $id_usario = "";
    if (isset($_POST["id_usuario"]) && $_POST["id_usuario"] != "") {
        $id_usario = $_POST["id_usuario"];
    } else if (isset($_GET["id_usuario"]) && $_GET["id_usuario"] != "") {
        $id_usario = $_GET["id_usuario"];
    }

    if (isset($_POST["formulario"]) && $_POST["formulario"] == "asignacion_domiciliario") {
        if (isset($_POST["id_usuario_domiciliario"]) && $_POST["id_usuario_domiciliario"] != "" && isset($_POST["id_pedido"]) && $_POST["id_pedido"] != "") {

            $domi = $_POST["id_usuario_domiciliario"];
            $pedido = $_POST["id_pedido"];
            $fecha = date("Y-m-d H:i:s");

            $sql = "insert into pedidos_asignados_domiciliario(id_usuario_coordinador, id_usuario_domiciliario, id_pedido, id_estado, fecha_creacion) values($id_usario, $domi, $pedido, 1, '$fecha')";
            $rs = mysql_query($sql);

            $sql2 = "update pedido set id_estado = 17 where id = $pedido";
            mysql_query($sql2);

            $domi = null;
            $pedido = null;
            $fecha = null;

        } else {
            ?>
            <script>alert("Por Favor Seleccione el Domiciliario para asignar el Pedido")</script><?
        }
    }

    ?>

    <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
          type="text/css"/>
    <link href="../assets/global/plugins/socicon/socicon.css" rel="stylesheet" type="text/css" />

    <title><? echo $nombre_pagina ?></title>

</head>
<!-- END HEAD -->
<body class="page-header-default page-sidebar-closed-hide-logo page-container-bg-solid"
      style="text-align: center;background-color:white;" bgcolor="#ffffff">

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
                                        <div class="portlet light ">
                                            <div class="portlet-title" style="text-align: left;">

                                                <div class='fuente-2'>
                                                    <!-- se neceita un icono, aqui !! -->
                                                    GESTIÓN DE TODOS LOS PEDIDOS
                                                </div>
                                            </div>
                                            <div class="portlet-body">

                                                <!-- BEGIN ROW 1 (PEDIDOS SIN ASIGNAR) -->
                                                <div class="row">

                                                    <!-- BEGIN DIV PEDIDOS SIN ASIGNAR -->
                                                    <div class="col-lg-5 col-xs-12 col-sm-12">
                                                        <!-- DISEÑO DE UN DIV -->
                                                        <div class="portlet light ">

                                                            <!-- cabezera del div blanco PEDIDOS SIN ASIGNAR -->
                                                            <div class="portlet-title tabbable-line">
                                                                <div class="caption">
                                                                    <i class="icon-bubbles font-dark hide"></i>
                                                                    <span class="caption-subject font-dark bold uppercase">Pedidos Sin Asignar</span>
                                                                </div>
                                                            </div>
                                                            <!-- fin cabezera del div blanco PEDIDOS SIN ASIGNAR -->

                                                            <!-- cuerpo del div blanco PEDIDOS SIN ASIGNAR -->
                                                            <div class="portlet-body">

                                                                <div class="tab-content">

                                                                    <div class="scroller" style="height: 338px;" data-always-visible="1"
                                                                         data-rail-visible1="0" data-handle-color="#D7DCE2">

                                                                        <!-- Seccion de todos los comentarios -->
                                                                        <div class="mt-comments">

                                                                            <?
                                                                            //informacion del pedido

                                                                            $sql = "select * from pedido where id_estado = 7";
                                                                            $rs = mysql_query($sql);

                                                                            while ($pedido = mysql_fetch_array($rs)) {
                                                                                ?>

                                                                                <small>
                                                                                    <!-- diseño de una fila de comentario -->
                                                                                    <div class="mt-comment">

                                                                                        <div class="mt-comment-img">
                                                                                            <img src="usuarios/<?
                                                                                            echo $pedido['id_usuario']; ?>/perfil/min_perfil.jpg"/>
                                                                                        </div>
                                                                                        <div class="mt-comment-body">
                                                                                            <b>PEDIDO
                                                                                                N° <? echo $pedido["id"] ?></b>
                                                                                            <br>
                                                                                            <br>
                                                                                            <div class="mt-comment-info">
                                                                                                <span class="mt-comment-author"><? echo nombre_usuario_new($pedido["id_usuario"]) ?></span>
                                                                                                <span class="mt-comment-date"><? echo direccion_cliente_new($pedido["id_ubicacion_cliente"]) ?></span>
                                                                                            </div>
                                                                                            <div class="mt-comment-text">
                                                                                                <div class="mt-comment-info">
                                                                                                    <span class="mt-comment-author uppercase"><? echo nombre_producto_new($pedido["id_producto"]) ?></span>
                                                                                                    <span class="mt-comment-date">Cantidad: <? echo $pedido["cantidad"] ?></span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mt-comment-details">
                                                                                                <span class="mt-comment-status mt-comment-status-pending">Pendiente</span>
                                                                                                <ul class="mt-comment-actions">
                                                                                                    <li>
                                                                                                        <a data-toggle="modal"
                                                                                                           href="#responsive"
                                                                                                           onclick="document.getElementById('id_pedido').value=<? echo $pedido["id"] ?>;">Asignar</a>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <!-- fin diseño de una fila de comentario -->
                                                                                </small>
                                                                                <?
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                        <!-- fin Seccion de todos los comentarios -->

                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- fin cuerpo del div blanco PEDIDOS SIN ASIGNAR -->

                                                        </div>
                                                        <!-- FIN DISEÑO DE UN DIV -->

                                                    </div>
                                                    <!-- END DIV PEDIDOS SIN ASIGNAR -->

                                                    <!-- MODAL ASIGNAR DOMICILIARIO-->
                                                    <div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
                                                        <form role="form" class="form-horizontal" action="domicilios.php"
                                                              name="asignacion_domiciliario" id="asignacion_domiciliario" method="POST">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                aria-hidden="true"></button>
                                                                        <h4 class="modal-title">Domiciliarios Disponibles</h4>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="scroller" style="height:100px" data-always-visible="1"
                                                                             data-rail-visible1="1">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <h4>Nombre</h4>

                                                                                    <select name="id_usuario_domiciliario" id="id_usuario_domiciliario"
                                                                                            class="col-md-12 form-control">
                                                                                        <?
                                                                                        //informacion del pedido

                                                                                        $sql = "select * from usuarios where id_roles=5";
                                                                                        $rs = mysql_query($sql);

                                                                                        while ($domiciliarios = mysql_fetch_array($rs)) {
                                                                                            $sql2 = "select * from asociado_disponible_view where id_usuario= " . $domiciliarios['id'] . " and estado=1";
                                                                                            $rs2 = mysql_query($sql2);

                                                                                            while ($domiciliariosActivos = mysql_fetch_array($rs2)) {
                                                                                                ?>
                                                                                                <option value=" <? echo $domiciliariosActivos["id_usuario"]; ?>">
                                                                                                    <? echo $domiciliarios["nombre_completo"]; ?>
                                                                                                </option>
                                                                                                <?
                                                                                            }
                                                                                        }

                                                                                        ?>

                                                                                    </select>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cerrar
                                                                        </button>
                                                                        <button type="submit" name="btn_delivery_assign" class="btn green">Asignar Este
                                                                            Domiciliario
                                                                        </button>
                                                                        <input type="hidden" id="formulario" name="formulario"
                                                                               value="asignacion_domiciliario"/>
                                                                        <input type="hidden" id="id_pedido" name="id_pedido" value="0"/>
                                                                        <input type="hidden" id="id_usuario" name="id_usuario"
                                                                               value="<? echo $_SESSION["id_usuario"] ?>"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END MODAL ASIGNAR DOMICILIARIO-->

                                                    <!-- BEGIN DIV INFO PEDIDOS ASIGNADOS PRIMER DISEÑO -->

                                                    <!-- END DIV INFO PEDIDOS ASIGNADOS PRIMER DISEÑO -->

                                                    <!-- BEGIN DIV INFO PEDIDOS ASIGNADOS SEGUNDO DISEÑO -->
                                                    <div class="col-lg-7 col-xs-12 col-sm-12">
                                                        <div class="portlet light ">
                                                            <div class="portlet-title">
                                                                <div class="caption font-dark">
                                                                    <i class="icon-settings font-dark"></i>
                                                                    <span class="caption-subject bold uppercase">Información pedidos asignados</span>
                                                                </div>
                                                                <div class="tools"></div>
                                                            </div>
                                                            <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"
                                                                       id="sample_1">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="all">Cliente</th>
                                                                        <th class="min-tablet">Nombre</th>
                                                                        <th class="all">Domiciliario</th>
                                                                        <th class="min-phone-l">Pedido N°</th>
                                                                        <th class="none">Dirección</th>
                                                                        <th class="none">Estado</th>
                                                                        <th class="none">Producto</th>
                                                                        <th class="desktop">Fecha</th>
                                                                        <th class="all">Tiempo</th>
                                                                        <th class="all">Cliente</th>
                                                                        <th class="all">Asociado</th>
                                                                        <th class="all">Domiciliario</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    <?
                                                                    $sql = "SELECT * FROM pedidos_asignados_domiciliario, pedido WHERE pedido.id = pedidos_asignados_domiciliario.id_pedido and pedido.id_estado != 16 and pedidos_asignados_domiciliario.id_estado != 2";
                                                                    $rs = mysql_query($sql);

                                                                    while ($info_pedido_asignado = mysql_fetch_array($rs)) {

                                                                        ?>

                                                                        <tr>
                                                                            <td>
                                                                                <div class="mt-action-img">
                                                                                    <img src="usuarios/<?
                                                                                    echo $info_pedido_asignado['id_usuario']; ?>/perfil/min_perfil.jpg"/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <? echo nombre_usuario_new($info_pedido_asignado["id_usuario"]) ?>
                                                                            </td>
                                                                            <td>
                                                                                <? echo nombre_usuario_new($info_pedido_asignado["id_usuario_domiciliario"]) ?>
                                                                            </td>
                                                                            <td>
                                                                                <? echo $info_pedido_asignado["id_pedido"] ?>
                                                                            </td>
                                                                            <td>
                                                                                <? echo direccion_cliente_new($info_pedido_asignado["id_ubicacion_cliente"]) ?>
                                                                            </td>
                                                                            <td>
                                                                                <? echo nombre_estado_new($info_pedido_asignado["id_estado"]) ?>
                                                                            </td>
                                                                            <td>
                                                                                <? echo nombre_producto_new($info_pedido_asignado["id_producto"]) ?>
                                                                            </td>
                                                                            <td>
                                                                                <? echo $info_pedido_asignado["fecha"] ?>
                                                                            </td>
                                                                            <td>

                                                                            </td>
                                                                            <td>

                                                                                <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-green font-white bg-hover-grey-salsa socicon-identica tooltips" data-original-title="Cliente"></a>
                                                                            </td>
                                                                            <td>
                                                                                <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-green font-white bg-hover-grey-salsa socicon-identica tooltips" data-original-title="Asociado"></a>
                                                                            </td>
                                                                            <td>
                                                                                <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-green font-white bg-hover-grey-salsa socicon-identica tooltips" data-original-title="Domiciliario"></a>
                                                                            </td>
                                                                        </tr>

                                                                        <?
                                                                    }

                                                                    ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END DIV INFO PEDIDOS ASIGNADOS SEGUNDO DISEÑO -->

                                                </div>
                                                <!-- END ROW 1 (PEDIDOS SIN ASIGNAR) -->

                                                <!-- BEGIN ROW 2 (PEDIDOS RECHAZADOS) -->
                                                <div class="row">

                                                    <!-- BEGIN DIV PEDIDOS RECHAZADOS -->
                                                    <div class="col-lg-5 col-xs-12 col-sm-12">
                                                        <!-- DISEÑO DE UN DIV -->
                                                        <div class="portlet light ">

                                                            <!-- cabezera del div blanco PEDIDOS RECHAZADOS -->
                                                            <div class="portlet-title tabbable-line">
                                                                <div class="caption">
                                                                    <i class="icon-bubbles font-dark hide"></i>
                                                                    <span class="caption-subject font-dark bold uppercase">Pedidos Rechazados</span>
                                                                </div>
                                                            </div>
                                                            <!-- fin cabezera del div blanco PEDIDOS RECHAZADOS -->

                                                            <!-- cuerpo del div blanco PEDIDOS RECHAZADOS -->
                                                            <div class="portlet-body">

                                                                <div class="tab-content">

                                                                    <div class="scroller" style="height: 338px;" data-always-visible="1"
                                                                         data-rail-visible1="0" data-handle-color="#D7DCE2">

                                                                        <!-- Seccion de todos los comentarios -->
                                                                        <div class="mt-comments">

                                                                            <?php

                                                                            $sql = "select * from pedido where id_estado = 18 and forma_adquisicion = 1";
                                                                            $rs = mysql_query($sql);

                                                                            while ($pedido = mysql_fetch_array($rs)) {

                                                                                $sql2 = "select nombre_completo from usuarios, pedidos_asignados_domiciliario where pedidos_asignados_domiciliario.id_pedido = " . $pedido['id'] . " and pedidos_asignados_domiciliario.id_usuario_domiciliario = usuarios.id";
                                                                                $rs2 = mysql_query($sql2);

                                                                                $domiciliario_rechaza = mysql_fetch_array($rs2);
                                                                                ?>

                                                                                <small>
                                                                                    <!-- diseño de una fila de comentario -->
                                                                                    <div class="mt-comment">

                                                                                        <div class="mt-comment-img">
                                                                                            <img src="usuarios/<?
                                                                                            echo $pedido['id_usuario']; ?>/perfil/min_perfil.jpg"/>
                                                                                        </div>
                                                                                        <div class="mt-comment-body">
                                                                                            <b>PEDIDO
                                                                                                N° <? echo $pedido["id"] ?></b>
                                                                                            <br>
                                                                                            <br>
                                                                                            <div class="mt-comment-info">
                                                                                                <span class="mt-comment-author"><? echo nombre_usuario_new($pedido["id_usuario"]) ?></span>
                                                                                                <span class="mt-comment-date"><? echo direccion_cliente_new($pedido["id_ubicacion_cliente"]) ?></span>
                                                                                            </div>
                                                                                            <div class="mt-comment-text">
                                                                                                <div class="mt-comment-info">
                                                                                                    <span class="mt-comment-author uppercase"><? echo nombre_producto_new($pedido["id_producto"]) ?></span>
                                                                                                    <span class="mt-comment-date">Cantidad: <? echo $pedido["cantidad"] ?></span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mt-comment-details">
                                                                                                <span class="mt-comment-status mt-comment-status-rejected">Rechazado por: </span>
                                                                                                <span class="mt-comment-author"> <? echo $domiciliario_rechaza["nombre_completo"] ?> </span>
                                                                                                <ul class="mt-comment-actions">
                                                                                                    <li>
                                                                                                        <a data-toggle="modal"
                                                                                                           href="#responsive"
                                                                                                           onclick="document.getElementById('id_pedido').value=<? echo $pedido["id"] ?>;">Reasignar</a>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <!-- fin diseño de una fila de comentario -->
                                                                                </small>
                                                                                <?
                                                                            }

                                                                            ?>


                                                                        </div>
                                                                        <!-- fin Seccion de todos los comentarios -->

                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- fin cuerpo del div blanco PEDIDOS RECHAZADOS -->

                                                        </div>
                                                        <!-- FIN DISEÑO DE UN DIV -->

                                                    </div>
                                                    <!-- END DIV PEDIDOS RECHAZADOS -->

                                                </div>
                                                <!-- END ROW 2 (PEDIDOS RECHAZADOS) -->

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

<script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>
<script src="../assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

</body>
</html>