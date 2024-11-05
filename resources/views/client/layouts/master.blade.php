@include('client.layouts.block.header')
    <!-- Topbar Start -->
    @include('client.layouts.block.topbar')
    @yield('css')
    @yield('banner')
   


    <!-- Offer Start -->
   
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        @yield('content')
        
    </div>
    <!-- Products End -->


    <!-- Subscribe Start -->
    @include('client.layouts.block.form')
    <!-- Subscribe End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        @yield('content1')
        
    </div>
    <!-- Products End -->




    <!-- Footer Start -->
    @include('client.layouts.block.footer')
    @yield('js')