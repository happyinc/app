<!DOCTYPE html>
<html lang="en">
    <head>  
        <?
            require_once'../../externo/plugins/PDOModel.php';
            require'../class/sessions.php';
            $objSe = new Sessions();
            $objSe->init();
            include "funciones.php";
            include("include_css.php");
            include("nombre_cabezera.php");
            include("menu_modal.php");
            
        ?>
        <title><? echo $nombre_pagina ?></title>
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 100%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
        <?php

        $bienes = "";
        $objCat = new PDOModel();
        $resulta = $objCat->executeQuery("SELECT id_bienes, id FROM categoria WHERE id_estado = '1'");
        foreach ($resulta as $item) {

            $bienes["".$item['id_bienes'].""][] = $item['id'];
        }


        $contador = 0;
        $todos = "";
        $fecha=date("Y-m-d H:i:s");
        $objConn = new PDOModel();
        $query_todos = "SELECT A.*, B.*  FROM producto A, producto_disponibilidad B WHERE B.id_producto = A.id AND B.cantidad_disponible > 0 and B.id_estado = 1  ";
        $result =  $objConn->executeQuery($query_todos);
        foreach ($result as $productos ) {


            foreach ($bienes as $clave => $valor)
            {
                $bien = $clave;
                foreach ($valor as $cl => $vr)
                {
                    if($productos["id_categoria"] == $vr)
                    {
                        $todos[$contador]["id_bienes"] = $bien;
                    }
                }
            }
            $todos[$contador]["id_usuario"] = $productos["id_usuario"];
            $todos[$contador]["id_categoria"] = $productos["id_categoria"];

            $contador++;
        }


        ?>
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
        <div id="map"></div>
        <!-- BEGIN CONTAINER -->
        <!-- END CONTAINER -->

            <!-- BEGIN CORE PLUGINS -->
            <?
            include("include_js.php");
            ?>
        <script>
            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.

            function initMap() {

                var styledMapType = new google.maps.StyledMapType(
                    [
                        {
                            "featureType": "landscape",
                            "stylers": [
                                {
                                    "color": "#ebf2fe"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "color": "#000000"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "stylers": [
                                {
                                    "color": "#d6e6fe"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "color": "#9a9a9a"
                                },
                                {
                                    "weight": 0.5
                                }
                            ]
                        },
                        {
                            "featureType": "poi.business",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "visibility": "on"
                                },
                                {
                                    "weight": 2
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "color": "#c0c0c0"
                                },
                                {
                                    "weight": 0.5
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "stylers": [
                                {
                                    "color": "#a7d0fe"
                                },
                                {
                                    "weight": 2
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "color": "#696969"
                                },
                                {
                                    "weight": 0.5
                                }
                            ]
                        }
                    ],
                    {name: 'Styled Map'});

                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 3.4841922999999997, lng: -76.51535799999999},
                    zoom: 13,
                    disableDefaultUI: true,
                    gestureHandling: 'greedy',
                    mapTypeControlOptions: {
                        mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                            'styled_map']
                    }
                });

                var marker = new google.maps.Marker({
                  position: map.getCenter(),
                  icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 3
                  },
                  draggable: true,
                  map: map
                });


                


                //Associate the styled map with the MapTypeId and set it to display.
                map.mapTypes.set('styled_map', styledMapType);
                map.setMapTypeId('styled_map');

                var infoWindow = new google.maps.InfoWindow({map: map});

                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };


                        infoWindow.setPosition(pos);
                        infoWindow.setContent('Hola! tu <b>estas</b> aqui');
                        map.setCenter(pos);
                    }, function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

                setMarkers(map);                        

            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'UPSSS! Enciende tu Localizacion GPS.' :
                    'Error: Es posible que tu dispositivo no soporte la geolocalizacion.');
            }

            

            function setMarkers(map) {
                var food = {
                  url: 'marcadores/food.png',
                  // This marker is 20 pixels wide by 32 pixels high.
                  size: new google.maps.Size(53, 53),
                  // The origin for this image is (0, 0).
                  origin: new google.maps.Point(0, 0),
                  // The anchor for this image is the base of the flagpole at (0, 32).
                  anchor: new google.maps.Point(0, 53)
                };
                var juice = {
                  url: 'marcadores/juice.png',
                  // This marker is 20 pixels wide by 32 pixels high.
                  size: new google.maps.Size(53, 53),
                  // The origin for this image is (0, 0).
                  origin: new google.maps.Point(0, 0),
                  // The anchor for this image is the base of the flagpole at (0, 32).
                  anchor: new google.maps.Point(0, 53)
                };
                var snacks = {
                  url: 'marcadores/snacks.png',
                  // This marker is 20 pixels wide by 32 pixels high.
                  size: new google.maps.Size(53, 53),
                  // The origin for this image is (0, 0).
                  origin: new google.maps.Point(0, 0),
                  // The anchor for this image is the base of the flagpole at (0, 32).
                  anchor: new google.maps.Point(0, 53)
                };

                var asociados = [
                            <?
                            $contador = 0;
                            foreach ($todos as $cl => $vr)
                            {
                                $ubicacion = ubicacion_usuario($vr["id_usuario"]);

                                $temp_ubicacion = explode("|",$ubicacion);
                                $latitud = $temp_ubicacion[0];
                                $longitud = $temp_ubicacion[1];

                                $valor = $vr["id_bienes"];
                                if($valor == 1)
                                {
                                    $tipo_icon = "food";
                                }

                                if($valor == 2)
                                {
                                    $tipo_icon = "juice";
                                }

                                if($valor == 3)
                                {
                                    $tipo_icon = "snacks";
                                }

                                ?>['<? echo nombre_usuario($vr["id_usuario"]); ?>', <? echo $latitud ?>, <? echo $longitud ?>, <? echo $contador ?>, <? echo $tipo_icon ?>, <? echo $vr["id_usuario"]; ?>, "<? echo calificacion_usuario($vr["id_usuario"])?>", "<? echo nombre_categoria($vr["id_categoria"])?>"],<?
                                $contador++;
                            }
                            ?>
                          ];

                var shape = {
                  coords: [1, 1, 1, 20, 18, 20, 18, 1],
                  type: 'poly'
                };
                
                <?
                for ($i = 0; $i < $contador; $i++) {
                    ?>
                    var asociado = asociados[<? echo  $i ?>];

                      var marker<? echo $i ?> = new google.maps.Marker({
                        position: {lat: asociado[1], lng: asociado[2]},
                        map: map,
                        icon: asociado[4],
                        shape: shape,
                        title: asociado[0],
                        zIndex: asociado[3]
                      });

                    var contentString = 
                            '<div style="width: 150px; height: 220px;overflow-y: hidden; overflow-x: hidden;padding:0 !important">'+
                                '<!-- SIDEBAR USERPIC -->'+
                                '<div class="profile-userpic" style="background:white;padding:0 !important">'+
                                    '<img src="usuarios/'+ asociado[5] +'/perfil/mid_perfil.jpg" class="img-responsive" alt="">'+
                                    '<div class="row" style="background:#4B01BA;"></br><div class="fuente-9">'+asociado[0]+'</div><div class="fuente-6">'+asociado[7]+'</div></br></div>'+ 
                                    
                                '</div>'+
                                '<!-- END SIDEBAR USERPIC -->'+
                                '<!-- SIDEBAR USER TITLE -->'+
                                '<div class="profile-usertitle">'+
                                    '<div class="profile-usertitle-job">'+ asociado[6] +'</div>'+   
                                    '<div class="btn-group-circle">'+
                                                '<input type="hidden" name="id_usuario" id="id_usuario" value="'+ asociado[5] +'"/>'+
                                                '<center><a href="disponibilidad_emprendedor.php?id_usuario='+ asociado[5] +'" type="submit" class="btn red-mint btn-outline sbold uppercase" style="border-radius: 10px;">DISPONIBILIDAD</button></center>'+
                                            '</div>'+                              
                                '</div>'+
                                '<!-- END MENU -->'+
                            '</div>';

                    var infowindow<? echo $i ?> = new google.maps.InfoWindow({
                        content: contentString
                    });

                    //window["marker" + i].addListener('click', function () 
                    marker<? echo $i ?>.addListener('click', function ()                    
                    {
                            infowindow<? echo $i ?>.open(map, marker<? echo $i ?>);
                    });
                    <?
                }
                ?>
                
              }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9mEL4ieWH7AHt0OLYpIMc9LKEqA-u3_0&callback=initMap">
        </script>
    </body>
</html>