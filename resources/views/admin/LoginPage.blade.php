
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrator | Log in</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('admin/img/logo/login.png')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/css/style.css')}}">
  
</head>
<style type="text/css">
  .wave{
  position: fixed;
  bottom: 0;
  left: 0;
  height: 100%;
  z-index: -1;
}

  @media screen and (max-width: 900px){
 

  .wave{
    display: none;
  }
   
}


</style>
<body class="hold-transition login-page">
  
  <div class="container-fluid">
  
                <div class="col-left">
                    <div class="login-box" >

  <!-- <div class="login-logo">
    <a><b><img src="{{ asset('admin/img/logo/logo2.png')}}" alt="logo" style="width: 70%;"></b></a>
  </div> -->
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <center>
      <img src="{{ asset('admin/img/logo/login.png')}}" alt="logo" style="width: 60%;">
      </center>
      <p class="login-box-msg" style="font-size: 20px;font-weight: bold;">Administrator</p>

      
      <form>
        
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" id="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
        <span class="fa fa-eye" style="cursor: pointer;" onclick="Visibility()" id="eye"></span>
            </div>
          </div>
        </div>

        <center>
        <div class="error" style="font-weight: bold;"></div>
        <div class="success" style="font-weight: bold;"></div>
        </center>
        
          <div class="row">
              
          <div class="col-md-12 ">
              <div class="mb-3 text-right">
              <!-- <a href="/forgot-password">I forgot my password</a> -->
              </div>
          </div>
          <div class="col-12 mb-3">
            <button type="button" class="btn yellowbtn w-100" onclick="Login()" id="a1">Sign In</button>
            <button type="button"  class="btn yellowbtn w-100" id="a2" disabled=""> <i class="fa fa-spinner fa-spin"></i>  Sign In</button>
          </div>
      
        
          <div class="col-md-12">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
      </form>

      {{-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      <p class="mb-1">
        
      </p>
      {{-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
                </div>
          
  </div>
   

<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js')}}"></script>
</body>
</html>

<script>

  $('#a2').hide();

$(document).keypress(function(event){
  
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
    Login();  
  }
  
});

function Visibility()
{
  if(document.getElementById("password").type == "text")
  {
    document.getElementById("password").type = "password";
$('#eye').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  }
  else if(document.getElementById("password").type == "password")
  {
    document.getElementById("password").type = "text";
$('#eye').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }

}

function Login()
{
  $('.error').hide();
  $('.success').hide();
  var username=$('input#username').val();
  if(username=='')
  {
    $('#username').focus();
    $('#username').css({'border':'2px solid red'});
    return false;
  }
  else
   $('#username').css({'border':'1px solid #CCC'});

   var password=$('input#password').val();
  if(password=='')
  {
    $('#password').focus();
    $('#password').css({'border':'2px solid red'});
    return false;
  }
  else
   $('#password').css({'border':'1px solid #CCC'});

   if($("#remember").prop('checked') == true)
   {
      var rememberStatus=1;
    }
    else if($("#remember").prop('checked') == false)
   {
      var rememberStatus=0;
    }
    
     $('#a1').hide();
       $('#a2').show();

   $.ajax({
     type: "POST",
     url: "/AdminLogin",
     data: {
        "_token": "{{ csrf_token() }}",
        "username": username,
        "password": password,
        "rememberStatus": rememberStatus
        },
     dataType: "json",
     success: function (data) {

      if(data['success'])
        {
          $('.success').show();
          $('.success').html(data['success']);
          $('.success').css({"color":"green"});
          setTimeout(function () {
                     window.location.href='/admin-dashboard';
                 }, 1000);

            $('#a2').hide();
       $('#a1').show();
             
        }
      else if(data['err'])
        {
          $('.error').show();
          $('.error').html(data['err']);
          $('.error').css({"color":"red"});
           $('#a2').hide();
       $('#a1').show();
        }
       
     }
   });
   
}

</script>
