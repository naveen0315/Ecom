@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Hello ADMINISTRATOR, You are logged in!') }}
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <a href="{{url('/')}}/brands" class="btn btn-outline-primary">Add Brands</a>
                        <a href="{{url('/')}}/category" class="btn btn-outline-secondary">Add Product Category</a>
                        <a href="{{url('/')}}/products" class="btn btn-outline-success">Add Products</a>
                        <a href="{{url('/')}}/allproducts" class="btn btn-outline-warning">All Products</a>
                        <a href="{{url('/')}}/orders" class="btn btn-outline-danger">Orders</a>

                    </div>
                    <div class="card-body">

                        <a href="{{url('/')}}/users" class="btn btn-outline-primary">All Users</a>
                        {{-- <a href="" class="btn btn-outline-danger">Emails</a> --}}
                        <a href="{{url('/')}}/payments" class="btn btn-outline-warning">Payments</a>
                        {{-- <a href="" class="btn btn-outline-info">Refund</a> --}}
                        {{-- <a href="" class="btn btn-outline-danger">Returned Orders</a> --}}
                        {{-- <a href="" class="btn btn-outline-dark">Shipments</a> --}}
                        
                        {{-- <a href="{{url('/')}}/adminCart" class="btn btn-outline-success">Cart</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
