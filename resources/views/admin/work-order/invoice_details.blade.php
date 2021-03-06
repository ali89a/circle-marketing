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
                                        @can('price-show')
                                        <th class="py-1">Unit Price</th>
                                        <th class="py-1">Amount</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $subtotal=0;
                                    @endphp
                                    @foreach($invoice->items as $item)
                                    @if($item->service->type=='general')
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold">{{ $item->invoice_description }}</p>
                                        </td>
                                        @can('price-show')
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $item->unit_price }}</span>
                                        </td>

                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $item->amount }}</span>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endif
                                    @php
                                    $subtotal= $subtotal+$item->amount;
                                    @endphp
                                    @endforeach
                                    @can('price-show')
                                    <tr>
                                        <td class="py-1" colspan="2">
                                            <p class="card-text font-weight-bold">Real IP</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $invoice->real_ip }}</span>
                                        </td>
                                    </tr>
                                    @endcan
                                </tbody>
                            </table>
                        </div>
                        @can('price-show')
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
                                            <p class="invoice-total-amount">{{$subtotal= $subtotal + $invoice->real_ip}}</p>
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
                        @endcan
                        <!-- Invoice Description ends -->

                        <hr class="invoice-spacing">

                        <!-- Invoice Note starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12">
                                    @if(empty($invoice->vat))
                                    <span class="font-weight-bold">Note:</span>
                                    <span>The entire payable amount is VAT inclusive. vat-no The entire payable amount is VAT Excluding.</span>
                                    @endif
                                    <br>
                                    <span class="font-weight-bold">Terms:</span>
                                    <span>Please pay the bill within 7days.</span>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>
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
                                        @can('price-show')
                                        <th class="py-1">Unit Price</th>
                                        <th class="py-1">Amount</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $subtotal=0;
                                    @endphp
                                    @foreach($invoice->items as $item)
                                    @if($item->service->type=='separate')
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold">{{ $item->invoice_description }}</p>
                                        </td>
                                        @can('price-show')
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $item->unit_price }}</span>
                                        </td>

                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $item->amount }}</span>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endif
                                    @php
                                    $subtotal= $subtotal+$item->amount;
                                    @endphp
                                    @endforeach
                                    @can('price-show')
                                    <tr>
                                        <td class="py-1" colspan="2">
                                            <p class="card-text font-weight-bold">Real IP</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $invoice->real_ip }}</span>
                                        </td>
                                    </tr>
                                    @endcan
                                </tbody>
                            </table>
                        </div>
                        @can('price-show')
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
                                            <p class="invoice-total-amount">{{$subtotal= $subtotal + $invoice->real_ip}}</p>
                                        </div>
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Vat({{ $invoice->vat }}%):</p>
                                            <p class="invoice-total-amount"> {{ $vat=( $subtotal * $invoice->vat) / 100 }}</p>
                                        </div>
                                      
                                        <hr class="my-50">
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Total:</p>
                                            <p class="invoice-total-amount">{{$total=$subtotal+$vat}}</p>
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
                        @endcan
                        <!-- Invoice Description ends -->

                        <hr class="invoice-spacing">

                        <!-- Invoice Note starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12">
                                    @if(empty($invoice->vat))
                                    <span class="font-weight-bold">Note:</span>
                                    <span>The entire payable amount is VAT inclusive. vat-no The entire payable amount is VAT Excluding.</span>
                                    @endif
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
                            <div class="card-title">
                                APPROVAL
                            </div>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="bg-gray">N A</td>
                                        <td class="text-center">
                                            @hasrole('NOC Admin')
                                            @if($invoice->invoice_approval->noc_approved_status ==='Pending')
                                            <a href="{{route('invoiceApprovalNOC',$invoice->id)}}" class="btn btn-success btn-sm mb-1">Approve</a>
                                            @else
                                            <p class="bg-gray btn-block">{{ $invoice->invoice_approval->noc_approved_status ??'' }}</p>
                                            @endif
                                            @else
                                            <p class="bg-gray btn-block">{{ $invoice->invoice_approval->noc_approved_status ??'' }}</p>

                                            @endhasrole
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray">M A</td>
                                        <td class="text-center">
                                            @hasrole('Marketing Admin')
                                            @if($invoice->invoice_approval->m_approved_status =='Pending')
                                            <a href="{{route('invoiceApprovalMarketing',$invoice->id)}}" class="btn btn-success btn-sm mb-1">Approve</a>
                                            @else
                                            <p class="bg-gray btn-block">{{ $invoice->invoice_approval->m_approved_status ??'' }}</p>
                                            @endif
                                            @else
                                            <p class="bg-gray btn-block">{{ $invoice->invoice_approval->m_approved_status ??'' }}</p>

                                            @endhasrole
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray">A A</td>
                                        <td class="text-center">
                                            @hasrole('Accounts Admin')
                                            @if($invoice->invoice_approval->a_approved_status =='Pending')
                                            <a href="{{route('invoiceApprovalAccounts',$invoice->id)}}" class="btn btn-success btn-sm mb-1">Approve</a>
                                            @else
                                            <p class="bg-gray btn-block">{{ $invoice->invoice_approval->a_approved_status ??'' }}</p>
                                            @endif
                                            @else
                                            <p class="bg-gray btn-block">{{ $invoice->invoice_approval->a_approved_status ??'' }}</p>

                                            @endhasrole
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray">COO</td>
                                        <td class="text-center">
                                            @hasrole('COO')
                                            @if($invoice->invoice_approval->coo_approved_status =='Pending')
                                            <a href="{{route('invoiceApprovalCOO',$invoice->id)}}" class="btn btn-success btn-sm mb-1">Approve</a>
                                            @else
                                            <p class="bg-gray btn-block">{{ $invoice->invoice_approval->coo_approved_status ??'' }}</p>
                                            @endif
                                            @else
                                            <p class="bg-gray btn-block">{{ $invoice->invoice_approval->coo_approved_status ??'' }}</p>

                                            @endhasrole
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-outline-secondary btn-block btn-download-invoice mb-75 waves-effect" href="{{ route('invoice.pdf-download', $invoice->id) }}" target="_blank">
                                Download
                            </a>
                            <a class="btn btn-outline-secondary btn-block mb-75 waves-effect" href="{{ route('invoice.pdf', $invoice->id) }}" target="_blank">
                                Print
                            </a>
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