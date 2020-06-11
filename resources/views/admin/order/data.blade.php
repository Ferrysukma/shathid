<table class="table table-hover table-bordered" style="width:100%">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Size</th>
            <th>Delivery</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if (count($data) != 0)
            @foreach ($data as $list)
                <tr>
                    <td style="text-align: center">{{$loop->iteration}}</td>
                    <td>{{$list->order_name}}</td>
                    <td>{{$list->order_phone}}</td>
                    <td>{{$list->order_product_name}}</td>
                    <td style="text-align: center">{{$list->order_qty}}</td>
                    <td>Rp. {{number_format($list->order_price,0,'.','.')}}</td>
                    <td style="text-align: center">{{$list->order_size}}</td>
                    <td>{{$list->order_type}}</td>
                    <td>
                        @if ($list->order_status == '1')
                            New Order
                        @elseif ($list->order_status == '2')
                            On Progress
                        @elseif ($list->order_status == '3')
                            Finish
                        @elseif ($list->order_status == '4')
                            Calcel
                        @endif
                    </td>
                    <td style="text-align:center">
                        <a class="btn btn-primary btn-sm" onclick="get_detail({{$list->order_id}}, '{{$list->order_status}}')"><i class="fa fa-eye"></i></a>
                    </td>
            @endforeach
        @else
            <tr>
                <td colspan="10" style="text-align:center"><b> No Data </b></td>
            </tr>
        @endif
    </tbody>
</table>
