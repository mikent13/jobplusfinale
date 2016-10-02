
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jp.css" rel="stylesheet">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>      
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    
   	<title>JobPlus</title>

   	<!-- STEPS-->
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
        });
    </script>
    <!-- END OF STEPS-->

    <script type="text/javascript">
    $(document).ready(function(){
        $("button[type='button']").click(function(){
        	var radioValue = $("button[name='paytype_id']:checked").val();
        });
    });
    </script>

    <!-- DISPLAY VALUES-->
    <script type="text/JavaScript">
        function showMessage(){
            var title = document.getElementById("title").value;
            var description = document.getElementById("description").value;
            var start_date = document.getElementById("start").value;
            var end_date = document.getElementById("end").value;
            var slot = document.getElementById("slot").value;
            var salary = document.getElementById("salary").value;

			display_title.innerHTML= title;
            display_description.innerHTML= description;
            display_startDate.innerHTML= start_date;
            display_endDate.innerHTML= end_date;
            display_slot.innerHTML= slot;
            display_salary.innerHTML= salary;
        }
    </script>
    <!-- END OF DISPLAY VALUES-->
    
  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
    	  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <div class="navbar-brand navbar-brand-centered">Job+</div>
		    </div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="navbar-brand-centered">
		      <ul class="nav navbar-nav navbar-right">
		        <li>  <a class="sub-nav noti" href="#"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
		        <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }}<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a  href="{{route('emp/dashboard')}}">Job+ Schedule</a><li>
                    <li><a href="#">Job+ Wallet</a></li>
                    <li><a href="#">Bookmarks</a></li>
                    <li><a href="#">Log</a></li>
                    <li class="divider"></li>
                    <li><a href="{{url('/logout')}}">Sign out</a></li>
                  </ul>
                </li>		        
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		<!---End of Nav -->

		<div class="row">
		<div class="container">
			<div class="col-md-3 outer-search-box">
				<div class="search-box">
				<form id="search">
						<input type="text" class="form-control" id="search" placeholder="Search Job"/>
				</form>
				<div class="search-result">
					<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Labandera</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section> 
					<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Carpentero</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section> 
						<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Yaya</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section>
					<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Cook</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section>
					<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Baby Sitter</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section>
				</div>
				</div>
			</div>


			<div class="col-md-9 content">
				<div class="panel panel-default">
				 <div class="panel-heading"><h3>Post a job</h3></div>
				  <div class="panel-body">
				    <div class="row">
				    <div class="result-header">				    
				    
				    <div class="col-md-3">
				  	 	<button type="button" class="btn btn-cat"  name="category" id="category_id" value="1" data-toggle="modal" data-target="#myModal">
				  	 	<img src="/img/lady.png" class="pull-left result-pic" >
				  	 	</button>
				  	 </div>
				  	   <div class="col-md-3">
				  	 	<button type="button" class="btn btn-cat"  name="category" id="category_id" value="2" data-toggle="modal" data-target="#myModal">
				  	 	<img src="/img/construction.png" class=" pull-left result-pic" >
				  	 	</button>
				  	 </div>
				  	   <div class="col-md-3">
				  	 	<button type="button" class="btn btn-cat"  name="category" id="category_id" value="3" data-toggle="modal" data-target="#myModal">
				  	 	<img src="/img/businessman.png" class="pull-left result-pic">
				  	 	</button>
				  	 </div>
				  	   <div class="col-md-3">
				  	 	<button type="button" class="btn btn-cat"  name="category" id="category_id" value="4" data-toggle="modal" data-target="#myModal">
				  	 	<img src="/img/maintenance.png" class="pull-left result-pic">
				  	 	</button>
				  	 </div>

				  	 <!-- MODAL -->
				  	<div id="myModal" class="modal fade" role="dialog">
  					<div class="modal-dialog">
  						 <!-- Modal content-->
				      	<div class="modal-content">
						    <div class="modal-header">
						         <button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 class="modal-title">Housekeeping</h3>
							</div>


						<div class="modal-body">
							<div class="row">
								<section>
									<div class="wizard">
									<div class="wizard-inner">
									<div class="connecting-line"></div>
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
													<span class="round-tab">
														<i class="glyphicon glyphicon-folder-open"></i>
													</span>
												</a>
											</li>
											<li role="presentation" class="disabled">
												<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
													<span class="round-tab">
														<i class="glyphicon glyphicon-map-marker"></i>
													</span>
												</a>
											</li>
											<li role="presentation" class="disabled">
												<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
													<span class="round-tab">
														<i class="glyphicon glyphicon-usd"></i>
													</span>
												</a>
											</li>				                    
											<li role="presentation" class="disabled">
												<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
													<span class="round-tab">
														<i class="glyphicon glyphicon-ok"></i>
													</span>
												</a>
											</li>
										</ul>
									</div>

								<form method="POST" action="{{url('job/store')}}">
								{{ csrf_field() }}
								<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
									<div class="tab-content">

										<!-- STEP 1 -->
										<div class="tab-pane active" role="tabpanel" id="step1">
											<h3>Step 1: Basic Information</h3>
											<div class="box">
											<div class="box-title"><h4>JOB INFO</h4></div>
											<div class="form-group"><br>
											    <label for="title">Title:</label>
											    <input type="text" name="title" id="title" class="form-control">
											</div>
											<div class="form-group">
											    <label for="description">Description:</label>
											    <input type="text" name="description" id="description" class="form-control">
											</div>
												
											</div><br><br>
											<div class="box">
											<div class="box-title"><h4>DATE AND TIME</h4></div>
											<div class="form-group"><br>
											    <label for="title">Start date:</label>
											    <input type="date" name="start" id="start_date">
											    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											    <label for="title">End date:</label>
											    <input type="date" name="end" id="end_date">
											</div>
											<!-- <div class="form-group"><br>
											    <label for="start_time">Start time:</label>
											    <input type="time" name="start_time">
											    <label for="end_time">End time:</label>
											    <input type="time" name="end_time">
											</div> -->
																						
											</div><br><br>

											
											<div class="btn-next">
												<button type="button" class="btn btn-primary next-step">Next</button>
											</div>
										</div>
										<!-- END OF STEP 1 -->

										<!-- STEP 2 -->
										<div class="tab-pane" role="tabpanel" id="step2">
											<h3>Step 2: Location</h3>
											    <div class="form-group has-feedback">
										     		<label for="search" class="sr-only">Search</label>
										     		<input type="text" class="form-control" name="search" id="search" placeholder="search">
										            <span class="glyphicon glyphicon-search form-control-feedback"></span>
										     	</div>

										    <!-- GOOGLE MAPS -->
											<div id="map"></div>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
        var lat= 10.355181;
        var long = 123.844222;
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: lat, lng: long},
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP

        });
        // Trigger map resize when tab is shown
             google.maps.event.trigger(map, "resize");
        
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      
        

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
                                   // myHomeLocText.value =  results[1].formatted_address;
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places&callback=initAutocomplete" async defer>
    	
    </script><!-- END OF GOOGLE MAPS-->
											<ul class="list-inline pull-right">
												<li><button type="button" class="btn btn-default prev-step">Previous</button></li>
												<li><button type="button" class="btn btn-primary next-step">Next</button></li>
											</ul>
										</div>
										<!-- END OF STEP 2 -->
										<!-- STEP 3 -->
										<div class="tab-pane" role="tabpanel" id="step3">
											<h3>Step 3: Payment</h3>
											<div class="box">
											<div class="box-title"><h4>ALLOCATION</h4></div>
											<div class="form-group"><br>
											    <label for="slot"># of slot:</label>
											    <input type="text" name="slot" id="slot" class="form-control">
											</div>
											</div><br><br>
											<div class="box">
											<div class="box-title"><h4>SALARY</h4></div>
											<center>
											<div class="form-group"><br>
											    <label class="radio-inline"><input type="radio" name="paytype_id" value="hourly" checked="checked">Hourly</label>
												<label class="radio-inline"><input type="radio" name="paytype_id" value="daily">Daily</label>
												<label class="radio-inline"><input type="radio" name="paytype_id" value="project">Project</label>
											</div>
											</center>
											<div class="form-group">
											<label for="salary">salary:</label>
											<input type="text" name="salary" id="salary" class="form-control">
											</div>
											</div></center><br><br>

											<div class="box">
											<div class="box-title"><h4>TOTAL AMOUNT</h4></div>
											<center>
												<h1><input type="text" id="amount"></h1>
											</center>
											</div><br><br>



											<ul class="list-inline pull-right">
												<li><button type="button" class="btn btn-default prev-step">Previous</button></li>
												<li><button type="button" onclick="showMessage()" class="btn btn-primary next-step">Next</button></li>
											</ul>
										</div>
										<!-- END OF STEP 3 -->

										<div class="tab-pane" role="tabpanel" id="complete">
											<center><h3>Complete Details</h3></center><br>
											<div class="display">
											<p><label>Title:</label>&nbsp;<span id="display_title"></span></p>
											<p><label>Description:</label>&nbsp;<span id="display_description"></span></p>
											<p><label>Start date:</label>&nbsp;<span id="display_startDate"></span></p>
											<p><label>End date:</label>&nbsp;<span id="display_endDate"></span></p>
											<p><label>Slot:</label>&nbsp;<span id="display_slot"></span></p>
											<!-- <p><label>Paytype ID:</label>&nbsp;<span id="display_paytypeId"></span></p> -->
											<p><label>Salary:</label>&nbsp;<span id="display_salary">.00</span></p>
											</div>
											<ul class="list-inline pull-right">
												<li><input type="submit" name="submit" value="Submit" class="btn btn-primary"></input></li>
											</ul>
										</div>
										<div class="clearfix"></div>
										 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
									</div>
								</form>
								</div>
								</section>
							</div>
							</div>
				      	</div>
				    	</div>
				  </div>				  
				</div>
				  	 	<!--  <div class="col-md-3">
					  	 	<img src="../images/businessman.png" class="img-rounded pull-left result-pic" name="category" id="category_id" value="2">					  	 	
					  	 </div>

					  	 <div class="col-md-3">
					  	 	<img src="../images/construction.png" class="img-rounded pull-left result-pic" name="category" id="category_id" value="3" alt="Rounded Image">					  	 	
					  	 </div>

					  	 <div class="col-md-3">
					  	 	<img src="../images/maintenance.png" class="img-rounded pull-left result-pic" name="category" id="category_id" value="4" alt="Rounded Image">					  	 	
					  	 </div> -->
				  </div>
				  </div>
				  
				 <!--  <div class="row">
				  	<div class="divider2"></div>
				  </div>
				  </div> -->
				 
				  <div class="col-md-12 content-feed">
				  	<div class="panel panel-default">
				  	<div class="panel-heading"><h3>Feed</h3></div>
				  	<div class="panel-body">

				  		<!-- LABANDERA -->
						  <div class="col-md-12">
						  	<div class="box">
							 	 <div class="box-title"><h4>Labandera</h4></div>
							 	 <p><b>Description:</b> Nunc mauris nisl, rhoncus eget augue sed, iaculis imperdiet erat?<br/>
							 	 <b>Schedule:</b> Monday-Wednesday<br/>
							 	 <b>Time:</b> 8:00AM-9:00AM
							 	 </p>
								<hr>
							</div>
						  </div> 
						  <!-- END OF LABANDERA -->

						  <!-- DRIVER -->
						  <div class="col-md-12">
						  	<div class="box">
							 	 <div class="box-title"><h4>Driver</h4></div>
							 	 <p><b>Description:</b> Nunc mauris nisl, rhoncus eget augue sed, iaculis imperdiet erat?<br/>
							 	 <b>Schedule:</b> Monday-Wednesday<br/>
							 	 <b>Time:</b> 8:00AM-9:00AM
							 	 </p>
								<hr>
							</div>
						  </div>
						  <!-- DRIVER -->

						  <!-- SALESLADY -->
						  <div class="col-md-12">
						  	<div class="box">
							 	 <div class="box-title"><h4>Saleslady</h4></div>
							 	 <p><b>Description:</b> Nunc mauris nisl, rhoncus eget augue sed, iaculis imperdiet erat?<br/>
							 	 <b>Schedule:</b> Monday-Wednesday<br/>
							 	 <b>Time:</b> 8:00AM-9:00AM
							 	 </p>
								<hr>
							</div>
						  </div>
						  <!-- SALESLADY -->
				   	</div>
				   	</div>
				</div>

	<script type="text/javascript" src="jquery.gmap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
			<script type="text/javascript">
				
			    //Initialize tooltips
			    $('.nav-tabs > li a[title]').tooltip();
			    
			    //Wizard
			    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

			        var $target = $(e.target);
			    
			        if ($target.parent().hasClass('disabled')) {
			            return false;
			        }
			    });

			    $(".next-step").click(function (e) {

			        var $active = $('.wizard .nav-tabs li.active');
			        $active.next().removeClass('disabled');
			        nextTab($active);

			    });
			    $(".prev-step").click(function (e) {

			        var $active = $('.wizard .nav-tabs li.active');
			        prevTab($active);

			    });
			};

			function nextTab(elem) {
			    $(elem).next().find('a[data-toggle="tab"]').click();
			}
			function prevTab(elem) {
			    $(elem).prev().find('a[data-toggle="tab"]').click();
			}
			</script>
  </body>
</html>