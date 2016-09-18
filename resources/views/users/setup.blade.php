@extends('masters.header')
@section('css')
    <link rel="stylesheet" href="/css/setup.css">
@endsection
@section('content')
<div class="container">
<panel-body><h1>Complete your profile.</h1></panel>
	<div class="row">
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

            <form id="setup" role="form" action="{{route('save')}}" method="post">
            {{csrf_field()}}
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h2>Basic Informations</h2>
                        <p>Kindly fill up the form below.</p>
                        <hr>
                        <div class="row">
                        <h3>Upload Picture</h3>
                            <div class="col-sm-4 col-sm-offset-2">
                               <input type="file" name="picture" id="picture">
                             </div>
                        </div>
                        <hr>
                       <div class="row">
                        <h3>Name</h3>
                        <div class="col-sm-4 col-sm-offset-2">
                            <div class="form-group">
                            <p>Last Name</p>
                                <input type="text" name="lastname" class="form-LastName form-control" id="lastname">
                            </div>
                        </div>
                        <div class="col-sm-4 ">
                            <div class="form-group">
                            <p>First Name</p>
                                <input type="text" name="firstname"  class="form-firstname form-control" id="firstname">
                            </div>
                        </div>
                        </div>
                         <hr>
                         <div class="row">
                         <h3>Contact</h3>
                         <div class="col-sm-4 col-sm-offset-2">
                            <div class="form-group">
                                 <p>Mobile Number</p>
                                 <input type="text" name="mobile" class="form-mobile form-control" id="mobile">
                            </div>
                         </div>
                         </div>
                         <hr>
                         <div class="row">
                         <h3>About Me</h3>
                         <div class="col-sm-8 col-sm-offset-2">
                            <div class="form-group ">
                                 <p>Biography</p>
                                 <textarea style="width:100%;height:130px;" name="aboutme" form="setup"></textarea>
                            </div>
                         </div>
                         </div>
                         <hr>
                         <div class="row">
                         <h3>Educational Background</h3>
                         <div class="col-sm-2 col-sm-offset-2">
                            <div class="form-group">
                                 <p>Degree</p>
                                 <div id="divdegree">
                                    <input type="text" name="degree[]" id="degree">
                                 </div>
                            </div>
                         </div>
                           <div class="col-sm-2 col-sm-offset-1">
                            <div class="form-group">
                                 <p>Year</p>
                                 <div id="divyear">
                                   <input type="text" name="year[]" id="year">
                                   </div>
                                 </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="form-group">
                                 <p>School</p>
                                 <div id="divschool">
                                    <input type="text" name="school[]" id="school"></div>
                                 </div>
                            </div>
                         </div>
                           <input type="button" value="Add Education" onClick="addEducation('divschool','divyear','divdegree');">
                         <hr>
                        <ul class="list-inline ">
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Next Step</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <h3>Skills and Experience</h3>
                        <p></p>
                        <hr>
                        <div class="row">
                         <h3>Work Experience</h3>
                         <div class="col-sm-2 col-sm-offset-2">
                            <div class="form-group">
                                 <p>Work</p>
                                 <div id="divwork">
                                    <input type="text" name="work[]" id="work">
                                 </div>
                            </div>
                         </div>
                           <div class="col-sm-2 col-sm-offset-1">
                            <div class="form-group">
                                 <p>Year</p>
                                 <div id="divyears">
                                   <input type="text" name="work[]" id="work">
                                   </div>
                                 </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="form-group">
                                 <p>Employer</p>
                                 <div id="divemployer">
                                    <input type="text" name="employer[]" id="employer">
                                    </div>
                                 </div>
                            </div>
                         </div>
                          <input type="button" value="Add Work" onClick="addWork('divwork','divyears','divemployer');">
                         <hr>
                         <div class="row">
                                   <h3>Categories and Skills </h3>
                              <div class="form-box">
                                <div class="col-sm-12">
                                <div class="panel">
                                <div class="panel-heading"><h3>Housekeeping</h3></div>
                                <div class="panel-body">
                                    <ul class="input-list">
                                         <li class="setup-skills">
                                        <div class="pure-checkbox">
                                            <input id="housekeeping[]" name="housekeeping[]" type="checkbox">
                                            <tag></tag>
                                        </div>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                <div class="panel-heading"><h3>Construction</h3></div>
                                <div class="panel-body">
                                    <ul class="input-list">
                                         <li class="setup-skills">
                                        <div class="pure-checkbox">
                                            <tag for="construction[]">Char</tag>
                                            <input id="construction[]" name="construction[]" type="checkbox">
                                            <tag></tag>
                                        </div>
                                        </li>
                                    </ul>
                                </div>
                                 <hr>
                                <div class="panel-heading"><h3>Personel</h3></div>
                                <div class="panel-body">
                                    <ul class="input-list">
                                         <li class="setup-skills">
                                        <div class="pure-checkbox">
                                            <input id="con[]" name="personel[]" type="checkbox">
                                            <tag></tag>
                                        </div>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                                 <div class="panel-heading"><h3>Maintenance</h3></div>
                                <div class="panel-body">
                                    <ul class="input-list">
                                         <li class="setup-skills">
                                        <div class="pure-checkbox">
                                            <input id="maintenance[]" name="maintenance[]" type="checkbox">
                                            <tag></tag>
                                        </div>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                               
                               </div>
                            </div>
                         </div>
                        <ul class="list-inline ">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>Location</h3>
                        <p>locate your address</p>
                        <hr>
                        <ul class="list-inline ">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Next Step</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Setup Payment Option</h3>
                        <p>Fill in your credentials.</p>
                        <hr>
                        <div class="col-sm-4 col-sm-offset-2">
                            <div class="form-group">
                                 <p>Account Number</p>
                                 <div id="divdegree">
                                    <input type="text" name="degree[]" id="degree">
                                 </div>
                            </div>
                         </div>
                         <div class="col-sm-4 col-sm-offset-1">
                            <div class="form-group">
                                 <p>Key</p>
                                 <div id="divdegree">
                                    <input type="text" name="degree[]" id="degree">
                                 </div>
                            </div>
                         </div>
                         <hr>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </section>
   </div>
</div>
@stop
<script>

    var ctrdegree = 0;
    var ctryear = 0;
    var ctrschool = 0;
   
    function addEducation(divschool,divyear,divdegree){
              
              var years = document.createElement('div');
              var schools = document.createElement('div');
              var degrees = document.createElement('div');
           
              years.innerHTML = "<br><input type='text' name='year[]'>";
              schools.innerHTML ="<br><input type='text' name='school[]'>";
              degrees.innerHTML ="<br><input type='text' name='degree[]'>";
              ctrschool++;
              ctryear++;
              ctrdegree++;

              document.getElementById(divyear).appendChild(years);
              document.getElementById(divschool).appendChild(schools);
              document.getElementById(divdegree).appendChild(degrees);
    }

   var ctrwork =0;
   var ctryears =0;
var ctremployer= 0;

       function addWork(divwork,divyears,divemployer){
              
              var work = document.createElement('div');
              var years = document.createElement('div');
              var employer = document.createElement('div');
           
              work.innerHTML = "<br><input type='text' name='work[]'>";
              years.innerHTML ="<br><input type='text' name='years[]'>";
              employer.innerHTML ="<br><input type='text' name='employer[]'>";
               ctrwork++;
                ctryears++;
                ctremployer++;

              document.getElementById(divwork).appendChild(work);
              document.getElementById(divyears).appendChild(years);
              document.getElementById(divemployer).appendChild(employer);
    }


</script>
