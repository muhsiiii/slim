@extends('layouts.Admin')
@section('title')
 edit-gym
  @endsection 
 
@section('contents')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Gym </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right custom-breadcrumb">
              <li class="breadcrumb-item"><a href="/active-gym"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
      <form>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <label>Agent *</label>
                  <select name="agent" id="agent" class="form-control">
                    <option value="">Choose agent</option>
                    @foreach($agents as $a)
                    <option value="{{$a->id}}" @if($a->id==$gym->agent_id) selected @endif>{{$a->name}}</option>
                    @endforeach
                  </select>
                </div>
                 <div class="form-group">
                  <label>Gym Name *</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{$gym->name}}">
                </div>
                <div class="form-group">
                  <label>Propriter Name *</label>
                  <input type="text" name="pname" id="pname" class="form-control" value="{{$gym->propriter}}">
                </div>
                <div class="form-group">
                  <label>Mobile *</label>
                  <input type="number" name="mobile" id="mobile" class="form-control" value="{{$gym->mobile}}">
                </div>

                 <div class="form-group">
                  <label>Mail Id </label>
                 <input type="text" name="mail" id="mail" class="form-control" value="{{$gym->mail_id}}">
                </div>
                
                
                 
              </div>



              <!-- /.col -->
              <div class="col-md-6">
                
                <div class="form-group">
                  <label>Pincode *</label>
                 <input type="number" name="pincode" id="pincode" class="form-control" oninput="GetDet()" value="{{$gym->pincode}}">
                 <span class="float-right tx-danger" id="pinloader">Fetching...</span>
                </div>
                <div class="form-group">
                  <label>District *</label>
                 <input type="text" name="district" id="district" class="form-control" value="{{$gym->district}}">
                </div>
                <div class="form-group">
                  <label>State *</label>
                 <input type="text" name="state" id="state" class="form-control" value="{{$gym->state}}">
                </div>
               
                <div class="form-group">
                  <label>Area *</label>
                 <select class="form-control select2 select2-hidden-accessible" name="areas" data-placeholder="Choose area" id="areas" tabindex="-1" aria-hidden="true">
                <option selected value="{{$gym->area}}">{{$gym->area}}</option>
              </select>
                </div>
                <div class="form-group">
                  <label>Address *</label>
                  <textarea class="form-control" rows="3" cols="3"  id="address">{{$gym->address}}</textarea>
                </div>

                


                
              </div>

            </div>
              <center>
                
                  
                  <button type="button" class="btn yellowbtn" onclick="AddGym()" id="submitButton">Submit</button>
                  <button type="button" class="btn yellowbtn" id="submitButton1"> <i class="fa fa-spinner fa-spin"></i>   Submit</button>
              
                </center>
          </div>
        </div>
    </section>


    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<script>

  function GetValidity(selectElement)
    {
      var selectedOption = selectElement.options[selectElement.selectedIndex];
      var monthValue = selectedOption.getAttribute("data-month");
      // alert(monthValue);
      // return false;
       var monthValue = parseInt(monthValue);

      var currentDate = new Date();
      var newDate = new Date(currentDate);
      newDate.setMonth(currentDate.getMonth() + monthValue);

      // Handle cases where the new month exceeds 11 (December)
      if (newDate.getMonth() > 11) {
          newDate.setFullYear(newDate.getFullYear() + 1);
          newDate.setMonth(newDate.getMonth() - 12);
      }

      var formattedNewDate = newDate.toISOString().substr(0, 10);
      var formattedCurDate = currentDate.toISOString().substr(0, 10);
      $('#validto').val(formattedNewDate);
      $('#validfrom').val(formattedCurDate);
      

    }

    function GetDet()
    {
        var pincode = $('input#pincode').val();
        if(pincode.length==6)
        {
            $('#pinloader').text('Fetching...');
            $('#pinloader').show();
            $("#pincode").prop('disabled', true);
            $('#areas').find('option').remove().end()
            .append('<option selected disabled>Choose area</option>');

            const pincodeApi = {
                "async": true,
                "url": "https://api.erebs.in/pincode/?p="+pincode,
                "method": "GET",};

            $.ajax(pincodeApi).done(function (response) {

            var status = response.status;
            if(status=='01')
            {
              $("#pincode").prop('disabled', false);
              $('#pinloader').hide();
              $("#state").prop('disabled', true);
              $("#district").prop('disabled', true);
              $("#areas").prop('disabled', false);

              var state = response.state;
              var district = response.district;
              var areas = response.area;

              $("#state").val(state);
              $("#district").val(district);
              for (var i = 0; areas.length>i; i++) {
                  $("#areas").append(new Option(areas[i], areas[i]));
                  }
              }else
              {
                $("#pincode").prop('disabled', false);
                $('#pinloader').text('Invalid pincode!');
              }

            });
        }else
        {
            $("#pincode").prop('disabled', false);
            $("#state").prop('disabled', false);
            $("#district").prop('disabled', false);
            $('#pinloader').hide();
        }
        

    }

function AddGym()
{

  var agent=$('#agent option:selected').val();
    if(agent=='')
    {
        $('#agent').focus();
        $('#agent').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#agent').css({'border':'1px solid #CCC'});
    var name=$('input#name').val();
    if(name=='')
    {
        $('#name').focus();
        $('#name').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#name').css({'border':'1px solid #CCC'});

      var pname=$('input#pname').val();
    if(pname=='')
    {
        $('#pname').focus();
        $('#pname').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#pname').css({'border':'1px solid #CCC'});

    var mobile=$('input#mobile').val();
    if(mobile=='')
    {
        $('#mobile').focus();
        $('#mobile').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#mobile').css({'border':'1px solid #CCC'});

      var pincode=$('input#pincode').val();
    if(pincode=='')
    {
        $('#pincode').focus();
        $('#pincode').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#pincode').css({'border':'1px solid #CCC'});

      var district=$('input#district').val();
    if(district=='')
    {
        $('#district').focus();
        $('#district').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#district').css({'border':'1px solid #CCC'});

   var state=$('input#state').val();
    if(state=='')
    {
        $('#state').focus();
        $('#state').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#state').css({'border':'1px solid #CCC'});

  var area=$('#area option:selected').val();
    if(area=='')
    {
        $('#area').focus();
        $('#area').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#area').css({'border':'1px solid #CCC'});

  var address=$('#address').val();
    if(address=='')
    {
        $('#address').focus();
        $('#address').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#address').css({'border':'1px solid #CCC'});

    var plan=$('#plan option:selected').val();
    if(plan=='')
    {
        $('#plan').focus();
        $('#plan').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#plan').css({'border':'1px solid #CCC'});

    

  var fee=$('input#fee').val();
    if(fee=='')
    {
        $('#fee').focus();
        $('#fee').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#fee').css({'border':'1px solid #CCC'});

  var validfrom=$('input#validfrom').val();
    if(validfrom=='')
    {
        $('#validfrom').focus();
        $('#validfrom').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#validfrom').css({'border':'1px solid #CCC'});

  var validto=$('input#validto').val();
    if(validto=='')
    {
        $('#validto').focus();
        $('#validto').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#validto').css({'border':'1px solid #CCC'});

    var pass=$('input#pass').val();
    if(pass=='')
    {
        $('#pass').focus();
        $('#pass').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#pass').css({'border':'1px solid #CCC'});

      var cpass=$('input#cpass').val();
    if(cpass=='')
    {
        $('#cpass').focus();
        $('#cpass').css({'border':'1px solid red'});
        return false;
    }
    else if(cpass!=pass)
    {

        swal({
        title: "Campaign added successfully",
        closeOnClickOutside: false,
        icon: "error",
        buttons: "Ok",
        })
        $('#cpass').focus();
        $('#cpass').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#cpass').css({'border':'1px solid #CCC'});

var mail=$('input#mail').val();
      $('#submitButton').hide();
      $('#submitButton1').show();
    
          data = new FormData();
data.append('agent', agent);
data.append('name', name);
data.append('pname', pname);
data.append('mobile', mobile);
data.append('mail', mail);
data.append('pincode', pincode);
data.append('district', district);
data.append('state', state);
data.append('area', area);
data.append('plan', plan);
data.append('fee', fee);
data.append('validfrom', validfrom);
data.append('validto', validto);
data.append('address', address);
data.append('pass', pass);

 data.append('_token', @json(csrf_token()));
 $.ajax({

type:"POST",
url:"/gym-add",
data:data,
dataType:"json",
contentType: false,
//cache: false,
processData: false,

success:function(data)
{
  if(data['success'])
  {
       $('#submitButton1').hide();
       $('#submitButton').show();
      swal({
      title: "Gym added successfully",
      closeOnClickOutside: false,
      icon: "success",
      buttons: "Ok",
      })
      .then((willDelete) => {
      if (willDelete) {
      window.location.href=window.location.href;
       } 
      
      });
                            
  }
  else
  {
    $('#submitButton1').hide();
       $('#submitButton').show();
      swal({
      title: "Mobile number already exists",
      closeOnClickOutside: false,
      icon: "error",
      buttons: "Ok",
      })
      .then((willDelete) => {
      if (willDelete) {
      window.location.href=window.location.href;
       } 
      
      });
  }

 

}




})



}






    
</script>
@endsection

