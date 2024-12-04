@section("header")
<title>Buat Baru | {{ office("office_name") }}</title>
@endsection

{!! breadcrumb("Buat Baru", ["Member", "Blogs"]) !!}

<form id="form" action="{{ url("api/blogs/create") }}" method="post">
	<div class="row">
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Thumbnail Blog</div>
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
						<div class="col-lg-8">
							<div class="form-group">
								<label>Tags</label>
								<select class="form-control" name="tags[]" multiple="multiple" required></select>
								<span validation-for="tags"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Status</label>
						<div class="d-flex gap-2">
							<label class="cursor-pointer">
								<input type="radio" name="status" value="Publish" checked>
								<span>Publish</span>
							</label>
							<label class="cursor-pointer">
								<input type="radio" name="status" value="Draft">
								<span>Draft</span>
							</label>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="w-100 btn btn-primary">Buat Postingan</button>
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

		$(`select[name^="tags"]`).select2({
		  width: '100%',
		  tags: true
		});

		$(`select[name^="category"]`).select2({
		  width: '100%',
		  tags: true,
		  placeholder: "Masukkan kategori"
		});

		$(`textarea[name="content"]`).tinymce({
			height: 480,
			plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				"save table directionality emoticons template paste"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
			setup: function (editor) {
				editor.on('change', function () {
					editor.save();
				});
			},
			image_class_list: [
				{title: 'Default', value: 'img-fluid'},
				{title: 'Width 100%', value: 'w-100'},
			],
			relative_urls: false,
			remove_script_host: true,
			document_base_url: '',
			automatic_uploads: true,
			images_upload_handler: handleImageUpload,
		});

		function handleImageUpload(blobInfo, success, failure, progress) {
			var xhr, formData;

			xhr = new XMLHttpRequest();
			xhr.withCredentials = false;
			xhr.open('POST', base_url(`/api/blogs/upload_img`));

			xhr.upload.onprogress = function(e) {
				progress(e.loaded / e.total * 100);
			};

			xhr.onload = function() {
				var json;

				if (xhr.status === 403) {
					failure('HTTP Error: ' + xhr.status, {
						remove: true
					});
					return;
				}

				if (xhr.status < 200 || xhr.status >= 300) {
					failure('HTTP Error: ' + xhr.status);
					return;
				}

				json = JSON.parse(xhr.responseText);
				if (!json || typeof json.url != 'string') {
					failure('Invalid JSON: ' + xhr.responseText);
					return;
				}
				success(json.url);
			};

			xhr.onerror = function() {
				failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
			};

			formData = new FormData();
			formData.append('file', blobInfo.blob(), blobInfo.filename());

			xhr.send(formData);
		};

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