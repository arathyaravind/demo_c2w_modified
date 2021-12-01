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
.panel-title>a{
 cursor: pointer;
}
.padding-top30
{
  padding-top: 30px;
}
  </style>
  @include('override.candidates._styles')
  @include('override.candidates._scripts')
  @include('override.front_end._styles')
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
<div class="container-fluid bg-1 text-center">
  {{--  @if(session()->has('job_message.level')=='success')
    <h3 class="margin">Login Again</h3>
    @else
    <h3 class="margin">Error Details</h3>
    @endif  --}}
 <div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login margin-top30">
          <div class="panel-heading">
           <!--  <div class="row">
             <div class="col-xs-12">
               <a href="#" class="active" id="register-form-link">Message</a>
             </div>
            
           </div>
            <hr> -->
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="register-form" action="/register-candidate" method="post" role="form" style="display: block;">
                 @if(session()->get('job_message_apply_level'))
                 <div class="alert alert-{{session()->get('job_message_apply_level')[0]}} alert-dismissible"> 
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>{{session()->get('job_message_apply_content')[0]}}</strong>
                 </div>
                 @endif
                 
                 @if(session()->get('job_message_level'))
                 <div class="alert alert-{{session()->get('job_message_level')[0]}} alert-dismissible"> 
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>{{session()->get('job_message_content')[0]}}</strong>
                 </div>
                 @endif
                  <div class="form-group">
                    <div class="row">
                     <div class="col-sm-6 col-sm-offset-3">
                      @if(session()->get('job_message_level')[0]=='success')
                      <a href="/post-resume" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register">Login</a>
                      @elseif(session()->get('job_message_apply_level')[0])
                      <a href="/post-resume" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register">Register</a>
                      @else
                      <a href="/post-resume" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register">Register/Login</a>
                      @endif 
                      </div>
                    </div>
                  </div>
                </form>
               
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <br/><br/><br/><br/>
  <h3></h3>
</div>



<!-- Footer -->
<footer class="container-fluid bg-4 text-center footer-custom">
  <p class="margin0">Copyright © 2018. All Rights Reserved <a href="">.Powered by C2W </a></p> 
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


@include('override.candidates._scripts')
</body>
</html>
