@extends('masters.AppPrimary')
@section('css')
<link rel="stylesheet" href="/bootstrap/css/dashboard.css">
@endsection

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
  <h1>Schedule</h1>
  <hr>
  <div class="col-md-12 time-body ">
    <h1>Active Job</h1>
    <p id="active-p">No items to display.</p>
    <div class="active-body">
      <div class="timeline-heading">
      <div class="col-md-12 head-tools">
          <button class="btn btn-md btn-apply hidden" id="actend">End job </button>
          <button class="btn btn-md btn-apply" id="actstart">Start job</button>
          <h1 id="head-min"></h1>
          <h2 id="head-meta"></h2>
      <hr>
      </div>
      <p class="hidden" id="workid"></p>
        <h1 id="actitle"></h1>
        <p id="actemp"></p>
        <div class="head-button pull-right">
          <select class="selectpicker " data-width="170px" data-style="actselect" title="Set actions">
            <option  class="actoption" data-icon="fa fa-envelope"> Send a message</option>
            <option class="actoption" data-icon="fa fa-calendar"> Request a reschedule</option>
            <option class="actoption" data-icon="fa fa-times"> Dismiss this job</option>
          </select>
        </div>
      </div>
      <div class="timeline-body">
        <div class="jtitle">
         <p id="actdesc">
         </p>
       </div>
       <div class="row contents">
        <div class="col-md-6">
          <div class="sched">
           <p id="startDay"></p>
           <h1 id="startTime"></h1>
           <p>Starts at</p>
         </div>
         <div class="sched head-center">
          <h1><i class="fa fa-long-arrow-right" aria-hidden="true"></i></h1>
        </div>
        <div class="sched">
          <p id="endDay"></p>
          <h1 id="endTime"></h1>
          <p>Ends at</p>
        </div>
      </div>
      <div class="row contents">
        <div class="col-md-6 cont-col">
          <div class="head-time">
            <h1 id="actsal"></h1>
            <p>You will receive</p>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div id="actgmap" style="height:300px;"></div>
      </div>
      <div class="col-md-6 cont-col">
        <h1 id="actaddress"></h1>
        <p>Located at</p>
      </div>
      <div class="col-md-3 cont-col cont-col-center ">
        <h1 id="actdistance"></h1>
        <p>Distance from current location</p>
      </div>
      <div class="col-md-3 cont-col">
        <h1 id="acttime"></h1>
        <p>Approximate travel time</p>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="rateModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header rate-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="hidden" id="empid"></p>
        <h1 class="modal-title">How's your experience working with</h1>
        <img id="emp-pic" class="modal-pic">
        </div>
        <div class="modal-body">
        <h1 class="modal-title modalemp" id="modalemp"></h1>
          <input id="rating-system" name="rate" type="number" class="rating" min="1" max="5" step="1">
          <hr>
          <div class="form-group ">
           <textarea style="width:100%;height:130px;font-size:19px;padding:15px;" name="review" id="review" placeholder="Write a short review."></textarea>
         </div>
         <input type="hidden" name="workid" id="actworkid">
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-md " data-dismiss="modal">Cancel</button>
        <button type="submit" id="btn-rate" class="btn btn-md btn-primary">Rate</button>
      </div>
    </div>
  </div>
</div>

<h1>Upcoming Jobs</h1>
<p id="upcoming-p">No items to display.</p>
<ul id="upcoming-timeline" class=" timeline"></ul>


<div class="modal fade" id="seeMoreModal" role="dialog">
  <div class="col-md-12">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="timeline-heading">
            <h1 id="modal-title"></h1>
            <p id="modal-emp"></p>
            <div class="head-button pull-right">
              <select class="selectpicker " data-width="170px" data-style="actselect" multiple title="Set actions">
                <option  class="actoption" data-icon="fa fa-envelope"> Send a message</option>
                <option class="actoption" data-icon="fa fa-calendar"> Request a reschedule</option>
                <option class="actoption" data-icon="fa fa-times"> Dismiss this job</option>
              </select>
            </div>
          </div>
          <div class="timeline-body">
            <div class="jtitle">
             <p id="modal-desc">

             </p>
           </div>
           <div class="row contents">
            <div class="col-md-6">
              <div class="sched">
               <p id="modal-startDay"></p>
               <h1 id="modal-startTime"></h1>
               <p>Starts at</p>
             </div>
             <div class="sched head-center">
              <h1><i class="fa fa-long-arrow-right" aria-hidden="true"></i></h1>
            </div>
            <div class="sched">
              <p id="modal-endDay"></p>
              <h1 id="modal-endTime"></h1>
              <p>Ends at</p>
            </div>
          </div>
          <div class="row contents">
            <div class="col-md-3 cont-col">
              <div class="head-time">
                <h1 id="modal-fromnow"></h1>
                <p>From now</p>
              </div>
            </div>
            <div class="col-md-3 cont-col">
              <div class="head-time">
                <h1 id="modal-sal"></h1>
                <p>You will receive</p>
              </div>
            </div>
          </div>
          <div class="modalmap">
            <div id="modalgmap" style="height:300px;"></div>
          </div>
          <div class="col-md-12 cont-col">
            <h1 id="modal-address"></h1>
            <p>Located at</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('js')
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places"></script>
<script src="/sweetalert/sweetalert.min.js"></script>
<script src="/calendar/moment.min.js"></script>
<script src="/js/star-rating.js" type="text/javascript"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/bootstrap/bootstrap-select.js"></script>
<script src="/js/app-dashboard.js"></script>
@endsection
