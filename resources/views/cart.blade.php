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
            <thead>
                <tr>
                    <th scope="col" ></th>
                    <th scope="col" style="width:50%">Product Name</th>
                    <th scope="col" >Price</th>
                    <th scope="col"  style="width:150px" >Quantity</th>
                    <th scope="col"  >Subtotal</th>
                    <th scope="col" ></th>
                </tr>
            </thead>

            <tbody>
                @php $total = 0 @endphp
                @foreach ($userCart as $cartData)
                    <tr class="product_data">
                        <td>
                            <a href="{{url('/')}}/ProductView/{{$cartData->product['id']}}">
                                <img src="{{ url('/') }}{{ config('app.img_path') }}/{{ $cartData->product['image'] }}"
                                    width="100" height="100" class="img-responsive" />
                            </a>
                        </td>
                        <td>
                            <a href="{{url('/')}}/ProductView/{{$cartData->product['id']}}">
                                 {{ $cartData->product['product_name'] }}
                            </a>
                        </td>
                        <td >&#8377;{{ $cartData->product['price'] }}</td>
                        <td  style="width:30px">
                            @if ($cartData->product['quantity'] >= $cartData->quantity)
                                <input type="hidden" class="product_id" value="{{$cartData->product['id']}}">


                                <input min="1" max="20"
                                type="number" name="quantity" value="{{ $cartData->quantity }}" class="form-control update-cart" />


                                @php $total += $cartData->product['price'] * $cartData['quantity'] @endphp
                            @else
                            <span class="btn-danger" style="padding:5px; border-radius:10px">Out Of Stock</span>
                            @endif
                        </td>
                        <td>&#8377;{{ $cartData->product['price'] * $cartData['quantity'] }}</td>
                        <td class="actions" data-th="">
                            <a href="{{ url('/') }}/removeCart/{{ $cartData['product_id']}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">
                        <h3><strong>Total &#8377;{{ $total }}</strong></h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">
                        <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue
                            Shopping</a>
                        @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" type="submit" class="btn btn-danger">Login</a>
                        @endif
                            @else
                            @if ($total == 0 )
                                <a href="{{ url('/') }}/AllProducts" type="submit" class="btn btn-danger">Go To Products</a>
                            @else
                                <a href="{{ url('/') }}/checkout" class="btn btn-success">Checkout</a>
                            @endif
                        @endguest
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- Update Cart Product Quantatiy --}}
    <script type="text/javascript">
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
         });
        $(".update-cart").click(function(e) {

            e.preventDefault();

            var prod_id = $(this).closest('.product_data').find('.product_id').val();
            var qty = $(this).closest('.product_data').find('.update-cart').val();
            // var prices = $(this).closest('.product_data').find('.prices').val();
            data = {
                'product_id'  : prod_id,
                'quantity' : qty,
                // 'prices' : prices,
            }
            $.ajax({
                method: "POST",
                url : "updateCart",
                data : data,
                success: function(response){
                    // alert(response)
                    location.reload();
                }

            });
        });
    </script>

@endsection
