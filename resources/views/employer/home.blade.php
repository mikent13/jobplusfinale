@extends('masters.primary')

@section('css')
  <link rel="stylesheet" href="/css/custom.css">
  <link rel="stylesheet" href="/calendar/fullcalendar.min.css"/>
  <link rel="stylesheet" href="/calendar/fullcalendar.print.css" media="print"/>
  
@endsection

@section('body')
  <div class="container">
      <div class="row row-offcanvas row-offcanvas-left">
        <!-- sidebar -->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <ul class="nav nav-primary">
              <li class="active"><a href="#"><i class="fa fa-calendar nav-icon" aria-hidden="true"></i> Job+ Schedule</a></li>
              <hr>
              <li><a href="{{ route('emp/job/post') }}"><i class="fa fa-suitcase nav-icon" aria-hidden="true"></i> Job+ Postings </a></li>
              <hr>
              <li><a href="#"><i class="fa fa-credit-card-alt nav-icon" aria-hidden="true"></i> Job+ Wallet </a></li>
              <hr>
              <li><a href="#"><i class="fa fa-bookmark nav-icon" aria-hidden="true"></i> Bookmarks</a></li> 
              <hr>
              <li><a href="#"><i class="fa fa-archive nav-icon" aria-hidden="true"></i> Logs</a></li>
              <hr>
              <li><a href="{{ route('emp/profile') }}"><i class="fa fa-user nav-icon" aria-hidden="true"></i> Profile</a></li>      
            </ul>
        </div>
        <hr>
        <!-- main area -->
        {{ dd($prof) }}

        <div class="col-xs-12 dash-content">
          @foreach($applications as $app)
              @foreach($profiles as $prof)
                @if($app->user_id === $prof->user_id)
                <h3>{{ $prof->fname }} {{$prof->fname}}</h3>
                <p>wants to work with you.</p>
                <a class="btn btn-primary btn-md">
                  Accept
                </a>
                @endif
              @endforeach
          @endforeach
           </div>

        </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="/calendar/jquery.min.js"></script>
<script src="/calendar/moment.min.js"></script>
<script src="/calendar/fullcalendar.min.js"></script>
@endsection
