<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Shath ID</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/img/logo.png')}}" rel="icon">
    <link href="{{asset('assets/img/logo.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    @yield('addOnCSS')

    <style>
        .form-group .error {
            text-align: left !important;
            color: red;
        }
    </style>
</head>

<body>

    <main id="main">
        @yield('content')
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
        <div class="container">
            <div class="row">

            <div class="col-lg-6 col-md-6">
                <div class="footer-info">
                <h3>Contact</h3>
                <p>
                    <?= nl2br($profile->profile_address) ?> <br>
                    {{$profile->profile_city}}, {{$profile->profile_province}}<br><br>
                    <strong>Phone:</strong> {{$profile->profile_phone}}<br>
                    <strong>Email:</strong> {{$profile->profile_email}}<br>
                </p>
                <div class="social-links mt-3">
                    @if ($profile->profile_facebook != null)
                        <a href="{{$profile->profile_facebook}}" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                    @endif
                    @if ($profile->profile_instagram != null)
                        <a href="{{$profile->profile_instagram}}" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                    @endif
                </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 footer-links">

            </div>

            <div class="col-lg-4 col-md-6 footer-newsletter">
                <h4>Our Newsletter</h4>
                <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                <form action="" method="post">
                <input type="email" name="email"><input type="submit" value="Subscribe">
                </form>

            </div>

            </div>
        </div>
        </div>

        {{-- <div class="container"> --}}
        <!-- <div class="copyright">
            &copy; Copyright <strong><span>Multi</span></strong>. All Rights Reserved
        </div> -->
        {{-- <div class="credits"> --}}
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/multi-responsive-bootstrap-template/ -->
            {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
        {{-- </div>
        </div> --}}
    </footer>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/vendor/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('assets/vendor/venobox/venobox.min.js')}}"></script>
    <script src="{{asset('assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    @yield('addOnJS')

    <!-- Template Main JS File -->
    <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
