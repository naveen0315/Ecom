@extends('layouts.app')

@section('content')
@foreach($Category as $categoryname)
@endforeach

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <!-- Message -->
            @if(session()->has('message'))

            <div class="alert alert-success">
            {{ session()->get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Product Categories') }}
                    <a class="float-end" href="{{ url('/') }}/home">Back</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/') }}/editCategory/{{$categoryname->id}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="categories_name" class="col-md-4 col-form-label text-md-end">{{ __('Category Name') }}</label>

                            <div class="col-md-6">
                                <input id="categories_name" type="name" class="form-control @error('categories_name') is-invalid @enderror" name="categories_name" value="{{ $categoryname->categories_name }}" autocomplete="categories_name" autofocus>

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
                                    {{ __('Edit Category') }}
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
