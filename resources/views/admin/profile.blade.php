@extends('layouts.app')

@section('content')
@foreach($users as $data)

@endforeach

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Message -->
            @if(session()->has('message'))

            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif


            <form method="POST" action="{{url('/')}}/adminProfile/{{$data->id}}">
                @csrf
                <!-- First Name -->
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                    <div class="col-md-6">
                        <input id="First_Name" type="text"
                            class="form-control @error('First_Name') is-invalid @enderror" name="First_Name"
                            value="{{ $data->First_Name}}" autocomplete="First_Name" autofocus>

                        @error('First_Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Last Name -->
                <div class="row mb-3">
                    <label for="Last_Name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name')
                        }}</label>

                    <div class="col-md-6">
                        <input id="Last_Name" type="text" class="form-control @error('Last_Name') is-invalid @enderror"
                            name="Last_Name" value="{{ $data->Last_Name}}" autocomplete="Last_Name" autofocus>

                        @error('Last_Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- email -->
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                        }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $data->email}}" autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Mobile -->
                <div class="row mb-3">
                    <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>

                    <div class="col-md-6">
                        <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                            name="mobile" value="{{ $data->mobile}}" autocomplete="mobile" autofocus>

                        @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Gender -->
                <div class="row mb-3">
                    <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                name="gender" id="male" value="male">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                name="gender" id="female" value="female">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-outline-success">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection