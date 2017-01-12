

$(document).ready(function(){

  $(document).on('change','#act-actions',function(){
    var val = $('#act-actions option:selected').val();
    if(val == 2){
      $('#actResched-Modal').modal('show');
      $('#active-datepicker1').datetimepicker({
        inline: true,
        sideBySide: true
      });
      $('#active-datepicker2').datetimepicker({
        inline: true,
        sideBySide: true
      });
    }
  });

  $(document).on('click','#btn-next',function(){
    $('#resched-end').click();

  });

  $(document).on('click','#btn-active-resched',function(){
    var start = $('#active-datepicker1').data('date');
    var end = $('#active-datepicker2').data('date');
    var workid = $('#act-workid').text();

    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var resched = $.ajax({
    url: '/get/dash/resched',
    method: 'GET',
    data:{
      'start': start,
      'end' : end,
      'workid' : workid
    }
  });

  resched.done(function(data){
    console.log(data);
  });

  });

  $(document).on('click','#btn-prev',function(){
    $('#resched-start').click();
  });

  $('.active-body').attr('hidden',true);
  initializeMap();
  activeJob();
  upcomingJob();
  loadEnd();
});
// upcomingJob();
// $('#late').hide();
var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};
function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
};

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
  });

  active.done(function(data){
    console.log(data);
    if(data.active == 1 || data.status == 1){

      $('#active-p').attr('hidden',true);
      $('#actitle').text(data.job.title);
      $('#actemp').text('Hired by '+data.employer.fname + ' '+ data.employer.lname);
      $('#actdesc').text(data.job.description);
      $('#modalemp').text(data.employer.fname + ' '+ data.employer.lname +'?');
      $('#empid').text(data.employer.user_id);
      $('#act-workid').text(data.work.work_id);
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

      if(data.started == 1){
        $('#actstart').fadeOut(1000);
        $('#actend').fadeIn(1200);
        $('#actend').removeClass('hidden');
        $('#head-min').text(end.fromNow(true));
        $('#head-meta').text('until session ends');
      }
      else{
       $('#head-min').text(start.fromNow(true));
       $('#head-meta').text('until job starts');
     }

     $('#emp-pic').attr('src',data.employer.avatar);
     
     $('#startDay').text(startDay1 + ', '+startMonth + '. '+startDay2 + ' '+startYear);
     $('#startTime').text(startTime);
     $('#endDay').text(endDay1 + ', '+endMonth + '. '+endDay2 + ' '+endYear);
     $('#endTime').text(endTime);

     $('#actsal').text('PHP '+data.job.salary);
     $('#actstart').attr('workid',data.work.work_id);


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

     var options = {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0
    };

    function success(pos) {
      var crd = pos.coords;

      console.log('Your current position is:');
      console.log('Latitude : ' + crd.latitude);
      console.log('Longitude: ' + crd.longitude);
      console.log('More or less ' + crd.accuracy + ' meters.');
    };

    function error(err) {
      console.warn('ERROR(' + err.code + '): ' + err.message);
    };

    navigator.geolocation.getCurrentPosition(success, error, options);

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position){
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

      $('.active-body').attr('hidden',false);

            // if(data.work.is_start == 1){
            //   $('#act-endbtn').attr('disabled',false);
            //   $('#act-startbtn').attr('disabled',true);
            // }
            // else
            // {

            // }

          }
          else if(data.status == 0 || data.active == 0){
            $('#active-p').attr('hidden',false);
            $('.active-body').attr('hidden',true);
          }

        });
}

// function ongoingJob(){
//   $('#ongoing-active').attr('hidden',true);
//    $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });

//   var ongoing = $.ajax({
//           url: '/app/ongoingJob',
//           method: 'GET'
//         });

//         ongoing.done(function(data){
//           console.log(data);
//           if(data.status == 1){
//              // $('#ongoing-active').attr('hidden',false);
//             // $('#ongoing-noactive').attr('hidden',true);

//             // $('#actitle').text(data.job.title);
//             // $('#actdesc').text(data.job.description);
//             // $('#actsched').text(data.sched.start + ' until ' + data.sched.end);
//             // $('#actworkid').text(data.work.work_id).attr('hidden',true);
//             // $('#actschedid').text(data.sched.schedule_id).attr('hidden',true);
//             // $('#actemployer').text(data.job.user_id).attr('hidden',true);
//           }
//           else{
//              // $('#ongoing-noactive').attr('hidden',false);
//             // $('#ongoing-active').attr('hidden',true);
//           }
//           if(data.status== 0){
//             alert('none');
//           }
//         });
// }

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
  var schedids = [];
  upcoming.done(function(data){
    console.log(data);
    if(data.status == 0){
      $('#upcoming-p').attr('hidden',false);
    }
    else{
     $('#upcoming-p').attr('hidden',true);

     for(i=0; i<data.sched.length; i++){
      for(x=0; x<data.work.length;x++){
        if(data.sched[i].schedule_id == data.work[x].sched_id){
          for(y=0; y<data.job.length; y++){
            if(data.sched[i].job_id == data.job[y].job_id){
              for(z=0; z<data.profile.length; z++){
                if(data.job[y].user_id == data.profile[z].user_id){
                  if(schedids.indexOf(data.sched[i].schedule_id) < 0){
                    schedids.push(data.sched[i].schedule_id);
                    console.log(schedids);
                    var start = moment(data.sched[i].start);
                    var end = moment(data.sched[i].end);

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

                    $('#upcoming-timeline').append($('<li>').addClass('timeline-inverted')
                      .append($('<div>').addClass('timeline-badge danger'))
                      .append($('<div>').addClass('timeline-panel')
                        .append($('<div>').addClass('timeline-heading')
                          .append($('<div>').addClass('row')
                            .append($('<div>').addClass('col-md-12')
                              .append($('<div>').addClass('timeline-heading')
                                .append($('<h1>').text(data.job[y].title))
                                .append($('<p>').text('by ' + data.profile[z].fname + ' '+data.profile[z].lname))
                                .append($('<div>').addClass('uphead-button pull-right')
                                 .append($('<button>').addClass('btn btn-md btn-bookmark btn-seemore').text('See More').attr({workid:''+data.work[x].work_id,schedid:''+data.sched[i].schedule_id}))))
                              .append($('<div>').addClass('timeline-body')
                                .append($('<div>').addClass('jtitle')
                                  .append($('<p>').text(data.job[y].description))))
                              .append($('<div>').addClass('row upcontents')
                                .append($('<div>').addClass('col-md-6')
                                  .append($('<div>').addClass('sched')
                                    .append($('<p>').text(startDay1 + ', '+startMonth + '. '+startDay2 + ' '+startYear))
                                    .append($('<h1>').text(startTime))
                                    .append($('<p>').text('Starts at')))
                                  .append($('<div>').addClass('sched head-center')
                                    .append($('<h1>')
                                      .append($('<i>').addClass('fa fa-long-arrow-right').attr('aria-hidden','true'))))
                                  .append($('<div>').addClass('sched')
                                    .append($('<p>').text(endDay1 + ', '+endMonth + '. '+endDay2 + ' '+endYear))
                                    .append($('<h1>').text(endTime))
                                    .append($('<p>').text('Ends at'))))
                                .append($('<div>').addClass('col-md-3 cont-col')
                                  .append($('<div>').addClass('head-time')
                                    .append($('<h1>').text(start.fromNow(true)))
                                    .append($('<p>').text('From now'))))
                                .append($('<div>').addClass('col-md-3 cont-col')
                                  .append($('<div>').addClass('head-time')
                                    .append($('<h1>').text('PHP '+data.job[y].salary))
                                    .append($('<p>').text('You will receive'))))

                                ))))))
                  }
                }
              }
            }
          }
        }
      }
    }
  }
});
} //End of Upcoming Job

var actmap;
var geolocations;
var modalmap;
var markers = [];
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

      modalmap = new google.maps.Map(document.getElementById('modalgmap'), {
        center: {lat: geolocations.lat, lng: geolocations.lng},
        zoom: 18
      });

    })};

  }

  function loadEnd(){
   $("#loading").fadeOut(300);
 }

 $(document).on('click','#act-endbtn',function(e){
  if($('#act-endbtn').is('[disabled]')){

  }
  else{
    $('#endModal').modal('show');
  };

});


 $(document).on('click','.btn-seemore',function(){
  var workid = this.getAttribute('workid');
  var schedid = this.getAttribute('schedid');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var seemore = $.ajax({
    url: '/app/dashboard/seemore',
    method: 'GET',
    data: {
      'workid' : workid,
      'schedid' : schedid
    }
  });

  seemore.done(function(data){
    console.log(data);
    $('#modal-title').text(data.job.title);
    $('#modal-emp').text('by '+data.profile.fname + ' '+data.profile.lname);
    $('#modal-desc').text(data.job.description);
    $('#modal-sal').text(data.job.salary);
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

    $('#modal-startDay').text(startDay1 + ', '+startMonth + '. '+startDay2 + ' '+startYear);
    $('#modal-startTime').text(startTime);
    $('#modal-endDay').text(endDay1 + ', '+endMonth + '. '+endDay2 + ' '+endYear);
    $('#modal-endTime').text(endTime);
    $('#modal-fromnow').text(start.fromNow(true));

    var meo = [];
    var locs;
    var centers = { lat: parseFloat(data.address.lat), lng: parseFloat(data.address.lng) };
    meo.push(centers);
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': meo[0] }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        locs = results[0].formatted_address;
        $('#modal-address').text(locs);
      }
    });

    function setMapOnAll(map){
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }
    setMapOnAll(null);
    var marker = new google.maps.Marker({
      map: modalmap,
      position: meo[0],
      title: 'Hello World!'
    });

    $('#modalgmap').attr('hidden',false);
    setTimeout(google.maps.event.trigger(modalmap, 'resize'),300);
    modalmap.setCenter(centers);
  });

  $('#seeMoreModal').modal('show');

});

 $(document).on('click','#actend',function(){
  $('#rateModal').modal('show');
});

 $(document).on('click','#btn-rate',function(){
  var review = $('#review').val();
  var rate = $('#rating-system').val();
  var emp = $('#empid').text();
  var work = $('#act-workid').text();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var endjob = $.ajax({
    url: '/applicant/job/end',
    method: 'GET',
    data: {
      'review' : review,
      'rate' : rate,
      'emp' : emp,
      'work': work
    }
  });

  endjob.done(function(data){
    console.log(data);
    if(data.status == 1){
      $('#rateModal').modal('hide');
      swal("Review sent!", " ", "success");
    }
  });


});

 $(document).on('click','#actstart',function(){
   $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


   var startjob = $.ajax({
    url: '/applicant/job/start',
    method: 'GET',
    data: {
      'workid' : this.getAttribute('workid'),
    }
  });

   startjob.done(function(data){
    console.log(data);
    
    if(data.status == 1){
      swal("Job has started.", "Work Hard!", "info");
      $('#actstart').fadeOut(1000);
      $('#actend').fadeIn(2000);
      $('#actend').removeClass('hidden');
      $('#head-min').text(end.fromNow(true));
      $('#head-meta').text('until session ends');
    }
    else{
      if(data.late == 1){
        swal("Oops.. It looks like you have exceed the 30 mins late allowance, we will deduct the penalty on your salary. ", " ", "warning");
      }
    }
    
  });


 });