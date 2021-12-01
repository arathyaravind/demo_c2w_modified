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
  .form-control-feedback {
    position: absolute;
    top: 0px;
    right: 0;
    z-index: 2;
    display: block;
    width: 34px;
    height: 34px;
    line-height: 34px;
    text-align: center;
    pointer-events: none;
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
<div class="container-fluid bg-1 text-center margin-top30">
  @if($_REQUEST['job_order_id'])
  <h3 class="margin heading-login">Apply Job</h3>
  @else
  <h3 class="margin heading-login">Candidate</h3>
  @endif
  
 <div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading" style="background-color: gainsboro;">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="register-form-link">New</a>
              </div>
              <div class="col-xs-6">
                 <a href="#"  id="login-form-link">Existing</a>
              </div>
            </div>
           {{--  <hr> --}}
          </div>
          <div class="panel-body">
            <div class="row margin-top15">
              <div class="col-lg-12">
                <form id="register-form" action="/register-candidate" method="post" role="form" style="display: block;">
                   @if($_REQUEST['job_order_id'])
                    <div class="form-group">
                    <input type="hidden" name="job_order_id"  tabindex="1" class="form-control" placeholder="job_order_id" value="{{$_REQUEST['job_order_id']}} ">
                  </div>
                  @endif
                  <div class="form-group">
                    <input type="email" name="email" id="primary_email" tabindex="1" class="form-control" placeholder="Email Address" value=" "  required>
                    <span class="text-danger new-alert-msg"></span>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        @if($_REQUEST['job_order_id'])
                      <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Apply Job">
                      @else
                     <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Add Now">
                      @endif
                                            
                      </div>
                    </div>
                  </div>
                </form>
                <form id="login-form" action="/view-candidate-details" method="post" role="form" style="display: none;">
                  @if($_REQUEST['job_order_id'])
                    <div class="form-group">
                    <input type="hidden" name="job_order_id"  tabindex="1" class="form-control" placeholder="job_order_id" value="{{$_REQUEST['job_order_id']}} ">
                  </div>
                  @endif
                  <span class="text-danger msg"></span>
                   <input type="hidden" name="id" id="id" tabindex="1" class="form-control"  value="">
                 <div class="form-group">
                    <input type="email" name="email" id="login_email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
                     <span class="text-danger alert-msg"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" name="key" id="key" tabindex="2" class="form-control" placeholder="Key" required>
                     <span class="text-danger key-alert-msg"></span>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3"> 
                      @if($_REQUEST['job_order_id'])       
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="View Job Details">
                      @else       
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="View Details">
                      @endif
                      
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="" tabindex="5" class="forgot-password"data-toggle="modal" data-target="#myModal">Forgot Key?</a>
                        </div>
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
   <br/><br/><br/>
  <h3></h3>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-btn" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Forgot Key</h4>
      </div>
      <div class="modal-body">
         <div class="single-send-msg"><p></p></div>
          <p class="login-box-msg">Enter your email address, to request key</p>
          <form>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" id="fogotemail" required="" placeholder="Email Address">
            <span class="fa fa-envelope form-control-feedback text-info"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              Try login again ? <a href="/post-resume">Click here</a>                          
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="button" class="btn btn-primary btn-block btn-flat" onclick="sendToCandidate()">Submit</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Footer -->
<footer class="container-fluid bg-4 text-center footer-custom">
  <p class="margin0">Copyright © 2018. All Rights Reserved <a href="">.Powered by C2W </a></p> 
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
      $(function() {

    $('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
 
  $("#register-submit").on("click", function(event) {
    event.preventDefault();
    if($.trim($("#primary_email").val())!='') {
       $('.new-alert-msg').html('');
      if((validateEmail($("#primary_email").val()))) {
        $('.new-alert-msg').html('');
        var email = $.trim($("#primary_email").val());
        $.get('/post-resume', {
          current_action: 'check_email',
          email: email
        }, function(_result) {
          if(_result != 'true'){
            $('.msg').html(' ');
            $('#login_email').val('');
            $('#register-form').submit(); 
            return true;
          } else {
            var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Email Already Exists!Please enter your key.</strong></div>';
            $('.msg').html(html); 
            $('#login_email').val(email);
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $('#login-form-link').addClass('active');
            $('#register-form').submit(function(e){

              e.preventDefault();
            });
            return false;
          }
        });

      }
      else{
      var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Invalid Email Address!</strong></div>';
       $('.new-alert-msg').html(html); 
       return false;
     }
    }
    else{
      var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Email Field required! Please enter the email.</strong></div>';
       $('.new-alert-msg').html(html);
     }
  });
  $("#login-submit").on("click", function() {
    event.preventDefault();
    if($.trim($("#login_email").val())!='') {
      $('.key-alert-msg').html('');
      $('.alert-msg').html(''); 
      if((validateEmail($("#login_email").val()))) {
        $('.alert-msg').html(''); 
        var email = $.trim($("#login_email").val());
        var key=$.trim($("#key").val());
        $.get('/post-resume', {
          current_action: 'check_email_key',
          email: email,
          key:key
        }, function(_result) {
          if(_result != 'false'){
            $('.msg').html(' ');
            $('#id').val(_result);
            document.getElementById("login-form").submit();
            return true;
          } else {
            if($.trim($("#key").val())=='') {
              var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Key Field required! Please enter your key.</strong></div>';
              $('.key-alert-msg').html(html);
              return false; 
            }
            var html = '<div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Wrong Email or Key Entered.!</strong></div>';
            $('.msg').html(html); 
            $('#login_email').val(email);
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $('#login-form-link').addClass('active');
            $('#login-form').submit(function(e){
              e.preventDefault();
            });
            return false;
          }
        });
      }else{
        var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Invalid Email Address!</strong></div>';
        $('.alert-msg').html(html); 

        if($.trim($("#key").val())=='') {
          var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Key Field required! Please enter your key.</strong></div>';
          $('.key-alert-msg').html(html); 
        }
        return false; 
      }
    }
    else{
     var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Email Field required! Please enter the email.</strong></div>';
     $('.alert-msg').html(html); 
     
     if($.trim($("#key").val())=='') {
      var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Key Field required! Please enter your key.</strong></div>';
      $('.key-alert-msg').html(html); 
    }
    return false;
  }

});
$('.close-btn').click(function(){
        location.reload();
    });
});
 function sendToCandidate() {
   $( "div.single-send-msg p" ).html(' ');
   var email=$("#fogotemail").val();
   console.log(email);
   if(email!=0){
    if((validateEmail(email))) {
      $.get('/forget-key', {
        email_id:email,
        current_action: 'send_key',
      }, function(_data) {
       if(_data=='OK') {
        $( "div.single-send-msg p" ).append('<strong>Mail!</strong> Successfully sent to the Candidate.');
      }
      if(_data==='notExist')
      {
        $( "div.single-send-msg p" ).append('<strong class="text-danger">Please enter your Registered Mail!</strong>');
      }

    });
    }else{
     $( "div.single-send-msg p" ).html('<strong class="text-danger">Invalid Email Address!</strong>');

   }
 }else{
  $( "div.single-send-msg p" ).html('<strong class="text-danger">Please Enter Your Email!</strong>');   
}
    }  
</script>
@include('override.candidates._scripts')
</body>
</html>
