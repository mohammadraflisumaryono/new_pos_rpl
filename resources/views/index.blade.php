@extends('template.app')

@section('head_khusus')
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="description" content="">

@endsection
@section('style')
<style>
    :root {
        /* widths for rows and containers
     */
        --header-height: 160px;
        --header-height-min: 80px;
    }

    /* on mobile devices below 600px
 */
    @media screen and (max-width: 600px) {
        :root {
            --header-height: 100px;
            --header-height-min: 80px;
        }
    }

    /* Theme Colors */
    :root {
        --accent-color: #DEAD6F;
        --dark-color: #222222;
        --light-dark-color: #727272;
        --light-color: #fff;
        --grey-color: #dbdbdb;
        --light-grey-color: #fafafa;
        --primary-color: #6995B1;
        --light-primary-color: #eef1f3;
    }

    /* Fonts */
    :root {
        --body-font: 'Chilanka', cursive;
        --heading-font: 'Chilanka', cursive;
        --secondary-font: 'Montserrat', sans-serif;
    }


    body {
        --bs-link-color: #333;
        --bs-link-hover-color: #333;

        --bs-link-color-rgb: 40, 40, 40;
        --bs-link-hover-color-rgb: 0, 0, 0;

        /* --bs-link-color: #DEAD6F;
  --bs-link-hover-color: #DEAD6F; */

        --bs-light-rgb: 248, 248, 248;

        --bs-font-sans-serif: 'Chilanka', cursive;
        --bs-body-font-family: var(--bs-font-sans-serif);
        --bs-body-font-size: 1rem;
        --bs-body-font-weight: 400;
        --bs-body-line-height: 2;
        --bs-body-color: #41403E;

        --bs-primary: #DEAD6F;
        --bs-primary-rgb: 222, 173, 111;

        --bs-primary-bg-subtle: #FFF9EB;
        --bs-border-color: #F7F7F7;

        --bs-secondary-rgb: 230, 243, 251;

        --bs-success-rgb: 238, 245, 228;
        --bs-danger-rgb: 249, 235, 231;
        --bs-warning-rgb: 255, 249, 235;
        --bs-info-rgb: 230, 243, 250;
    }

    .btn-primary {
        padding: 1.2rem 3rem;
        --bs-btn-color: #fff;
        --bs-btn-bg: #DEAD6F;
        --bs-btn-border-color: transparent;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #e9b775;
        --bs-btn-hover-border-color: transparent;
        --bs-btn-focus-shadow-rgb: 49, 132, 253;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #DEAD6F;
        --bs-btn-active-border-color: transparent;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #d3d7dd;
        --bs-btn-disabled-border-color: transparent;
    }

    .btn-outline-primary {
        transition: all 0.3s ease-in;
        padding: 1.2rem 3rem;
        letter-spacing: 0.02375rem;
        --bs-btn-color: #DEAD6F;
        --bs-btn-border-color: #DEAD6F;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #DEAD6F;
        --bs-btn-hover-border-color: #DEAD6F;
        --bs-btn-focus-shadow-rgb: 13, 110, 253;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #DEAD6F;
        --bs-btn-active-border-color: #DEAD6F;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #DEAD6F;
        --bs-btn-disabled-bg: transparent;
        --bs-btn-disabled-border-color: #DEAD6F;
        --bs-gradient: none;
    }

    .btn-outline-dark {
        transition: all 0.3s ease-in;
        padding: 1.2rem 3rem;
        letter-spacing: 0.02375rem;
        text-transform: uppercase;
        --bs-btn-color: #41403E;
        --bs-btn-border-color: #41403E;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #41403E;
        --bs-btn-hover-border-color: #41403E;
        --bs-btn-focus-shadow-rgb: 33, 37, 41;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #41403E;
        --bs-btn-active-border-color: #41403E;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #41403E;
        --bs-btn-disabled-bg: transparent;
        --bs-btn-disabled-border-color: #41403E;
        --bs-gradient: none;
    }

    .btn-dark {
        padding: 1.2rem 3rem;
        font-size: 1.1875rem;
        text-transform: uppercase;
        --bs-btn-color: #fff;
        --bs-btn-bg: #41403E;
        --bs-btn-border-color: #41403E;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #363533;
        --bs-btn-hover-border-color: #363533;
        --bs-btn-focus-shadow-rgb: 66, 70, 73;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #41403E;
        --bs-btn-active-border-color: #41403E;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #41403E;
        --bs-btn-disabled-border-color: #41403E;
    }

    @media screen and (max-width:991px) {

        .btn-primary,
        .btn-outline-primary,
        .btn-outline-dark,
        .btn-dark {
            padding: 0.6rem 1.5rem;
            font-size: 1rem;
        }
    }

    body {
        letter-spacing: 0.01625rem;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: var(--heading-font);
        color: var(--bs-body-color);
        font-weight: 400;
        text-transform: capitalize;
    }

    a {
        text-decoration: none;
    }

    .breadcrumb.text-white {
        --bs-breadcrumb-divider-color: #fff;
        --bs-breadcrumb-item-active-color: var(--bs-primary);
    }

    .dropdown-menu {
        --bs-dropdown-link-active-bg: var(--bs-primary);
    }

    .secondary-font {
        font-family: var(--secondary-font);
        font-weight: 300;
    }

    /*----------------------------------------------*/
    /* 6. SITE STRUCTURE */
    /*----------------------------------------------*/
    /* 6.1 Header
--------------------------------------------------------------*/
    /* Preloader */
    .preloader-wrapper {
        width: 100%;
        height: 100vh;
        margin: 0 auto;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 111;
        background: #fff;
    }

    .preloader-wrapper .preloader {
        margin: 20% auto 0;
        transform: translateZ(0);
    }

    .preloader:before,
    .preloader:after {
        content: '';
        position: absolute;
        top: 0;
    }

    .preloader:before,
    .preloader:after,
    .preloader {
        border-radius: 50%;
        width: 2em;
        height: 2em;
        animation: animation 1.2s infinite ease-in-out;
    }

    .preloader {
        animation-delay: -0.16s;
    }

    .preloader:before {
        left: -3.5em;
        animation-delay: -0.32s;
    }

    .preloader:after {
        left: 3.5em;
    }

    @keyframes animation {

        0%,
        80%,
        100% {
            box-shadow: 0 2em 0 -1em var(--accent-color);
        }

        40% {
            box-shadow: 0 2em 0 0 var(--accent-color);
        }
    }


    /* search bar style  */
    .search-bar {
        border: 1px solid #EAEAEA;
    }

    .search-bar ::placeholder {
        font-family: var(--secondary-font);
    }

    .form-control:focus {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        border-color: #86b7fe;
        outline: 0;
        box-shadow: none;
    }

    /* Categories section */
    .categories a {
        text-decoration: none;
        color: blue;
    }

    /* banner style */
    #banner.swiper-container {
        width: 100%;
        height: 100%;
    }

    #banner .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    #banner .center-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Category */
    #categories .categories-item img {
        height: 40px;
        width: 40px;
        /* Atur tinggi maksimum gambar */
        object-fit: cover;
        /* Memastikan gambar tetap proporsional */
    }

    #categories .categories-item p {
        font-weight: bold;
        /* Membuat teks menjadi tebal */
        font-size: 1.2rem;
        /* Ukuran font yang lebih besar */
    }



    /* pet clothing */
    .card {
        --bs-card-inner-border-radius: none;
        --bs-card-bg: transparent;
        background-color: transparent;
        border: none;
    }

    .card img {
        object-fit: cover;
        height: 200px;
        /* Adjust as necessary */
        width: 100%;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    a.btn-cart {
        border-radius: 0.25rem;
        border: 1px solid rgba(65, 64, 62, 0.20);
    }

    a.btn-wishlist {

        border-radius: 0.25rem;
        border: 1px solid rgba(65, 64, 62, 0.20);
    }


    /* pet foodies style  */
    button.filter-button {
        letter-spacing: 0.02125rem;
        border: none;
        border-bottom: 2px solid #D9D9D8;
        background: transparent;
        text-transform: uppercase;
        font-size: 1.0625rem;
        transition: all 0.3s ease-in;
    }

    button.filter-button.active,
    button.filter-button:hover {
        border-bottom: 2px solid #DEAD6F;
    }

    /* testimonial style  */
    .testimonial-content {
        color: #908F8D;
    }



    /* register form  */
    .form-control {
        color: #908F8D;
        line-height: normal;
        letter-spacing: 0.02125rem;
        text-transform: capitalize;
        border-radius: 0.25rem;
        border: 1px solid rgba(65, 64, 62, 0.20);
        background: #FFF;
        display: flex;
        padding: 1.25rem 0rem 1.25rem 1.25rem;
        align-items: center;
        gap: 0.375rem;
        align-self: stretch;
    }

    .form-control:focus {
        border-color: #41403E;
    }


    /* blog style */
    .blog-paragraph {
        color: #908F8D;
        font-size: 1rem;
        font-weight: 400;
        line-height: normal;
        font-family: var(--secondary-font);
    }

    .blog-read {
        color: #908F8D;
        font-size: 1rem;
        letter-spacing: 0.02rem;
        text-transform: uppercase;
    }

    a.blog-read {
        border-bottom: 3px solid #D9D9D8;
        transition: all 0.3s ease-in;
    }

    a.blog-read:hover {
        border-bottom: 3px solid #8a8a8a;
    }


    /* services style  */
    .service-icon {
        font-size: 30px;
        border-radius: 3.125rem;
        border: 1px solid #D9D9D8;
        padding: 1.25rem;
    }


    /* insta style  */
    .instagram-item:hover:before,
    .instagram-item:hover .icon-overlay {
        opacity: 1;
        cursor: pointer;
    }

    .icon-overlay {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        align-items: center;
        font-size: 3rem;
        cursor: pointer;
        opacity: 0;
        -moz-transition: 0.8s ease;
        -webkit-transition: 0.8s ease;
        transition: 0.8s ease;
    }


    @media screen and (max-width: 991px) {

        /* offcanvas menu */
        .offcanvas-body .nav-item {
            font-weight: 700;
            border-bottom: 1px solid #d1d1d1;
        }

        .offcanvas-body .filter-categories {
            width: 100%;
            margin-bottom: 20px !important;
            border: 1px solid #d1d1d1 !important;
            padding: 14px;
            border-radius: 8px;
        }

        /* dropdown-menu */
        .dropdown-menu {
            padding: 0;
            border: none;
            line-height: 1.4;
            font-size: 0.9em;
        }

        .dropdown-menu a {
            padding-left: 0;
        }

        .dropdown-toggle::after {
            position: absolute;
            right: 0;
            top: 21px;
        }
    }


    /*--------------------------------------------------------------
faqs section style start
--------------------------------------------------------------*/
    .accordion-button:not(.collapsed) {
        color: var(--body-text-color);
        background-color: transparent;
        box-shadow: none;
    }

    .accordion {
        --bs-accordion-color: var(--light-text-color);
        --bs-accordion-bg: none;
        --bs-accordion-btn-color: var(--body-text-color);
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url('https://api.iconify.design/eva/arrow-down-fill.svg?color=%2341403e');

    }

    .accordion-button::after {
        background-image: url('https://api.iconify.design/eva/arrow-down-fill.svg?color=%2341403e');
    }

    .accordion-button:focus {
        z-index: 3;
        border-color: none;
        box-shadow: none;
    }




    /*--------------------------------------------------------------
Blog section style start
--------------------------------------------------------------*/
    /* ------ Pagination ------*/
    .pagination .page-numbers {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        color: var(--bs-body-color);
        padding: 0 10px;
        line-height: 1.4;
        transition: 0.9s all;
        border-radius: 8px;
    }

    .pagination .page-numbers:hover,
    .pagination .page-numbers.current {
        color: var(--accent-color);
    }

    #categories {
        padding: 3rem 1rem;
    }

    .container {
        max-width: calc(100% - 8rem);
        /* Perkecil container */
    }

    #slider {
        text-align: left;
        /* Geser konten ke kiri */
    }

    .container {
        max-width: calc(100% - 4rem);
        /* Perkecil container */
    }

    #slider {
        text-align: left;
        /* Geser konten ke kiri */
    }
</style>
</style>



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
    <div class="container mx-auto max-w-[calc(100%-4rem)]"> <!-- Perkecil container -->
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
        <div class="row">

            @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('storage/'.$product->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-semibold">{{$product->nama}}</h5>
                        <p class="card-text">{{ $product->short_description }}</p>
                        <p class="card-text text-green-500 text-right ">{{$product->readAblePrice}}</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="banner-2" class="my-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="row flex-row-reverse banner-content align-items-center">
                <div class="img-wrapper col-12 col-md-6">
                    <img src="images/banner-img2.png" class="img-fluid">
                </div>
                <div class="content-wrapper col-12 offset-md-1 col-md-5 p-5">
                    <div class="secondary-font text-primary text-uppercase mb-3 fs-4">Upto 40% off</div>
                    <h2 class="banner-title display-1 fw-normal">Clearance sale !!!
                    </h2>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>

            </div>
        </div>
    </section>


    <section id="bestselling" class="my-5 overflow-hidden">
        <div class="container py-5 mb-5">

            <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">Best selling products</h2>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>
            </div>

            <div class=" swiper bestselling-swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
              New
            </div> -->
                        <div class="card position-relative">
                            <a href="single-product.html"><img src="images/item5.jpg" class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Grey hoodie</h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        5.0</span>

                                    <h3 class="secondary-font text-primary">$18.00</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / category-carousel -->


        </div>
    </section>

    @if(!Auth::user())

    <section id="register" style="background: url('images/background-img.png') no-repeat;">
        <div class="container ">
            <div class="row my-5 py-5">
                <div class="offset-md-3 col-md-6 my-5 ">
                    <h2 class="display-3 fw-normal text-center">Get 20% Off on <span class="text-primary">first Purchase</span>
                    </h2>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter Your Email Address">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" name="email" id="password1" placeholder="Create Password">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" name="email" id="password2" placeholder="Repeat Password">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg rounded-1">Register it now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section id="latest-blog" class="my-5">
        <div class="container py-5 my-5">
            <div class="row mt-5">
                <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                    <h2 class="display-3 fw-normal">Latest Blog Post</h2>
                    <div>
                        <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                            Read all
                            <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                <use xlink:href="#arrow-right"></use>
                            </svg></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 my-4 my-md-0">
                    <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
                        <h3 class="secondary-font text-primary m-0">20</h3>
                        <p class="secondary-font fs-6 m-0">Feb</p>

                    </div>
                    <div class="card position-relative">
                        <a href="single-post.html"><img src="images/blog1.jpg" class="img-fluid rounded-4" alt="image"></a>
                        <div class="card-body p-0">
                            <a href="single-post.html">
                                <h3 class="card-title pt-4 pb-3 m-0">10 Reasons to be helpful towards any animals</h3>
                            </a>

                            <div class="card-text">
                                <p class="blog-paragraph fs-6">At the core of our practice is the idea that cities are the incubators of
                                    our greatest
                                    achievements, and the best hope for a sustainable future.</p>
                                <a href="single-post.html" class="blog-read">read more</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-4 my-md-0">
                    <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
                        <h3 class="secondary-font text-primary m-0">21</h3>
                        <p class="secondary-font fs-6 m-0">Feb</p>

                    </div>
                    <div class="card position-relative">
                        <a href="single-post.html"><img src="images/blog2.jpg" class="img-fluid rounded-4" alt="image"></a>
                        <div class="card-body p-0">
                            <a href="single-post.html">
                                <h3 class="card-title pt-4 pb-3 m-0">How to know your pet is hungry</h3>
                            </a>

                            <div class="card-text">
                                <p class="blog-paragraph fs-6">At the core of our practice is the idea that cities are the incubators of
                                    our greatest
                                    achievements, and the best hope for a sustainable future.</p>
                                <a href="single-post.html" class="blog-read">read more</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-4 my-md-0">
                    <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
                        <h3 class="secondary-font text-primary m-0">22</h3>
                        <p class="secondary-font fs-6 m-0">Feb</p>

                    </div>
                    <div class="card position-relative">
                        <a href="single-post.html"><img src="images/blog3.jpg" class="img-fluid rounded-4" alt="image"></a>
                        <div class="card-body p-0">
                            <a href="single-post.html">
                                <h3 class="card-title pt-4 pb-3 m-0">Best home for your pets</h3>
                            </a>

                            <div class="card-text">
                                <p class="blog-paragraph fs-6">At the core of our practice is the idea that cities are the incubators of
                                    our greatest
                                    achievements, and the best hope for a sustainable future.</p>
                                <a href="single-post.html" class="blog-read">read more</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="service">
        <div class="container py-5 my-5">
            <div class="row g-md-5 pt-4">
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:shopping-cart"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Free Delivery</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:user-check"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">100% secure payment</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:tag"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Daily Offer</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:award"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Quality guarantee</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="insta" class="my-5">
        <div class="row g-0 py-5">
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta1.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta2.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta3.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta4.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta5.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item  text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="images/insta6.jpg" alt="insta-img" class="img-fluid rounded-3">
                </a>
            </div>
        </div>
    </section>

    <footer id="footer" class="my-5">
        <div class="container py-5 my-5">
            <div class="row">

                <div class="col-md-3">
                    <div class="footer-menu">
                        <img src="images/logo.png" alt="logo">
                        <p class="blog-paragraph fs-6 mt-3">Subscribe to our newsletter to get updates about our grand offers.</p>
                        <div class="social-links">
                            <ul class="d-flex list-unstyled gap-2">
                                <li class="social">
                                    <a href="#">
                                        <iconify-icon class="social-icon" icon="ri:facebook-fill"></iconify-icon>
                                    </a>
                                </li>
                                <li class="social">
                                    <a href="#">
                                        <iconify-icon class="social-icon" icon="ri:twitter-fill"></iconify-icon>
                                    </a>
                                </li>
                                <li class="social">
                                    <a href="#">
                                        <iconify-icon class="social-icon" icon="ri:pinterest-fill"></iconify-icon>
                                    </a>
                                </li>
                                <li class="social">
                                    <a href="#">
                                        <iconify-icon class="social-icon" icon="ri:instagram-fill"></iconify-icon>
                                    </a>
                                </li>
                                <li class="social">
                                    <a href="#">
                                        <iconify-icon class="social-icon" icon="ri:youtube-fill"></iconify-icon>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-menu">
                        <h3>Quick Links</h3>
                        <ul class="menu-list list-unstyled">
                            <li class="menu-item">
                                <a href="#" class="nav-link">Home</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">About us</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Offer </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Services</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Conatct Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-menu">
                        <h3>Help Center</h5>
                            <ul class="menu-list list-unstyled">
                                <li class="menu-item">
                                    <a href="#" class="nav-link">FAQs</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="nav-link">Payment</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="nav-link">Returns & Refunds</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="nav-link">Checkout</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="nav-link">Delivery Information</a>
                                </li>
                            </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <h3>Our Newsletter</h3>
                        <p class="blog-paragraph fs-6">Subscribe to our newsletter to get updates about our grand offers.</p>
                        <div class="search-bar border rounded-pill border-dark-subtle px-2">
                            <form class="text-center d-flex align-items-center" action="" method="">
                                <input type="text" class="form-control border-0 bg-transparent" placeholder="Enter your email here" />
                                <iconify-icon class="send-icon" icon="tabler:location-filled"></iconify-icon>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    @endsection

    @section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.main-swiper', {
                loop: true,
                autoplay: {
                    delay: 3000, // 3 seconds
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                effect: 'slide', // Default effect, you can change to 'fade', 'cube', etc.
                speed: 600, // Duration of transition between slides (in ms)
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            let currentTransform = 0;
            const badgeWidth = document.querySelector('.categories-item').offsetWidth + 16; // Sesuaikan dengan desain dan padding/margin Anda

            function showSlide(index) {
                // Pastikan index berada dalam rentang yang benar
                if (index < 0) {
                    index = totalSlides - 1; // Jika index kurang dari 0, pindahkan ke slide terakhir
                } else if (index >= totalSlides) {
                    index = 0; // Jika index melebihi totalSlides, pindahkan ke slide pertama
                }
            }


            function goNext() {
                const slider = document.getElementById("slider");
                const containerWidth = slider.parentElement.clientWidth;
                const maxTransform = slider.scrollWidth - containerWidth;
                if (currentTransform - badgeWidth > -maxTransform) {
                    currentTransform -= badgeWidth;
                } else {
                    currentTransform = -maxTransform;
                }
                slider.style.transform = "translateX(" + currentTransform + "px)";
            }

            function goPrev() {
                if (currentTransform + badgeWidth <= 0) {
                    currentTransform += badgeWidth;
                } else {
                    currentTransform = 0;
                }
                const slider = document.getElementById("slider");
                slider.style.transform = "translateX(" + currentTransform + "px)";
            }

            document.getElementById("next").addEventListener("click", goNext);
            document.getElementById("prev").addEventListener("click", goPrev);
        });
    </script>
    @endsection