
@extends('layouts.Admin')
@section('title')
notifications
  @endsection
 
@section('contents')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notifications</h1>
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
              <div class="card-header">
                
                  <button type="button" class="btn yellowbtn" value="Submit" onclick="window.location.href='/add-notification'" id="renewbt1" style="float: right;">  Add New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                    
                    
                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($noti as $u )

                    @php
                    $dt1 = date("d-m-Y", strtotime($u->noti_date));
                    @endphp
                    
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->title}}</td>

                     @if($u->noti_type=='All')
                     <td>For all users</td>
                     @else
                     <td>For {{$u->GetUser->full_name}}</td>
                     @endif

                   <td>{!! $u->msg !!}</td>
                   <td>{{$dt1}}</td>
                    <td>
                      <select class="form-control" onchange="ChangeStatus(this.value,'{{$u->id}}')">
                        <option value="Active" @if($u->status=='Active') selected @endif>Active</option>
                        <!-- <option value="Pending">Pending</option> -->
                        <option value="Completed" @if($u->status=='Completed') selected @endif>Completed</option>

                      </select>

                    </td>
                   
              
                  <td>
                     
                    <a href="/edit-notification/{{encrypt($u->id)}}" target="_blank" style="cursor: pointer;background-color: #28e653;border:none;" class="btn btn-danger btn-sm"><b>View/Edit</b></a>
                    <a onclick="Delete('{{$u->id}}')" style="cursor: pointer;background-color: red;border:none;" class="btn btn-danger btn-sm"><b> Delete</b></a>
                   
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


   function ChangeStatus(val,cid)
    {
      $.ajax({

              type:"POST",
              url:'/noti-status',
              data: {
        _token: @json(csrf_token()),
        body: val,
        body1: cid,
       
        },
               
              dataType:"json",
              success:function(data)
                {
                  //$('.loader').hide();
                  //$('.overlay').hide();

                  if(data['success'])
                    {
                       swal({
                              title: "Status changed successfully.",
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

  function Delete(val)
    {
    
  
 swal({
  title: "Do you want to delete this notification ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/delete-notification',
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
                              title: "Notification deleted successfully.",
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



</script>


@endsection

