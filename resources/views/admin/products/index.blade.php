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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    <div style="width: 100px; height: 100px;">
                                        <img src="{{Storage::url($item->img_thumb)}}" style="max-width: 100%; max-height: 100%;" alt="">
                                    </div>
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->sku}}</td>
                                <td>{{$item->price_regular}}</td>
                                <td>{{$item->price_sale}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{Str::limit($item->content, 50, '...') }}</td>
                                <td>{{ Str::limit($item->overview, 50, '...') }}</td>
                                <td>{{$item->category->name}}</td>
                               
                                <td class="">
                                    <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xóa Danh Mục này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group me-2" role="group" aria-label="First group">
                                            <button type="submit" class="btn btn-outline-danger"><i
                                                    class="fas fa-trash text-danger"></i></button>
                                    </form>
                                    <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-outline-warning"><i
                                            class="fas fa-edit text-warning"></i></a>
                                    <a href="{{ route('admin.products.show', $item->id) }}"
                                        class="btn btn-outline-info"><i class="fas fa-info text-info"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                </div>
            </div>
        </div>

    </div>
    @endsection