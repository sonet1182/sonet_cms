<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="/asset/backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Ten Shop</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/asset/backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>


        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::url() == url('/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('dashboard.v1') }}" class="nav-link {{ request()->is('dashboard/v1*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}


                {{-- @can('role-list') --}}
                <li class="nav-item {{ request()->is('categories*') ? 'menu-open active' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Caregory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @can('role-list') --}}
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category List</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('role-create') --}}
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}" class="nav-link {{ request()->is('categories/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan --}}


                @can('product-list')
                <li class="nav-item {{ request()->is('products*') ? 'menu-open active' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Product
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('product-list')
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link {{ request()->is('products') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product List</p>
                            </a>
                        </li>
                        @endcan
                        @can('product-create')
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}" class="nav-link {{ request()->is('products/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan










                <li class="nav-header">WEB SETTINGS</li>
                <li class="nav-item">
                    <a href="{{ route('web_property.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Properties</p>
                    </a>
                </li>



                @can('role-list')
                <li class="nav-item {{ request()->is('roles*') ? 'menu-open active' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('roles*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Role
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('role-list')
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role List</p>
                            </a>
                        </li>
                        @endcan
                        @can('role-create')
                        <li class="nav-item">
                            <a href="{{ route('roles.create') }}" class="nav-link {{ request()->is('roles/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan



                @can('user-list')
                <li class="nav-item {{ request()->is('users*') ? 'menu-open active' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            user
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('user-list')
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>user List</p>
                            </a>
                        </li>
                        @endcan
                        @can('user-create')
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link {{ request()->is('products/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>

    </div>

</aside>
