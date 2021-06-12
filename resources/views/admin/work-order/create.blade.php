@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Work Order</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Work Order Create
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Vertical Wizard -->
        <section class="vertical-wizard">
            <div class="bs-stepper vertical vertical-wizard-example">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#account-details-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">1</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Customer Details</span>
                                <span class="bs-stepper-subtitle">Setup Account Details</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#personal-info-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">2</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Customer Documents</span>
                                <span class="bs-stepper-subtitle">Add Customer Documents</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#address-step-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">3</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Order</span>
                                <span class="bs-stepper-subtitle">Add Order</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#social-links-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">4</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Social Links</span>
                                <span class="bs-stepper-subtitle">Add Social Links</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <div id="account-details-vertical" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Account Details</h5>
                            <small class="text-muted">Enter Your Account Details.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="organization">Organization</label>
                                <input type="text" id="organization" name="organization" class="form-control" placeholder="Enter Organization" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="client_type">Client Type</label>
                                <select class="select2 w-100" id="client_type">
                                    <option label=" "></option>
                                    <option value="isp">ISP</option>
                                    <option value="corporate">Corporate</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="technical-email">Technical Email</label>
                                <input type="email" id="technical-email" name="technical_email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="billing-email">Billing Email</label>
                                <input type="email" id="billing-email" name="billing_email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="mobile">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="01515664762" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="alt_mobile">Alter Mobile</label>
                                <input type="text" id="alt_mobile" name="alt_mobile" class="form-control" placeholder="01516664762" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="occupation">Occupation</label>
                                <input type="email" id="occupation" name="occupation" class="form-control" placeholder="Enter occupation" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="division">Division</label>
                                <select class="select2 w-100" id="division">
                                    <option label=" "></option>
                                    <option>UK</option>
                                    <option>USA</option>
                                    <option>Spain</option>
                                    <option>France</option>
                                    <option>Italy</option>
                                    <option>Australia</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="district">District</label>
                                <select class="select2 w-100" id="district">
                                    <option label=" "></option>
                                    <option>UK</option>
                                    <option>USA</option>
                                    <option>Spain</option>
                                    <option>France</option>
                                    <option>Italy</option>
                                    <option>Australia</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="upazila">Upazila</label>
                                <select class="select2 w-100" id="upazila">
                                    <option label=" "></option>
                                    <option>UK</option>
                                    <option>USA</option>
                                    <option>Spain</option>
                                    <option>France</option>
                                    <option>Italy</option>
                                    <option>Australia</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="technical-address">Technical Address</label>
                                <input type="text" id="technical-address" name="technical_address" class="form-control" placeholder="Technical Address" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="billing-address">Billing Address</label>
                                <input type="text" id="billing-address" name="billing_address" class="form-control" placeholder="Billing Address" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-prev" disabled>
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>
                    <div id="personal-info-vertical" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Personal Info</h5>
                            <small>Enter Your Personal Info.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-first-name">First Name</label>
                                <input type="text" id="vertical-first-name" class="form-control" placeholder="John" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-last-name">Last Name</label>
                                <input type="text" id="vertical-last-name" class="form-control" placeholder="Doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-country">Country</label>
                                <select class="select2 w-100" id="vertical-country">
                                    <option label=" "></option>
                                    <option>UK</option>
                                    <option>USA</option>
                                    <option>Spain</option>
                                    <option>France</option>
                                    <option>Italy</option>
                                    <option>Australia</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-language">Language</label>
                                <select class="select2 w-100" id="vertical-language" multiple>
                                    <option>English</option>
                                    <option>French</option>
                                    <option>Spanish</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>







                    <div id="address-step-vertical" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Order</h5>
                            <small>Enter Your Order.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-address">Type</label>
                                <input style="margin-left: 10%" type="radio" name="type" value="own"> Own
                                <input style="margin-left: 30%" type="radio" name="type" value="nttn"> NTTN
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-landmark">Scl Id</label>
                                <input type="text" name="scl_id" id="vertical-landmark" class="form-control" placeholder="Borough bridge" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Gmap Location</label>
                                <input type="text" name="gmap_location" id="pincode2" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city2">Connect Type</label>
                                <input type="text" id="city2" name="connect_type" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Link Id</label>
                                <input type="text" id="pincode2" name="link_id" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city2">Vat</label>
                                <input type="text" id="city2" name="vat" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Visit Type</label>
                                <select class="form-control" name="visit_type">
                                    <option value="">Select Type</option>
                                    <option value="visited">Visited</option>
                                    <option value="phone">Phone</option>
                                </select>
                                {{-- <input style="margin-left: 10%" type="radio" name="type" value="own"> Own
                                <input style="margin-left: 30%" type="radio" name="type" value="nttn"> NTTN --}}
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city2">Order Submission Date</label>
                                <input type="text" id="city2" name="order_submission_date" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Billing Cycle</label>
                                <input type="text" id="pincode2" name="billing_cycle" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city2">Billing Remark</label>
                                <input type="text" id="city2" name="billing_remark" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Bill Start Date</label>
                                <input type="text" id="pincode2" name="bill_start_date" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city2">Delivery Date</label>
                                <input type="text" id="city2" name="delivery_date" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Bill Generate Method</label>
                                <input type="text" id="pincode2" name="bill_generate_method" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city2">Total Price</label>
                                <input type="text" id="city2" name="total_Price" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Core Rent</label>
                                <input type="text" id="pincode2" name="core_rent" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city2">OTC</label>
                                <input type="text" id="city2" name="otc" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Real IP</label>
                                <input type="text" id="pincode2" name="real_ip" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Marketing User</label>
                                <input type="text" id="pincode2" name="marketing_user_id" class="form-control" placeholder="658921" />
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Accounts User</label>
                                <input type="text" id="pincode2" name="accounts_user_id" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Security Money Type</label>
                                <input type="text" id="pincode2" name="security_money_type" class="form-control" placeholder="658921" />
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Security Money Amount</label>
                                <input type="text" id="pincode2" name="security_money_amount" class="form-control" placeholder="658921" />
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">BIN</label>
                                <input type="text" id="pincode2" class="form-control" placeholder="658921" />
                            </div> --}}
                           
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>







                    <div id="social-links-vertical" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Social Links</h5>
                            <small>Enter Your Social Links.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-twitter">Twitter</label>
                                <input type="text" id="vertical-twitter" class="form-control" placeholder="https://twitter.com/abc" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-facebook">Facebook</label>
                                <input type="text" id="vertical-facebook" class="form-control" placeholder="https://facebook.com/abc" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-google">Google+</label>
                                <input type="text" id="vertical-google" class="form-control" placeholder="https://plus.google.com/abc" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-linkedin">Linkedin</label>
                                <input type="text" id="vertical-linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-success btn-submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Vertical Wizard -->
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
<script src="{{ asset('') }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
<script src="{{ asset('') }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{ asset('') }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page-js')
<script src="{{ asset('') }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
@push('script')

@endpush