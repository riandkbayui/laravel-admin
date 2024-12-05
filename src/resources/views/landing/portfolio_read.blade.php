@section("header")
<title>{{$portfolio->title}} | {{ office("office_name") }}</title>

<!-- Primary Meta Tags -->
<meta name="title" content="{{$portfolio->title}} | {{ office("office_name") }}" />
<meta name="description" content="{{ $portfolio->description }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{url($portfolio->slug)}}" />
<meta property="og:title" content="{{$portfolio->title}} | {{ office("office_name") }}" />
<meta property="og:description" content="{{ $portfolio->description }}" />
<meta property="og:image" content="{{ url($portfolio->thumbnail) }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{url($portfolio->slug)}}" />
<meta property="twitter:title" content="{{$portfolio->title}} | {{ office("office_name") }}" />
<meta property="twitter:description" content="{{ $portfolio->description }}" />
<meta property="twitter:image" content="{{ url($portfolio->thumbnail) }}" />

@endsection

<div>

	<section class="breadcrumbs">
		<div class="container">

			<ol>
				<li>
					<a href="{{ url("/") }}">Home</a>
				</li>
				<li>
					<a href="{{ url("/") }}">Portfolio</a>
				</li>
				<li>Detail</li>
			</ol>

		</div>
	</section><!-- End Breadcrumbs -->

	<!-- ======= Blog Single Section ======= -->
	<section id="blog" class="blog">
		<div class="container" data-aos="fade-up">

			<div class="row">

				<div class="col-lg-8 entries">

					<article class="entry entry-single">

						<div class="entry-img">
							<img src="{{ url($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="img-fluid">
						</div>

						<h2 class="entry-title">
							{{ $portfolio->title }}
						</h2>

						<div class="entry-meta">
							<ul>
								<li class="d-flex align-items-center"><i class="bi bi-person"></i> {{ office("office_name") }}</li>
								<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="{{ display_datetime($portfolio->updated_at) }}">{{ display_datetime($portfolio->updated_at) }}</time></li>
							</ul>
						</div>

						<div class="entry-content">{!! $portfolio->content !!}</div>

					</article><!-- End blog entry -->

				</div><!-- End blog entries list -->

				<div class="col-lg-4">
					<div class="sidebar">
						<h3 class="sidebar-title">Informasi</h3>
						<hr>
						<div>
							{!! $portfolio->information !!}
						</div>
					</div><!-- End sidebar -->
				</div><!-- End blog sidebar -->

			</div>

		</div>
	</section><!-- End Blog Single Section -->

</div>