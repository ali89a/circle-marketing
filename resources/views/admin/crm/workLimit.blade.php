@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <div class="content-body">
            <section class="card card-body modern-horizontal-wizard">
                <div class=" wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">
                        <form class="form" id="user_form" method="post" action="{{ route('crmWorkLimit') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="text-center">CRM Daily Work Limit</h2>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <input type="hidden" name="id" value="{{ $workLimit->id }}">
                                            <tr>
                                                <td>Bandwidth Limit</td>
                                                <td><input type="number" name="blimit" value="{{ $workLimit->blimit }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MAC Limit</td>
                                                <td><input type="number" name="mlimit" value="{{ $workLimit->mlimit }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Corporate Limit</td>
                                                <td><input type="number" name="climit" value="{{ $workLimit->climit }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Local Limit</td>
                                                <td><input type="number" name="llimit" value="{{ $workLimit->llimit }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="submit" value="Submit"
                                                        class="ml-5 btn btn-primary pull-right" style="width:150px">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/forms/select/select2.min.css">
@endsection
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/forms/form-wizard.css">
@endsection
@push('style')

@endpush
@section('vendor-js')
@endsection
@section('page-js')
    <script src="{{ asset('') }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
@push('script')

@endpush
