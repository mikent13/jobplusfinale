<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" id="bootstrap-css">
    <link href="/css/jp.css" rel="stylesheet">
     <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
  	 <link rel="stylesheet" href="/bootcards/css/bootcards-desktop.min">
  	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  	  <style>
  	  	
  	  </style>
   	<title>JobPlus</title>
  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
    	  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <div class="navbar-brand navbar-brand-centered">Job+</div>
		    </div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="navbar-brand-centered">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#"></a></li>
		        <li class="dropdown">
                  <a href="{{route('app/dashboard')}}" class="dropdown-toggle" data-toggle="dropdown">Dashboard<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('app/dashboard')}}">Job+ Schedule</a><li>
                    <li><a href="#">Job+ Wallet</a></li>
                    <li><a href="#">Bookmarks</a></li>
                    <li><a href="#">Log</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sign out</a></li>
                  </ul>
                </li>		        
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

		<!---End of Nav -->
		<div class="row">
			<div class="well well-lg">
			<div class="container">
				<form>
				<div class="form-group form-group-md col-xs-3">
				  <select class = "form-control input-md" id="search-sel">
			      </select>
				</div>
					<div class="form-group form-group-md col-xs-4">
					  <input list="skills" type="text" class="form-control input-md" id="search-skill">
					</div>
					<datalist id="skills">
						
					</datalist>
					<div class="form-group form-group-md col-xs-4 ">
					  <input type="text" class="form-control input-md" id="search-loc">
					</div>
				    <button id="btn-search" type="button" class="btn btn-primary btn-md">Search</button>
				</form>
				</div>
			</div>
		</div>

		<div class="row">
		<div class="container">
		<div class="col-md-12">
		<div class="col-md-4">
			<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<div class="btn-group ">
								 <div class="form-group col-md-6">
								      <select class="form-control input-sm filters" id="fil-date">
								      <option value="0" selected="selected">Posted Any Time </option>
								        <option value="1">Today</option>
								        <option value="2">1 week ago</option>
								        <option value="3">2 weeks ago</option>
								        <option value="4">later than 2 weeks</option>
								      </select>
								    </div>
								    
								    <div class="form-group col-md-6">
								      <select class="form-control input-sm filters" id="fil-ptype">
								       <option value="0" selected="selected">Any Pay Types</option>
								      </select>
								    </div>

								     <div class="form-group col-md-6">
								      <select class="form-control input-sm filters" id="fil-dist">
								       <option value="0" selected="selected">Distance</option>
								        <option value="5">5 miles</option>
								        <option value="10">10 miles</option>
								        <option value="15">15 miles</option>
								      </select>
								    </div>

								    <div class="form-group col-md-6">
								      <select class="form-control input-sm filters" id="fil-sal">
								       <option value="0" selected="selected">Salary Range</option>
								        <option value="500">below 500</option>
								        <option value="1000">below 1000</option>
								        <option value="5000">above 1000</option>
								      </select>
								    </div>

								    <div class="form-group col-md-6">
									<button class="btn btn-default btn-sm ">Reset filter</button>
								</div>						
							</div>	
						</div>	
						<!-- Job list-->
						<div class="list-group " id="side-res"></div>
						<!-- End Job list-->
					</div>
					</div>
			<div class="col-md-8 dash-content">
<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<p id="res-jobid"></p>
							<h4 class="panel-title pull-left" id="result-title"></h4>
							<br>
							<p id="result-postby"></p>
							<div class="btn-group pull-right">
								<a id="apply-btn btn-sm btn-default" class="btn btn-primary">
										<span>Apply</span>
								</a>
								<a id="bmark-btn" class="btn btn-default">
									<span>Bookmark</span>
								</a>
							</div>							
						</div>					
						<ul id="res-filtering"></ul>
						<h3>schedule</h3>						
						<ul id="result-sched"></ul>
						<div id="key"></div>
						<p id="result-skill"></p>
						</div>
		
					</div>	
					</div>
		</div>
		</div>
		
<script src="/js/jquery-1.11.1.min.js"></script>
	<script src="/js/jquery-ui.min.js"></script>

    <script src="/calendar/moment.min.js"></script>
    <script src="/bootcard/js/bootcards.min.js"></script>
    <script src="/js/custom.js"></script>
  </body>
