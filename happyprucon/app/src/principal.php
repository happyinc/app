<!DOCTYPE html>
<html>
<head>
    <title>Styled Map Types</title>
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

</head>
<body onload="initMap(aa,bb)">
<div id="map"></div>
<script>
    function initMap(aa,bb) {

        alert(aa+ " - "+ bb)
        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
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


        // Create a map object, and include the MapTypeId to add
        // to the map type control.
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: aa, lng: bb},
            zoom: 16,
            mapTypeControlOptions: {
                mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
            }
        });

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9mEL4ieWH7AHt0OLYpIMc9LKEqA-u3_0">
</script>
</body>
</html>