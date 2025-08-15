<!DOCTYPE html>
<html lang="en">

@include('template.head')
    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout">


            <!-- Topbar Start -->
            @include('template.header')
            <!-- end Topbar -->

            <!-- Left Sidebar Start -->
            @include('template.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                <!-- Start Content-->
                    @yield('content')
                <!-- content -->
                </div>

                <!-- Footer Start -->
                @include('template.footer')
                <!-- end Footer -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        @include('template.js')
        @yield('js')
    </body>
</html>
