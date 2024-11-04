@extends('admin.layouts.master')
@section('content')
    <!-- End of Topbar -->
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Danh Mục</h1>
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

            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-info">Danh Sách Danh Mục</h6>
                <a href="{{route('admin.categories.trashed')}}" class="btn btn-warning">Thùng rác</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Danh Mục</th>
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Cập nhật</th>
                                <th style="text-align: center;"><i class="fas fa-fw fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $item)
                                <tr>
                                    <td>{{ $item->id}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div style="width: 100px; height: 100px;">
                                            <img src="{{Storage::url($item->cover)}}" style="max-width: 100%; max-height: 100%;" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        {!! $item->is_active ? '<span class="badge bg-success"> Hoạt động </span>' :
                                            ' <span class="badge bg-danger"> Không hoạt động </span>'!!}
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td class="">
                                        <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xóa Danh Mục này không?')">
                                            @csrf
                                            @method('DELETE')
                                            <div class="btn-group me-2" role="group" aria-label="First group">
                                                <button type="submit" class="btn btn-outline-danger"><i
                                                        class="fas fa-trash text-danger"></i></button>
                                        </form>
                                        <a href="{{ route('admin.categories.edit', $item->id) }}" class="btn btn-outline-warning"><i
                                                class="fas fa-edit text-warning"></i></a>
                                        <a href="{{ route('admin.categories.show', $item->id) }}"
                                            class="btn btn-outline-info"><i class="fas fa-info text-info"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$category->links()}}
                </div>
            </div>
        </div>

    </div>
    @endsection