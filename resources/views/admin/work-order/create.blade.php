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
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            data-feather="grid"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i
                                class="mr-1" data-feather="check-square"></i><span
                                class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i
                                class="mr-1" data-feather="message-square"></i><span
                                class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i
                                class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a
                            class="dropdown-item" href="app-calendar.html"><i class="mr-1"
                                data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
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
                                            <input type="text" id="organization" name="organization"
                                                class="form-control form-control-sm" placeholder="Enter Organization" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="client_type">Client Type</label>
                                            <select class="select2 w-100" id="client_type" name="client_type"
                                                class="form-control form-control-sm">
                                                <option value="">Select One</option>
                                                <option value="isp">ISP</option>
                                                <option value="corporate">Corporate</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="technical-email">Technical Email</label>
                                            <input type="email" id="technical-email" name="technical_email"
                                                class="form-control form-control-sm" placeholder="john.doe@email.com"
                                                aria-label="john.doe" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="billing-email">Billing Email</label>
                                            <input type="email" id="billing-email" name="billing_email"
                                                class="form-control form-control-sm" placeholder="john.doe@email.com"
                                                aria-label="john.doe" />
                                        </div>
                                    </div>


                                </div>
                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="mobile">Mobile</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control form-control-sm"
                                                placeholder="01515664762" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="alt_mobile">Alter Mobile</label>
                                            <input type="text" id="alt_mobile" name="alt_mobile" class="form-control form-control-sm"
                                                placeholder="01516664762" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="occupation">Occupation</label>
                                            <input type="email" id="occupation" name="occupation" class="form-control form-control-sm"
                                                placeholder="Enter occupation" aria-label="john.doe" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="division">Division</label>
                                            <select class="select2 w-100" id="division">
                                                <option label=" "></option>
                                                <option>UK</option>
                                                <option>USA</option>
                                                <option>Spain</option>
                                                <option>France</option>
                                                <option>Italy</option>
                                                <option>Australia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="district">District</label>
                                            <select class="select2 w-100" id="district">
                                                <option label=" "></option>
                                                <option>UK</option>
                                                <option>USA</option>
                                                <option>Spain</option>
                                                <option>France</option>
                                                <option>Italy</option>
                                                <option>Australia</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="upazila">Upazila</label>
                                            <select class="select2 w-100" id="upazila">
                                                <option label=" "></option>
                                                <option>UK</option>
                                                <option>USA</option>
                                                <option>Spain</option>
                                                <option>France</option>
                                                <option>Italy</option>
                                                <option>Australia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="technical-address">Technical Address</label>
                                            <input type="text" id="technical-address" name="technical_address"
                                                class="form-control form-control-sm" placeholder="Technical Address" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="billing-address">Billing Address</label>
                                            <input type="text" id="billing-address" name="billing_address"
                                                class="form-control form-control-sm" placeholder="Billing Address" />
                                        </div>
                                    </div>



                                </div>

                                <div class="content-header">
                                    <h5 class="mb-0">Document Info</h5>
                                    <small>Enter Your Document Info.</small>
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">File1</label>
                                            <input type="file" name="gmap_location" id="pincode2" class="form-control form-control-sm"
                                                placeholder="658921" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">File2</label>
                                            <input type="file" id="city2" name="connect_type" class="form-control form-control-sm"
                                                placeholder="Birmingham" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">File1</label>
                                            <input type="file" name="gmap_location" id="pincode2" class="form-control form-control-sm"
                                                placeholder="658921" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">File2</label>
                                            <input type="file" id="city2" name="connect_type" class="form-control form-control-sm"
                                                placeholder="Birmingham" />
                                        </div>
                                    </div>



                                </div>


                                <div class="content-header">
                                    <h5 class="mb-0">Order</h5>
                                    <small>Enter Your Order.</small>
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="vertical-address">Type</label>
                                            <input style="margin-left: 10%" type="radio" name="type" value="own"> Own
                                            <input style="margin-left: 10%" type="radio" name="type" value="nttn"> NTTN
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="vertical-landmark">SCL Id</label>
                                            <input type="text" name="scl_id" id="vertical-landmark" class="form-control form-control-sm"
                                                placeholder="Borough bridge" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Gmap Location</label>
                                            <input type="text" name="gmap_location" id="pincode2" class="form-control form-control-sm"
                                                placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">Connect Type</label>
                                            <input type="text" id="city2" name="connect_type" class="form-control form-control-sm"
                                                placeholder="Birmingham" />
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Link Id</label>
                                            <input type="text" id="pincode2" name="link_id" class="form-control form-control-sm"
                                                placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">Vat</label>
                                            <input type="text" id="city2" name="vat" class="form-control form-control-sm"
                                                placeholder="Birmingham" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Visit Type</label>
                                            <select class="form-control" name="visit_type">
                                                <option value="">Select Type</option>
                                                <option value="visited">Visited</option>
                                                <option value="phone">Phone</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">Order Submission Date</label>
                                            <input type="text" id="city2" name="order_submission_date"
                                                class="form-control form-control-sm" placeholder="Birmingham" />
                                        </div>
                                    </div>


                                </div>
                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Billing Cycle</label>
                                            <input type="text" id="pincode2" name="billing_cycle" class="form-control form-control-sm"
                                                placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">Billing Remark</label>
                                            <input type="text" id="city2" name="billing_remark" class="form-control form-control-sm"
                                                placeholder="Birmingham" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Bill Start Date</label>
                                            <input type="text" id="pincode2" name="bill_start_date" class="form-control form-control-sm"
                                                placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">Delivery Date</label>
                                            <input type="text" id="city2" name="delivery_date" class="form-control form-control-sm"
                                                placeholder="Birmingham" />
                                        </div>
                                    </div>


                                </div>



                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Bill Generate Method</label>
                                            <input type="text" id="pincode2" name="bill_generate_method"
                                                class="form-control form-control-sm" placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">Total Price</label>
                                            <input type="text" id="city2" name="total_Price" class="form-control form-control-sm"
                                                placeholder="Birmingham" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Core Rent</label>
                                            <input type="text" id="pincode2" name="core_rent" class="form-control form-control-sm"
                                                placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="city2">OTC</label>
                                            <input type="text" id="city2" name="otc" class="form-control form-control-sm"
                                                placeholder="Birmingham" />
                                        </div>
                                    </div>


                                </div>


                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Real IP</label>
                                            <input type="text" id="pincode2" name="real_ip" class="form-control form-control-sm"
                                                placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Marketing User</label>
                                            <input type="text" id="pincode2" name="marketing_user_id"
                                                class="form-control form-control-sm" placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">customers User</label>
                                            <input type="text" id="pincode2" name="customers_user_id"
                                                class="form-control form-control-sm" placeholder="658921" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Security Money Type</label>
                                            <input type="text" id="pincode2" name="security_money_type"
                                                class="form-control form-control-sm" placeholder="658921" />
                                        </div>
                                    </div>


                                </div>



                                 <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                              <label class="form-label" for="pincode2">Security Money Amount</label>
                                <input type="text" id="pincode2" name="security_money_amount" class="form-control form-control-sm"
                                    placeholder="658921" />
                                        </div>
                                    </div>
{{-- 
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode2">Marketing User</label>
                                            <input type="text" id="pincode2" name="marketing_user_id"
                                                class="form-control" placeholder="658921" />
                                        </div>
                                    </div> --}}

                                  


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
                                        <button type="submit"
                                            class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                        <button type="reset"
                                            class="btn btn-outline-secondary waves-effect">Reset</button>
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