<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('img/t.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">T-Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/user.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }} ({{ Auth::user()->role }})</a>
            </div>
        </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{request()->is('dashboard') ? 'active' : ''}}">
                        <i class="bi bi-grid-1x2-fill me-2"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">TABLE</li>
                <li class="nav-item">
                    <a href="{{route('products')}}" class="nav-link {{request()->is('products') ? 'active' : ''}}">
                        <i class="bi bi-minecart me-2"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('category')}}" class="nav-link {{request()->is('category') ? 'active' : ''}}">
                        <i class="bi bi-list-ul me-2"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('customers')}}" class="nav-link {{request()->is('customers') ? 'active' : ''}}">
                        <i class="bi bi-people me-2"></i>
                        <p>
                            Customers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('sales')}}" class="nav-link {{request()->is('sales') ? 'active' : ''}}">
                        <i class="bi bi-basket-fill me-2"></i>
                        <p>
                            Sales
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('salesdetail')}}" class="nav-link {{request()->is('salesdetail') ? 'active' : ''}}">
                        <i class="bi bi-receipt me-2"></i>
                        <p>
                            Sales Detail
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{route('users')}}" class="nav-link {{request()->is('users') ? 'active' : ''}}">
                        <i class="bi bi-people-fill me-2"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
