@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Product</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="form">
                                <input type="hidden" name="id" value="{{$data->product_id}}">
                                <input type="hidden" name="image" value="{{$data->product_image}}">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{$data->product_name}}" placeholder="Product Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Category</label>
                                    <div class="col-sm-10">
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Category Product</option>
                                            <option value="Long Sleeve" {{$data->product_category == 'Long Sleeve' ? 'selected' : '' }}>Long Sleeve</option>
                                            <option value="Short Sleeve" {{$data->product_category == 'Short Sleeve' ? 'selected' : '' }}>Short Sleeve</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="price" id="price" placeholder="Product Price" value="{{number_format($data->product_price,0,'.','.')}}" onkeyup="formatRupiah(this.value, '#price')">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Size</label>
                                    <div class="col-sm-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="size[]" id="sizes" value="S" {{ in_array('S', json_decode($data->product_size)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">S</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="size[]" id="sizem" value="M" {{ in_array('M', json_decode($data->product_size)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">M</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="size[]" id="sizel" value="L" {{ in_array('L', json_decode($data->product_size)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">L</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="size[]" id="sizexl" value="XL" {{ in_array('XL', json_decode($data->product_size)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">XL</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="size[]" id="sizexxl" value="XXL" {{ in_array('XXL', json_decode($data->product_size)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">XXL</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Stock</label>
                                    <div class="col-sm-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="stock" id="notempty" value="Tersedia" {{$data->product_stock == 'Tersedia' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Tersedia</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="stock" id="empty" value="Tidak Tersedia" {{$data->product_stock == 'Tidak Tersedia' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Tidak Tersedia</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Image</label>
                                    <div class="col-sm-2">
                                        <div class="form-check form-check-inline">
                                            <input type="file" name="file[]" class="dropify" data-height="150" data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png" data-default-file="{{ !empty(json_decode($data->product_image)[0]) ? asset('image/'.json_decode($data->product_image)[0]) : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check form-check-inline">
                                            <input type="file" name="file[]" class="dropify" data-height="150" data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png" data-default-file="{{ !empty(json_decode($data->product_image)[1]) ? asset('image/'.json_decode($data->product_image)[1]) : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check form-check-inline">
                                            <input type="file" name="file[]" class="dropify" data-height="150" data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png" data-default-file="{{ !empty(json_decode($data->product_image)[2]) ? asset('image/'.json_decode($data->product_image)[2]) : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OVERVIEW -->
        </div>
    </div>
@endsection

@section('addOnJS')
    <script>
        $(document).ready(function(){
            $("#nav_product").addClass('active');
        });

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });

        $(document).ready(function(){
            $("#form").validate({
                rules       : {
                    name: {
                        required: true
                    },
                    category: {
                        required: true
                    },
                    price: {
                        required: true
                    },
                    'size[]': {
                        required: true
                    },
                    stock: {
                        required: true
                    }
                },
                submitHandler : function (e) {
                    edit_product();
                }
            });
        });

        function edit_product() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url        : '/admin/product/edit_product_process',
                type       : "POST",
                data       : new FormData(document.getElementById('form')),
                enctype    : 'multipart/form-data',
                processData: false,                                           // Important!
                contentType: false,
                cache      : false,
                dataType   : "json",
                success: function (res) {
                    Swal.close();
                    if (res == 'success') {
                        Swal.fire({
                            title: 'Edit Product Success !',
                            type: 'success',
                            text: "Product successfuly Updated !",
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                            }).then((result) => {
                            if (result.value) {
                                var url = '/admin/product';
                                window.location = url;
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
    </script>
@endsection
