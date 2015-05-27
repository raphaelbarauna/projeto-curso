@extends('app')

@section('content')

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Google Maps localiza latitude / longitude</title>

        <link href="../../css/screen.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
            var map;
            var geocoder;
            var centerChangedLast;
            var reverseGeocodedLast;
            var currentReverseGeocodeResponse;

            function initialize() {
                var latlng = new google.maps.LatLng(-12.981175303660732, -38.465041799999995);
                var myOptions = {
                    zoom: 12,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                geocoder = new google.maps.Geocoder();


                setupEvents();
                centerChanged();
            }

            function setupEvents() {
                reverseGeocodedLast = new Date();
                centerChangedLast = new Date();

                setInterval(function() {
                    if((new Date()).getSeconds() - centerChangedLast.getSeconds() > 1) {
                        if(reverseGeocodedLast.getTime() < centerChangedLast.getTime())
                            reverseGeocode();
                    }
                }, 1000);

                google.maps.event.addListener(map, 'zoom_changed', function() {
                    document.getElementById("zoom_level").innerHTML = map.getZoom();
                });

                google.maps.event.addListener(map, 'center_changed', centerChanged);

                google.maps.event.addDomListener(document.getElementById('crosshair'),'dblclick', function() {
                    map.setZoom(map.getZoom() + 1);
                });

            }

            function getCenterLatLngText() {
                return '(' + map.getCenter().lat() +', '+ map.getCenter().lng() +')';
            }

            function centerChanged() {
                centerChangedLast = new Date();
                var latlng = getCenterLatLngText();
                document.getElementById('latlng').innerHTML = latlng;
                document.getElementById('formatedAddress').innerHTML = '';
                currentReverseGeocodeResponse = null;
            }

            function reverseGeocode() {
                reverseGeocodedLast = new Date();
                geocoder.geocode({latLng:map.getCenter()},reverseGeocodeResult);
            }

            function reverseGeocodeResult(results, status) {
                currentReverseGeocodeResponse = results;
                if(status == 'OK') {
                    if(results.length == 0) {
                        document.getElementById('formatedAddress').innerHTML = 'None';
                    } else {
                        document.getElementById('formatedAddress').innerHTML = results[0].formatted_address;
                    }
                } else {
                    document.getElementById('formatedAddress').innerHTML = 'Error';
                }
            }


            function geocode() {
                var address = document.getElementById("address").value;
                geocoder.geocode({
                    'address': address,
                    'partialmatch': true}, geocodeResult);
            }

            function geocodeResult(results, status) {
                if (status == 'OK' && results.length > 0) {
                    map.fitBounds(results[0].geometry.viewport);
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            }

            function addMarkerAtCenter() {
                var marker = new google.maps.Marker({
                    position: map.getCenter(),
                    map: map
                });

                var text = 'Lat/Lng: ' + getCenterLatLngText();
                if(currentReverseGeocodeResponse) {
                    var addr = '';
                    if(currentReverseGeocodeResponse.size == 0) {
                        addr = 'None';
                    } else {
                        addr = currentReverseGeocodeResponse[0].formatted_address;
                    }
                    text = text + '<br>' + 'address: <br>' + addr;
                }

                var infowindow = new google.maps.InfoWindow({ content: text });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });
            }

        </script>
    </head>

    <body onLoad="initialize()">
    <h1 style="display:none;">APP Google Maps - Localizar Latitude / Longitude</h1>
    <div style="position: relative; width:980px; left:50%; margin-left:-490px; height:90px;">

        <div style="position:absolute; right:0px; top:30px;">
            Localizar Região:
            <input type="text" class="form_contato" id="address" style="width:300px; margin-right:15px;"/>

            <input type="button" value="Procurar" onClick="geocode()" class="form_contato"> <input type="button" value="Adicionar ponto no mapa" onClick="addMarkerAtCenter()" class="form_contato"/>
        </div>
    </div>
    <div style="background:url(../../images/geral/separacao_line.png) repeat-x; height:2px;"></div>
    <div style="position: relative; width:980px; left:50%; margin-left:-490px; height:40px; line-height:40px; text-align:center;" class="Caecilia17">Para realizar a pesquisa digite no formulario acima o endereço desejado.</div>
    <div style="background:url(../../images/geral/separacao_line.png) repeat-x; height:2px;"></div>
    <div style="background:#ffffff;">
        <div id="map">
            <div id="map_canvas" style="width:50%; left:300px; height:400px"></div>

            <div id="crosshair"></div>
        </div>
    </div>
    <div style="background:url(../../images/geral/separacao_line.png) repeat-x; height:2px;"></div>
    <div style="position: relative; width:980px; left:50%; margin-left:-490px; height:90px; margin-top:20px; line-height:20px;" class="arial15cinza">
        Latitude / Longitude: <span id="latlng"></span><br />
        Endereço: <span id="formatedAddress"></span><br />
        Nivel do zoom: <span id="zoom_level"></span><br />
    </div>
    </body>
    </html>
@stop
