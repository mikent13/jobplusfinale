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
        <link href="/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
        
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
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
                    <a href="#"><p><i class="fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"></i></p></a>
                </li>
                <li>
                    <a href="#"><p><i class="fa fa-bell-o fa-lg fa-fw" aria-hidden="true"></i></p></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle img-avatar" data-toggle="dropdown">
                    <img src="{{Auth::user()->profile->avatar}}" style="border-radius: 50%; height: 30px; width: 30px; margin-right:5px;">{{Auth::user()->profile->lname}}, {{Auth::user()->profile->fname}}  <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
                  </a>
                   <div class="dropdown-content-main">
                  <ul>
                    <p><a href="#">Manage Profile</a></p>
                    <p><a href="#">Sign Out</a></p>
                  </ul>
                  </div>
                </li>               
              </ul>
          </div>
        </div>
        <nav class="navbar navbar-default sub-nav " role="navigation">
          <div class="container">
              <ul class="nav navbar-nav navbar-left sub-nav-header">
                <li>
                    <a href="{{route('app/dashboard')}}"><p>Schedule</p></a>
                </li>
                 <li>
                  <a  href="{{route('app/job/result')}}">Find Job</i></a>
                </li>
                <li>
                    <a href="#"><p>Job Offers</p></a>
                </li>
                <li>
                    <a href="#"><p>Saved Jobs</p></a>
                </li>
                
                <li>
                    <a href="#"><p>Wallet</p></a>
                </li>
                <li>
                    <a href="#"><p>Logs</p></a>
                </li>               
              </ul>
          </div>
        </nav>
@yield('body')
</body>
<script src="/js/jquery-1.11.1.min.js"></script>
 <script src="/bootstrap/js/bootstrap.min.js"></script>
 <script src="/js/scripts.js"></script>
 @yield('js')
</html>