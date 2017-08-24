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

    $id_happy = "";
    $id_sesion = "";
    $id_cliente = "";
    $id_asociado = "";
    $fecha = date("Y-m-d H:i:s");

    if (isset($_POST["id_sesion"]) && $_POST["id_sesion"] != "" && isset($_POST["id_usuario_happy"]) && $_POST["id_usuario_happy"] != "" && isset($_POST["id_emprendedor"]) && $_POST["id_emprendedor"] != "" && isset($_POST["id_cliente"]) && $_POST["id_cliente"] != "") {
        $id_happy = $_POST["id_usuario_happy"];
        $id_sesion = $_POST["id_sesion"];
        $id_cliente = $_POST["id_cliente"];
        $id_asociado = $_POST["id_emprendedor"];
    }

    if (isset($_POST["formulario"]) && $_POST["formulario"] == "asignacion_domiciliario") {

        if ($id_happy != "" && $id_sesion != "" && $id_cliente != "" && $id_asociado != "" && isset($_POST["id_usuario_domiciliario"]) && $_POST["id_usuario_domiciliario"] != "" && isset($_POST["id_pedido"]) && $_POST["id_pedido"] != "" && $_POST["flag_domicilio"] == 1) {

            $domi = $_POST["id_usuario_domiciliario"];
            $pedido = $_POST["id_pedido"];

            $sql = "insert into pedidos_asignados_domiciliario(id_usuario_coordinador, id_usuario_domiciliario, id_pedido, id_estado, fecha_creacion) values($id_sesion, $domi, $pedido, 1, '$fecha')";
            $rs = mysql_query($sql);

            $sql = "update pedido set id_estado = 17 where id = $pedido";
            mysql_query($sql);

            $sql = "insert into ticket(fecha_i, id_usuario_o, id_usuario_d, id_pedido, estado) values($fecha, $id_happy, $id_cliente, $pedido, 1)";
            mysql_query($sql);

            $sql = "insert into ticket(fecha_i, id_usuario_o, id_usuario_d, id_pedido, estado) values($fecha, $id_happy, $id_asociado, $pedido, 1)";
            mysql_query($sql);

            $sql = "insert into ticket(fecha_i, id_usuario_o, id_usuario_d, id_pedido, estado) values($fecha, $domi, $id_cliente, $pedido, 1)";
            mysql_query($sql);

            $sql = "insert into ticket(fecha_i, id_usuario_o, id_usuario_d, id_pedido, estado) values($fecha, $domi, $id_asociado, $pedido, 1)";
            mysql_query($sql);

            $sql = "insert into ticket(fecha_i, id_usuario_o, id_usuario_d, id_pedido, estado) values($fecha, $domi, $id_happy, $pedido, 1)";
            mysql_query($sql);

            $domi = null;
            $pedido = null;
            $fecha = null;

        } else if ($id_happy != "" && $id_cliente != "" && $id_asociado != "" && $_POST["flag_domicilio"] == 2) {

            $pedido = $_POST["id_pedido"];

            $sql = "insert into ticket(fecha_i, id_usuario_o, id_usuario_d, id_pedido, estado) values($fecha, $id_happy, $id_cliente, $pedido, 1)";
            mysql_query($sql);

            $sql = "insert into ticket(fecha_i, id_usuario_o, id_usuario_d, id_pedido, estado) values($fecha, $id_happy, $id_asociado, $pedido, 1)";
            mysql_query($sql);
        } else {
            ?>
            <script>alert("Por Favor Seleccione todos los datos para asignar el Pedido")</script><?
        }
    }

    ?>

    <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
          type="text/css"/>
    <link href="../assets/global/plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>

    <script>
        function asignar_modal(id_pedido, forma, cliente, asociado) {
            var id_pedido = id_pedido;
            var forma = forma;
            document.getElementById('id_pedido').value = id_pedido;
            document.getElementById('id_cliente').value = cliente;
            document.getElementById('id_emprendedor').value = asociado;

            if (forma !== 1) {
                document.getElementById('flag_domicilio').value = 2;
                obj = document.getElementById('select_domiciliarios');
                obj.style.display = 'none';
            }
            else {
                document.getElementById('flag_domicilio').value = 1;
                obj = document.getElementById('select_domiciliarios');
                obj.style.display = 'block';
            }
        }
    </script>

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

                                                                    <div class="scroller" style="height: 338px;"
                                                                         data-always-visible="1"
                                                                         data-rail-visible1="0"
                                                                         data-handle-color="#D7DCE2">

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
                                                                                                           href="#responsive_domicilio"
                                                                                                           onclick="asignar_modal(<? echo $pedido["id"] ?>,<? echo $pedido["forma_adquisicion"] ?>,<? echo $pedido["id_usuario"] ?>, <? echo id_asociado_new($pedido["id_producto"]) ?>)">Asignar</a>
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
                                                    <div id="responsive_domicilio" class="modal fade" tabindex="-1"
                                                         aria-hidden="true">
                                                        <form role="form" class="form-horizontal"
                                                              action="domicilios2.php"
                                                              name="asignacion_domiciliario"
                                                              id="asignacion_domiciliario" method="POST">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-hidden="true"></button>
                                                                        <h4 class="modal-title">Asignación</h4>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="scroller" style="height:100px"
                                                                             data-always-visible="1"
                                                                             data-rail-visible1="1">
                                                                            <div class="row">
                                                                                <div class="col-md-12">

                                                                                    <div id="select_domiciliarios"
                                                                                         class="col-md-6 col-lg-6">
                                                                                        <h5>
                                                                                            <label for="id_usuario_domiciliario">Domiciliario</label>
                                                                                        </h5>
                                                                                        <select name="id_usuario_domiciliario"
                                                                                                id="id_usuario_domiciliario"
                                                                                                class=" form-control">
                                                                                            <?
                                                                                            //informacion del pedido

                                                                                            $sql = "select * from usuarios where id_roles=5";
                                                                                            $rs = mysql_query($sql);

                                                                                            while ($happy = mysql_fetch_array($rs)) {
                                                                                                $sql2 = "select * from asociado_disponible_view where id_usuario= " . $happy['id'] . " and estado=1";
                                                                                                $rs2 = mysql_query($sql2);

                                                                                                while ($domiciliariosActivos = mysql_fetch_array($rs2)) {
                                                                                                    ?>
                                                                                                    <option value=" <? echo $domiciliariosActivos["id_usuario"]; ?>">
                                                                                                        <? echo $happy["nombre_completo"]; ?>
                                                                                                    </option>
                                                                                                    <?
                                                                                                }
                                                                                            }

                                                                                            ?>

                                                                                        </select>
                                                                                    </div>

                                                                                    <div id="select_happy"
                                                                                         class="col-md-6 col-lg-6">
                                                                                        <h5>
                                                                                            <label for="id_usuario_happy">Happy</label>
                                                                                        </h5>
                                                                                        <select name="id_usuario_happy"
                                                                                                id="id_usuario_happy"
                                                                                                class="col-md-6 col-lg-6 form-control">
                                                                                            <?
                                                                                            //informacion del pedido

                                                                                            $sql = "select * from usuarios where id_roles=4 or id_roles=6";
                                                                                            $rs = mysql_query($sql);

                                                                                            while ($happy = mysql_fetch_array($rs)) {

                                                                                                ?>
                                                                                                <option value=" <? echo $happy["id"]; ?>">
                                                                                                    <? echo $happy["nombre_completo"]; ?>
                                                                                                </option>
                                                                                                <?
                                                                                            }
                                                                                            ?>

                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" data-dismiss="modal"
                                                                                class="btn dark btn-outline">Cerrar
                                                                        </button>
                                                                        <button type="submit" name="btn_delivery_assign"
                                                                                class="btn green">Asignar
                                                                        </button>
                                                                        <input type="hidden" id="formulario"
                                                                               name="formulario"
                                                                               value="asignacion_domiciliario"/>

                                                                        <input type="hidden" id="id_pedido"
                                                                               name="id_pedido" value="0"/>

                                                                        <input type="hidden" id="id_cliente"
                                                                               name="id_cliente" value="0"/>

                                                                        <input type="hidden" id="id_emprendedor"
                                                                               name="id_emprendedor" value="0"/>

                                                                        <input type="hidden" id="id_sesion"
                                                                               name="id_sesion"
                                                                               value="<? echo $_SESSION["id_usuario"] ?>"/>

                                                                        <input type="hidden" id="flag_domicilio"
                                                                               name="flag_domicilio" value="0"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END MODAL ASIGNAR DOMICILIARIO-->

                                                    <!-- BEGIN DIV INFO PEDIDOS ASIGNADOS PRIMER DISEÑO -->

                                                    <!-- END DIV INFO PEDIDOS ASIGNADOS PRIMER DISEÑO -->

                                                    <!-- BEGIN DIV INFO PEDIDOS ASIGNADOS SEGUNDO DISEÑO -->

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

                                                                    <div class="scroller" style="height: 338px;"
                                                                         data-always-visible="1"
                                                                         data-rail-visible1="0"
                                                                         data-handle-color="#D7DCE2">

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
                                                                                                           href="#responsive_domicilio"
                                                                                                           onclick="asignar_modal(<? echo $pedido["id"] ?>,<? echo $pedido["forma_adquisicion"] ?>,<? echo $pedido["id_usuario"] ?>, <? echo id_asociado_new($pedido["id_producto"]) ?>)">Reasignar</a>
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