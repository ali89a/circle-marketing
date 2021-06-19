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
                            <li class="breadcrumb-item active">Invoice
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
                            <h4 class="card-title">Invoice List</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderd">
                                            <tbody>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Send Mail</th>
                                                    <th>Invoice ID</th>
                                                    <th>Order ID</th>
                                                    <th>Client<br> Confirmation</th>
                                                    <th>Customer Name</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <!--<th>Mail Send Status</th>-->
                                                    <th>Invoice number</th>
                                                    <th>Send Count</th>
                                                    <th>Invoice Date</th>
                                                    <th>Generate Time</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="{{url('invoice/details')}}" class="btn btn-primary btn-xs btn-block"><i class="fa fa-print"></i> View</a>
                                                    </td>

                                                    <td>
                                                        <a class="btn btn-info btn-xs" target="_blank" href=""><i class="fa fa-mail"></i>Send Mail</a>
                                                    </td>
                                                    <td>
                                                        7550 </td>
                                                    <td>666</td>
                                                    <td class="">
                                                        Pending
                                                    </td>
                                                    <td>
                                                        Sufia Khatun(HK Net) </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        new </td>
                                                    <td>CN_51050</td>
                                                    <td>3</td>
                                                    <td>05-Jun-2021</td>
                                                    <td>05-Jun-2021 02:49:33 PM</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@section('vendor-css')

@endsection
@section('page-css')

<link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/pages/app-invoice.css">
@endsection
@push('style')

@endpush