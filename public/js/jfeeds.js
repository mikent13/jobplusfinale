//----------------------------Initialize Datas------------------------------------//
var map;
var maps;
var input;
var searchBox;
var place;



//----------------------------Initialization------------------------------------//
function initializeMap(){
$('#feed-gmap').attr('hidden',true);
$('#rec-gmap').attr('hidden',true);

     if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
             maps = new google.maps.Map(document.getElementById('feed-gmap'), {
          center: {lat: geolocation.lat, lng: geolocation.lng},
          zoom: 18
        });

         map = new google.maps.Map(document.getElementById('rec-gmap'), {
          center: {lat: geolocation.lat, lng: geolocation.lng},
          zoom: 18
        });

        });
        }
}

function initializeData(){
    $('#feed-body').attr('hidden',true);
    $('#rec-body').attr('hidden',true);


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
      var index = 0;
      $('#search-sel').append($('<option>', {
          value:index,
          text: 'Select Category'
        }).attr('value',index));

     $.each(data.categories,function(key,vals){
        $('#search-sel').append($('<option>', {
          value:vals.category_id,
          text: vals.name})); 

     });

      $.each(data.paytypes,function(key,value){
        $('#fil-ptype').append($('<option>').text(value.name).attr('value',value.paytype_id));
     });

        $('#skills').empty();
       $.each(data.skill,function(key,val){
         $('#skills').append($('<option>').text(val.skill_id).attr('value',val.name))
      });

  //----------------Job Feeds------------//

for(i = 0; i< data.jobs.length; i++){
  for(z = 0; z< data.jobadd.length; z++){
    if(data.jobs[i].job_id == data.jobadd[z].jobid){
    for(x = 0; x< data.profile.length; x++){
      if(data.jobs[i].user_id == data.profile[x].user_id){
         $('#jobfeed-res').append($('<a>').addClass('list-group-item item-res').attr('data-val',data.jobs[i].job_id)
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

  
//----------------------------Requests------------------------------------//

//--------Job Search  --------//
  var loc;
  $(document).on('click','#btn-search',function(e){
    e.preventDefault();
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
          data:{
            'cat'  : $('#search-sel option:selected').val(),
            'skill': $('#search-skill').val(),
            'location':this.loc,
            'salary': $('#fil-sal').val(),
            'ptype': $('#fil-ptype').val(),
          },
        });

        search.done(function(data){
          $('#jobfeed-res').empty();
          console.log(data);

  for(i = 0; i< data.jobs.length; i++){
    for(z = 0; z< data.jobadd.length; z++){
    if(data.jobs[i].job_id == data.jobadd[z].jobid){
    for(x = 0; x< data.profile.length; x++){
      if(data.jobs[i].user_id == data.profile[x].user_id){
         $('#jobfeed-res').append($('<a>').addClass('list-group-item item-res').attr('data-val',data.jobs[i].job_id)
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
        }); 

      });
  });

//-------- Onclick  Tab recommended --------//

$(document).on('click','#tab-recommended',function(e){
  e.preventDefault();
  $('#feed-body').attr('hidden',true);
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

  var search = $.ajax({
          url: '/get/job/recommended',
          method: 'GET',
        });

    search.done(function(data){
      console.log(data);
      $('#recommended-res').empty();
  for(i = 0; i< data.jobs.length; i++){
  for(z = 0; z< data.jobadd.length; z++){
    if(data.jobs[i].job_id == data.jobadd[z].jobid){
      for(y = 0; y< data.jobskills.length; y++){
        if(data.jobs[i].job_id == data.jobskills[y].job_id){
    for(x = 0; x< data.profile.length; x++){
      if(data.jobs[i].user_id == data.profile[x].user_id){
         $('#recommended-res').append($('<a>').addClass('list-group-item recom-res').attr('data-val',data.jobs[i].job_id)
                        .append($('<div>').addClass('cont-feeds')
                        .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                        .append($('<h4>').addClass('list-group-item-heading ellipsis meta-title').text(data.jobs[i].title))
                        .append($('<p>').addClass('list-group-item-text meta meta-employer').text('by '+data.profile[x].fname + ' ' + data.profile[x].lname))
                        .append($('<i>').addClass('meta-loc meta-marker fa-1x fa fa-map-marker'))
                        .append($('<p>').addClass('list-group-item-text meta meta-loc meta-locality').text(data.jobadd[z].locality))));
        }
      }
      }
      }
    }}
    }

    });

});

//--------Job Onclick  --------//
    $(document).on('click','.recom-res',function(e){
       e.preventDefault();
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
      $('#rec-body').attr('hidden',false);
      $('#rec-result-sched').empty();
      $('#rec-result-skill').empty();
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
             
             $('#rec-result-title').text("(" +data.job.job_id + ") "+ data.job.title);
             for(i = 0; i<data.sched.length; i++){
                $('#rec-result-sched').append($('<li>')
                  .append($('<p>').text(data.sched[i].start + " until " + data.sched[i].end)));
             }
             for(i = 0; i<data.skill.length; i++){
                $('#rec-result-skill').append($('<li>')
                  .append($('<p>').text(data.skill[i].name)));
             }
            $('#rec-res-jobid').text(data.job.job_id).attr('hidden',true);
        // $('#res-filtering').append('<li> '+data.skill.name+'</li>'+'<li>'+locs+'</li>'+'<li>'+data.category.name+'</li>'+'<li>'+data.paytype.name+'</li>'+'<li>'+data.job.salary+'</li>'+'<li>'+dateposted.fromNow()+'</li>');
      });

       var marker = new google.maps.Marker({
          map: map,
          position: meos[0],
          title: 'Hello World!'
        });
       
      $('#rec-gmap').attr('hidden',false);
      setTimeout(google.maps.event.trigger(map, 'resize'),300);
      map.setCenter(centers);

      // var dateposted = moment(data.job.date_posted);
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

    });
    }); 


$(document).on('click','#tab-feeds',function(e){
       e.preventDefault();
      $('#rec-body').attr('hidden',true);
     });

//--------Job Onclick  --------//
    $(document).on('click','.item-res',function(e){
       e.preventDefault();
        $('#feed-result-sched').empty();
      $('#feed-result-skill').empty();
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
      $('#feed-body').attr('hidden',false);
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
                $('#feed-result-skill').append($('<li>')
                  .append($('<p>').text(data.skill[i].name)));
             }


        // $('#res-filtering').append('<li> '+data.skill.name+'</li>'+'<li>'+locs+'</li>'+'<li>'+data.category.name+'</li>'+'<li>'+data.paytype.name+'</li>'+'<li>'+data.job.salary+'</li>'+'<li>'+dateposted.fromNow()+'</li>');
      });

       var marker = new google.maps.Marker({
          map: maps,
          position: meo[0],
          title: 'Hello World!'
        });
       
      $('#feed-gmap').attr('hidden',false);
      setTimeout(google.maps.event.trigger(maps, 'resize'),300);
      maps.setCenter(centers);

      // var dateposted = moment(data.job.date_posted);
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

    });
    }); 

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
         alert(data.success);

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
          alert(data.success);
        });
    });

  $(document).on('change','#search-sel',function(e){
      e.preventDefault();
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
          $('#skills').empty();
          $.each(data.skills,function(key,val){
             $('#skills').append($('<option>').text(val.name))
          });
         
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