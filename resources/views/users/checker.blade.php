@extends('masters.AppPrimary')
@section('css')
<style type="text/css">
	#map{
		margin-top: 20px;
		margin-bottom: 20px;
		width: 100%;
		height: 500px;
		background-color: #e7e7e7;
	}
</style>
@endsection
<div class="container">
<h1>Job Checker Page</h1>
<div id="map"></div>
<hr>
<h1>Radius: 1 KM</h1>
<p>Jobs Covered:</p>
</div>

@section('js')
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places"></script>

<script type="text/javascript">

var map;
var circle;
var place;
var nearbs;
var markers = [];
var geolocations;
//----------------------------Initialization------------------------------------//

function initialize(){

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {

    var geolocations = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      var meos = [];
      var locs;
      var centers = { lat:geolocations.lat , lng:geolocations.lng };
      meos.push(centers);
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({ 'latLng': meos[0] }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
             console.log(results);
          var res = results[0].address_components;
          for(var i=0; i<res.length; i++){
            if(res[i].types[0] =="locality"){
             $('#search-loc').val(res[i].long_name);
             nearbs = res[i].long_name;
             console.log(nearbs);
           }
         }
       }
     });

  map = new google.maps.Map(document.getElementById('map'), {
        center:centers,
        zoom: 15
      });

 	var marker = new google.maps.Marker({
    map: map,
    position: meos[0],
    draggable: true
  });
 	
 	var radius = 1000;

   circle = new google.maps.Circle({
            map: map,
            clickable: false,
            // metres
            radius: radius,
            fillColor: '#fff',
            fillOpacity: .6,
            strokeColor: '#313131',
            strokeOpacity: .4,
            strokeWeight: .8
        });
    // attach circle to marker
    circle.bindTo('center', marker, 'position');
})
    }

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  var request = $.ajax({
  url:'/get/checker/dummy',
  method:'GET',
});
  
  request.done(function(data){
  	console.log(data);
  	var arr = [];
  	for(var i=0; i<data.address.length;i++){
	var centers = { lat: parseFloat(data.address[i].lat), lng: parseFloat(data.address[i].lng) };
    arr.push(centers);
  	var m;
  	m = new google.maps.Marker({
    map: map,
    position: arr[i],
    draggable: true
  });
}
  });
  }

$(document).ready(function(){

initialize();
});

</script>
@endsection