
//----------------------------Initialize Datas------------------------------------//
$(document).ready(function() {
     
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
       var jobdatas = $.ajax({
      url:'/get/jobdata',
      method:'GET',
    });

    jobdatas.done(function(data){
      console.log(data);
      var index = 0;
     $.each(data.categories,function(key,vals){
        $('#search-sel').append($('<option>', {
          value:vals.category_id,
          text: vals.name}));

     });

      $.each(data.paytypes,function(key,value){
        $('#fil-ptype').append('<option>'+ value.name + '</option>').attr('value',index);
        index++;
     });

      $.each(data.jobs,function(key,value){
        $('#side-res').append($('<a>').addClass('list-group-item').attr('data-val',value.job_id)
                        .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                        .append($('<h4>').addClass('list-group-item-heading').text(value.title))
                        .append($('<p>').addClass('list-group-item-text').text('location')));
      });

    });

//----------------------------Requests------------------------------------//

//--------Job Onclick  --------//
    $(document).on('click','.list-group-item',function(e){
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
      console.log(data);
      var dateposted = moment(data.job.date_posted);
        $('#result-sched').empty();
        $('#key').empty();
        $('#res-filtering').empty();  
        $('#result-title').text(data.job.title);
        $('#result-postby').text(data.user.fname + data.user.lname + dateposted.fromNow());
        $('#res-jobid').text(data.job.job_id).attr('hidden',true);
        $('#res-filtering').append('<li>'+data.category.name+'</li>'+'<li>'+data.paytype.name+'</li>'+'<li>'+data.job.salary+'</li>'+'<li>'+dateposted.fromNow()+'</li>');
        
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
          console.log(data);
          $('#skills').empty();
          $.each(data.skills,function(key,val){
             $('#skills').append($('<option>').text(val.name))
          });
         
        });
             

  });

    $(document).on('click','#btn-search',function(e){
      e.preventDefault();
           $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

        var search = $.ajax({
          url: '/app/jobsearch',
          method: 'GET',
          data:{
            'cat':$('#search-sel option:selected').val()
          },
        });
        search.done(function(data){
          console.log(data);
          $('.list-group').empty();
          $.each(data.job,function(key,value){
            $('#side-res').append($('<a>').addClass('list-group-item').attr('data-val',value.job_id)
                        .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                        .append($('<h4>').addClass('list-group-item-heading').text(value.title))
                        .append($('<p>').addClass('list-group-item-text').text('location')));
          });
        });   
    });

  $('#search-skill').keyup(function(e){

        var autocomp = $.ajax({
          url: "/app/autocomplete",
          method: 'GET',
          dataType: "json",
          data:{
            'key':$('#search-skill').val()
          }
        });

        autocomp.done(function(data){
          $('#side-res').empty();
          console.log(data);
          $.each(data.s,function(key,value){
            $('#search-skill').autocomplete({
              timeout:1000,
              minLength:2,
              source:value.name,
              select:function(e,ui){
                console.log(selected);
              }
            });

            $.each(data.j,function(key,value){
                $('#side-res').empty();
              $('#side-res').append($('<a>').addClass('list-group-item').attr('data-val',value.job_id)
                        .append($('<img>').addClass('img-rounded pull-left').attr('src',''))
                        .append($('<h4>').addClass('list-group-item-heading').text(value.title))
                        .append($('<p>').addClass('list-group-item-text').text('location')));
            });
          }); 
        });
    });
  
//--------------------------------------------------------------------------
  
   $('.dropdown-toggle').dropdown();

  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });

  $('filter-body').collapse('hide');
	  $("#filter-box").mouseenter(            
        function() {
            $('#filter-body').collapse('show',700);
        });

	  $("#filter-box").mouseleave(            
        function() {
            $('#filter-body').collapse('hide',700);
        });

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
  

    function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

bootcards.init( {
  offCanvasBackdrop : true,
  offCanvasHideOnMainClick : true,
  enableTabletPortraitMode : true,
  disableRubberBanding : true,
  disableBreakoutSelector : 'a.no-break-out'
});
           
    


});