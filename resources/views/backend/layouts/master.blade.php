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


            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>


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
