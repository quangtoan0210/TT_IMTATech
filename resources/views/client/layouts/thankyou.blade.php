@extends('client.layouts.master')

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Thank You</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thank You</p>
        </div>
    </div>
</div>
<!-- Thank You Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 mb-5">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Your order has been placed successfully!</h1>
            <p>Thank you for your purchase. Your order number is #12345. We will contact you shortly with your order details.</p>
            <a href="{{ route('home') }}" class="btn btn-info py-3 px-4">Go to Home</a>
        </div>
    </div>
</div>
<!-- Thank You End -->
@endsection
