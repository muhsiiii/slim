<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrator | Forgot Password</title>
   <link rel="icon" type="image/x-icon" href="{{ asset('admin/img/logo/logo1.png')}}">

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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><img src="{{ asset('admin/img/logo/logo2.png')}}" alt="logo" style="width: 70%;"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Forgot your password? Here you can easily retrieve a new password.</p>
      <form>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

         <div class="error"></div>
        <div class="success"></div>


        <div class="row">
          <div class="col-12">
            <button type="button" class="btn yellowbtn btn-block" id="ab1" onclick="SubmitMail()">Request new password</button>
             <button type="button" class="btn yellowbtn btn-block" id="ab2"> <i class="fa fa-spinner fa-spin"></i> Please wait..</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="/CrowdAfrik-Admin"><i class="fa fa-angle-left"></i>   Back To Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
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

<script type="text/javascript">
  $('#ab2').hide();
$(document).keypress(function(event){
  
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
    Login();  
  }
  
});

function SubmitMail()
{
  $('.error').hide();
  $('.success').hide();
  var email=$('input#email').val();
  if(email=='')
  {
    $('#email').focus();
    $('#email').css({'border':'2px solid red'});
    return false;
  }
  else
   $('#email').css({'border':'1px solid #CCC'});
 $('#ab2').show();
              $('#ab1').hide();

   $.ajax({
     type: "POST",
     url: "/AdminMailChk",
     data: {
        "_token": "{{ csrf_token() }}",
        "email": email,
        },
     dataType: "json",
     success: function (data) {

      if(data['success'])
        {
            $('#ab1').show();
              $('#ab2').hide();
          $('.success').show();
          $('.success').html(data['success']);
          $('.success').css({"color":"green"});
          setTimeout(function () {
                    window.location.href=window.location.href;
                 }, 3000);
             
        }
      else if(data['err'])
        {
          $('#ab1').show();
              $('#ab2').hide();
          $('.error').show();
          $('.error').html(data['err']);
          $('.error').css({"color":"red"});
        }
       
     }
   });
   
}

</script>
