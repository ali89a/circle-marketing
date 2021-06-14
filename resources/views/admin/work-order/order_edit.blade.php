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
                            <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
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
        <section class="modern-horizontal-wizard">
            <div class="bs-stepper wizard-modern modern-wizard-example">
                <div class="bs-stepper-header">
                    <div class="step">
                        <a href="{{route('customerDetailEdit', $customer_order->id)}}" class="step-trigger">
                            <span class="bs-stepper-box">1 </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Customer Details</span>
                                <span class="bs-stepper-subtitle">Setup Customer Details</span>
                            </span>
                        </a>
                    </div>
                    <div class="line">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                    <div class="step">
                        <a href="{{route('docEdit',$customer_order->id)}}" class="step-trigger">
                            <span class="bs-stepper-box">2</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Document Info</span>
                                <span class="bs-stepper-subtitle">Add Document Info</span>
                            </span>
                        </a>
                    </div>
                    <div class="line">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                    <div class="step active">
                        <a href="{{route('orderEdit',$customer_order->id)}}" class="step-trigger">
                            <span class="bs-stepper-box">3</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Order Info</span>
                                <span class="bs-stepper-subtitle">Add Order Info</span>
                            </span>
                        </a>
                    </div>
                    <div class="line">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                    <div class="step">
                        <a href="{{route('orderDetailEdit',$customer_order->id)}}" class="step-trigger">
                            <span class="bs-stepper-box">4</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Order Details </span>
                                <span class="bs-stepper-subtitle">Add Order Details</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <form method="post" action="{{route('work-order.update',$customer_order->id)}}">
                        @csrf
                        @method('put')
                        <div class="content-header">
                            <h5 class="mb-0">Order</h5>
                            <small>Enter Your Order.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="vertical-address">Type</label>
                                <input style="margin-left: 10%" type="radio" value="{{$customer_order->type}}" name="type" value="own"> Own
                                <input style="margin-left: 30%" type="radio" value="{{$customer_order->type}}" name="type" value="nttn"> NTTN
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="vertical-landmark">Scl Id</label>
                                <input type="text" value="{{$customer_order->scl_id}}" name="scl_id" id="vertical-landmark" class="form-control" placeholder="Borough bridge" />
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label" for="pincode2">Gmap Location</label>
                                <input type="text" value="{{$customer_order->gmap_location}}" name="gmap_location" id="pincode2" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="city2">Connect Type</label>
                                <input type="text" id="city2" value="{{$customer_order->connect_type}}" name="connect_type" class="form-control" placeholder="Birmingham" />
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label" for="pincode2">Link Id</label>
                                <input type="text" id="pincode2" value="{{$customer_order->link_id}}" name="link_id" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="city2">Vat</label>
                                <input type="text" id="city2" value="{{$customer_order->vat}}" name="vat" class="form-control" placeholder="Birmingham" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="visit_type">Visit Type</label>
                                <select class="form-control" name="visit_type">
                                    <option value="">Select Type</option>
                                    <option value="visited">Visited</option>
                                    <option value="phone">Phone</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="order_submission_date">Order Submission Date</label>
                                <input type="text" value="{{$customer_order->order_submission_date}}" name="order_submission_date" id="order_submission_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="billing_cycle">Billing Cycle</label>
                                <input type="text" id="billing_cycle" value="{{$customer_order->billing_cycle}}" name="billing_cycle" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="billing_remark">Billing Remark</label>
                                <input type="text" id="billing_remark" value="{{$customer_order->billing_remark}}" name="billing_remark" class="form-control" placeholder="Birmingham" />
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label" for="bill_start_date">Bill Start Date</label>
                                <input type="text" name="bill_start_date" value="{{$customer_order->bill_start_date}}" id="bill_start_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="delivery_date">Delivery Date</label>
                                <input type="text" name="delivery_date" value="{{$customer_order->delivery_date}}" id="delivery_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label" for="bill_generate_method">Bill Generate Method</label>
                                <input type="text" id="bill_generate_method" value="{{$customer_order->bill_generate_method}}" name="bill_generate_method" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="total_Price">Total Price</label>
                                <input type="text" id="total_Price" value="{{$customer_order->total_Price}}" name="total_Price" class="form-control" placeholder="Birmingham" />
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label" for="core_rent">Core Rent</label>
                                <input type="text" id="core_rent" value="{{$customer_order->core_rent}}" name="core_rent" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="city2">OTC</label>
                                <input type="text" id="city2" value="{{$customer_order->otc}}" name="otc" class="form-control" placeholder="Birmingham" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="otc">Real IP</label>
                                <input type="text" id="otc" value="{{$customer_order->real_ip}}" name="real_ip" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="marketing_user_id">Marketing User</label>
                                <input type="text" id="marketing_user_id" value="{{$customer_order->marketing_user_id}}" name="marketing_user_id" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="customers_user_id">customers User</label>
                                <input type="text" id="customers_user_id" value="{{$customer_order->customers_user_id}}" name="customers_user_id" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="security_money_type">Security Money Type</label>
                                <input type="text" id="security_money_type" value="{{$customer_order->security_money_type}}" name="security_money_type" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="security_money_amount">Security Money Amount</label>
                                <input type="text" id="security_money_amount" value="{{$customer_order->security_money_amount}}" name="security_money_amount" class="form-control" placeholder="658921" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle mr-sm-25 mr-0">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next waves-effect waves-float waves-light">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ml-sm-25 ml-0">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
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
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/forms/select/select2.min.css">
@endsection
@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-pickadate.css">

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
<script src="{{ asset('') }}app-assets/js/scripts/forms/form-wizard.js"></script>

@endsection
@push('script')

@endpush