@extends('app')

@section('content')

    <!DOCTYPE html>
    <html>
    <head>
        <title>Exibindo no Google Maps o endereço digitado</title>
        <script src="https://maps.googleapis.com/maps/api/js?=false"></script>
    </head>
    <body>
    <input type="text" id="address"  value="Rua, Nº , Bairro" />
    <input type="button" value="Enviar" onclick="codeAddress()" />
    <div id="map-canvas" style="width: 640px;left: 400px; height:480px"></div>

    </body>
    <script>
        var geocoder;
        var map;
        function initialize() {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var mapOptions = {
                zoom: 15,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new         google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            codeAddress();
        }

        function codeAddress() {
            var address = document.getElementById('address').value;
            geocoder.geocode( { 'address': address},     function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    </html>
  

@stop
