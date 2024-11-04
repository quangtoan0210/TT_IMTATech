
@extends('client.layouts.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Đăng Ký</h5>
                    <form action="{{ route('register')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-info btn-block">Đăng Ký</button>
                        <div class="text-center mt-3">
                            <p>Đã có tài khoản? <a href="{{ route('formLogin') }}">Đăng nhập ngay</a></p>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
