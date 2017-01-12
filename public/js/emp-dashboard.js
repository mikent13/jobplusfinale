

$(document).ready(function(){
	$("#loading").fadeOut(300);

$(document).on('click','#btnaccept',function(){
	var workid = this.getAttribute('data-val');

	  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var request = $.ajax({
      url:'/employer/application/response',
      method:'GET',
      data:{
        'workid': workid
      }
    });

    request.done(function(data){
    	console.log(data);
    	alert('workid: '+data.success +' accepted');
    });

});

});