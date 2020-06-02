@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Product</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <a href="/admin/product/add_product" class="btn btn-primary"><i class="fa fa-plush"></i>Add Product</a>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Size</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($data != null)
                                            @foreach ($data as $list)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$list->product_name}}</td>
                                                    <td>{{$list->product_category}}</td>
                                                    <td>Rp. {{number_format($list->product_price,0,'.','.')}}</td>
                                                    <td>{{$list->product_stock}}</td>
                                                    <td>
                                                        <?php $size = json_decode($list->product_size); ?>
                                                        @foreach ($size as $row)
                                                            {{$row}}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <?php $image = json_decode($list->product_image); ?>
                                                        @foreach ($image as $row)
                                                            <img src="{{asset('image/'.$row)}}" alt="{{$list->product_name}}" onclick="popup_image('{{asset('image/'.$row)}}')" style="height: 40px">
                                                        @endforeach
                                                    </td>
                                                    <td style="text-align:center">
                                                        <a class="btn btn-warning btn-sm" href="/admin/product/edit/{{$list->product_id}}"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm" onclick="delete_product({{$list->product_id}}, '{{$list->product_image}}')"><i class="fa fa-trash"></i></a>
                                                    </td>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" style="text-align:center"><b> No Data </b></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OVERVIEW -->
        </div>
    </div>

    {{-- Modal Image --}}
    <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="text-align:center">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('addOnJS')
    <script>
        $(document).ready(function(){
            $("#nav_product").addClass('active');
        });

        function delete_product(id, image) {
            Swal.fire({
                title: ' Delete Product !',
                type: 'error',
                text: "Anda yakin akan menghapus produk ini?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                    delete_product_process(id, image);
                }
            })
        }

        function delete_product_process(id, image) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url        : '/admin/product/delete_product',
                type       : "POST",
                data       : {id : id, image:image},
                dataType   : "json",
                success: function (res) {
                    Swal.close();
                    if (res == 'success') {
                        Swal.fire({
                            title: 'Delete Product Success !',
                            type: 'success',
                            text: "Product successfuly Deleted !",
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                            }).then((result) => {
                            if (result.value) {
                                window.location.reload();;
                            }
                        })
                    } else {
                        Swal.fire("Error !", "Please try again", "error");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire("Error !", "Please try again", "error");
                },
                beforeSend: function () {
                    let timerInterval
                        Swal.fire({
                        title: 'Loading',
                        html: '',
                        timer: 20000,
                        timerProgressBar: false,
                        allowOutsideClick: false,
                        allowEscapeKey:false,
                        allowEnterKey:false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                            const content = Swal.getContent()
                            }, 100)
                        },
                        onClose: () => {
                            clearInterval(timerInterval)
                        }
                        }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                },
            });
        }

        function popup_image(image) {
            html = '<img src="'+image+'" alt="Gambar" style="height:500px">';
            $('.modal-body').html(html);
            $('#popupModal').modal('show');
        }
    </script>
@endsection
