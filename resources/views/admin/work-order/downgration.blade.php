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
                            <li class="breadcrumb-item active">Downgration
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
                            <h4 class="card-title">Downgration Create</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="#" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-7">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th colspan="4" class="text-center">Pricing/Capacity</th>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:200px;"></td>
                                                        <td>Capacity</td>
                                                        <td>Downgrate</td>

                                                        <td>Price</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Internet</td>
                                                        <td style="width:200px"><input type="number" value="{{$customer_order_info->internet_capacity_1}}" name="internet_capacity_1" min="0" class="form-control"></td>
                                                        <td style="width:200px"><input type="number" value="" name="internet_capacity_1" min="0" class="form-control"></td>

                                                        <td><input type="number" step=".01" value="{{$customer_order_info->internet_price_1}}" name="internet_price_1" min="0" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BDIX</td>
                                                        <td><input type="number" value="{{$customer_order_info->bdix_capacity_1}}" name="bdix_capacity_1" min="0" class="form-control"></td>
                                                        <td><input type="number" value="" name="bdix_capacity_1" min="0" class="form-control"></td>

                                                        <td><input type="number" step=".01" value="{{$customer_order_info->bdix_price_1}}" name="bdix_price_1" min="0" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>It Service 1</td>
                                                        <td><input type="number" value="{{$customer_order_info->youtube_capacity_1}}" name="youtube_capacity_1" min="0" class="form-control"></td>
                                                        <td><input type="number" value="" name="youtube_capacity_1" min="0" class="form-control"></td>

                                                        <td><input type="number" step=".01" value="{{$customer_order_info->youtube_price_1}}" name="youtube_price_1" min="0" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>It Service 2</td>
                                                        <td><input type="number" value="{{$customer_order_info->facebook_capacity_1}}" name="facebook_capacity_1" min="0" class="form-control"></td>
                                                        <td><input type="number" value="" name="facebook_capacity_1" min="0" class="form-control"></td>

                                                        <td><input type="number" step=".01" value="{{$customer_order_info->facebook_price_1}}" name="facebook_price_1" min="0" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Data</td>
                                                        <td><input type="number" value="{{$customer_order_info->data_capacity_1}}" name="data_capacity_1" min="0" class="form-control"></td>
                                                        <td><input type="number" value="" name="data_capacity_1" min="0" class="form-control"></td>

                                                        <td><input type="number" step=".01" value="{{$customer_order_info->data_price_1}}" name="data_price_1" min="0" class="form-control"></td>
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
                                                        <td><input type="text" class="datepicker" name="upgrade_delivery_date" required=""></td>
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
@section('css')

@endsection
@section('js')

@endsection
@push('script')

@endpush