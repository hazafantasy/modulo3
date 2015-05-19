<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>Info modulo3</title>
        <style>
            html, body, #map-canvas {
                height: 100%;
                margin: 0px;
                padding: 0px
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>
            // This example displays a marker at the center of Australia.
            // When the user clicks the marker, an info window opens.

            function initialize() {
                var casillaCentral = new google.maps.LatLng(19.0373846, -98.2072657);
                var casillaEste = new google.maps.LatLng(19.063810, -98.129158);
                var casillaOeste = new google.maps.LatLng(19.053101, -98.235245);
                var casillaSur = new google.maps.LatLng(18.989809, -98.210526);
                var mapOptions = {
                    zoom: 12,
                    center: casillaCentral
                };

                var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                var image = 'images/amarillo.png';


                var contentString = '<div id="content">' +
                        '<div id="siteNotice">' +
                        '</div>' +
                        '<h1 id="firstHeading" class="firstHeading">Votaciones 2015</h1>' +
                        '<div id="bodyContent">' +
                        '<p><b>Votaciones 2015</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
                        'sandstone rock formation in the southern part of the ' +
                        'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) ' +
                        'south west of the nearest large town, Alice Springs; 450&#160;km ' +
                        '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major ' +
                        'features of the Uluru - Kata Tjuta National Park. Uluru is ' +
                        'sacred to the Pitjantjatjara and Yankunytjatjara, the ' +
                        'Aboriginal people of the area. It has many springs, waterholes, ' +
                        'rock caves and ancient paintings. Uluru is listed as a World ' +
                        'Heritage Site.</p>' +
                        '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
                        'https://en.wikipedia.org/w/index.php?title=Uluru</a> ' +
                        '(last visited June 22, 2009).</p>' +
                        '</div>' +
                        '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });


                //HAcer un procesamiento de JSON para hacer solo un hit al servidor y recibir todos los datos de las casillas
                $.get("ax_result?best=2", function (data, status) {
                    if (data > 50) {
                        image = 'images/verde.png';
                    }
                    else {
                        image = 'images/azul.png';
                    }

                    var marker = new google.maps.Marker({
                        position: casillaCentral,
                        map: map,
                        title: 'Votaciones 2015',
                        icon: image
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                });
                
                
                $.get("ax_result?best=1", function (data, status) {
                    if (data > 50) {
                        image = 'images/verde.png';
                    }
                    else {
                        image = 'images/azul.png';
                    }

                    var marker = new google.maps.Marker({
                        position: casillaEste,
                        map: map,
                        title: 'Votaciones 2015',
                        icon: image
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                });
                
                $.get("ax_result?best=3", function (data, status) {
                    if (data > 50) {
                        image = 'images/verde.png';
                    }
                    else {
                        image = 'images/amarillo.png';
                    }

                    var marker = new google.maps.Marker({
                        position: casillaOeste,
                        map: map,
                        title: 'Votaciones 2015',
                        icon: image
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                });
                
              }

            google.maps.event.addDomListener(window, 'load', initialize);

        </script>
    </head>
    <body>
        <div id="map-canvas"></div>
    </body>
</html>