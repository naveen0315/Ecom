@extends('layouts.app')

@section('content')

<!-- Message -->
@if(session()->has('message'))

  <div class="alert alert-danger">
  {{ session()->get('message') }}
  </div>
@endif

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <br>
            <div class="card">
                <div class="card-header">{{ __('Shopping Cart') }}
                    <a class="float-end" href="{{ url('/') }}/home">Back</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">@sortablelink('id', 'Sr.No')</th>
                            <th scope="col">@sortablelink('product_id', 'Product ID')</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">@sortablelink('price','Price')</th>
                            <th scope="col">Image</th>
                            <th scope="col">@sortablelink('quantity','Order Quantity')</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($ShopCart as $cart )
                            <tr>
                              <th style="padding: 10px;" scope="row">{{$cart['id']}}</th>
                              <th style="padding: 10px;" scope="row">{{$cart['product_id']}}</th>
                              <td class="text-uppercase " style="width: 200px; padding: 10px;">{{$cart->product->product_name}}</td>
                              <td style="padding: 10px;">&#8377;{{$cart['price']}}</td>
                              <td><img style="width: 100px; padding: 10px;"  src="{{url('/')}}{{ config('app.img_path')}}{{$cart->product->image}}" alt=""></td>
                              <td style="padding: 10px;">{{$cart['quantity']}}</td>

                              <td style="width: 250px; padding: 10px;">

                                  <a href="{{url('/')}}/adminProductView/{{$cart['product_id']}}" type="button" class="btn btn-outline-primary">View</a>


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
@endsection
