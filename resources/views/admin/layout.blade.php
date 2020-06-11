<!doctype html>
<html lang="en">

<head>

	<title>Admin Shath ID</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/admin/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/admin/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/admin/vendor/chartist/css/chartist-custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor/dropify/dist/css/dropify.css')}}">
	<link rel="stylesheet" href="{{asset('assets/js/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

	<!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/main.css')}}">

	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/demo.css')}}">

	<!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/logo.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/logo.png')}}">

    <style>
        .panel-body .row .table thead tr th {
            text-align: center;
            text-transform: uppercase;
        }

        .panel-headline .panel-heading .panel-title {
            text-transform: uppercase;
            font-weight: bold;
        }

        .form-group .error {
            text-align: left !important;
            color: red;
        }
    </style>

    @yield('addOnCSS')

</head>

<body>

	<!-- WRAPPER -->
	<div id="wrapper">

		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand" style="margin-top:-40px; padding-top: 40px; padding-bottom:0px;">
				<a href="/admin/home" ><h2>SHATH ID</h2></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets/img/logo.png')}}" class="img-circle" alt="Avatar"> <span>Admin</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a data-toggle="modal" data-target="#modalChangePassword"><i class="lnr lnr-cog"></i> <span>Ganti Password</span></a></li>
								<li><a href="/admin/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
        <!-- END NAVBAR -->

		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/admin/home" class="" id="nav_home"><i class="lnr lnr-home"></i> <span>Home</span></a></li>
						<li><a href="/admin/product" id="nav_product" class=""><i class="lnr lnr-store"></i> <span>Product</span></a></li>
                        <li>
							<a href="#subPages" id="nav_order" data-toggle="collapse" class="collapsed"><i class="lnr lnr-tag"></i> <span>Order</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="/admin/order" class="">Data Order</a></li>
									<li><a href="/admin/order/history" class="">History Order</a></li>
								</ul>
							</div>
						</li>
                        <li><a href="/admin/setting" id="nav_setting" class=""><i class="lnr lnr-cog"></i> <span>General Setting</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
        <!-- END LEFT SIDEBAR -->

		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			@yield('content')
			<!-- END MAIN CONTENT -->
		</div>
        <!-- END MAIN -->

		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">Powered By <i class="fa fa-love"></i><a href="#">Shath ID</a></p>
			</div>
		</footer>
	</div>
    <!-- END WRAPPER -->

    {{-- Modal Change Password --}}
    <div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" style="text-align:center">Ganti Password</h3>
                </div>
                <form id="formChangePassword">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Password Lama">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password Baru">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Konfirmasi Password Baru">
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="change_password($('#formChangePassword').serialize())">Simpan</button>
                </div>
            </div>
        </div>
    </div>

	<!-- Javascript -->
	<script src="{{asset('assets/admin/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendor/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('assets/admin/scripts/klorofil-common.js')}}"></script>
    <script src="{{asset('assets/vendor/dropify/dist/js/dropify.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

	<script>
		function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            $(prefix).val(rupiah);
        }

        function change_password(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/admin/change_password" ,
                type: "POST",
                data: data,
                dataType: "json",
                success: function (res) {
                    Swal.close();
                    if (res == 'success') {
                        Swal.fire({
                            title: 'Ganti Password',
                            type: 'success',
                            text: "Password berhasil diubah!",
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                            }).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            }
                        })
                    } else {
                        Swal.fire("Error !", res, "error");
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

    @yield('addOnJS')

</body>

</html>
