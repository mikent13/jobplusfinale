@extends('masters.AppPrimary')

@section('body')
<div class="container">
	<h1>SMS Page</h1>
	<hr>
	<h1>Recipient Number</h1>
	<input type="text" id="mobile" placeholder="phone number">
	<h1>Message</h1>
	<textarea  style="width:100%;height:130px;" id="message" placeholder="Message to recipient"></textarea>
	<hr>
	<button class="btn btn-lg" id="btn-send">Send</button>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('click','#btn-send',function(){
			var number = $('#mobile').val();
			var message = $('#message').val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			var send = $.ajax({
				url: '/sms/send',
				method: 'GET',
				data:{
					"number": number,
					"message": message
				}
			});
			send.done(function(data){
				console.log(data);
			});
		});

	});
</script>
@endsection