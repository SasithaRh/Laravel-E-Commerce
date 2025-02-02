<aside class="col-md-2">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a href="{{ route('user/dashboard') }}" class="nav-link  @if(Request::segment(2) == 'dashboard') active @endif" >Dashboard</a>
        </li>
         <li class="nav-item">
            <a href="{{ route('user/orders') }}" class="nav-link  @if(Request::segment(2) == 'orders') active @endif">Orders</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user/editprofile') }}" class="nav-link @if(Request::segment(2) == 'editprofile') active @endif">Edit Profile</a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route("logout/user") }}">Sign Out</a>
        </li>
    </ul>
</aside><!-- End .col-lg-3 -->
