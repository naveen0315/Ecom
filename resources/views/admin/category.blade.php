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
                <div class="card-header">{{ __('Product Category List') }}
                    <a class="float-end" href="{{ url('/') }}/home">Back</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th style="padding-left:70px" scope="col">Category ID</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($allCategory as $category )
                          <tr>
                            <th style="padding-left:80px" scope="row">{{$category['id']}}</th>
                            <td scope="row">{{$category['categories_name']}}</td>
                            <td scope="row" >
                                <a href="{{url('/')}}/editCategory/{{$category['id']}}" class="btn btn-outline-success">Edit</a>
                                <a href="{{url('/')}}/deleteCategory/{{$category['id']}}" type="button" class="btn btn-outline-danger">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
             @endif
            <div class="card">
                <div class="card-header">{{ __('Product Categories') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/') }}/category">
                        @csrf
                        <div class="row mb-3">
                            <label for="categories_name" class="col-md-4 col-form-label text-md-end">{{ __('Category Name') }}</label>

                            <div class="col-md-6">
                                <input id="categories_name" type="name" class="form-control @error('categories_name') is-invalid @enderror" name="categories_name" value="{{ old('categories_name') }}" autocomplete="categories_name" autofocus>

                                @error('categories_name')
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
        </div>
    </div>
</div>

@endsection
