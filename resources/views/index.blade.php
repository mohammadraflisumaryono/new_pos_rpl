
@extends('template.app')
@section('head_khusus')
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="description" content="">
@endsection
@section('page_content')

<header>
    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>
</header>

<section id="banner">
    <div class="swiper main-swiper">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
            <div class="swiper-slide">
                <a href="{{ $slider->link }}">
                    <img src="{{ asset('storage/' . $slider->image_path) }}" class="img-fluid" alt="Banner Image">
                </a>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section id="categories" class="py-24 sm:py-8 px-4">
    <div class="container mx-auto max-w-[calc(100%-4rem)]"> 
        <div class="relative flex items-center justify-center">
            <button aria-label="slide backward" class=" z-30 left-0 ml-4 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 cursor-pointer rounded-full border-2 border-gray-400 p-2" id="prev">
                <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="w-full h-full mx-auto overflow-hidden relative px-12">
                <div id="slider" class="h-full flex items-center justify-start transition-transform ease-out duration-700" style="text-align: left;"> <!-- Geser isi ke kiri -->
                    @foreach($categories as $category)
                    <div class="flex flex-shrink-0 relative w-auto sm:w-auto text-center mx-2">
                        <a href="#" class="categories-item text-decoration-none d-inline-block">
                            <span class="badge bg-light text-dark d-flex align-items-center justify-center" style="font-size: 1em; padding: 0.5em;">
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->nama }}" class="img-fluid me-2" style="max-width: 20px;">
                                {{ $category->nama }}
                            </span>
                        </a>
                    </div>

                    @endforeach
                </div>
            </div>
            <button aria-label="slide forward" class="z-30 mr-4 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 cursor-pointer rounded-full border-2 border-gray-400 p-2" id="next">
                <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
    </div>
</section>

<section class="products">
    <div class="container">
        <div class="row justify-content-center">
            @if(Session::has('search_results'))
            <div class="col-12 text-center mb-3">
                <h5>Search Result</h5>
                <hr>
            </div>
            @foreach(Session::get('search_results') as $product)
            <div class="col-8 col-md-4 col-lg-2 mb-4">
                <div class="card card-custom h-100">
                    <img class="card-img-top" src="{{ asset('storage/'.$product->image) }}" alt="Product Image">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title font-semibold title-clamp">{{$product->nama}}</h6>
                        <div class="price-and-button mt-auto">
                            <p class="card-text text-green-500 text-right">{{$product->readAblePrice}}</p>
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('cart.store') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-custom">Beli</button>
                                </form>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary d-inline-block">Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            <div class="col-12 text-center mb-3">
                <h5>Product</h5>
                <hr>
            </div>
            @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card card-custom h-100">
                    <img class="card-img-top" src="{{ asset('storage/'.$product->image) }}" alt="Product Image">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title font-semibold title-clamp">{{$product->nama}}</h6>
                        <div class="price-and-button mt-auto">
                            <p class="card-text text-right">{{$product->readAblePrice}}</p>
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('cart.store') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-danger" style="background-color: #F9DAD6; border-color: #F9DAD6; color: #562D33">Beli</button>
                                </form>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-danger" style="background-color: #F9DAD6; border-color: #F9DAD6; color: #562D33">Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if(!Auth::user())
<section id="register" style="background: url('images/background-img.png') no-repeat;">
    <div class="container ">
        <div class="row my-5 py-5">
            <div class="offset-md-3 col-md-6 my-5 ">
                <h2 class="display-3 fw-normal text-center">Get 20% Off on <span class="text-primary">first Purchase</span></h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter Your Email Address" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control form-control-lg" name="password" id="password1" placeholder="Create Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control form-control-lg" name="password_confirmation" id="password2" placeholder="Repeat Password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-lg btn-primary" type="submit">Get Started</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endif

<section id="service">
    <div class="container py-5 my-5">
        <div class="row g-md-5 pt-4">
            <div class="col-md-3 my-3">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <img src="storage/images/qualityservice.png" class="rounded-circle me-3" alt="Gambar Kiri" style="width: 70px; height: 70px;">
                            <h3 class="card-title py-2 m-0" style="font-size: 0.9rem; font-weight: bold; color: #2c3e50;">Quality Service</h3>
                        </div>
                        <div class="card-text text-center">
                            <p class="blog-paragraph fs-6" style="color: #7f8c8d;">Hubungi kami, maka kami siap melayani anda</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <img src="storage/images/securepayment.png" class="rounded-circle me-3" alt="Gambar Kiri" style="width: 70px; height: 70px;">
                            <h3 class="card-title py-2 m-0" style="font-size: 0.9rem; font-weight: bold; color: #2c3e50;">100% Secure Payment</h3>
                        </div>
                        <div class="card-text text-center">
                            <p class="blog-paragraph fs-6" style="color: #7f8c8d;">Kami menjamin pembayaran anda aman dan terlindungi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <img src="storage/images/dailyoffer.png" class="rounded-circle me-3" alt="Gambar Kiri" style="width: 70px; height: 70px;">
                            <h3 class="card-title py-2 m-0" style="font-size: 0.9rem; font-weight: bold; color: #2c3e50;">Daily Offer</h3>
                        </div>
                        <div class="card-text text-center">
                            <p class="blog-paragraph fs-6" style="color: #7f8c8d;">Jangan lewatkan penawaran harian kami!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <img src="storage/images/qualityguarantee.png" class="rounded-circle me-3" alt="Gambar Kiri" style="width: 70px; height: 70px;">
                            <h3 class="card-title py-2 m-0" style="font-size: 0.9rem; font-weight: bold; color: #2c3e50;">Quality Guarantee</h3>
                        </div>
                        <div class="card-text text-center">
                            <p class="blog-paragraph fs-6" style="color: #7f8c8d;">Jangan khawatir! Kami siap memberikan kualitas terbaik!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<footer class="footer mt-auto py-5" style="background-color: #F9DAD680;">
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="mb-4" style="color: #562D33">Tentang Kami</h5>
                <p style="color: 62D33 ">Sunny Mart merupakan website supermarket yang bisa anda gunakan kapan dan dimana saja untuk memenuhi kebutuhan anda..</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-4" style="color: #562D33;">Hubungi Kami</h5>
                <p style="color: #562D33;">Alamat: Jalan A.H Nasution No.76, Bandung, Jawa Barat, 40614</p>
                <p style="color: #562D33;">Email: sunnymart@gmail.com</p>
                <p style="color: #562D33;">Telepon: 123-456-7890</p>
            </div>
            <div class="col-md-4">
                <h5 class="mb-4" style="color: #562D33;">Ikuti Kami</h5>
                <ul class="list-inline social-icons">
                    <li class="list-inline-item"><a href="{{route('comingsoon')}}" style="color: #562D33;"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="{{route('comingsoon')}}" style="color: #562D33;"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="{{route('comingsoon')}}" style="color: #562D33;"><i class="fab fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="{{route('comingsoon')}}" style="color: #562D33;"><i class="fab fa-linkedin"></i></a></li>
        </div>
    </div>
    <div class="container text-center">
        <p class="text-muted mb-0" style="color: #562D33;">© 2024 SunnyMart. All rights reserved.</p>
    </div>
</footer>


@endsection