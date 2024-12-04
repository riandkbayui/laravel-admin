<script src="{{url("assets/libs/jquery/jquery.min.js")}}"></script>
<script src="{{url("assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{url("assets/libs/metismenu/metisMenu.min.js")}}"></script>
<script src="{{url("assets/libs/simplebar/simplebar.min.js")}}"></script>
<script src="{{url("assets/libs/node-waves/waves.min.js")}}"></script>
<script src="{{url("assets/js/app.js")}}"></script>
{{-- custom start --}}
<script src="{{url("assets/libs/loadingoverlay/loadingoverlay.min.js")}}"></script>
<script src="{{url("assets/libs/moment/moment.js")}}"></script>
<script src="{{url("assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js")}}"></script>
<script src="{{url("assets/libs/select2/js/select2.min.js")}}"></script>
<script src="{{url("assets/libs/sweetalert2/sweetalert2.min.js")}}"></script>
<script src="{{url("assets/libs/datatables/datatables.min.js")}}"></script>
<script src="{{url("assets/libs/utils.js")}}"></script>
{{-- custom end --}}
<script type="text/javascript">
	const base_url = function(url) {
		const site_url = "{!! base_url() !!}".replace(/^\/+|\/+$/g, '');
		const url_to = url.replace(/^\/+|\/+$/g, '');
		return `${site_url}/${url_to}`;
	}
</script>