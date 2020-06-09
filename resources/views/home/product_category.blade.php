@extends('layout')

@section('content')

@include('product.header')
<br><br>
<!-- ======= Short Sleeve Section ======= -->
<section id="shortSleeve" class="services section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>{{$category}}</h2>
            <p>{{$category}}</p>
        </div>

        <div class="row">
            @foreach ($products as $product)
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
            @endforeach
        </div>

    </div>
</section>
<!-- End Short Sleeve Section -->
@endsection
