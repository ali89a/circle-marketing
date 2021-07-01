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
                                                        <th>Internet</th>
                                                        <th>GGC</th>
                                                        <th>FB</th>
                                                        <th>BDIX</th>
                                                        <th>Data</th>
                                                    </tr>
                                                    <tr>
                                                        <th>VLAN</th>
                                                        <td><input type="text" value="{{$order_noc->vlan_internet}}" name="vlan_internet" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->vlan_ggc}}" name="vlan_ggc" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->vlan_fb}}" name="vlan_fb" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->vlan_bdix}}" name="vlan_bdix" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->vlan_data}}" name="vlan_data" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>IP</th>
                                                        <td><input type="text" value="{{$order_noc->ip_internet}}" name="ip_internet" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->ip_ggc}}" name="ip_ggc" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->ip_fb}}" name="ip_fb" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->ip_bdix}}" name="ip_bdix" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->ip_data}}" name="ip_data" class="form-control"></td>

                                                    </tr>
                                                    <tr>
                                                        <th>Assigned BW</th>
                                                        <td><input type="text" value="{{$order_noc->assigned_bandwidth_internet}}" name="assigned_bandwidth_internet" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->assigned_bandwidth_ggc}}" name="assigned_bandwidth_ggc" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->assigned_bandwidth_fb}}" name="assigned_bandwidth_fb" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->assigned_bandwidth_bdix}}" name="assigned_bandwidth_bdix" class="form-control"></td>
                                                        <td><input type="text" value="{{$order_noc->assigned_bandwidth_data}}" name="assigned_bandwidth_data" class="form-control"></td>
                                                    </tr>
                                                    <tr>

                                                        <th>MRTG/Cpanel</th>
                                                        <td>
                                                            <input type="text" name="mrtg_graph_url" class="form-control" value="{{$order_noc->mrtg_graph_url}}" required>
                                                        </td>
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

                                                        <th>Real IP</th>
                                                        <td>
                                                            <input type="text" name="real_ip" class="form-control" value="{{$order_noc->real_ip}}" required>
                                                        </td>
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