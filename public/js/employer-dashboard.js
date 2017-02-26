$(document).ready(function(){
	$("#loading").fadeOut(300);
	initialize();
	function initialize(){
		$('#active-feeds').hide(400);
		$('#active-feeds').empty();
		$('#upcoming-feeds').hide(400);
		$('#upcoming-feeds').empty();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var sel = $.ajax({
			url: '/employer/dashboard/data',
			method: 'get',
		});

		sel.done(function(data){
			console.log(data);
			$('#active-feeds').show(400);
			$('#upcoming-feeds').show(400);

			if(data.active_status == 200){
				for(var i=0; i<data.active.length; i++){
					for(var z=0; z<data.reviewed.length;z++){
						var start = new moment(data.active[i].schedules.start).format('LT');
						if(data.active[i].is_start == 0){
							$('#active-feeds').append($('<div>').addClass('card-cont col-md-12')
								.append($('<span>').addClass('app-image col-md-2')
									.append($('<img>').attr('src',data.active[i].users.profile.avatar)))
								.append($('<span>').addClass('card-center col-md-7')
									.append($('<h2>').text(data.active[i].users.profile.fname + ' '+data.active[i].users.profile.lname))
									.append($('<p>').text('currently working on your job:'))
									.append($('<a>').text(data.active[i].schedules.jobs.title))
									.append($('<span>').addClass('button-tool')
										.append($('<button>').addClass('btn btn-md btn-startjob').text('Start session').attr('workid',data.active[i].work_id))
										.append($('<button>').addClass('btn btn-md btn-endjob hidden').text('End session').attr('workid',data.active[i].work_id))
										.append($('<p>').addClass('start-at').text('Scheduled at ' + start))))
								.append($('<span>').addClass('end-time col-md-3')
									.append($('<p>').text('Service charge: '))
									.append($('<h3>').text('Php ' + data.active[i].schedules.jobs.salary + ' / ' + data.active[i].schedules.jobs.paytypes.name)))
								)
						}
						else if(data.active[i].work_id == data.reviewed[z].work_id){
							
						}
						else{
							$('#active-feeds').append($('<div>').addClass('card-cont col-md-12')
								.append($('<span>').addClass('app-image col-md-2')
									.append($('<img>').attr('src',data.active[i].users.profile.avatar)))
								.append($('<span>').addClass('card-center col-md-7')
									.append($('<h2>').text(data.active[i].users.profile.fname + ' '+data.active[i].users.profile.lname))
									.append($('<p>').text('currently working on your job:'))
									.append($('<a>').text(data.active[i].schedules.jobs.title))
									.append($('<span>').addClass('button-tool')
										.append($('<button>').addClass('btn btn-md btn-startjob hidden').text('Start session').attr('workid',data.active[i].work_id))
										.append($('<button>').addClass('btn btn-md btn-endjob').text('End session').attr({'workid':data.active[i].work_id}))
										.append($('<p>').addClass('start-at').text('Scheduled at ' + start))))
								.append($('<span>').addClass('end-time col-md-3')
									.append($('<p>').text('Service charge: '))
									.append($('<h3>').text('Php ' + data.active[i].schedules.jobs.salary + ' / ' + data.active[i].schedules.jobs.paytypes.name)))
								)
						}
					}
				}
			}


			/// End of Active Job Feeds

			if(data.upcoming_status == 200){
				for(var y=0; y<data.upcoming.length; y++){
					var start = new moment(data.upcoming[y].schedules.start).format('LT');
					$('#upcoming-feeds').append($('<div>').addClass('card-cont col-md-12')
						.append($('<span>').addClass('app-image col-md-2')
							.append($('<img>').attr('src',data.upcoming[y].users.profile.avatar)))
						.append($('<span>').addClass('card-center col-md-7')
							.append($('<h2>').text(data.upcoming[y].users.profile.fname + ' '+data.upcoming[y].users.profile.lname))
							.append($('<p>').text('will be working on your job:'))
							.append($('<a>').text(data.upcoming[y].schedules.jobs.title))
							.append($('<span>').addClass('button-tool')
								.append($('<p>').addClass('start-at').text('Scheduled at '+ start))
								.append($('<span>').addClass('button-resched')
									.append($('<button>').addClass('btn btn-md btn-reschedjob').text('Reschedule').attr('workid',data.upcoming[y].work_id))
									.append($('<button>').addClass('btn btn-md btn-dismiss').text('Dismiss applicant').attr('workid',data.upcoming[y].work_id)))))
						.append($('<span>').addClass('end-time col-md-3')
							.append($('<p>').text('Service charge: '))
							.append($('<h3>').text('Php ' + data.upcoming[y].schedules.jobs.salary + ' / ' + data.upcoming[y].schedules.jobs.paytypes.name)))
						)
				}
			}

			/// End of Upcoming Job Feeds

		})
}

$(document).on('click','.btn-startjob',function(){
	var workid = $(this).attr('workid');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var sel = $.ajax({
		url: '/employer/startjob',
		method: 'get',
		data:{
			'id': workid
		}
	});
	sel.done(function(data){
		console.log(data);
		initialize();
	})
});

function promptEndjob(endworkID){
	swal({
		title: "Do you wis to end the current job session?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Confirm",
		closeOnConfirm: true
	},
	function(){
		EndJobSummary(endworkID);
	});
}

function EndJobSummary(endworkID){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var end = $.ajax({
		url: '/employer/endjob/summary',
		method: 'get',
		data:{
			'workid': endworkID
		}
	});

	end.done(function(data){
		console.log(data);
		var salary = data.work[0].job.salary;
		var paytype = data.work[0].paytype;
		var start =  moment(data.work[0].work.start_time);
		var end =  moment(data.work[0].work.end_time);
		var schedstart =  moment(data.work[0].work.schedules.start);
		var late = schedstart.from(start,'minutes');
		var result = end.from(start,'hours');
		var img = data.work[0].applicant.avatar;

		var tentative = end.from(start,true);
		var tentative = tentative.replace('hours','');
		var totalsalary = salary * tentative;

		console.log(start);
		console.log(end);
		console.log(result);
		$('#btn-confirm').attr('workid',endworkID);
		$('#applicant-img').attr('src',img);
		$('#totalsalary').text('Php ' +totalsalary);
		$('#salary').text('Php ' + salary + ' / '+paytype);
		$('#date-started').text(start.format('dddd, MMM. Mo hh:mm a'));
		$('#date-ended').text(end.format('dddd, MMM. Mo hh:mm a'));
		$('#hours_render').text(result);

		$('#endJob-Modal').modal('show');
	})
}

$(document).on('click','#btn-confirm',function(){
	var workid = $(this).attr('workid');
	var review = $('#review').val();
	var rate = $('#rating-system').val();

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var endjob = $.ajax({
		url: '/employer/endjob',
		method: 'get',
		data:{
			'workid': workid,
			'rate': rate,
			'review': review
		}
	});

	endjob.done(function(data){
		console.log(data);
		$('#endJob-Modal').modal('hide');
		swal({
			title: "Great!",
			text: "Succesfully ended the job.",
			showConfirmButton: false
		});		
	});

});

var endworkID =0;
$(document).on('click','.btn-endjob',function(){
	var endworkID = $(this).attr('workid');
	promptEndjob(endworkID);
});

});

