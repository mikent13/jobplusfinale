@extends('masters.AppPrimary')
@section('css')
    <link rel="stylesheet" href="/css/setup.css">
@endsection
@section('body')
<div class="container">
<h1>Welcome <b>{{ Auth::user()->username }}</b>! To get started, let's setup your profile first.</h1>
    <div class="row wiz-body">
        <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-wrench"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-map-marker"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-credit-card"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                    <div class="tab-header">
                        <h1>Basic Informations</h1>
                        <p>Kindly fill in the form below.</p>
                    </div>  
                        <div class="row">
                            <div class="col-sm-12 setup-header">
                              <h2>Upload Picture</h2>
                               <input type="file" name="picture" id="picture">
                             </div>
                        </div>
                        <hr>
                       <div class="row setup-header">
                       <h1>Personal Information</h1>
                            <div class="form-group-md col-sm-5 ">
                                 <h3>LastName</h3>
                                <input type="text" name="lastname" class="setup-textp" id="lastname" placeholder="LastName">
                            </div>
                            <div class="form-group form-group-md col-sm-5 setup-header">
                                <h3>FirstName</h3>
                                <input type="text" name="firstname"  class="setup-textp" id="firstname" placeholder="FirstName">
                            </div>
                        </div>
                         <div class="row setup-header">
                            <div class="form-group form-group-md col-sm-5">
                                 <h3>Contact</h3>
                                 <input type="text" name="mobile" class="setup-textp" id="mobile" placeholder="Mobile Number">
                            </div>
                         </div>
                         <div class="row setup-header">
                            <div class="form-group form-group-md col-sm-11">
                             <h3>About Me</h3>
                                 <textarea  class="setup-textp" style="width:100%;height:130px;" name="aboutme" form="setup" placeholder="Tell us about yourself"></textarea>
                            </div>
                         </div>
                         <hr>
                         <div class="row setup-header div-edu">
                         <h1>What school have you recently attended?</h1>
                         <p>(Highschool, College, University, etc.)</p>
                            <div class="form-group form-group-md col-sm-12">
                                 <h3>Attainment</h3>
                                 <select name="attainment" id="attainment" class="selectpicker" data-style="setup-selectp">
                                 @foreach($degree as $deg)
                                    <option class="setup-selectoption" value="{{ $deg->degree_id }}" >{{ $deg->name }}</option>
                                 @endforeach
                                 </select>
                            </div>
                            <div class="form-group form-group-md col-sm-6 setup-school">
                                 <h3>School</h3>
                                 <div id="divschool">
                                    <input type="text" class="setup-textp" name="school[]" id="school[]">
                                </div>
                             </div>
                            <div class="form-group form-group-md col-sm-2 ">
                                 <h3>From</h3>
                                 <div id="divstartyear">
                                 <select name="yearstart[]" id="year[]" class="selectpicker" data-style="setup-selectp">
                                 @for($x=2016; $x >1950; $x--)
                                    <option class="setup-selectoption" value="{{ $x }}" >{{ $x }}</option>
                                 @endfor
                                 </select>
                                   </div>
                             </div>
                            <div class="form-group form-group-md col-sm-2 setup-year">
                                 <h3>To (Year ended)</h3>
                                 <div id="divendyear">
                                 <select name="yearend[]" id="year[]" class="selectpicker" data-style="setup-selectp">
                                 @for($x=2025; $x >1950; $x--)
                                    <option class="setup-selectoption" value="{{ $x }}" >{{ $x }}</option>
                                 @endfor
                                 </select>
                                </div>
                             </div>
                             <div class="form-group form-group-md col-md-4 setup-school divdeg">
                                 <h3>Degree</h3>
                                 <div id="divschool">
                                 <select name="degree" id="degree" class="selectpicker" data-style="setup-selectp">
                                    <option class="setup-selectoption">Bachelor of Applied Science</option>
                                    <option class="setup-selectoption">Bachelor of Architecture</option>
                                    <option class="setup-selectoption">Bachelor of Arts</option>
                                    <option class="setup-selectoption">Bachelor of Business Administration</option>
                                    <option class="setup-selectoption">Bachelor of Commerce</option>
                                    <option class="setup-selectoption">Bachelor of Science</option>
                                 </select>
                                </div>
                             </div>
                             <div class="form-group form-group-md col-md-6 setup-school divmajor">
                                 <h3>Field of Study</h3>
                                 <div id="divschool">
                                    <input type="text" class="setup-textp" name="fieldstudy" id="fieldstudy" list="fieldstud">
                                    <datalist id="fieldstud">
                                        <option  value="Information Technology">
                                        <option  value="Computer Science">
                                    </datalist>
                                </div>
                             </div>
                        </div>
                         <hr>
                            <button type="button" class="btn btn-primary btn-info-full next-step">Next Step</button>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                    <div class="tab-header">
                        <h1>Work Experience and Skills</h1>
                        <p>Kindly fill in the form below.</p>
                    </div>
                    <div class="row setup-header">
                     <h1>What is your current/recent work?</h1>
                     <p>Your recent work or past experience.</p>
                     <div class="form-group form-group-md col-sm-5 ">
                         <h3>Employer</h3>
                        <input type="text" name="employer" class="setup-textp" id="employer" placeholder="Company name or Employer">
                    </div>
                    <div class="form-group form-group-md col-sm-2 ">
                     <h3>From</h3>
                         <select name="workyearstart" id="workyearstart" class="selectpicker" data-width:"fit" data-style="setup-selectp">
                         @for($x=2016; $x >1950; $x--)
                            <option class="setup-selectoption" value="{{ $x }}" >{{ $x }}</option>
                         @endfor
                         </select>
                    </div>
                    <div class="form-group form-group-md col-sm-2 ">
                        <h3>To ( Year Ended )</h3>
                     <select name="workyearend" id="workyearend" class="selectpicker" data-width:"fit" data-style="setup-selectp">
                         @for($x=2016; $x >1950; $x--)
                            <option class="setup-selectoption" value="{{ $x }}" >{{ $x }}</option>
                         @endfor
                         </select>
                    </div>
                    <div class="form-group form-group-md col-sm-5 ">
                         <h3>Job Type</h3>
                         <!-- <select name="jobtype"  id="asd" class="selectpicker" data-style="setup-selectp">
                         </select> -->
                          <select class="input-lg jtype jpinput"  data-style="setup-selectp">
                            </select>
                    </div>
                     <div class="form-group form-group-md col-sm-5 ">
                         <h3>Job Position</h3>
                        <input type="text" name="employer" class="setup-textp" id="employer" placeholder="Company name or Employer">
                    </div>
                     </div>
                     <hr>
                         <div class="row setup-header">
                               <h1>What are your skills? </h1>
                               <p>Select your designated skills below.</p>
                        <div class="col-md-3">
                            <h3>Housekeeping</h3>
                            <ul class="input-list">
                                 <li class="setup-skills">
                                    @foreach ($housekeeping as $house)
                                    <label>
                                      <input id="{{$house->name}}" class="skill-select" name="housekeeping[]" type="checkbox" value="{{$house->skill_id}}">
                                     {{$house->name}}
                                     </label>
                                     @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                          <h3>Construction</h3>
                            <ul class="input-list">
                                 <li class="setup-skills">
                                     @foreach ($construction as $cons)
                                     <label>
                                    <input id="{{$cons->name}}" name="construction[]" type="checkbox" value="{{$cons->skill_id}}">
                                    {{$cons->name}}
                                    </label>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                          <h3>Personel</h3>
                              <ul class="input-list">
                                 <li class="setup-skills">
                                  @foreach ($personel as $per)
                                  <label>
                                       <input id="{{$per->name}}" name="personel[]" type="checkbox" value="{{$per->skill_id}}">
                                    {{$per->name}}
                                    </label>
                             @endforeach
                                </li>
                            </ul>
                            </div>
                            <div class="col-md-3">
                          <h3>Maintenance</h3>
                            <ul class="input-list">
                                 <li class="setup-skills">
                                  @foreach ($maintenance as $main)
                                  <label>
                                    <input id="{{$main->name}}" value="{{$main->skill_id}}" name="maintenance[]" type="checkbox">
                                   {{$main->name}}
                                   </label>
                                 @endforeach
                                </li>
                            </ul>
                            </div>
                         </div>
                         <hr>
                        <ul class="list-inline ">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                    <div class="tab-header">
                        <h1>Location</h1>
                        <p>Locate your address</p>
                    </div>
                         <input id="pac-input" class="controls setup-mapinput" type="text" placeholder="Search Box">
                        <input id="clat" type="text" name="clat">
                        <input id="clong" type="text" name="clong">
                        <div id="map" style="width: auto;height: 700px;"></div>
                        <hr>
                        <ul class="list-inline ">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Next Step</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h2>Setup Payment Option</h2>
                        <p>Fill in your credentials.</p>
                        <hr>
                        <div class="col-sm-4 col-sm-offset-2">
                            <div class="form-group">
                                 <p>Account Number</p>
                                 <div id="divdegree">
                                    <input type="text" name="account" id="account">
                                 </div>
                            </div>
                         </div>
                         <div class="col-sm-4 setup-header">
                            <div class="form-group">
                                 <p>Key</p>
                                 <div id="divdegree">
                                    <input type="text" name="key" id="key">
                                 </div>
                            </div>
                         </div>
                         <hr>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
        </div>
    </section>
   </div>
</div>
@stop
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/scripts.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places"></script>
<script src="/js/setup.js"></script>

<!-- <script>
    var ctrdegree = 0;
    var ctryear = 0;
    var ctrschool = 0;
   
    function addEducation(divschool,divstartyear,divendyear){
              
              var start = document.createElement('div');
              var end = document.createElement('div');
              var schools = document.createElement('div');
             
              start.innerHTML = "<br><input type='text' name='yearstart[]' value=''>";
              end.innerHTML = "<br><input type='text' name='yearend[]' value=''>";
              schools.innerHTML ="<br><input type='text' name='school[]'value=''>";
             
              ctrschool++;
              ctrstart++;
              ctrend++;

              document.getElementById(divstartyear).appendChild(start);
              document.getElementById(divendyear).appendChild(end);
              document.getElementById(divschool).appendChild(schools);
             
              document.getElementById(divstartyear).value++;
              document.getElementById(divendyear).value++;
              document.getElementById(divschool).value++;
    }

   // var ctrwork =0;
   // var ctryears =0;
   // var ctremployer= 0;

   //     function addWork(divwork,divyears,divemployer){
              
   //            var work = document.createElement('div');
   //            var years = document.createElement('div');
   //            var employer = document.createElement('div');
           
   //            work.innerHTML = "<br><input type='text' name='work[]'value=''>";
   //            years.innerHTML ="<br><input type='text' name='years[]'value=''>";
   //            employer.innerHTML ="<br><input type='text' name='employer[]'value=''>";
   //             ctrwork++;
   //              ctryears++;
   //              ctremployer++;

   //            document.getElementById(divwork).appendChild(work);
   //            document.getElementById(divyears).appendChild(years);
   //            document.getElementById(divemployer).appendChild(employer);
   //            document.getElementById(divyear).value++;
   //            document.getElementById(divschool).value++;
   //            document.getElementById(divdegree).value++;
   //  }
</script>
 -->