@extends('masters.header')
@section('css')
    <link rel="stylesheet" href="/css/setup.css">
@endsection
@section('content')
<div class="container">

    <div class="row">
        <section>
        <panel-body>
        <div class="wizard">
        <h1>Welcome to JobPlus!</h1>
        <p>This section will help us serve you the job that fits your interest and connects you to thousands of job seekers through JobPlus. We'll ask you to select jobs of interest and complete a profile for review. 
        </p>
        </panel>
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-wrench"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-map-marker"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-credit-card"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form id="setup" role="form" action="{{route('user/save')}}" method="post">
            {{csrf_field()}}
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h2>Basic Informations</h2>
                        <p>Kindly fill up the form below.</p>
                        <hr>
                        <div class="row">
                      
                            <div class="col-sm-4 col-sm-offset-1">
                              <h3>Upload Picture</h3>
                               <input type="file" name="picture" id="picture">
                             </div>
                        </div>
                        <br>
                       <div class="row">
                       <h3>Name</h3>
                        <div class="col-sm-4 col-sm-offset-1">
                            <div class="form-group">
                                <input type="text" name="lastname" class="form-LastName form-control" id="lastname" placeholder="LastName">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="firstname"  class="form-firstname form-control" id="firstname" placeholder="FirstName">
                            </div>
                        </div>
                        </div>
                         <div class="row">
                         <div class="col-sm-4 col-sm-offset-1">
                         <h3>Contact</h3>
                            <div class="form-group">
                                 <input type="text" name="mobile" class="form-mobile form-control" id="mobile" placeholder="Mobile Number">
                            </div>
                         </div>
                         </div>
                         <div class="row">
                         <div class="col-sm-8 col-sm-offset-1">
                             <h3>About Me</h3>
                            <div class="form-group ">
                                 <textarea style="width:100%;height:130px;" name="aboutme" form="setup"></textarea>
                            </div>
                         </div>
                         </div>
                         <hr>
                         <div class="row">
                         <div class="col-sm-2 col-sm-offset-1">
                         <h3>Education</h3>
                            <div class="form-group">
                                 <p>Degree</p>
                                 <select name="degrees" id="degree">
                                 @foreach($degree as $deg)
                                    <option value="{{ $deg->degree_id }}" >{{ $deg->name }}</option>
                                 @endforeach
                                 </select>
                            </div>
                         </div>
                         </div>
                         <div class="row">
                           <div class="col-sm-2 col-sm-offset-1">
                            <div class="form-group">
                                 <p>Year Attended</p>
                                 <div id="divstartyear">
                                   <input type="text" name="yearstart[]" id="year[]">
                                   </div>
                             </div>
                        </div>
                           <div class="col-sm-2 col-sm-offset-1">
                            <div class="form-group">
                                 <p>Year Ended</p>
                                 <div id="divendyear">
                                   <input type="text" name="yearend[]" id="year[]">
                                   </div>
                             </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="form-group">
                                 <p>School</p>
                                 <div id="divschool">
                                    <input type="text" name="school[]" id="school[]"></div>
                                 </div>
                            </div>
                         </div>
                           <input type="button" value="Add Education" onClick="addEducation('divschool','divstartyear','divendyear');">
                         <hr>
                        <ul class="list-inline ">
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Next Step</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                         <div class="row">
                                   <h3>Skills </h3>
                              <div class="form-box">
                                <div class="col-sm-12">
                                <div class="panel">
                                <div class="panel-body">
                <div class="col-sm-10 col-md-offset-1">
                    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <div class="hidden-xs">Housekeeping</div>
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" id="stars" class="btn btn-primary" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <div class="hidden-xs">Construction</div>
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" id="stars" class="btn btn-primary" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                <div class="hidden-xs">Personel</div>
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" id="favorites" class="btn btn-default" href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                <div class="hidden-xs">Maintenance</div>
                            </button>
                        </div>
                    </div>
                     
                      <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1">
                          <h3>Housekeeping</h3>
                            <ul class="input-list">
                                 <li class="setup-skills">
                                <div class="pure-checkbox">
                                    @foreach ($housekeeping as $house)
                                      <input id="{{$house->name}}" name="housekeeping[]" type="checkbox" value="{{$house->skill_id}}">
                                     <tag>{{$house->name}}</tag>
                                     @endforeach
                                </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade in" id="tab2">
                          <h3>Construction</h3>
                            <ul class="input-list">
                                 <li class="setup-skills">
                                <div class="pure-checkbox">
                                    <tag for="construction[]"></tag>
                                     @foreach ($construction as $cons)
                                    <input id="{{$cons->name}}" name="construction[]" type="checkbox" value="{{$cons->skill_id}}">
                                    <tag>{{$cons->name}}</tag>
                                    @endforeach
                                </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade in" id="tab3">
                          <h3>Personel</h3>
                              <ul class="input-list">
                                                         <li class="setup-skills">
                                                        <div class="pure-checkbox">
                                                          @foreach ($personel as $per)
                                                               <input id="{{$per->name}}" name="personel[]" type="checkbox" value="{{$per->skill_id}}">
                                                            <tag>{{$per->name}}</tag>
                                                     @endforeach
                                                        </div>
                                                        </li>
                                                    </ul>
                        </div>
                         <div class="tab-pane fade in" id="tab4">
                          <h3>Maintenance</h3>
                            <ul class="input-list">
                                 <li class="setup-skills">
                                <div class="pure-checkbox">
                                  @foreach ($maintenance as $main)
                                    <input id="{{$main->name}}" value="{{$main->skill_id}}" name="maintenance[]" type="checkbox">
                                    <tag>{{$main->name}}</tag>
                                 @endforeach
                                </div>
                                </li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    </div>
                    </div>
  
                               </div>
                            </div>
                         </div>
                        <ul class="list-inline ">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>Location</h3>
                        <p>locate your address</p>
                         <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                        <input id="clat" type="text" name="clat">
                        <input id="clong" type="text" name="clong">
                        <div id="map"></div>

 
                        <hr>
                        <ul class="list-inline ">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Next Step</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Setup Payment Option</h3>
                        <p>Fill in your credentials.</p>
                        <hr>
                        <div class="col-sm-4 col-sm-offset-2">
                            <div class="form-group">
                                 <p>Account Number</p>
                                 <div id="divdegree">
                                    <input type="text" name="account" id="account">
                                 </div>
                            </div>
                         </div>
                         <div class="col-sm-4 col-sm-offset-1">
                            <div class="form-group">
                                 <p>Key</p>
                                 <div id="divdegree">
                                    <input type="text" name="key" id="key">
                                 </div>
                            </div>
                         </div>
                         <hr>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </section>
   </div>
</div>
@stop
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places"></script>
   <script>
   $(document).ready(function(){
    initAutocomplete();
   });
      function initAutocomplete() {
        var lat= 10.355181;
        var long = 123.844222;
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: lat, lng: long},
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

     google.maps.event.trigger(map, "resize");
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
      
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        google.maps.event.addListener(map, 'click', function (e) {
                 
              var ll = {lat: e.latLng.lat(), lng: e.latLng.lng()}; 

              //alert(e.latLng.lat());  
               markers.forEach(function(marker) {
                          marker.setMap(null);
                });
              
               markers = []; 

               lastMarker = new google.maps.Marker({
                                position: ll,
                                map: map,
                                title: 'Hello World!'
                            });
                markers.push(lastMarker);

                getAddressByLatlng(ll);

         });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });


 // $('a[href="#step3"]').on('shown.bs.tab', function() {
 //    });
      }

    </script>

    <script type="text/javascript">

      function getAddressByLatlng(latlng){
             
                var lat =latlng.lat;
                var lng =latlng.lng;
        
                var inputSearchBox = document.getElementById('pac-input');

                var cLatValId = document.getElementById('clat');
                var cLongValId = document.getElementById('clong');

                cLatValId.value=lat;
                cLongValId.value=lng;

                var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                             if (status == google.maps.GeocoderStatus.OK) {
                                if (results[1]) {
                                    inputSearchBox.value =  results[1].formatted_address;
                                }
                            }
                 });

              }

    </script>

   <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;

      function initMap() {
       
        var lat= 10.355181;
        var long = 123.844222;
        var pyrmont = {lat: lat, lng: long};
        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 10,
          width: '500px',
        height: '500px',
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius: 200,
          type: ['store']
        }, callback);
      }

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
    </script>
    

<script>

    var ctrdegree = 0;
    var ctryear = 0;
    var ctrschool = 0;
   
    function addEducation(divschool,divstartyear,divendyear){
              
              var start = document.createElement('div');
              var end = document.createElement('div');
              var schools = document.createElement('div');
             
              start.innerHTML = "<br><input type='text' name='yearstart[]' value=''>";
              end.innerHTML = "<br><input type='text' name='yearend[]' value=''>";
              schools.innerHTML ="<br><input type='text' name='school[]'value=''>";
             
              ctrschool++;
              ctrstart++;
              ctrend++;

              document.getElementById(divstartyear).appendChild(start);
              document.getElementById(divendyear).appendChild(end);
              document.getElementById(divschool).appendChild(schools);
             
              document.getElementById(divstartyear).value++;
              document.getElementById(divendyear).value++;
              document.getElementById(divschool).value++;

    }

   // var ctrwork =0;
   // var ctryears =0;
   // var ctremployer= 0;

   //     function addWork(divwork,divyears,divemployer){
              
   //            var work = document.createElement('div');
   //            var years = document.createElement('div');
   //            var employer = document.createElement('div');
           
   //            work.innerHTML = "<br><input type='text' name='work[]'value=''>";
   //            years.innerHTML ="<br><input type='text' name='years[]'value=''>";
   //            employer.innerHTML ="<br><input type='text' name='employer[]'value=''>";
   //             ctrwork++;
   //              ctryears++;
   //              ctremployer++;

   //            document.getElementById(divwork).appendChild(work);
   //            document.getElementById(divyears).appendChild(years);
   //            document.getElementById(divemployer).appendChild(employer);
   //            document.getElementById(divyear).value++;
   //            document.getElementById(divschool).value++;
   //            document.getElementById(divdegree).value++;
   //  }

</script>
