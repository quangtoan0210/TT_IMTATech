@extends('admin.layouts.master')
@section('content')
    <!-- End of Topbar -->
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>
            </div>
            <div class="col-3">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-info">Danh Sách Sản phẩm</h6>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Img_thumb</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price_Regular</th>
                                <th>Price_Sale</th>
                                <th>Quantity</th>
                                <th>Content</th>
                                <th>Overview</th>
                                <th>Category</th>
            
                            </tr>
                        </thead>
                        <tbody>
                        
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                    <div style="width: 100px; height: 100px;">
                                        <img src="{{Storage::url($product->img_thumb)}}" style="max-width: 100%; max-height: 100%;" alt="">
                                    </div>
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->sku}}</td>
                                <td>{{$product->price_regular}}</td>
                                <td>{{$product->price_sale}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->content}}</td>
                                <td>{{$product->overview}}</td>
                                <td>{{$product->category->name}}</td>
                               
                              
                            </tr>
                        
                        </tbody>
                    </table>
                    <a href="{{route('admin.products.index')}}" class="btn btn-success">Quay lại</a>
                 
                </div>
            </div>
        </div>

    </div>
    @endsection