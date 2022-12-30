@extends('layouts.nav')
@section('content')
    <!-- Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @foreach ($singleProduct as $productDetail)
        <div class="container mt-5 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="images p-5">
                                    <div class="text-center "> <img id="main-image"
                                            src="{{ url('/') }}{{ config('app.img_path') }}{{ $productDetail->image }}"
                                            width="100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ url('/') }}/AllProducts"><i class="fa fa-long-arrow-left"></i>
                                                <span class="ml-1">Back</span>
                                        </div> </a>
                                    </div>
                                    <div class="mt-4 mb-3">
                                        <span
                                            class="text-uppercase text-muted brand">{{ $productDetail->category->categories_name }}
                                        </span>
                                        <span style="color:red">//</span>
                                        <span
                                            class="text-uppercase text-muted brand">{{ $productDetail->brand->brand_name }}</span>
                                        <h5 class="text-uppercase">{{ $productDetail->product_name }}</h5>
                                        <div class="price d-flex flex-row align-items-center"> <span
                                                class="act-price">&#8377; {{ $productDetail->price }}</span>

                                        </div>
                                    </div>
                                    <p class="about">{{ $productDetail->description }}</p>

                                    <div class="cart mt-4 align-items-center">

                                        @if ($productDetail->quantity == 0)
                                            <span class="btn-danger" style="padding:10px; border-radius:10px">Out Of
                                                Stock</span>
                                            <a href="{{ url('/') }}/addwishlist/{{ $productDetail['id'] }}">
                                                <i class="fa fa-heart text-muted"></i></a>
                                        @else
                                            <a href="{{ url('/') }}/addToCart/{{ $productDetail['id'] }}"
                                                class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</a>

                                            {{-- <a href="{{ url('/') }}/buyNow/{{ $productDetail['id'] }}"
                                                class="btn btn-danger text-uppercase mr-2 px-4">Buy Now</a> --}}

                                            <a href="{{ url('/') }}/addwishlist/{{ $productDetail['id'] }}">
                                                <i class="fa fa-heart text-muted"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
