@extends('admin.layouts.master')
@section('content')
    <!-- End of Topbar -->
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Account</h1>
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

            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-info">Danh Sách Tài Khoản</h6>
            <a href="{{ route('admin.export.users') }}"class="btn btn-outline-success">Xuất dữ liệu</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                              
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->role}}</td>
                      
                                <td>
                                    @if ($item->role == 'user')
                                    <form action="{{ route('admin.promoteToAdmin', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-info">Chuyển thành Admin</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.demoteToUser', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Chuyển thành User</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.deleteUser', $item->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                                @if($item->is_locked)
                                <form action="{{ route('admin.user.unlock', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Mở khóa</button>
                                </form>
                            @else
                                <form action="{{ route('admin.user.lock', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Khóa</button>
                                </form>
                            @endif
                                </td>
                           </tr>
                           @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>

    </div>
@endsection