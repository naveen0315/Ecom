@extends('layouts.nav')
@section('content')
@foreach ($newAddressUser as $userAddress)

@endforeach
    <div class="container">
        <!-- Message -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('User Address') }}
                        <a class="float-end" href="{{ url('/') }}/{{ Auth::id() }}">Back</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/')}}/userAddress/{{ $userAddress->id }}">
                            @csrf
                            @foreach ($newAddressUser as $userAddress)
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                                <input class="" id="First_Name" type="text"
                                                    name="First_Name" placeholder="First Name*"
                                                    value="{{ $userAddress['First_Name'] }}"
                                                    autocomplete="First_Name" autofocus>
                                                @error('First_Name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                                <input class=" " id="Last_Name" type="text"
                                                    name="Last_Name" placeholder="Last Name*"
                                                    value="{{ $userAddress['Last_Name'] }}"
                                                    autocomplete="Last_Name" autofocus>
                                                @error('Last_Name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                                <input class=" @error('email') is-invalid @enderror"
                                                    id="email" name="email" type="email"
                                                    placeholder="Email Address*"
                                                    value="{{ $userAddress['email'] }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                                <input class=" @error('mobile') is-invalid @enderror"
                                                    id="mobile" name="mobile" type="text"
                                                    placeholder="Phone*"
                                                    value="{{ $userAddress['mobile'] }}">
                                                @error('mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="aa-checkout-single-bill">
                                                <textarea class=" @error('address') is-invalid @enderror" id="address" name="address"
                                                    value="{{ $userAddress['address'] }}">{{ $userAddress['address'] }}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                                <input class=" @error('state') is-invalid @enderror"
                                                    id="state" name="state" type="text"
                                                    value="{{ $userAddress['state'] }}"
                                                    placeholder="State">
                                                @error('state')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                                <input class=" @error('city') is-invalid @enderror"
                                                    id="city" name="city" type="text"
                                                    placeholder="City / Town*"
                                                    value="{{ $userAddress['city'] }}">
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                                <input class=" @error('district') is-invalid @enderror"
                                                    id="district" name="district" type="text"
                                                    placeholder="District*"
                                                    value="{{ $userAddress['district'] }}">
                                                @error('district')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="aa-checkout-single-bill">
                                                <input class=" @error('pincode') is-invalid @enderror"
                                                    id="pincode" name="pincode" type="text"
                                                    placeholder="Postcode / ZIP*"
                                                    value="{{ $userAddress['pincode'] }}">
                                                @error('pincode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
