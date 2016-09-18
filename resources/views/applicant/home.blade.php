@extends('masters.primary')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.print.css" media="print"/>
@endsection

@section('body')
  <div class="container">
      <div class="row row-offcanvas row-offcanvas-left">
        <!-- sidebar -->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <ul class="nav nav-primary">
              <li class="active"><a href="#"><i class="fa fa-calendar nav-icon" aria-hidden="true"></i> Job+ Schedule</a></li>
              <hr>
              <li><a href="{{ route('app/job/search') }}"><i class="fa fa-suitcase nav-icon" aria-hidden="true"></i> Job+ Postings </a></li>
              <hr>
              <li><a href="#"><i class="fa fa-credit-card-alt nav-icon" aria-hidden="true"></i> Job+ Wallet </a></li>
              <hr>
              <li><a href="#"><i class="fa fa-bookmark nav-icon" aria-hidden="true"></i> Bookmarks</a></li> 
              <hr>
              <li><a href="#"><i class="fa fa-archive nav-icon" aria-hidden="true"></i> Logs</a></li>
              <hr>
              <li><a href="{{ route('user/profile',['id' => 'Auth::id()']) }}"><i class="fa fa-user nav-icon" aria-hidden="true"></i> Profile</a></li>                
            </ul>
        </div>
        <!-- main area -->
        <div class="col-xs-12 col-sm-9 dash-content">
       	   <div id="calendar-{{ $calid }}"></div>
           @foreach($app as $data)
            {{  $data->start }}
           @endforeach
        </div>
    </div>
  </div>
@endsection

@section('scripts')
    {!! $calendar->script() !!}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@endsection