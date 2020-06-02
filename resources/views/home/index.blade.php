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
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <a href="/product/1">
                    <div class="icon-box">
                        <div class="icon"><img src="assets/img/longsleeve.jpg" alt="Gambar"></div>
                        <h4><a href="/product/1">Lorem Ipsum</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                <a href="/product/1">
                    <div class="icon-box">
                        <div class="icon"><img src="assets/img/longsleeve.jpg" alt="Gambar"></div>
                        <h4><a href="/product/1">Sed ut perspiciatis</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                <a href="/product/1">
                    <div class="icon-box">
                        <div class="icon"><img src="assets/img/longsleeve.jpg" alt="Gambar"></div>
                        <h4><a href="/product/1">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                <a href="/product/1">
                    <div class="icon-box">
                        <div class="icon"><img src="assets/img/longsleeve.jpg" alt="Gambar"></div>
                        <h4><a href="/product/1">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </a>
            </div>

        </div>

        <div class="row row-btn-showmore">
            <div class="col-lg-12 col-btn-showmore">
            <a href="#" class="get-started-btn">Show More</a>
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
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <a href="/product/1">
                    <div class="icon-box">
                        <div class="icon"><img src="assets/img/kaos.jpg" alt="Gambar"></div>
                        <h4><a href="/product/1">Lorem Ipsum</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                <a href="/product/1">
                    <div class="icon-box">
                        <div class="icon"><img src="assets/img/kaos.jpg" alt="Gambar"></div>
                        <h4><a href="">Sed ut perspiciatis</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                <a href="/product/1">
                    <div class="icon-box">
                        <div class="icon"><img src="assets/img/kaos.jpg" alt="Gambar"></div>
                        <h4><a href="/product/1">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                <a href="/product/1">
                    <div class="icon-box">
                        <div class="icon"><img src="assets/img/kaos.jpg" alt="Gambar"></div>
                        <h4><a href="/product/1">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </a>
            </div>

        </div>

        <div class="row row-btn-showmore">
            <div class="col-lg-12 col-btn-showmore">
            <a href="#" class="get-started-btn">Show More</a>
            </div>
        </div>

        </div>
    </section>
    <!-- End Short Sleeve Section -->
@endsection
