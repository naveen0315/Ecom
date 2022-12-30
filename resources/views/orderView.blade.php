@extends('layouts.nav')

@section('content')
    {{-- CSS --}}
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

        .card-stepper {
            z-index: 0
        }

        #progressbar-2 {
            color: #455A64;
        }

        #progressbar-2 li {
            list-style-type: none;
            font-size: 13px;
            width: 33.33%;
            float: left;
            position: relative;

        }

        #progressbar-2 #step1:before {
            content: '\f058';
            /* font-family: "Font Awesome 5 Free"; */
            color: rgba(247, 242, 242, 0.966);
            width: 37px;
            margin-left: 0px;
            padding-left: 0px;
        }

        #progressbar-2 #step2:before {
            content: '\f058';
            /* font-family: "Font Awesome 5 Free"; */
            color: rgba(247, 242, 242, 0.966);
            width: 37px;
        }

        #progressbar-2 #step3:before {
            content: '\f058';
            /* font-family: "Font Awesome 5 Free"; */
            color: rgba(247, 242, 242, 0.966);
            width: 37px;
            margin-right: 0;
            text-align: center;
        }

        #progressbar-2 #step4:before {
            content: '\f058';
            /* font-family: 'Times New Roman', Times, serif; */
            color: rgba(247, 242, 242, 0.966);
            width: 37px;
            margin-right: 0;
            text-align: center;
        }

        #progressbar-2 li:before {
            line-height: 37px;
            display: block;
            font-size: 12px;
            background: #c5cae9;
            border-radius: 50%;
        }

        #progressbar-2 li:after {
            content: '';
            width: 100%;
            height: 10px;
            background: #c5cae9;
            position: absolute;
            left: 0%;
            right: 0%;
            top: 15px;
            z-index: -1;
        }

        #progressbar-2 li:nth-child(1):after {
            left: 1%;
            width: 100%
        }

        #progressbar-2 li:nth-child(2):after {
            left: 1%;
            width: 100%;
        }

        #progressbar-2 li:nth-child(3):after {
            left: 1%;
            width: 100%;
        }

        #progressbar-2 li:nth-child(4) {
            left: 0;
            width: 37px;
        }

        #progressbar-2 li:nth-child(4):after {
            left: 0;
            width: 0;
        }

        #progressbar-2 li.active:before,
        #progressbar-2 li.active:after {
            background: #6520ff;
        }

        #progressbar-2 li.Cancel:before,
        #progressbar-2 li.Cancel:after {
            background: #f70101;
        }
        #progressbar-2 li.Hold:before,
        #progressbar-2 li.Hold:after {
            background: #f5f10c;
        }
        #progressbar-2 li.Delivered:before,
        #progressbar-2 li.Delivered:after {
            background: #2bee04;
        }
    </style>
    {{-- End CSS --}}

    @foreach ($orderTable as $orderstatus)
    @endforeach
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Shipping Details') }}</div>
                    <div class="card-body">
                        @foreach ($addressUser as $userAddress)
                            <h5 class="card-title">Name:
                                {{ $userAddress['First_Name'] }}
                                {{ $userAddress['Last_Name'] }}</h5>
                            <h6 class="card-title">Email:
                                {{ $userAddress['email'] }}</h6>
                            <h6 class="card-title">Mobile No:
                                {{ $userAddress['mobile'] }}</h6>
                            <h6 class="card-title">Address:
                                {{ $userAddress['address'] }}</h6>
                            <h6 class="card-title">State:
                                {{ $userAddress['state'] }}</h6>
                            <h6 class="card-title">City:
                                {{ $userAddress['city'] }}</h6>
                            <h6 class="card-title">District:
                                {{ $userAddress['district'] }}</h6>
                            <h6 class="card-title">Pin Code:
                                {{ $userAddress['pincode'] }}</h6>
                        @endforeach
                    </div>
                </div>
                <div class="card card-stepper text-black mt-2">
                    <div class="card-header">{{ __('Order Tracking') }}</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h5 class="mb-0">INVOICE <span
                                        class="text-primary font-weight-bold">#{{ $orderstatus->id }}</span>
                                </h5>
                            </div>
                            <div class="text-end">
                                {{-- <p class="mb-0">Expected Arrival <span>01/12/19</span></p> --}}
                                <p class="mb-0">Tracking ID: <span
                                        class="font-weight-bold">{{ $orderstatus->shipment['tracking_no'] }}</span></p>
                            </div>
                        </div>
                        <ul id="progressbar-2" class="d-flex justify-content-between px-0 pt-0 ">
                            @if ($orderstatus->order_status == 'Hold')
                                <li class="Hold fa fa-check text-center" id="step1" aria-hidden="true"></li>
                                <li class="text-center" id="step2" aria-hidden="true"></li>
                                <li class="text-center" id="step3" aria-hidden="true"></li>
                                <li class="text-muted text-end" id="step4"></li>
                            @elseif ($orderstatus->order_status == 'Shipped')
                                <li class="active fa fa-check text-center" id="step1" aria-hidden="true"></li>
                                <li class="active fa fa-check text-center" id="step2" aria-hidden="true"></li>
                                <li class="active fa fa-check text-center" id="step3" aria-hidden="true"></li>
                                <li class="text-muted text-end" id="step4" aria-hidden="true"></li>

                            @elseif ($orderstatus->order_status == 'Delivered')
                                <li class="Delivered fa fa-check fa fa-check text-center" id="step1" aria-hidden="true"></li>
                                <li class="Delivered fa fa-check text-center" id="step2" aria-hidden="true"></li>
                                <li class="Delivered fa fa-check text-center" id="step3" aria-hidden="true"></li>
                                <li class="Delivered fa fa-check text-muted text-end" id="step4" aria-hidden="true"></li>

                            @elseif ($orderstatus->order_status == 'Cancel')
                                <li class="Cancel  text-center" id="step1" ></li>
                                <li class="Cancel  text-center" id="step2" ></li>
                                <li class="Cancel  text-center" id="step3" ></li>
                                <li class="Cancel fa fa-check text-muted text-end" id="step4" aria-hidden="true"></li>
                            @endif
                        </ul>
                        <div class="d-flex justify-content-between">
                            @if ($orderstatus->order_status == 'Cancel')
                                <div class="d-lg-flex align-items-center">
                                    <div>

                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <div>

                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <div>

                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <div>
                                        <p class="fw-bold mb-1">Order</p>
                                        <p class="fw-bold mb-0">Cancelled</p>
                                    </div>
                                </div>
                            @else
                                <div class="d-lg-flex align-items-center">
                                    <div>
                                        <p class="fw-bold mb-1">Order</p>
                                        <p class="fw-bold mb-0">Pending</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <div>
                                        <p class="fw-bold mb-1">Order</p>
                                        <p class="fw-bold mb-0">Processed</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <div>
                                        <p class="fw-bold mb-1">Order</p>
                                        <p class="fw-bold mb-0">Shipped</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <div>
                                        <p class="fw-bold mb-1">Order</p>
                                        <p class="fw-bold mb-0">Delivered</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
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
                                            <td>{{ $orders->productData->product_name }}</td>
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
                                        <th>
                                            @if ($orderstatus->order_status == 'Cancel')
                                                <span style="color:red">Your Order has been
                                                    {{ $orderstatus->order_status }}led</span>
                                            @elseif ($orderstatus->order_status == 'Hold')
                                                <span style="color:yellow">Your Order on
                                                    {{ $orderstatus->order_status }}</span>
                                            @elseif ($orderstatus->order_status == 'Delivered')
                                                <span style="color:green">Your Order has been
                                                    {{ $orderstatus->order_status }}</span>
                                        <th>
                                            {{-- Tracking No:. {{ $orderstatus->shipment['tracking_no'] }} --}}
                                        </th>
                                    @else
                                        <span style="color:green">Your Order has been
                                            {{ $orderstatus->order_status }}</span>
                                        <th>
                                            {{-- Tracking No:. {{ $orderstatus->shipment['tracking_no'] }} --}}
                                        </th>
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
