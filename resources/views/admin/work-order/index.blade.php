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
                            <li class="breadcrumb-item active">Work Order List
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
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        <a class="dropdown-item" href="{{route('work-order.create')}}"><svg xmlns="#" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">Add Work Order</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="box ml-2 mr-2 mt-2">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label class="form-label" for="pincode2">Marketing Progress</label>
                                <select class="form-control form-control-sm" name="visit_type">
                                    <option value="">Select Option</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="pincode2">NOC Progress</label>
                                <select class="form-control form-control-sm" name="visit_type">
                                    <option value="">Select Option</option>
                                    <option value="done">Done</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="vertical-landmark">Org/Customer/ID</label>
                                <input type="text" name="scl_id" id="vertical-landmark" class="form-control form-control-sm" placeholder="Borough bridge" />
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="vertical-landmark">Link ID/SCL ID</label>
                                <input type="text" name="scl_id" id="vertical-landmark" class="form-control form-control-sm" placeholder="Borough bridge" />
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="pincode2">Submitted By</label>
                                <select class="form-control form-control-sm" name="visit_type">
                                    <option value="">Select Type</option>
                                    <option value="visited">Visited</option>
                                    <option value="phone">Phone</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="pincode2">Client Type</label>
                                <select class="form-control form-control-sm" name="visit_type">
                                    <option value="">Select</option>
                                    <option value="isp">ISP</option>
                                    <option value="corporate">Corporate</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="fp-range">Range</label>
                                <input type="text" id="fp-range" class="data-type form-control form-control-sm flatpickr-range flatpickr-input active" placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" style="margin-top:20px;" class="btn btn-info"><i class="fa fa-search"></i>Search</button>
                                <a style="margin-top:20px;" href="#" class="btn btn-primary"><i class="fa fa-refresh"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title">Work Order List</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr class="alert alert-dark">
                                    <th>Order Id</th>
                                    <th class="text-center">Action</th>
                                    <th>Approval</th>
                                    <th>Link ID &amp; <br> Approval Details</th>
                                    <th>Customer Details</th>
                                    <th>Bandwidth Requirement</th>
                                    <th>Connection Type</th>
                                    <th>Gmap Location</th>
                                    <th>Visited/Phone</th>
                                    <th>Billing Cycle Date</th>
                                    <th>Billing Details</th>
                                    <th>Create Date</th>
                                    <th>Update Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td class="text-center">
                                        <ul class="list-inline" style="width:120px">
                                            <li>
                                                <!--Marketing Executive section-->
                                                <a href="" class="btn btn-danger btn-xs btn-block"><i class="fa fa-remove"></i> Cancel Order</a>
                                                <a href="{{route('customerDetailEdit', $order->id)}}" class="btn btn-primary btn-xs btn-block"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="{{route('work-order-upgration', $order->id)}}" class="btn btn-primary  btn-block btn-xs"><i class="fa fa-edit"></i> Upgration</a>
                                                <a href="{{route('work-order-downgration', $order->id)}}" class="btn btn-info  btn-block btn-xs"><i class="fa fa-edit"></i> Downgration</a>

                                                <!--Marketing Admin section-->

                                                <!--Account Executive section-->
                                                <!--Account Admin section-->
                                                <div class="history">
                                                    <form action="" method="post">
                                                        <input type="hidden" value="666" name="history">
                                                        <button type="submit" class="btn btn-default btn-xs btn-block">H
                                                            (4) <i class="fa fa-history"></i></button>
                                                    </form>
                                                </div>
                                                <a href="" class="btn btn-primary  btn-block btn-xs"><i class="fa fa-table"></i> Invoice List
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="bg-gray">M A</td>
                                                    <td class="text-center mstatus666">
                                                        <p class="bg-gray btn-block">{{ $order->order_approval->m_approved_status ??'' }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">A A</td>
                                                    <td class="text-center acstatus666">
                                                        <p class="bg-gray btn-block">{{ $order->order_approval->a_approved_status ??'' }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">COO</td>
                                                    <td class="text-center coostatus666">
                                                        <p class="bg-gray btn-block text-center">{{ $order->order_approval->coo_approved_status ??'' }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">N A</td>
                                                    <td class="text-center nstatus666">
                                                        <p class="bg-gray btn-block">{{ $order->order_approval->noc_approved_status ??'' }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">NWS</td>
                                                    <td class="text-center nstatus666">
                                                        <p class="bg-gray btn-block">{{ $order->order_approval->noc_assigned_status ??'' }}</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-bordered bg-orange">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:12px;"><strong>Own/Nttn Type:</strong>{{$order->type}} </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:12px;"><strong>Price :</strong> {{$order->price}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:12px;"><strong>Link ID:</strong>  {{ $order->link_id??'' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:12px;"><strong>SCL ID:</strong>{{$order->scl_id}} </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="approvaltable approvaltable666">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" class="bg-gray text-center">Approval Details</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">M</td>
                                                    <td width="120px">Sub By: <strong>kawcher</strong></td>
                                                    <td>App By: mkawcher</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">N</td>
                                                    <td>Ass: <strong>sadek</strong></td>
                                                    <td>App By: <strong class="">abir</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">A</td>
                                                    <td>COO: <strong class="coostatus666">pending</strong></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-bordered bw_details cdetails">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td style="width:150px;white-space: normal">{{ $order->customer_details->customer->name??'' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Organization</td>
                                                    <td style="width:150px;white-space: normal;min-width:150px">{{ $order->customer_details->organization }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>{{ $order->customer_details->customer->email??'' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile</td>
                                                    <td>{{ $order->customer_details->customer->mobile??'' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Security<br>money</td>
                                                    <td>Bank Cheque :{{ $order->security_money_cheque??'' }}<br>Cash : {{ $order->security_money_cash??'' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>VAT</td>
                                                    <td>
                                                    {{ $order->vat??'' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a class="btn btn-primary btn-xs btn-flat btn-block" data-toggle="collapse" href="#c{{$order->id}}" role="button" aria-expanded="false" aria-controls="c{{$order->id}}">View Details</a>
                                        <div class="col">
                                            <div class="collapse multi-collapse" id="c{{$order->id}}">
                                                <div class="card card-body">
                                                    <table class="table table-bordered bw_details">
                                                        <tbody>
                                                            <tr>
                                                                <td>Location :</td>
                                                                <td>{{ $order->customer_details->division->name??'' }},{{ $order->customer_details->district->name??'' }},{{ $order->customer_details->upazila->name??'' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>TA</td>
                                                                <td>{{ $order->customer_details->technical_address??'' }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td>BA</td>
                                                                <td> {{ $order->customer_details->billing_address ??'' }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Work order:</td>
                                                                <td><a id="single_image" href="https://demo.circlenetworkbd.net/assets/uploads/customer/work_order3.JPG" data-lightbox="work_order3.JPG" class="text-center btn btn-primary btn-xs">View
                                                                        image</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>IP Agreement</td>
                                                                <td>
                                                                    <a id="single_image" href="https://demo.circlenetworkbd.net/assets/uploads/customer/ip_autorize5.jpg" data-lightbox="ip_autorize5.jpg" class="text-center btn btn-primary btn-xs">View
                                                                        image</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Authorization(Cor)</td>
                                                                <td>
                                                                    <a data-fancybox="" data-type="iframe" data-src="https://demo.circlenetworkbd.net/assets/uploads/customer/polly_it1.pdf" href="javascript:;" class="text-center btn btn-primary btn-xs">View
                                                                        Pdf</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>License Copy</td>
                                                                <td>
                                                                    <a id="single_image" href="https://demo.circlenetworkbd.net/assets/uploads/customer/linices9.jpg" data-lightbox="linices9.jpg" class="text-center btn btn-primary btn-xs">View
                                                                        image</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Trade License</td>
                                                                <td>
                                                                    <a id="single_image" href="https://demo.circlenetworkbd.net/assets/uploads/customer/Trade_License7.jpg" data-lightbox="Trade_License7.jpg" class="text-center btn btn-primary btn-xs">View
                                                                        image</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nid Copy</td>
                                                                <td>
                                                                    <a id="single_image" href="https://demo.circlenetworkbd.net/assets/uploads/customer/nid_final1.JPG" data-lightbox="nid_final1.JPG" class="text-center btn btn-primary btn-xs">View
                                                                        image</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-xs btn-flat btn-block collapsed" data-toggle="collapse" href="#m{{$order->id}}" role="button" aria-expanded="false" aria-controls="m{{$order->id}}">View Marketing</a>
                                        <div class="col">
                                            <div class="collapse multi-collapse" id="m{{$order->id}}">
                                                <div class="card card-body">
                                                    <button id="uphistory_666" type="button" class="uphistory btn btn-info btn-xs" data-toggle="modal" data-target="#uphistory">
                                                        <input type="hidden" value="666">View History
                                                    </button>
                                                    <table class="table table-bordered bw_details table-stripd">
                                                        <caption class="text-center">Marketing Requirement</caption>
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td>capacity</td>
                                                                <td>Buffer</td>
                                                                <td>UP</td>
                                                                <td>Down</td>
                                                                <td class=" onlym allhide">price</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Internet (1st)</td>
                                                                <td>{{ $order->order_info->internet_capacity_1??'' }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide">{{ $order->order_info->internet_price_1??'' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Internet(2nd)</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>BDIX(1st)</td>
                                                                <td>{{ $order->order_info->bdix_capacity_1??'' }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide">{{ $order->order_info->bdix_price_1??'' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>BDIX(2nd)</td>
                                                                <td>{{ $order->order_info->internet_price_2??'' }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide">{{ $order->order_info->internet_price_2??'' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>It Service 1 (1st)</td>
                                                                <td>{{ $order->order_info->youtube_capacity_1??'' }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide">{{ $order->order_info->youtube_price_1??'' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>It Service 1 (2st)</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>It Service 2(1st)</td>
                                                                <td>{{ $order->order_info->facebook_capacity_1??'' }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide">{{ $order->order_info->facebook_price_1??'' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>It Service 2(2nd)</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Data (1st)</td>
                                                                <td>{{ $order->order_info->data_capacity_1??'' }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide">{{ $order->order_info->data_price_1??'' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Data(2nd)</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right onlym allhide"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Domain</td>
                                                                <td colspan="4"></td>
                                                                <td class="text-right onlym allhide"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Hosting</td>
                                                                <td colspan="4"></td>
                                                                <td class="text-right onlym allhide"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5">Combine Price</td>
                                                                <td class="text-right allhide">{{ $order->total_Price }}</td>
                                                            </tr>
                                                            <tr class="onlym">
                                                                <td colspan="5">OTC</td>
                                                                <td class="text-right allhide">{{$order->otc}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5">Core Rent</td>
                                                                <td class="text-right allhide">{{$order->core_rent}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5">Real Ip</td>
                                                                <td class="text-right allhide">{{$order->real_ip}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="mhistory666">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a style="margin-top:10px" class="btn btn-primary btn-xs btn-flat btn-block" data-toggle="collapse" href="#n{{$order->id}}" role="button" aria-expanded="false" aria-controls="n{{$order->id}}">View NOC</a>
                                        <div class="col">
                                            <div class="collapse multi-collapse" id="n{{$order->id}}">
                                                <div class="card card-body">
                                                    <table class="table table-bordered bw_details">
                                                        <caption class="text-center">NOC Details</caption>
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td>Internet</td>
                                                                <td>GGC</td>
                                                                <td>FB</td>
                                                                <td>BDIX</td>
                                                                <td>DATA</td>

                                                            </tr>
                                                            <tr>
                                                                <td>VLAN</td>
                                                                <td>2841</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>IP</td>
                                                                <td>10.11.13.202/30</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Assigned BW</td>
                                                                <td>1100MB</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>3000MB</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Real IP</td>
                                                                <td colspan="5">{{$order->real_ip}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>MRTG/Cpanel</td>
                                                                <td colspan="3">
                                                                </td>
                                                                <td>USER: hkrup</td>
                                                                <td>PASSWORD: circle@hkrup</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                    </td>
                                    <td class="text-center">{{ $order->connect_type }}</td>
                                    <td class="text-center">{{ $order->gmap_location }}</td>
                                    <td class="text-center">{{ $order->visit_type }}</td>
                                    <td class="text-center">
                                        {{ $order->billing_cycle }}
                                        <hr>
                                        15tarik 50% 26tarik 50%
                                    </td>
                                    <td>
                                        <table class="billingtable">
                                            <tbody>
                                                <tr>
                                                    <td>Submission Date</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->order_submission_date)->format('j-M-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Bill Start Date</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->bill_start_date)->format('j-M-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-orange">Delivery Date</td>
                                                    <td class="bg-orange">{{ \Carbon\Carbon::parse($order->delivery_date)->format('j-M-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">NOC Delivered</td>
                                                    <td class="bg-gray">delivery_date</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">Bill Generate</td>
                                                    <td class="bg-gray">{{ $order->bill_generate_method }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-orange">UP/Down Delivery </td>
                                                    <td class="bg-orange">15-Jun-2021</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-gray">NOC UP Delivered</td>
                                                    <td class="bg-gray"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="text-center"> {{ \Carbon\Carbon::parse($order->created_at)->format('j-M-Y, g:i a')}}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($order->updated_at)->format('j-M-Y, g:i a')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>


@endsection
@section('vendor-css')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">


@endsection
@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-pickadate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/workOrder.css">
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
@endsection
@push('script')

@endpush