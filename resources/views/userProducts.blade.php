@extends('layouts.nav')

@section('content')
    <!-- Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <!-- product section -->
    <section class="product_section layout_padding">
        <div class="container-fluid e-2" style="width:90%">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>Products</span>
                </h2>
            </div>
            <div class="row">
                @foreach ($AllPro as $products)
                    <div class="card" style="width: 18rem;">
                        <div class="box">
                            <a href="{{url('/')}}/ProductView/{{$products['id']}}">
                            <div class="option_container">
                                <div class="options">
                                    {{-- <a href="{{url('/')}}/ProductView/{{$products['id']}}" class="option1">
                                        {{$products['product_name']}}
                                    </a> --}}
                                    @if ($products->quantity == 0)
                                        <span class="btn-danger" style="padding:10px; border-radius:10px">Out Of
                                            Stock</span>
                                        <a href="{{ url('/')}}/addwishlist/{{ $products['id']}}"><i class="fa fa-heart text-muted"></i></a>
                                    @else
                                        <a href="{{ url('/') }}/addToCart/{{ $products['id'] }}" class="option3">Add to
                                            cart</a>
                                        {{-- <a href="{{ url('/') }}/buyNow/{{ $products['id'] }}" class="option2">Buy Now</a> --}}
                                        <a href="{{ url('/')}}/addwishlist/{{ $products['id']}}"><i class="fa fa-heart text-muted"></i></a>

                                    @endif
                                </div>
                            </div>
                        </a>
                            <div class="img-box ">
                                <img src="{{ url('/') }}{{ config('app.img_path') }}{{ $products['image'] }}"
                                    alt="">
                            </div>
                            <div class="detail-box">
                                <h6>
                                    {{ $products['product_name'] }}
                                </h6>
                            </div>
                            <div class="detail-box">
                                <h6>
                                    Price : &#8377;{{ $products['price'] }}
                                </h6>
                                <h6>
                                    Stock : {{ $products['quantity'] }}
                                </h6>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div style="display: flex; justify-content: center;">{!! $AllPro->appends(Request::all())->links() !!}</div>
@endsection
