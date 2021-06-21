@extends('admin.layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-body">
        <section class="card card-body modern-horizontal-wizard">
            <div class=" wizard-modern modern-wizard-example">
                <div class="bs-stepper-content">

                    <form action="#" method="get">
                        <div class="row">
                            <div class="col-sm-5">
                                Date range:
                                <input type="text"
                                    class="data-type form-control form-control-sm flatpickr-range flatpickr-input active"
                                    name="report_date" id="reservation" required=""
                                    placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
                            </div>
                            <div class="col-sm-2 mt-2">
                                <input type="submit" value="Generate Report" class="btn btn-primary form-control"
                                    style="margin-top:20px">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>


@endsection
@section('vendor-css')

    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

@endsection
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/workOrder.css">
@endsection
@push('style')

@endpush
@section('vendor-js')
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endsection
@section('page-js')
    <script src="{{ asset('/') }}app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
@endsection

@push('script')
    

@endpush
