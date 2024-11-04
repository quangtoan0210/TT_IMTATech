@extends('admin.layouts.master')

@section('content')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh mục</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Thêm Danh Mục</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <div class="col-sm-8">
                            <form action="{{route('admin.categories.update',$category)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Tên:</label>
                                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                </div>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <div class="mb-3">
                                    <label class="form-label">Ảnh:</label><br>
                                    <input type="file" name="cover">
                                    <div style="width: 100px; height: 100px;">
                                        <img src="{{Storage::url($category->cover)}}" style="max-width: 100%; max-height: 100%;" alt="">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái:</label>
                                    <input class="form-check-input" type="checkbox" name="is_active" @checked($category->is_active)>
                                </div>
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                            </form>
                        </div>
                    </table>
                    <div class="">
                    @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif</div>
                </div>
            </div>
        </div>
    </div>
    @endsection

   