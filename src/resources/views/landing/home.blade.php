@section("header")
<title>Beranda | {{ office("office_name") }}</title>

<!-- Primary Meta Tags -->
<meta name="title" content="Beranda | {{ office("office_name") }}" />
<meta name="description" content="{{office("office_name")}} adalah website penyedia layanan Jasa pembuatan website yang terpercaya." />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{url("/")}}" />
<meta property="og:title" content="Beranda | {{ office("office_name") }}" />
<meta property="og:description" content="{{office("office_name")}} adalah website penyedia layanan Jasa pembuatan website yang terpercaya." />
<meta property="og:image" content="{{ url("assets/logo-meta.png") }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{url("/")}}" />
<meta property="twitter:title" content="Beranda | {{ office("office_name") }}" />
<meta property="twitter:description" content="{{office("office_name")}} adalah website penyedia layanan Jasa pembuatan website yang terpercaya." />
<meta property="twitter:image" content="{{ url("assets/logo-meta.png") }}" />

@endsection

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
	<div class="container" data-aos="zoom-out" data-aos-delay="100">
		<div class="row">
			<div class="col-xl-6">
				<h1>Selamat datang di {{ office("office_name") }}</h1>
				<p class="text-white">Jasa pembuatan website yang terpercaya, kami di {{ office("office_name") }} memahami keunikan setiap proyek. Dengan sentuhan kreatif dan solusi teknologi yang canggih, kami membantu Anda mewujudkan visi online Anda.</p>
				<a href="#contact" class="btn-get-started scrollto">Hubungi Kami</a>
			</div>
		</div>
	</div>
</section><!-- End Hero -->
<main id="main">
	<!-- ======= About Section ======= -->
	<section id="about" class="about">
		<div class="container" data-aos="fade-up">
			<div class="row no-gutters">
				<div class="content col-xl-5 d-flex align-items-stretch">
					<div class="content">
						<h3>{{ office("office_name") }}</h3>
						<p>
							Selamat datang di {{ office("office_name") }}, solusi terdepan untuk kebutuhan pembuatan website Anda! Kami dengan bangga membuka pintu layanan profesional kami, memberikan jaminan bahwa setiap website yang kami bangun adalah manifestasi dari keahlian tinggi dan komitmen kami terhadap kepuasan pelanggan.
						</p>
						<a href="#" class="btn btn-outline-danger"><span>Tentang Kami</span> <i class="bx bx-chevron-right"></i></a>
					</div>
				</div>
				<div class="col-xl-7 d-flex align-items-stretch">
					<div class="icon-boxes d-flex flex-column justify-content-center">
						<div class="row">
							<div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
								<i class="bx bx-money-withdraw"></i>
								<h4>Harga Bersaing</h4>
								<p>{{ office("office_name") }} menawarkan solusi website dengan harga bersaing, sesuai anggaran Anda. Kami mengutamakan kualitas tanpa memberatkan keuangan, memastikan nilai terbaik bagi bisnis Anda.</p>
							</div>
							<div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
								<i class="bx bx-user-pin"></i>
								<h4>Tim Profesional</h4>
								<p>Dengan tim pemrogram berpengalaman, {{ office("office_name") }} menghadirkan profesionalisme dan kreativitas. Setiap anggota tim kami terampil dalam teknologi terbaru, memberikan desain website yang menarik dan fungsional.</p>
							</div>
							<div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
								<i class="bx bx-analyse"></i>
								<h4>Inovasi Berkelanjutan</h4>
								<p>{{ office("office_name") }} memelopori inovasi berkelanjutan dengan mengikuti tren teknologi terkini. Setiap proyek kami mencerminkan ide-ide segar dan konsep kreatif.</p>
							</div>
							<div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
								<i class="bx bx-shield"></i>
								<h4>Dukungan Pelanggan Terbaik</h4>
								<p>Kami tidak hanya membuat website; kami memberikan dukungan terbaik untuk kelancaran operasional Anda. {{ office("office_name") }} siap membantu setiap pertanyaan atau perubahan yang Anda butuhkan.</p>
							</div>
						</div>
					</div><!-- End .content-->
				</div>
			</div>
		</div>
	</section><!-- End About Section -->
	<!-- ======= Tabs Section ======= -->
	<section id="tabs" class="tabs">
		<div class="container" data-aos="fade-up">
			<ul class="nav nav-tabs row d-flex">
				<li class="nav-item col-3">
					<a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
						<i class="bi bi-code"></i>
						<h4 class="d-none d-lg-block">PHP</h4>
					</a>
				</li>
				<li class="nav-item col-3">
					<a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
						<i class="bi-code-square"></i>
						<h4 class="d-none d-lg-block">HTML</h4>
					</a>
				</li>
				<li class="nav-item col-3">
					<a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
						<i class="bi bi-code-slash"></i>
						<h4 class="d-none d-lg-block">NodeJS</h4>
					</a>
				</li>
				<li class="nav-item col-3">
					<a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
						<i class="bi bi-phone"></i>
						<h4 class="d-none d-lg-block">Android</h4>
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active show" id="tab-1">
					<div class="row">
						<div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
							<h3>Apa itu PHP?</h3>
							<p>
								PHP, singkatan dari Hypertext Preprocessor, adalah bahasa pemrograman sisi server yang digunakan secara luas untuk pengembangan web. PHP menyediakan kemampuan untuk membuat halaman web dinamis dengan mudah, mengintegrasikan HTML dan menyusun kode server-side untuk berinteraksi dengan basis data. PHP memiliki sintaksis yang mudah dipahami dan mendukung pengembangan aplikasi web yang dinamis dan efisien.
							</p>
						</div>
						<div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
							<img src="{{ url("/statics/img/tabs-1.jpg") }}" alt="" class="img-fluid">
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab-2">
					<div class="row">
						<div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
							<h3>Apa itu HTML?</h3>
							<p>
								HTML, singkatan dari Hypertext Markup Language, adalah bahasa markah standar yang digunakan untuk membuat struktur dan tata letak halaman web. HTML menggunakan elemen-elemen seperti tag, atribut, dan struktur hirarkis untuk menyusun konten web. Dengan HTML, pengembang dapat membuat struktur dokumen yang jelas dan membangun halaman web yang responsif dan mudah diakses oleh berbagai perangkat.
							</p>
						</div>
						<div class="col-lg-6 order-1 order-lg-2 text-center">
							<img src="{{ url("/statics/img/tabs-2.jpg") }}" alt="" class="img-fluid">
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab-3">
					<div class="row">
						<div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
							<h3>Apa itu NodeJS?</h3>
							<p>
								Node.js adalah platform runtime JavaScript yang memungkinkan pengembangan aplikasi sisi server. Dibangun di atas mesin JavaScript V8 dari Google Chrome, Node.js memungkinkan pengembang untuk mengeksekusi JavaScript di sisi server, memberikan kemampuan pengembangan aplikasi berkecepatan tinggi dan skala yang besar. Node.js populer untuk pengembangan aplikasi real-time, seperti aplikasi kolaboratif dan permainan daring.
							</p>
						</div>
						<div class="col-lg-6 order-1 order-lg-2 text-center">
							<img src="{{ url("/statics/img/tabs-3.jpg") }}" alt="" class="img-fluid">
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab-4">
					<div class="row">
						<div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
							<h3>Apa itu Android?</h3>
							<p>
								Android merupakan sistem operasi mobile yang dikembangkan oleh Google. Dirancang untuk perangkat seluler, Android memberikan platform yang terbuka dan fleksibel bagi pengembang untuk membuat aplikasi. Dengan dukungan terhadap berbagai perangkat keras dan fungsi, Android menyediakan ekosistem yang luas untuk pengembangan aplikasi mobile yang inovatif. Android Studio, lingkungan pengembangan resmi, mempermudah pembuatan aplikasi dengan memanfaatkan bahasa pemrograman Java atau Kotlin.
							</p>
						</div>
						<div class="col-lg-6 order-1 order-lg-2 text-center">
							<img src="{{ url("/statics/img/tabs-4.jpg") }}" alt="" class="img-fluid">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- End Tabs Section -->
	<!-- ======= Services Section ======= -->
	<section id="services" class="services section-bg ">
		<div class="container" data-aos="fade-up">
			<div class="section-title">
				<h2>Layanan</h2>
				<p>Berikut ini adalah layanan-layanan yang kami sajikan untuk anda.</p>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="100">
						<i class="bi bi-display"></i>
						<h4><a href="#">Pembuatan Website Responsif</a></h4>
						<p>{{ office("office_name") }} menyediakan layanan pembuatan website yang responsif dan mobile-friendly. Dengan desain yang menarik dan fungsionalitas yang optimal, kami memastikan pengalaman pengguna yang luar biasa di berbagai perangkat.</p>
					</div>
				</div>
				<div class="col-md-6 mt-4 mt-md-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
						<i class="bi bi-search"></i>
						<h4><a href="#">Optimisasi SEO</a></h4>
						<p>Kami memahami pentingnya visibilitas online. Layanan optimisasi SEO {{ office("office_name") }} membantu website Anda mendapatkan peringkat tinggi di mesin pencari, meningkatkan trafik organik dan kehadiran online Anda.</p>
					</div>
				</div>
				<div class="col-md-6 mt-4 mt-md-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="300">
						<i class="bi bi-wrench"></i>
						<h4><a href="#">Maintenance</a></h4>
						<p>{{ office("office_name") }} tidak hanya berhenti setelah website selesai dibuat. Kami sediakan layanan pemeliharaan rutin gratis selama 3 bulan untuk memastikan bahwa website Anda tetap berjalan lancar, aman, dan selalu up-to-date.</p>
					</div>
				</div>
				<div class="col-md-6 mt-4 mt-md-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="400">
						<i class="bi bi-calendar"></i>
						<h4><a href="#">Sistem Reservasi Online</a></h4>
						<p>Kami menyediakan solusi sistem reservasi online yang canggih untuk bisnis seperti restoran, hotel, atau layanan lainnya. Memungkinkan pelanggan untuk melakukan reservasi dengan mudah dan efisien.</p>
					</div>
				</div>
				<div class="col-md-6 mt-4 mt-md-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="500">
						<i class="bi bi-lightbulb"></i>
						<h4><a href="#">Konsultasi Strategi Digital</a></h4>
						<p>Layanan konsultasi strategi digital kami membantu Anda merancang rencana yang efektif untuk meningkatkan kehadiran online dan mencapai tujuan bisnis Anda. Kami memberikan panduan yang personal dan sesuai dengan kebutuhan Anda.</p>
					</div>
				</div>
				<div class="col-md-6 mt-4 mt-md-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="600">
						<i class="bi bi-android"></i>
						<h4><a href="#">Pengembangan Aplikasi Mobile</a></h4>
						<p>{{ office("office_name") }} menghadirkan layanan pengembangan aplikasi mobile yang inovatif. Dari ide hingga peluncuran, kami memastikan aplikasi Anda memenuhi standar kualitas tertinggi dan memberikan pengalaman pengguna yang luar biasa.</p>
					</div>
				</div>
			</div>
		</div>
	</section><!-- End Services Section -->
	<!-- ======= Testimonials Section ======= -->
	<section id="testimonials" class="testimonials">
		<div class="container" data-aos="fade-up">
			<div class="section-title">
				<h2>Testimonials</h2>
				<p>Berikut ini adalah kesan - kesan dari pelanggan {{ office("office_name") }}.</p>
			</div>
			<div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="testimonial-wrap">
							<div class="testimonial-item">
								<img src="{{ url("/statics/img/testimonials/testimonials-1.jpg") }}" class="testimonial-img" alt="">
								<h3>Budi Setiawan</h3>
								<h4>CEO Perusahaan XYZ</h4>
								<p>
									<i class="bx bxs-quote-alt-left quote-icon-left"></i>
									Inovasi {{ office("office_name") }} dalam setiap detail proyek membuat mereka berbeda. Tim mereka bersemangat, menghadirkan solusi teknologi yang cerdas. Dukungan pelanggan mereka membuat kami merasa diutamakan setelah website kami diluncurkan.
									<i class="bx bxs-quote-alt-right quote-icon-right"></i>
								</p>
							</div>
						</div>
					</div><!-- End testimonial item -->
					<div class="swiper-slide">
						<div class="testimonial-wrap">
							<div class="testimonial-item">
								<img src="{{ url("/statics/img/testimonials/testimonials-2.jpg") }}" class="testimonial-img" alt="">
								<h3>Rina Permatasari</h3>
								<h4>Pemilik Usaha Kecil</h4>
								<p>
									<i class="bx bxs-quote-alt-left quote-icon-left"></i>
									{{ office("office_name") }} tidak hanya membuat website, mereka menciptakan pengalaman. Harga terjangkau, tim yang berdedikasi, dan dukungan yang luar biasa. Saya merekomendasikan {{ office("office_name") }} kepada siapa pun yang mencari solusi website terbaik.
									<i class="bx bxs-quote-alt-right quote-icon-right"></i>
								</p>
							</div>
						</div>
					</div><!-- End testimonial item -->
					<div class="swiper-slide">
						<div class="testimonial-wrap">
							<div class="testimonial-item">
								<img src="{{ url("/statics/img/testimonials/testimonials-4.jpg") }}" class="testimonial-img" alt="">
								<h3>Ahmad Prasetyo</h3>
								<h4>Pengusaha Startup</h4>
								<p>
									<i class="bx bxs-quote-alt-left quote-icon-left"></i>
									{{ office("office_name") }} bukan hanya sekedar jasa pembuatan website; kami adalah mitra Anda dalam menghadirkan online presence yang luar biasa. Terima kasih kepada pelanggan setia kami yang telah berbagi pengalaman positif mereka!
									<i class="bx bxs-quote-alt-right quote-icon-right"></i>
								</p>
							</div>
						</div>
					</div><!-- End testimonial item -->
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</section><!-- End Testimonials Section -->
	<!-- ======= Frequently Asked Questions Section ======= -->
	<section id="faq" class="faq">
		<div class="container" data-aos="fade-up">
			<div class="section-title">
				<h2>Pertanyaan - Pertanyaan</h2>
			</div>
			<ul class="faq-list accordion" data-aos="fade-up">
				<li>
					<a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq1">Berapa biaya pembuatan website di {{ office("office_name") }}? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
					<div id="faq1" class="collapse" data-bs-parent=".faq-list">
						<p>
							Kami menawarkan harga bersaing. Biaya ditentukan berdasarkan kompleksitas proyek. Hubungi kami untuk penawaran yang sesuai dengan kebutuhan Anda.
						</p>
					</div>
				</li>
				<li>
					<a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq2">Siapakah anggota tim {{ office("office_name") }}? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
					<div id="faq2" class="collapse" data-bs-parent=".faq-list">
						<p>
							Tim kami terdiri dari pemrogram berpengalaman dan desainer kreatif. Mereka memadukan keahlian teknis dan artistik untuk menciptakan website yang unik.
						</p>
					</div>
				</li>
				<li>
					<a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq3">Bagaimana {{ office("office_name") }} memastikan inovasi dalam setiap proyek? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
					<div id="faq3" class="collapse" data-bs-parent=".faq-list">
						<p>
							Kami selalu mengikuti tren terkini dalam teknologi. Dengan pendekatan inovatif, setiap proyek mencerminkan ide segar dan konsep kreatif.
						</p>
					</div>
				</li>
				<li>
					<a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq4">Apakah {{ office("office_name") }} memberikan dukungan pelanggan setelah proyek selesai? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
					<div id="faq4" class="collapse" data-bs-parent=".faq-list">
						<p>
							Ya, kami memberikan dukungan pelanggan terbaik. Tim kami siap membantu dengan pertanyaan, pembaruan, atau perubahan setelah proyek selesai.
						</p>
					</div>
				</li>
				<li>
					<a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq5">Berapa lama waktu yang dibutuhkan untuk menyelesaikan proyek pembuatan website? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
					<div id="faq5" class="collapse" data-bs-parent=".faq-list">
						<p>
							Waktu pengerjaan bervariasi sesuai kompleksitas proyek. Kami akan memberikan estimasi waktu yang akurat pada awal proyek.
						</p>
					</div>
				</li>
				<li>
					<a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq6">Apakah {{ office("office_name") }} menerima proyek dari luar kota atau luar negeri? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
					<div id="faq6" class="collapse" data-bs-parent=".faq-list">
						<p>
							Ya, kami menerima proyek dari seluruh wilayah. Kami memastikan komunikasi yang efektif dan kolaborasi yang lancar melalui platform digital.
						</p>
					</div>
				</li>
				<li>
					<a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq7">Bagaimana saya bisa memulai proyek pembuatan website dengan {{ office("office_name") }}? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
					<div id="faq7" class="collapse" data-bs-parent=".faq-list">
						<p>
							Hubungi kami melalui formulir kontak di website kami atau langsung melalui email/telepon. Tim kami akan segera merespons dan membantu Anda memulai proyek Anda.
						</p>
					</div>
				</li>
			</ul>
		</div>
	</section><!-- End Frequently Asked Questions Section -->
	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container" data-aos="fade-up">
			<div class="section-title">
				<h2>Kontak</h2>
				<p>Jika ada suatu pertanyaan silahkan hubungi kontak di bawah ini.</p>
			</div>
			<div class="row" data-aos="fade-up" data-aos-delay="100">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-12">
							<div class="info-box">
								<i class="bx bx-map"></i>
								<h3>Alamat</h3>
								<p>{{ office("office_address") }}</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="info-box mt-4">
								<i class="bx bx-envelope"></i>
								<h3>Email</h3>
								<p>{{ office("office_email") }}</p>
							</div>
						</div>
						<div class="col-md-6">
							<a target="_blank" href="#">
								<div class="info-box mt-4">
									<i class="bx bx-phone-call"></i>
									<h3>Telepon (WA)</h3>
									<p>{{ office("office_phone") }}</p>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- End Contact Section -->
</main><!-- End #main -->

@section("javascript")
<script type="text/javascript">
	$(document).ready(function() {

		/**
		 * Testimonials slider
		 */
		new Swiper('.testimonials-slider', {
			speed: 600,
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			slidesPerView: 'auto',
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 20
				},

				1200: {
					slidesPerView: 3,
					spaceBetween: 20
				}
			}
		});
	});
</script>
@endsection