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
                        <a href="{{route('customerDetailEdit', $customer_order_info->order_id)}}" class="step-trigger">
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
                        <a href="{{route('docEdit', $customer_order_info->order_id)}}" class="step-trigger">
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
                    <div class="step">
                        <a href="{{route('orderEdit', $customer_order_info->order_id)}}" class="step-trigger">
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
                    <div class="step active">
                        <a href="{{route('orderDetailEdit')}}" class="step-trigger">
                            <span class="bs-stepper-box">4</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Order Details </span>
                                <span class="bs-stepper-subtitle">Add Order Details</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <form method="post" action="{{route('orderDetailUpdate',$customer_order_info->order_id)}}">
                        @csrf
                        @method('put')
                        <div class="content-header">
                            <h5 class="mb-0">Order Details</h5>
                            <small class="text-muted">Enter Your Order Details.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <th colspan="3" class="text-center">Pricing/Capacity</th>
                                            </tr>
                                            <tr>
                                                <td style="width:200px;"></td>
                                                <td>Capacity</td>

                                                <td>Price</td>
                                            </tr>
                                            <tr>
                                                <td>Internet</td>
                                                <td style="width:200px"><input type="number" value="{{$customer_order_info->internet_capacity_1}}" name="internet_capacity_1" min="0" class="form-control"></td>

                                                <td><input type="number" step=".01" value="{{$customer_order_info->internet_price_1}}" name="internet_price_1" min="0" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>BDIX</td>
                                                <td><input type="number" value="{{$customer_order_info->bdix_capacity_1}}" name="bdix_capacity_1" min="0" class="form-control"></td>

                                                <td><input type="number" step=".01" value="{{$customer_order_info->bdix_price_1}}" name="bdix_price_1" min="0" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>It Service 1</td>
                                                <td><input type="number" value="{{$customer_order_info->youtube_capacity_1}}" name="youtube_capacity_1" min="0" class="form-control"></td>

                                                <td><input type="number" step=".01" value="{{$customer_order_info->youtube_price_1}}" name="youtube_price_1" min="0" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>It Service 2</td>
                                                <td><input type="number" value="{{$customer_order_info->facebook_capacity_1}}" name="facebook_capacity_1" min="0" class="form-control"></td>

                                                <td><input type="number" step=".01" value="{{$customer_order_info->facebook_price_1}}" name="facebook_price_1" min="0" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>Data</td>
                                                <td><input type="number" value="{{$customer_order_info->data_capacity_1}}" name="data_capacity_1" min="0" class="form-control"></td>

                                                <td><input type="number" step=".01" value="{{$customer_order_info->data_price_1}}" name="data_price_1" min="0" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Price</td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="total_price" min="0" class="form-control" value="{{$customer_order_info->order->total_Price}}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                         <tr>
                                                <td>Core Rent</td>
                                                <td colspan="2"><input type="number" name="core_rent" min="0" class="form-control" value="{{$customer_order_info->order->core_rent}}"></td>
                                            </tr>
                                            <tr>
                                                <td>OTC</td>
                                                <td colspan="2"><input type="number" step=".01" name="otc" min="0" class="form-control" value="{{$customer_order_info->order->otc}}"></td>
                                            </tr>
                                            <tr>
                                                <td>Real IP</td>
                                                <td colspan="2"><input type="text" name="real_ip" class="form-control" value="{{$customer_order_info->order->real_ip}}"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <a href="{{route('orderEdit', $customer_order_info->order_id)}}" class="btn btn-primary btn-prev waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle mr-sm-25 mr-0">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </a>
                            <button class="btn btn-success btn-submit waves-effect waves-float waves-light">Submit</button>
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