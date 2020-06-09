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
            <?php
                $images = json_decode($product->product_image);
            ?>
            <div class="owl-carousel portfolio-details-carousel">
                @foreach ($images as $image)
                <img src="{{asset('image/'.$image)}}" class="img-fluid" alt="{{$product->product_name}}">
                @endforeach
            </div>

            <div class="portfolio-info">
            <h3>{{$product->product_name}}</h3>
            <ul>
                <li><strong>Kategori</strong>: {{$product->product_category}}</li>
                <?php
                    $size = json_decode($product->product_size);
                ?>
                <li><strong>Ukuran</strong>:
                    @foreach ($size as $row)
                        {{$row}}
                    @endforeach
                </li>
                <li><strong>Stock</strong>: {{$product->product_stock}}</li>
                <li><strong>Harga</strong>: <a href="#">Rp. {{number_format($product->product_price,0,'.','.')}}</a></li>
            </ul>
            </div>

        </div>

        <div class="portfolio-description section-bg">
            <h2>Form Pemesanan</h2>
            <form id="form">
                <div id="form-identity">
                    <div class="form-row">
                        <div class="col form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Kamu" />
                        </div>
                        <div class="col form-group">
                            <input type="number" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="Nomor HP Kamu" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col form-group">
                            <select name="size" id="size" class="form-control">
                                <option value="">Pilih Ukuran</option>
                                @foreach ($size as $row)
                                <option value="{{$row}}">{{$row}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <input type="number" class="form-control" name="qty" id="qty" min="1" onkeyup="get_price(this.value, $('#price').val())" placeholder="Jumlah Pesanan" />
                        </div>
                    </div>

                    <div class="text-center"><a class="btn btn-primary btn-submit" style="color: #fff" onclick="get_form_pengiriman()">Pengiriman</a></div>
                </div>

                <div id="form-pengiriman" style="display: none">
                    <div class="form-group">
                        <select class="form-control" name="type" id="type" onchange="ongkir_type(this.value)">
                            <option value="">Pilih Jenis Pengiriman</option>
                            <option value="cod">Cash Of Delivery (COD)</option>
                            <option value="non-cod">Jasa Pengiriman</option>
                        </select>
                    </div>

                    <div class="form-row input-destination" style="display: none">
                        <div class="col form-group">
                            <select class="form-control" name="" id="province" onchange="get_city(this.value)">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($province as $row)
                                <option value="{{$row['province_id']}}">{{$row['province']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="price" name="price" value="{{$product->product_price}}">
                        <input type="hidden" id="ongkir" name="ongkir" value="0">
                        <div class="col form-group">
                            <select class="form-control" name="" id="city">
                                <option value="">Pilih Kota/Kabupaten</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row input-destination" style="display: none">
                        <div class="col form-group">
                            <select class="form-control" name="" id="courier" onchange="get_cost($('#city').val(), $('#qty').val(), this.value)">
                                <option value="">Pilih Jasa Pengiriman</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <select class="form-control" name="" id="cost" onclick="get_ongkir(this.value)">
                                <option value="">Pilih Paket Pengiriman</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="address" rows="3"placeholder="Deskripsi Alamat"></textarea>
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
                                        <p style="color: #ef6445;" id="price-product"><strong> Rp. {{number_format($product->product_price,0,'.','.')}} </strong></p>
                                        <p style="color: #ef6445;" id="price-ongkir"><strong> Rp. 0 </strong></p>
                                        <hr>
                                        <p style="color: #ef6445;" id="price-total"><strong> Rp. {{number_format($product->product_price,0,'.','.')}} </strong></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-center"><button class="btn btn-primary btn-submit" type="submit">Pesan Sekarang</button></div>
                </div>
            </form>
        </div>

    </div>
</section>
<!-- End Portfolio Details Section -->
@endsection

@section('addOnJS')
    <script>
        function ongkir_type(type) {
            if (type == 'cod') {
                $('.input-destination').hide();
                $('#province').removeAttr('name', 'province');
                $('#city').removeAttr('name', 'city');
                $('#cost').removeAttr('name', 'cost');
                $('#courier').removeAttr('name', 'courier');
                $('#ongkir').val('0');
            } else {
                $('#province').attr('name', 'province');
                $('#city').attr('name', 'city');
                $('#cost').attr('name', 'cost');
                $('#courier').attr('name', 'courier');
                $('.input-destination').show();
            }
        }

        function get_cost(city, qty, courier) {
            if (qty == '' || qty <= 0) {
                alert('Masukan Jumlah Pesanan Dengan Benar !');
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url     : "{{url('/get_courier')}}",
                    type    : "POST",
                    dataType: "JSON",
                    data    : {city:city, qty:qty, courier:courier},
                    success : function (res) {
                        if (res != 'empty') {
                            var html = '';

                            for (let i = 0; i < res.length; i++) {
                                for (let j = 0; j < res[i].costs.length; j++) {
                                    res[i].costs[j].service
                                    html += '<option value="'+res[i].costs[j].service+'-'+res[i].costs[j].cost[0].value+'">'+res[i].costs[j].service+ ' (' +res[i].costs[j].cost[0].etd +') Hari - Rp. '+res[i].costs[j].cost[0].value+'</option>';
                                }
                            }

                            $('#cost').html(html);
                        }
                    },
                    error   : function () {
                    },
                    beforeSend : function () {

                    },
                })
            }
        }

        function get_ongkir(val) {
            var ongkir = val.split('-');
            var price  = $('#price').val();
            var qty    = $('#qty').val();

            var price_final = parseInt(price) * parseInt(qty);
            var total_price = parseInt(ongkir[1]) + price_final;

            $('#price-product').html('<strong>Rp. '+price_final+'</strong>');
            $('#price-total').html('<strong>Rp. '+total_price+'</strong>');
            $('#price-ongkir').html('<strong>Rp. '+ongkir[1]+'</strong>');
            $('#ongkir').val(ongkir[1]);
        }

        function get_form_pengiriman() {
            var name = $('#name').val();
            var nomor_hp = $('#nomor_hp').val();
            var size = $('#size').val();
            var qty = $('#qty').val();

            if (size != '' && nomor_hp != '' && name != '' && qty > 0) {
                $('#form-identity').hide();
                $('#form-pengiriman').show();
            } else {
                alert('Isi Form Dengan Benar !');
            }
        }

        function get_price(qty, price) {
            var price_final = parseInt(qty) * parseInt(price);

            $('#price-product').html('<strong>Rp. '+price_final+'</strong>');
            $('#price-total').html('<strong>Rp. '+price_final+'</strong>');
        }

        function get_city(provinceId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url     : "{{url('/get_city')}}",
                type    : "POST",
                dataType: "JSON",
                data    : {provinceId:provinceId},
                success : function (res) {
                    if (res != 'empty') {
                        var html = '';
                        html += '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';

                        for (let i = 0; i < res.length; i++) {
                            html += '<option value="'+res[i].city_id+'">'+res[i].type+' '+res[i].city_name+'</option>';
                        }

                        $('#city').html(html);
                    }
                },
                error   : function () {
                },
                beforeSend : function () {

                },
            })
        }
    </script>
@endsection
