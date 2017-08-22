<?
if(isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] != "")
{
    $id_usuario_menu = $_SESSION["id_usuario"];
}
else
{
    ?><script type="text/javascript">location.href ="selec_log.html";</script><?
}

?>
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style="background:#5F059E;">
                                    <div class="row" style="background:#5F059E;">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >
                                            <!-- SIDEBAR USERPIC -->
                                            <div class="mt-img" style="margin-bottom: 10px !important;">
                                                <img src="<? echo "usuarios/".$_SESSION["id_roles"]."/perfil/res_perfil.jpg"?>" width="90" class="img-circle" style="border-radius: 50%;">  
                                            </div>
                                            <!-- END SIDEBAR USERPIC -->
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="text-align: center;">
                                            
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="text-align: left;">
                                            <!-- SIDEBAR USER TITLE -->
                                            <small>
                                            <div class="profile-usertitle" style="text-align: left;">
                                                <div class='fuente-4'><? echo nombre_usuario($_SESSION["id_usuario"]) ?></div>
                                                <div class='fuente-6'>
                                                    <i class="fa fa-street-view"></i> 
                                                    Perfil: <? echo nombre_rol($_SESSION["id_roles"]) ?> 
                                                </div>
                                            </div>
                                            </small>
                                            <!-- END SIDEBAR USER TITLE -->
                                        </div>
                                    </div>
                                </br>
                                    <div style="background:#4B01BA;">
                                                    <? 
                                                    if(isset($_SESSION["id_roles"]) && $_SESSION["id_roles"] != "")
                                                    {
                                                        if($_SESSION["id_roles"] == 1)
                                                        {
                                                            echo "ADMINISTRADOR";
                                                        }
                                                        else if($_SESSION["id_roles"] == 2)
                                                        {
                                                            ////MENU DEL EMPRENDEDOR
                                                            ?> 
                                                            <a href="perfil.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-user"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> VER PERFIL </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="gestion_pedido.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-tasks"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> GESTION DE PEDIDOS </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="gestion_producto.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-cubes"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> LISTA DE BIENES </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="ver_pagos.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-money"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> MIS PAGOS </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"></div>
                                                                    </div>
                                                                </div>
                                                            <a href="cerrar.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-power-off"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> CERRAR SESION </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <?
                                                        }
                                                        else if($_SESSION["id_roles"] == 3)
                                                        {
                                                            ////MENU DEL CLIENTE
                                                            ?>  
                                                            <a href="main.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-home"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> INICIO </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="perfil_cliente.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-user"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> VER PERFIL </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="mis_pedidos.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-tasks"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> MIS PEDIDOS </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="crear_tarjetas.php?id_usuario=<? echo $id_usuario_menu ?>&id_pedido=0">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-credit-card"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> REGISTRAR TARJETAS </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"></div>
                                                                    </div>
                                                                </div>
                                                            <a href="cerrar.php?id_usuario=<? echo $id_usuario_menu ?>">
                                                                <div class="row" style="background:#4B01BA;">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;height:50px;">
                                                                        <div class='fuente-1' style="display: table-cell;vertical-align: middle;text-align: center;">
                                                                            <i class="fa fa-power-off"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="display: table;height:50px;">
                                                                        <div class='fuente-5' style="display: table-cell;vertical-align: middle;text-align: left;"> CERRAR SESION </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <?
                                                        }
                                                        else if($_SESSION["id_roles"] == 4)
                                                        {
                                                            echo "COORDINADOR PEDIDOS";
                                                        }
                                                        else if($_SESSION["id_roles"] == 5)
                                                        {
                                                            echo "DOMICILIARIO";
                                                        }
                                                        else if($_SESSION["id_roles"] == 6)
                                                        {
                                                            echo "SERVICIO AL CLIENTE";
                                                        }
                                                    }
                                                    ?>
                                        
                                    </div>

                        </div>
                    </div>
                </div>
            </div>