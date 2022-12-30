@extends('layouts.app')

@section('content')
@foreach($ProEdit as $editPro )

@endforeach
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
             @endif
            <div class="card">
                <div class="card-header">{{ __('Add Products') }}
                    <a class="float-end" href="{{ url('/') }}/allproducts">Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/') }}/editProducts/{{$editPro ->id}}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('Product Name') }}</label>
                            <div class="col-md-6">
                                <input id="product_name" type="text" class="form-control" name="product_name" value="{{$editPro ->product_name}}"  autocomplete="product_name" autofocus>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control " name="description" value="{{$editPro ->description}}"   autocomplete="description" autofocus>{{$editPro ->description}}</textarea>

                            </div>
                        </div>

                        <!-- Category -->
                        <div class="row mb-3">
                            <label for="cat_id" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select id="cat_id" class="form-select "  name="cat_id"  >
                                    <option selected>Choose Category</option>
                                    @foreach ($AllCategories as $category )

                                        @if ($category->id == $editPro ->cat_id)
                                            <option selected value="{{$category -> id}}" >{{$category -> categories_name}}</option>
                                        @else
                                            <option  value="{{$category -> id}}" >{{$category -> categories_name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Brand -->
                        <div class="row mb-3">
                            <label for="brand_id" class="col-md-4 col-form-label text-md-end">{{ __('Brand') }}</label>
                            <div class="col-md-6">
                                <select id="brand_id" class="form-select "  name="brand_id" aria-label="Default select example">
                                    <option >Choose Brand</option>
                                    @foreach ($AllBrand as $brand )
                                        @if ($brand->id == $editPro ->brand_id)
                                            <option selected value="{{$brand -> id}}">{{$brand -> brand_name}}</option>
                                        @else
                                            <option value="{{$brand -> id}}">{{$brand -> brand_name}}</option>
                                        @endif
                                    @endforeach
                               </select>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control " name="price" value="{{$editPro ->price}}"  autocomplete="price" autofocus>

                            </div>
                        </div>

                        <!-- Old Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Old Image') }}</label>
                            <div class="col-md-6">
                                <img style="width: 100px; padding: 10px;"  src="{{url('/')}}{{ config('app.img_path')}}{{$editPro ->image}}" alt="">
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" value="{{$editPro ->image}}"  autocomplete="image" autofocus>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>
                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control " name="quantity" value="{{$editPro ->quantity}}"  autocomplete="quantity" autofocus>

                            </div>
                        </div>

                        <!-- Color -->
                        <div class="row mb-3">
                            <label for="color" class="col-md-4 col-form-label text-md-end">{{ __('Color') }}</label>
                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control" name="color"
                                value="{{$editPro ->color}}"  autocomplete="color" autofocus>

                            </div>
                        </div>

                        <!-- Size -->
                        <div class="row mb-3">
                            <label for="size" class="col-md-4 col-form-label text-md-end">{{ __('Size') }}</label>
                            <div class="col-md-6">
                                <input id="size" type="text" class="form-control " name="size"
                                value="{{$editPro ->size}}"  autocomplete="size" autofocus>

                            </div>
                        </div>

                        <!-- Button -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-outline-success">
                                    {{ __('Update Product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
