@extends('masters.primary')

@section('body')
<h1> {{ $profile->fname}} {{$profile->lname}}'s Profile </h1>
<hr>
<div class="col-md-12">
	<h3>Biography</h3>
	<p>{{$profile->biography}}</p>
	<hr>
</div>
<div class="col-md-12">
	<h3>Experiences</h3>
		@foreach($profile->experience as $experience)
			<p><b>{{$experience->year}}</b></p>
			<p>{{$experience->jobname}}</p>
			<p>Hired by {{$experience->employer}}</p>
		@endforeach
	<hr>
</div>
<div class="col-md-12">
	<h3>Education</h3>
		@foreach($profile->education as $education)
			<p>{{$education->school}}</p>
		@endforeach
		{{}}
	<hr>
</div>


@endsection

