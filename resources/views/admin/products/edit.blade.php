@extends('admin.layouts.master')

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('theme/admin/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('js')
    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!-- dropzone js -->
    <script src="{{ asset('theme/admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('theme/admin/js/create-product.init.js') }}"></script>
@endsection

@section('content')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Sửa Sản phẩm</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <div class="col-sm-8">
                            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Tên:</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sku</label>
                                    <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
                                    @error('sku')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ảnh:</label><br>
                                    <input type="file" name="img_thumb" onchange="showImage(event)" class="form-control">
                                    <div style="width: 100px; height: 100px;">
                                        <img src="{{ Storage::url($product->img_thumb) }}" style="max-width: 100%; max-height: 100%;" alt="">
                                    </div>
                                    @error('img_thumb')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <img id="cover" src="" alt="Hình ảnh sản phẩm" style="width: 200px; display: none">
                                <div class="mb-3">
                                    <label class="form-label">Price Regular</label>
                                    <input type="number" name="price_regular" class="form-control" value="{{ old('price_regular', $product->price_regular) }}">
                                    @error('price_regular')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Price Sale</label>
                                    <input type="number" name="price_sale" class="form-control" value="{{ old('price_sale', $product->price_sale) }}">
                                    @error('price_sale')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}">
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Overview</label>
                                    <input type="text" name="overview" class="form-control" value="{{ old('overview', $product->overview) }}">
                                    @error('overview')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea name="content" id="ckeditor-classic" cols="30" rows="10" class="form-control">{{ old('content', $product->content) }}</textarea>
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <select class="form-select" id="category_id" name="category_id">
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}" {{ old('category_id', $product->category_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <button type="submit" class="btn btn-success">Sửa</button>
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
