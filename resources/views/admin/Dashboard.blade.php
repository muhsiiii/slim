@extends('layouts.Admin')
@section('title')
dashboard
  @endsection

@section('contents')
<style type="text/css">

</style>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">


            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->


        <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $expiredCustomerCount  }}</h3>










                {{-- @foreach ($records as $record)
                <div>
                    <h3>Record ID: {{ $record->id }}</h3>
                    <p>Valid To: {{ $record->validto }}</p>
                    @if ($record->expired)
                        <p style="color: red;">Expired</p>
                    @else
                        <p style="color: green;">Not Expired</p>
                    @endif
                </div>
            @endforeach --}}








                <p>Expired customers</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>0</h3>

                <p>Active Campaigns</p>
              </div>
              <div class="icon">
                <i class="fas fa-bullhorn"></i>
              </div>
              <a href="/campaign" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>



        <div class="col-md-4 col-xl-3">
            <div class="small-box" style="background-color:#c4789b;">
              <div class="inner">
                <h3 style="color:white;">0</h3>

                <p style="color:white;">Completed Campaigns</p>
              </div>
              <div class="icon">
                <i class="fas fa-bullhorn"></i>
              </div>
              <a href="/campaign" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="small-box" style="background-color:#1ea683;">
              <div class="inner">
                <h3 style="color:white;">0</h3>

                <p style="color:white;">Active Notifications</p>
              </div>
              <div class="icon">
                <i class="fa fa-bell"></i>
              </div>
              <a href="/notifications" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


       </div>










    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   @endsection
