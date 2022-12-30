@extends('layouts.nav')

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

    <!-- Message -->
    @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="container">
        <table id="cart" class="table">
            <h2>Order History</h2>
            <thead>
                <tr>
                    <th  scope="col" style="width:20%;">@sortablelink('created_at', 'Order Date')</th>
                    <th scope="col" style="width:20%">@sortablelink('id', 'Order Number')</th>
                    <th scope="col" style="width:20%">Tracking Number</th>
                    <th scope="col" style="width:15%">Order Amount</th>
                    <th scope="col">Status</th>
                    <th style="text-align: center; width:30%">Action</th>
                </tr>
            </thead>
            @foreach ($orders as $ordersData)
                <tr>

                    <td>{{ $ordersData->created_at }}</td>
                    <td>{{ $ordersData->id }}</td>
                    <td>{{ $ordersData->shipment['tracking_no'] }}</td>
                    <td>{{ $ordersData->amount}}</td>
                    <td>
                        @if ($ordersData['order_status'] == 'Hold')
                            <span
                                style="background-color: yellow; padding:5px; border-radius:5px">{{ $ordersData['order_status'] }}</span>
                        @elseif($ordersData['order_status'] == 'Cancel')
                            <span
                                style="background-color: Red; padding:5px; border-radius:5px">{{ $ordersData['order_status'] }}</span>
                        @elseif($ordersData['order_status'] == 'Delivered')
                            <span
                                style="background-color: Green; padding:5px; border-radius:5px">{{ $ordersData['order_status'] }}</span>
                        @else
                            <span
                                style="background-color: rgba(35, 223, 35, 0.672); padding:5px; border-radius:5px">{{ $ordersData['order_status'] }}</span>
                        @endif
                    </td>
                    <td >
                        {{-- <a href="{{ url('/') }}/orderView/{{ $ordersData->id }}" class="btn btn-outline-success">View</a> --}}
                        @if ($ordersData['order_status'] == 'Delivered')
                            <a href="{{ url('/') }}/orderView/{{ $ordersData->id }}" class="btn btn-outline-success">View</a>
                            <a href="{{ url('/') }}/returnOrder/{{ $ordersData->id }}" class="btn btn-outline-danger">Return</a>

                        @elseif ($ordersData['order_status'] == 'Hold')
                            <a href="{{ url('/') }}/orderView/{{ $ordersData->id }}" class="btn btn-outline-success">View</a>
                            <a href="{{ url('/') }}/orderCancel/{{ $ordersData->id }}" class="btn btn-outline-warning">Cancel</a>

                        @elseif($ordersData['order_status'] == 'Cancel')
                            <a href="{{ url('/') }}/orderView/{{ $ordersData->id }}" class="btn btn-outline-success">View</a>

                        @elseif($ordersData['order_status'] == 'Shipped')
                            <a href="{{ url('/') }}/orderView/{{ $ordersData->id }}" class="btn btn-outline-success">View</a>
                        @endif
                    </td>

                </tr>

            @endforeach

            <tbody>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
        <div style="display: flex; justify-content: center;">{!! $orders->appends(Request::all())->links() !!}</div>
    </div>
@endsection
