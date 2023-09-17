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
<style>
/* Style all input fields */



/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 0.8rem;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><img src="{{ asset('admin/img/logo/logo2.png')}}" alt="logo" style="width: 70%;"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <form>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Password" value="{{$email}}" readonly="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-mail"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="newpass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span  class="fa fa-eye" style="cursor: pointer;" onclick="Visibility()" id="eye"></span>
            </div>
          </div>
        </div>
              <div id="message">
  <h3 style="font-size:1rem;">Password must contain the following: <span style="float: right;cursor: pointer;" onclick="Close()"> <i class="fa fa-times" aria-hidden="true"></i>  Close</span></h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>uppercase</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-eye" style="cursor: pointer;" onclick="Visibility1()" id="eye1"></span>
            </div>
          </div>
        </div>

                  <div class="form-group" id="error"></div>
        <div class="row">
          <div class="col-12">
            <button type="button" class="btn yellowbtn btn-block" id="ab1" onclick="Save()">Change password</button>
            <button type="button" class="btn yellowbtn btn-block" id="ab2"> <i class="fa fa-spinner fa-spin"></i> Please wait...</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="/girokab-admin">Back To Login</a>
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
<script src="{{ asset('js/sweetalert.js') }}"></script>
</body>
</html>



<script>

  
      $('#ab2').hide();
 $('#message').hide();

var myInput = document.getElementById("newpass");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}
  // When the user starts to type something inside the password field
myInput.onkeyup = function() {

var errcnt=0;

  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
     $('#ab1').prop('disabled', true);
     var errcnt=errcnt+1;
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
    $('#ab1').prop('disabled', true);
     var errcnt=errcnt+1;
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
    $('#ab1').prop('disabled', true);
     var errcnt=errcnt+1;
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
    $('#ab1').prop('disabled', true);
     var errcnt=errcnt+1;
  }

      if(errcnt==0)
      {
         $('#ab1').prop('disabled', false);
          document.getElementById("message").style.display = "none";
           $('#newpass').css('border','1px solid #CCC');
      }
      else
      {
         $('#ab1').prop('disabled', true);
           document.getElementById("message").style.display = "block";
            $('#newpass').css('border','1px solid red');
      }


    }





      function Visibility()
{
  if(document.getElementById("newpass").type == "text")
  {
    document.getElementById("newpass").type = "password";
$('#eye').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  }
  else if(document.getElementById("newpass").type == "password")
  {
    document.getElementById("newpass").type = "text";
$('#eye').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }

}

     function Visibility1()
{
  if(document.getElementById("confirmpass").type == "text")
  {
    document.getElementById("confirmpass").type = "password";
$('#eye1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  }
  else if(document.getElementById("confirmpass").type == "password")
  {
    document.getElementById("confirmpass").type = "text";
$('#eye1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }

}
      
    function Save()
    {
    
      var newpass=$('input#newpass').val();
    
      if(newpass=='')
      {
        $('#newpass').css('border','1px solid red');
        
        return false;
      }
      else
        $('#newpass').css('border','1px solid #CCC');
    
      var confirmpass=$('input#confirmpass').val();
    
      if(confirmpass=='')
      {
        $('#confirmpass').css('border','1px solid red');
        
        return false;
      }
      else if(confirmpass!=newpass)
      {
        $('#confirmpass').css('border','1px solid red');
    
        $('#error').show();
        $('#error').text("Passwords are not matching !!!");
        $('#error').css({'color':'red'});
        
        return false;
      }
      else
        $('#confirmpass').css('border','1px solid #CCC');
      // $('#submitButton').hide();
      // $('#submitButton1').show();
     $('#ab2').show();
     $('#ab1').hide();
    
      $.ajax({
    
        type:"POST",
        url:"/adminpsw-reset",
         data: {
            _token: @json(csrf_token()),
            newpass:newpass
            },
        dataType:"json",
       
        success:function(data)
        {
          if(data['success'])
          {
             $('#ab1').show();
              $('#ab2').hide();
             swal({
                                  title: "Password Changed Successfully",
                                  closeOnClickOutside: false,
                                  icon: "success",
                                  buttons: "Ok",
      
                                })
    
                          .then((willDelete) => {
                           if (willDelete) {
                                 window.location.href='/admin-logout';
                                      } 
    
                                });
          }
      //     else if(data['err'])
      //     {
      //       $('#submitButton1').hide();
      // $('#submitButton').show();
      //       swal({
      //                             title: "Incorrect Current Password",
      //                             //text: "Username and Password send to your Email",
      //                             icon: "error",
      //                             buttons: "Ok",
      
      //                           })
      //     }
    
        }
    
    
    
    
      })
    
    
    
    
    
    
    }
    
    
    
    
      
     </script>   
