<h4 style="text-align: center"><strong>User Order</strong></h5>
<div class="row">
    <div class="col-md-12">
        <table class="table table-detail">
            <body>
                <tr>
                    <td class="lable-detail">Nama Pemesan</td>
                    <td class="value-detail">: {{$order->order_name}}</td>
                </tr>
                <tr>
                    <td class="lable-detail">Nomor Pemesan</td>
                    <td class="value-detail">: {{$order->order_phone}}</td>
                </tr>
                <tr>
                    <td class="lable-detail">Order Date</td>
                    <td class="value-detail">: {{date("d F Y | H:i:s", strtotime($order->order_date))}}</td>
                </tr>
            </body>
        </table>
    </div>
</div>
<h4 style="text-align: center"><strong>Product Detail</strong></h5>
<div class="row">
    <div class="col-md-12" >
        <table width="100%" class="table table-detail">
            <tr>
                <td class="lable-detail">Product Name</td>
                <td class="value-detail">: {{$order->order_product_name}}</td>
            </tr>
            <tr>
                <td class="lable-detail">Product Image</td>
                <td class="value-detail">: <a href="/product/{{$order->order_product_id}}" target="_blank">Go to detail product</a></td>
            </tr>
            <tr>
                <td class="lable-detail">Product Price</td>
                <td class="value-detail">: Rp. {{number_format($order->order_product_price,0,'.','.')}}</td>
            </tr>
        </table>
    </div>
</div>
<h4 style="text-align: center"><strong>Delivery Order</strong></h5>
<div class="row">
    <div class="col-md-12" >
        <table width="100%" class="table table-detail">
            <tr>
                <td class="lable-detail">Order Size</td>
                <td class="value-detail">: {{$order->order_size}}</td>
            </tr>
            <tr>
                <td class="lable-detail">Order Qty</td>
                <td class="value-detail">: {{$order->order_qty}} Pcs</td>
            </tr>
            <tr>
                <td class="lable-detail">Order Price</td>
                <td class="value-detail">: Rp. {{number_format($order->order_price,0,'.','.')}}</td>
            </tr>
            <tr>
                <td class="lable-detail">Order Delivery</td>
                <td class="value-detail">: {{$order->order_type}}</td>
            </tr>
            @if ($order->order_type == 'courier')
                <tr>
                    <td class="lable-detail">Order Courier</td>
                    <td class="value-detail">: {{strtoupper($order->order_courier)}}</td>
                </tr>
                <tr>
                    <td class="lable-detail">Service</td>
                    <td class="value-detail">: {{$order->order_service}}</td>
                </tr>
                <tr>
                    <td class="lable-detail">Province</td>
                    <td class="value-detail">: {{$order->order_province}}</td>
                </tr>
                <tr>
                    <td class="lable-detail">City</td>
                    <td class="value-detail">: {{$order->order_city}}</td>
                </tr>
            @endif
            <tr>
                <td class="lable-detail">Address</td>
                <td class="value-detail">: <?= nl2br($order->order_address); ?></td>
            </tr>
            @if ($order->order_type == 'courier')
                <tr>
                    <td class="lable-detail">Delivery Price</td>
                    <td class="value-detail">: Rp. {{number_format($order->order_ongkir,0,'.','.')}}</td>
                </tr>
            @endif
        </table>
    </div>
</div>

@if ($status == '1')
    <script>
        var html = '';
        html += '<button type="button" class="btn btn-danger" onclick="cancel_order({{$order->order_id}})">Cancel</button>';
        html += '<button type="button" class="btn btn-primary" onclick="accept_order({{$order->order_id}})">Accept</button>';

        $('.modal-footer').html(html);
    </script>
@elseif ($status == '2')
    <script>
        var html = '';
        html += '<button type="button" class="btn btn-primary" onclick="finish_order({{$order->order_id}})">Finish</button>';

        $('.modal-footer').html(html);
    </script>
@endif
