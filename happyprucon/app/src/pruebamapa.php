<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //error_reporting(E_ALL ^ E_NOTICE);
    require_once'../../externo/plugins/PDOModel.php';
    include '../class/sessions.php';

    $objSe = new Sessions();
    ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My City - shared on themelock.com Places Map</title>

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
</head>
<body class="inmap innerpage">
<!--navigation swipe-->
<div class="menu-btn">&#9776;</div>
<nav class="pushy pushy-left">
<div class="profile">
<div class="avatar"><img src="../../externo/geo/img/avatar/ava_16.jpg" alt="#"><span>5</span></div>
<h3><a href="03.html">Ananew Matvey</a></h3>
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

<!--add-->
<div class="add_place none" id="pl">
<div class="place_form">
<i class="fa fa-times close_window" id="close"></i>
<h3>Add new place<span></span></h3>
<form>
<label>Place name:<input type="text"></label>
<label>latitude:<input type="text"></label>
<label>longitude:<input type="text"></label>
<label>Categori:
<select>
<option value="Cafe">Cafe</option>
<option value="Bar">Bar</option>
<option value="Cinema">Cinema</option>
<option value="Shop">Shop</option>
<option value="Club">Club</option>
<option value="Bank">Bank</option>
</select>
</label>
<a href="#" class="green_btn_header" id="add">Add</a>
</form>
</div>
</div>

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

<div class="fixed_w">
<div class="row">
<div class="col-md-12"><a href="index.html" class="logo"><img src="img/logoin.png" alt="Mycity"/></a>
<input type="text" class="search" placeholder="search"><a href="#" class="green_btn_header" id="ad">Add place</a></div>
</div>
</div>
</div>

<!--categori menu-->
<div class="container-fluid menu mobile">
<div class="row">
<div class="col-md-12">
<span>Categori menu</span>
<i class="fa fa-times" id="close_menu"></i>
<ul>
<li><a href="javascript:toggleMarkers('Shop');" class="shop"><i class="fa fa-shopping-cart"></i></a></li>
<li><a href="javascript:toggleMarkers('Cinema');" class="cinema"><i class="fa fa-film"></i></a></li>
<li><a href="javascript:toggleMarkers('Club');" class="club"><i class="fa fa-beer"></i></a></li>
<li><a href="javascript:toggleMarkers('Cafe');" class="cafe"><i class="fa fa-cutlery"></i></a></li>
<li><a href="javascript:toggleMarkers('Sport');" class="sport"><i class="fa fa-futbol-o"></i></a></li>
<li><a href="javascript:toggleMarkers('Port');" class="port"><i class="fa fa-life-ring"></i></a></li>
<li><a href="javascript:toggleMarkers('Bank');" class="bank"><i class="fa fa-university"></i></a></li>
<li><a href="javascript:toggleMarkers('Post');" class="post"><i class="fa fa-envelope-o"></i></a></li>
<li><a href="javascript:toggleMarkers('Showplace');" class="showplace"><i class="fa fa-eye"></i></a></li>
<li><a href="javascript:toggleMarkers('Park');" class="park"><i class="fa fa-leaf"></i></a></li>
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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9mEL4ieWH7AHt0OLYpIMc9LKEqA-u3_0&callback=initMap">
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../../externo/geo/js/jquery.min.js"></script>
<!--scroll animate block-->
<script src="../../externo/geo/js/wow.min.js"></script>
<!--Other main scripts-->
<script src="../../externo/geo/js/all_scr.js"></script>
<!--Bootstrap js-->
<script src="../../externo/geo/js/bootstrap.min.js"></script>
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
            zoom: 16,
            mapTypeControlOptions: {
                mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
            }
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
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'UPSSS! Enciende tu Localizacion GPS.' :
            'Error: Es posible que tu dispositivo no soporte la geolocalizacion.');
    }
</script>

<!--Slider Revolution-->
<script type="text/javascript" src="../../externo/geo/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="../../externo/geo/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!--Parallax-->
<script type="text/javascript" src="../../externo/geo/js/jquery.parallax-0.2-min.js"></script>
</body>
</html>