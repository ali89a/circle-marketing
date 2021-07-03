@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section class="card card-body modern-horizontal-wizard">
                <div class=" wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">
                        <form class="form" id="user_form" method="post"
                            action="{{ route('customer-relation.update', $crm->id) }}" name="editForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            {{-- <input type="hidden" name="createdBy" value="{{ Auth::user()->id }}"> --}}
                                            <input type="hidden" name="id" value="{{ $crm->id }}">
                                            <tr>
                                                <td>Applicant/Customer:</td>
                                                <td colspan="2">
                                                    <select name="applicantname" id="applicantname"
                                                        class="form-control form-control-sm" disabled="true">
                                                        <option value="">Select Applicant/Customer</option>
                                                        @foreach ($customers as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td>Work Order:</td>
                                                <td colspan="2">
                                                    <select name="workOrder" id="workOrder"
                                                        class="form-control form-control-sm" disabled="true">
                                                        <option value="">Select Work Order</option>
                                                        @foreach ($workOrders as $item)
                                                            <option value="{{ $item->id }}">{{ $item->id }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <td>Uplink pop:</td>
                                                <td><input type="text" name="uplink" class="form-control form-control-sm"
                                                        value="{{ $crm->uplink }}" required="" readonly></td>
                                            </tr>
                                            <tr>
                                                <td>Client Type</td>
                                                <td>
                                                    <select name="client_type" class="form-control form-control-sm"
                                                        disabled="true">
                                                        <option value="">Select Type</option>
                                                        <option value="bandwidth">Bandwidth Client</option>
                                                        <option value="mac">Mac Client</option>
                                                        <option value="corporate">Corporate Client</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Problem Start Date</td>
                                                <td>
                                                    <input type="date" name="start_date" value="{{ $crm->start_date }}"
                                                        class="form-control flatpickr-basic flatpickr-input"
                                                        placeholder="YYYY-MM-DD" disabled="true">
                                                    {{-- <input type="text" name="start_date" class="datepicker form-control"> --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Issue Details</td>
                                                <td>
                                                    <textarea name="issue_details" class="form-control"
                                                        disabled="true">{{ $crm->issue_details }}</textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Assign To</td>
                                                <td>
                                                    <select id="user" name="user" class="form-control form-control-sm"
                                                        disabled="true">
                                                        <option value="">Select User</option>
                                                        @foreach ($admins as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Remark</td>
                                                <td>
                                                    <textarea name="remark" class="form-control"
                                                        disabled="true">{{ $crm->remark }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Issue Type</td>
                                                <td>
                                                    <select name="issue_type" class="form-control form-control-sm" disabled="true">
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
                                                <td>Rating</td>
                                                <td>
                                                    <select id="rating" name="rating" class="form-control form-control-sm" disabled="true">
                                                        <option value="">Select One</option>
                                                        <option value="solved">Solved</option>
                                                        <option value="not_solved">Not Solved</option>
                                                    </select>
                                                    {{-- <input type="text" name="rating" class="form-control form-control-sm"
                                                        value="{{ $crm->rating }}"> --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Feedback</td>
                                                <td>
                                                    <select id="feedback" name="feedback"
                                                        class="form-control form-control-sm"  disabled="true">
                                                        <option value="">Select One</option>
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                    {{-- <input type="text" name="feedback" class="form-control form-control-sm"
                                                        value="{{ $crm->feedback }}"> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="col-md-12 offset-md-10">
                                    <br>
                                    <input type="submit" value="Submit" class="btn btn-primary pull-right">
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.forms['editForm'].elements['applicantname'].value = {{ $crm->applicantname }}
        //document.forms['editForm'].elements['workOrder'].value = {{ $crm->workOrder }}
        document.forms['editForm'].elements['issue_type'].value = "{{ $crm->issue_type }}"
        document.forms['editForm'].elements['client_type'].value = "{{ $crm->client_type }}"
        document.forms['editForm'].elements['user'].value = {{ $crm->user }}
        document.forms['editForm'].elements['rating'].value = "{{ $crm->rating }}"
        document.forms['editForm'].elements['feedback'].value = "{{ $crm->feedback }}"
    </script>

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
