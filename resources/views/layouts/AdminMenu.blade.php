<!-- Main Sidebar Container -->
<style type="text/css">
  .nav-link.active{
        background-color: #d11409 !important;
  }
  .nav-link:hover{
        background-color: #d11409 !important;
  }
</style>
<aside class="main-sidebar sidebar-dark-primary">
  <!-- Brand Logo -->
<center>
  <span class="logo-icon font-weight-light mt-4">

    <br><h1 class="" style="font-weight: 700;color:#1b84e7">slim.</h1><br>

  </span>
</center>
<!-- <a href="/admin-dashboard" class="brand-link text-center">

      <span class="logo-icon font-weight-light mr-2"><img src="{{ asset('admin/img/logo/logo2.png')}}" style="width: 100px;"> </span>
      <span class="brand-text font-weight-light"><img src="{{ asset('admin/img/logo/giro-kab-logo-text.svg')}}" style="width: 130px;" > </span> -->
    <!-- </a> -->


  <!-- Sidebar -->



  <div class="sidebar" style="overflow-y: hidden;">




    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

             <li class="nav-item" >
              @if($header=='Dashboard')
              <a href="/admin-dashboard" class="nav-link active" style="color: white;">
              @else
              <a href="/admin-dashboard" class="nav-link" style="color: white;">
              @endif
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard

                </p>
              </a>
            </li>

            <li class="nav-item" >
              @if($header=='Agents')
              <a href="/agents" class="nav-link active" style="color: white;">
              @else
              <a href="/agents" class="nav-link" style="color: white;">
              @endif
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Agents

                </p>
              </a>
            </li>

            <li class="nav-item" >
              @if($header=='Plans')
              <a href="/plans" class="nav-link active" style="color: white;">
              @else
              <a href="/plans" class="nav-link" style="color: white;">
              @endif
                <i class="nav-icon fa fa-tasks"></i>
                <p>
                  Plans

                </p>
              </a>
            </li>


            <li class="nav-item">
                @if($header=='Gym')
          <a href="#" class="nav-link active" style="color: white;">
            @else
            <a href="#" class="nav-link" style="color: white;">
            @endif
            <i class="nav-icon fa fa-home"></i>
            <p>
              Gym

              <i class="fas fa-angle-left right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/add-gym" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p> Add New</p>

              </a>

            </li>
            <li class="nav-item">
              <a href="/active-gym" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p> All Gym</p>

              </a>

            </li>


          </ul>
        </li>









        <li class="nav-item">
                @if($header=='notification')
          <a href="{{ route('addnotification') }}" class="nav-link active" style="color: white;">
            @else
            <a href="{{ route('addnotification') }}" class="nav-link" style="color: white;">
            @endif
            <i class="nav-icon fa fa-bell"></i>
            <p>
              Notifications

              {{-- <i class="fas fa-angle-left right"></i> --}}

            </p>
          </a>
          {{-- <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/notifications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p> Active</p>

              </a>

            </li>
            <li class="nav-item">
              <a href="/completed-notifications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Completed</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>

          </ul> --}}
        </li>


        {{-- <li class="nav-item" >
            @if($header=='Agents')
            <a href="/agents" class="nav-link active" style="color: white;">
            @else
            <a href="/agents" class="nav-link" style="color: white;">
            @endif
              <i class="nav-icon fa fa-users"></i>
              <p>
                Agents

              </p>
            </a>
          </li> --}}





    <li class="nav-item">
      @if($header=='Settings')
          <a href="#" class="nav-link active" style="color: white;">

            @else

<a href="#" class="nav-link" style="color: white;">
            @endif
            <i class="nav-icon fa fa-cog"></i>
            <p>
              Settings

              <i class="fas fa-angle-left right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/change-password" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p> Change Password</p>

              </a>

            </li>
            <li class="nav-item">
              <a href="{{ route('admin.logout')}}" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>

          </ul>
        </li>

        <br><br>




      </ul>
    </nav>
    <br><br> <br>    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
