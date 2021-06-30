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
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Upgration
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('user.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Upgration Create</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('orderUpgrationUpdate',$customer_order_info->order_id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-7" id="vue_app">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="5">
                                                            <div class="form-group">
                                                                <input type="hidden" name="order_id" value="{{ $customer_order_info->order_id }}" class="form-control input-sm">
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
                                                        <td>Upgrade</td>
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
                                                            <input type="number" v-model="row.upgration" :name="'items['+index+'][upgration]'" class="form-control input-sm" required>
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
                                                        <td colspan="4">
                                                            <input type="number" step=".01" name="total_price" min="0" class="form-control" value="{{$customer_order_info->order->total_Price}}">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>Link ID:</td>
                                                        <td>{{$customer_order_info->order->link_id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Location: </td>
                                                        <td> {{ $customer_order_info->order->customer_details->upazila->name??'' }},{{ $customer_order_info->order->customer_details->district->name??'' }}, {{ $customer_order_info->order->customer_details->division->name??'' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Connection Type:</td>
                                                        <td>{{$customer_order_info->order->connect_type}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Security Money:</td>
                                                        <td>0,0,,0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Visited/Phone:</td>
                                                        <td> {{$customer_order_info->order->visit_type}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order Submission Date</td>
                                                        <td> {{$customer_order_info->order->order_submission_date}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Billing Date:</td>
                                                        <td> {{$customer_order_info->order->billing_cycle}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bill Start Date:</td>
                                                        <td> {{$customer_order_info->order->bill_start_date}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Date:</td>
                                                        <td> {{$customer_order_info->order->delivery_date}} </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Upgradation Delivery Date:</td>
                                                        <td>
                                                            <input type="text" name="upgrade_delivery_date" id="upgrade_delivery_date" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td>Billing by</td>
                                                        <td>
                                                            <div class="form-group">

                                                                <select class="form-control" name="bill_generate_method">
                                                                    <option value="">Select Date</option>
                                                                    <option value="by_marketing_date" {{ $customer_order_info->order->bill_generate_method == 'by_marketing_date' ? 'selected' : '' }}>by_marketing_date</option>
                                                                    <option value="by_noc_done" {{ $customer_order_info->order->bill_generate_method == 'by_noc_done' ? 'selected' : '' }}>by_noc_done</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light mt-2 float-right" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
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