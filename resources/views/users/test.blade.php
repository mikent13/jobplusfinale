
@if(isset($hous))
	
	@foreach($hous as $hs)
		<p>{{ $hs }}<p>
	@endforeach

@endif

@if(isset($cons))
	@foreach($cons as $co)
		<p>{{ $co }}<p>
	@endforeach
@endif

@if(isset($pers))
@foreach($pers as $pe)
		<p>{{ $pe }}<p>
	@endforeach
@endif

@if(isset($main))
@foreach($main as $ma)
		<p>{{ $ma }}<p>
	@endforeach
@endif