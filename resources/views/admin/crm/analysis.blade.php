@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <div class="content-body">
            <section class="card card-body modern-horizontal-wizard">
                <div class=" wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">

                        <form action="" id="search">
                            <div class="row">

                                <div class="col-sm-4">
                                    From Date
                                    <input type="date" name="from_date" class="form-control flatpickr-basic
                                                                                        flatpickr-input"
                                        placeholder="YYYY-MM-DD" readonly="readonly">
                                </div>
                                <div class="col-sm-4">
                                    To Date
                                    <input type="date" name="to_date" class="form-control flatpickr-basic
                                                                                        flatpickr-input"
                                        placeholder="YYYY-MM-DD" readonly="readonly">
                                </div>

                                {{-- <div class="col-sm-5">
                                    Date range:
                                    <input type="text"
                                        class="data-type form-control form-control-sm flatpickr-range flatpickr-input active"
                                        name="report_date" id="reservation" required=""
                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
                                </div> --}}
                                {{-- <div class="col-sm-2 mt-2">
                                    <input type="submit" value="Generate Report" class="btn btn-primary form-control"
                                        style="margin-top:20px">
                                </div> --}}
                                <div class="col-sm-2">
                                    <button @click="search" type="submit" id="searchBtn"
                                        class="btn btn-info byn-block form-control mt-2">
                                        Search
                                    </button>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-warning byn-block form-control mt-2" type="reset"
                                        id="reset">Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-12 orderlist" id="result">


                    </div>


                </div>
            </section>
        </div>
    </div>


@endsection

@section('vendor-css')

    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/pickers/pickadate/pickadate.css">
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
    <script type="text/javascript">
        //console.log('error');
        $(document).ready(function() {
            $('#reset').click(function() {
                $('#result').html('');
            });
            $('#searchBtn').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '{{ route('crmResult') }}',
                    data: $('#search').serialize(),
                    // alert(result);
                    success: function(result) {
                        console.log(result);
                        $('#result').html(result);
                    }
                });
            });
            //alert(result);
            $('#details').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '{{ route('crmResult') }}',
                    data: $('#search').serialize(),
                    success: function(result) {
                        $('#result').html(result);
                    }
                });
            });
        });
    </script>

@endpush
