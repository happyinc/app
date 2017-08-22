<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include "funciones.php";
    include "include_css.php";
    ?>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
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
</head>
<body>
<div id="map"></div>
<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 15
        });
        var infoWindow = new google.maps.InfoWindow({map: map});
<?
        $objConn = new PDOModel();
        $objConn->where("id_roles",2);
        $res_usu =  $objConn->select("usuarios");
        foreach ($res_usu as $ubica){
        ?>
        var ubicaciones<? echo $ubica['id']?> = {lat: <? echo $ubica['latitud'] ?>, lng: <? echo $ubica['longitud'] ?>};

        var contentString<? echo $ubica['id']?> =
        '<div id="content" style="padding-left: 20px !important; border-radius: 20px;">' +
            '<div class="mt-widget-2" style="border: 0 !important" >'+
                '<div class="mt-head" style="background-image: url(usuarios/<?echo$ubica["id"];?>/perfil/mid_perfil.jpg); height: 100px;" >'+
                    '<div class="mt-head-user-img"></div>'+
                '</div>'+
            '</div>'+
            '<div class="mt-body" style="padding-top: 80px !important;">'+
                '<h3 class="mt-body-title bold"> <? echo $ubica["nombre"]; ?> </h3>'+
                    '<ul class="mt-body-stats">'+
                        '<? echo $ubica["id"]; ?>'+
                    '</ul>'+
                '<div class="btn-group-circle">'+
                    '<input type="hidden" name="id_usuario" id="id_usuario" value="<? echo $ubica["id"]; ?>"/>'+
                    '<center><a href="disponibilidad_emprendedor.php?id_usuario=<? echo $ubica["id"]; ?>" type="submit" class="btn red-mint btn-outline sbold uppercase" style="border-radius: 10px;">DISPONIBILIDAD</button></center>'+
                '</div>'+
            '</div>'+
        '</div>';


        var infowindow<? echo $ubica['id']?> = new google.maps.InfoWindow({
            content: contentString<? echo $ubica['id']?>
        });

        var marker<? echo $ubica['id']?> = new google.maps.Marker({
            position: ubicaciones<? echo $ubica['id']?>,
            map: map
            ,
            title: 'Prueba de ubicacion<? echo $ubica['id']?>'
        });
        marker<? echo $ubica['id']?>.addListener('click', function () {
            infowindow<? echo $ubica['id']?>.open(map, marker<? echo $ubica['id']?>);
        });

        <?
        }
        ?>


        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }
</script>
<?
include "include_js.php";
?>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOTpZg3Uhl0AItmrXORFIsGfJQNJiLHGg&callback=initMap">
</script>

</body>
</html>