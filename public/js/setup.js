
 $(document).ready(function(){
  $('.divdeg').hide();
  $('.divmajor').hide();
  $('.tab-content').hide();
  $('.tab-content').show('slow')

  initAutocomplete();
  initializeData();


$('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
});

$("#filter-box").mouseenter(function() {
  $('#filter-body').collapse('show',700);
});

$("#filter-box").mouseleave(function() {
  $('#filter-body').collapse('hide',700);
});

        //Initialize tooltips
$('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
$('a[data-toggle="tab"]').on('show.bs.tab', function(e){
    var $target = $(e.target);
    if ($target.parent().hasClass('disabled')) {
        return false;
}});

$(".next-step").click(function(e){
    var $active = $('.wizard .nav-tabs li.active');
    $active.next().removeClass('disabled');
    nextTab($active);

});
$(".prev-step").click(function(e){
    var $active = $('.wizard .nav-tabs li.active');
    prevTab($active);
});

function nextTab(elem){
  $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem){
  $(elem).prev().find('a[data-toggle="tab"]').click();
}

// End of Document ready
 });

var input;
var searchBox;
var geolocation;
var map;
 function initAutocomplete() {

  if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

          console.log(geolocation);
         var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: geolocation.lat, lng: geolocation.lng},
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

         // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        searchBox.addListener('places_changed',function(){
          alert('place changed');
          console.log(this);
        });
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        
        google.maps.event.addListener(map, 'click', function (e) {
          var ll = {lat: e.latLng.lat(), lng: e.latLng.lng()}; 

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

        $('[href=#step3]').on('shown.bs.tab', function (e) {
  setTimeout(google.maps.event.trigger(map, 'resize'),300);
 });

         function getAddressByLatlng(latlng){
             
                var lat =latlng.lat;
                var lng =latlng.lng;
        
                var inputSearchBox = document.getElementById('pac-input');

                var cLatValId = document.getElementById('clat');
                var cLongValId = document.getElementById('clong');

                cLatValId.value=lat+','+lng;
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
        console.log(data);
      var index = 0;

      

     $.each(data.categories,function(key,vals){
        $('.jtype').append($('<option>', {
          value:vals.category_id,
          text: vals.name}));
     });

      $.each(data.categories,function(key,vals){
        $('#degree').append($('<option>', {
          value: vals.category_id,
          text: vals.name}));
     });

    });
}

    // initAutocomplete();
    $(document).on('change','#attainment',function(){
      var attainment = $('#attainment option:selected').val();
      if(attainment == 2){
        $('.divdeg').show('slow');
        $('.divmajor').show('slow');
      }
      else{
         $('.divdeg').hide('slow');
        $('.divmajor').hide('slow');
      }

      console.log(attainment);
    });
      
  







 