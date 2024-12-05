@section('header')
<title>Konfigurasi | {{ office("office_name") }}</title>
@endsection

{!! breadcrumb("Konfigurasi", ["Admin"]) !!}

<div class="card">
    <div class="card-header">
        <div class="card-title">Daftar Konfigurasi</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-hover table-striped text-nowrap">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Value</th>
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
    const table = $('#table').DataTable({
        'ajax':{
            'url'		: base_url('api/configs/datatable'),
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
            {data: "description"},
            {data: "value", render: function(data, i, row){
                return (`
                    <input name="value" placeholder="Masukkan nilai" value="${data}" class="form-control" type="text" autocomplete="off">
                `);
            }, className: "wd-280"}
        ],
        'createdRow'	: function(element, row) {
            $(`input[name="value"]`, element).on("change", function(e){
                e.preventDefault();
                $.LoadingOverlay("show");
                $.ajax({
                    url: base_url('api/configs/update'),
                    type: 'POST',
                    dataType: 'json',
                    processData: true,
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    data: {
                        id: row.id,
                        value: this.value
                    },
                })
                .done(function(response, textStatus, jqXHR) {
                    Swal.fire('Berhasil!', response.message, 'success');
                    table.ajax.reload();
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.responseJSON ?? false) {
                        const json = jqXHR.responseJSON;
                        Swal.fire('Maaf!', json.message, 'error');
                    }
                })
                .always(function() {
                    $.LoadingOverlay("hide");
                });
            });
        }
    });
</script>
@endsection