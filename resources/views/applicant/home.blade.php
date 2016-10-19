@extends('masters.primary')

@section('css')
  <link rel="stylesheet" href="/css/custom.css">
  <link rel="stylesheet" href="/calendar/fullcalendar.min.css"/>
  <link rel="stylesheet" href="/calendar/fullcalendar.print.css" media="print"/>
  <link href="/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('body')
  <div class="container">
      <div class="row row-offcanvas row-offcanvas-left">

        <!-- sidebar -->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <ul class="nav nav-primary">
              <li class="active"><a href="#"><i class="fa fa-calendar nav-icon" aria-hidden="true"></i> Job+ Schedule</a></li>
              <hr>
                 <li><a href="#"><i class="fa fa-credit-card-alt nav-icon" aria-hidden="true"></i> Job+ Wallet </a></li>
              <hr>
                 <li><a href="{{ route('app/job/result') }}"><i class="fa fa-suitcase nav-icon" aria-hidden="true"></i> Find a Job </a></li>
              <hr>
              <li><a href="#"><i class="fa fa-bookmark nav-icon" aria-hidden="true"></i> Bookmarks</a></li> 
              <hr>
              <li><a href="#"><i class="fa fa-archive nav-icon" aria-hidden="true"></i> Logs</a></li>
              <hr>
              <li><a href="{{ route('app/profile') }}"><i class="fa fa-user nav-icon" aria-hidden="true"></i> Profile</a></li>      
            </ul>
        </div>

        <!-- main area -->
        <div class="col-xs-12 col-sm-9 dash-content">
        <br>
        @if(count($databaseEvents) == 0)
        <div class="well well-md">
              <h2>My Calendar</h2>
              <p>You currently have no job applications.</p>
          <h3>Click below to start appyling for your first job.</h3>
          <a class="btn btn-primary " href="{{ route('app/job/result') }}">Browse a Job</a>
          </div>
          <hr>
          <h3>Recommended Jobs</h3>
          <p>We offer these jobs that fits your skills.</p>
          <hr>
        
<div class="bootcards-list">
  <div class="panel panel-default">
    <div class="list-group">
      @foreach($recjobs as $jobs)
      <a class="list-group-item" href="{{ route('app/job/view',$jobs->job_id) }}">
        <div class="row">
          <div class="col-sm-6">
            <i class="fa fa-3x fa-suitcase pull-left" aria-hidden="true"></i>
            @foreach($skills as $skill)
                @if($jobs->skill_id == $skill->skill_id)
                   <h4 class="list-group-item-heading">{{ $skill->name }}</h4> 
                @endif
            @endforeach
          
            <p class="list-group-item-text">Tokyo, Japan</p>
          </div>
          <div class="col-sm-6">
            <p class="list-group-item-text">Salary</p>
            <p class="list-group-item-text">P{{ $jobs->salary }}.00</p>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>

        @else
        <h3>Calendar View</h3>
        <p>Easily pinpoint current and upcoming jobs.</p>
        <hr>
          <div id="calendar">
             {!! $calendar->calendar() !!}
           </div>
           <h3>Active Job</h3>
           <!-- <p> Job that you're currently working. </p> -->
            <hr>
           @if(Session::has('warning'))
           <div class="alert alert-warning">
             <p>{{ Session::get('warning') }}</p>
           </div>
           <?php Session::forget('warning') ?>
           @endif

            @if(Session::has('late'))
           <div class="alert alert-warning">
             <p>{{ Session::get('late') }}</p>
           </div>
           <?php Session::forget('late') ?>
           @endif
       
           @if(Session::has('success'))
            <div class="alert alert-success">
             <p>{{ Session::get('success') }}</p>
            </div>
           <?php Session::forget('success') ?>
           @endif

            @if($active)
            <div class="col-md-6">
            <div class="panel panel-default bootcards-file">
            <div class="panel-heading">
            <h3 class="panel-title">Working as
            @foreach($skills as $skill)
                @if($active->skill_id == $skill->skill_id)
                  {{ $skill->name }}
                @endif
            @endforeach
            </h3>
          </div>
          <div class="list-group">
            <div class="list-group-item">
              <a href="#">
                <i class="icon-file-pdf"></i>
              </a>
              <h3 class="list-group-item-heading">
              </h3>
              <p class="list-group-item-text">Schedule</p>
              <h3 class="list-group-item-heading">
              {{ $start }} until {{ $end }}
              </h3>
            </div>
            <div class="list-group-item">
              <p class="list-group-item-text">Location</p>
              <h3 class="list-group-item-heading">
              </h3>
            </div>
            <div class="list-group-item">
              <p class="list-group-item-text">Description</p>
               <h3 class="list-group-item-heading">
                {{$active->description}}
              </h3>
            </div>
          </div>
          <div class="panel-footer">
            <div class="btn-group ">
              <div class="btn-group">
              <a href="{{ route('app/job/start',$activework->job_id) }}">
                <button class="btn btn-default">
                  Start Job
                </button>
              </a>
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default bootcards-file">
          <div class="panel-heading">
          <h3 class="panel-title">
             Time left before job ends:
          </h3>
          </div>
          <div class="list-group">
             <div class="list-group-item">
              <p class="list-group-item-text"></p>
               <h3 class="list-group-item-heading">

              </h3>
            </div>
          </div>
          <div class="panel-footer">
            <div class="btn-group ">
              <div class="btn-group">
                <button class="btn btn-default" data-toggle="modal" data-target="#myModal">
                 End Job
                </button>
              </div>
            </div>
          </div>
          </div>
        </div>
        <form id="review" enctype="multipart/form-data" action="{{ route('app/job/end',$active->user_id) }}" method="get">
        {{csrf_field()}}
        <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">How's your experience working with 
            <p>{{ $profile->fname}} {{ $profile->lname }}?</p></h3>
          </div>
          <div class="modal-body">
            <input id="rating-system" name="rate" type="number" class="rating" min="1" max="5" step="1">
            <hr>
             <div class="form-group ">
               <textarea style="width:100%;height:130px;" name="review"  form="review" placeholder="Kindly give a short review."></textarea>
            </div>
            <input type="hidden" name="workid" value="{{ $activework->work_id }}">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </div>
    </div>
    </form>
        @else
        <p> You have no active job as of the moment.</p>
        <h3>Upcoming Job</h3>
        <hr>
        @endif

        @section('scripts')
          {!! $calendar->script() !!}
        @endsection
        @endif
            </div>
    </div>
  </div>

@endsection

<script src="/calendar/jquery.min.js"></script>
<script src="/calendar/moment.min.js"></script>
<script src="/calendar/fullcalendar.min.js"></script>
<script src="/js/star-rating.js" type="text/javascript"></script>