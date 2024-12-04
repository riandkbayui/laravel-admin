@section("header")
<title>Login Page | {{ office("office_name") }}</title>
@endsection

<div class="vh-100 vw-100 d-flex overflow-hidden">
	<div class="m-auto w-100 row justify-content-center">
		<div class="col-lg-3 px-3">
			<form id="form" action="{!! url("api/auth/login") !!}">
				<div class="card">
					<div class="card-body">
						<div class="text-center mb-4">
							<div class="avatar-md m-auto mb-2 d-flex ar-1-1 bg-primary rounded-circle">
								<i class="fa fa-user-alt m-auto text-white fsz-32"></i>
							</div>
							<h4 class="mb-0">Login Area</h4>
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input name="username" placeholder="Masukkan username" value="" class="form-control" type="text" autocomplete="off" required>
							<span validation-for="username"></span>
						</div>
						<div class="form-group">
							<label for="password">Kata Sandi</label>
							<div class="input-group">
								<input name="password" placeholder="Masukkan password" value="" class="form-control" type="password" autocomplete="off" required>
								<button type="button" id="pwd" class="btn btn-password btn-outline-primary"><i class="fa fa-eye"></i></button>
							</div>
							<span validation-for="password"></span>
						</div>
					</div>
					<div class="card-footer">
						<div class="form-group">
							<button class="btn btn-primary w-100">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@section("javascript")
<script type="text/javascript">
	$(document).ready(function() {
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

		$(`#pwd`).passwordToggle();
	});
</script>
@endsection