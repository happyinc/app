<?php
//error_reporting(E_ALL ^ E_NOTICE);
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include "funciones.php";
    ?>
<title>Geolocalización</title>
<!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../externo/geo/css/bootstrap.css">
    <!--Main styles-->
    <link rel="stylesheet" type="text/css" href="../../externo/geo/css/main.css">
    <!--Adaptive styles-->
    <link rel="stylesheet" type="text/css" href="../../externo/geo/css/adaptive.css">
    <!--Swipe menu-->
    <link rel="stylesheet" type="text/css" href="../../externo/geo/css/pushy.css">
    <!--fonts-->
    <link rel="stylesheet" type="text/css" href="../../externo/geo/css/font-awesome.css">
    <!--animation css-->
    <link rel="stylesheet" type="text/css" href="../../externo/geo/css/animate.css">
    <!-- Slider Revolution -->
    <link rel="stylesheet" type="text/css" href="../../externo/geo/rs-plugin/css/settings.css" media="screen" />
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    <script>
        var aa = 0;
        var bb = 0;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                aa = pos.lat;
                bb = pos.lng;


            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }
    </script>

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
<body onload="initialize(aa,bb)" class="inmap innerpage">
<!--navigation swipe-->
<div class="menu-btn">&#9776;</div>
<nav class="pushy pushy-left">
<div class="profile">
<div class="avatar"><img src="../../externo/geo/img/avatar/ava_16.jpg" alt="#"><span>5</span></div>
<h3><a href="03.html">HAPPYHAPPY</a></h3>
<a href="#" class="log_btn">Log in</a>
</div>
<ul class="side_menu">
<li><a href="index.html"><i class="fa fa-bookmark-o"></i>Promo page</a></li>
<li><a href="01.html" class="animsition-link"><i class="fa fa-map-marker"></i>Map</a></li>
<li><a href="05.html"><i class="fa fa-list"></i>Place list</a></li>
<li><a href="04.html"><i class="fa fa-th"></i>Place grid</a></li>
<li><a href="02.html"><i class="fa fa-building-o"></i>Place</a></li>
<li><a href="03.html"><i class="fa fa-user"></i>User profile</a></li>
<li><a href="06.html"><i class="fa fa-book"></i>Blog</a></li>
<li><a href="07.html"><i class="fa fa-file-powerpoint-o"></i>Open post</a></li>
</ul>
</nav>


<!--autorization-->
<div class="add_place none" id="autorized">
<div class="place_form login_form">
<i class="fa fa-times close_window" id="closeau"></i>
<h3>Autorization<span></span></h3>
<form>
<label>Login:<input type="text"></label>
<label>Password:<input type="text"></label>
<a href="#" class="btn btn-success">Log in</a>
<a href="#" class="btn btn-primary"><i class="icon-facebook"></i>Log in with Facebook</a>
</form>
</div>
</div>

<!-- Site Overlay -->
<div class="site-overlay"></div>
<div id="container">
<!--Header-->
<div class="container-fluid header inner_head">


</div>

<!--categori menu-->
<div class="container-fluid menu mobile">
<div class="row">
<div class="col-md-12">
<span>Categori menu</span>
<i class="fa fa-times" id="close_menu"></i>
<ul>
    <?

    $objCat = new PDOModel();
    $result = $objCat->executeQuery("SELECT A.id_estado, A.nombre, B.id_estado, B.id_bienes, count(*) as tipobien FROM bienes as A, categoria as B WHERE A.id_estado = '1' and A.id = B.id_bienes and B.id_estado = '1' group by B.id_bienes");
    foreach ($result as $item) {
    if($item['id_bienes'] == 1){
        $icono = "fa fa-cutlery";
        $clase = "cafe";
        $href = "Cafe";
    }
    if($item['id_bienes'] == 2){
        $icono = "fa fa-beer";
        $clase = "club";
        $href = "Club";
    }
    if($item['id_bienes'] == 3){
        $icono = "fa fa-life-ring";
        $clase = "port";
        $href = "Port";
    }
    ?>
<li><a href="javascript:toggleMarkers('<? echo $href; ?>');" class="<? echo $clase; ?>"><i class="<? echo $icono; ?>"></i></a></li>
        <?
    }
    ?>
<li class="mobile_menu"><a href="#"><i class="fa fa-bars"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
<!--map-->
<div id="map" class="map"></div>
<!--/map-->
<!--
#################################
- SCRIPT FILES -
#################################
-->
<!--Google maps API linl
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAOTpZg3Uhl0AItmrXORFIsGfJQNJiLHGg"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9mEL4ieWH7AHt0OLYpIMc9LKEqA-u3_0&callback=initMap"
        async defer></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../../externo/geo/js/jquery.min.js"></script>
<!--scroll animate block-->
<script src="../../externo/geo/js/wow.min.js"></script>
<!--Other main scripts-->
<script src="../../externo/geo/js/all_scr.js"></script>
<!--Bootstrap js-->
<script src="../../externo/geo/js/bootstrap.min.js"></script>
<!--Map js-->

<script type="text/javascript">

    var
        mapObject,
        markers = [],
        markersData = {
            <?
            foreach ($todos as $cl => $vr)
            {
                $valor = $vr["id_bienes"];
                if($valor == 1)
                {
                    ?>'Cafe':<?
                }

                if($valor == 2)
                {
                    ?>'Club':<?
                }

                if($valor == 3)
                {
                    ?>'Port':<?
                }
                ?>
                        [
                            <?
                            $ubicacion = ubicacion_usuario($vr["id_usuario"]);

                            $temp_ubicacion = explode("|",$ubicacion);
                            $latitud = $temp_ubicacion[0];
                            $longitud = $temp_ubicacion[1];
                            ?>
                            {
                                name: 'Cronulla Beach',location_latitude: <? echo $latitud ?>,location_longitude:  <? echo $longitud ?>,map_image_url: 'usuarios/<?echo $vr["id_usuario"];?>/perfil/mid_perfil.jpg',name_point: '<? echo nombre_usuario($vr["id_usuario"]); ?>',
                                description_point:"<? calificacion_usuario($vr["id_usuario"]); ?>",
                                url_point: 'disponibilidad_emprendedor.php?id_usuario=<? echo $vr["id_usuario"]; ?>'
                            },
                            <?

                            ?>

                        ],
                <?
            }
            ?>

        };



    function initialize (a,b) {

    var mapOptions = {
        zoom: 16,
        center: new google.maps.LatLng(a, b),
        mapTypeId: google.maps.MapTypeId.ROADMAP,

        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        panControl: false,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControl: false,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        scaleControl: false,
        scaleControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
        streetViewControl: false,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        styles: [{"featureType":"poi","stylers":[{"visibility":"off"}]},{"stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"elementType":"labels","stylers":[{"gamma":0.26},{"visibility":"off"}]},{"featureType":"road","stylers":[{"lightness":0},{"saturation":0},{"hue":"#ffffff"},{"gamma":0}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"lightness":50},{"saturation":0},{"hue":"#ffffff"}]},{"featureType":"administrative.province","stylers":[{"visibility":"on"},{"lightness":-50}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}]
    };
    var
        marker;
    mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
    for (var key in markersData)
        markersData[key].forEach(function (item) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                map: mapObject,
                icon: '../../externo/geo/img/icon/' + key + '.png',
            });

            if ('undefined' === typeof markers[key])
                markers[key] = [];
            markers[key].push(marker);
            google.maps.event.addListener(marker, 'click', (function () {
                closeInfoBox();
                getInfoBox(item).open(mapObject, this);
                mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
            }));


        });
    };

    function hideAllMarkers () {
        for (var key in markers)
            markers[key].forEach(function (marker) {
                marker.setMap(null);
            });
    };

    function toggleMarkers (category) {
        hideAllMarkers();
        closeInfoBox();

        if ('undefined' === typeof markers[category])
            return false;
        markers[category].forEach(function (marker) {
            marker.setMap(mapObject);
            marker.setAnimation(google.maps.Animation.DROP);

        });
    };

    function closeInfoBox() {
        $('div.infoBox').remove();
    };

    function getInfoBox(item) {
        return new InfoBox({
            content:
            '<div class="marker_info none" id="marker_info">' +
            '<div class="info" id="info">'+
            '<img src="' + item.map_image_url + '" class="logotype" alt=""/>' +
            '<h2><small style="color: white;"><b>'+ item.name_point +'<span></span></b></small></h2>' +
            '<span>'+ item.description_point +'</span>' +
            '<a href="'+ item.url_point + '" class="green_btn" style="bottom: 15px !important; "><b>DISPONIBILIDAD</b></a>' +
            '<span class="arrow"></span>' +
            '</div>' +
            '</div>',
            disableAutoPan: true,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(40, -210),
            closeBoxMargin: '50px 200px',
            closeBoxURL: '',
            isHidden: false,
            pane: 'floatPane',
            enableEventPropagation: true
        });


    };
</script>
<script type="text/javascript" src="../../externo/geo/js/infobox.js"></script>
<!--Slider Revolution-->
<script type="text/javascript" src="../../externo/geo/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="../../externo/geo/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!--Parallax-->
<script type="text/javascript" src="../../externo/geo/js/jquery.parallax-0.2-min.js"></script>
</body>
</html>