@section('header')
<title>Portfolio | {{ office("office_name") }}</title>
@endsection

@section('breadcrumb-action')
<div class="text-end mt-2">
    <a href="{{ url("member/portfolios/create") }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Buat Baru</a>
</div>
@endsection

{!! breadcrumb("Portfolio", ["Member"]) !!}

<div class="card">
    <div class="card-header">
        <div class="card-title">Daftar Portfolio</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-hover table-striped text-nowrap">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Kategori</th>
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

@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        const table = $('#table').DataTable({
            'ajax':{
                'url'		: base_url('api/portfolios/datatable'),
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
                {data: "title", className: "text-wrap"},
                {data: "category"},
                {data: "status"},
                {data: "id", render: function(data, i, row){
                    const slug = base_url(`portfolio/${row.slug}`);
                    const urledit = base_url(`member/portfolios/update/${row.id}`);
                    return (`
                        <div class="d-flex gap-2">
                            <a target="_blank" class="btn btn-sm btn-primary" href="${slug}"><i class="fa fa-link"></i></a>
                            <a class="btn btn-sm btn-warning" href="${urledit}"><i class="fa fa-edit"></i></a>
                        </div>
                    `);
                }},
            ],
            'createdRow'	: function(element, row) {
                
            }
        });
    });
</script>
@endsection