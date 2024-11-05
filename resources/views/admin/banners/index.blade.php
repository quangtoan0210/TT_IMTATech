@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Quản lý Banner</h1>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Danh Sách Banner</h6>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-info btn-sm">Thêm Banner</a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th style="text-align: center;"><i class="fas fa-fw fa-cog"></i> Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <div class="d-flex flex-wrap" style="max-width: 300px;">
                                        @foreach ($item->images as $image)
                                            <div style="width: 100px; height: 100px; overflow: hidden; margin-right: 5px;">
                                                <img src="{{ Storage::url($image->image_path) }}" style="width: 100%; height: auto;" alt="Banner Image">
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.banners.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit text-warning"></i>
                                    </a>
                                    <form action="{{ route('admin.banners.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa Banner này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
@endsection
