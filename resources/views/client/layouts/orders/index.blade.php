@extends('client.layouts.master')

@section('content')
<div class="container">
   

    @if($orders->isEmpty())
        <h1 class="text-center">Bạn không có đơn hàng nào</h1>
    @else
    <h1 class="text-center">Đơn hàng của bạn</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $item->product_name }}</td>

                            @php
                            // Tạo đường dẫn đầy đủ cho ảnh
                            $imagePath = $item->product_image;
                            $fullImageUrl = asset('storage/' . $imagePath); // Sử dụng 'storage' nếu ảnh nằm trong thư mục storage
                            @endphp
                            <td>
                                @if(file_exists(public_path('storage/' . $imagePath)))
                                    <img src="{{ $fullImageUrl }}" alt="Product Image" style="width: 100px;">
                                @else
                                    <img src="{{ asset('default-image.jpg') }}" alt="Default Image" style="width: 50px;">
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($order->total, 2) }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                @php
                                    $canCancel = $order->status == 'pending' || $order->status == 'waiting for delivery';
                                @endphp
                            
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @if($canCancel)
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Bạn có chắc muốn hủy không?');">Hủy đơn hàng</button>
                                    @else
                                        <button type="button" class="btn btn-secondary" disabled>Hủy đơn hàng</button>
                                    @endif
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
