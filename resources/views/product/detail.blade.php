@extends('layout')

@section('content')

@include('product.header')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <h2>Product Detail</h2>
    </div>
</section>
<!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">

        <div class="portfolio-details-container">

            <div class="owl-carousel portfolio-details-carousel">
            <img src="/assets/img/portfolio/portfolio-details-1.jpg" class="img-fluid" alt="">
            <img src="/assets/img/portfolio/portfolio-details-2.jpg" class="img-fluid" alt="">
            <img src="/assets/img/portfolio/portfolio-details-3.jpg" class="img-fluid" alt="">
            </div>

            <div class="portfolio-info">
            <h3>Baju Kaos Lengan Pendek</h3>
            <ul>
                <li><strong>Kategori</strong>: Short Sleeve</li>
                <li><strong>Ukuran</strong>: M, L, XL</li>
                <li><strong>Stock</strong>: 100 Pcs</li>
                <li><strong>Harga</strong>: <a href="#">Rp. 100.000</a></li>
            </ul>
            </div>

        </div>

        <div class="portfolio-description">
            <h2>Form Pemesanan</h2>
            <form action="#">
                <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                    <div class="form-row">
                    <div class="col form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama Kamu" />
                    </div>
                    <div class="col form-group">
                        <input type="number" class="form-control" name="email" id="email" placeholder="Nomor HP Kamu" />
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="col form-group">
                        <select name="size" id="size" class="form-control">
                            <option value="">Pilih Ukuran</option>
                            <option value="M">M</option>
                            <option value="M">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <div class="col form-group">
                        <input type="number" class="form-control" name="email" id="email" placeholder="Jumlah Pesanan" />
                    </div>
                    </div>

                    <div class="form-group">
                    <select class="form-control" name="type" id="type">
                        <option value="">Pilih Jenis Pengiriman</option>
                        <option value="cod">Cash Of Delivery (COD)</option>
                        <option value="non-cod">Jasa Pengiriman</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <textarea class="form-control" name="message" rows="3"placeholder="Catatan"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"></div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
                            <h4>Rincian Harga</h3>
                            <table class="table">
                                <tr>
                                    <td>
                                        <p> Harga Produk :</p>
                                        <p> Ongkos Kirim :</p>
                                        <hr>
                                        <p> Total Harga :</p>
                                    </td>
                                    <td>
                                        <p style="color: #ef6445;"><strong> Rp. 100.000 </strong></p>
                                        <p style="color: #ef6445;"><strong> Rp. 10.000 </strong></p>
                                        <hr>
                                        <p style="color: #ef6445;"><strong> Rp. 110.000 </strong></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-center"><button class="btn btn-primary btn-submit" type="submit">Pesan Sekarang</button></div>
                </form>
            </form>
        </div>

    </div>
</section>
<!-- End Portfolio Details Section -->
@endsection
