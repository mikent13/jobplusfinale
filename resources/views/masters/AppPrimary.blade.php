<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>JobPlus</title>
        <!-- CSS -->
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/bootstrap/css/appfinale.css">
        <link rel="stylesheet" href="/bootcard/css/bootcards-desktop.min.css">
        <link rel="stylesheet" href="/bootstrap/bootstrap-select.min.css">
        <link rel="stylesheet" href="/sweetalert/sweetalert.css">
        <link href="/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
        @yield('css')
</head>
<body>
       <div class="navbar main-nav">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="{{route('app/dashboard')}}" class="brand"><p>Job+</p></a>
                </li>
                <li>
                    <a href="#"><p>Employer</p></a>
                </li>
                <li>
                    <a href="{{route('app/dashboard')}}" class="active"><p>Candidate</p></a>
                </li>
            </ul>
              <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#"><p><i class="fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"></i><span class="badge">1</span></p></a>
                </li>
                <li>
                    <a href="#"><p><i class="fa fa-bell-o fa-lg fa-fw" aria-hidden="true"></i></p></a>
                </li>
                <li class="dopdown">
                  <a href="{{route('app/profile')}}" class="dropdown-toggle img-avatar" data-toggle="dropdown">
                    <img src="{{Auth::user()->profile->avatar}}" style="border-radius: 50%; height: 30px; width: 30px; margin-right:5px;">{{Auth::user()->profile->lname}}, {{Auth::user()->profile->fname}}  <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
                  </a>
                </li>               
              </ul>
          </div>
        </div>
        <nav class="navbar navbar-default sub-nav " role="navigation">
          <div class="container">
              <ul class="nav navbar-nav navbar-left sub-nav-header">
                <li>
                    <a href="{{route('app/dashboard')}}"><p><i class="fa fa-lg fa-clock-o" aria-hidden="true"></i> Schedule</p></a>
                </li>
                 <li>
                  <a  href="{{route('app/job/result')}}"><p><i class="fa fa-lg fa-briefcase" aria-hidden="true"></i> Find Job</p></i></a>
                </li>
                <li>
                    <a href="#"><p><i class="fa fa-handshake-o" aria-hidden="true"></i> Job Offers</p></a>
                </li>
                <li>
                    <a href="#"><p><i class="fa fa-lg fa-bookmark-o" aria-hidden="true"></i> Saved Jobs</p></a>
                </li>
                <li>
                    <a href="#"><p><i class="fa fa-lg fa-credit-card" aria-hidden="true"></i> Wallet</p></a>
                </li>
                <li>
                    <a href="#"><p><i class="fa fa-lg fa-history" aria-hidden="true"></i> Logs</p></a>
                </li>
                <li>
                    <a href="{{url('/get/user/profile')}}"><p><i class="fa fa-lg fa-user-circle" aria-hidden="true"></i> Profile</p></a>
                </li>                              
              </ul>
          </div>
        </nav>
@yield('body')
<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 foot ">
                    <h1> JobPlus </h1>
                    <ul>
                        <li> <a href="#"><h1>#<b>Road To Graduation March 2017</b></h1></a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6 foot ">
               
                </div>
                <div class="col-lg-3  col-md-2 col-sm-4 col-xs-6 foot foot-social">
             <ul class="social">
                        <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6 foot">
                </div>
                <div class="col-lg-2  col-md-3 col-sm-6 col-xs-12 ">
                  
                </div>
            </div>
            <!--/.row--> 
        </div>
        <!--/.container--> 
    </div>
    <!--/.footer-->
    
    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> JobPlus. All right reserved. </p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul> 
            </div>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>
</body>
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/scripts.js"></script>
 @yield('js')
</html>