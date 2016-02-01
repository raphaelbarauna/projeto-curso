@extends('app')

@section('content')
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.9/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.9/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; right:30%; top:20%; bottom:0; width:30%; height: 60%;}
</style>

<style>
  body { margin:0; padding:0; }
  #map { position:absolute; right:30%; top:20%; bottom:0; width:30%; height: 60%;}
 
 <div class="col-sm-3">
    <div class="left-sidebar">
<h2>Restaurantes</h2>
        <div class="panel-group category-products" id="accordian"><!--category-products-->
                     			                    
 #marker-list {
      position:absolute;
      top:20%; right:0; width:1000px;
      bottom:0;
      overflow-x:auto;
      background:#fff;
      margin:0;
      padding:5px;
  }
  #marker-list li {
      padding:5px;
      margin:0;
      list-style-type:none;
  }
  #marker-list li:hover {
      background:#eee;
  }
  </style>
<div id='map'></div>

    <ul id="marker-list">
        <li>Salvador</li>
        <li>Shop Salvador</li>
        <li>Iguatemi</li>
        <li>Barra Shop</li>
        <li>Paralela</li>
        <li>Aeroclube</li>
        <li>Nort Shop</li>
        <li>Itaigara</li>
        <li>Truckeroo</li></ul>
</ul>

<a href='#' id='geolocate' class='ui-button'>Find me</a>
</ul>


	
<script>
L.mapbox.accessToken = 'pk.eyJ1Ijoic2Vrb2xhIiwiYSI6Ik5lV1dNV0kifQ.LbGm-Y6EyUaPQwRcSMS0rw';
  var map = L.mapbox.map('map', 'mapbox.dc-markers');
  var markerList = document.getElementById('marker-list');
  var geolocate = document.getElementById('geolocate');
  
  var myLayer = L.mapbox.featureLayer().addTo(map);

  map.featureLayer.on('ready', function(e) {
      map.featureLayer.eachLayer(function(layer) {
         // var item = markerList.appendChild(document.createElement('li'));
          item.innerHTML = layer.toGeoJSON().properties.title;
          item.onclick = function() {
             map.setView(layer.getLatLng(), 14);
             layer.openPopup();
          };
      });
  });
  if (!navigator.geolocation) {
    geolocate.innerHTML = 'Geolocation is not available';
} else {
    geolocate.onclick = function (e) {
        e.preventDefault();
        e.stopPropagation();
        map.locate();
    };
}

// Once we've got a position, zoom and center the map
// on it, and add a single marker.
map.on('locationfound', function(e) {
    map.fitBounds(e.bounds);

    myLayer.setGeoJSON({
        type: 'Feature',
        geometry: {
            type: 'Point',
            coordinates: [e.latlng.lng, e.latlng.lat]
        },
        properties: {
            'title': 'Here I am!',
            'marker-color': '#ff8888',
            'marker-symbol': 'star'
        }
    });

    // And hide the geolocation button
    geolocate.parentNode.removeChild(geolocate);
});

// If the user chooses not to allow their location
// to be shared, display an error message.
map.on('locationerror', function() {
    geolocate.innerHTML = 'Position could not be found';
});
  
  
</script>
@stop
