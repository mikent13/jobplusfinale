@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Employer Dashboard<h2><h3>Welcome, {{ Auth::user()->username }}</h3></div>
                <div class="panel-body">
                   <h3>Jobs Posted</h3>
                   <ul>
                   	@foreach($jobs as $job)
                   		<li><h4>{{ $job->title }}</h4> <p>posted by {{ $job->getEmployer() }}</p></li>
	                   		<a href="{{ route('applicant.apply',['jobid' => $job->id,'id'=> Auth::user()->id]) }}">
	                   			<button class="btn btn-primary">Apply</button>
	                   		</a>
                   	@endforeach
                   </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

