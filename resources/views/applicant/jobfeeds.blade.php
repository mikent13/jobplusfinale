@extends('masters.AppPrimary')

@section('body')

<div class="jbheader">
	<div class="jpHeroImage"></div>
	<div class="container">
		<div class="jbcontents">
			<div class="form-group form-group-md col-xs-3">
			  <select class = "form-control input-lg" id="search-sel"></select>
			</div>
			<div class="form-group form-group-md col-xs-4">
			  <input list="skills" type="text" class="form-control input-lg" id="search-skill" placeholder="Input keywords or jobtitle">
			</div>
				<datalist id="skills"></datalist>
			<div class="form-group form-group-md col-xs-4 ">
			  <input type="text" class="form-control input-lg" id="search-loc" placeholder="Enter your city">
			</div>
			   <button id="btn-search" type="button" class="btn btn-lg">Search</button>
			<div class="btn-group ">								    
				<div class="form-group col-md-5">
				    <select class="form-control input-md filters" id="fil-ptype">
				    	<option value="0" selected="selected"><p>Any Pay Types</p></option>
				    </select>
				</div>
				<div class="form-group col-md-5">
				    <select class="form-control input-md filters" id="fil-sal">
				       <option value="0" selected="selected">Any Salary</option>
				       <option value="1">below 500</option>
				       <option value="2">below 1000</option>
				       <option value="3">above 1000</option>
				    </select>
				</div>
				<div class="form-group col-md-1">
					<button class="btn btn-default btn-md ">Reset filter</button>
				</div>						
			</div>	
		</div>
	</div>
</div>
	
 <div class="container">
   	<div class="row">
        <!-- Nav tabs --><div class="card">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#feeds" id="tab-feeds" aria-controls="feeds" role="tab" data-toggle="tab"><h3>Job Feeds</h3></a></li>
            <li role="presentation"><a href="#recommended" id="tab-recommended" aria-controls="recommended" role="tab" data-toggle="tab"><h3>Recommended Jobs</h3></a></li>
            <li role="presentation"><a href="#nearby" id="tab-nearby" aria-controls="nearby" role="tab" data-toggle="tab"><h3>Nearby Jobs</h3></a></li>
            <li role="presentation"><a href="#category" id="tab-category" aria-controls="category" role="tab" data-toggle="tab"><h3>Search by Category</h3></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="feeds">
            <div class="col-md-5 jp-content">
            <div class="panel panel-default">
				<div class="panel-heading clearfix">
					<label>
						<select class="form-control input-sm sort" id="sorter">
					       <option value="0" selected="selected">Any Pay Types</option>
				        </select>
					</label>
				</div>	
				<!-- Job list-->
				<div class="list-group" id="jobfeed-res"></div>
			</div>
            </div>
            <div id="feed-body" class="col-md-7 jp-content">
            	<div class="panel">
        			<div id="feed-gmap" style="height:250px;"></div>
            		<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<p id="feed-res-jobid"></p>
							<h1 class="panel-title pull-left" id="feed-result-title"></h1>
							<h1 id="feed-result-add" class="pull-left"></h1>
							<br>
							<p id="result-postby"></p>
							<div class="btn-group pull-right">
								<a  class="btn btn-primary btn-sm ">
									<span id="feed-apply-btn">Apply</span>
								</a>
								<a id="bmark-btn" class="btn btn-default">
									<span>Bookmark</span>
								</a>
							</div>							
						</div>	
						<ul id="res-filtering"></ul>
						<h3>Schedule</h3>						
						<ul id="feed-result-sched"></ul>
						<div id="key"></div>
						<h3>Skills</h3>
						<ul id="feed-result-skill"></ul>
						</div>
            	</div>
            </div>
            </div>

            <!-- Recommended Job list-->
            
            <div role="tabpanel" class="tab-pane" id="recommended">
        	<div class="col-md-5 jp-content">
            <div class="panel panel-default">
				<div class="panel-heading clearfix">
					<label>
						<select class="form-control input-sm sort" id="sorter" >
					       <option value="0" selected="selected">Any Pay Types</option>
				        </select>
					</label>
				</div>	
				<!-- Job list-->
				<div class="list-group" id="recommended-res"></div>
			</div>
            </div>
            <div id="rec-body" class="col-md-7 jp-content">
            	<div class="panel">
        			<div id="rec-gmap" style="height:250px;"></div>
            		<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<p id="rec-res-jobid"></p>
							<h1 class="panel-title pull-left" id="rec-result-title"></h1>
							<h1 id="rec-result-add" class="pull-left"></h1>
							<br>
							<p id="result-postby"></p>
							<div class="btn-group pull-right">
								<a  class="btn btn-primary btn-sm ">
									<span id="rec-apply-btn">Apply</span>
								</a>
								<a id="bmark-btn" class="btn btn-default">
									<span>Bookmark</span>
								</a>
							</div>							
						</div>	
						<ul id="res-filtering"></ul>
						<h1>schedule</h1>						
						<ul id="rec-result-sched"></ul>
						<h1>Skill</h1>
						<ul id="rec-result-skill"></ul>
						<div id="key"></div>
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
<script src="/js/jfeeds.js"></script>
<script src="/calendar/moment.min.js"></script>
@endsection