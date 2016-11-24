@extends('masters.AppPrimary')

@section('body')
<a href="#scrolled" class="hidden" id="scroll"></a>
<div class="jbheader">
	<div class="container">
	<h1 class="jbtext">Boost your Job with a <b>Plus!</b></h1>
		<div class="jbcontents">
		<form></form>
			<div class="form-group form-group-md col-md-3">
				<h1>Category</h1>
			  <select class="selectpicker jpinput" data-style="selectp" id="search-sel">
			  	<option value="0" class="selectoption" selected="selected"><p>Any Category</p></option>
			  </select>
			</div>
			<div class="form-group form-group-md col-md-3">
			<h1>Skills</h1>
			<select class="selectpicker jpinput" data-style="selectp" id="s-skill" multiple="multiple"></select>
			</div>
			<div class="form-group form-group-md col-md-4">
			<h1>City</h1>
			  <input type="text" class="form-control textp" id="search-loc" placeholder="Enter your city">
			</div>
		   <button id="btn-search" type="button" class="btn btn-lg btn-search">Search</button>
			<h2><a href="#demo" data-toggle="collapse" class="col-filter"><i class="fa fa-filter" aria-hidden="true"></i>Filter Search</a></h2>
			  <div id="demo" class="collapse">
			   <div id="jbfilters" class="btn-group collapse">								    
				<div class="form-group form-group-md col-md-6">
				<h1>Paytype</h1>
				    <select class="selectpicker jpinput" data-style="selectp" id="fil-ptype">
				    	<option value="0" class="selectoption" selected="selected"><p>Any Pay Types</p></option>
				    </select>
				</div>
				<div class="form-group form-group-md col-md-6">
				<h1>Salary</h1>
				    <select class="selectpicker jpinput" data-style="selectp" id="fil-sal">
				       <option value="0" selected="selected" class="selectoption">Any Salary</option>
				       <option value="1" class="selectoption">below 500</option>
				       <option value="2" class="selectoption">below 1000</option>
				       <option value="3" class="selectoption">above 1000</option>
				    </select>
				</div>
			</div>
			  </div>
		</div>
	</div>
</div>
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
 <div class="container" id="scrolled">
   	<div class="row">
        <!-- Nav tabs --><div class="card">
        <ul class="nav nav-tabs" role="tablist" >
            <li role="presentation" class="active"><a href="#feeds" id="tab-feeds" aria-controls="feeds" role="tab" data-toggle="tab"><h3>Job Feeds</h3></a></li>
            <li role="presentation"><a href="#recommended" id="tab-recommended" aria-controls="recommended" role="tab" data-toggle="tab"><h3>Recommended Jobs</h3></a></li>
            <li role="presentation"><a href="#nearby" id="tab-nearby" aria-controls="nearby" role="tab" data-toggle="tab"><h3>Nearby Jobs</h3></a></li>
            <li role="presentation"><a href="#category" id="tab-category" aria-controls="category" role="tab" data-toggle="tab"><h3>Search by Category</h3></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="feeds">
            <div class="col-md-12">
			<h2 id="result-count"></h2>
			</div>
            <div class="col-md-5 jp-content feed-panel">
            <div class="panel panel-default jp-tabpanel ">
				<!-- Job list-->
				<div class="list-group" id="jobfeed-res">
				</div>
			</div>
            </div>
            <div id="feed-body" class="col-md-7 jp-content">
            	<div class="panel feed-panel">
            	<div class="row feed-top">
            		<div class="col-md-6 feed-title">
        				<h1 id="feed-t"></h1>
            			<p id="feed-p"></p>
            		</div>
            			<div class=" pull-right feed-tool">
            				<button class="btn btn-md btn-apply" id="feed-apply-btn">Apply</button>
            				<button class="btn btn-md btn-bookmark"><i class="fa fa-heart-o" aria-hidden="true"></i>Save</button>
            				<p><i class="fa fa-clock-o" aria-hidden="true"></i>1 day ago</p>
            			</div>
					</div>
        			<div id="feed-gmap" style="height:250px;"></div>
        			<div class="feed-meta">
        			<div class="feed-loc">
        				<p id="feed-res-jobid"></p>
        				<i class="fa fa-4x fa-map-marker" aria-hidden="true"></i>
						<h1 id="feed-result-add" class="meta-address"></h1>
						</div>
					<div class="col-md-4 mini-meta">
						<p class="mini-m meta-sal"></p>
						<p>Salary</p>
					</div>
					<div class="col-md-4 mini-meta">
					<p class="mini-m meta-ptype"></p>
						<p>Paytype</p>
					</div>
					<div class="col-md-4 mini-meta">
					<p class="mini-m meta-slot"></p>
						<p>Slot</p>
					</div>
        			</div>
        			<div class="feed-content">
        			<h2>Description</h2>
        			<p id="feed-desc"></p>
						<h2>Schedule</h2>						
						<div class="col-md-6 sched">
							<b><p><i class="fa fa-calendar-o" aria-hidden="true"></i> March 13, 2016 </p>
							<p><i class="fa fa-calendar-o" aria-hidden="true"></i> March 13, 2016 </p>
							<p><i class="fa fa-calendar-o" aria-hidden="true"></i> March 13, 2016 </p></b>
						</div>
						<div class="col-md-6 sched">
							<b><p><i class="fa fa-clock-o" aria-hidden="true"></i> 5:00 PM until 7:00 PM</p>
							<p><i class="fa fa-clock-o" aria-hidden="true"></i> 5:00 PM until 7:00 PM</p>
							<p><i class="fa fa-clock-o" aria-hidden="true"></i> 5:00 PM until 7:00 PM</p></b>
						</div>
						<div id="key"></div>
						<h2>Skills</h2>
						<div id="feed-result-skill"></div>
					</div>
					<hr>
					<div class="feed-footer">
						<h2>Interested in this Job?</h2>
						<button class="btn btn-md btn-apply" id="feed-apply-btn">Apply</button>
					</div>
            	</div>
            </div>
            </div>

            <!-- Recommended Job list-->
            
            <div role="tabpanel" class="tab-pane" id="recommended">
     <div class="col-md-12">
			<h2 id="result-count"></h2>
			</div>
            <div class="col-md-5 jp-content feed-panel">
            <div class="panel panel-default jp-tabpanel ">
				<!-- Job list-->
				<div class="list-group" id="recommended-res">
				</div>
			</div>
            </div>
            <div id="rec-body" class="col-md-7 jp-content">
            	<div class="panel feed-panel">
            	<div class="row feed-top">
            		<div class="col-md-6 feed-title">
        				<h1 id="rec-t"></h1>
            			<p id="rec-p"></p>
            		</div>
            			<div class=" pull-right feed-tool">
            				<button class="btn btn-md btn-apply" id="rec-apply-btn">Apply</button>
            				<button class="btn btn-md btn-bookmark"><i class="fa fa-heart-o" aria-hidden="true"></i>Save</button>
            				<p><i class="fa fa-clock-o" aria-hidden="true"></i>1 day ago</p>
            			</div>
					</div>
        			<div id="rec-gmap" style="height:250px;"></div>
        			<div class="feed-meta">
        			<div class="feed-loc">
        				<p id="rec-res-jobid"></p>
        				<i class="fa fa-4x fa-map-marker" aria-hidden="true"></i>
						<h1 id="rec-result-add" class="meta-address"></h1>
						</div>
					<div class="col-md-4 mini-meta">
						<p class="mini-m meta-sal"></p>
						<p>Salary</p>
					</div>
					<div class="col-md-4 mini-meta">
					<p class="mini-m meta-ptype"></p>
						<p>Paytype</p>
					</div>
					<div class="col-md-4 mini-meta">
					<p class="mini-m meta-slot"></p>
						<p>Slot</p>
					</div>
        			</div>
        			<div class="feed-content">
        			<h2>Description</h2>
        			<p id="rec-desc"></p>
						<h2>Schedule</h2>						
						<div class="col-md-6 sched">
							<b><p><i class="fa fa-calendar-o" aria-hidden="true"></i> March 13, 2016 </p>
							<p><i class="fa fa-calendar-o" aria-hidden="true"></i> March 13, 2016 </p>
							<p><i class="fa fa-calendar-o" aria-hidden="true"></i> March 13, 2016 </p></b>
						</div>
						<div class="col-md-6 sched">
							<b><p><i class="fa fa-clock-o" aria-hidden="true"></i> 5:00 PM until 7:00 PM</p>
							<p><i class="fa fa-clock-o" aria-hidden="true"></i> 5:00 PM until 7:00 PM</p>
							<p><i class="fa fa-clock-o" aria-hidden="true"></i> 5:00 PM until 7:00 PM</p></b>
						</div>
						<div id="key"></div>
						<h2>Skills</h2>
						<div id="rec-result-skill"></div>
					</div>
					<hr>
					<div class="feed-footer">
						<h2>Interested in this Job?</h2>
						<button class="btn btn-md btn-apply" id="rec-apply-btn">Apply</button>
					</div>
            	</div>
            </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="nearby"></div>
            <div role="tabpanel" class="tab-pane" id="category"></div>
        </div>
		</div>
	</div>
 </div>	
@endsection

@section('js')
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places"></script>
<script src="/bootstrap/bootstrap-select.js"></script>
<script src="/sweetalert/sweetalert.min.js"></script>
<script src="/js/jfeeds.js"></script>

<script src="/calendar/moment.min.js"></script>
@endsection