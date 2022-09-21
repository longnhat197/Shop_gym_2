@extends('front.layout.master')
@section('title','My order')
@section('body')


    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home"></i> Home</a>
                        <span>My order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- My Order Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg 12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>ID</th>
                                    <th style="text-align: left; padding-left:2%">PRODUCTS</th>
                                    <th>TOTAL</th>
                                    <th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                    <td class="cart-pic first-row">
                                        <img style="height: 100px"
                                            src="front/img/products/{{ $order->orderDetails[0]->product->productImages[0]->path }}"
                                            alt="">

                                    </td>
                                    <td class="first-row">#{{ $order->id }}</td>
                                    <td class="cart-title first-row" style="padding-left: 2%">
                                        <h5>{{ $order->orderDetails[0]->product->name }}
                                            @if (count($order->orderDetails) > 1)
                                                (and {{ count($order->orderDetails) }} orther products)
                                            @endif

                                        </h5>
                                    </td>
                                    <td class="total-price first-row">
                                        ${{ array_sum(array_column($order->orderDetails->toArray(),'total')) }}
                                    </td>
                                    <td class="first-row">
                                        <a href="./account/my-order/{{ $order->id }}" class="btn">Details</a>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- My Order Section End -->

@endsection
