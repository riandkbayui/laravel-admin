@section('header')
<title>Pengguna | {{ office("office_name") }}</title>
@endsection

@section("breadcrumb-action")
<div class="text-end mt-2">
    <a href="{{ url("admin/users/create") }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah Baru</a>
</div>
@endsection

{!! breadcrumb("Pengguna", ["Admin"]) !!}

<div class="card">
	<div class="card-header">
		<div class="card-title">Daftar Pengguna</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="table" class="table table-hover table-striped text-nowrap">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Role</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

@section("javascript")
<script type="text/javascript">
	$(document).ready(function() {
		const table = $('#table').DataTable({
			'ajax':{
				'url'		: base_url('api/users/datatable'),
				'dataSrc'	: 'data',
				'type'		: 'POST'
			},
			'processing'	: true,
			'serverSide'	: true,
			'paging'		: true,
			'lengthChange'	: true,
			'searching'		: true,
			'ordering'		: true,
			'info'			: true,
			'autoWidth'		: false,
			'responsive'	: false,
			'order'			: [ [0, 'desc'] ],
			'columns'		: [
				{data: "created_at", render: v => idDateTimeFormat(v)},
				{data: "name"},
				{data: "username"},
				{data: "role"},
				{data: "status"},
				{data: "id", render: function(data, i, row){
					const url = base_url(`admin/users/update/${row.id}`);
					return (`
						<a class="btn btn-primary btn-sm" href="${url}"><i class="fa fa-user-edit"></i> Edit</a>
					`);
				}},
			],
			'createdRow'	: function(element, row) {
				
			}
		});
	});
</script>
@endsection