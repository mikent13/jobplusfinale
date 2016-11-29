function loadEnd(){
   $("#loading").fadeOut(300);
}

function activeJob(){
$('.actend').attr('hidden',true);
	$.ajaxSetup({
	  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

	var active = $.ajax({
          url: '/app/activeJob',
          method: 'GET',
          complete: loadEnd
        });

        active.done(function(data){
          console.log(data);
          if(data.status == 1){

            $('#actitle').text(data.job.title);
            $('#actemp').text(data.employer.fname + ' '+ data.employer.lname) ;
            $('#actdesc').text(data.job.description);

            var start = moment(data.sched.start);
            var end = moment(data.sched.end);
            
            var startDay1 = start.format('dddd');
            var startMonth = start.format('MMM');
            var startDay2 = start.format('D'); 
            var startYear = start.format('YYYY');
            var startTime = start.format('LT');

            var endDay1 = end.format('dddd');
            var endMonth = end.format('MMM');
            var endDay2 = end.format('D'); 
            var endYear = end.format('YYYY');
            var endTime = end.format('LT');

            $('#startDay').text(startDay1 + ', '+startMonth + '. '+startDay2 + ' '+startYear);
            $('#startTime').text(startTime);
            $('#endDay').text(endDay1 + ', '+endMonth + '. '+endDay2 + ' '+endYear);
            $('#endTime').text(endTime);

            $('#actsal').text('$'+data.job.salary);
           var wid = $('#actworkid').val(data.work.work_id).attr('hidden',true);

          var meo = [];
          var locs;
          var centers = { lat: parseFloat(data.address.lat), lng: parseFloat(data.address.lng) };
          meo.push(centers);
          var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'latLng': meo[0] }, function (results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
                locs = results[0].formatted_address;
                $('#actaddress').text(locs);
              }
     });

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocations = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var directionsService = new google.maps.DirectionsService;



    var origin = new google.maps.LatLng(geolocations.lat, geolocations.lng),
    destination = new google.maps.LatLng(data.address.lat, data.address.lng),
    service = new google.maps.DistanceMatrixService();

    $('#actgmap').attr('hidden',false);
        setTimeout(google.maps.event.trigger(actmap, 'resize'),300);
      actmap.setCenter(centers);
      directionsDisplay.setMap(actmap);

      calculateAndDisplayRoute(directionsService, directionsDisplay);

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: origin, 
          destination: destination,  
          travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

service.getDistanceMatrix(
    {
        origins: [origin],
        destinations: [destination],
        travelMode: google.maps.TravelMode.DRIVING,
        avoidHighways: false,
        avoidTolls: false
    }, 
    callback
);

       })};

function callback(response, status) {
 
      console.log(response);
    if(status=="OK") {
        $('#actdistance').text(response.rows[0].elements[0].distance.text);
        $('#acttime').text(response.rows[0].elements[0].duration.text);
    } else {
        alert("Error: " + status);
    }
}

        //      var marker = new google.maps.Marker({
        //   map: actmap,
        //   position: meo[0],
        //   title: 'Hello World!'
        // });
            $('.active-body').attr('hidden',false);
       
         

            if(data.work.is_start == 1){
              $('#act-endbtn').attr('disabled',false);
              $('#act-startbtn').attr('disabled',true);
            }
            else
            {
             
            }
          }
          else
          {
            $('#noactive').attr('hidden',false);
            $('#active').attr('hidden',true);
          }
        });
}

$('#actend').click(function(){
  $('#myModal').modal('show');
});

function ongoingJob(){
  $('#ongoing-active').attr('hidden',true);
	 $.ajaxSetup({
	  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

	var ongoing = $.ajax({
          url: '/app/ongoingJob',
          method: 'GET'
        });

        ongoing.done(function(data){
          console.log(data);
          if(data.status == 1){
          	 $('#ongoing-active').attr('hidden',false);
            $('#ongoing-noactive').attr('hidden',true);

            $('#actitle').text(data.job.title);
            $('#actdesc').text(data.job.description);
            $('#actsched').text(data.sched.start + ' until ' + data.sched.end);
            $('#actworkid').text(data.work.work_id).attr('hidden',true);
            $('#actschedid').text(data.sched.schedule_id).attr('hidden',true);
            $('#actemployer').text(data.job.user_id).attr('hidden',true);
          }
          else{
          	 $('#ongoing-noactive').attr('hidden',false);
            $('#ongoing-active').attr('hidden',true);
          }
          if(data.status== 0){
            alert('none');
          }
        });
}

function upcomingJob(){
  $.ajaxSetup({
	  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

	var upcoming = $.ajax({
          url: '/app/upcomingJob',
          method: 'GET'
        });

        upcoming.done(function(data){
          // console.log(data);
        });
}

var actmap;
var geolocations;
var upmap;
function initializeMap(){
  $('#actgmap').attr('hidden',false);
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocations = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
         
         actmap = new google.maps.Map(document.getElementById('actgmap'), {
          center: {lat: geolocations.lat, lng: geolocations.lng},
          zoom: 18
        });

       })};

        // upmap = new google.maps.Map(document.getElementById('upgmap'), {
        //   center: {lat: geolocations.lat, lng: geolocations.lng},
        //   zoom: 18
        // });
}

$(document).ready(function(){
$($('.active-body').attr('hidden',true));
$($('.timeline').attr('hidden',true));
initializeMap();
activeJob();
// upcomingJob();
// $('#late').hide();
// $('.timeline').append($('<li>').addClass('timeline-inverted')
//                 .append($('<div>').addClass('timeline-badge danger'))
//                   .append($('<div>').addClass('timeline-panel')
//                     .append($('<div>').addClass('timeline-heading')
//                       .append($('<div>').addClass('row')
//                         .append($('<div>').addClass('col-md-12')
//                           .append($('<div>').addClass('timeline-heading')
//                             .append($('<h1>').text('Your work as Carpenter'))
//                             .append($('<p>').text('by Kent Michael Baguion'))
//                             .append($('<div>').addClass('uphead-button pull-right')
//                               .append($('<button>').addClass('btn btn-md btn-bookmark').text('See More'))))
//                           .append($('<div>').addClass('timeline-body')
//                             .append($('<div>').addClass('jtitle')
//                               .append($('<p>').text('Nice to meet you soon'))))
//                           .append($('<div>').addClass('row upcontents')
//                             .append($('<div>').addClass('col-md-8')
//                               .append($('<div>').addClass('sched')
//                                 .append($('<p>').text('Friday, Nov.6 2016'))
//                                 .append($('<h1>').text('09:30 am'))
//                                 .append($('<p>').text('Starts at')))
//                               .append($('<div>').addClass('sched head-center')
//                                 .append($('<h1>')
//                                   .append($('<i>').addClass('fa fa-long-arrow-right').attr('aria-hidden','true'))))
//                               .append($('<div>').addClass('sched')
//                                 .append($('<p>').text('Friday, Nov.6 2016'))
//                                 .append($('<h1>').text('10:30 am'))
//                                 .append($('<p>').text('Ends at'))))
//                             .append($('<div>').addClass('col-md-4 cont-col')
//                               .append($('<div>').addClass('head-time')
//                                 .append($('<h1>').text('$50'))
//                                 .append($('<p>').text('You will receive'))))


//                   ))))))


  $(document).on('click','#act-startbtn',function(e){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    if($('#act-startbtn').is('[disabled]')){
      alert("The job has already been started.");
    }
    else{
      var startjob = $.ajax({
          url: '/applicant/job/start',
          method: 'GET',
          data: {
            'workid' : $('#actworkid').text(),
            'schedid' : $('#actschedid').text()
          }
        });

        startjob.done(function(data){
          console.log(data);
          if(data.late == 0){
            alert("you're late.");
          }
          else{
            alert('job has been started.');
          }
        });
    };
    
  });

  $(document).on('click','#act-endbtn',function(e){
      if($('#act-endbtn').is('[disabled]')){
     
    }
    else{
        $('#endModal').modal('show');
    };
    
  });

 $(document).on('click','#rev-endbtn',function(e){
  $('#endModal').modal('hide');

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var endjob = $.ajax({
          url: '/applicant/job/end',
          method: 'GET',
          data: {
            'rating' : $('#rating-system').val(),
            'review' : $('#review').val(),
            'workid': $('#actworkid').text(),
            'reviewed' : $('#actemployer').text()
          }
        });

        endjob.done(function(data){
          console.log(data);
          if(data.status == 1){
            alert('Thank you!, your feedback has been sent!');
          }
        });

  });

});