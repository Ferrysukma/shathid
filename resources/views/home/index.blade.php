@extends('layout')

@section('content')

    @include('home.header')

<!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">
            <?php $n = 0; ?>
            @foreach ($banners as $row)
                <div class="carousel-item {{ $n == 0 ? 'active' : '' }}" style="background-image: url(image/{{ $row->banner_image }})">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">{{$row->banner_name}}</h2>
                            <p class="animate__animated animate__fadeInUp"><?= nl2br($row->banner_description) ?></p>
                        </div>
                    </div>
                </div>
                <?php $n++; ?>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

        </div>
    </section>
    <!-- End Hero -->

    <!-- ======= Long Sleeve Section ======= -->
    <section id="longSleeve" class="services">
        <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Long Sleeve</h2>
            <p>Long Sleeve</p>
        </div>

        <div class="row">
            @foreach ($products as $product)
                @if ($product->product_category == 'Long Sleeve')
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <a href="/product/{{$product->product_id}}">
                            <div class="icon-box">
                                <div class="icon"><img src="{{asset('image/'.json_decode($product->product_image)[0])}}" alt="Gambar"></div>
                                <h4><a href="/product/{{$product->product_id}}">{{$product->product_name}}</a></h4>
                                <p>{{$product->product_stock}}</p>
                                <p class="label-price">Rp. {{number_format($product->product_price,0,'.','.')}}</p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="row row-btn-showmore">
            <div class="col-lg-12 col-btn-showmore">
            <a href="/product/category/long" class="get-started-btn">Show More</a>
            </div>
        </div>

        </div>
    </section>
    <!-- End Long Sleeve Section -->

    <!-- ======= Short Sleeve Section ======= -->
    <section id="shortSleeve" class="services section-bg">
        <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Short Sleeve</h2>
            <p>Short Sleeve</p>
        </div>

        <div class="row">
            @foreach ($products as $product)
                @if ($product->product_category == 'Short Sleeve')
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <a href="/product/{{$product->product_id}}">
                            <div class="icon-box">
                                <div class="icon"><img src="{{asset('image/'.json_decode($product->product_image)[0])}}" alt="{{$product->product_name}}"></div>
                                <h4><a href="/product/{{$product->product_id}}">{{$product->product_name}}</a></h4>
                                <p>{{$product->product_stock}}</p>
                                <p class="label-price">Rp. {{number_format($product->product_price,0,'.','.')}}</p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="row row-btn-showmore">
            <div class="col-lg-12 col-btn-showmore">
            <a href="/product/category/short" class="get-started-btn">Show More</a>
            </div>
        </div>

        </div>
    </section>
    <!-- End Short Sleeve Section -->
@endsection
