@extends('masters.AppPrimary')
@section('css')
      <link rel="stylesheet" href="/bootstrap/css/profile.css">
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
  <h1>My Profile</h1>

<div class="col-md-8">
  <div class="profcontainer">
    <div class="profbody main">
      <div class="col-md-3 pic-container">
        <span class="pic-body">
          <img src="{{Auth::user()->profile->avatar}}" class="profile-pic">
        </span>
      </div>
      <div class="top-name col-md-offset-3">
      <button class="btn btn-md pull-right btn-tool" id="edit-name" ><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
        <h1 class="prof-name"></h1>
        <i class="fa fa-lg fa-map-marker" aria-hidden="true"></i><h4 class="prof-address"></h4>
          <div id="prof-skills" class="skills">
          
          </div>
      </div>
    </div>
  </div>

  <div class="profcontainer">
    <div class="profbody">
    <div class="row profinfo">
      <button class="btn btn-md pull-right btn-tool" id="edit-overview"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
      <h1>Overview</h1>
    </div>
      <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor risus. Donec sollicitudin molestie malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt.
      </p>
    </div>
  </div>

  <div class="profcontainer">
    <div class="profbody">
    <div class="row profinfo">
      <button class="btn btn-md pull-right btn-tool" id="edit-education"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
      <h1>Education</h1>
      <div class="education">
        <h3>Bachelor of Science in Information Technology</h3>
        <h4>University of San Jose-Recoletos</h4>
        <p>2013-2014</p>
        </div>
        <div class="education">
        <h3>Bachelor of Science in Computer Science</h3>
        <h4>University of San Carlos</h4>
        <p>2016 - Present</p>
        </div>
    </div>
    </div>
  </div>

  <div class="profcontainer">
    <div class="profbody">
      <div class="row profinfo">
      <button class="btn btn-md pull-right btn-tool" id="edit-work"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
      <h1>Work & Experience</h1>
      <h3>2013</h3>
      <h4>Dishwasher</h4>
      <p>in Bagzki's House</p>
      </div>
    </div>
  </div>

  <div class="profcontainer">
    <div class="profbody">
      <h1>Job+ Work History</h1>
      <p>No items to display.</p>
    </div>
  </div>
</div> <!-- End of col-md-8 -->

<div class="col-md-4">
  <div class="profcontainer">
    <div class="profbody">
    <div class="balance">
      <h1>Balance </h1>
      <h1><i class="fa fa-usd" aria-hidden="true"></i>30.12</h1>
      <button class="btn btn-lg btn-block btn-reload">Reload</button>
      <h2>View Transaction History</h2>
      </div>
    </div>
  </div>

<button class="btn btn-block btn-lg"><i class="fa fa-cog" aria-hidden="true"></i> Account Settings</button>
</div> <!-- End of col-md-4 -->

  <!-- Modal -->
  <div class="modal fade " id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-2x fa-times" aria-hidden="true"></i></button>
          <h1 class="modal-title"></h1>
        </div>
        <div class="modal-body">
        <div class="row col-md-12">
          <div class="form-group form-group-md col-md-6 ">
               <h3>Last Name</h3>
              <input type="text" name="lastname" class="setup-textp" id="lastname" placeholder="LastName">
              <li class="setup-skills">
                  <label>
                    <input id="skillbox" class="skill-select" name="housekeeping" type="checkbox" value="1">
                   Checkbox
                   </label>
              </li>
          </div>
          <div class="form-group form-group-md col-md-6 ">
               <h3>First Name</h3>
              <input type="text" name="firstname" class="setup-textp" id="firstname" placeholder="LastName">
          </div>
          </div>
          <div class="row col-md-12">

          </div>
        </div>
          <button type="button" id="name-save" class="btn btn-lg " data-dismiss="modal">Save</button>
          <button type="button" class="btn btn-lg " data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>

</div>
  
@endsection

@section('js')
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/profiles.js"></script>
@endsection