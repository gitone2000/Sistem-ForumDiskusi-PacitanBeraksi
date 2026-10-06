<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/img/decaa.png') }}" class="img-circle" alt="User Image"><br>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->nama }}</p>
                <p>Pacitan Beraksi</p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
            </li>

            {{-- Master Menu --}}
            <li class="header">MASTER DATA</li>
            <li class="{{ request()->is('admin/bidang*') ? 'active' : '' }}">
                <a href="{{ route('bidang.index') }}"><i class="fa fa-briefcase"></i> <span>Bidang Keilmuan</span></a>
            </li>
            <li class="{{ request()->is('admin/perguruan*') ? 'active' : '' }}">
                <a href="{{ route('perguruan.index') }}"><i class="fa fa-university"></i> <span>Perguruan
                        Tinggi</span></a>
            </li>
            <li class="{{ request()->is('admin/kotaperguruan*') ? 'active' : '' }}">
                <a href="{{ route('kotaperguruan.index') }}"><i class="fa fa-map-marker"></i> <span>Kota Perguruan
                        Tinggi</span></a>
            </li>
            <li class="{{ request()->is('admin/kecamatan*') ? 'active' : '' }}">
                <a href="{{ route('kecamatan.index') }}"><i class="fa fa-map"></i> <span>Kecamatan</span></a>
            </li>
            <li class="{{ request()->is('admin/desa*') ? 'active' : '' }}">
                <a href="{{ route('desa.index') }}"><i class="fa fa-home"></i> <span>Desa</span></a>
            </li>
            <li class="{{ request()->is('admin/channel*') ? 'active' : '' }}">
                <a href="{{ route('channel.index') }}"><i class="fa fa-users"></i> <span>Forum-Chat</span></a>
            </li>

            <li class="header">DATA USER</li>
            <li class="{{ request()->is('admin/useradmin*') ? 'active' : '' }}">
                <a href="{{ route('user.admin.index') }}"><i class="fa fa-user"></i> <span>Data User Admin</span></a>
            </li>
            <li class="{{ request()->is('admin/usermhs*') ? 'active' : '' }}">
                <a href="{{ route('user.mhs.index') }}"><i class="fa fa-user"></i> <span>Data User Mahasiswa</span></a>
            </li>
        </ul>

        {{-- @if (Auth::user()->role == 'admin')
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
                </li>
                <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}"><i class="fa fa-circle-o"></i> <span>Category</span></a>
                </li>
                <li class="{{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                    <a href="{{ route('tasks.index') }}"><i class="fa fa-circle-o"></i> <span>Task</span></a>
                </li>
                <li class="{{ request()->routeIs('users.index.author') ? 'active' : '' }}">
                    <a href="{{ route('users.index.author') }}"><i class="fa fa-circle-o"></i> <span>Author</span></a>
                </li>
                <li class="{{ request()->routeIs('users.index.kurator') ? 'active' : '' }}">
                    <a href="{{ route('users.index.kurator') }}"><i class="fa fa-circle-o"></i> <span>Kurator</span></a>
                </li>
                <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> <span>Admin</span></a>
                </li>
            </ul><!-- /.sidebar-menu -->
        @endif

        @if (Auth::user()->role == 'mahasiswa')
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
                </li>
                <li class="{{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                    <a href="{{ route('tasks.index') }}"><i class="fa fa-circle-o"></i> <span>Task Berjalan</span></a>
                </li>
                <li class="{{ request()->routeIs('tasks.completed') ? 'active' : '' }}">
                    <a href="{{ route('tasks.completed') }}"><i class="fa fa-circle-o"></i> <span>Task Selesai</span></a>
                </li>
            </ul><!-- /.sidebar-menu -->
        @endif --}}
    </section>
    <!-- /.sidebar -->
</aside>
