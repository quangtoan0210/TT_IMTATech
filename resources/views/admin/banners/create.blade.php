@extends('admin.layouts.master')

@section('content')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Banner</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Thêm Banner</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <div class="col-sm-8">
                            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Tên -->
                                <div class="mb-3">
                                    <label class="form-label">Tên:</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Ảnh -->
                                <div class="mb-3">
                                    <label class="form-label">Ảnh:</label><br>
                                    <input type="file" name="image" onchange="showImage(event)" class="form-control">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <img id="cover" src="" alt="Hình ảnh sản phẩm" style="width: 200px; display: none">

                                <button type="submit" class="btn btn-success">Tạo mới</button>
                            </form>
                        </div>
                    </table>
                    <div class="">
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
        function showImage(event) {
            const cover = document.getElementById('cover');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                cover.src = reader.result;
                cover.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection