@extends('admin.layouts.master')

@section('content')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Quản lý Banner</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Thêm Banner</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-sm-8">
                        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Tiêu đề -->
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề:</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mô tả -->
                            <div class="mb-3">
                                <label class="form-label">Mô tả:</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Ảnh (nhiều ảnh) -->
                            <div class="mb-3">
                                <label class="form-label">Ảnh:</label><br>
                                <input type="file" name="images[]" multiple onchange="previewImages(event)" class="form-control">
                                @error('images.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Hiển thị ảnh xem trước -->
                            <div id="image-preview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>

                            <!-- Trạng thái -->
                            <div class="mb-3">
                                <label class="form-label">Trạng thái:</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Kích hoạt</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Tạo mới</button>
                        </form>
                    </div>

                    <div class="mt-4">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function previewImages(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';

            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function () {
                    const imgElement = document.createElement('img');
                    imgElement.src = reader.result;
                    imgElement.style.width = '100px';
                    imgElement.style.height = '100px';
                    imgElement.style.objectFit = 'cover';
                    imgElement.style.margin = '5px';
                    previewContainer.appendChild(imgElement);
                }
                reader.readAsDataURL(file);
            });
        }
    </script>
@endsection
