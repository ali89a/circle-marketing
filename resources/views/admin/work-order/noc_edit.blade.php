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
                            <li class="breadcrumb-item active">NOC
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
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Marketing</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered bw_details table-stripd">
                                    <caption class="text-center">Marketing Requirement</caption>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>capacity</td>
                                            <td>Buffer</td>
                                            <td>UP</td>
                                            <td>Down</td>
                                            @can('price-show')
                                            <td class=" onlym allhide">price</td>
                                            @endcan
                                        </tr>
                                        @foreach($order->order_items as $item)
                                        <tr>
                                            <td>{{ $item->service->name??'' }}</td>
                                            <td>{{ $item->capacity??'' }}</td>
                                            <td>{{ $item->buffer??'' }}</td>
                                            <td>{{ $item->upgration??'' }}</td>
                                            <td>{{ $item->downgration??'' }}</td>
                                            @can('price-show')
                                            <td class="text-right onlym allhide">{{ $item->price??'' }}</td>
                                            @endcan
                                        </tr>
                                        @endforeach
                                        @can('price-show')
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
                                        @endcan
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
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


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">NOC Update</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('nocUpdate',$order_noc->order_id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th></th>
                                                        <th>VLAN</th>
                                                        <th>IP</th>
                                                        <th>Assigned BW</th>
                                                    </tr>
                                                    @foreach($order->order_items as $key=>$row)
                                                    <tr>
                                                        <th>{{ $row->service->name }}<input type="hidden" value="{{$row->service->id}}" name="noc_items[{{$key}}][service_id]" class="form-control">
                                                        </th>
                                                        <td><input type="text" value="{{$item->vlan}}" name="noc_items[{{$key}}][vlan]" class="form-control"></td>
                                                        <td><input type="text" value="{{$item->ip}}" name="noc_items[{{$key}}][ip]" class="form-control"></td>
                                                        <td><input type="text" value="{{$item->assigned_brandwith}}" name="noc_items[{{$key}}][assigned_brandwith]" class="form-control"></td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <th>MRTG/Cpanel</th>
                                                        <td>
                                                            <input type="text" name="mrtg_graph_url" class="form-control" value="{{$order_noc->mrtg_graph_url}}" required>
                                                        </td>
                                                        <th>Real IP</th>
                                                        <td>
                                                            <input type="text" name="real_ip" class="form-control" value="{{$order_noc->real_ip}}" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Username</th>
                                                        <td>
                                                            <input type="text" name="username" class="form-control" value="{{$order_noc->username}}" required>
                                                        </td>
                                                        <th>Passwword</th>
                                                        <td>
                                                            <input type="text" name="password" class="form-control" value="{{$order_noc->password}}" required>
                                                        </td>
                                                    </tr>
                                                    <tr>


                                                        <th>Device Description</th>
                                                        <td>
                                                            <textarea name="device_description" class="form-control" rows="1" required>{{$order_noc->device_description}}</textarea>
                                                        </td>
                                                        <th>Status</th>
                                                        <td>
                                                            <select class="form-control" name="status">
                                                                <option value="Processing" {{ $order_noc->status=="Processing"?"selected":'' }}>Processing</option>
                                                                <option value="Done" {{ $order_noc->status=="Done"?"selected":'' }}>Done</option>
                                                            </select>
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