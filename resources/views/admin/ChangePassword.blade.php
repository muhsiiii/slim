@extends('layouts.Admin')
@section('title')
 change password
  @endsection
 
@section('contents')

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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!--<div class="col-sm-12 text-center mt-4">-->
            
            
          <!--</div>-->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
          <!--     <li class="breadcrumb-item"><a href="/admin-dashboard">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-5" style="margin-left: auto;margin-right: auto;">
            <!-- general form elements -->
            <div class="card form-box" >
              <div class="card-block">
                  <i class="fa fa-lock mr-2" aria-hidden="true"></i>
                  <h3 id="twelve" class="mb-0">   Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><i class="fa fa-lock" aria-hidden="true"></i>  Current Password</label>
                    <input type="password" class="form-control" id="oldpass" placeholder="Current password">
                    <input type="checkbox" onclick="myFunction()">   <span style="font-size: 12px;">Show password</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1"><i class="fa fa-lock" aria-hidden="true"></i>  New Password</label>
                    <input type="password" class="form-control" id="newpass" placeholder="New password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <input type="checkbox" onclick="myFunction1()">   <span style="font-size: 12px;">Show password</span>


                  <div id="message">
  <h3 style="font-size:1rem;">Password must contain the following: <span style="float: right;cursor: pointer;" onclick="Close()"> <i class="fa fa-times" aria-hidden="true"></i>  Close</span></h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>uppercase</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1"><i class="fa fa-lock" aria-hidden="true"></i>  Confirm Password</label>
                    <input type="password" class="form-control" id="confirmpass" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <input type="checkbox" onclick="myFunction2()">   <span style="font-size: 12px;">Show password</span>

                  </div>

                  <div class="form-group" id="error">
                    
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn yellowbtn w-100" onclick="Save()" id="submitButton">Submit</button>
                  <button type="button" class="btn yellowbtn w-100" id="submitButton1"> <i class="fa fa-spinner fa-spin"></i>   Submit</button>
                </div>


              </form>
            </div>
            <!-- /.card -->

          </div>


         







          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script>

 

  function myFunction()
   {
    document.getElementById("message").style.display = "none";
   }

  function myFunction() {
  var x = document.getElementById("oldpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunction1() {
  var x = document.getElementById("newpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  document.getElementById("message").style.display = "none";

  }
}
function myFunction2() {
  var x = document.getElementById("confirmpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

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
     $('#submitButton').prop('disabled', true);
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
    $('#submitButton').prop('disabled', true);
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
    $('#submitButton').prop('disabled', true);
     var errcnt=errcnt+1;
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
    $('#submitButton').prop('disabled', true);
     var errcnt=errcnt+1;
  }

      if(errcnt==0)
      {
         $('#submitButton').prop('disabled', false);
          document.getElementById("message").style.display = "none";
           $('#newpass').css('border','1px solid #CCC');
      }
      else
      {
         $('#submitButton').prop('disabled', true);
           document.getElementById("message").style.display = "block";
            $('#newpass').css('border','1px solid red');
      }


    }


    
      
    function Save()
    {
    
    $('#error').hide();
      var oldpass=$('input#oldpass').val();
    
      if(oldpass=='')
      {
        $('#oldpass').css('border','1px solid red');
        
        return false;
      }
      else
        $('#oldpass').css('border','1px solid #CCC');
    
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
      $('#submitButton').hide();
      $('#submitButton1').show();
    
    
      $.ajax({
    
        type:"POST",
        url:"/password-update",
         data: {
            _token: @json(csrf_token()),
            oldpass: oldpass,
            newpass:newpass
            },
        dataType:"json",
       
        success:function(data)
        {
          if(data['success'])
          {
              $('#submitButton1').hide();
      $('#submitButton').show();
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
          else if(data['err'])
          {
            $('#submitButton1').hide();
      $('#submitButton').show();
            swal({
                                  title: "Incorrect Current Password",
                                  //text: "Username and Password send to your Email",
                                  icon: "error",
                                  buttons: "Ok",
      
                                })
          }
    
        }
    
    
    
    
      })
    
    
    
    
    
    
    }
    
    
    
    
      
     </script>   

  @endsection