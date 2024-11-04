@extends('client.layouts.master')
@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop Detail</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{Storage::url($product->img_thumb)}}" alt="Image">
                    </div>
                    
                </div>
              
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">{{$product->name}}</h3>
            <h6 class="font-weight-semi-bold">Sku: {{$product->sku}}</h6>

            <h3 class="font-weight-semi-bold mb-4"><span class="text-danger">{{$product->price_sale}}đ</span> <del>{{$product->price_regular}}đ</del></h3>
            <p class="mb-4"> {{$product->overview}}</p>
            <h6 class="font-weight-semi-bold">Quantity: {{$product->quantity}}</h6>
            <div class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button class="btn btn-info btn-minus" >
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-secondary text-center" value="1">
                    <div class="input-group-btn">
                        <button class="btn btn-info btn-plus">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <a href="{{route('add-to-cart',$product->id)}}" class="btn btn-info px-3">Add To Cart</a>
            </div>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">  Overview</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    {!!$product->content!!}
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    {{$product->overview}}
                </div>
               
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
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
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-info mr-1"></i>Add To Cart</a>
                </div>
            </div>
         
        </div>
        @endforeach
    </div>
</div>
<!-- Products End -->
@endsection