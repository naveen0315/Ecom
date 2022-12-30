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
            <h2>
                My Wishlist</h2>
            <thead>
                <tr>
                    <th scope="col" style="width:50%">Product Name</th>
                    <th scope="col" >Price</th>
                    <th scope="col" >Stock Status</th>
                    <th >Action</th>
                </tr>
            </thead>
            @foreach ($wishData as $wish)
                <tr>
                    <td>{{ $wish->Products['product_name'] }}</td>
                    <td>{{ $wish->Products['price'] }}</td>
                    <td>{{ $wish->Products['quantity'] }}</td>
                    <td>
                        @if ($wish->Products['quantity'] == 0)
                            <span style="background-color: red; border-radius:10px; padding:10px">Out Of Stock</span>
                        @else
                            <a href="{{ url('/') }}/addToCart/{{ $wish->Products['id'] }}" class="btn btn-outline-success">Add To Cart </a>
                        @endif
                        <a href="{{ url('/') }}/removeWish/{{ $wish->Products['id'] }}" class="btn btn-outline-danger">Delete</a>
                    </td>
                </tr>

            @endforeach

            <tbody>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
        <div style="display: flex; justify-content: center;">{!! $wishData->appends(Request::all())->links() !!}</div>
    </div>
@endsection
