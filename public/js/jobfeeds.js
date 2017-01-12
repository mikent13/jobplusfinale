//----------------------------Initialize Datas------------------------------------//
var map;
var input;
var searchBox;
var place;

$(document).ready(function() {
 initializeMap();
 initializeData();

//----------------------------Initialization------------------------------------//
function initializeMap(){
$('#map').attr('hidden',true);
     if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
             map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: geolocation.lat, lng: geolocation.lng},
          zoom: 18
        });
        });
        }
}

function initializeData(){

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

      $.each(data.jobs,function(key,value){
        $('#side-res').append($('<a>').addClass('list-group-item item-res').attr('data-val',value.job_id)
                        .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                        .append($('<h4>').addClass('list-group-item-heading').text(value.title))
                        .append($('<p>').addClass('list-group-item-text').text(value.job_id)));
      });

  //----------------Location------------//
 input = document.getElementById('search-loc');
 var options = {
  types: ['(cities)'],
  componentRestrictions: {country: "us"}
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
  

//----------------------------Requests------------------------------------//

//--------Job Search  --------//
  $(document).on('click','#btn-search',function(e){
      e.preventDefault();
      var resp_placeid ;
      var req_placeid ;
      var zips = [];
      var geocode = new google.maps.Geocoder();
      var ctr = 0;
      geocode.geocode({ 'address': $('#search-loc').val() }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              console.log(results);

            var res = results[0].address_components;
            for(var i=0; i<res.length; i++){
              if(res[i].types[0] =="locality"){
                this.req_placeid = res[i].long_name;
              }
            }
              }
      });
      
           $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

        var search = $.ajax({
          url: '/app/jobsearch',
          method: 'GET',
          data:{
            'cat'  : $('#search-sel option:selected').val(),
            'skill': $('#search-skill').val(),
            'location': $('#search-loc').val(),
            'salary': $('#fil-sal').val(),
            'ptype': $('#fil-ptype').val(),
            'date': $('#fil-date').val(),
          },
        });

        search.done(function(data){
          $('#side-res').empty();
          console.log(data);
          $.each(data.job,function(key,value){

            center = {  lat: parseFloat(value.lat),  lng: parseFloat(value.long) };
            zips.push(center);
            geocode.geocode({ 'latLng': zips[0] }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              var rea = results[0].address_components;
                for(var i=0; i<rea.length; i++){
                  if(rea[i].types[0] =="locality"){
                    this.resp_placeid = rea[i].long_name;
                      if(this.req_placeid === this.resp_placeid){
                        $('#side-res').append($('<a>').addClass('list-group-item item-res').attr('data-val',value.job_id)
                            .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                            .append($('<h4>').addClass('list-group-item-heading').text(value.title))
                            .append($('<p>').addClass( 'list-group-item-text').text(value.job_id)));
                      }
                  }
                }     
            }
      });  
          });

        });  

    });

//--------Job Onclick  --------//
    $(document).on('click','.item-res',function(e){
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
      var meo = [];
      var locs;
      var centers = { lat: parseFloat(data.job.lat), lng: parseFloat(data.job.long) };
      meo.push(centers);
      var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'latLng': meo[0] }, function (results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
                locs = results[0].formatted_address;
                console.log(results[0]);
              }
        $('#res-filtering').append('<li>'+data.skill.name+'</li>'+'<li>'+locs+'</li>'+'<li>'+data.category.name+'</li>'+'<li>'+data.paytype.name+'</li>'+'<li>'+data.job.salary+'</li>'+'<li>'+dateposted.fromNow()+'</li>');
      });

       var marker = new google.maps.Marker({
          map: map,
          position: meo[0],
          title: 'Hello World!'
        });
       
      $('#map').attr('hidden',false);
      setTimeout(google.maps.event.trigger(map, 'resize'),300);
      map.setCenter(centers);

      var dateposted = moment(data.job.date_posted);
        $('#result-sched').empty();
        $('#key').empty();
        $('#res-filtering').empty();  
        $('#result-title').text(data.job.title);
        $('#result-postby').text(data.user.fname + data.user.lname + dateposted.fromNow());
        $('#res-jobid').text(data.job.job_id).attr('hidden',true);
        
        $.each(data.sched, function(key,value){
        var start = moment(value.start).format('lll');
        var end = moment(value.end).format('lll');
        $('#result-sched').append('<p>' + start +' - '+ end +'</p>');
      });

    });
    }); 

//-------- Job Application --------//
    $(document).on('click','#apply-btn',function(e){
       e.preventDefault();
       var jobid = $('#res-jobid').text();
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

//-------- Job Search --------//    

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
});