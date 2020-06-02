@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Home</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add-modal" data-backdrop="false" data-keyboard="false"><i class="fa fa-plush"></i>Add Banner</button>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Banner Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($data != null)
                                            @foreach ($data as $list)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$list->banner_name}}</td>
                                                    <td>{{$list->banner_description}}</td>
                                                    <td><img src="{{asset('image/'.$list->banner_image)}}" alt="{{$list->banner_name}}" onclick="popup_image('{{asset('image/'.$list->banner_image)}}')" style="height: 50px"></td>
                                                    <td style="text-align:center">
                                                        <a class="btn btn-warning btn-sm" onclick="edit({{$list->banner_id}})"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm" onclick="delete_banner({{$list->banner_id}})"><i class="fa fa-trash"></i></a>
                                                    </td>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align:center"><b> No Data </b></td>
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

    {{-- Modal Add Banner --}}
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Banner Name">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" cols="3" rows="3" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Banner --}}
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-edit">
                <div class="modal-body" id="modal-edit-content">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Save</button>
                </div>
                </form>
            </div>
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
            $("#nav_home").addClass('active');
        });

        function delete_banner(id) {
            Swal.fire({
                title: ' Delete Banner !',
                type: 'error',
                text: "Anda yakin akan menghapus banner ini?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                    delete_banner_process(id);
                }
            })
        }

        function delete_banner_process(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url        : '/admin/home/delete_banner',
                type       : "POST",
                data       : {id : id},
                dataType   : "json",
                success: function (res) {
                    Swal.close();
                    if (res == 'success') {
                        Swal.fire({
                            title: 'Delete Banner Success !',
                            type: 'success',
                            text: "Banner successfuly Deleted !",
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

        $(document).ready(function(){
            // alert('tes')
            $("#form").validate({
                // onclick: false,
                rules       : {
                    name: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    file: {
                        required: true
                    }
                },
                submitHandler : function (e) {
                    add_banner_process();
                }
            });
        });

        function add_banner_process() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url        : '/admin/home/add_banner',
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
                            title: 'Add Banner Success !',
                            type: 'success',
                            text: "Banner successfuly Added !",
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

        function edit(id) {
            $.ajax({
                url        : '/admin/home/edit/'+id,
                type       : "GET",
                dataType   : "html",
                success: function (res) {
                    Swal.close();
                    $('#modal-edit-content').html(res);
                    $('#modal-edit').modal({backdrop: "static", keyboard:false, show: true})
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

        $(document).ready(function(){
            $("#form-edit").validate({
                // onclick: false,
                rules       : {
                    name: {
                        required: true
                    },
                    description: {
                        required: true
                    }
                },
                submitHandler : function (e) {
                    edit_banner_process();
                }
            });
        });

        function edit_banner_process() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url        : '/admin/home/edit/process',
                type       : "POST",
                data       : new FormData(document.getElementById('form-edit')),
                enctype    : 'multipart/form-data',
                processData: false,                                           // Important!
                contentType: false,
                cache      : false,
                dataType   : "json",
                success: function (res) {
                    Swal.close();
                    if (res == 'success') {
                        Swal.fire({
                            title: 'Edit Banner Success !',
                            type: 'success',
                            text: "Banner successfuly updated !",
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
