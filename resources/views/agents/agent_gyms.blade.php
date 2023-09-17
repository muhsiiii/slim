@extends('layouts.Admin')
@section('title')
    agents
@endsection

@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Agents</h1>
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

                                <button type="button" class="btn yellowbtn" value="Submit"
                                    onclick="window.location.href='/add-agent'" id="renewbt1" style="float: right;"> Add
                                    New</button>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Propriter</th>
                                            <th>Details</th>
                                            <th>Validity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($agentgyms as $gym)
                                            @php
                                                $dt1 = date('d-m-Y', strtotime($gym->validfrom));
                                                $dt2 = date('d-m-Y', strtotime($gym->validto));

                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>Name : {{ $gym->name }}<br>
                                                    Propriter : {{ $gym->propriter }}<br>
                                                    Mobile : {{ $gym->mobile }}<br>
                                                    Agent : {{ $gym->GetAgent->name }}<br>
                                                </td>
                                                <td>Pincode : {{ $gym->pincode }}<br>
                                                    State : {{ $gym->state }}<br>
                                                    District : {{ $gym->district }}<br>
                                                    Area : {{ $gym->area }}<br>
                                                    Address : {{ $gym->address }}<br>
                                                </td>
                                                <td> From : {{ $dt1 }}<br>
                                                    To :{{ $dt2 }}
                                                </td>
                                                <td>{{ $gym->status }}</td>
                                                <td>


                                                    <a style="cursor: pointer;background-color: red;border:none;"
                                                        onclick="Block()" class="btn btn-danger btn-sm"><b> Block</b></a>

                                                    <a style="cursor: pointer;background-color: green;border:none;"
                                                        onclick="Activate()" class="btn btn-danger btn-sm"><b>
                                                            Activate</b></a>

                                                    <a style="cursor: pointer;background-color: #dba318;border:none;"
                                                        href='' target="_blank" class="btn btn-danger btn-sm"><b>
                                                            Edit</b></a>
                                                    {{-- <a style="cursor: pointer;background-color: #28e653;border:none;"
                                                        href='' target="_blank" class="btn btn-danger btn-sm"><b>
                                                            Gyms</b></a> --}}

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
        function Activate(val) {


            swal({
                    title: "Do you want to activate this agent ?",
                    //text: "Ensure that this student has a valid reason for a this action .",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                })

                .then((willDelete) => {
                    if (willDelete) {

                        var body = val;




                        $.ajax({

                            type: "POST",
                            url: '/activate-agent',
                            data: {
                                _token: @json(csrf_token()),
                                body: body

                            },

                            dataType: "json",
                            success: function(data) {
                                //$('.loader').hide();
                                //$('.overlay').hide();

                                if (data['success']) {
                                    swal({
                                            title: "Agent activated successfully.",
                                            // text: "This member moved and Password send to your Email",
                                            icon: "success",
                                            buttons: "Ok",
                                            closeOnClickOutside: false

                                        })

                                        .then((willDelete) => {
                                            if (willDelete) {
                                                window.location.href = window.location.href;
                                            }

                                        });


                                }


                            }
                        })

                    }

                });

        }


        function Block(val) {


            swal({
                    title: "Do you want to block this agent ?",
                    //text: "Ensure that this student has a valid reason for a this action .",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                })

                .then((willDelete) => {
                    if (willDelete) {

                        var body = val;




                        $.ajax({

                            type: "POST",
                            url: '/block-agent',
                            data: {
                                _token: @json(csrf_token()),
                                body: body

                            },

                            dataType: "json",
                            success: function(data) {
                                //$('.loader').hide();
                                //$('.overlay').hide();

                                if (data['success']) {
                                    swal({
                                            title: "Agent blocked successfully.",
                                            // text: "This member moved and Password send to your Email",
                                            icon: "success",
                                            buttons: "Ok",
                                            closeOnClickOutside: false

                                        })

                                        .then((willDelete) => {
                                            if (willDelete) {
                                                window.location.href = window.location.href;
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
