@section('header')
<title>Dashboard | {{ office("office_name") }}</title>
@endsection

{!! breadcrumb("Dashboard", ["Member"]) !!}

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex gap-2">
                    <div class="flex-fill">
                        <div class="fw-bold mb-1">Blog Publish</div>
                        <h1>{{ idr($blog->publish) }}</h1>
                    </div>
                    <div>
                        <div class="avatar-md d-flex bg-light rounded-circle">
                            <i class="mdi mdi-blogger text-primary m-auto fsz-32"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex gap-2">
                    <div class="flex-fill">
                        <div class="fw-bold mb-1">Blog Draft</div>
                        <h1>{{ idr($blog->draft) }}</h1>
                    </div>
                    <div>
                        <div class="avatar-md d-flex bg-light rounded-circle">
                            <i class="mdi mdi-blogger text-primary m-auto fsz-32"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex gap-2">
                    <div class="flex-fill">
                        <div class="fw-bold mb-1">Blog Total</div>
                        <h1>{{ idr($blog->total) }}</h1>
                    </div>
                    <div>
                        <div class="avatar-md d-flex bg-light rounded-circle">
                            <i class="mdi mdi-blogger text-primary m-auto fsz-32"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>