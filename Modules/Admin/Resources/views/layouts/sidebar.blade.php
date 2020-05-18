<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}" class="brand-link">
        <img src="/modules/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Wedding Org</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->user_photo != "");
                    <img src="/images/profile/{{ Auth::user()->user_photo }}" alt="User Image">
                @else
                    <img src="/modules/admin/img/avatar5.png" class="img-circle elevation-2" alt="User Image">    
                @endif
                
            </div>
            <div class="info">
                <a href="{{ route('admin.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.config') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Config App</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.listadmin') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>Admin(s)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.bank') }}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Bank(s)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>Vendor(s)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.listcustomer') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Customer(s)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.order')}}" class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Order(s)</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>