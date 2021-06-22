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
                        <hr>
                        <div class="row" id="vue_app">
                            <div class="form-group col-md-4">
                                <label class="form-label" for="type">Type</label>
                                <div class="demo-inline-spacing">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="type" @change="onChange($event)" class="custom-control-input" value="Own" {{ $customer_order->type == "Own" ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customRadio1">Own</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="type" @change="onChange($event)" class="custom-control-input" value="NTTN" {{ $customer_order->type == "NTTN" ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customRadio2">NTTN</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4" v-if="own_price">
                                <label class="form-label" for="price">Price</label>
                                <input type="text" value="{{$customer_order->price??'400'}}" name="price" id="price" class="form-control">
                            </div>
                            <div class="form-group col-md-4" v-if="nttn_price">
                                <label class="form-label" for="price">Price</label>
                                <input type="text" value="{{$customer_order->price??'800'}}" name="price" id="price" class="form-control">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="details"></div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td> <label class="form-label" for="scl_id">Scl Id</label></td>
                                            <td>
                                                <input type="text" value="{{$customer_order->scl_id}}" name="scl_id" id="scl_id" class="form-control" placeholder="SCL ID" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="gmap_location">Gmap Location</label></td>
                                            <td>
                                                <input type="text" value="{{$customer_order->gmap_location}}" name="gmap_location" id="gmap_location" class="form-control" placeholder="GMAP Location" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="connect_type">Connect Type</label></td>
                                            <td>
                                                <select class="form-control" name="connect_type">
                                                    <option value="">Select Type</option>
                                                    <option value="Fiber" {{ $customer_order->connect_type == "Fiber" ? 'selected' : '' }}>Fiber</option>
                                                    <option value="Hostpot" {{ $customer_order->connect_type == "Hostpot" ? 'selected' : '' }}>Hostpot</option>
                                                    <option value="Radio" {{ $customer_order->connect_type == "Radio" ? 'selected' : '' }}>Radio</option>
                                                    <option value="Fiber & Radio" {{ $customer_order->connect_type == "Fiber & Radio" ? 'selected' : '' }}>Fiber & Radio</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="connect_type">Vat</label></td>
                                            <td>
                                                <input type="text" id="Vat" value="{{$customer_order->vat}}" name="vat" class="form-control" placeholder="Vat" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="visit_type">Visit Type</label></td>
                                            <td>
                                                <select class="form-control" name="visit_type">
                                                    <option value="">Select Type</option>
                                                    <option value="visited" {{ $customer_order->visit_type == "visited" ? 'selected' : '' }}>Visited</option>
                                                    <option value="phone" {{ $customer_order->visit_type == "phone" ? 'selected' : '' }}>Phone</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="order_submission_date">Order Submission Date</label></td>
                                            <td>
                                                <input type="text" value="{{$customer_order->order_submission_date}}" name="order_submission_date" id="order_submission_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="billing_cycle">Billing Date/Cycle</label></td>
                                            <td>
                                                <select class="form-control" name="billing_cycle">
                                                    <option value="">Select Date</option>
                                                    @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{ $i == $customer_order->billing_cycle ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="bill_start_date">Bill Start Date</label></td>
                                            <td>
                                                <input type="text" name="bill_start_date" value="{{$customer_order->bill_start_date}}" id="bill_start_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="delivery_date">Delivery Date</label></td>
                                            <td>
                                                <input type="text" name="delivery_date" value="{{$customer_order->delivery_date}}" id="delivery_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="bill_generate_method">Bill Generate Method</label></td>
                                            <td>
                                                <select class="form-control" name="bill_generate_method">
                                                    <option value="">Select Date</option>
                                                    <option value="by_marketing_date" {{ $customer_order->bill_generate_method == 'by_marketing_date' ? 'selected' : '' }}>by_marketing_date</option>
                                                    <option value="by_noc_done" {{ $customer_order->bill_generate_method == 'by_noc_done' ? 'selected' : '' }}>by_noc_done</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="security_money_cheque">Security Money Cheque</label></td>
                                            <td>
                                                <input type="text" id="security_money_cheque" value="{{$customer_order->security_money_cheque}}" name="security_money_cheque" class="form-control" placeholder="658921" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="security_money_cash">Security Money Cash</label></td>
                                            <td>
                                                <input type="text" id="security_money_cash" value="{{$customer_order->security_money_cash}}" name="security_money_cash" class="form-control" placeholder="658921" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="billing_remark">Billing Remark</label></td>
                                            <td>

                                                <textarea class="form-control" name="billing_remark" rows="1">{{$customer_order->billing_remark}}</textarea>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="details"></div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td> <label class="form-label" for="scl_id">Scl Id</label></td>
                                            <td>
                                                <input type="text" value="{{$customer_order->scl_id}}" name="scl_id" id="scl_id" class="form-control" placeholder="SCL ID" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="gmap_location">Gmap Location</label></td>
                                            <td>
                                                <input type="text" value="{{$customer_order->gmap_location}}" name="gmap_location" id="gmap_location" class="form-control" placeholder="GMAP Location" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="connect_type">Connect Type</label></td>
                                            <td>
                                                <select class="form-control" name="connect_type">
                                                    <option value="">Select Type</option>
                                                    <option value="Fiber" {{ $customer_order->connect_type == "Fiber" ? 'selected' : '' }}>Fiber</option>
                                                    <option value="Hostpot" {{ $customer_order->connect_type == "Hostpot" ? 'selected' : '' }}>Hostpot</option>
                                                    <option value="Radio" {{ $customer_order->connect_type == "Radio" ? 'selected' : '' }}>Radio</option>
                                                    <option value="Fiber & Radio" {{ $customer_order->connect_type == "Fiber & Radio" ? 'selected' : '' }}>Fiber & Radio</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="connect_type">Vat</label></td>
                                            <td>
                                                <input type="text" id="Vat" value="{{$customer_order->vat}}" name="vat" class="form-control" placeholder="Vat" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="visit_type">Visit Type</label></td>
                                            <td>
                                                <select class="form-control" name="visit_type">
                                                    <option value="">Select Type</option>
                                                    <option value="visited" {{ $customer_order->visit_type == "visited" ? 'selected' : '' }}>Visited</option>
                                                    <option value="phone" {{ $customer_order->visit_type == "phone" ? 'selected' : '' }}>Phone</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="order_submission_date">Order Submission Date</label></td>
                                            <td>
                                                <input type="text" value="{{$customer_order->order_submission_date}}" name="order_submission_date" id="order_submission_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="billing_cycle">Billing Date/Cycle</label></td>
                                            <td>
                                                <select class="form-control" name="billing_cycle">
                                                    <option value="">Select Date</option>
                                                    @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{ $i == $customer_order->billing_cycle ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="bill_start_date">Bill Start Date</label></td>
                                            <td>
                                                <input type="text" name="bill_start_date" value="{{$customer_order->bill_start_date}}" id="bill_start_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="delivery_date">Delivery Date</label></td>
                                            <td>
                                                <input type="text" name="delivery_date" value="{{$customer_order->delivery_date}}" id="delivery_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="bill_generate_method">Bill Generate Method</label></td>
                                            <td>
                                                <select class="form-control" name="bill_generate_method">
                                                    <option value="">Select Date</option>
                                                    <option value="by_marketing_date" {{ $customer_order->bill_generate_method == 'by_marketing_date' ? 'selected' : '' }}>by_marketing_date</option>
                                                    <option value="by_noc_done" {{ $customer_order->bill_generate_method == 'by_noc_done' ? 'selected' : '' }}>by_noc_done</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="security_money_cheque">Security Money Cheque</label></td>
                                            <td>
                                                <input type="text" id="security_money_cheque" value="{{$customer_order->security_money_cheque}}" name="security_money_cheque" class="form-control" placeholder="658921" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="security_money_cash">Security Money Cash</label></td>
                                            <td>
                                                <input type="text" id="security_money_cash" value="{{$customer_order->security_money_cash}}" name="security_money_cash" class="form-control" placeholder="658921" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label class="form-label" for="billing_remark">Billing Remark</label></td>
                                            <td>

                                                <textarea class="form-control" name="billing_remark" rows="1">{{$customer_order->billing_remark}}</textarea>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{route('docEdit', $customer_order->id)}}" class="btn btn-primary btn-prev waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle mr-sm-25 mr-0">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </a>
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
                    get_url: "",

                },

                type: '',
                own_price: false,
                nttn_price: false,


            },
            methods: {
                onChange(event) {
                    var vm = this;
                    var service_type = event.target.value;
                    console.log(service_type);
                    if (service_type === 'Own') {
                        vm.own_price = true;
                        vm.nttn_price = false;

                    }
                    if (service_type === 'NTTN') {
                        vm.own_price = false;
                        vm.nttn_price = true;
                    }
                },
                fetch_service() {
                    var vm = this;
                    var slug = vm.type;
                    //check
                    // alert(slug);

                    if (slug) {
                        axios.get(this.config.get_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                if (!vm.services.some(data => data.service_id === details.id)) {
                                    vm.services.push({
                                        service_id: details.id,
                                        name: details.name,
                                    });
                                    vm.service_id = '';
                                } else {
                                    toastr.info('Already Selected This Item', {
                                        closeButton: true,
                                        progressBar: true,
                                    });

                                    return false;
                                }


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

                load_old() {
                    var vm = this;
                    var slug = vm.order_id;
                    axios.get(this.config.get_old_items_data + '/' + slug).then(function(response) {
                        var item = response.data;
                        console.log(item);
                        for (key in item) {
                            vm.services.push(item[key]);
                        };

                    })
                },
            },
            beforeMount() {
                this.load_old();
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