<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	@yield('header')
	<!-- App favicon -->
	<link rel="shortcut icon" href="{{url("assets/images/favicon.ico")}}">

	@include('userpage/partials/css')
    @yield('style')

</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{url("member/dashboard")}}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{url("assets/images/logo.svg")}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <span class="text-body fsz-18"><i class="fa fa-blog"></i> {{ office("office_name") }}</span>
                            </span>
                        </a>

                        <a href="{{url("member/dashboard")}}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{url("assets/images/logo-light.svg")}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <span class="text-white fsz-18"><i class="fa fa-blog"></i> {{ office("office_name") }}</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                </div>

                <div class="d-flex">

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle ar-1-1 img-cover-center header-profile-user" src="{{url(user("photo"))}}" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ ucfirst(user("username")) }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ url("member/profile") }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ url("auth/logout") }}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Keluar</span></a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>
                        <li>
                            <a href="{{url("member/dashboard")}}">
                                <i class="mdi mdi-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url("member/blogs")}}">
                                <i class="mdi mdi-blogger"></i>
                                <span>Blogs</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url("member/portfolios")}}">
                                <i class="mdi mdi-briefcase-account"></i>
                                <span>Portfolio</span>
                            </a>
                        </li>
                        @if (user("role")=="admin")
                            
                        @endif
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-folder"></i>
                                <span>Datamaster</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true">
                                <li><a href="{{ url("admin/users"); }}">Pengguna</a></li>
                                <li><a href="{{ url("admin/configs"); }}">Konfigurasi</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{url("auth/logout")}}">
                                <i class="mdi mdi-logout"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    {!! $content ?? "" !!}

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Skote.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    @include('userpage/partials/javascript')
    @yield('javascript')

</body>

</html>