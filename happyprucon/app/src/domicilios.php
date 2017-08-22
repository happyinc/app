<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("../../externo/plugins/PDOModel.php");
require '../class/sessions.php';
$objSe = new Sessions();
$objSe->init();
$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;
$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null;
$fullname = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo'] : null;
if ($rol != 4) {
    echo "<script> alert('Usuario no autorizado');
                    window.location.assign('logueo.html');</script>";
}

?>

<html>

<head>
    <?php
    include "include_css.php";
    include "funciones_new.php";

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
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">

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

                                        $sql = "select * from pedido where id_estado = 7 and forma_adquisicion = 1";
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
                                                            <span class="mt-comment-author"><? echo nombre_usuario($pedido["id_usuario"]) ?></span>
                                                            <span class="mt-comment-date"><? echo direccion_cliente($pedido["id_ubicacion_cliente"]) ?></span>
                                                        </div>
                                                        <div class="mt-comment-text">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author uppercase"><? echo nombre_producto($pedido["id_producto"]) ?></span>
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
                                    <th class="all">Domiciliario</th>
                                    <th class="min-phone-l">Pedido N°</th>
                                    <th class="min-tablet">Cliente</th>
                                    <th class="none">Dirección</th>
                                    <th class="none">Estado</th>
                                    <th class="none">Producto</th>
                                    <th class="desktop">Fecha</th>
                                    <th class="all">Tiempo</th>
                                    <th class="all">Chat</th>
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
                                            <? echo nombre_usuario($info_pedido_asignado["id_usuario_domiciliario"]) ?>
                                        </td>
                                        <td>
                                            <? echo $info_pedido_asignado["id_pedido"] ?>
                                        </td>
                                        <td>
                                            <? echo nombre_usuario($info_pedido_asignado["id_usuario"]) ?>
                                        </td>
                                        <td>
                                            <? echo direccion_cliente($info_pedido_asignado["id_ubicacion_cliente"]) ?>
                                        </td>
                                        <td>
                                            <? echo nombre_estado($info_pedido_asignado["id_estado"]) ?>
                                        </td>
                                        <td>
                                            <? echo nombre_producto($info_pedido_asignado["id_producto"]) ?>
                                        </td>
                                        <td>
                                            <? echo $info_pedido_asignado["fecha"] ?>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <div class="mt-action-icon ">
                                                <i class="icon-magnet"></i>
                                            </div>
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
                                                            <span class="mt-comment-author"><? echo nombre_usuario($pedido["id_usuario"]) ?></span>
                                                            <span class="mt-comment-date"><? echo direccion_cliente($pedido["id_ubicacion_cliente"]) ?></span>
                                                        </div>
                                                        <div class="mt-comment-text">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author uppercase"><? echo nombre_producto($pedido["id_producto"]) ?></span>
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
        <!-- END CONTENT BODY -->

    </div>
    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<?php
include "footer.php";
?>
<!-- END FOOTER -->

<!-- BEGIN CORE PLUGINS -->
<?php
include "include_js.php";
?>

<script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>
<script src="../assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

</body>

</html>