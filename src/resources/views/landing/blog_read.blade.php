@section("header")
<title>{{$blog->title}} | {{ office("office_name") }}</title>

<!-- Primary Meta Tags -->
<meta name="title" content="{{$blog->title}} | {{ office("office_name") }}" />
<meta name="description" content="{{ $blog->description }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{url($blog->slug)}}" />
<meta property="og:title" content="{{$blog->title}} | {{ office("office_name") }}" />
<meta property="og:description" content="{{ $blog->description }}" />
<meta property="og:image" content="{{ url($blog->thumbnail) }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{url($blog->slug)}}" />
<meta property="twitter:title" content="{{$blog->title}} | {{ office("office_name") }}" />
<meta property="twitter:description" content="{{ $blog->description }}" />
<meta property="twitter:image" content="{{ url($blog->thumbnail) }}" />

@endsection

<div>

	<section class="breadcrumbs">
		<div class="container">

			<ol>
				<li>
					<a href="{{ url("/") }}">Home</a>
				</li>
				<li>
					<a href="{{ url("blogs") }}">Blog</a>
				</li>
				<li>Baca Artikel</li>
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
							<img src="{{ url($blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid">
						</div>

						<h2 class="entry-title">
							{{ $blog->title }}
						</h2>

						<div class="entry-meta">
							<ul>
								<li class="d-flex align-items-center"><i class="bi bi-person"></i> {{ office("office_name") }}</li>
								<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="{{ display_datetime($blog->publish_at) }}">{{ display_datetime($blog->publish_at) }}</time></li>
							</ul>
						</div>

						<div class="entry-content">{!! $blog->content !!}</div>

						<div class="entry-footer">
							<i class="bi bi-folder"></i>
							<ul class="cats">
								<li>
									<a href="{{ url("blogs/tag/{$blog->category}") }}">{{$blog->category}}</a>
								</li>
							</ul>

							<i class="bi bi-tags"></i>
							<ul class="tags">
								@foreach ($blogtags as $item)
								    <li>
										<a href="{{ url("blogs/tag/{$item}") }}">{{$item}}</a>
									</li>
								@endforeach
							</ul>
						</div>

					</article><!-- End blog entry -->

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
	</section><!-- End Blog Single Section -->

</div>