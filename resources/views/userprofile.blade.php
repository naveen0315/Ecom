@extends('layouts.nav')

@section('content')
<style>
        .avatar-upload {
        position: relative;
        max-width: 200px;
        margin: 30px auto;
        }
        .avatar-upload .avatar-edit {
        position: absolute;
        right: 90px;
        z-index: 1;
        top: 60px;
        }
        .avatar-upload .avatar-edit input {
        display: none;
        }
        .avatar-upload .avatar-edit input + label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
        }
        .avatar-upload .avatar-edit input + label:after {
        content: "\f040";
        font-family: 'FontAwesome';
        color: #757575;
        position: absolute;
        top: 5px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
        }
        .avatar-upload .avatar-preview {
        width: 100px;
        height: 100px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        }
</style>

    @foreach ($users as $data)
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
                    <div class="card-header">{{ __('User Profile') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/') }}/userProfile/{{ $data->id }}" enctype="multipart/form-data">
                            @csrf
                            {{-- Profile Image --}}
                            <div class="container">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' value="{{ old('image') }}" id="image" class="form-control @error('image') is-invalid @enderror" name="image" />
                                        <label for="image"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('{{ url('/') }}{{ config('app.img_path2') }}/{{ $data->image}}');"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- First Name -->
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="First_Name" type="text"
                                        class="form-control @error('First_Name') is-invalid @enderror" name="First_Name"
                                        value="{{ $data->First_Name }}" autocomplete="First_Name" autofocus>

                                    @error('First_Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="row mb-3">
                                <label for="Last_Name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="Last_Name" type="text"
                                        class="form-control @error('Last_Name') is-invalid @enderror" name="Last_Name"
                                        value="{{ $data->Last_Name }}" autocomplete="Last_Name" autofocus>

                                    @error('Last_Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- email -->
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $data->email }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mobile -->
                            <div class="row mb-4">
                                <label for="mobile"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text"
                                        class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                        value="{{ $data->mobile }}" autocomplete="mobile" autofocus>

                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="row mb-3">
                                <label for="gender"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input checked class="form-check-input @error('gender') is-invalid @enderror"
                                            type="radio" name="gender" id="male" value="male">
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('User Address') }}
                        <button type="button" class="btn btn-outline-success float-end" data-bs-toggle="modal"
                            data-bs-target="#exampleModal2">Add New Address</button>
                    </div>
                    <div class="card-body">
                        @foreach ($addressUser as $userAddress)
                            <h5 class="card-title">
                                {{ $userAddress->First_Name }}
                                {{ $userAddress->Last_Name }}
                                <a href="{{ url('/') }}/userAddress/{{ $userAddress->id }}" type="button"
                                    class="btn btn-outline-primary float-end">Edit</a>
                            </h5>
                            <p class="card-text">Email: {{ $userAddress->email }}</p>
                            <p class="card-text">Address: {{ $userAddress->address }}, District:
                                {{ $userAddress->district }},
                                State: {{ $userAddress->state }}, Pin Code:
                                {{ $userAddress->pincode }}</p>
                            <hr>
                        @endforeach

                        {{-- Add User Address Modal --}}
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">Add User Address</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="/addUserAddress">
                                            @csrf
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="aa-checkout-single-bill">
                                                            <input class=" @error('First_Name') is-invalid @enderror"
                                                                id="First_Name" type="text" name="First_Name"
                                                                placeholder="First Name*" value="{{ old('First_Name') }}"
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
                                                            <input class=" @error('Last_Name') is-invalid @enderror"
                                                                id="Last_Name" type="text" name="Last_Name"
                                                                placeholder="Last Name*" value="{{ old('Last_Name') }}"
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
                                                                placeholder="Email Address*" value="{{ old('email') }}">
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
                                                                placeholder="Phone*" value="{{ old('mobile') }}">
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
                                                                value="{{ old('address') }}">Write Your Address Here!!!</textarea>
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
                                                                value="{{ old('state') }}" placeholder="State">
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
                                                                placeholder="City / Town*" value="{{ old('city') }}">
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
                                                                placeholder="District*" value="{{ old('district') }}">
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
                                                                value="{{ old('pincode') }}">
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
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Image script --}}
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function() {
        readURL(this);
    });
</script>
