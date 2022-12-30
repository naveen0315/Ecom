<script type="text/javascript">
    function preback() {
        window.history.forward();
    }
    setTimeout("preback()", 0);
    windows.onunload = function() {
        null
    };
</script>

@extends('layouts.nav')
@section('content')
    <!-- Message -->
    @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif
    <!-- Cart view section -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <!-- Login section -->
                @guest
                    @if (Route::has('login'))
                        <div class="panel panel-default aa-checkout-login">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        Login
                                    </a>
                                </h4>
                            </div>
                        </div>
                    @endif
                @else
                    <form action="{{ url('/') }}/placeOrder" method="get">
                        @csrf
                        <div class="card">
                            <div class="card-header">{{ __('Shipping Address') }}</div>
                            <div class="card-body">
                                <div class="form-check">
                                    @foreach ($addressUser as $userAddress)
                                        <input name="address" id="address" value="{{ $userAddress->id }}" checked
                                            class="forem-check" type="radio">
                                        <label for="address">
                                            <h5 class="card-title">
                                                {{ $userAddress->First_Name }}
                                                {{ $userAddress->Last_Name }}
                                                {{-- <a href="{{ url('/') }}/userAddress/{{ $userAddress->id }}" type="button"
                                                                                    class="btn btn-outline-primary float-end">Edit</a> --}}
                                            </h5>
                                            <p class="card-text">Email:
                                                {{ $userAddress->email }}</p>
                                            <p class="card-text">Address:
                                                {{ $userAddress->address }},
                                                District:
                                                {{ $userAddress->district }},
                                                State: {{ $userAddress->state }}, Pin Code:
                                                {{ $userAddress->pincode }}</p>
                                            <hr>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="checkout-right">
                            <div class="card-header">{{ __('Price & Order Summary') }}</div>
                            <div class="card-body">
                                <div class="aa-order-summary-area">
                                    <table class="table ">
                                        <thead>
                                            <th style="font-size:14px; font-weight:bold;; width:500px ">
                                                Product
                                            </th>
                                            <th style="font-size:14px; font-weight:bold;; width:110px ">
                                                Total</th>
                                        </thead>
                                        <tbody>
                                            @php $total = 0 @endphp
                                            @foreach ($userCheckout as $cartData)
                                                @php $total += $cartData->product['price'] * $cartData['quantity'] @endphp
                                                <tr data-id="{{ $cartData->id }}">
                                                    <td data-th="Product">
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <h4 name="product_name" class="nomargin">
                                                                    {{ $cartData->product['product_name'] }}
                                                                    <strong> X
                                                                        {{ $cartData['quantity'] }}
                                                                    </strong>
                                                                </h4>

                                                                <span
                                                                    style="color: green; font-size:14px; font-weight:bold">{{ $cartData->product['color'] }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="font-size:14px; font-weight:bold" data-th="Price">
                                                        &#8377;
                                                        {{ $cartData->price * $cartData->quantity }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="font-size:14px; font-weight:bold ">Total
                                                </th>
                                                <td style="font-size:14px; font-weight:bold; ">
                                                    &#8377;
                                                    {{ $total }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <h4>Payment Method</h4>
                                <div class="aa-payment-method">
                                    <div class="form-check">
                                        <div class="form-check  p-4">
                                            <input class="form-check-input " type="radio" name="payment" id="COD"
                                                value="COD">
                                            <label class="form-check-label" for="COD">
                                                COD
                                            </label>

                                        </div>
                                        <div class="form-check ">
                                            <input class="form-check-input " checked type="radio" name="payment"
                                                id="Online" value="Online">
                                            <label class="form-check-label" for="Online">
                                                Online
                                            </label>
                                        </div><br>
                                        <div class="form-check ">
                                            @if ($total == 0)
                                                <a href="{{ url('/') }}/AllProducts" type="submit"
                                                    class="btn btn-outline-danger">Go To
                                                    Products</a>
                                            @else
                                                <button type="submit" class="btn btn-outline-success">Place
                                                    Order
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            @endguest
        </div>
        <!-- / Cart view section -->
    @endsection
