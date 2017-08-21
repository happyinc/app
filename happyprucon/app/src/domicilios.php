<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/**
 * Created by PhpStorm.
 * User: DESARROLLO HAPPY INC
 * Date: 11/08/2017
 * Time: 10:53 AM
 */

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
            /*$objConn = new PDOModel();
            $insertData["id_usuario_coordinador"] = $id_usario;
            $insertData["id_usuario_domiciliario"] = $_POST["id_usuario_domiciliario"];
            $insertData["id_pedido"] = $_POST["id_pedido"];
            $insertData["id_estado"] = 1;
            $insertData["fecha_creacion"] = date("Y-m-d H:i:s");

            $objConn->insert('pedidos_asignados_domiciliario', $insertData);*/
        } else {
            ?>
            <script>alert("Por Favor Seleccione el Domiciliario para asignar el Pedido")</script><?
        }
    }
    ?>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">

<!-- BEGIN CONTAINER -->
<div class="page-container">

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

                                        <?php
                                        //informacion del pedido
                                        /*$objUsuariosDomic = new PDOModel();
                                        $objUsuariosDomic->andOrOperator = "AND";
                                        $objUsuariosDomic->where("id_estado", 7);
                                        $objUsuariosDomic->where("forma_adquisicion", 1);
                                        $result = $objUsuariosDomic->select("pedido");

                                        foreach ($result as $pedido) {*/

                                        $sql = "select * from pedido";
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

                <!-- MODAL -->
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

                                                    /*$objUsuariosDomic = new PDOModel();
                                                    $objUsuariosDomic->where("id_roles", 5);
                                                    $lol = $objUsuariosDomic->select("usuarios");

                                                    foreach ($lol as $users) {

                                                        $obj = new PDOModel();
                                                        $obj->andOrOperator = "AND";
                                                        $obj->where("id_usuario", $users["id"]);
                                                        $obj->where("estado", 1);
                                                        $result2 = $obj->select("asociado_disponible_view");

                                                        foreach ($result2 as $user) {
                                                            $name = nombre_usuario($user["id_usuario"]);
                                                            ?>

                                                            <option value="<? echo $users["id_usuario"]; ?>"><? echo $users["nombre_completo"]; ?></option>

                                                            <?
                                                        }
                                                    }*/
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
                <!-- END MODAL -->

                <!-- BEGIN DIV INFO PEDIDOS ASIGNADOS -->
                <div class="col-lg-7 col-xs-12 col-sm-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class=" icon-social-twitter font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Quick Actions</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_actions_pending" data-toggle="tab"> Pending </a>
                                </li>
                                <li>
                                    <a href="#tab_actions_completed" data-toggle="tab"> Completed </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_actions_pending">
                                    <!-- BEGIN: Actions -->
                                    <div class="mt-actions">
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar10.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class="icon-magnet"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Natasha Kim</span>
                                                            <p class="mt-action-desc">Dummy text of the printing</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-green"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar3.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class=" icon-bubbles"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Gavin Bond</span>
                                                            <p class="mt-action-desc">pending for approval</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-red"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar2.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class="icon-call-in"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Diana Berri</span>
                                                            <p class="mt-action-desc">Lorem Ipsum is simply dummy
                                                                text</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-green"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar7.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class=" icon-bell"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">John Clark</span>
                                                            <p class="mt-action-desc">Text of the printing and
                                                                typesetting industry</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-red"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar8.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class="icon-magnet"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Donna Clarkson </span>
                                                            <p class="mt-action-desc">Simply dummy text of the
                                                                printing</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-green"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar9.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class="icon-magnet"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Tom Larson</span>
                                                            <p class="mt-action-desc">Lorem Ipsum is simply dummy
                                                                text</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-green"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Actions -->
                                </div>
                                <div class="tab-pane" id="tab_actions_completed">
                                    <!-- BEGIN:Completed-->
                                    <div class="mt-actions">
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar1.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class="icon-action-redo"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Frank Cameron</span>
                                                            <p class="mt-action-desc">Lorem Ipsum is simply dummy</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-red"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar8.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class="icon-cup"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Ella Davidson </span>
                                                            <p class="mt-action-desc">Text of the printing and
                                                                typesetting industry</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-green"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar5.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class=" icon-graduation"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Jason Dickens </span>
                                                            <p class="mt-action-desc">Dummy text of the printing and
                                                                typesetting industry</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-red"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-action">
                                            <div class="mt-action-img">
                                                <img src="../assets/pages/media/users/avatar2.jpg"/></div>
                                            <div class="mt-action-body">
                                                <div class="mt-action-row">
                                                    <div class="mt-action-info ">
                                                        <div class="mt-action-icon ">
                                                            <i class="icon-badge"></i>
                                                        </div>
                                                        <div class="mt-action-details ">
                                                            <span class="mt-action-author">Jan Kim</span>
                                                            <p class="mt-action-desc">Lorem Ipsum is simply dummy</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-action-datetime ">
                                                        <span class="mt-action-date">3 jun</span>
                                                        <span class="mt-action-dot bg-green"></span>
                                                        <span class="mt=action-time">9:30-13:00</span>
                                                    </div>
                                                    <div class="mt-action-buttons ">
                                                        <div class="btn-group btn-group-circle">
                                                            <button type="button" class="btn btn-outline green btn-sm">
                                                                Appove
                                                            </button>
                                                            <button type="button" class="btn btn-outline red btn-sm">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Completed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END DIV INFO PEDIDOS ASIGNADOS -->

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
                                        //informacion del pedido
                                        /*$objUsuariosDomic = new PDOModel();
                                        $objUsuariosDomic->andOrOperator = "AND";
                                        $objUsuariosDomic->where("id_estado", 7);
                                        $objUsuariosDomic->where("forma_adquisicion", 1);
                                        $result = $objUsuariosDomic->select("pedido");

                                        foreach ($result as $pedido) {*/

                                        $sql = "select * from pedido where id_estado = 7 and forma_adquisicion = 1";
                                        $rs = mysql_query($sql);

                                        while ($pedido = mysql_fetch_array($rs)) {

                                            ?>

                                            <small>
                                                <!-- diseño de una fila de comentario -->
                                                <div class="mt-comment">

                                                    <div class="mt-comment-img">
                                                        <img src="../assets/pages/media/users/avatar1.jpg"/>
                                                        <b>PEDIDO N° <? echo $pedido["id_producto"] ?></b>
                                                    </div>
                                                    <div class="mt-comment-body">
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author">Leidy Ramirez</span>
                                                            <span class="mt-comment-date">11 Agus, 10:30AM</span>
                                                        </div>
                                                        <div class="mt-comment-text">
                                                            <b><? echo $pedido["cantidad"] ?></b>
                                                            - <? echo nombre_producto($pedido["id_producto"]) ?>
                                                        </div>
                                                        <div class="mt-comment-details">
                                                            <span class="mt-comment-status mt-comment-status-rejected">Rechazado</span>
                                                            <ul class="mt-comment-actions">
                                                                <li>
                                                                    <a data-toggle="modal"
                                                                       href="#responsive">Asignar</a>
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

<script src="../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

</body>

</html>