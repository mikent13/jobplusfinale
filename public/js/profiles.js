$(document).ready(function(){

initializeData();


	$('#edit-name').on('click',function(){
		$('#myModal').modal('show');
		$('.modal-title').text('Edit Name & Skills');
		$('#skillbox').prop('checked',true);
	});

	$('#name-save').on('click',function(){
		$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	var updatename = $.ajax({
	  url:'/get/update/name',
	  method:'GET',
	  data:{
	  	'lname': $('#lastname').val(),
	  	'fname' : $('#firstname').val()
	  }
	});

	updatename.done(function(data){
		initializeData();
	});

	});

});

function loadEnd(){
$('#loading').fadeOut(200);
}

function initializeData(){
	  $.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	   var profiledata = $.ajax({
	  url:'/get/profiledata',
	  method:'GET',
	  complete:loadEnd,
	});

	   profiledata.done(function(data){
	   	console.log(data);
	   	$('.prof-name').text(data.profile.fname + ' ' + data.profile.lname);
   		$('.prof-address').text(data.profile.locality);
   		$('#lastname').attr('value',data.profile.lname);
   		$('#firstname').attr('value',data.profile.fname);

   		$('#prof-skills').empty();
   		$.each(data.skills,function(key,val){
   			$('#prof-skills').append($('<p>').text(val.name));
   			console.log(val.name);
   		});
	   });


}