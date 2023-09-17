@extends('layouts.Admin')
@section('title')
 add-plan
  @endsection 
 
@section('contents')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Plan </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right custom-breadcrumb">
              <li class="breadcrumb-item"><a href="/plans"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></li>
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
                  <label>Plan Name *</label>
                  <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Months *</label>
                  <input type="number" name="month" id="month" class="form-control" value="1">
                </div>

                
                
                 
              </div>


              <!-- /.col -->
              <div class="col-md-6">

               <div class="form-group">
                  <label>Actual Fee (Rs.) *</label>
                 <input type="number" name="afee" id="afee" class="form-control">
                </div>
                <div class="form-group">
                  <label>Minimum Fee (Rs.) *</label>
                 <input type="number" name="mfee" id="mfee" class="form-control">
                </div>
              </div>

            </div>
              <center>
                
                  
                  <button type="button" class="btn yellowbtn" onclick="AddAgent()" id="submitButton">Submit</button>
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


function AddAgent()
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

    var month=$('input#month').val();
    if(month=='')
    {
        $('#month').focus();
        $('#month').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#month').css({'border':'1px solid #CCC'});

      var afee=$('input#afee').val();
    if(afee=='')
    {
        $('#afee').focus();
        $('#afee').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#afee').css({'border':'1px solid #CCC'});

      var mfee=$('input#mfee').val();
    if(mfee=='')
    {
        $('#mfee').focus();
        $('#mfee').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#mfee').css({'border':'1px solid #CCC'});

      $('#submitButton').hide();
      $('#submitButton1').show();
    
          data = new FormData();

data.append('name', name);
data.append('month', month);
data.append('afee', afee);
data.append('mfee', mfee);

 data.append('_token', @json(csrf_token()));
 $.ajax({

type:"POST",
url:"/plan-add",
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
      title: "Plan added successfully",
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
      title: "Plan already exists",
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

