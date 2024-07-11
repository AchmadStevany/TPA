<!doctype html>
<html lang="en">

<head>
    @include('layouts.title-meta')
    @include('layouts.head')
    @include('layouts.loader')
</head>

@section('body')

    <body style="background-color: #ffffff">
    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar-nasabah')
        {{-- @include('layouts.sidebar') --}}
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
</body>

</html>
