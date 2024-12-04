@section("header")
<title>Blog | {{ office("office_name") }}</title>

<!-- Primary Meta Tags -->
<meta name="title" content="Blog | {{ office("office_name") }}" />
<meta name="description" content="{{office("office_name")}} adalah website penyedia layanan Jasa pembuatan website yang terpercaya." />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{url("/")}}" />
<meta property="og:title" content="Blog | {{ office("office_name") }}" />
<meta property="og:description" content="{{office("office_name")}} adalah website penyedia layanan Jasa pembuatan website yang terpercaya." />
<meta property="og:image" content="{{ url("assets/logo-meta.png") }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{url("/")}}" />
<meta property="twitter:title" content="Blog | {{ office("office_name") }}" />
<meta property="twitter:description" content="{{office("office_name")}} adalah website penyedia layanan Jasa pembuatan website yang terpercaya." />
<meta property="twitter:image" content="{{ url("assets/logo-meta.png") }}" />

@endsection

<div>
	<!-- ======= Breadcrumbs ======= -->
	<section class="breadcrumbs">
		<div class="container">
			<ol>
				<li>
					<a href="{{ url("/") }}">Home</a>
				</li>
				<li>Blog</li>
			</ol>
			<h2>Blog</h2>
		</div>
	</section><!-- End Breadcrumbs -->
	<!-- ======= Blog Section ======= -->
	<section id="blog" class="blog">
		<div class="container" data-aos="fade-up">
			<div class="row">
				<div class="col-lg-8 entries">
					@if ($blogs->count())
						<div class="entries">
						    @foreach ($blogs as $blog)
								<article class="entry">
									<div class="entry-img">
										<img src="{{ url($blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid">
									</div>
									<h2 class="entry-title">
										<a href="{{ url($blog->slug) }}">{{ $blog->title }}</a>
									</h2>
									<div class="entry-meta">
										<ul>
											<li class="d-flex align-items-center"><i class="bi bi-person"></i> {{ office("office_name") }}</li>
											<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="{{ display_datetime($blog->publish_at) }}">{{ display_datetime($blog->publish_at) }}</time></li>
										</ul>
									</div>
									<div class="entry-content">
										<p>
											{{ $blog->description }}
										</p>
										<div class="read-more">
											<a href="{{ url($blog->slug) }}">Baca Selengkapnya</a>
										</div>
									</div>
								</article><!-- End blog entry -->
						    @endforeach
						</div>
						<div class="blog-pagination d-flex justify-content-center">
							{{ $blogs->links('vendor/pagination/default') }}
						</div>
					@else
					    <p class="text-center">- Postingan Tidak Ditemukan -</p>
					@endif
				</div><!-- End blog entries list -->
				<div class="col-lg-4">
					<div class="sidebar">
						<h3 class="sidebar-title">Pencarian</h3>
						<div class="sidebar-item search-form">
							<form action="{{ url("blogs") }}">
								<input type="text" placeholder="Masukkan pencarian" name="search" autocomplete="off">
								<button type="submit"><i class="bi bi-search"></i></button>
							</form>
						</div><!-- End sidebar search formn-->
						<h3 class="sidebar-title">Kategori</h3>
						<div class="sidebar-item categories">
							<ul>
								@foreach ($categories as $item)
								<li>
									<a href="{{ url("blogs/category/{$item}") }}">{{ $item }}</a>
								</li>
								@endforeach
							</ul>
						</div><!-- End sidebar categories-->
						<h3 class="sidebar-title">Tags</h3>
						<div class="sidebar-item tags">
							<ul>
								@foreach ($tags as $item)
								<li>
									<a href="{{ url("blogs/tag/{$item}") }}">{{ $item }}</a>
								</li>
								@endforeach
							</ul>
						</div><!-- End sidebar tags-->
					</div><!-- End sidebar -->
				</div><!-- End blog sidebar -->
			</div>
		</div>
	</section><!-- End Blog Section -->
</div>