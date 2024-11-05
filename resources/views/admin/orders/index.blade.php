@extends('admin.layouts.master')

@section('content')
    <!-- End of Topbar -->
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Đơn Hàng</h1>
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
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Danh Sách Tài Khoản</h6>
        <a href="{{ route('admin.orders.export') }}"class="btn btn-outline-success">Xuất dữ liệu</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên Khách Hàng</th>
                            <th>Email</th> <!-- Adjust width here -->
                            <th>Điện Thoại</th>
                            <th>Địa Chỉ</th>
                            <th>Ngày Đặt Hàng</th>
                            <th>Tổng Tiền</th>
                            <th style="width: 10%;">Trạng Thái</th> <!-- Adjust width here -->
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                            <td>{{ $order->email }}</td> <!-- Adjust width here -->
                            <td>{{ $order->mobile }}</td>
                            <td>{{ $order->address_1 }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($order->total, 2) }} VNĐ</td>
                            <td style="width: 15%;"> <!-- Adjust width here -->
                                <form action="{{ route('admin.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="waiting for delivery" {{ $order->status == 'waiting for delivery' ? 'selected' : '' }}>Chờ lấy hàng</option>
                                        <option value="delivering" {{ $order->status == 'delivering' ? 'selected' : '' }}>Đang giao hàng</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Order Actions">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-info">Chi Tiết</a>
                                    <a href="{{ route('admin.invoice', $order->id) }}" class="btn btn-outline-primary">In Hóa Đơn</a>
                                    <a href="{{ route('admin.pdfInvoice', $order->id) }}" class="btn btn-outline-success">Xuất PDF</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
