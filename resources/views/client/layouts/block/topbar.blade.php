<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                @auth
                <span class="mr-3">Xin chào, {{ Auth::user()->name }}</span>
                
                @if(Auth::user()->role === \App\Models\User::ROLE_ADMIN)
                    <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link">Quản trị</a>
                @else
                    <span class="btn btn-outline-info"><a href="{{ route('orders.index') }}">Đơn hàng</a></span>
                @endif
                
                <form action="{{ route('logout') }}" method="POST" class="ml-3">
                    @csrf
                    <button type="submit" class="btn btn-link nav-item nav-link">Logout</button>
                </form>
            @else
                <!-- If the user is not logged in -->
                <a href="{{ route('formLogin') }}" class="nav-item nav-link">Login</a>
                <a href="{{ route('formRegister') }}" class="nav-item nav-link">Register</a>
            @endauth
            
            </div>
        </div>
        
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-info font-weight-bold border px-3 mr-1">T</span>Pharmacy</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products" name="query">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-info">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="" class="btn border">
                <i class="fas fa-heart text-info"></i>
                
            </a>
            <a href="{{route('cart')}}" class="btn border">
               <i class="fas fa-shopping-cart text-info"></i>
             
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
      
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-info font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-around" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                        <a href="{{route('shop')}}" class="nav-item nav-link">Shop</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link " >About</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                   
                                </div>
                        </div>
                        @if(session('categories'))
                        @php $categories = session('categories'); @endphp
                        <!-- Hiển thị danh mục -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Category</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('shop.category', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                
                        <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a>
                    </div>
                   
                </div>
                
            </nav>
            
        </div>
    </div>
</div>
<!-- Navbar End -->
<!-- Featured Start -->
