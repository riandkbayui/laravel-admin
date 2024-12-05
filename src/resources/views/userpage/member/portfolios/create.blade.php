@section("header")
<title>Buat Baru | {{ office("office_name") }}</title>
@endsection

{!! breadcrumb("Buat Baru", ["Member", "Portfolio"]) !!}

<form id="form" action="{{ url("api/portfolios/create") }}" method="post">
	<div class="row">
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Thumbnail Portfolio</div>
				</div>
				<div class="card-body">
					<div class="text-center mb-2">
						<img id="img-preview" src="{{ url("assets/uploads/general/placeholder.jpg") }}" class="w-100 ar-16-75 img-cover-center">
						<p class="text-danger">* Pastikan rasio gambar adalah 16:75, atau 1200px:628px.</p>
					</div>
					<div class="form-group">
						<label>Upload Foto</label>
						<input type="file" name="photo" accept=".jpg,.jpeg,.png" class="form-control" required>
						<span validation-for="photo"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Formulir</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Judul</label>
						<input name="title" value="" placeholder="Masukkan judul" class="form-control" type="text" autocomplete="off" required>
						<span validation-for="title"></span>
					</div>
					<div class="form-group">
						<label>Slug</label>
						<input name="slug" value="" placeholder="Masukkan slug" class="form-control" type="text" autocomplete="off" required>
						<span validation-for="slug"></span>
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea name="description" placeholder="Masukkan deskripsi" class="form-control" rows="4" required></textarea>
						<span validation-for="description"></span>
					</div>
					<div class="form-group">
						<label>Konten</label>
						<textarea name="content" placeholder="Masukkan konten" class="form-control" rows="10"></textarea>
						<span validation-for="content"></span>
					</div>
					<div class="form-group">
						<label>Informasi</label>
						<textarea name="information" placeholder="Masukkan information" class="form-control" rows="10"></textarea>
						<span validation-for="information"></span>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Kategori</label>
								<select class="form-control" name="category" required>
									@foreach ($categories as $item)
									    <option value="{{$item}}">{{$item}}</option>
									@endforeach
								</select>
								<span validation-for="category"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Status</label>
						<div class="d-flex gap-2">
							<label class="cursor-pointer">
								<input type="radio" name="status" value="Show" checked>
								<span>Tampil</span>
							</label>
							<label class="cursor-pointer">
								<input type="radio" name="status" value="Hide">
								<span>Sembunyi</span>
							</label>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="w-100 btn btn-primary">Buat Portfolio</button>
				</div>
			</div>
		</div>
	</div>
</form>

@section("javascript")
<script type="text/javascript" src="{{ url("assets/libs/tinymce/tinymce.min.js") }}"></script>
<script type="text/javascript" src="{{ url("assets/libs/tinymce/jquery.tinymce.min.js") }}"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$("#form").submit(function(event) {
			event.preventDefault();
			var formData = new FormData(this);
			$(`span[validation-for]`).text('');
			$.LoadingOverlay("show");
			$.ajax({
				url: this.action,
				type: 'POST',
				dataType: 'json',
				processData: false,
				contentType: false,
				data: formData,
			})
			.done(function(response, textStatus, jqXHR) {
				Swal.fire({
					title: 'Berhasil!',
					text: response.message,
					icon: 'success',
					showCancelButton: false,
					confirmButtonColor: false,
					confirmButtonText: 'Ya',
				}).then((result) => {
					location.replace(response.redirect_to);
				});
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				if (jqXHR.responseJSON ?? false) {
					const json = jqXHR.responseJSON;
					Swal.fire('Maaf!', json.message, 'error');
					if (json.errors ?? false) {
						$.each(json.errors, function(index, val) {
							$(`span[validation-for="${index}"]`).text(val);
						});
					}
				}
			})
			.always(function() {
				$.LoadingOverlay("hide");
			});
		});

		$(`select[name^="category"]`).select2({
		  width: '100%',
		  tags: true,
		  placeholder: "Masukkan kategori"
		});

		$(`textarea[name="content"]`).tinymceSetup({
			upload_path: base_url(`/api/portfolios/upload_img`)
		});

		$(`textarea[name="information"]`).tinymceSetup({
			upload_path: base_url(`/api/portfolios/upload_img`)
		});

		$(`input[name="photo"]`).previewImgTo(`#img-preview`);

		$('input[name="title"]').on("input propertychange", function (e) {
			e.preventDefault();
			const val = this.value
				.toLowerCase()
				.replace(/[^0-9a-z]/gi, '-') 
				.replace(/-+/g, '-') 
				.replace(/^-|-$/g, ''); 

			$('input[name="slug"]').val(val);
		});

	});
</script>
@endsection