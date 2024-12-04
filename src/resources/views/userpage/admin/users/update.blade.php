@section('header')
<title>Perbarui Pengguna | {{ office("office_name") }}</title>
@endsection

{!! breadcrumb("Perbarui Pengguna", ["Admin", "Pengguna"]) !!}

<form id="form" action="{{url("api/users/update")}}" method="post">
	<div class="row">
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Foto Profil</div>
				</div>
				<div class="card-body">
					<div class="text-center mb-2">
						<img id="preview-img" src="{{ url($user->photo) }}" class="wh-240 img-cover-center" alt="foto profil">
					</div>
					<div class="form-group">
						<label>Upload Foto</label>
						<input name="photo" class="form-control" type="file" accept=".jpg,.jpeg,.png">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Biodata Penggna</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Nama Pengguna</label>
						<input name="name" placeholder="" value="{{ $user->name }}" class="form-control" type="text" autocomplete="off" required>
						<span validation-for="name"></span>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input name="username" placeholder="" value="{{ $user->username }}" class="form-control" type="text" autocomplete="off" required>
						<span validation-for="username"></span>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input name="email" placeholder="" value="{{ $user->email }}" class="form-control" type="text" autocomplete="off" required>
						<span validation-for="email"></span>
						<input name="id" value="{{ $user->id }}" placeholder="" class="d-none" type="hidden">
					</div>
					<div class="form-group">
						<label>Telp</label>
						<input name="phone" placeholder="" value="{{ $user->phone }}" class="form-control" type="number" autocomplete="off" required>
						<span validation-for="phone"></span>
					</div>
					<p class="text-danger">* Kosongkan jika tidak ingin mengubah kata sandi.</p>
					<div class="form-group">
						<label>Kata sandi</label>
						<div class="input-group">
							<input name="password" placeholder="Masukkan kata sandi" value="" class="form-control" type="password" autocomplete="off">
							<button type="button" class="btn btn-outline-primary"><i class="fa fa-eye"></i></button>
						</div>
						<span validation-for="password"></span>
					</div>
					<div class="form-group">
						<label>Konfirmasi sandi</label>
						<div class="input-group">
							<input name="password_confrimation" placeholder="Masukkan konfirmasi sandi" value="" class="form-control" type="password" autocomplete="off">
							<button type="button" class="btn btn-outline-primary"><i class="fa fa-eye"></i></button>
						</div>
						<span validation-for="password_confrimation"></span>
					</div>
				</div>
				<div class="card-footer">
					<button class="w-100 btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
				</div>
			</div>
		</div>
	</div>
</form>

@section('javascript')
<script type="text/javascript">
	$(document).ready(function () {
		$(`#form`).submit(function(e) {
			e.preventDefault();
			const formData = new FormData(this);
			$(`span[validation-for]`).text("");
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

		$(`input[type="password"]`).passwordToggle();
		$(`input[name="username"]`).inputUsername();
		$(`input[name="email"]`).inputEmail();
		$(`input[name="phone"]`).inputOnlyNumber();
		$(`input[name="photo"]`).previewImgTo(`#preview-img`);
	});
</script>
@endsection