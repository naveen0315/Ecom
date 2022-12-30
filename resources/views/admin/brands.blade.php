@extends('layouts.app')

@section('content')

<!-- Message -->
@if(session()->has('message'))

  <div class="alert alert-danger">
  {{ session()->get('message') }}
  </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Product Brands List') }}
                    <a class="float-end" href="{{ url('/') }}/home">Back</a>

                </div>
                <div class="card-body">
                    <table class="table">
                        <thead >
                            <tr>
                                <th style="padding-left:70px" scope="col">Brand ID</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allBrands as $brands )
                            <tr>
                                <th style="padding-left:80px" scope="row">{{$brands['id']}}</th>
                                <td>{{$brands['brand_name']}}</td>
                                <td>
                                    <a href="{{url('/')}}/editBrands/{{$brands['id']}}" class="btn btn-outline-success">Edit</a>
                                    <a href="{{url('/')}}/deleteBrands/{{$brands['id']}}" type="button" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="display: flex; justify-content: center;">{!! $allBrands->appends(Request::all())->links() !!}</div>
            </div>
        </div>
        <div class="col-md-5">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Product Brands') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/') }}/brands">
                        @csrf
                        <div class="row mb-3">
                            <label for="brand_name" class="col-md-4 col-form-label text-md-end">{{ __('Brand Name')
                                }}</label>
                            <div class="col-md-6">
                                <input id="brand_name" type="name"
                                    class="form-control @error('brand_name') is-invalid @enderror" name="brand_name"
                                    value="{{ old('brand_name') }}" autocomplete="brand_name" autofocus>
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
                                    {{ __('ADD') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="form-inline my-2 my-lg-0">
                        <button style="border-radius: 0px" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        <input style="border-radius: 0px; width:80%" class="form-control mr-sm-2" name="search" type="search" placeholder="Search By: Brand Name" aria-label="Search">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
