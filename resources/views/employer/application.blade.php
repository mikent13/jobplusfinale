@extends('masters.EmpPrimary')

@section('body')
 <div id="loading">
<div id="loading-center">
<div id="loading-center-absolute">
<div class="object" id="object_one"></div>
<div class="object" id="object_two"></div>
<div class="object" id="object_three"></div>
<div class="object" id="object_four"></div>
</div>
</div>
</div>
        <div class="container">
        <h1>Pending Applications</h1>
        <hr>
        <table class="table">
        	<thead>
        		<tr>
        			<th>Work Id</th>
        			<th>Job</th>
        			<th>Applicant</th>
        			<th>Actions</th>
        		</tr>
        	</thead>
        	<tbody>
        	@foreach($work as $w)
        		<tr>
        			<td>{{$w->work_id}}</td>
        			<td>
        				@foreach($jobs as $j)
        				@if($j->job_id == $w->job_id)
        				{{$j->title}}
        				@endif
        				@endforeach
        			</td>
        			<td>
        				@foreach($profiles as $p)
        				@if($p->user_id == $w->user_id)
        				{{$p->fname}} {{$p->lname}}
        				@endif
        				@endforeach
        			</td>
        			<td><a id="btnaccept" data-val="{{$w->work_id}}"><button class="btn btn-md">Accept</button></a>   <a id="btndecline" data-val="{{$w->work_id}}"><button class="btn btn-md">Decline</button></a></td>
        		</tr>
        	@endforeach
        	</tbody>
        </table>
        </div>
@endsection

@section('js')
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/emp-dashboard.js"></script>
@endsection
