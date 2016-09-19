
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jp.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>      
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    

   	<title>JobPlus</title>

   	<!-- STEPS-->
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
        });
    </script>
    <!-- END OF STEPS-->

    <script type="text/javascript">
    $(document).ready(function(){
        $("button[type='button']").click(function(){
        	var radioValue = $("button[name='paytype_id']:checked").val();
        });
    });
    </script>


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
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dashboard<span class="caret"></span></a>
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
		<div class="container">
			<div class="col-md-3 outer-search-box">
				<div class="search-box">
				<form id="search">
						<input type="text" class="form-control" id="search" placeholder="Search Job"/>
				</form>
				<div class="search-result">
					<section id="" class="result pull-left">
						<p class="meta-loc" id="job-title"><b>Labandera</b></p>
						<small >Banawa, Cebu City</small>
						<div class="bookmark pull-right"><span class="glyphicon glyphicon-heart-empty"></span></div>
					</section> 
		
				</div>
				</div>
			</div>

				  <div class="col-md-9 content-feed">
				  	<div class="panel panel-default">
				  	<div class="panel-heading"><h3>Feed</h3></div>
				  	<div class="panel-body">


				  		<!-- LABANDERA -->
						  <div class="col-md-12">
						  	<div class="box">
							 	 <div class="box-title"><h4>Labandera</h4></div>
							 
							 	 <p><b>Description:</b> Nunc mauris nisl, rhoncus eget augue sed, iaculis imperdiet erat?<br/>
							 	 <b>Schedule:</b> Monday-Wednesday<br/>
							 	 <b>Time:</b> 8:00AM-9:00AM
							 	 </p>
								<hr>
							</div>
						  </div> 
						  <!-- END OF LABANDERA -->

						  <!-- DRIVER -->
						  <div class="col-md-12">
						  	<div class="box">
							 	 <div class="box-title"><h4>Driver</h4></div>
							 	 <p><b>Description:</b> Nunc mauris nisl, rhoncus eget augue sed, iaculis imperdiet erat?<br/>
							 	 <b>Schedule:</b> Monday-Wednesday<br/>
							 	 <b>Time:</b> 8:00AM-9:00AM
							 	 </p>
								<hr>
							</div>
						  </div>
						  <!-- DRIVER -->

						  <!-- SALESLADY -->
						  <div class="col-md-12">
						  	<div class="box">
							 	 <div class="box-title"><h4>Saleslady</h4></div>
							 	 <p><b>Description:</b> Nunc mauris nisl, rhoncus eget augue sed, iaculis imperdiet erat?<br/>
							 	 <b>Schedule:</b> Monday-Wednesday<br/>
							 	 <b>Time:</b> 8:00AM-9:00AM
							 	 </p>
								<hr>
							</div>
						  </div>
						  <!-- SALESLADY -->
				   	</div>
				   	</div>
				</div>

	<script type="text/javascript" src="jquery.gmap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>

			<script type="text/javascript">
				
				$(document).ready(function () {
			    //Initialize tooltips
			    $('.nav-tabs > li a[title]').tooltip();
			    
			    //Wizard
			    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

			        var $target = $(e.target);
			    
			        if ($target.parent().hasClass('disabled')) {
			            return false;
			        }
			    });

			    $(".next-step").click(function (e) {

			        var $active = $('.wizard .nav-tabs li.active');
			        $active.next().removeClass('disabled');
			        nextTab($active);

			    });
			    $(".prev-step").click(function (e) {

			        var $active = $('.wizard .nav-tabs li.active');
			        prevTab($active);

			    });
			});

			function nextTab(elem) {
			    $(elem).next().find('a[data-toggle="tab"]').click();
			}
			function prevTab(elem) {
			    $(elem).prev().find('a[data-toggle="tab"]').click();
			}
			</script>
  </body>
</html>