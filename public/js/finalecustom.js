
function activeJob(){
$('#act-endbtn').attr('disabled',true);
	$.ajaxSetup({
	  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

	var active = $.ajax({
          url: '/app/activeJob',
          method: 'GET'
        });

        active.done(function(data){
          console.log(data);
          if(data.status == 1){
            $('#active').attr('hidden',false);
            $('#noactive').attr('hidden',true);

            $('#actitle').text(data.job.title);
            $('#actdesc').text(data.job.description);
            $('#actsched').text(data.sched.start + ' until ' + data.sched.end);
            $('#actworkid').text(data.work.work_id).attr('hidden',true);
            $('#actschedid').text(data.sched.schedule_id).attr('hidden',true);
            $('#actemployer').text(data.job.user_id).attr('hidden',true);
            if(data.work.is_start == 1){
              $('#act-endbtn').attr('disabled',false);
              $('#act-startbtn').attr('disabled',true);
            }
            else
            {
              $('#act-endbtn').attr('disabled',true);
            }
          }
          else
          {
            $('#noactive').attr('hidden',false);
            $('#active').attr('hidden',true);
          }
        });
}

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

$(document).ready(function(){
  activeJob();
	// setInterval(activeJob,1000);

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