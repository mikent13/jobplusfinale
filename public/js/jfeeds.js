//----------------------------Initialize Datas------------------------------------//
var feedmap;
var recmap;
var nearmap;
var input;
var searchBox;
var place;
var nearbs;
var markers = [];
var geolocations;
//----------------------------Initialization------------------------------------//
function initializeMap(){
  $('#feed-gmap').attr('hidden',true);
  $('#rec-gmap').attr('hidden',true);
  $('#near-gmap').attr('hidden',true);

  // if (navigator.geolocation) {
  //   navigator.geolocation.getCurrentPosition(function(position) {
    
  //     console.log(geolocations.lat);


  //   });
  // }
  
  var geolocations = {
        lat: 10.315699,
        lng: 123.885437
      };

      var meos = [];
      var locs;
      var centers = { lat:geolocations.lat , lng:geolocations.lng };
      meos.push(centers);
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({ 'latLng': meos[0] }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          var res = results[0].address_components;
          for(var i=0; i<res.length; i++){
            if(res[i].types[0] =="locality"){
             $('#search-loc').val(res[i].long_name);
             nearbs = res[i].long_name;
           }
         }
       }
     });

  feedmap = new google.maps.Map(document.getElementById('feed-gmap'), {
        center:centers,
        zoom: 18
      });

      recmap = new google.maps.Map(document.getElementById('rec-gmap'), {
        center: centers,
        zoom: 18
      });

      nearmap = new google.maps.Map(document.getElementById('near-gmap'), {
        center: centers,
        zoom: 18
      });
  $("#loading").fadeOut(300);
}

function initializeData(){
 
 
 $('#feed-body').attr('hidden',true);
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 var jobdatas = $.ajax({
  url:'/get/jobpagedata',
  method:'GET',
});

 jobdatas.done(function(data){
  console.log(data);
  var index = 0;$

  $.each(data.categories,function(key,val){
   $('#search-sel').append($('<option>').text(val.name).attr('value',val.category_id).addClass('selectoption'))
 });

  $('#search-sel').selectpicker('refresh');

  $('#s-skill').empty();
  $.each(data.skill,function(key,val){
   $('#s-skill').append($('<option>').text(val.name).attr('value',val.skill_id).addClass('selectoption'))
 });
  

  $('#s-skill').selectpicker('refresh');

  $.each(data.paytypes,function(key,value){
    $('#fil-ptype').append($('<option>').text(value.name).attr('value',value.paytype_id).addClass('selectoption'));
  });

  $('#fil-ptype').selectpicker('refresh');

  
  //----------------Job Feeds------------//
  for(i = 0; i< data.jobs.length; i++){
    for(z = 0; z< data.jobadd.length; z++){
      if(data.jobs[i].job_id == data.jobadd[z].jobid){
        for(x = 0; x< data.profile.length; x++){
          if(data.jobs[i].user_id == data.profile[x].user_id){
           $('#jobfeed-res').append($('<a>').addClass('list-group-item item-res').attr('data-val',data.jobs[i].job_id).attr('id','item')
            .append($('<div>').addClass('cont-feeds')
              .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
              .append($('<h4>').addClass('list-group-item-heading ellipsis meta-title').text(data.jobs[i].title))
              .append($('<p>').addClass('list-group-item-text meta meta-employer').text('by '+data.profile[x].fname + ' ' + data.profile[x].lname))
              .append($('<i>').addClass('meta-loc meta-marker fa-1x fa fa-map-marker'))
              .append($('<p>').addClass('list-group-item-text meta meta-loc meta-locality').text(data.jobadd[z].locality))));
         }
       }
     }}
   }
   $('.item-res ').click(function(e) {
    e.preventDefault();
    $('.item-res').removeClass('item-active');
    $(this).addClass('item-active')
  });

   
      //   for(z = 0; z< data.jobadd.length; z++){
      //   if(data.jobs[i].job_id == data.jobadd[z].jobid){
      //     $('#side-res').append($('<p>').addClass('list-group-item-text meta meta-loc').text(data.jobadd[z].locality));
      //   }
      // }
      
  // for(x = 0; x< data.jobskill.length; x++){
  //   if(data.jobs[i].job_id == data.jobskill[x].job_id){
  //     for(z= 0; z< data.skill.length; z++){
  //       if(data.jobskill[x].skill_id == data.skill[z].skill_id){
  //       $('#side-res').append($('<p>').addClass('list-group-item-text meta meta-skill').text(data.skill[z].name));                          
  //      }
  //     }
  //   }
  // }


  //----------------Location------------//

  input = document.getElementById('search-loc');
  var options = {
    types: ['(cities)'],
    componentRestrictions: {country: "ph"}
  };
  
  searchBox = new google.maps.places.Autocomplete(input,options);
  searchBox.addListener('places_changed', function() {
   places = searchBox.getPlaces();
   if (places.length == 0) {
    return;
  }
});
});

};

$(document).ready(function(){

 
  var stickyNavTop = $('.sub-nav').offset().top;
  
  var stickyNav = function(){
    var scrollTop = $(window).scrollTop();
    
    if (scrollTop > stickyNavTop) { 
      $('.sub-nav').addClass('sticky sub-nav-header');
    } else {
      $('.sub-nav').removeClass('sticky'); 
    }
  };
  
  stickyNav();
  
  $(window).scroll(function() {
    stickyNav();
  });
  initializeMap();
  initializeData();


  $('a[href*=#scrolled]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
      || location.hostname == this.hostname) {

      var target = $('#scrolled');
    target = target.length ? target : $('[name=' + '#scrolled'.slice(1) +']');
    if (target.length) {
     $('html,body').animate({
       scrollTop: target.offset().top
     }, 1000);
     return false;
   }
 }
});

  $('.feed-panel').attr('hidden',false);



  
//----------------------------Requests------------------------------------//
function loadStart(){
 $("#loading").fadeIn(200);
 $('#feed-body').attr('hidden',true);

}
function loadEnd(){
  $('#scroll').click();
  $('#loading').fadeOut(200);
}
//--------Job Search  --------//
var loc;
$(document).on('click','#btn-search',function(e){
  e.preventDefault();
  $('#tab-feeds').click();
  var json = $('#s-skill').val();
  var zips = [];
  var geocode = new google.maps.Geocoder();
  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  geocode.geocode({ 'address': $('#search-loc').val() }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      console.log(results);

      var res = results[0].address_components;
      for(var i=0; i<res.length; i++){
        if(res[i].types[0] =="locality"){
         this.loc =  res[i].long_name;
       }
     }
   }
   var search = $.ajax({
    url: '/app/jobsearch',
    method: 'GET',
    beforeSend:loadStart,
    complete:loadEnd,
    data:{
      'cat'  : $('#search-sel option:selected').val(),
      'skill': json,
      'location':this.loc,
      'salary': $('#fil-sal').val(),
      'ptype': $('#fil-ptype').val(),
    },
  });
   search.done(function(data){
    console.log(data);
    $('#jobfeed-res').empty();
    if(data.jobs.length == 0){
      $('.feed-panel').attr('hidden',true);
      $('#result-count').text('Sorry, no results were found. ');  
    }
    else{
      $('.feed-panel').attr('hidden',false);
      $('#result-count').text(data.jobs.length + ' Job(s) found in ' + data.loc);  
    }

    for(i = 0; i< data.jobs.length; i++){
      for(x = 0; x< data.profile.length; x++){
        for(z = 0; z< data.add.length; z++){
          if(data.jobs[i].job_id == data.add[z].jobid){
            console.log(data.jobs[i].title);
            if(data.jobs[i].user_id == data.profile[x].user_id){
              $('#jobfeed-res').append($('<a>').addClass('list-group-item item-res').attr('data-val',data.jobs[i].job_id)
                .append($('<div>').addClass('cont-feeds')
                  .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                  .append($('<h4>').addClass('list-group-item-heading ellipsis meta-title').text(data.jobs[i].title))
                  .append($('<p>').addClass('list-group-item-text meta meta-employer').text('by '+data.profile[x].fname + ' ' + data.profile[x].lname))
                  .append($('<i>').addClass('meta-loc meta-marker fa-1x fa fa-map-marker'))
                  .append($('<p>').addClass('list-group-item-text meta meta-loc meta-locality').text(data.add[z].locality))));
            }
          }
        }
      }
    }

  }); 
 });
});

//-------- Onclick  Tab recommended --------//

$(document).on('click','#tab-recommended',function(e){
  e.preventDefault();
  $('#feed-body').attr('hidden',true);
  $('#rec-body').attr('hidden',true);
  $('.item-res').removeClass('item-active');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var jobids = [];
  var search = $.ajax({
    url: '/get/job/recommended',
    method: 'GET',
  });

  search.done(function(data){
    console.log(data);
    $('#recommended-res').empty();

    for(i = 0; i< data.jobs.length; i++){
      for(z = 0; z< data.add.length; z++){
        if(data.jobs[i].job_id == data.add[z].jobid){
          for(y = 0; y< data.jobskills.length; y++){
            if(data.jobs[i].job_id == data.jobskills[y].job_id){
              for(x = 0; x< data.profile.length; x++){
                if(data.jobs[i].user_id == data.profile[x].user_id){
                  
                  if(jobids.indexOf(data.jobs[i].job_id) < 0){
                    jobids.push(data.jobs[i].job_id);
                    console.log(jobids);
                    $('#recommended-res').append($('<a>').addClass('list-group-item recom-res').attr('data-val',data.jobs[i].job_id)
                      .append($('<div>').addClass('cont-feeds')
                        .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                        .append($('<h4>').addClass('list-group-item-heading ellipsis meta-title').text(data.jobs[i].title))
                        .append($('<p>').addClass('list-group-item-text meta meta-employer').text('by '+data.profile[x].fname + ' ' + data.profile[x].lname))
                        .append($('<i>').addClass('meta-loc meta-marker fa-1x fa fa-map-marker'))
                        .append($('<p>').addClass('list-group-item-text meta meta-loc meta-locality').text(data.add[z].locality))));
                  }
                }
              }
            }
          }
        } 
      }
    }

    $('.recom-res ').click(function(e) {
      e.preventDefault();
      $('.recom-res').removeClass('item-active');
      $(this).addClass('item-active')
    });
  });

});

//--------Job Onclick  --------//
$(document).on('click','.recom-res',function(e){
 $('#feed-body').attr('hidden',true);
 e.preventDefault();
 $('#rec-result-sched').empty();
 $('#rec-result-skill').empty();
 $('#rec-body').attr('hidden',false);
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 var request = $.ajax({
  url:'/get/job',
  method:'GET',
  data:{
    'jobid': $(this).data('val'),
  }
});

 request.done(function(data){
  console.log(data);
  var meos = [];
  var locs;
  var centers = { lat: parseFloat(data.address.lat), lng: parseFloat(data.address.lng) };
  meos.push(centers);
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'latLng': meos[0] }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      locs = results[0].formatted_address;
      $('#rec-result-add').text(locs);
    }
    $('#rec-res-jobid').text(data.job.job_id).attr('hidden',true);
    $('#rec-result-title').text("(" +data.job.job_id + ") "+ data.job.title);
    for(i = 0; i<data.sched.length; i++){
      $('#rec-result-sched').append($('<li>')
        .append($('<p>').text(data.sched[i].start + " until " + data.sched[i].end)));
    }
    for(i = 0; i<data.skill.length; i++){
      $('#rec-result-skill').append($('<p>').text(data.skill[i].name).addClass('mini-skill'));
    }
    $('#rec-desc').text(data.job.description);
    $('.meta-sal').text('$' + data.job.salary);
    $('.meta-slot').text(data.job.slot);
    $('.meta-ptype').text(data.paytype.name);

  });

  var marker = new google.maps.Marker({
    map: recmap,
    position: meos[0],
    title: 'Hello World!'
  });
  
  $('#rec-gmap').attr('hidden',false);
  setTimeout(google.maps.event.trigger(recmap, 'resize'),300);
  recmap.setCenter(centers);
  var dateposted = moment(data.job.date_posted);
  $('#postedago').text('Posted ' +dateposted.fromNow());
  $('.sched-start').empty();
  $('.sched-end').empty();
  $('.sched-start').append($('<h3>').text('From'));
  $('.sched-end').append($('<h3>').text('Until'));
  for(i=0; i<data.sched.length; i++){
    var start = moment(data.sched[i].start).format('MMMM Do YYYY, h:mm a');
    var end = moment(data.sched[i].end).format('MMMM Do YYYY, h:mm a');
    $('.sched-start').append($('<p>').text(start));
    $('.sched-end').append($('<p>').text(end));
  }

  $('#rec-t').text(data.job.title);
  $('#rec-p').text('by ' +data.user.fname + ' ' + data.user.lname);

});
});


$(document).on('click','#tab-feeds',function(e){
 e.preventDefault();
 $('#rec-body').attr('hidden',true);
 $('#feed-body').attr('hidden',true);
 $('.feed-panel').attr('hidden',false);

});

//--------Job Onclick  --------//
$(document).on('click','.item-res',function(e){
 e.preventDefault();
 $('#feed-result-sched').empty();
 $('#feed-result-skill').empty();
 $('#feed-body').attr('hidden',false);
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 var request = $.ajax({
  url:'/get/job',
  method:'GET',
  data:{
    'jobid': $(this).data('val'),
  }
});

 request.done(function(data){
  console.log(data);
  var meo = [];
  var locs;
  var centers = { lat: parseFloat(data.address.lat), lng: parseFloat(data.address.lng) };
  meo.push(centers);
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'latLng': meo[0] }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      locs = results[0].formatted_address;
      $('#feed-result-add').text(locs);
    }
    $('#feed-res-jobid').text(data.job.job_id).attr('hidden',true);
    $('#feed-result-title').text("(" +data.job.job_id + ") "+ data.job.title);
    for(i = 0; i<data.sched.length; i++){
      $('#feed-result-sched').append($('<li>')
        .append($('<p>').text(data.sched[i].start + " until " + data.sched[i].end)));
    }
    for(i = 0; i<data.skill.length; i++){
      $('#feed-result-skill').append($('<p>').text(data.skill[i].name).addClass('mini-skill'));
    }
    $('#feed-desc').text(data.job.description);
    $('.meta-sal').text('$' + data.job.salary);
    $('.meta-slot').text(data.job.slot);
    $('.meta-ptype').text(data.paytype.name);

  });

  var marker = new google.maps.Marker({
    map: feedmap,
    position: meo[0],
    title: 'Hello World!'
  });
  
  $('#feed-gmap').attr('hidden',false);
  setTimeout(google.maps.event.trigger(feedmap, 'resize'),300);
  feedmap.setCenter(centers);

  var dateposted = moment(data.job.date_posted);
  $('#postedago').text('Posted ' +dateposted.fromNow());
  $('.sched-start').empty();
  $('.sched-end').empty();
  $('.sched-start').append($('<h3>').text('From'));
  $('.sched-end').append($('<h3>').text('Until'));
  for(i=0; i<data.sched.length; i++){
    var start = moment(data.sched[i].start).format('MMMM Do YYYY, h:mm a');
    var end = moment(data.sched[i].end).format('MMMM Do YYYY, h:mm a');
    $('.sched-start').append($('<p>').text(start));
    $('.sched-end').append($('<p>').text(end));
  }


      //   $('#result-sched').empty();
      //   $('#key').empty();
      //   $('#res-filtering').empty();  
      //   $('#result-title').text(data.job.title);
      //   $('#result-postby').text(data.user.fname + data.user.lname + dateposted.fromNow());
      //   $('#res-jobid').text(data.job.job_id).attr('hidden',true);
      
      //   $.each(data.sched, function(key,value){
      //   var start = moment(value.start).format('lll');
      //   var end = moment(value.end).format('lll');
      //   $('#result-sched').append('<p>' + start +' - '+ end +'</p>');
      // });

      $('#feed-t').text(data.job.title);
      $('#feed-p').text('by ' +data.user.fname + ' ' + data.user.lname);

    });
}); 

$(document).on('click','#tab-nearby',function(e){
  e.preventDefault();
  $('#near-body').attr('hidden',true);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var jobids = [];
  var search = $.ajax({
    url: '/get/job/nearby',
    method: 'GET',
    data:{
      'loc' :nearbs
    }
  });

  search.done(function(data){
    console.log(data);
    $('#nearby-res').empty();

    for(i = 0; i< data.jobs.length; i++){
      for(z = 0; z< data.add.length; z++){
        if(data.jobs[i].job_id == data.add[z].jobid){
          for(y = 0; y< data.jobskills.length; y++){
            if(data.jobs[i].job_id == data.jobskills[y].job_id){
              for(x = 0; x< data.profile.length; x++){
                if(data.jobs[i].user_id == data.profile[x].user_id){
                  if(jobids.indexOf(data.jobs[i].job_id) < 0){
                    jobids.push(data.jobs[i].job_id);
                    console.log(jobids);
                    $('#nearby-res').append($('<a>').addClass('list-group-item near-res').attr('data-val',data.jobs[i].job_id)
                      .append($('<div>').addClass('cont-feeds')
                        .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                        .append($('<h4>').addClass('list-group-item-heading ellipsis meta-title').text(data.jobs[i].title))
                        .append($('<p>').addClass('list-group-item-text meta meta-employer').text('by '+data.profile[x].fname + ' ' + data.profile[x].lname))
                        .append($('<i>').addClass('meta-loc meta-marker fa-1x fa fa-map-marker'))
                        .append($('<p>').addClass('list-group-item-text meta meta-loc meta-locality').text(data.add[z].locality))));
                  }
                }
              }
            }
          }
        } 
      }
    }
  });

});
$(document).on('click','.near-res',function(e){
 $('#near-body').attr('hidden',true);
 e.preventDefault();
 $('#near-result-sched').empty();
 $('#near-result-skill').empty();
 $('#near-body').attr('hidden',false);
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 var request = $.ajax({
  url:'/get/job',
  method:'GET',
  data:{
    'jobid': $(this).data('val'),
  }
});

 request.done(function(data){
  console.log(data);
  var meos = [];
  var locs;
  var centers = { lat: parseFloat(data.address.lat), lng: parseFloat(data.address.lng) };
  meos.push(centers);
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'latLng': meos[0] }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      locs = results[0].formatted_address;
      $('#near-result-add').text(locs);
    }
    $('#near-res-jobid').text(data.job.job_id).attr('hidden',true);
    $('#near-result-title').text("(" +data.job.job_id + ") "+ data.job.title);
    for(i = 0; i<data.sched.length; i++){
      $('#near-result-sched').append($('<li>')
        .append($('<p>').text(data.sched[i].start + " until " + data.sched[i].end)));
    }
    for(i = 0; i<data.skill.length; i++){
      $('#near-result-skill').append($('<p>').text(data.skill[i].name).addClass('mini-skill'));
    }
    $('#near-desc').text(data.job.description);
    $('.meta-sal').text('PHP ' + data.job.salary);
    $('.meta-slot').text(data.job.slot);
    $('.meta-ptype').text(data.paytype.name);
  });

  var marker = new google.maps.Marker({
    map: nearmap,
    position: meos[0],
    title: 'Hello World!'
  });
  
  $('#near-gmap').attr('hidden',false);
  setTimeout(google.maps.event.trigger(nearmap, 'resize'),300);
  nearmap.setCenter(centers);
  var dateposted = moment(data.job.date_posted);
  $('#postedago').text('Posted ' +dateposted.fromNow());
  $('.sched-start').empty();
  $('.sched-end').empty();
  $('.sched-start').append($('<h3>').text('From'));
  $('.sched-end').append($('<h3>').text('Until'));
  for(i=0; i<data.sched.length; i++){
    var start = moment(data.sched[i].start).format('MMMM Do YYYY, h:mm a');
    var end = moment(data.sched[i].end).format('MMMM Do YYYY, h:mm a');
    $('.sched-start').append($('<p>').text(start));
    $('.sched-end').append($('<p>').text(end));
  }

  $('#near-t').text(data.job.title);
  $('#near-p').text('by ' +data.user.fname + ' ' + data.user.lname);

});
});


function loadAlert(){
  swal("Thank You!", "Application sent!", "success");
}
//-------- Job Application --------//
$(document).on('click','#feed-apply-btn',function(e){
  
 e.preventDefault();

 var jobid = $('#feed-res-jobid').text();
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 var apply = $.ajax({
  url: '/app/apply',
  method: 'GET',
  data:{'jobid':jobid},
});

 apply.done(function(data){
  console.log(data);
  if(data.status == 0){
    var myconfstart = moment(data.myconf.start).format('MMMM Do YYYY, h:mm a');
var myconfend = moment(data.myconf.end).format('MMMM Do YYYY, h:mm a');
var jobconfstart = moment(data.jobconf.start).format('MMMM Do YYYY, h:mm a');
var jobconfend = moment(data.jobconf.end).format('MMMM Do YYYY, h:mm a');
      $('#confjtitle').text(data.myconfjob.title);
      $('#myschedstart').text('Start: ' +myconfstart);
      $('#myschedend').text('End: '+myconfend);
      $('#appliedstart').text('Start: ' +jobconfstart);
      $('#appliedend').text('End: ' +jobconfend);
      $('#conflictModal').modal('show');
  }
  else{
    loadAlert();
  }
 });

});
$(document).on('click','#near-apply-btn',function(e){
  
 e.preventDefault();

 var jobid = $('#near-res-jobid').text();
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 var apply = $.ajax({
  url: '/app/apply',
  method: 'GET',
  data:{'jobid':jobid},
});

 apply.done(function(data){
  console.log(data);
  if(data.status == 0){
    var myconfstart = moment(data.myconf.start).format('MMMM Do YYYY, h:mm a');
var myconfend = moment(data.myconf.end).format('MMMM Do YYYY, h:mm a');
var jobconfstart = moment(data.jobconf.start).format('MMMM Do YYYY, h:mm a');
var jobconfend = moment(data.jobconf.end).format('MMMM Do YYYY, h:mm a');
      $('#confjtitle').text(data.myconfjob.title);
      $('#myschedstart').text('Start: ' +myconfstart);
      $('#myschedend').text('End: '+myconfend);
      $('#appliedstart').text('Start: ' +jobconfstart);
      $('#appliedend').text('End: ' +jobconfend);
      $('#conflictModal').modal('show');
  }
  else{
    loadAlert();
  }
 });

});
$(document).on('click','#rec-apply-btn',function(e){
  
 e.preventDefault();

 var jobid = $('#rec-res-jobid').text();
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
 var apply = $.ajax({
  url: '/app/apply',
  method: 'GET',
  data:{'jobid':jobid},
});
  apply.done(function(data){
  console.log(data);
  if(data.status == 0){
    var myconfstart = moment(data.myconf.start).format('MMMM Do YYYY, h:mm a');
var myconfend = moment(data.myconf.end).format('MMMM Do YYYY, h:mm a');
var jobconfstart = moment(data.jobconf.start).format('MMMM Do YYYY, h:mm a');
var jobconfend = moment(data.jobconf.end).format('MMMM Do YYYY, h:mm a');
      $('#confjtitle').text(data.myconfjob.title);
      $('#myschedstart').text('Start: ' +myconfstart);
      $('#myschedend').text('End: '+myconfend);
      $('#appliedstart').text('Start: ' +jobconfstart);
      $('#appliedend').text('End: ' +jobconfend);
      $('#conflictModal').modal('show');
  }
  else{
    loadAlert();
  }
 });
});

$(document).on('change','#search-sel',function(e){
  e.preventDefault();
  console.log($('#s-skill option:selected').val());
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var sel = $.ajax({
    url: '/app/job/getskill',
    method: 'GET',
    data:{
      'cat':$('#search-sel option:selected').val(),
    },
  });

  sel.done(function(data){
    console.log(data);
    $('#s-skill').empty();
    $.each(data.skills,function(key,val){
      console.log(val.name);
      $('#s-skill').append($('<option>').text(val.name).attr('value',val.skill_id).addClass('selectoption'))
    });

    $('#s-skill').selectpicker('refresh');
    $('#s-skill').selectpicker('toggle');
  });
});

//-------- Job Filters --------//
$(document).on('change','.filters',function(e){
  e.preventDefault();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var filter = $.ajax({
    url: '/app/job/filter',
    method: 'GET',
    data:{
      'date':     $('#fil-date option:selected').val(),
      'salary':   $('#fil-sal option:selected').val(),
      'paytype':  $('#fil-ptype option:selected').val(),
      'distance': $('#fil-dist option:selected').val()
    }
  });
  filter.done(function(data){
    console.log(data);
  });
});

});