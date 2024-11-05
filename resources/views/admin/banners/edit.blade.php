@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Quản lý Banner</h1>

        <!-- Form Sửa Banner -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Sửa Banner</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="col-sm-8">
                    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Tiêu đề Banner -->
                        <div class="mb-3">
                            <label class="form-label">Tên:</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Ảnh Banner -->
                        <div class="mb-3">
                            <label class="form-label">Ảnh:</label>
                            <input type="file" name="images[]" multiple class="form-control">
                            @error('images.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <!-- Hiện tại các ảnh đã có -->
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
                                @foreach ($banner->images as $image) <!-- Assuming you have a relationship for images -->
                                    <div style="width: 150px; height: 150px;">
                                        <img src="{{ Storage::url($image->image_path) }}" style="width: 100%; height: auto;" alt="Banner Image">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
