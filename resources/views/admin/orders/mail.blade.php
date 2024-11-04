@component('mail::message')
# <h1>Thông tin đơn hàng của bạn</h1>

<strong>Xin chào</strong> {{$order->first_name}}
Xin cảm ơn bạn đã tin tưởng T-Pharmacy. Đây là thông tin của bạn

**Mã đơn hàng:** {{ $order->id }}

## Chi tiết đơn hàng:

    @foreach ($order->items as $item)
        - **{{ $item->product_name }}** - {{ $item->quantity }} x {{ $item->product_price }}
    @endforeach

**Tổng tiền** {{ $order->total }} <br>
Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận thông tin giao hàng
Cảm ơn bạn đã mua sắm tại T-Pharmacy!


Thanks,<br>

@endcomponent
