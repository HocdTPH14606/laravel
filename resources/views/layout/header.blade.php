
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Trang chủ</a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link elevation-4">
        <!-- <img src="/images/avatar/o.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">ADMIN</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="" class="d-block">Đỗ Tiến Học ph14606</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
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
                    <a href="/users" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>Users <i class="right fas fa-angle-left"></i></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>Register <i class="right fas fa-angle-left"></i></p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="/products" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>Products <i class="right fas fa-angle-left"></i></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/product-add" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>Products-add<i class="right fas fa-angle-left"></i></p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="/products" class="nav-link">
                      <i class="nav-icon fas fa-calendar-alt"></i>
                      <p>Products<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/product-add" class="nav-link">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>Products-add<i class="right fas fa-angle-left"></i></p>
                            </a>
                        </li>
                      <li class="nav-item">
                        <a href="/products" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Danh sách sản phẩm </p>
                        </a>
                      </li>
                    </ul>
                  </li>
            </ul>
        </nav>
    </div>
</aside>