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
                    <div class="dropdown-menu dropdown-menu-right">

                        <a class="dropdown-item" href="{{route('work-order.index')}}"><svg xmlns="#" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">Work Order</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">

        <section class="modern-horizontal-wizard">
            <div class="bs-stepper wizard-modern modern-wizard-example">
                <div class="bs-stepper-header">
                    <div class="step active">
                        <a href="{{url('#')}}" class="step-trigger">
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
                        <a href="" class="step-trigger">
                            <span class="bs-stepper-box">2</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Document Info</span>
                                <span class="bs-stepper-subtitle">Add Document Info</span>
                            </span>
                        </a>
                    </div>
                    <div class="step">
                        <a href="" class="step-trigger">
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
                        <a href="" class="step-trigger">
                            <span class="bs-stepper-box">4</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Order Details </span>
                                <span class="bs-stepper-subtitle">Add Order Details</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="bs-stepper-content">

                    <form method="post" action="{{route('work-order.store')}}">
                        @csrf
                        <div class="content-header">
                            <h5 class="mb-0">Customer Details</h5>
                        </div>
                        <hr style="border: 1px solid">
                        <div class="row justify-content-center">
                            <div class="form-group col-sm-4">
                                <label for="customer_id">Customer</label>
                                <select class="form-control form-control-sm" id="customer_id" name="customer_id" required>
                                    <option value="">Select One</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="organization">Organization</label>
                                <input type="text" id="organization" name="organization" class="form-control form-control-sm" placeholder="Enter Organization" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="client_type">Client Type</label>
                                <select class="form-control form-control-sm" id="client_type" name="client_type">
                                    <option label="">Select One</option>
                                    <option value="isp">ISP</option>
                                    <option value="corporate">Corporate</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="technical-email">Technical Email</label>
                                <input type="email" id="technical-email" name="technical_email" class="form-control form-control-sm" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="billing-email">Billing Email</label>
                                <input type="email" id="billing-email" name="billing_email" class="form-control form-control-sm" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="mobile">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control form-control-sm" placeholder="01515664762" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="alter_mobile">Alter Mobile</label>
                                <input type="text" id="alter_mobile" name="alter_mobile" class="form-control form-control-sm" placeholder="01516664762" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="occupation">Occupation</label>
                                <input type="text" id="occupation" name="occupation" class="form-control form-control-sm" placeholder="Enter occupation" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="technical-address">Technical Address</label>
                                <input type="text" id="technical-address" name="technical_address" class="form-control form-control-sm" placeholder="Technical Address" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="billing-address">Billing Address</label>
                                <input type="text" id="billing-address" name="billing_address" class="form-control form-control-sm" placeholder="Billing Address" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="division_id">Division</label>
                                <select class="form-control form-control-sm" id="division_id" name="division_id">
                                    <option value="">Select One</option>
                                    @foreach($divisions as $list)
                                    <option value="{{ $list->id }}"> {{ $list->name }}({{ $list->bn_name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="basicSelect">District</label>
                                <select class="form-control form-control-sm" id="district_id" name="district_id">

                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="basicSelect">Upazila</label>
                                <select class="form-control form-control-sm" id="upazila_id" name="upazila_id">
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-prev waves-effect" disabled="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle mr-sm-25 mr-0">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button type="submit" class="btn btn-primary btn-next waves-effect waves-float waves-light">
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

<script>
    $('document').ready(function() {
        $('#division_id').change(function() {
            var id = $('#division_id').val();
            $.ajax({
                url: '{{url('admin/fetch-district')}}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                  console.log(data);
                    $('#district_id').html(data);
                }
            });
        });

        $('#district_id').change(function() {
            var id = $('#district_id').val();
            $.ajax({
                url: '{{url('admin/fetch-thana')}}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#upazila_id').html(data);
                }
            });
        });

    });
</script>


@endpush