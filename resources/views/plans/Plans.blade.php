
@extends('layouts.Admin')
@section('title')
 plans
  @endsection

@section('contents')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Plans</h1>
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

                  <button type="button" class="btn yellowbtn" value="Submit" onclick="window.location.href='/add-plan'" id="renewbt1" style="float: right;">  Add New</button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Months</th>
                    <th>Actual Fee</th>
                    <th>Minimum Fee</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($plans as $u )

                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->name}}</td>
                     <td>{{$u->month}}</td>
                    <td>{{$u->actual_fee}}</td>
                    <td>{{$u->minimum_fee}}</td>
                    <td>{{$u->status}}</td>

                    <td>

                   @if($u->status=='Active')
                    <a style="cursor: pointer;background-color: red;border:none;" onclick="Block('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Block</b></a>
                    @else
                    <a style="cursor: pointer;background-color: green;border:none;" onclick="Activate('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Activate</b></a>
                    @endif
                    <a style="cursor: pointer;background-color: #dba318;border:none;" href='/edit-plan/{{encrypt($u->id)}}' target="_blank" class="btn btn-danger btn-sm"><b> Edit</b></a>
                     <a style="cursor: pointer;background-color: #28e653;border:none;" href="{{ route('plansgyms',$u->id) }}"  class="btn btn-danger btn-sm"><b> Gyms</b></a>

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



 function Activate(val)
    {


 swal({
  title: "Do you want to activate this plan ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/activate-plan',
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
                              title: "Plan activated successfully.",
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
  title: "Do you want to block this plan ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/block-plan',
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
                              title: "Plan blocked successfully.",
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

