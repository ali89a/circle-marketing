@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <div class="content-body">
            <section class="modern-horizontal-wizard">
                <div class="bs-stepper wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">
                        <div class="card box">
                            <div class=" card-body box-body">
                                <div class="col-md-12" style="margin-bottom:15px;">
                                    <form action="" id="search">
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label for="fp-range"> Issue Type</label>
                                                <select name="issue_type" class="form-control form-control-sm">
                                                    <option value="">Select Type</option>
                                                    <option value="no_issue">No Issue</option>
                                                    <option value="not_responding">Not Responding</option>
                                                    <option value="marketing">Marketing</option>
                                                    <option value="fiber">Fiber</option>
                                                    <option value="support">Support</option>
                                                    <option value="account">Accounts</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                From Date
                                                <input type="date" name="from_date"
                                                    class="form-control flatpickr-basic flatpickr-input"
                                                    placeholder="YYYY-MM-DD" readonly="readonly">
                                            </div>
                                            <div class="col-sm-4">
                                                To Date
                                                <input type="date" name="to_date"
                                                    class="form-control flatpickr-basic flatpickr-input"
                                                    placeholder="YYYY-MM-DD" readonly="readonly">
                                            </div>
                                            <div class="col-sm-4">
                                                Contact Number/Organization:
                                                <input type="text" class="form-control " name="mobile" onclick="">
                                            </div>
                                            <div class="col-sm-2">
                                                <button @click="search" type="submit" id="searchBtn"
                                                    class="btn btn-primary byn-block form-control mt-2">
                                                    Search
                                                </button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-primary byn-block form-control mt-2" type="reset"
                                                    id="reset">Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                </div>
                                <div class="col-md-12 orderlist" id="result">
                                    <table class="table table-bordered table-striped table-responsive">
                                        <tbody>
                                            <tr>
                                                <th>ID</th>
                                                <th>Action</th>
                                                <th>Issue Status</th>
                                                <th>Current<br> Status</th>
                                                <th>Customer</th>
                                                <th>Client Type</th>
                                                <th>Mobile</th>
                                                <th>Uplink POP</th>
                                                <th>Issue Type</th>
                                                <th>Issue Details</th>
                                                <th>Issue Start Date</th>
                                                <th>Assigned to</th>
                                                <th>Create Date</th>
                                                <th>Created By</th>
                                                <th>Remark</th>
                                                <th>Feedback</th>
                                                <th>Rating</th>
                                                <th>Review</th>
                                            </tr>
                                            @foreach ($crms as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ $item->userName }}</td>
                                                    <td>{{ $item->client_type }}</td>
                                                    <td>{{ $item->mobile }}</td>
                                                    <td>{{ $item->uplink }}</td>
                                                    <td>{{ $item->issue_type }}</td>
                                                    <td>{{ $item->issue_details }}</td>
                                                    <td>{{ date('d-M-Y g:i: a ', strtotime($item->start_date)) }}</td>
                                                    <td>{{ $item->adminName }}</td>
                                                    <td>{{ date('d-M-Y g:i: a ', strtotime($item->created_at)) }}</td>
                                                    <td>{{ $item->adminName }}</td>
                                                    <td>{{ $item->remark }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{ $reports->links() }} --}}
                                </div>
                                <hr>
                                <br>
                                {{-- <div id="result"> --}}
                                {{-- list will show in this box --}}
                                {{-- </div> --}}
                            </div>
                            <div class="row form-control-sm mb-2 ml-2">
                                <ul class="pagination">
                                    <li><a href="" data-ci-pagination-page="20">
                                            {{-- {{ $reports->links() }} --}}
                                        </a></li>
                                </ul>
                            </div>
                        </div>
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
                    url: '{{ route('crmSearchResult') }}',
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
                    url: '{{ route('crmSearchResult') }}',
                    data: $('#search').serialize(),
                    success: function(result) {
                        $('#result').html(result);

                    }
                });
            });
        });
    </script>

@endpush
