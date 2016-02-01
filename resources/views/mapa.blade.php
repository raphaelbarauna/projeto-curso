<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.9/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.9/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:20%; bottom:0; width:20%; height: 50%;}
</style>

<style>
  body { margin:0; padding:0; }
  #map { position:absolute; 
  top:20%; bottom:0; width:20%; height: 50%;}
 
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
<ul id='marker-list'></ul>
<script>
L.mapbox.accessToken = 'pk.eyJ1Ijoic2Vrb2xhIiwiYSI6Ik5lV1dNV0kifQ.LbGm-Y6EyUaPQwRcSMS0rw';
  var map = L.mapbox.map('map', 'mapbox.dc-markers');
  var markerList = document.getElementById('marker-list');

  map.featureLayer.on('ready', function(e) {
      map.featureLayer.eachLayer(function(layer) {
          var item = markerList.appendChild(document.createElement('li'));
          item.innerHTML = layer.toGeoJSON().properties.title;
          item.onclick = function() {
             map.setView(layer.getLatLng(), 14);
             layer.openPopup();
          };
      });
  });
</script>