@extends('admin.layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-body">
        <section class="modern-horizontal-wizard">
            <div class="bs-stepper wizard-modern modern-wizard-example">
                <div class="bs-stepper-content">
                    <div class="card box">
                        <div class=" card-body box-body">
                            <div class="col-md-12" style="margin-bottom:15px;">
                                <form action="#" method="get">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="fp-range">Submitted By</label>
                                            <select class="form-control form-control-sm" id="client_type"
                                                name="location_upazila">
                                                <option label="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="fp-range">Date Range</label>
                                            <input type="text" id="fp-range"
                                                class="data-type form-control form-control-sm flatpickr-range flatpickr-input active"
                                                placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
                                        </div>
                                        <div class="col-md-2">
                                            <br>
                                            <input type="submit" value="Generate Report" class="btn btn-primary"
                                                style="margin-top:20px">
                                        </div>
                                        <div class="col-md-1">
                                            <a style="margin-top:20px" href="#" class="btn btn-default"><i
                                                    class="fa fa-refresh"></i></a>
                                        </div>
                                    </div>
                                </form>
                                <div class="ajaxform">
                                    <div class="row" style="margin-top:20px">
                                        <div class="col-sm-4">
                                            Contact Number/Organization:
                                            <input type="text" class="form-control" name="searchnumber">
                                        </div>
                                        <div class="col-sm-2" style="margin-top:18px;">
                                            <button type="submit" class="btn btn-primary btnsearch"><i
                                                    class="fa fa-search"></i></button>
                                            <button class="btn btn-default btnclear"><i
                                                    class="fa fa-refresh"></i></button>
                                        </div>
                                        <div class="col-md-12" style="overflow-y:scroll;">
                                            <div id="searchresult">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12 orderlist" style="overflow-y:scroll;">
                                <table class="table table-bordered table-striped table-responsive">
                                    <tbody>
                                        <tr>
                                            <th>Report ID</th>
                                            <th>Action</th>
                                            <th>Client/Organization name</th>
                                            <th>C Type</th>
                                            <th>ISP Type</th>
                                            <th>Location</th>
                                            <th>District</th>
                                            <th>Upazila</th>
                                            <th>Contact Number</th>
                                            <th>Contact Person</th>
                                            <th>Email</th>
                                            <th>Contact By</th>
                                            <th>Bandwidth</th>
                                            <th>Rate</th>
                                            <th>OTC</th>
                                            <th>Remark</th>
                                            <th>Visit/Phone</th>
                                            <th>Visiting Card</th>
                                            <th>Report Date</th>
                                            <th>Record File</th>
                                        </tr>
                                        @foreach ($pendingList as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                @if($item->ctype=='new')
                                                <a href="{{route('/unpublished-product',['id' => $product->id])}}"
                                                    class="btn btn-success btn-circle">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                @else
                                                <a href="{{route('/published-product',['id' => $product->id])}}"
                                                    class="btn btn-warning btn-circle">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{ $item->cname }}</td>
                                            <td>{{ $item->location_district }} </td>
                                            <td>{{ $item->location_upazila }} </td>
                                            <td>{{ $item->address }} </td>
                                            <td>{{ $item->contact_person }} </td>
                                            <td>{{ $item->email }} </td>
                                            <td>{{ $item->visit_phone }}</td>
                                            <td>{{ $item->ctype }}</td>
                                            <td>{{ $item->isp_type }}</td>
                                            <td>{{ $item->visiting_card }} </td>
                                            <td>{{ $item->bandwidth }}</td>
                                            <td>{{ $item->rate }}</td>
                                            <td>{{ $item->otc }}</td>
                                            <td>{{ $item->remark }}</td>
                                            <td>{{ $item->audio }}</td>
                                            <td>
                                                <a id="single_image" href="#"
                                                    data-lightbox="1_OfibXlsns7WzN7a2WpaI1w.png"><img
                                                        src="{{ asset($item->visiting_card) }}                                                                                                                                        "
                                                        width="50"></a> </td>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <div class="audiofile">

                                                    <audio controls="">
                                                        <source src="{{ $item->audio }}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                </div>
                                            </td>

                                        </tr>


                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>
</div>


@endsection
@section('vendor-css')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('/') }}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">


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