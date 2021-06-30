@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section class="card card-body modern-horizontal-wizard">
                <div class=" wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">
                        <form class="form" id="user_form" method="post" action="{{ route('customer-relation.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Applicant/Customer:</td>
                                                <td colspan="2">
                                                    <select name="applicantname" id="applicantname"
                                                        class="form-control form-control-sm">
                                                        <option value="">Select Applicant/Customer</option>
                                                        <option value="880">(880)Mohammad Ali(E-Network)</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Uplink pop:</td>
                                                <td><input type="text" name="uplink" class="form-control form-control-sm"
                                                        required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Issue Type</td>
                                                <td>
                                                    <select name="issue_type" class="form-control form-control-sm">
                                                        <option value="">Select Type</option>
                                                        <option value="no_issue">No Issue</option>
                                                        <option value="not_responding">Not Responding</option>
                                                        <option value="marketing">Marketing</option>
                                                        <option value="fiber">Fiber</option>
                                                        <option value="support">Support</option>
                                                        <option value="account">Accounts</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Client Type</td>
                                                <td>
                                                    <select name="client_type" class="form-control form-control-sm">
                                                        <option value="">Select Type</option>
                                                        <option value="bandwidth">Bandwidth Client</option>
                                                        <option value="mac">Mac Client</option>
                                                        <option value="corporate">Corporate Client</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Problem Start Date</td>
                                                <td>
                                                    <input type="date" name="start_date"
                                                        class="form-control flatpickr-basic flatpickr-input"
                                                        placeholder="YYYY-MM-DD" readonly="readonly">
                                                    {{-- <input type="text" name="start_date" class="datepicker form-control"> --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Issue Details</td>
                                                <td>
                                                    <textarea name="issue_details" class="form-control"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assign To</td>
                                                <td><select id="userlist" name="user" class="form-control form-control-sm">
                                                        <option value="">Select User</option>
                                                        <option value="0">No User</option>
                                                        <option value="1">(1)Rokibul Hasan(rokibul)</option>
                                                        <option value="114">(114)Marketing Admin(madmin)</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td>Remark</td>
                                                <td>
                                                    <textarea name="remark" class="form-control"></textarea>
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>



                                </div>

                                <div class="col-md-12">
                                    <a href="#" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to List</a>
                                    <input type="submit" value="Submit" class="btn btn-primary pull-right"
                                        style="width:150px">
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


    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/forms/form-wizard.css">

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
@section('page-js')
    <script src="{{ asset('') }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
