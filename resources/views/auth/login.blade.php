<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="Style/fonts/icomoon/style.css" />

  <link rel="stylesheet" href="Style/css/owl.carousel.min.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="Style/css/bootstrap.min.css" />

  <!-- Style -->
  <link rel="stylesheet" href="Style/css/style.css" />

  <title>Login | ECOM</title>
</head>

<body>
  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('Style/images/bg_1.jpg')"></div>
    <div class="contents">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 class="text-uppercase">
                  {{ __("Login") }}
                </h3>
              </div>
              <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group first">
                  <label for="email" class="col-form-label">{{ __("Email Address") }}</label>
                  <input placeholder="Enter Email ID" id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    autocomplete="email" autofocus />
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                {{-- Password --}}
                <div class="form-group last mb-3">
                  <label for="password" class="col-form-label">{{ __("Password") }}</label>
                  <input placeholder="Enter Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" autocomplete="current-password" />
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                </div>

                <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                    <div class="control__indicator"></div>
                  </label>
                    @if (Route::has('password.request'))
                        <a class="col-form-label ml-auto" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                </div>

                <input type="submit" value="Log In" class="btn btn-block py-2 btn-primary" />
                @if (Route::has('register'))
                  <a class="col-form-label" href="{{ route('register')}}">
                    New customer?.{{ __('Start here') }}
                  </a>
                @endif

                {{-- <span class="text-center my-3 d-block">or</span> --}}

                {{-- <div class="">
                  <a href="#" class="btn btn-block py-2 btn-facebook">
                    <span class="icon-facebook mr-3"></span>
                    Login with facebook
                  </a>
                  <a href="#" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span>
                    Login with Google</a>
                </div> --}}
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
