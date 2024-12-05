<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@yield('header')
	<!-- App favicon -->
	<link rel="shortcut icon" href="{{url("assets/logo-square.png")}}">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="{{url("statics/vendor/aos/aos.css")}}" rel="stylesheet">
	<link href="{{url("statics/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
	<link href="{{url("statics/vendor/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet">
	<link href="{{url("statics/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
	<link href="{{url("statics/vendor/glightbox/css/glightbox.min.css")}}" rel="stylesheet">
	<link href="{{url("statics/vendor/remixicon/remixicon.css")}}" rel="stylesheet">
	<link href="{{url("statics/vendor/swiper/swiper-bundle.min.css")}}" rel="stylesheet">
	<link href="{{url("statics/css/style.css")}}" rel="stylesheet">
	<link href="{{url("assets/css/fontsizes.css")}}" rel="stylesheet">

	@yield('style')

</head>

<body class="">


	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top d-flex align-items-center">
		<div class="container d-flex align-items-center">
			<h1 class="logo me-auto">
				<a href="{{url("/")}}"><img src="{{url("assets/logo-land.png")}}"></a>
			</h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html" class="logo me-auto"><img src="/statics/img/logo.png" alt=""></a>-->
			<nav id="navbar" class="navbar order-last order-lg-0">
				<ul>
					<li>
						<a class="nav-link scrollto" href="{{ url("/") }}">Beranda</a>
					</li>
					<li>
						<a class="nav-link scrollto" href="#about">Tentang</a>
					</li>
					<li>
						<a class="nav-link scrollto" href="#services">Layanan</a>
					</li>
					<li>
						<a href="{{ url("blogs") }}">Blog</a>
					</li>
					<li>
						<a class="nav-link scrollto" href="#contact">Kontak</a>
					</li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->
			<a href="{{ url("/auth/login") }}" class="get-started-btn scrollto">Masuk</a>
		</div>
	</header><!-- End Header -->
	
	{!! $content ?? "" !!}

	<!-- ======= Footer ======= -->
	<footer id="footer">
		<div class="container d-md-flex py-4">
			<div class="me-md-auto text-center text-md-start">
				<div class="copyright">
					&copy; Copyright <strong><span>{{ office("office_name") }}</span></strong>. All Rights Reserved
				</div>
				<div class="credits">
					<!-- All the links in the footer should remain intact. -->
					<!-- You can delete the links only if you purchased the pro version. -->
					<!-- Licensing information: https://bootstrapmade.com/license/ -->
					<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/presento-bootstrap-corporate-template/ -->
					Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
				</div>
			</div>
			<div class="social-links text-center text-md-end pt-3 pt-md-0">
				<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
				<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
				<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
				<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
				<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
			</div>
		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->
	<script src="{{url("assets/libs/jquery/jquery.min.js")}}"></script>
	<script src="{{url("statics/vendor/purecounter/purecounter_vanilla.js")}}"></script>
	<script src="{{url("statics/vendor/aos/aos.js")}}"></script>
	<script src="{{url("statics/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
	<script src="{{url("statics/vendor/glightbox/js/glightbox.min.js")}}"></script>
	<script src="{{url("statics/vendor/isotope-layout/isotope.pkgd.min.js")}}"></script>
	<script src="{{url("statics/vendor/swiper/swiper-bundle.min.js")}}"></script>
	<script src="{{url("statics/vendor/php-email-form/validate.js")}}"></script>
	<script src="{{url("statics/js/main.js")}}"></script>

	@yield('javascript')

</body>

</html>