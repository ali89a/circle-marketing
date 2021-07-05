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
                            <li class="breadcrumb-item active">Invoice Details
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
                        <a class="dropdown-item" href="{{route('work-order.index')}}"><svg xmlns="#" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">Work Order</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Responsive tables start -->
        <section class="invoice-preview-wrapper">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-9 col-md-8 col-12">
                    <div class="card invoice-preview-card">
                        <!-- Address and Contact starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row invoice-spacing">
                                <div class="col-xl-8 p-0">
                                    <h6 class="mb-2">To:</h6>
                                    <h6 class="mb-25">{{$invoice->order->customer_details->organization}}</h6>
                                    <p class="card-text mb-25">{{$invoice->billing_address}}</p>
                                </div>
                                <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="pr-1">Invoice No:</td>
                                                <td><span class="font-weight-bold">{{$invoice->invoice_no}}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Link ID:</td>
                                                <td>{{$invoice->link_id}}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Invoice Date:</td>
                                                <td><span class="font-weight-bold">{{$invoice->invoice_date}}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <h5><strong>Subject:</strong> {{$invoice->subject}}</h5>
                        </div>
                        <!-- Address and Contact ends -->

                        <!-- Invoice Description starts -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="py-1">Description of Charges</th>
                                        <th class="py-1">Unit Price</th>
                                        <th class="py-1">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $subtotal=0;
                                    @endphp
                                    @foreach($invoice->items as $item)
                                    <tr>

                                        <td class="py-1">
                                            <p class="card-text font-weight-bold">{{ $item->invoice_description }}</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $item->unit_price }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $item->amount }}</span>
                                        </td>
                                    </tr>
                                    @php
                                    $subtotal= $subtotal+$item->amount;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="card-body invoice-padding pb-0">
                            <div class="row invoice-sales-total-wrapper">
                                <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                    <p class="card-text mb-0">

                                    </p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                    <div class="invoice-total-wrapper">
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Subtotal:</p>
                                            <p class="invoice-total-amount">{{$subtotal}}</p>
                                        </div>
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Vat({{ $invoice->vat }}%):</p>
                                            <p class="invoice-total-amount"> {{ $vat=( $subtotal * $invoice->vat) / 100 }}</p>
                                        </div>
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Core Rent:</p>
                                            <p class="invoice-total-amount"> {{$invoice->core_rent}}</p>
                                        </div>
                                        @if($invoice->otc)
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">OTC:</p>
                                            <p class="invoice-total-amount"> {{$invoice->otc}}</p>
                                        </div>
                                        @endif
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Previous Due:</p>
                                            <p class="invoice-total-amount"> {{$invoice->previous_due}}</p>
                                        </div>
                                        <hr class="my-50">
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Total:</p>
                                            <p class="invoice-total-amount">{{$total=$subtotal+$invoice->previous_due+ $invoice->otc + $invoice->core_rent+$vat}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="card-text mb-0">
                                    In Word: {{ \App\Classes\ConvertNumber::convert_number_to_words($total) }} Taka Only.
                                </p>
                            </div>
                        </div>
                        <!-- Invoice Description ends -->

                        <hr class="invoice-spacing">

                        <!-- Invoice Note starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <span class="font-weight-bold">Note:</span>
                                    <span>The entire payable amount is excluding VAT.</span>
                                    <br>
                                    <span class="font-weight-bold">Terms:</span>
                                    <span>Please pay the bill within 7days.</span>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>
                </div>
                <!-- /Invoice -->

                <!-- Invoice Actions -->
                <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary btn-block mb-75 waves-effect waves-float waves-light" data-toggle="modal" data-target="#send-invoice-sidebar">
                                Send Invoice
                            </button>
                            <button class="btn btn-outline-secondary btn-block btn-download-invoice mb-75 waves-effect">Download</button>
                            <a class="btn btn-outline-secondary btn-block mb-75 waves-effect" href="./app-invoice-print.html" target="_blank">
                                Print
                            </a>
                            <a class="btn btn-outline-secondary btn-block mb-75 waves-effect" href="./app-invoice-edit.html"> Edit </a>
                            <button class="btn btn-success btn-block waves-effect waves-float waves-light" data-toggle="modal" data-target="#add-payment-sidebar">
                                Add Payment
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Actions -->
            </div>
        </section>
        <!-- Responsive tables end -->
    </div>
</div>


@endsection
@section('vendor-css')




@endsection
@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/pages/app-invoice.css">
@endsection
@push('style')

@endpush
@section('vendor-js')

@endsection
@section('page-js')

@endsection
@push('script')

@endpush