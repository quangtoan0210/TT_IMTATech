@extends('client.layouts.master')

@section('content')
<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Image</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse(Cart::content() as $product)
                    <tr>
                        <td class="align-middle">
                            @php
                            // Tạo đường dẫn đầy đủ cho ảnh
                            $imagePath = $product->options->image;
                            $fullImageUrl = asset('storage/' . $imagePath); // Sử dụng 'storage' nếu ảnh nằm trong thư mục storage
                        @endphp
                        
                        @if(file_exists(public_path('storage/' . $imagePath)))
                            <img src="{{ $fullImageUrl }}" alt="Product Image" style="width: 100px;">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" alt="Default Image" style="width: 50px;">
                        @endif
                        </td>
                        <td class="align-middle">
                           
                            
                            {{ $product->name }}
                        </td>
                        <td class="align-middle">${{ number_format($product->price, 2) }}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <a href="{{ route('qty-decrement', $product->rowId) }}" class="btn btn-sm btn-info btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{ $product->qty }}" readonly>
                                <div class="input-group-btn">
                                    <a href="{{ route('qty-increment', $product->rowId) }}" class="btn btn-sm btn-info btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">${{ number_format($product->subtotal, 2) }}</td>
                        <td class="align-middle">
                            <a href="{{ route('remove-product', $product->rowId) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Your cart is empty.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form action="{{ route('cart.applyVoucher') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="code" class="form-control p-4" placeholder="Voucher Code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-info">Apply Voucher</button>
                    </div>
                </div>
            </form>
            
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">${{ number_format((float) str_replace(',', '', Cart::subtotal()), 2) }}</h6>
                    </div>
                  
                    @if(session()->has('cart.discount'))
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Discount</h6>
                        <h6 class="font-weight-medium">${{ number_format((float) session('cart.discount'), 2) }}</h6>
                    </div>
                    @endif
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">${{ number_format(
                            (float) str_replace(',', '', Cart::subtotal()) 
                            - ((float) session('cart.discount') ?? 0) 
                           ) 
                        }}</h5>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-block btn-info my-3 py-3">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
