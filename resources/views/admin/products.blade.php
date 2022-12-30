@extends('layouts.app')

@section('content')

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
                    <a class="float-end" href="{{ url('/') }}/home">Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/') }}/products" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('Product Name') }}</label>
                            <div class="col-md-6">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}"  autocomplete="product_name" autofocus>
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autocomplete="description" autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="row mb-3">
                            <label for="cat_id" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select id="cat_id"  class="form-select @error('description') is-invalid @enderror"  name="cat_id" >
                                    <option  selected>Choose Category</option>
                                    @foreach ($AllCategory as $category )
                                        <option value="{{$category -> id}}">{{$category -> categories_name}}</option>
                                    @endforeach
                                </select>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The Category name is required.') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Brand -->
                        <div class="row mb-3">
                            <label for="brand_id" class="col-md-4 col-form-label text-md-end">{{ __('Brand') }}</label>
                            <div class="col-md-6">
                                <select id="brand_id" class="form-select @error('description') is-invalid @enderror"  name="brand_id" aria-label="Default select example">
                                    <option >Choose Brand</option>
                                    @foreach ($AllBrands as $brand )
                                        <option value="{{$brand -> id}}">{{$brand -> brand_name}}</option>
                                    @endforeach
                               </select>
                               @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The brand name is required.') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="image" autofocus>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>
                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}"  autocomplete="quantity" autofocus>
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Color -->
                        <div class="row mb-3">
                            <label for="color" class="col-md-4 col-form-label text-md-end">{{ __('Color') }}</label>
                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}"  autocomplete="color" autofocus>
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Size -->
                        <div class="row mb-3">
                            <label for="size" class="col-md-4 col-form-label text-md-end">{{ __('Size') }}</label>
                            <div class="col-md-6">
                                <input id="size" type="text" class="form-control @error('size') is-invalid @enderror" name="size" value="{{ old('size') }}"  autocomplete="size" autofocus>
                                @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-outline-success">
                                    {{ __('ADD PRODUCT') }}
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
