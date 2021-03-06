@extends('admin.layout')

@section('addOnCSS')
    <style>
        .lable-detail {
            text-align: left;
            font-weight: bold;
            width: 30%
        }
        .value-detail {
            text-align: left;
            font-weight: bold;
        }
        .tabel.table-detail {
            border: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">History Order</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-8"></div>
                        <div class="col-sm-4">
                            <select name="filter" id="filter" class="form-control" onchange="get_data(this.value)">
                                <option value="0">All Order</option>
                                <option value="3">Finish Order</option>
                                <option value="4">Cancel Order</option>
                            </select>
                        </div>
                    </div> <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive" id="content-data">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OVERVIEW -->
        </div>
    </div>

    {{-- Modal Detail Order --}}
    <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content" style="height: 500px;overflow-y: auto;">
                <div class="modal-header">
                    <h3 class="modal-title" style="text-align: center"><strong> Detail Order</strong></h3>
                </div>
                <div class="modal-body" style="text-align:center" id="content-detail">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('addOnJS')
    <script>
        $(document).ready(function(){
            $("#nav_order").addClass('active');

            get_data(0);
        });

        function get_detail(id, status) {
            $.ajax({
                url     : "/admin/order/detail/"+id+'/'+status,
                type    : "GET",
                dataType: "HTML",
                success : function (res) {
                    Swal.close();
                    $('#content-detail').html(res);
                    $('#modal-detail').modal('show');
                },
                error   : function () {
                },
                beforeSend : function () {
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
            })
        }

        function get_data(type) {
            $.ajax({
                url     : "/admin/order/history/data/"+type,
                type    : "GET",
                dataType: "HTML",
                success : function (res) {
                    Swal.close();
                    $('#content-data').html(res);
                },
                error   : function () {
                },
                beforeSend : function () {
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
            })
        }
    </script>
@endsection
