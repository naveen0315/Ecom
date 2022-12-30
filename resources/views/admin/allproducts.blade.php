@extends('layouts.app')

@section('content')
    {{-- Search Bar --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card-header">
                    <form class="form-inline my-2 my-lg-0 float-end">
                        <input class="form-control mr-sm-2" name="search" type="search"
                            placeholder="Search By: name, price, color" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Message -->
    @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <br>
                <div class="card">
                    <div class="card-header">{{ __('All Products') }}
                        <a class="float-end" href="{{ url('/') }}/home">Back</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@sortablelink('id', 'Sr.No')</th>
                                    <th scope="col">@sortablelink('product_name', 'Product Name')</th>
                                    <th scope="col">@sortablelink('brand_id', 'Brand Name')</th>
                                    <th scope="col">@sortablelink('cat_id', 'Category')</th>
                                    <th scope="col">@sortablelink('description', 'Description')</th>
                                    <th scope="col">@sortablelink('price', 'Price')</th>
                                    <th scope="col">@sortablelink('inage`', 'Image')</th>
                                    <th scope="col">@sortablelink('quantity', 'Stock')</th>
                                    <th scope="col">@sortablelink('color', 'Color')</th>
                                    <th scope="col">@sortablelink('size', 'Size')</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AllProducts as $products)
                                    <tr>
                                        <th style="padding: 10px;" scope="row">{{ $products['id'] }}</th>
                                        <td style="width: 200px; padding: 10px;">{{ $products['product_name'] }}</td>
                                        <td style="width: 150px; padding: 10px;">{{ $products->brand->brand_name }}</td>
                                        <td style="padding: 10px;">{{ $products->category->categories_name }}</td>
                                        <td style="width: 400px; padding: 10px;">{{ $products['description'] }}</td>
                                        <td style="padding: 10px;">&#8377;{{ $products['price'] }}</td>
                                        <td><img style="width: 100px; padding: 10px;"
                                                src="{{ url('/') }}{{ config('app.img_path') }}{{ $products['image'] }}"
                                                alt=""></td>
                                        <td style="padding: 10px;">{{ $products['quantity'] }}</td>
                                        <td style="padding: 10px;">{{ $products['color'] }}</td>
                                        <td style="padding: 10px;">{{ $products['size'] }}</td>
                                        <td style="width: 250px; padding: 10px;">
                                            <a href="{{ url('/') }}/adminProductView/{{ $products['id'] }}"
                                                type="button" class="btn btn-outline-primary">View</a>
                                            <a href="{{ url('/') }}/editProducts/{{ $products['id'] }}"
                                                class="btn btn-outline-success">Edit</a>
                                            <a href="{{ url('/') }}/deleteProducts/{{ $products['id'] }}"
                                                type="button" class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: center;">{!! $AllProducts->appends(Request::all())->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
