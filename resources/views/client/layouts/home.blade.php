@extends('client.layouts.master')

@section('banner')
<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-inner">
            @foreach ($banner as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="height: 410px;">
                    <img class="img-fluid" src="{{Storage::url($banner->image)}}" alt="">
                </div>
            @endforeach
        </div>
        
    </div>
    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-prev-icon mb-n2"></span>
        </div>
    </a>
    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-next-icon mb-n2"></span>
        </div>
    </a>
</div>
@endsection
@section('content')

<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-info m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-info m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-info m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-info m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->

<div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">Sản phẩm Hot</span></h2>
</div>

<div class="row px-xl-5 pb-3">
    @foreach ($product as $item)
    <div class="col-lg-2-4 col-md-3 col-sm-4 col-6 pb-1" style="flex: 0 0 20%; max-width: 20%;">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100" src="{{Storage::url($item->img_thumb)}}" alt="">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3">{{$item->name}}</h6>
                <div class="d-flex justify-content-center">
                    <h6>{{$item->price_sale}}</h6><h6 class="text-muted ml-2"><del>{{$item->regular_sale}}</del></h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="{{route('product.detail',$item->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-info mr-1"></i>View Detail</a>
                <a href="{{route('add-to-cart',$item->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-info mr-1"></i>Add To Cart</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@section('content1')
<div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
</div>
<div class="row px-xl-5 pb-3">
    @foreach ($products as $item)
    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
       
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100" src="{{Storage::url($item->img_thumb)}}" alt="">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3">{{$item->name}}</h6>
                <div class="d-flex justify-content-center">
                    <h6>{{$item->price_sale}}</h6><h6 class="text-muted ml-2"><del>{{$item->regular_sale}}</del></h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="{{route('product.detail',$item->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-info mr-1"></i>View Detail</a>
                <a href="{{route('add-to-cart',$item->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-info mr-1"></i>Add To Cart</a>
            </div>
        </div>
     
    </div>
    @endforeach
</div>
   
   
@endsection

