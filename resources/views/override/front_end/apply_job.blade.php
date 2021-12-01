<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Connecting2Work HR Solutions | HR consultancy in Kerala Trivandrum, Cochin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/vendor/crudbooster/assets/logo_crudbooster.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 14px Source Sans Pro,Helvetica Neue,Helvetica,Arial, sans-serif;
    line-height: 1.42857143;
    color: #333;
  }
  p {
  font-size: 16px;
  }
  .margin {
    margin-bottom: 45px;
    color: #ffffff;
  }
  .bg-1 { 
    background-color: #1abc9c; /* Green */
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    
  }
  .bg-2 { 
      background-color: #474e5d; /* Dark Blue */
      color: #ffffff;
  }
  .bg-3 { 
      background-color: #ffffff; /* White */
      color: #555555;
  }
  .bg-4 { 
      background-color: #2f2f2f; /* Black Gray */
      color: #fff;
  }
  .container-fluid {
      padding-top: 70px;
      padding-bottom: 70px;
      padding-right: 15px;
      padding-left: 15px;
  }
  .navbar {
      padding-top: 15px;
      padding-bottom: 15px;
      border: 0;
      border-radius: 0;
      margin-bottom: 0;
      font-size: 12px;
      letter-spacing: 5px;
  }
  .navbar-nav  li a:hover {
      color: #1abc9c !important;
  }
  .logo-img
{
  width: 80%;
    margin-top: -7px;
    margin-left: 10px;
}
.padding0
{
  padding: 0px
}
.footer-custom
{
  padding: 24px;
    position: fixed;
    width: 100%;
    bottom: 0px;
}
.margin0
{
  margin:0px;
}
.heading-login{
  font-size: 33px;
    text-transform: uppercase;
}
.panel-login>.panel-heading a.active {
    color: #029f5b;
    font-size: 19px !important;
}
.panel-login>.panel-heading a
{
  font-size: 17px !important;
  line-height: 30px;
}
.margin-top30{
  margin-top: 30px;
}
.margin-top15
{
  margin-top: 15px;
}
.align-center
{
  text-align: center;
}
.panel-title>a{
 cursor: pointer;
 font-weight: 700;
}
.padding-top30
{
  padding-top: 30px;
}
.form-group .title{
  font-weight: 600;
    line-height: 22px;
}
.panel-default>.panel-heading {
    color: #333;
    background-color: #ebeaea;
    border-color: #ddd;
}
.small-btn-margin
{
  margin: 3px 6px 3px 0px;
}
.experiance-section{
  margin: 15px 30px 15px 30px;
    padding: 7px;
    border: 1px solid #ccc;
    margin-top: 25px;
}

.list-data{
  border: 1px solid #ccc;
    padding-bottom: 5px;
    margin-bottom: 3px;
    background: aliceblue;
    border-radius: 10px;
    cursor: pointer
}
  </style>
  @include('override.candidates._styles')
  @include('override.candidates._scripts')
</head>
<body class="bg-1">

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
       <a class="navbar-brand padding0" href="">
      <img title="C2W" src="/logo.png" class="logo-img">
      </a>
    </div>    
  </div>
</nav>

<!-- First Container -->
<div class="container-fluid bg-1 text-center padding-top30">
  <h3 class="margin heading-login">Apply Job</h3>
 
    <div class="panel panel-default jo-panel">
      <div class="panel-body">
        <!-- ** -->
        <form class="form-horizontal job_form" method="post" id="form" enctype="multipart/form-data" action="/apply-job">
          @if(session()->has('job_message.level'))
    <div class="alert alert-{{ session('job_message.level') }} alert-dismissible"> 
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{!! session('job_message.content') !!}</strong>
    </div>
        @endif
          <div class="panel-group" id="accordion">
            <div class='parse_msg'></div>
            <div class="panel panel-default">
             <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                <h4 class="panel-title">
                  <a>PERSONAL DETAILS</a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse in">
                 <?php $jobOrderName = \DB::table('job_orders')->find($_REQUEST['joborderid'])->title; 
                 ?>
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="job_order_id" id="job_order_id"  value="{{$_REQUEST['joborderid']}}">
                    <br/>
                    <div class="col-md-2 title">
                      Job Title
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="job_title" id="job_title" readonly='' value="{{ $jobOrderName }}">
                    </div>
                    
                  </div>
                   <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <div class="col-md-2 title">
                      First Name
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" name="first_name" id="first_name" required="" value="{{ old('first_name') }}">
                      <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    </div>
                     <div class="col-md-2 title">
                      Last Name
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3"><input type="text" class="form-control" name="last_name" id="last_name" required value="{{ old('last_name') }}" >
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    </div>
                  </div>
                  <!-- <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                   
                  </div> -->
                  <div class="form-group">
                    <div class="col-md-2 title">
                      Date of Birth
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <input type='date' class="form-control" name="birth_date" id="birth_date" required/>
                    </div>
                    <div class="col-md-2 title">Gender
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <select name="gender" id="gender" class="form-control">
                        <option value="">--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-2 title">
                      Primary Email
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" name="primary_email" id="primary_email" required>
                      <div class="text-danger"><p class="msg"></p></div>
                    </div>
                    <div class="col-md-2 title">Secondary Email</div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" name="secondary_email" id="secondary_email" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-2 title">
                      Primary Phone
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" name="primary_phone" id="primary_phone" required="">
                    </div>
                    <div class="col-md-2 title">Secondary Phone</div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" name="secondary_phone" id="secondary_phone">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-2 title">
                      Address
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" name="address" id="address" required  >
                    </div>
                    <div class="col-md-2 title">
                      Country
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <select name="country_id" id="country_id" class="form-control multi-select-select2" required onchange="listStates(this.value)">

                        @foreach($countries as  $country)
                        <option value="{{ $country->id }}"{{('India'== $country->name) ?'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-2 title">
                      State
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <select name="state_id" id="state_id" class="form-control multi-select-select2" required onchange="listCities(this.value)">
                        <option value="">--</option>
                      </select>
                    </div>
                    <div class="col-md-2 title">
                      City
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <select name="city_id" id="city_id" class="form-control multi-select-select2" required>
                        <option value="">--</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-2 title">Postal Code</div>
                    <div class="col-md-3">
                      <select name="postal_code" id="postal_code" class="form-control multi-select-select2">
                        <option value="">--</option>
                        @foreach($postal_codes as  $postal_code)
                        <option value="{{ $postal_code->id }}">{{ $postal_code->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-2 title">
                      Current City
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <div class="col-md-3">
                      <select name="current_city" id="current_city" class="form-control multi-select-select2" required>
                        <option value="">--</option>
                        @foreach($cities as  $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-md-2 title">Religion</div>
                    <div class="col-md-3">
                      <input type="text" name="religion" id="religion" class="form-control" >
                    </div>
                      <div class="col-md-2 title">Date Available</div>
                    <div class="col-md-3">
                      <input type="date" name="date_available" id="date_available" class="form-control" value='' >
                    </div>
                  </div>
                 <div class="form-group">
                    <div class="col-md-2 title">Website/Professional Profile </div>
                    <div class="col-md-3">
                      <input type="text" name="website" id="website" class="form-control" >
                    </div>
                  </div>

          </div></div>
            <div class="panel panel-default">
              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                <h4 class="panel-title">
                  <a>PROFESSIONAL</a>
                </h4>
              </div>
              <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="col-md-2 title">
                      Head Line
                    </div>
                    <div class="col-md-8">
                      <input type="text" name="head_line" id="head_line" class="form-control">
                    </div>

                  </div>

                  <div class="form-group">
                    <div class="col-md-2 title">
                      Total Experience
                      <span class='text-danger' title='This field is required'>*</span>
                    </div>
                    <input type="hidden" name="experience_years" id="experience_years" class="form-control" value="">
                    <input type="hidden" name="experience_months" id="experience_months" class="form-control" value="">
                    <div class="col-md-8">
                      <div class="dropdown">
                        <button class="btn btn-experience form-control" id="experience" onclick="getExpVal()" type="button" data-toggle="dropdown" value=" ">Total Experience


                        </button>

                        <ul class="dropdown-menu col-md-12">
                          <span class="pull-right">
                            <button type="button"class="btn btn-danger btn-sm small-btn-margin" data-toggle="dropdown">
                              <span class="glyphicon glyphicon-remove-sign"></span> Close
                            </button>
                          </span>
                          <br/>


                         {{-- <div class="row experiance-section">
                          <div class="col-md-6 btn-scroll">
                            <li><h4>Year</h4></li>
                            @for($x = 0; $x <= 50; $x++)  
                            <li>
                              <div class="radio">
                                <label><input type="radio" value="{{$x}}" name="year" onclick="getExpVal()">{{$x}}</label>
                              </div></li>
                              @endfor
                            </div>
                            <div class="col-md-6 btn-scroll">
                              <li><b><h4>Month</h4></b></li>

                              @for($x = 0; $x <= 11; $x++) 
                              <li>
                                <div class="radio">
                                  <label><input type="radio" value="{{$x}}" name="month" onclick="getExpVal()">{{$x}}</label>
                                </div></li>
                                @endfor
                              </div>
                          </div> --}}

                           <div class="row experiance-section">
                           <div class="col-md-12">
                            <h4>Year</h4>
                             <ul class="list-inline margin0">
                              @for($x = 0; $x <= 50; $x++)  
                              <li class="list-data">
                               <div class="radio">
                                <label><input type="radio" value="{{$x}}" name="year" onclick="getExpVal()">{{$x}}</label>
                              </div>
                              </li>
                              @endfor
                             </ul>
                            <h4>Month</h4>
                             <ul class="list-inline margin0">
                              @for($x = 0; $x <= 11; $x++) 
                              <li class="list-data">
                                <div class="radio">
                                  <label><input type="radio" value="{{$x}}" name="month" onclick="getExpVal()">{{$x}}</label>
                                </div>
                              </li>
                              @endfor
                             </ul>
                            </div>  
                          </div>
                              <p class="pull-right">
                                <a class="btn btn-danger btn-sm small-btn-margin" id="experience_remove">
                                  <span class="glyphicon glyphicon-remove"></span> Clear Selection
                                </a>
                              </p>

                            </ul>
                          </div></div>



                        </div>

                        <div class="form-group">
                          <div class="col-md-2 title">Current CTC
                            <span class='text-danger' title='This field is required'>*</span>
                          </div>
                          <div class="col-md-3">
                            <input type="number" name="current_ctc" id="current_ctc" placeholder="in lakhs" class="form-control" required  step="0.01" >
                          </div>
                          <div class="col-md-2 title">Expected CTC
                            <span class='text-danger' title='This field is required'>*</span>
                          </div>
                          <div class="col-md-3">
                            <input type="number" name="expected_ctc" id="expected_ctc" placeholder="in lakhs" class="form-control" required step="0.01">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-2 title">First Job Start Date</div>
                          <div class="col-md-3">
                            <input type="date" name="first_job_start_date" id="first_job_start_date" class="form-control">
                          </div>
                          <div class="col-md-2 title">
                            Can Relocate 
                            &nbsp; <input type ="checkbox" name="can_relocate" value="1">
                          </div>
                          <div class="col-md-1 title">Preferred City</div>
                          <div class="col-md-2">
                            <select name="preferred_city" id="preferred_city" class="form-control multi-select-select2">
                              <option value="">--</option>
                              @foreach($cities as  $city)
                              <option value="{{ $city->id }}">{{ $city->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-2 title">Current Employer</div>
                          <div class="col-md-3">
                            <input type="text" name="current_employer" id="current_employer" class="form-control">
                          </div>
                          <div class="col-md-2 title">Current Designation</div>
                          <div class="col-md-3">
                            <input type="text" name="current_designation" id="current_designation" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                      <h4 class="panel-title">
                        <a>PROFESSIONAL SKILLS</a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="form-group">
                          <div class="col-md-2 title">General Skills
                            <span class='text-danger' title='This field is required'>*</span>
                          </div>
                          <div class="col-md-3 select2-container-div" >
                            <select name="general_skill_id[]" id="general_skill_id"  multiple="multiple" class="form-control multi-select-select2" required="">
                              @foreach($general_skills as  $general_skill)
                              <option value="{{ $general_skill->id }}">{{ $general_skill->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2 title">Industry
                            <span class='text-danger' title='This field is required'>*</span>
                          </div>
                          <div class="col-md-3 select2-container-div" >
                            <select name="industry_id[]" id="industry_id" multiple="multiple"  class="form-control multi-select-select2" required="">
                              @foreach($industries as  $industry)
                              <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-2 title">Functional Area
                            <span class='text-danger' title='This field is required'>*</span>
                          </div>
                          <div class="col-md-3 select2-container-div" >
                            <select name="functional_area_id[]" multiple="multiple" id="functional_area_id" class="form-control multi-select-select2" onchange="listFunctionalAreaRolesAndSkills(this.value)" required="">
                              @foreach($functional_areas as  $functional_area)
                              <option value="{{ $functional_area->id }}">{{ $functional_area->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2 title">Functional Roles
                            <span class='text-danger' title='This field is required'>*</span>
                          </div>
                          <div class="col-md-3 select2-container-div" >
                            <select name="functional_area_role_id[]" id="functional_area_role_id" multiple="multiple"  class="form-control multi-select-select2" required="">
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-2 title">Functional Skills
                            <span class='text-danger' title='This field is required'>*</span>
                          </div>
                          <div class="col-md-3 select2-container-div" >
                            <select name="functional_area_skill_id[]" id="functional_area_skill_id" multiple="multiple"  class="form-control multi-select-select2" required="">
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                      <h4 class="panel-title">
                        <a>EDUCATIONAL DETAILS</a>
                      </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="form-group">
                          <div class="col-md-2 title">
                            Highest Qualification
                            <span class='text-danger' title='This field is required'>*</span>
                          </div>
                          <div class="col-md-3">
                            <select name="highest_qualification" id="highest_qualification" class="form-control" required>
                              <option value="">--</option>
                              @foreach($qualifications as  $qualification)
                              <option value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2">
                            <button type="button" class="btn btn-xs btn-primary pull-right btn-clone-qual-div" title="Add">
                              <i class="fa fa-plus"></i>
                            </button>
                          </div>
                        </div>                
                        <div class="form-group candidate-qual-div-class" id = "candidate-qual-div">
                          <div class="col-md-2">
                            <select name="qualification_level_id[]" class="form-control qualification_level_id" required="">
                              <!-- onchange="listQualifications(this.value)" -->
                              <option value=""> Select Qualification Level </option>
                              @foreach($qualification_levels as $qualification_level)
                              <option value="{{$qualification_level->id}}">
                                {{$qualification_level->qual_level}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2">
                            <select name="qualification_id[]" class="form-control qualification_id" required="">
                              <option value=""> Qualification </option>
                            </select>
                          </div>
                          <div class="col-md-2 title">
                            <span class="">
                              Is Completed 
                              &nbsp; <input type ="checkbox" name="is_completed[]" value="1" class="is_completed">
                            </span>
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="completed_year[]" class="form-control completed_year" placeholder="Year" required="">
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="score[]" class="form-control score" placeholder="Score" required="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                      <h4 class="panel-title">
                        <a>UPLOADS</a>
                      </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="form-group">
                          <div class="col-md-2 title">Photo</div>
                          <div class="col-md-3">
                            <input type="file"  name="photo_url" id="photo_url" class="form-control">
                          </div>

                <div class="col-md-2 title">
                 Resume
                 <span class='text-danger' title='This field is required'>*</span>
               </div>
               <div class="col-md-3">
                <input type="file" name="resume" class="form-control" id="resume_url" value="" required="">
              </div>
           
                    <!-- <div class="col-md-2 title">
                      Resume
                    
                    </div>
                    <div class="col-md-3">
                      <input type="file" name="resume_url" id="resume_url" class="form-control">
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
                 <div class="form-group">
              <div class="panel-body">
              
                  <div class="col-md-12 align-center">
                    <input type="submit" id="submit-candidate-personal" name="submit-candidate-personal" value="Apply" class="btn btn-success">
                  </div>
                
              </div>
            </div>
             
            </div>
          
        </form>
      </div>
    </div>
 
  <h3></h3>
</div>



<!-- Footer -->
<footer class="container-fluid bg-4 text-center footer-custom">
  <p class="margin0">Copyright © 2018. All Rights Reserved <a href="">.Powered by C2W </a></p> 
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('.multi-select-select2').select2();
      var indian_country_id= $('#country_id').val();
    $( "#experience_remove" ).click(function() {
      var buttonValue= 'Total Experience';
      $('#experience').html(buttonValue);
      $('input[name="year"]').prop('checked', false);
      $('input[name="month"]').prop('checked', false);
    });

    $("#country_id").val(indian_country_id).trigger('change.select2');
    
    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
     });
    
      $(document).on("change",".qualification_level_id",function () {
        var select = $(this).parent().next('div').find('.qualification_id');
          select.empty();
          select.append("<option value=''>--</option>");
          $.get('/apply-job', {
              qualification_level_id: $(this).val(),
              current_action: 'list_qualifications',
          }, function(_dataQualifications) {
        $.each(_dataQualifications,function(key, value) {
                  select.append('<option value=' + value.id + '>' + value.qualification + '</option>');
              });
          });     
      });
      
    $(document).on("click",".btn-clone-qual-div",function () {
      candidateQualDiv =  $('#candidate-qual-div').clone()
                              .find("input, select").val("").attr("checked",false)
                              .end();
            candidateQualDiv.find(".is_completed").val('1');
             candidateQualDiv.append("<button type='button' class='remove-qual-div btn btn-xs btn-danger' title='Remove'><i class='fa fa-trash'></i></button>");
      $('.candidate-qual-div-class').last().append().after(candidateQualDiv);
      });

      $(document).on("click",".remove-qual-div",function(){
        $(this).parent().remove();
      });
       jQuery.fn.preventDoubleSubmission = function() {

      var last_clicked, time_since_clicked;

      $(this).bind('submit', function(event){

      if(last_clicked) 
        time_since_clicked = event.timeStamp - last_clicked;

      last_clicked = event.timeStamp;

      if(time_since_clicked < 2000)
        return false;

       return true;
        });   
        };
      $('#submit-candidate-personal').click(function() { 
        $("#form").find('.validate-error').removeClass('validate-error');
        $('#form').preventDoubleSubmission();
        if($.trim($("#first_name").val()) == ''){
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          $("#form").find("#first_name").addClass('validate-error').focus();
          return false;
        }
        if(!$.trim($("#last_name").val())){
          $("#form").find("#last_name").addClass('validate-error').focus();
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#birth_date").val())){
          $("#form").find("#birth_date").addClass('validate-error').focus();
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#gender").val())){
          $("#form").find("#gender").addClass('validate-error').focus();
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!(validateEmail($("#primary_email").val()))) {
          $('.msg').html(' ');
          $("#form").find("#primary_email").addClass('validate-error').focus();
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
         if( $("#secondary_email").val() && !validateEmail($("#secondary_email").val()) ) {
          $("#form").find("#secondary_email").addClass('validate-error').focus();
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!validatePhone($("#primary_phone").val())) {
          if(!validatePhone($("#primary_phone").val())) {
            $("#form").find("#primary_phone").addClass('validate-error').focus();
            if($('#collapse1').attr("class") == 'panel-collapse collapse'){
              $('#collapse1').parent().find('.panel-heading a').click();
            }
          }
          return false;
        }
        if(($("#secondary_phone").val()) && !validatePhone($("#secondary_phone").val())) {
          $("#form").find("#secondary_phone").addClass('validate-error').focus();
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#address").val())){
          $("#form").find("#address").addClass('validate-error').focus();
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#country_id").val())){
          $("#country_id").next(".select2").addClass('validate-error').trigger('focus.select2');
          /*$(this).find("#country_id").addClass('validate-error').focus();*/
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#state_id").val())){
          $("#state_id").next(".select2").addClass('validate-error').trigger('focus.select2');
          /*$(this).find("#state_id").addClass('validate-error').focus();*/
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#city_id").val())){
          $("#city_id").next(".select2").addClass('validate-error').trigger('focus.select2');
          /*$(this).find("#city_id").addClass('validate-error').focus();*/
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#current_city").val())){
          /*$(this).find("#current_city").addClass('validate-error').focus();*/
        $("#current_city").next(".select2").addClass('validate-error').trigger('focus.select2');
          if($('#collapse1').attr("class") == 'panel-collapse collapse'){
            $('#collapse1').parent().find('.panel-heading a').click();
          }
          return false;
        }
        
        /*if(!$.trim($("#experience_years").val())){
          $(this).find("#experience_years").addClass('validate-error').focus();
          if($('#collapse2').attr("class") == 'panel-collapse collapse'){
            $('#collapse2').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if((!$.trim($("#experience_months").val()) || $("#experience_months").val() > 11) ) {
          $(this).find("#experience_months").addClass('validate-error').focus();
          if($('#collapse2').attr("class") == 'panel-collapse collapse'){
            $('#collapse2').parent().find('.panel-heading a').click();
          }
          return false;
        }*/
        if(!$.trim($("#experience").val())) {
          $("#form").find("#experience").addClass('validate-error').focus();
          if($('#collapse2').attr("class") == 'panel-collapse collapse'){
            $('#collapse2').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#current_ctc").val())){
          $("#form").find("#current_ctc").addClass('validate-error').focus();
          if($('#collapse2').attr("class") == 'panel-collapse collapse'){
            $('#collapse2').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#expected_ctc").val())){
          $("#form").find("#expected_ctc").addClass('validate-error').focus();
          if($('#collapse2').attr("class") == 'panel-collapse collapse'){
            $('#collapse2').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#general_skill_id").val())){
          $("#general_skill_id").next(".select2").addClass('validate-error').focus();
          if($('#collapse3').attr("class") == 'panel-collapse collapse'){
            $('#collapse3').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#industry_id").val())){
          $("#industry_id").next(".select2").addClass('validate-error').focus();
          if($('#collapse3').attr("class") == 'panel-collapse collapse'){
            $('#collapse3').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#functional_area_id").val())){
          $("#functional_area_id").next(".select2").addClass('validate-error').focus();
          if($('#collapse3').attr("class") == 'panel-collapse collapse'){
            $('#collapse3').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#functional_area_role_id").val())){
          $("#functional_area_role_id").next(".select2").addClass('validate-error').focus();
          if($('#collapse3').attr("class") == 'panel-collapse collapse'){
            $('#collapse3').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#functional_area_skill_id").val())){
          $("#functional_area_skill_id").next(".select2").addClass('validate-error').focus();
          if($('#collapse3').attr("class") == 'panel-collapse collapse'){
            $('#collapse3').parent().find('.panel-heading a').click();
          }
          return false;
        }
        if(!$.trim($("#highest_qualification").val())){
          $('#form').find("#highest_qualification").addClass('validate-error').focus();
          if($('#collapse4').attr("class") == 'panel-collapse collapse'){
            $('#collapse4').parent().find('.panel-heading a').click();
          }
          return false;
        }
        var validator = true;

        $(".qualification_level_id").each(function() {
          if(!$(this).val()){
            $(this).addClass('validate-error').focus();
            validator = false;
            return false;
          }
        });

        $(".qualification_id").each(function() {
          if(!$(this).val()){
            $(this).addClass('validate-error').focus();
            validator = false;
            return false;
          }
        });

        $(".completed_year").each(function() {
          if(!$(this).val()){
            $(this).addClass('validate-error').focus();
            validator = false;
            return false;
          }
        });

        $(".score").each(function() {
          if(!$(this).val()){
            $(this).addClass('validate-error').focus();
            validator = false;
            return false;
          }
        });

      // if(!$("#photo_url").val()){
      //  $(this).find("#photo_url").addClass('validate-error').focus();
      //  return false;
      // }
      if(!$.trim($("#resume_url").val())){
         $("#form").find("#resume_url").addClass('validate-error').focus();
          if($('#collapse5').attr("class") == 'panel-collapse collapse'){
              $('#collapse5').parent().find('.panel-heading a').click();
            }
          return false;
        }
      if($("#resume_url").val()) {
        myfile= $('#resume_url' ).val();
        var ext = myfile.split('.').pop();
        if(!(ext=="docx" || ext=="pdf" || ext=="doc" || ext=="rtf")){
          alert("Please Upload Docx, Doc, rtf Or Pdf");
          $("#form").find("#resume_url").addClass('validate-error').focus();
          if($('#collapse5').attr("class") == 'panel-collapse collapse'){
              $('#collapse5').parent().find('.panel-heading a').click();
            }
          return false;
        }
      }
      if(!validator) {
        if($('#collapse4').attr("class") == 'panel-collapse collapse'){
            $('#collapse4').parent().find('.panel-heading a').click();
          }
        return false;
      } 
  });
  });

function getExpVal()
{
    var year=$('input[name=year]:checked').val();
    var month=$('input[name=month]:checked').val();
    if(year!== undefined){
     var buttonValue=year+' years';
      $('#experience').html(buttonValue);
      $('#experience_years').val(year);
   }
  if(month!== undefined){
     var buttonValue=month+' months';
      $('#experience').html(buttonValue);
      $('#experience_months').val(month);
   }
   if((year!== undefined) && (month!== undefined)){
    var buttonValue= year+' years'+' '+ month+' months';
    $('#experience').html(buttonValue);
    $('#experience').val(buttonValue);
    $('#experience_years').val(year);
    $('#experience_months').val(month);
   }
    if((year== undefined) && (month== undefined)){ 
    var buttonValue=  $('#experience').html();
    $('#experience').html(buttonValue);
   }
   }
  
    function listStates(country_id) {
  console.log(country_id);
  $.get('/apply-job', {
    country_id: country_id,
    current_action: 'list_states',
  }, function(_data) {
    var select = $('form select[name= state_id]');
    select.empty();
    select.append('<option value=' +' '+ '>' +'--'+ '</option>');
    var select2= $('form select[name= city_id]');
    select2.empty();
    select2.append('<option value=' +' '+ '>' +'--'+ '</option>');
    $.each(_data,function(key, value) {
      select.append('<option value=' + value.id + '>' + value.name + '</option>');
    });
  });
}

    function listCities(state_id) {
    $.get('/apply-job', {
      state_id: state_id,
      current_action: 'list_cities',
    }, function(_dataCity) {
      var select = $('form select[name= city_id]');
      select.empty();
      select.append('<option value=' +' '+ '>' +'--'+ '</option>');
      $.each(_dataCity,function(key, value) {
        select.append('<option value=' + value.id + '>' + value.name + '</option>');
      });
      if(parseCityText != '') {
        $("#city_id option").each(function () {
              if ($(this).html().trim() == $.trim(parseCityText)) {
                  $(this).attr("selected", "selected");
                  parseCity = $(this).attr('value');
            $("#city_id").val(parseCity).change();
              } else {
                parseCity = '';
              }
        });
        parseCityText = '';
      }
    });
  }
    function listFunctionalAreaRolesAndSkills(functional_area_id) {
      $.get('/apply-job', {
            functional_area_id: $('#functional_area_id').val(),
            current_action: 'list_functional_roles_skills',
        }, function(_dataFunctionalArea) {
          var selectRoles = $('#functional_area_role_id');
          selectRoles.empty();
      $.each(_dataFunctionalArea['roles'],function(key, value) {
                selectRoles.append('<option value=' + value.id + '>' + value.name + '</option>');
            });

            var selectSkills = $('#functional_area_skill_id');
          selectSkills.empty();
          $.each(_dataFunctionalArea['skills'],function(key, value) {
                selectSkills.append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    }
</script>
@include('override.candidates._scripts')
</body>
</html>
