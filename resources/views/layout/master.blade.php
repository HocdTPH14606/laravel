<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Fixed Navbar Layout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- <link rel="stylesheet" href="{{asset('/dist/css/all.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  /> --}}
    {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <div class="wrapper">
        <div>
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="/" class="nav-link">Trang chủ</a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="" class="brand-link elevation-4">
                    <span class="brand-text font-weight-light">ADMIN</span>
                </a>
                <div class="sidebar">
                    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                        </div>
                        <div class="info">
                            <a href="" class="d-block">Đỗ Tiến Học ph14606</a>
                        </div>
                    </div> --}}
                    <div class="user-panel mt-3  mb-3 d-flex">
                        <div class="info">
                            <a href="#" class="d-block">
                            <!-- Auth::check() trả về true/false đã đăng nhập hay chưa -->
                            @if (Auth::check())
                                <!-- Auth::user() trả về thể hiện của model User chứa thông tin đã đăng nhập -->
                                {{Auth::user()->email}}
                            @endif
                            </a>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="input-group" >
                          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                          <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fa fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="/admin/users" class="nav-link">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>Users</i></p>
                                </a>
                            </li> 
                            <li class="nav-item">
                                <a href="/admin/attribute" class="nav-link">
                                  <i class="nav-icon fa fa-archive"></i>
                                  <p>Thuộc tính<i class="right fa fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/attribute/create" class="nav-link">
                                            <i class="fa fa-dot-circle nav-icon"></i>
                                            <p>Thêm thuộc tính</p>
                                        </a>
                                    </li>
                                  <li class="nav-item">
                                    <a href="/admin/attribute" class="nav-link">
                                        <i class="fa fa-dot-circle nav-icon"></i>
                                      <p>Danh sách thuộc tính</p>
                                    </a>
                                  </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/products" class="nav-link">
                                  <i class="nav-icon fa fa-calendar"></i>
                                  <p>Sản phẩm<i class="right fa fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/products/create" class="nav-link">
                                            <i class="fa fa-dot-circle nav-icon"></i>
                                            <p>Thêm sản phẩm</p>
                                        </a>
                                    </li>
                                  <li class="nav-item">
                                    <a href="/admin/products" class="nav-link">
                                        <i class="fa fa-dot-circle nav-icon"></i>
                                      <p>Danh sách sản phẩm</p>
                                    </a>
                                  </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/carts" class="nav-link">
                                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                                    <p>Đơn hàng</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/statistical" class="nav-link"> 
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Thống kê</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
        </div>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid "> 
                <h2 style="padding: 25px">@yield('content-title')</h2> 
                    <div class="list-group">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div>
            @include('layout.footer')
        </div>
    </div>
    <script src="{{asset('/dist/js/jquery.min.js')}}"></script>
    <script src="{{asset('/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/dist/js/adminlte.min.js')}}"></script>
</body>

</html>