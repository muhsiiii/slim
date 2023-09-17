
@extends('layouts.Admin')
@section('title')
 users
  @endsection
 
@section('contents')

<!-- *************************************** -->
<div class="modal" id="udet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border:none;">
      <div class="modal-header" style="background:#d11409;color: white;border:none; ">
        <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 25px;font-weight: bold;">Profile</i></h5><i class="fa fa-times-circle" aria-hidden="true" style="font-weight: bold;font-size: 25px;cursor: pointer;" onclick="document.getElementById('udet').style.display='none'"></i>


       
      </div>
      <div class="modal-body">
        <form class="edit-content" id="reject" method="post">

          <h6>Age : <span id="sp1"></span></h3>
          <h6>Address : <span id="sp2"></span></h3>
          <h6>Country : <span id="sp3"></span></h3>
          <h6>State : <span id="sp4"></span></h3>
          <h6>Town : <span id="sp5"></span></h3>
            <h6>Community : <span id="sp7"></span></h3>
          <h6>Post Code : <span id="sp6"></span></h3>



      </div>
  
      </form>
    </div>
  </div>
</div>
<!-- *************************************** -->


<!-- *************************************** -->
<div class="modal" id="block" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border:none;">
      <div class="modal-header" style="background:#d11409;color: white;border:none; ">
        <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 25px;font-weight: bold;">Reason for Block</i></h5><i class="fa fa-times-circle" aria-hidden="true" style="font-weight: bold;font-size: 25px;cursor: pointer;" onclick="document.getElementById('block').style.display='none'"></i>


       
      </div>
      <div class="modal-body">
        <form class="edit-content" id="reject" method="post">

<label>Reason</label>
          <textarea class="form-control" id="reason" rows="5" cols="5"></textarea>
          <input type="hidden" id="buid">

      </div>
      <div class="modal-footer" style="border:none;">
        
        <button type="button" class="btn" id="ab1" onclick="RejectUser()" style="background-color: #d11409;color: white;">Submit</button>
         <button type="button"  class="btn" id="ab2" disabled="" style="background-color: #d11409;color: white;"> <i class="fa fa-spinner fa-spin"></i>  Submit</button>
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
            <h1>Active Users - {{$state->GetCon->name}},{{$state->name}}</h1>
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
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>CA Id</th>
                    <th>Mobile</th>
                    <th>Mail Id</th>
                    <th>Registered On</th>
                    <th>Status</th>
                    <th>Guarantors</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $u )
                    @php
                     $dt1 = date("d-m-Y h:i a", strtotime($u->created_at));
                     if($u->country_id=='')
                     {
                      $con='';
                     }
                     else
                     {
                      $con=$u->GetCon->name;
                     }
                      if($u->state_id=='')
                     {
                      $st='';
                     }
                     else
                     {
                      $st=$u->GetSt->name;
                     }
                    @endphp
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->full_name}}</td>
                     <td>{{$u->code.$u->ca_id}}</td>
                    <td>{{$u->phone_number}}</td>
                    <td>{{$u->email_id}}</td>
                    <td>{{$dt1}}</td>
                    <td>{{$u->status}}</td>
                   
                    
                   <td>
                          <a href="/nominees/{{encrypt($u->id)}}" target="_blank" style="cursor: pointer;border:none;background-color: #17a2b8" class="btn btn-primary btn-sm"><b> View</b></a>


                    </td>

                    <td>
                     
                    <a style="cursor: pointer;background-color: #dd778c;border:none;" onclick="UserProfile('{{$u->age}}','{{$u->address}}','{{$con}}','{{$st}}','{{$u->town}}','{{$u->community}}','{{$u->post_code}}')" class="btn btn-danger btn-sm"><b> Profile</b></a>
                    @if($u->status=='Active')
                    <a style="cursor: pointer;background-color: red;border:none;" onclick="Block('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Block</b></a>
                    @else
                    <a style="cursor: pointer;background-color: #28e653;border:none;" onclick="Activate('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Activate</b></a>

                    @endif
                   
                    </td>
                  
              
                
                 
                      
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

   function UserProfile(age,add,con,dist,town,com,post)
{

var modal2 = document.getElementById("udet");

modal2.style.display = "block";

 $('#sp1').text(age);
 $('#sp2').text(add);
 $('#sp3').text(con);
 $('#sp4').text(dist);
 $('#sp5').text(town);
 $('#sp6').text(post);
  $('#sp7').text(com);

}

 function Activate(val)
    {
    
  
 swal({
  title: "Do you want to activate this user ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/activate-user',
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
                              title: "User activated successfully.",
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
    
  var modal1 = document.getElementById("block");
modal1.style.display = "block";
$('#buid').val(val);
} 

function RejectUser()
    {
      var reason=$('#reason').val();
    
      if(reason=='')
      {
        $('#reason').css('border','1px solid red');
        
        return false;
      }
      else
      $('#reason').css('border','1px solid #CCC');

      var buid=$('input#buid').val();

      $('#ab1').hide();
      $('#ab2').show();

      data = new FormData();
      data.append('reason', reason);
       data.append('buid', buid);
      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/block-user",
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
                       title: "User blocked successfully",
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


        }
    
    
    
    
      })

    }



</script>


@endsection

