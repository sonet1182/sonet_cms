<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    @include('backend.asset.css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- @include('backend.asset.preloader') --}}

        <!-- Navbar -->
        @include('backend.inc.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('backend.inc.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->


        @include('backend.inc.footer')

        <!-- Control Sidebar -->
        @include('backend.inc.controlbar')
        <!-- /.control-sidebar -->

    </div>
    <!-- ./wrapper -->

    @include('backend.asset.js')


    @yield('scripts')
</body>

</html>
