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
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @foreach ($returnData as $orders)
    @endforeach
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ url('/') }}/returnOrder/{{ $orders->order_id }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">{{ __('Return Order') }}
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="" class="col-md-4">{{ __('Select Product') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" name="product_id" required>
                                        <option selected>Select Product</option>
                                        @foreach ($returnData as $returnOrder)
                                            @if ($returnOrder->order_status == 'Fully Refunded')
                                                <option disabled>
                                                    {{ $returnOrder->productData->product_name }}</option>
                                            @else
                                                <option value="{{ $returnOrder->productData->id }}">
                                                    {{ $returnOrder->productData->product_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-md-4">{{ __('Enter Quanaity') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('quantity') is-invalid @enderror" id="quantity" required
                                        type="text" name="quantity" placeholder="Enter Quanaity"
                                        value="{{  $returnOrder->quanaity }}" autocomplete="quantity"
                                        autofocus>
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{' Enter Quanaity' }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-md-4">{{ __('Pickup Address') }}</label>
                                <div class="col-md-6">
                                    @foreach ($returnAddress as $userAddress)
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill">
                                                        <input
                                                            class="form-control @error('First_Name') is-invalid @enderror"
                                                            id="First_Name" type="text" name="First_Name"
                                                            placeholder="First Name*"
                                                            value="{{ $userAddress->user_address['First_Name'] }}"
                                                            autocomplete="First_Name" autofocus>
                                                        @error('First_Name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill">
                                                        <input class="form-control @error('Last_Name') is-invalid @enderror"
                                                            id="Last_Name" type="text" name="Last_Name"
                                                            placeholder="Last Name*"
                                                            value="{{ $userAddress->user_address['Last_Name'] }}"
                                                            autocomplete="Last_Name" autofocus>
                                                        @error('Last_Name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill">
                                                        <input class="form-control @error('email') is-invalid @enderror"
                                                            id="email" name="email" type="email"
                                                            placeholder="Email Address*"
                                                            value="{{ $userAddress->user_address['email'] }}">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill">
                                                        <input class="form-control @error('mobile') is-invalid @enderror"
                                                            id="mobile" name="mobile" type="text"
                                                            placeholder="Phone*"
                                                            value="{{ $userAddress->user_address['mobile'] }}">
                                                        @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="aa-checkout-single-bill">
                                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                                            value="{{ $userAddress->user_address['address'] }}">{{ $userAddress->user_address['address'] }}</textarea>
                                                        @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill">
                                                        <input class="form-control @error('state') is-invalid @enderror"
                                                            id="state" name="state" type="text"
                                                            value="{{ $userAddress->user_address['state'] }}"
                                                            placeholder="State">
                                                        @error('state')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill">
                                                        <input class="form-control @error('city') is-invalid @enderror"
                                                            id="city" name="city" type="text"
                                                            placeholder="City / Town*"
                                                            value="{{ $userAddress->user_address['city'] }}">
                                                        @error('city')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill">
                                                        <input class="form-control @error('district') is-invalid @enderror"
                                                            id="district" name="district" type="text"
                                                            placeholder="District*"
                                                            value="{{ $userAddress->user_address['district'] }}">
                                                        @error('district')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill">
                                                        <input class="form-control @error('pincode') is-invalid @enderror"
                                                            id="pincode" name="pincode" type="text"
                                                            placeholder="Postcode / ZIP*"
                                                            value="{{ $userAddress->user_address['pincode'] }}">
                                                        @error('pincode')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <br>
                            <div class="row mb-3">
                                <label for="" class="col-md-4">{{ __('Return Action') }}</label>
                                <div class="col-md-6">
                                    <span style="color: red">{{ __('Refund') }}</span>
                                    {{-- <select class="form-select" aria-label="Default select example">
                                        <option selected>Return Action</option>
                                        <option value="1">Refund</option>
                                        <option value="2">Replacement</option>
                                    </select> --}}
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <button class="btn btn-outline-success">Confrim Return</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('ITEM DETAILS') }}</div>
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
                                    @foreach ($returnData as $orders)
                                        @php $total += $orders->productData->price * $orders->quantity @endphp
                                        <tr>
                                            <td>
                                                {{ $orders->productData->product_name }}
                                                @if ($orders->order_status == '0')
                                                    <span style="color:red">Sell</span>
                                                @elseif ($orders->order_status == 'Fully Refunded')
                                                <span style="color:red">{{ $orders->order_status }}</span>
                                                @else
                                                    <span style="color:red">Amount of  {{ $orders->order_status }} Product has been Refunded</span>
                                                @endif
                                            </td>
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
                                        <th>
                                            &#8377;{{ $total }}
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
