<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa đơn</title>
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-2 text-gray-800">Hóa Đơn #{{ $order->id }}</h1>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Thông Tin Khách Hàng</h6>
        </div>
        <div class="card-body">
            <p><strong>Tên:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Điện Thoại:</strong> {{ $order->mobile }}</p>
            <p><strong>Địa Chỉ:</strong> {{ $order->address_1 }} {{ $order->address_2 }}</p>
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
                        <th>Ảnh</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->product_price, 2) }} VNĐ</td>
                        <td>{{ number_format($item->subtotal, 2) }} VNĐ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="text-right">
        <button onclick="window.print()" class="btn btn-primary">In Hóa Đơn</button>
    </div>
</div>
</body>
</html>
