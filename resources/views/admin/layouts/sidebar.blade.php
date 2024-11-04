<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Quang Toản</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>@yield('title')</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseCategories"
           aria-expanded="true" aria-controls="collapseCategories">
            <span>Danh mục</span>
        </a>
        <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></i>Danh mục</h6>
                <a class="collapse-item" href="{{route('admin.categories.create')}}">Thêm danh mục</a>
                <a class="collapse-item" href="{{route('admin.categories.index')}}">Danh sách danh mục</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
           aria-expanded="true" aria-controls="collapseProducts">
            <span>Sản phẩm</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sản phẩm</h6>
                <a class="collapse-item" href="{{route('admin.products.create')}}">Thêm Sản phẩm</a>
                <a class="collapse-item" href="{{route('admin.products.index')}}">Danh sách sản phẩm</a>
            </div>
        </div>
    </li>
  
    <!-- Nav Item - Banner Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseBanners"
           aria-expanded="true" aria-controls="collapseBanners">
            <span>Quản lý banner</span>
        </a>
        <div id="collapseBanners" class="collapse" aria-labelledby="headingBanners" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Banner</h6>
                <a class="collapse-item" href="{{route('admin.banners.create')}}">Thêm Banner</a>
                <a class="collapse-item" href="{{route('admin.banners.index')}}">Danh sách Banner</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Account Management -->
    <!-- Nav Item - Account Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccounts"
        aria-expanded="true" aria-controls="collapseAccounts">
            <span>Quản lý tài khoản</span>
        </a>
        <div id="collapseAccounts" class="collapse" aria-labelledby="headingAccounts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tài khoản</h6>
                <a class="collapse-item" href="{{route('admin.create')}}">Thêm Tài khoản</a>
                <a class="collapse-item" href="{{route('admin.users')}}">Danh sách Tài khoản</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Voucher Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVouchers"
        aria-expanded="true" aria-controls="collapseVouchers">
            <span>Quản lý Voucher</span>
        </a>
        <div id="collapseVouchers" class="collapse" aria-labelledby="headingVouchers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Voucher</h6>
                <a class="collapse-item" href="{{route('admin.vouchers.create')}}">Thêm Voucher</a>
                <a class="collapse-item" href="{{route('admin.vouchers.index')}}">Danh sách Voucher</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders"
        aria-expanded="true" aria-controls="collapseOrders">
            <span>Quản lý Đơn Hàng</span>
        </a>
        <div id="collapseOrders" class="collapse" aria-labelledby="headingOrders" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Đơn Hàng</h6>
                <a class="collapse-item" href="{{route('admin.orders.index')}}">Danh sách đơn hàng</a>
            </div>
        </div>
    </li>

</ul>
