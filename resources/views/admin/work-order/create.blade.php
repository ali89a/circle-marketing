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
        <form method="post" action="{{route('work-order.store')}}">
            @csrf
            <!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Customer Details</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="organization">Organization</label>
                                            <input type="text" id="organization" name="organization" class="form-control form-control-sm" placeholder="Enter Organization" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="client_type">Client Type</label>
                                            <select class="select2 w-100" id="client_type" name="client_type" class="form-control form-control-sm">
                                                <option value="">Select One</option>
                                                <option value="isp">ISP</option>
                                                <option value="corporate">Corporate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="technical-email">Technical Email</label>
                                            <input type="email" id="technical-email" name="technical_email" class="form-control form-control-sm" placeholder="john.doe@email.com" aria-label="john.doe" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                        <label class="form-label" for="billing-email">Billing Email</label>
                                    <input type="email" id="billing-email" name="billing_email" class="form-control form-control-sm" placeholder="john.doe@email.com" aria-label="john.doe" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 offset-sm-9">
                                        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </form>
        <!-- Basic Horizontal form layout section end -->
    </div>
</div>

@endsection
@section('vendor-css')
@endsection
@section('page-css')
@endsection
@push('style')

@endpush
@section('vendor-js')
@endsection
@section('page-js')
@endsection
@push('script')

@endpush