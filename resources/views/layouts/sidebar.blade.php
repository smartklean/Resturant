 <div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">
            <div class="sidebar-profile">
                <a href="javascript:void(0);" id="profile-menu-link">
                    <div class="sidebar-profile-image">
                        <img src="logo_images/{{$setting->logo}}" class="img-circle img-responsive" alt="">
                    </div>
                    <div class="sidebar-profile-details">
                        <span>{{$setting->name}}<br><small>{{$setting->address}}</small></span>
                    </div>
                </a>
            </div>
        </div>
        <ul class="menu accordion-menu">
            <li class="{{ Request::is('home*') ? 'active' : '' }}">
                <a href="{{url('/home')}}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a>
            </li>
            @if(Auth::user()->userRole == 'admin')
            <li class="{{ Request::is('user/*') ? 'active' : '' }}">
                <a href="{{url('/users')}}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-user"></span><p>Users</p></a>
            </li>
            @endif
            
            <li class="{{ Request::is('supplier/*') ? 'active' : '' }}">
                <a href="{{url('/suppliers')}}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Suppliers</p></a>
            </li>

            <li class="{{ Request::is('category/*') ? 'active' : '' }}">
                <a href="{{url('/category')}}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-equalizer"></span><p>Categories</p></a>
            </li>

            <li class="{{ Request::is('product/*') ? 'active' : '' }}">
                <a href="{{url('/product')}}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-tasks"></span><p>Products</p></a>
            </li>


            @if(Auth::user()->userRole == 'admin')
            <li class="{{ Request::is('refill/*') ? 'active' : '' }}">
                <a href="{{url('/refill')}}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-gift"></span><p>Product Refill</p></a>
            </li>
            @endif

            <li class="{{ Request::is('sales/*') ? 'active' : '' }}">
                <a href="{{url('/sales')}}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-shopping-cart"></span><p>Sales</p></a>
            </li>

            <!-- <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list"></span><p>Settings</p></a>
                <ul class="sub-menu">
                    <li><a href="">Static Tables</a></li>
                    <li><a href="table-responsive.html">Responsive Tables</a></li>
                    <li><a href="table-data.html">Data Tables</a></li>
                </ul>
            </li> -->
            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list"></span><p>Help</p></a>
            </li>
        </ul>
    </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->