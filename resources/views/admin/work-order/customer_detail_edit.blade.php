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
                    <div class="step active">
                        <a href="{{route('customerDetailEdit', $order_customer_info->order_id)}}" class="step-trigger">
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
                        <a href="{{route('docEdit', $order_customer_info->order_id)}}" class="step-trigger">
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
                        <a href="{{route('orderEdit', $order_customer_info->order_id)}}" class="step-trigger">
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
                        <a href="{{route('orderDetailEdit', $order_customer_info->order_id)}}" class="step-trigger">
                            <span class="bs-stepper-box">4</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Order Details </span>
                                <span class="bs-stepper-subtitle">Add Order Details</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="bs-stepper-content" id="vue_app">
                    <form method="post" action="{{route('customerDetailUpdate',$order_customer_info->order_id)}}">
                        @csrf
                        @method('put')
                        <div class="content-header">
                            <h5 class="mb-0">Customer Details</h5>
                        </div>
                        <hr style="border: 1px solid">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="organization">Organization</label>
                                <input type="text" id="organization" value="{{$order_customer_info->organization}}" name="organization" class="form-control form-control-sm" placeholder="Enter Organization" />
                                <input type="hidden" id="customer_id" value="{{$order_customer_info->customer_id}}" name="customer_id">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="basicSelect">Client Type</label>
                                <select class="form-control form-control-sm" id="client_type" name="client_type">
                                    <option label="">Select One</option>
                                    <option value="isp" {{ $order_customer_info->client_type == 'isp' ? 'selected' : '' }}>ISP</option>
                                    <option value="corporate" {{ $order_customer_info->client_type == 'corporate' ? 'selected' : '' }}>Corporate</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="technical-email">Technical Email</label>
                                <input type="email" id="technical-email" name="technical_email" value="{{$order_customer_info->technical_email}}" class="form-control form-control-sm" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="billing-email">Billing Email</label>
                                <input type="email" id="billing-email" name="billing_email" value="{{$order_customer_info->billing_email}}" class="form-control form-control-sm" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="mobile">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control form-control-sm" value="{{$order_customer_info->mobile}}" placeholder="01515664762" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="alter_mobile">Alter Mobile</label>
                                <input type="text" id="alter_mobile" name="alter_mobile" value="{{$order_customer_info->alter_mobile}}" class="form-control form-control-sm" placeholder="01516664762" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="occupation">Occupation</label>
                                <input type="text" id="occupation" name="occupation" value="{{$order_customer_info->occupation}}" class="form-control form-control-sm" placeholder="Enter occupation" aria-label="john.doe" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="technical-address">Technical Address</label>
                                <input type="text" id="technical-address" name="technical_address" value="{{$order_customer_info->technical_address}}" class="form-control form-control-sm" placeholder="Technical Address" />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="billing-address">Billing Address</label>
                                <input type="text" id="billing-address" name="billing_address" value="{{$order_customer_info->billing_address}}" class="form-control form-control-sm" placeholder="Billing Address" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="division_id">Division</label>
                                <select class="form-control form-control-sm" id="division_id" name="division_id" v-model="division_id" @change="fetch_district()">
                                    <option value="">Select One</option>
                                    @foreach($divisions as $list)
                                    <option value="{{ $list->id }}" {{ $list->id == $order_customer_info->division_id ? 'selected' : '' }}> {{ $list->name }}({{ $list->bn_name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="district_id">District</label>

                                <select class="form-control form-control-sm" name="district_id" id="district_id" class="form-control" v-model="district_id" @change="fetch_upazila()">
                                    <option value="">Select one</option>
                                    <option :value="row.id" v-for="row in districts" v-html="row.name">
                                    </option>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="upazila_id">Upazila</label>
                                <select class="form-control form-control-sm" name="upazila_id" id="upazila_id" class="form-control" v-model="upazila_id">
                                    <option value="">Select one</option>
                                    <option :value="row.id" v-for="row in upazilas" v-html="row.name">
                                    </option>
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
<script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
<script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('vue-js/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script>
    //  console.log('error');
    $(document).ready(function() {
        var vue = new Vue({
            el: '#vue_app',
            data: {
                config: {
                    get_district_url: "{{ url('admin/fetch-district-by-division-id') }}",
                    get_upazila_url: "{{ url('admin/fetch-upazila-by-district-id') }}",
                },
                division_id: '{{$order_customer_info->division_id}}',
                district_id: '{{$order_customer_info->district_id}}',
                upazila_id: '{{$order_customer_info->upazila_id}}',
                districts: [],
                upazilas: [],
                order_id: "{{$order_customer_info->order_id}}",
            },
            methods: {
                fetch_district() {
                    var vm = this;
                    var slug = vm.division_id;
                    if (slug) {
                        axios.get(this.config.get_district_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                vm.districts = details.districts;

                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                fetch_upazila() {
                    var vm = this;
                    var slug = vm.district_id;
                    if (slug) {
                        axios.get(this.config.get_upazila_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                vm.upazilas = details.upazilas;

                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                delete_row: function(row) {
                    this.services.splice(this.services.indexOf(row), 1);
                },
            },
            beforeMount() {
                this.fetch_district();
                this.fetch_upazila();
                
            },
            updated() {
                $('.bSelect').selectpicker('refresh');
            }
        });
        $('.bSelect').selectpicker({
            liveSearch: true,
            size: 5
        });
    });
</script>



@endpush