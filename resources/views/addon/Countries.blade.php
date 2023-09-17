
@extends('layouts.Admin')
@section('title')
countries
  @endsection
 
@section('contents')

<!-- *************************************** -->
<div class="modal" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border:none;">
      <div class="modal-header" style="background:#d11409;color: white;border:none; ">
        <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 25px;font-weight: bold;">Add Country</i></h5><i class="fa fa-times-circle" aria-hidden="true" style="font-weight: bold;font-size: 25px;cursor: pointer;" onclick="document.getElementById('editmodel').style.display='none'"></i>


       
      </div>
      <div class="modal-body">
        <form class="edit-content" id="reject" method="post">

          <div class="form-group">
            <label for="reason" class="col-form-label" style="font-weight: bold;">Country:</label>
        <input type="text" name="cn" id="cn" class="form-control">
          </div>
          <div class="form-group">
            <label for="reason" class="col-form-label" style="font-weight: bold;">Country Code:</label>
        <input type="text" name="cncode" id="cncode" class="form-control">
          </div>
          <div class="form-group">
            <label for="reason" class="col-form-label" style="font-weight: bold;">Mobile Code:</label>
        <input type="number" name="mcode" id="mcode" class="form-control">
          </div>

      </div>
      <div class="modal-footer" style="border:none;">
        
        <button type="button" class="btn" id="ab1" onclick="SaveSub()" style="background-color: #d11409;color: white;">Submit</button>
         <button type="button"  class="btn" id="ab2" disabled="" style="background-color: #d11409;color: white;"> <i class="fa fa-spinner fa-spin"></i>  Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- *************************************** -->


<!-- *************************************** -->
<div class="modal" id="editsub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border:none;">
      <div class="modal-header" style="background:#d11409;color: white;border:none; ">
        <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 25px;font-weight: bold;">Edit Country</i></h5><i class="fa fa-times-circle" aria-hidden="true" style="font-weight: bold;font-size: 25px;cursor: pointer;" onclick="document.getElementById('editsub').style.display='none'"></i>


       
      </div>
      <div class="modal-body">
        <form class="edit-content" id="reject" method="post">


         <input type="hidden" name="cid" id="cid" class="form-control">
          

          <div class="form-group">
            <label for="reason" class="col-form-label" style="font-weight: bold;">Country:</label>
        <input type="text" name="cn1" id="cn1" class="form-control" >
          </div>
          <div class="form-group">
            <label for="reason" class="col-form-label" style="font-weight: bold;">Country Code:</label>
        <input type="text" name="cncode1" id="cncode1" class="form-control">
          </div>
          <div class="form-group">
            <label for="reason" class="col-form-label" style="font-weight: bold;">Mobile Code:</label>
        <input type="number" name="mcode1" id="mcode1" class="form-control">
          </div>


      </div>
      <div class="modal-footer" style="border:none;">
        
        <button type="button" class="btn" id="ab3" onclick="UpdateSub()" style="background-color: #d11409;color: white;">Submit</button>
         <button type="button"  class="btn" id="ab4" disabled="" style="background-color: #d11409;color: white;"> <i class="fa fa-spinner fa-spin"></i>  Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- *************************************** -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Countries</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="/girokab-admin/customer-area"><i class="fa fa-arrow-left" aria-hidden="true"></i>  back</a></li> -->

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      
            

            <div class="card">
              <div class="card-header">
                
                  <button type="button" class="btn yellowbtn" value="Submit" onclick="AddSub()" id="renewbt1" style="float: right;">  Add New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Country Id</th>
                    <th>Country</th>
                    <th>Code</th>
                    <th>Mobile Code</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Users</th>
                    
                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($con as $u )

                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$u->id}}</td>
                     <td>{{$u->name}}</td>
                     <td>{{$u->code}}</td>
                     <td>{{$u->mobile_code}}</td>
                     <td>{{$u->status}}</td>
             
                  <td>
                     
                    <a onclick="EditSub('{{$u->id}}','{{$u->name}}','{{$u->code}}','{{$u->mobile_code}}')" style="cursor: pointer;background-color: #28e653;border:none;" class="btn btn-danger btn-sm"><b> Edit</b></a>
                    @if($u->status=='Active')
                    <a style="cursor: pointer;background-color: red;border:none;" onclick="Block('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Block</b></a>
                    @else
                    <a style="cursor: pointer;background-color: #28e653;border:none;" onclick="Activate('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Activate</b></a>

                    @endif
                   
                    </td>

                    <td><a href="/country-users/{{encrypt($u->id)}}" target="_blank" style="cursor: pointer;background-color: #52b0ef;border:none;" class="btn btn-danger btn-sm"><b> View</b></a></td>
  
                  </tr>

                  @endforeach
               
    
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  




<!-- Page specific script -->

<script>



 function AddSub()
{

var modal1 = document.getElementById("editmodel");

modal1.style.display = "block";
}


function SaveSub()
    {
    

      var cn=$('input#cn').val();
    
      if(cn=='')
      {
        $('#cn').css('border','1px solid red');
        
        return false;
      }
      else
        $('#cn').css('border','1px solid #CCC');

    var cncode=$('input#cncode').val();
    
      if(cncode=='')
      {
        $('#cncode').css('border','1px solid red');
        
        return false;
      }
      else
        $('#cncode').css('border','1px solid #CCC');

      var mcode=$('input#mcode').val();
    
      if(mcode=='')
      {
        $('#mcode').css('border','1px solid red');
        
        return false;
      }
      else
        $('#mcode').css('border','1px solid #CCC');

      
     $('#ab1').hide();
      $('#ab2').show();

      data = new FormData();
      data.append('cn', cn);
       data.append('cncode', cncode);
        data.append('mcode', mcode);
      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/country-add",
         data: data,
        dataType:"json",
        contentType: false,
//cache: false,
processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
              $('#ab2').hide();
              $('#ab1').show();
             
               swal({
                       title: "Country added successfully",
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

          if(data['err'])
          {
              $('#ab2').hide();
              $('#ab1').show();
             
               swal({
                       title: "Country already exists !",
                       closeOnClickOutside: false,
                       icon: "error",
                      buttons: "Ok",
                    })
    
          }

        }
    
    
    
    
      })
    
    
    
    
    
    
    } 



  function Activate(val)
    {
    
  
 swal({
  title: "Do you want to activate this country ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/activate-country',
              data: {
        _token: @json(csrf_token()),
        body: body
       
        },
               
              dataType:"json",
              success:function(data)
                {
                  //$('.loader').hide();
                  //$('.overlay').hide();

                  if(data['success'])
                    {
                       swal({
                              title: "Country activated successfully.",
                             // text: "This member moved and Password send to your Email",
                              icon: "success",
                              buttons: "Ok",
                               closeOnClickOutside: false
  
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
  
});

} 


function Block(val)
    {
    
  
 swal({
  title: "Do you want to block this country ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/block-country',
              data: {
        _token: @json(csrf_token()),
        body: body
       
        },
               
              dataType:"json",
              success:function(data)
                {
                  //$('.loader').hide();
                  //$('.overlay').hide();

                  if(data['success'])
                    {
                       swal({
                              title: "Country blocked successfully.",
                              //text: "Username and Password send to your Email",
                              icon: "success",
                              buttons: "Ok",
                               closeOnClickOutside: false
  
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
  
});

} 


 function EditSub(cid,cname,ccode,mcode)
{

var modal2 = document.getElementById("editsub");

modal2.style.display = "block";

$('#cid').val(cid);
$('#cn1').val(cname);
$('#cncode1').val(ccode);
$('#mcode1').val(mcode);

}


function UpdateSub()
    {
    
     

      var cn1=$('input#cn1').val();
    
      if(cn1=='')
      {
        $('#cn1').css('border','1px solid red');
        
        return false;
      }
      else
        $('#cn1').css('border','1px solid #CCC');

      var cncode1=$('input#cncode1').val();
    
      if(cncode1=='')
      {
        $('#cncode1').css('border','1px solid red');
        
        return false;
      }
      else
        $('#cncode1').css('border','1px solid #CCC');

            var mcode1=$('input#mcode1').val();
    
      if(mcode1=='')
      {
        $('#mcode1').css('border','1px solid red');
        
        return false;
      }
      else
        $('#mcode1').css('border','1px solid #CCC');


var conid=$('input#cid').val();
      
     $('#ab3').hide();
      $('#ab4').show();

      data = new FormData();
       data.append('cn1', cn1);
       data.append('cncode1', cncode1);
       data.append('mcode1', mcode1);
        data.append('conid', conid);

  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/country-edit",
         data: data,
        dataType:"json",
        contentType: false,
//cache: false,
processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
              $('#ab4').hide();
              $('#ab3').show();
             
               swal({
                       title: "Country updated successfully",
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

          if(data['err'])
          {
              $('#ab4').hide();
              $('#ab3').show();
             
               swal({
                       title: "Country already exists",
                       closeOnClickOutside: false,
                       icon: "error",
                      buttons: "Ok",
                    })
    
          }

        }
    
    
    
    
      })
    
    
    
    
    
    
    } 



</script>


@endsection

