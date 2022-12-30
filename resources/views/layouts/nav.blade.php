<!DOCTYPE html>
<html>

<head>
   <!-- Basic -->
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <!-- Mobile Metas -->
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <!-- Site Metas -->
   <meta name="keywords" content="" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
   <title>Ecom | Naveen</title>
   <!-- bootstrap core css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
   <!-- font awesome style -->
   <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
   <!-- Custom styles for this template -->
   {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet" /> --}}
   <!-- responsive style -->
   <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">



</script>

</head>

<body>

      <!-- header section strats -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src="{{ asset('images/logo.png')}}" alt="Logo" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form class="d-flex">
                                <input class="form-control me-2 search" name="search" type="search" placeholder="Search By: name, price, color" aria-label="Search">
                                <button class="btn btn-outline-success searchbtn" type="submit">Search</button>
                            </form>
                        </li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img style="border-radius:50px" src="{{ url('/') }}{{ config('app.img_path2') }}/{{ Auth::user()->image}}"
                                    width="30" height="30" class="img-responsive" />
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/') }}/userProfile/{{ Auth::user()->id }}">
                                        {{ __('Your Account') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/') }}/userOrders">
                                        {{ __('Your Orders') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/') }}/wishlist">
                                        {{ __('Your Wish List') }}<span class="badge badge-pill badge-danger wish-count">0</span>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item">
                            <a href="{{ url('/') }}/Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span class="badge badge-pill badge-danger">
                                    <span class="badge badge-pill badge-danger cart-count">0</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- end header section -->
   <main class="py-4">
        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        @yield('content')
   </main>

   <!-- footer Start -->
    <footer>
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <div class="full">
                  <div class="logo_footer">
                     <a href="#"><img width="210" src="{{ asset('images/logo.png')}}" alt="#" /></a>
                  </div>
                  <div class="information_f">
                     <p><strong>ADDRESS:</strong> 28 White tower, Street Name New York City, USA</p>
                     <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                     <p><strong>EMAIL:</strong> yourmain@gmail.com</p>
                  </div>
               </div>
            </div>
            <div class="col-md-8">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="widget_menu">
                              <h3>Menu</h3>
                              <ul>
                                 <li><a href="#">Home</a></li>
                                 <li><a href="#">About</a></li>
                                 <li><a href="#">Services</a></li>
                                 <li><a href="#">Testimonial</a></li>
                                 <li><a href="#">Blog</a></li>
                                 <li><a href="#">Contact</a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="widget_menu">
                              <h3>Account</h3>
                              <ul>
                                 <li><a href="#">Account</a></li>
                                 <li><a href="#">Checkout</a></li>
                                 <li><a href="#">Login</a></li>
                                 <li><a href="#">Register</a></li>
                                 <li><a href="#">Shopping</a></li>
                                 <li><a href="#">Widget</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- footer end -->

   <div class="cpy_">
    <p class="mx-auto">© 2022 Design & Developed <a href="">Naveen Aggarwal</a></p>

      </p>
   </div>
   <!-- jQery -->
   <script src="{{ asset('js/jquery-3.4.1.min.js')}}"></script>
   <!-- popper js -->
   <script src="{{ asset('js/popper.min.js')}}"></script>
   <!-- bootstrap js -->
   <script src="{{ asset('js/bootstrap.js')}}"></script>
   <!-- custom js -->
   <script src="{{ asset('js/custom.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js" integrity="sha512-4WpSQe8XU6Djt8IPJMGD9Xx9KuYsVCEeitZfMhPi8xdYlVA5hzRitm0Nt1g2AZFS136s29Nq4E4NVvouVAVrBw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $(document).ready(function() {
        loadcart();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function loadcart()
        {
            $.ajax({
                method: "GET",
                url: "/load-cart-data",
                success: function (response){
                    $('.cart-count').html('');
                    $('.cart-count').html(response.count);
                }
        });

        }

        });
        $(document).ready(function() {
            loadwish();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function loadwish()
            {
                $.ajax({
                    method: "GET",
                    url: "/load-wish-data",
                    success: function (response){
                        $('.wish-count').html('');
                        $('.wish-count').html(response.count);
                    }
            });

            }

            });

</script>

</body>

</html>
@yield('scripts')
