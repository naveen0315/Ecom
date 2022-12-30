@extends('layouts.app')

@section('content')
@foreach($Brands as $brandname)
@endforeach

<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-5">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Product Brands') }}
                    <a class="float-end" href="{{ url('/') }}/home">Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/') }}/editBrands/{{$brandname->id}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="brand_name" class="col-md-4 col-form-label text-md-end">{{ __('Brand Name')
                                }}</label>
                            <div class="col-md-6">
                                <input id="brand_name" type="name"
                                    class="form-control @error('brand_name') is-invalid @enderror" name="brand_name"
                                    value="{{ $brandname->brand_name }}" autocomplete="brand_name" autofocus>
                                @error('brand_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-outline-success">
                                    {{ __('Edit Brand') }}
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
