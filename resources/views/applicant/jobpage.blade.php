@extends('masters.secondary')
  <link href="/css/jobpage-custom.css" rel="stylesheet">
@section('body')
 <div class="container">
      <div class="row row-offcanvas row-offcanvas-left">

		<div class="row">
		<div class="container">
			<div class="col-md-3 outer-search-box">
			<p>< Back to Filters </p>
				<div class="search-box">
				<form id="search">
						<input type="text" class="form-control" id="search" placeholder="Search Job"/>
				</form>
				<div class="search-result">
					<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Labandera</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section> 
					<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Carpentero</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section> 
						<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Yaya</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section>
					<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Cook</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section>
					<section id="" class="result pull-left">
						<img src="/img/pic.png" class="img-rounded pull-left job-pic" alt="Rounded Image">
						<p class="meta-loc" id="job-title"><b>Baby Sitter</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section>
				</div>
				</div>
			</div>
			<div class="col-md-9 content">
				<div class="panel panel-default">
				  <div class="panel-heading map">
				  	<div id="gmap">
				  	</div>
				  </div>
				  <div class="panel-body">
				    <div class="row">
				    <div class="result-header">
				    <div class="col-md-5">
				  	 	<img src="../images/pic.png" class="img-rounded pull-left result-pic" alt="Rounded Image">
				  	 	<h3 class="result-title" id="job-title">Labandera</h3>
						<small class="meta-post" id="postedby">Kent Michael Baguion</small>
				  	 </div>
				  	 <div class="col-md-7">
				  	 <small class="pull-right">1 day ago</small>
				  	 <div class="action-btn bmark">
				   			<p>BOOKMARK</p>
				   		</div>
				   		<div class="action-btn apply">
				   			<p>APPLY</p>
				   		</div>
					</div>
				    </div>
				  </div>
				  
				  <div class="row">
				  	<div class="divider2"></div>
				  </div>
				  <div class="row">
				  	<div class="col-md-5">
				  		<div class="meta-data">
				  			<p>Location</p>
				  			<p class="main">Banawa, Cebu City</p>
				  			<p>Schedule</p>
				  			<p class="main">MWF 10:00 - 11:00 PM</p>
				  		</div> 
				  	</div>
				  	<div class="col-md-5">
				  		<div class="meta-data">
				  			<p>Salary</p>
				  			<p class="main">P500.00</p>
				  			<p>Mode of Payment</p>
				  			<p class="main">Per Hour</p>
				  		</div>
				  	</div>
				  		<div class="col-md-2">
				  		<div class="meta-data">
				  		<p>Slot</p>
				  		<p class="main">2</p>
				  		</div>
				  		</div>
				  
				  </div>
				    <div class="row">
				  	<div class="divider1"></div>
				  	</div>
				  <div class="col-md-12">
				  <div class="box">
				 	 <div class="box-title"><h4>Description</h4></div>
					 	 <p>Nunc mauris nisl, rhoncus eget augue sed, iaculis imperdiet erat? Nullam varius neque nec est volutpat dictum. Curabitur ultricies risus pulvinar orci pulvinar, sed cursus odio imperdiet. Quisque sollicitudin iaculis lorem at faucibus. Cras posuere felis id nunc ornare malesuada ac tempor ipsum. Nullam posuere dapibus varius. Sed iaculis leo in nibh varius semper.
						</p>
				  </div>
				  </div>
				   <div class="col-md-6">
				  <div class="box">
				  	<div class="box-title"><h4>Requirements</h4></div>
				  	<ul>
				  		<li>Knowledge in pc troubleshooting Hardware/software. </li>
				  		<li>Proficient on database (mssql / mysql) </li>
				  		<li>Knowledge in pc troubleshooting Hardware/software. </li>
				  		<li>Proficient on database (mssql /mysql) </li>
				  	</ul>
				  </div>
				  </div>
				     <div class="col-md-6">
				  <div class="box">
				  	<div class="box-title"><h4>Benefits</h4></div>
				  	<ul>
				  		<li>Free Lunch</li>
				  		<li>Transportation Allowance</li>
				  		<li>Free Lunch</li>
				  		<li>Transportation Allowance</li>
				  		<li>Free Lunch</li>
				  		<li>Transportation Allowance</li>
				  		<li>Free Lunch</li>
				  		<li>Transportation Allowance</li>
				  	</ul>
				  </div>
				  </div>
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
@stop
