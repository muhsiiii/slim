@extends('layouts.Admin')
@section('title')
 profile
  @endsection
  
@section('contents')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center">
            <!-- <h3 id="twelve"><i class="fa fa-user" aria-hidden="true"></i>   My Profile
            </h3> -->
          </div>
          <div class="col-sm-12  text-center">
            <ol class="breadcrumb justify-content-center">
              <!-- <li class="breadcrumb-item"><a href="/admin-dashboard"><i class="fa fa-arrow-left" aria-hidden="true"></i>  back</a></li> -->
              {{-- <li class="breadcrumb-item active"></li> --}}
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4" style="margin-right: auto;margin-left: auto;">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('admin/img/'.$adm->profile_image)}}"
                       alt="User profile picture" style="width: 200px;border-radius:10px;height:250px;">
                </div>
                <h3 class="profile-username text-center">{{$adm->name}}</h3>

                <p class="text-muted text-center"></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Mobile </b> <a class="float-right">{{$adm->mobile}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Mail Id</b> <a class="float-right">{{$adm->mail_id}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Facebook</b> <a class="float-right" href="{{$adm->facebook}}" target="_blank"><i class="fab fa-facebook" aria-hidden="true" style="font-size: 20px;"></i></a>
                  </li>
                  <li class="list-group-item">
                    <b>Instagram</b> <a class="float-right" href="{{$adm->instagram}}" target="_blank"><i class="fab fa-instagram" aria-hidden="true" style="font-size: 20px;"></i></a>
                  </li>
                  <li class="list-group-item">
                    <b>Twitter</b> <a class="float-right" href="{{$adm->twitter}}" target="_blank"><i class="fab fa-twitter" aria-hidden="true" style="font-size: 20px;"></i></a>
                  </li>
                  <!-- <li class="list-group-item">
                    <b>Applied Date</b> <a class="float-right">jj</a>
                  </li> -->
                  
                 
                  
                </ul>

                 

                 
                <a style="cursor: pointer;" href="/edit-admin-profile" class="btn yellowbtn btn-block"><b>Edit</b></a>
              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script>

     function Selectpay(val)
{
  if(val==2)
  {
    $('#d1').hide();
    $('#d2').hide();
  }
  else
  {
    $('#d1').show();
    $('#d2').show();
  }
}





   

        





  </script>

  


 @endsection
