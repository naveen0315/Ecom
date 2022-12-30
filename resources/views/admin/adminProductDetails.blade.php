@extends('layouts.app')

@section('content')
    @foreach ($singleProduct as $productDetail)
        <div class="container mt-5 mb-5">
            <div class="row d-flex justify-content-center">
                <!-- Message -->
                @if (session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                @endif
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
                                            <a href="{{ url('/') }}/allproducts"><i class="fa fa-long-arrow-left"></i>
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

                                        <a href="{{ url('/') }}/editProducts/{{ $productDetail['id'] }}"
                                            class="btn btn-outline-success text-uppercase mr-2 px-4">Edit</a>

                                        <a href="{{ url('/') }}/deleteProducts/{{ $productDetail['id'] }}"
                                            type="button"
                                            class="btn btn-outline-danger text-uppercase mr-2 px-4">Delete</a>
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
