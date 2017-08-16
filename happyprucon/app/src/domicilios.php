<?php
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
    include "funciones.php";
    require_once '../../externo/plugins/PDOModel.php';
    ?>
</head>

<body class="page-header-fixed page
-sidebar-closed-hide-logo page-container-bg-solid page-md">

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        <div class="row">

            <div class="col-lg-6 col-xs-12 col-sm-12">
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

                            <div class="slimScrollDiv"
                                 style="position: relative; overflow: hidden; width: auto; height: 338px;">

                                <div class="scroller" style="height: 338px; overflow: hidden; width: auto;"
                                     data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2"
                                     data-initialized="1">

                                    <div class="tab-pane active" id="portlet_comments_1">

                                        <!-- Seccion de todos los comentarios -->
                                        <div class="mt-comments">
                                            <?
                                            //informacion del pedido
                                            $objPedido = new PDOModel();
                                            /*$objPedido->andOrOperator = "AND";
                                            $objPedido->where("id_estado", 7);
                                            $objPedido->where("forma_adquisicion", 1);*/
                                            $result = $objPedido->select("pedido");

                                            foreach ($result as $pedido) {

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
                                                                <span class="mt-comment-status mt-comment-status-rejected">Pendiente</span>
                                                                <ul class="mt-comment-actions">
                                                                    <li>
                                                                        <a href="#">Asignar</a>
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

                                <div class="slimScrollBar"
                                     style="background: rgb(215, 220, 226); width: 7px; position: absolute; top: 102px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 235.555px;"></div>

                                <div class="slimScrollRail"
                                     style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>

                            </div>

                        </div>

                    </div>
                    <!-- fin cuerpo del div blanco PEDIDOS SIN ASIGNAR -->

                </div>
                <!-- FIN DISEÑO DE UN DIV -->


                <!-- DISEÑO DE UN DIV -->
                <div class="portlet light ">

                    <!-- cabezera del div blanco PEDIDOS SIN ASIGNAR -->
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-bubbles font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Pedidos Rechazados</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#portlet_comments_1" data-toggle="tab"> Pending </a>
                            </li>
                            <li>
                                <a href="#portlet_comments_2" data-toggle="tab"> Approved </a>
                            </li>
                        </ul>
                    </div>
                    <!-- fin cabezera del div blanco PEDIDOS SIN ASIGNAR -->

                    <!-- cuerpo del div blanco PEDIDOS SIN ASIGNAR -->
                    <div class="portlet-body">

                        <div class="tab-content">

                            <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0"
                                 data-handle-color="#D7DCE2">

                                <div class="tab-pane active" id="portlet_comments_1">

                                    <!-- Seccion de todos los comentarios -->
                                    <div class="mt-comments">

                                        <!-- diseño de una fila de comentario -->
                                        <div class="mt-comment">

                                            <div class="mt-comment-img">
                                                <img src="../assets/pages/media/users/avatar1.jpg"/></div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author">Leidy Ramirez</span>
                                                    <span class="mt-comment-date">11 Agus, 10:30AM</span>
                                                </div>
                                                <div class="mt-comment-text"> 4 Hamburguesas Vegetarianas
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-rejected">Pendiente</span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="#">Quick Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">View</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- fin diseño de una fila de comentario -->

                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="../assets/pages/media/users/avatar6.jpg"/></div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author">Leidy Ramirez</span>
                                                    <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                                </div>
                                                <div class="mt-comment-text"> 8 Carnes Fritas
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-rejected">Pendiente</span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="#">Quick Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">View</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- fin Seccion de todos los comentarios -->

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- fin cuerpo del div blanco PEDIDOS SIN ASIGNAR -->

                </div>
                <!-- FIN DISEÑO DE UN DIV -->

            </div>

        </div>

    </div>

</div>

<?php
include "footer.php";
?>
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<?php
include "include_js.php";
?>

</body>

</html>