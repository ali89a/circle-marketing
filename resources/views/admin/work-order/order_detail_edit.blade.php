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
                        <div class="row" id="vue_app">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="service_id">Service Type</label>
                                                        <select class="form-control" @change="fetch_service()" id="service_id" name="service_id" v-model="service_id">
                                                            <option value="">Select Type</option>
                                                            @foreach($all_service as $service)
                                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width:200px">Service</th>
                                                <th>Capacity</th>
                                                <th>Price</th>
                                                <th></th>
                                            </tr>
                                            <tr v-for="(row, index) in services">
                                                <td v-html="row.name"></td>
                                                <td>
                                                    <input type="hidden" :name="'items['+index+'][service_id]'" class="form-control input-sm" v-bind:value="row.service_id">
                                                    <input type="number" v-model="row.capacity" :name="'items['+index+'][capacity]'" class="form-control input-sm" required>
                                                </td>
                                                <td>
                                                    <input type="number" v-model="row.price" :name="'items['+index+'][price]'" class="form-control input-sm" required>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" @click="delete_row(row)">x</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Price</td>
                                                <td colspan="3">
                                                    <input type="number" step=".01" name="total_price" min="0" class="form-control" value="{{$customer_order_info->order->total_Price}}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Real IP:</td>
                                            <td><input type="text" name="real_ip" class="form-control form-control-sm" value="{{$customer_order_info->order->real_ip}}"></td>
                                        </tr>
                                        <tr>
                                            <td>Core Rent:</td>
                                            <td><input type="text" name="core_rent" class="form-control form-control-sm" value="{{$customer_order_info->order->core_rent}}"></td>
                                        </tr>
                                        <tr>
                                            <td>OTC</td>
                                            <td><input type="text" name="otc" class="form-control form-control-sm" value="{{$customer_order_info->order->otc}}"></td>
                                        </tr>
                                    </tbody>
                                </table>
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
                    get_url: "{{ url('admin/fetch-service-by-id') }}",
                    get_old_items_data: "{{ url('admin/fetch-general-product-info') }}",
                },

                service_id: '',
                services: [],
                order_id: "{{$customer_order_info->order_id}}",
            },
            methods: {
                fetch_service() {
                    var vm = this;
                    var slug = vm.service_id;
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