<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />



    <link rel="stylesheet" href="Style/css/owl.carousel.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Style/css/bootstrap.min.css" />

    <!-- Style -->
    <link rel="stylesheet" href="Style/css/style.css" />

    <title>Login | ECOM</title>
</head>

<body style="font-family: Times New Roman">
    <div class="d-md-flex half">
        <div class="bg" style="background-image: url('Style/images/bg_1.jpg')"></div>
        <div class="contents">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <div class="col-md-8 form mx-auto">
                            <div class="text-center mb-5">
                                <h3 class="text-uppercase">
                                    {{ __("Looks like you're new here!") }}
                                </h3>
                                <h5>{{ __('Sign up with your Email ID to get started') }}</h5>
                            </div>
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label for="name"
                                                class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                                            <input id="First_Name" type="text"
                                                class="form-control @error('First_Name') is-invalid @enderror"
                                                name="First_Name" value="{{ old('First_Name') }}"
                                                autocomplete="First_Name" autofocus>

                                            @error('First_Name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label for="Last_Name"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                                            <input id="Last_Name" type="text"
                                                class="form-control @error('Last_Name') is-invalid @enderror"
                                                name="Last_Name" value="{{ old('Last_Name') }}" autocomplete="Last_Name"
                                                autofocus>

                                            @error('Last_Name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label for="email"
                                                class="col-md-6 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label for="mobile"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>
                                            <input id="mobile" type="text"
                                                class="form-control @error('mobile') is-invalid @enderror"
                                                name="mobile" value="{{ old('mobile') }}" autocomplete="mobile"
                                                autofocus>

                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                                                <label for="gender"
                                                    class="mb-0 px-1 me-4">{{ __('Gender') }}</label>
                                                <div class="form-check  p-4">
                                                    <input checked
                                                        class="form-check-input @error('gender') is-invalid @enderror"
                                                        type="radio" name="gender" id="male" value="male">
                                                    <label class="form-check-label" for="male">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check ">
                                                    <input
                                                        class="form-check-input @error('gender') is-invalid @enderror"
                                                        type="radio" name="gender" id="female" value="female">
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
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label for="image"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
                                            <input id="image" type="file"
                                                class="form-control @error('image') is-invalid @enderror"
                                                name="image" value="{{ old('image') }}" autocomplete="image"
                                                autofocus>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label for="password"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label for="password-confirm"
                                                class="col-md-6 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end pt-3">
                                    <button type="submit" class="btn btn-primary btn-lg ms-2">
                                        {{ __('Register') }}
                                    </button>
                                    <a href="{{ route('login') }}" type="button"
                                        class="btn btn-light btn-lg">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="Style/js/jquery-3.3.1.min.js"></script>
    <script src="Style/js/popper.min.js"></script>
    <script src="Style/js/bootstrap.min.js"></script>
    <script src="Style/js/main.js"></script>
</body>

</html>
