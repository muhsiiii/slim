@extends('layouts.Admin')
@section('title')
 edit-notification
  @endsection 
 
@section('contents')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Notification </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right custom-breadcrumb">
              <!-- <li class="breadcrumb-item"><a href="/notifications"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></li> -->
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
                  <label>Title *</label>
                  <input type="text" name="title" id="title" class="form-control" value="{{$noti->title}}">
                </div>

                <div class="form-group" >
                  <label>Type *</label>
                  <select class="form-control" name="type" id="type" onchange="SelectType(this.value)">
                    <option value="">Choose</option>
                    <option value="1" @if($noti->noti_type=='All') selected @endif>For All</option>
                    <option value="2" @if($noti->noti_type!='All') selected @endif>For Individual</option>
                  </select>
                  
                </div>
                <center>
                 <span>- OR -</span> 
                </center>
                
                 <div class="form-group" id="userlist1" onchange="SelectItem(this.value)">
                  <label>Users *</label>
                  <select class="form-control" name="user" id="user">
                    <option value="">Choose</option>
                    @foreach($usr as $u)
                    <option value="{{$u->id}}" @if($noti->noti_type==$u->id) selected @endif>{{$u->full_name}}</option>
                    @endforeach
                  </select>
                  
                </div>

                 <div class="form-group">
                  <label>Date *</label>
                  <input type="date" name="dt" id="dt" class="form-control" value="{{$noti->noti_date}}">
                </div>

                 
              </div>


              <!-- /.col -->
              <div class="col-md-6">

               
                <div class="form-group">
                  <label>Description *</label>
                  <textarea class="form-control ckeditor" rows="5" cols="5" id="desc">{{$noti->msg}}</textarea>
                </div>
                
                
              </div>

            </div>
              <center>
                
                  
                  <button type="button" class="btn yellowbtn" onclick="AddCat()" id="submitButton">Submit</button>
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

function SelectType(val)
{
  if(val!=2)
  {
    $('#user').val('');
  }

}

function SelectItem(val)
{
  if(val=='')
  {
    $('#type').val('');
  }
  else
  {
    $('#type').val('2');
  }

}

function AddCat()
{
      
      
    var title=$('input#title').val();
    if(title=='')
    {
        $('#title').focus();
        $('#title').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#title').css({'border':'1px solid #CCC'});

   var type=$('#type option:selected').val();
    if(type=='')
    {
        $('#type').focus();
        $('#type').css({'border':'1px solid red'});
        return false;
    }
    else if(type==1)
    {
       $('#type').css({'border':'1px solid #CCC'});
       var usr='All';
      
    }

    else if(type==2)
    {
         $('#type').css({'border':'1px solid #CCC'});
        var usr=$('#user option:selected').val();
        if(usr=='')
        {
            $('#user').focus();
            $('#user').css({'border':'1px solid red'});
            return false;
        }
        else
          $('#user').css({'border':'1px solid #CCC'});
    }

    var dt=$('input#dt').val();
    if(dt=='')
    {
        $('#dt').focus();
        $('#dt').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#dt').css({'border':'1px solid #CCC'});
  
    var desc=CKEDITOR.instances.desc.getData();
    if(desc=='')
    {

        alert('Pleade add description');
        return false;
    }
    else
  
    $('#desc').css({'border':'1px solid #CCC'});



    $('#submitButton').hide();
      $('#submitButton1').show();
    
          data = new FormData();

data.append('title', title);
data.append('dt', dt);
data.append('type', usr);
data.append('usr', usr);
data.append('desc', desc);
data.append('notid', '{{$noti->id}}');

 data.append('_token', @json(csrf_token()));
 $.ajax({

type:"POST",
url:"/notification-update",
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
                                  title: "Notification updated successfully",
                                  closeOnClickOutside: false,
                                  icon: "success",
                                  buttons: "Ok",
      
                                })
    
                          .then((willDelete) => {
                           if (willDelete) {
                                 window.location.href='/notifications';
                                      } 
    
                                });
                            
  }

 

}




})



}
               

    

    
</script>
@endsection

