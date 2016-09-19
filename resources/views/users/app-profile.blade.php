@extends('masters.primary')

@section('body')
  <div class="container">
      <div class="row row-offcanvas row-offcanvas-left">
        <!-- sidebar -->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <ul class="nav nav-primary">
              <li><a href="{{route('app/dashboard')}}"><i class="fa fa-calendar nav-icon" aria-hidden="true"></i> Job+ Schedule</a></li>
              <hr>
              <li><a href="{{ route('app/job/search') }}"><i class="fa fa-suitcase nav-icon" aria-hidden="true"></i> Job+ Postings </a></li>
              <hr>
              <li><a href="#"><i class="fa fa-credit-card-alt nav-icon" aria-hidden="true"></i> Job+ Wallet </a></li>
              <hr>
              <li><a href="#"><i class="fa fa-bookmark nav-icon" aria-hidden="true"></i> Bookmarks</a></li> 
              <hr>
              <li><a href="#"><i class="fa fa-archive nav-icon" aria-hidden="true"></i> Logs</a></li>
              <hr>
              <li><a href="{{ route('user/profile',['id' => 'Auth::id()']) }}"><i class="fa fa-user nav-icon" aria-hidden="true"></i> Profile</a></li>                
            </ul>
        </div>
        <!-- main area -->
        <div class="col-xs-12 col-sm-9 dash-content">
          <div class="row">
    <div class="col-md-12 top-banner">
    <h1 class="head-text"><img class="banner" src="/img/background.jpg"/> </h1>
      <div class="col-md-6 col-md-offset-3 prof-head">
        <div class="img-box">
          <img class="dp" src="/img/dp.jpg">
        </div>
        <div class="rate">
        <span><i class="fa fa-star star" aria-hidden="true"></i></span>
        <span><i class="fa fa-star star" aria-hidden="true"></i></span>
        <span><i class="fa fa-star star" aria-hidden="true"></i></span>
        <span><i class="fa fa-star star" aria-hidden="true"></i></span>
        <span><i class="fa fa-star star" aria-hidden="true"></i></span>
        </div>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> Banawa, Cebu City</p>
        <h2>Kent Michael Baguion</h2>
        <div class="edit-tool">
          <p>Edit Profile</p>
        </div>
        </div>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="custom-card">
        <h3><i class="fa fa-user custom-card-icon" aria-hidden="true"></i> Biography</h3>
        <p>
          Nullam molestie, lectus ac congue lacinia, nisi ex dictum ligula, et ornare erat urna tempus odio. Nunc orci diam, pellentesque ac nulla eget, feugiat finibus neque. Aenean ornare ac orci id ultricies! Nulla at magna sit amet erat feugiat varius ut non mi. Fusce et ex laoreet; maximus felis sed, pretium leo. Ut enim erat, suscipit nec magna ac, dapibus efficitur mauris. Nullam nec ligula nec nibh volutpat porttitor vel ac nisi.
        </p>
      </div>
      <hr>
    </div>
    <div class="col-md-6">
      <div class="custom-card">
        <h3><i class="fa fa-graduation-cap custom-card-icon" aria-hidden="true"></i> Education</h3>
        <div class="card-edu">
          <h3>2011</h3>
          <p>Saint Peter's College of Ormoc</p>
          <p>Ormoc City</p>
        </div>
        <div class="card-edu">
          <h3>2012</h3>
          <p>University of San Jose Recoletos</p>
          <p>Cebu City</p>
        </div>
        <div class="card-edu">
          <h3>2017</h3>
          <p>University of San Jose Recoletos</p>
          <p>Cebu City</p>
        </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="custom-card">
        <h3><i class="fa fa-briefcase custom-card-icon" aria-hidden="true"></i> Experience</h3>
        <div class="card-edu">
          <h3>2011</h3>
          <p>Saint Peter's College of Ormoc</p>
        </div>
        <div class="card-edu">
          <h3>2012</h3>
          <p>University of San Jose Recoletos</p>
        </div>
        <div class="card-edu">
          <h3>2017</h3>
          <p>University of San Jose Recoletos</p>
        </div>
      </div>
    </div>

</div>
<div class="row">
<hr>
    <div class="col-md-12">
      <div class="custom-card">
        <h3><i class="fa fa-wrench custom-card-icon" aria-hidden="true"></i> Skills</h3>
      </div>
    </div>
    <div class="col-md-3 ">
      <div class="custom-card">
      <h3>Household</h3>
      <p><i class="fa fa-check" aria-hidden="true"></i> Housekeeper</p>
      <p><i class="fa fa-check" aria-hidden="true"></i> Cook</p>
      <p><i class="fa fa-check" aria-hidden="true"></i> Cook</p>
      </div>
    </div>
    <div class="col-md-3">
    <div class="custom-card">
      <h3>Construction</h3>
      <p><i class="fa fa-check" aria-hidden="true"></i> Housekeeper</p>
      <p><i class="fa fa-check" aria-hidden="true"></i> Cook</p>
      <p><i class="fa fa-check" aria-hidden="true"></i> Cook</p>
      </div>
    </div>
    <div class="col-md-3">
    <div class="custom-card">
      <h3>Personel</h3>
      <p><i class="fa fa-check" aria-hidden="true"></i> Housekeeper</p>
      <p><i class="fa fa-check" aria-hidden="true"></i> Cook</p>
      <p><i class="fa fa-check" aria-hidden="true"></i> Cook</p>
      </div>
    </div>
    <div class="col-md-3">
    <div class="custom-card">

      <h3>Maintenance</h3>
      <p><i class="fa fa-check" aria-hidden="true"></i> Housekeeper</p>
      <p><i class="fa fa-check" aria-hidden="true"></i> Cook</p>
      <p><i class="fa fa-check" aria-hidden="true"></i> Cook</p>
      </div>
    </div>
 </div>
  <br>
        </div>
    </div>
  </div>

  
@endsection