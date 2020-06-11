@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">General Setting</h3>
                </div>
                <div class="panel-body">
                    <form id="form">
                        <div class="form-row">
                            <input type="hidden" name="id" id="id" value="{{$profile->profile_id}}">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$profile->profile_email}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Nomor Handphone</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Nomor Handphone" value="{{$profile->profile_phone}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">URL Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="URL Instagram" value="{{$profile->profile_instagram}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">URL Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="URL Facebook" value="{{$profile->profile_facebook}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Bank</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="radio" name="bank" value="BNI" {{$profile->profile_bank == 'BNI' ? 'checked' : ''}}> BNI
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="bank" value="Mandiri"{{$profile->profile_bank == 'Mandiri' ? 'checked' : ''}}> Mandiri
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="bank" value="BRI" {{$profile->profile_bank == 'BRI' ? 'checked' : ''}}> BRI
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="bank" value="BCA" {{$profile->profile_bank == 'BCA' ? 'checked' : ''}}> BCA
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nama Pemilik Rekening</label>
                                <input type="text" class="form-control" id="rekening" name="rekening" placeholder="Nama Pemilik Rekening" value="{{$profile->profile_rekening}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Nomor Rekening</label>
                                <input type="number" class="form-control" id="nomorRekening" name="nomorRekening" placeholder="Nomor Rekening" value="{{$profile->profile_nomor_rekening}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Province</label>
                                <select name="province" id="province" class="form-control" onchange="get_city(this.value, '')">
                                    <option value="" disabled selected>Choose Province</option>
                                    @foreach ($province as $row)
                                        <option value="{{$row['province_id']}}-{{$row['province']}}" {{$profile->profile_province_id == $row['province_id'] ? 'selected' : ''}}>{{$row['province']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">City</label>
                                <select name="city" id="city" class="form-control">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Address</label>
                                <textarea name="address" id="address" class="form-control" placeholder="Description Adrress"><?= nl2br($profile->profile_address) ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </form>
                </div>
            </div>
            <!-- END OVERVIEW -->
        </div>
    </div>
@endsection

@section('addOnJS')
    <script>
        $(document).ready(function(){
            $("#nav_setting").addClass('active');

            get_city('{{$profile->profile_province_id}}-{{$profile->profile_province}}', '{{$profile->profile_city_id}}')
        });

        function get_city(province, cityId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url     : "{{url('/admin/setting/get_city_admin')}}",
                type    : "POST",
                dataType: "JSON",
                data    : {province:province},
                success : function (res) {
                    if (res != 'empty') {
                        var html = '';

                        for (let i = 0; i < res.length; i++) {
                            if (cityId == res[i].city_id) {
                                var selected = 'selected';
                            } else {
                                var selected = '';
                            }
                            html += '<option value="'+res[i].city_id+'-'+res[i].type+' '+res[i].city_name+'" '+selected+'>'+res[i].type+' '+res[i].city_name+'</option>';
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

        $(document).ready(function(){
            $("#form").validate({
                // onclick: false,
                rules       : {
                    email: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    bank: {
                        required: true
                    },
                    rekening: {
                        required: true
                    },
                    nomorRekening: {
                        required: true
                    },
                    province: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    address: {
                        required: true
                    }
                },
                submitHandler : function (e) {
                    var form = $('#form').serialize();
                    submit_setting(form);
                }
            });
        });

        function submit_setting(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url        : '/admin/setting/general_setting',
                type       : "POST",
                data       : data,
                dataType   : "json",
                success: function (res) {
                    Swal.close();
                    if (res == 'success') {
                        Swal.fire({
                            title: 'Setting Success !',
                            type: 'success',
                            text: "Setting successfuly Changed !",
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
    </script>
@endsection
