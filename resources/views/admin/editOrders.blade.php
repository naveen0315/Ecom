@extends('layouts.app')

@section('content')
    <style>
        .thumbnail {

            position: relative;

            padding: 0px;

            margin-bottom: 20px;

        }

        .thumbnail img {

            width: 80%;

        }

        .thumbnail .caption {

            margin: 7px;

        }

        .main-section {

            background-color: #F8F8F8;

        }


        .total-header-section {

            border-bottom: 1px solid #d2d2d2;

        }

        .total-section p {

            margin-bottom: 20px;

        }

        .cart-detail {

            padding: 15px 0px;

        }

        .cart-detail-img img {

            width: 100%;

            height: 100%;

            padding-left: 15px;

        }

        .cart-detail-product p {

            margin: 0px;

            color: #000;

            font-weight: 500;

        }

        .cart-detail .price {

            font-size: 12px;

            margin-right: 10px;

            font-weight: 500;

        }

        .cart-detail .count {

            color: #C2C2DC;

        }

        .checkout {

            border-top: 1px solid #d2d2d2;

            padding-top: 15px;

        }

        .checkout .btn-primary {

            border-radius: 50px;

            height: 50px;

        }
    </style>

@foreach ($orderTable as $orderstatus)

@endforeach

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Shipping Details') }}
                        <a class="float-end" href="{{ url('/') }}/orders">Back</a>
                    </div>
                    <div class="card-body">
                        @foreach ($addressUser as $userAddress)
                            <h5 class="card-title">Name:
                                {{ $userAddress->user_address['First_Name'] }}
                                {{ $userAddress->user_address['Last_Name'] }}</h5>
                            <h6 class="card-title">Email:
                                {{ $userAddress->user_address['email'] }}</h6>
                            <h6 class="card-title">Mobile No:
                                {{ $userAddress->user_address['mobile'] }}</h6>
                            <h6 class="card-title">Address:
                                {{ $userAddress->user_address['address'] }}</h6>
                            <h6 class="card-title">State:
                                {{ $userAddress->user_address['state'] }}</h6>
                            <h6 class="card-title">City:
                                {{ $userAddress->user_address['city'] }}</h6>
                            <h6 class="card-title">District:
                                {{ $userAddress->user_address['district'] }}</h6>
                            <h6 class="card-title">Pin Code:
                                {{ $userAddress->user_address['pincode'] }}</h6>
                        @endforeach
                    </div>
                </div><br>
                @if ($orderstatus->order_status == 'Cancel')

                @elseif($orderstatus->order_status == 'Hold')
                    <div class="card">
                        <div class="card-header">{{ __('Tracking No') }}</div>
                        <div class="card-body">
                            <form action="/editOrder/{{ $orderstatus->id }}" method="POST">
                                @csrf
                                <input type="text" name="tracking_no" class="form-control m-2" required>
                                <button class="btn btn-success m-2">Update</button>
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                @else
                <div class="card">
                    <div class="card-header">{{ __('Tracking No') }}</div>
                    <div class="card-body">
                        <span>Tracking No. {{ $orderstatus->shipment['tracking_no'] }}</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Order Details') }}</div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @foreach ($orderView as $orders)
                                        @php $total += $orders->productData->price * $orders->quantity @endphp
                                        <tr>
                                            <td>{{ $orders->productData->product_name}}</td>
                                            <td>{{ $orders->quantity }}</td>
                                            <td>{{ $orders->price }}</td>
                                            <td>
                                                <a
                                                    href="{{ url('/') }}/ProductView/{{ $orders->productData['id'] }}">
                                                    <img src="{{ url('/') }}{{ config('app.img_path') }}/{{ $orders->productData['image'] }}"
                                                        width="100%" height="100" class="img-responsive" />
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Grand Total</th>
                                        <td></td>
                                        <td></td>
                                        <th>&#8377;{{ $total }}</th>
                                    </tr>
                                    <tr>
                                        <th>Tracking No. {{ $orderstatus->shipment['tracking_no'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>
                                            @if ($orderstatus->order_status == 'Cancel')
                                                <span style="color:red"> {{$orderstatus->order_status}}</span>

                                            @elseif ($orderstatus->order_status == 'Hold')
                                                <span style="color:yellow"> {{$orderstatus->order_status}}</span>

                                            @elseif ($orderstatus->order_status == 'Delivered')
                                                <span style="color:green"> {{$orderstatus->order_status}}</span>
                                            @else
                                                <span style="color:green"> {{$orderstatus->order_status}}</span>

                                            @endif
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
