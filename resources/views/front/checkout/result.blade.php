@extends('front.layout.master')
@section('title','Shop')
@section('body')



<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">

        <div class="d-flex justify-content-center">
            <div>
                <img src="front/img/img-cart-empty.png" alt="">
                <h4 style="color: rgba(0,0,0,.4);">{{ $notification }}</h4>
                <a href="{{ route('shop') }}" style="display: block" class="btn btn-outline-danger mt-4">Shopping</a>
            </div>
        </div>

    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection
