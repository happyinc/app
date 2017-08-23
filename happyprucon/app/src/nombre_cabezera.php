<style type="text/css">
        /* fuentes en nuestro disco duro */
        @font-face {
            font-family: "Museo Sans 700";
            src: url("fonts/MuseoSans_700.otf") format("opentype");
        }

        .fuente-1{font-family:"Museo Sans 700";font-size: 20px;color: white}
        .fuente-2{font-family:"Museo Sans 700";font-size: 15px;color: #5F059E}
        .fuente-3{font-family:"Museo Sans 700";font-size: 14px;color: #00F85B}
        .fuente-4{font-family:"Museo Sans 700";font-size: 15px;color: white}
        .fuente-5{font-family:"Museo Sans 700";font-size: 14px;color: white}
        .fuente-6{font-family:"Museo Sans 700";font-size: 12px;color: #00F85B}
        .fuente-7{font-family:"Museo Sans 700";font-size: 18px;color: white}
        .fuente-8{font-family:"Museo Sans 700";font-size: 12px;color: grey}
        .fuente-9{font-family:"Museo Sans 700";font-size: 12px;color: #5F059E}
        .fuente-10{font-family:"Museo Sans 700";font-size: 11px;color: white}
        .fuente-11{font-family:"Museo Sans 700";font-size: 10px;color: grey}
</style>
<?  
            $archivo_temp = basename($_SERVER["PHP_SELF"]);
            $array_temp = explode("/", $archivo_temp);

            $nombre_temp = "";
            foreach ($array_temp as $key => $value) {
                $nombre_temp = $value;
            }

            $archivo_actual = "";
            $nombre_pagina = "";
            switch($nombre_temp) //Valido en que archivo estoy para generar mi CSS de selección
            {
                case "guia.php":
                    $archivo_actual = 'NOMBRE DE APP';
                    $nombre_pagina = "NOMBRE DE APP";
                    $archivo_herramienta = "<img src='buscar.png' alt='logo' class='logo-default' height='25'/>";
                    break;
                case "main.php":
                    $archivo_actual = "<img src='logo_head.png' alt='logo' class='logo-default' height='25'/>";
                    $nombre_pagina = "PAGINA PRINCIPAL";
                    $archivo_herramienta = "<a href='buscar.php' style'text-decoration:underline;'><img src='buscar.png' alt='logo' class='logo-default' height='25'/></a>";
                    
                    break;
                case "gestion_pedido.php":
                    $archivo_actual = "<img src='logo_head.png' alt='logo' class='logo-default' height='25'/>";
                    $nombre_pagina = "GESTION DE PEDIDOS";
                    $archivo_herramienta = "";
                    break; 
                case "editar_producto.php":
                    $archivo_actual = strtoupper(nombre_producto($id_producto));
                    $nombre_pagina = "EDITAR PRODUCTO";
                    $archivo_herramienta = "";
                    break;
                case "crear_producto.php":
                    $archivo_actual = 'CREAR BIEN - SERVICIO';
                    $nombre_pagina = "CREAR BIEN O SERVICIO";
                    $archivo_herramienta = "";
                    break;    
                case "nombre_cabezera.php":
                    $archivo_actual = 'HAPPY CABEZERA';
                    $nombre_pagina = "GESTION DE CABEZERA";
                    $archivo_herramienta = "";
                    break;
                case "mapa.php":
                    $archivo_actual = "<img src='logo_head.png' alt='logo' class='logo-default' height='25'/>";
                    $nombre_pagina = "GEOLOCALIZACION HAPPY";
                    $archivo_herramienta = "";
                    break; 
                case "editar_perfil.php":
                    $archivo_actual = "EDITAR PERFIL";
                    $nombre_pagina = "EDITAR PERFIL";
                    $archivo_herramienta = "";
                    break;
                case "gestion_producto.php":
                    $archivo_actual = "BIENES O SERVICIOS";
                    $nombre_pagina = "BIENES O SERVICIOS";
                    $archivo_herramienta = "";
                    break;
                case "editar_perfil_cliente.php":
                    $archivo_actual = "EDITAR PERFIL";
                    $nombre_pagina = "EDITAR PERFIL";
                    $archivo_herramienta = "";
                    break;
                case "perfil.php":
                    $archivo_actual = strtoupper(nombre_usuario($id_usuario));
                    $nombre_pagina = "PERFIL USUARIO";
                    if($id_usuario == $_SESSION["id_usuario"])
                    {
                        $archivo_herramienta = "<a href='editar_perfil.php?id_usuario=$id_usuario' style'text-decoration:underline;color: gray;'><b>EDITAR</b></a>";
                    }
                    else
                    {
                        $archivo_herramienta = "";
                    }
                    break;
                case "perfil_cliente.php":
                    $archivo_actual = strtoupper(nombre_usuario($id_usuario));
                    $nombre_pagina = "PERFIL USUARIO";
                    if($id_usuario == $_SESSION["id_usuario"])
                    {
                        $archivo_herramienta = "<a href='editar_perfil_cliente.php?id_usuario=$id_usuario' style'text-decoration:underline;color: gray;'><b>EDITAR</b></a>";
                    }
                    else
                    {
                        $archivo_herramienta = "";
                    }
                    break;
                default:
                    $archivo_actual = "<img src='logo_head.png' alt='logo' class='logo-default' height='25'/>";
                    $nombre_pagina = "HAPPY HAPPY";
                    $archivo_herramienta = "";
                    break;
                case "ver_pagos.php":
                    $archivo_actual = "MIS PAGOS";
                    $nombre_pagina = "MIS PAGOS";
                    $archivo_herramienta = "";
                    break;
                case "buscar.php":
                    $archivo_actual = "FILTRAR";
                    $nombre_pagina = "FILTRAR";
                    $archivo_herramienta = "<a data-toggle='modal' data-target='#myModal'><i class='fa fa-sliders fa-2x' style='color: black;'></i></a>";
                    break;

            }
        
?>