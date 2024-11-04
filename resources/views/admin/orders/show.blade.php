@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Chi Tiết Đơn Hàng #{{ $order->id }}</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Thông Tin Khách Hàng</h6>
            </div>
            <div class="card-body">
                <p><strong>Tên:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Điện Thoại:</strong> {{ $order->mobile }}</p>
                <p><strong>Địa Chỉ:</strong> {{ $order->address_1 }}</p>
                <p><strong>Thành Phố:</strong> {{ $order->city }}</p>
                <p><strong>Mã Bưu Điện:</strong> {{ $order->zip }}</p>
                <p><strong>Phương Thức Thanh Toán:</strong> {{ $order->payment_method }}</p>
                <p><strong>Tổng Tiền:</strong> {{ number_format($order->total, 2) }} VNĐ</p>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Chi Tiết Sản Phẩm</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                          
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product_price, 2) }} VNĐ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay Lại</a>
    </div>
@endsection
