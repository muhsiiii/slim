@extends('layouts.Admin')
@section('title')
 edit-agent
  @endsection 
 
@section('contents')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Agent </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right custom-breadcrumb">
              <li class="breadcrumb-item"><a href="/agents"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></li>
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
                  <label>Name *</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{$agent->name}}">
                </div>
                <div class="form-group">
                  <label>Mobile *</label>
                  <input type="number" name="mobile" id="mobile" class="form-control" value="{{$agent->mobile}}">
                </div>

                 
                
                 
              </div>


              <!-- /.col -->
              <div class="col-md-6">

              <div class="form-group">
                  <label>Mail Id </label>
                 <input type="text" name="mail" id="mail" class="form-control" value="{{$agent->mail_id}}">
                </div>
                <div class="form-group">
                  <label>Address *</label>
                  <textarea class="form-control" rows="3" cols="3"  id="address">{{$agent->address}}</textarea>
                </div>


                
              </div>

            </div>
              <center>
                
                  
                  <button type="button" class="btn yellowbtn" onclick="EditAgent()" id="submitButton">Submit</button>
                  <button type="button" class="btn yellowbtn" id="submitButton1"> <i class="fa fa-spinner fa-spin"></i>   Submit</button>
              
                </center>
          </div>
        </div>
    </section>





  














    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>


function EditAgent()
{
    var name=$('input#name').val();
    if(name=='')
    {
        $('#name').focus();
        $('#name').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#name').css({'border':'1px solid #CCC'});

    var mobile=$('input#mobile').val();
    if(mobile=='')
    {
        $('#mobile').focus();
        $('#mobile').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#mobile').css({'border':'1px solid #CCC'});

    var address=$('#address').val();
    if(address=='')
    {
        $('#address').focus();
        $('#address').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#address').css({'border':'1px solid #CCC'});

  

var mail=$('input#mail').val();
      $('#submitButton').hide();
      $('#submitButton1').show();
    
          data = new FormData();

data.append('name', name);
data.append('mobile', mobile);
data.append('mail', mail);
data.append('address', address);
data.append('aid', '{{$agent->id}}');

 data.append('_token', @json(csrf_token()));
 $.ajax({

type:"POST",
url:"/agent-edit",
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
      title: "Agent updated successfully",
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
      window.location.href='/agents';
       } 
      
      });
  }

 

}




})



}






    
</script>
@endsection

