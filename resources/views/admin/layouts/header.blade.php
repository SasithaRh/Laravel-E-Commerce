  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>



      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        @php
            $unReadNotification = App\Models\Notification::getunReadNotification();
            // dd($unReadNotification);
        @endphp
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{ $unReadNotification->count() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ $unReadNotification->count() }} Notifications</span>
          <div class="dropdown-divider"></div>
          @foreach ($unReadNotification as $unReadNotifications)
          <a href="{{ url("$unReadNotifications->url") }}" id="{{ $unReadNotifications->id }}" class="dropdown-item" onClick="clicked(this);">
            <i class="fas fa-envelope mr-2"></i>{{ $unReadNotifications->message }}<br>
            <span class="float-right text-muted text-sm">{{ Carbon\Carbon::parse($unReadNotifications->created_at)->diffForHumans() }}</span>
          </a>
          <div class="dropdown-divider"></div>
          @endforeach


      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-power-off"></i>

        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-center">

          <a href="{{ route('logout') }}" class="dropdown-item">
            <i class="fas fa-power-off mr-3"></i> LogOut

          </a>

        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assest/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">E-Commerce Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="min-height: 1000.4px;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assest/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{ url('admin/dashboard') }}" class="nav-link  @if(Request::segment(2) == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                    <i class="nav-icon fas fa-user"></i>
                  <p>
                    Admin

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/customers/list') }}" class="nav-link @if(Request::segment(2) == 'customers') active @endif">
                    <i class="nav-icon fas fa-user"></i>
                  <p>
                    Customers

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/order/list') }}" class="nav-link @if(Request::segment(2) == 'order') active @endif">
                    <i class="nav-icon fas fa-user"></i>
                  <p>
                    Orders

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/category/list') }}" class="nav-link @if(Request::segment(2) == 'category') active @endif">
                    <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    Category

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/sub_category/list') }}" class="nav-link @if(Request::segment(2) == 'sub_category') active @endif">
                    <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    Sub Category

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/product/list') }}" class="nav-link @if(Request::segment(2) == 'product') active @endif">
                    <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    Product

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/brand/list') }}" class="nav-link @if(Request::segment(2) == 'brand') active @endif">
                    <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    Brand

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/color/list') }}" class="nav-link @if(Request::segment(2) == 'color') active @endif">
                    <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    Colors

                  </p>
                </a>
              </li>
          <li class="nav-item">
            <a href="{{ url('admin/discountcode/list') }}" class="nav-link @if(Request::segment(2) == 'discountcode') active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Discount Code

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/slider/list') }}" class="nav-link @if(Request::segment(2) == 'slider') active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Home Slider

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets

              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar <small>+ Custom Area</small></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/uplot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>uPlot</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Elements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/sliders.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/modals.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modals & Alerts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/navbar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Navbar & Tabs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/timeline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Timeline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/ribbons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ribbons</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/validation.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li> --}}


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<script>
   function clicked(obj){
    var notification_id  = obj.id;
        xhr = $.ajax({
    type: "GET",
    url: "{{ url('notification/remove') }}",
    data: {

        "id":notification_id,
    },
    dataType: "json",
    success: function(data) {
location.reload();
    },
    error: function(data) {

    }
})
    }
</script>
