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
                                    {{-- <form action="#" method="get"> --}}
                                    <form action="" id="search">
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label for="fp-range">Submitted By</label>
                                                <select class="form-control form-control-sm" name="name">
                                                    <option value="">Submitted By</option>
                                                    {{-- @foreach ($contact as $item) --}}
                                                    <option value="{{ $contact->name }}">{{ $contact->name }}
                                                    </option>
                                                    {{-- @endforeach --}}
                                                </select>
                                            </div>
                                            {{-- <div class="col-md-4 form-group">
                                            <label for="fp-range">Date Range</label>
                                            <input type="text" id="fp-range" name="from_date"
                                                class="data-type form-control form-control-sm flatpickr-range flatpickr-input active"
                                                placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
                                            </div> --}}
                                            <div class="col-sm-4">
                                                From Date
                                                <input type="date" name="from_date"
                                                    class="form-control flatpickr-basic flatpickr-input"
                                                    placeholder="YYYY-MM-DD" readonly="readonly">
                                            </div>
                                            <div class="col-sm-4">
                                                To Date
                                                <input type="date" name="to_date"
                                                    class="form-control flatpickr-basic flatpickr-input"
                                                    placeholder="YYYY-MM-DD" readonly="readonly">
                                            </div>
                                            <div class="col-sm-4">
                                                Contact Number/Organization:
                                                <input type="text" class="form-control " name="contact_number" onclick="">
                                            </div>
                                            <div class="col-sm-2">
                                                <button @click="search" type="submit" id="searchBtn"
                                                    class="btn btn-primary byn-block form-control mt-2">
                                                    Search
                                                </button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-primary byn-block form-control mt-2" type="reset"
                                                    id="reset">Reset
                                                </button>
                                            </div>

                                            {{-- <div class="col-md-2">
                                            <br>
                                            <button @click="search" type="submit" id="searchBtn"
                                                class="btn btn-primary byn-block form-control">
                                                Search
                                            </button>
                                            <br>
                                            <button class="btn btn-primary byn-block form-control" type="reset"
                                                id="reset">Reset
                                            </button>

                                        </div> --}}
                                        </div>
                                    </form>

                                    {{-- <div id="result"> --}}
                                    {{-- list will show in this box --}}
                                    {{-- </div> --}}

                                    {{-- <div class="ajaxform">
                                    <div class="row" style="margin-top:20px">
                                        <div class="col-sm-4">
                                            Contact Number/Organization:
                                            <input type="text" class="form-control " name="searchnumber">
                                        </div>
                                        <div class="col-sm-2" style="margin-top:18px;">
                                            <button type="submit" class="btn btn-primary btnsearch"><i
                                                    class="fa fa-search"></i>Search</button>
                                        </div>
                                        <div class="col-md-12" style="overflow-y:scroll;">
                                            <div id="searchresult">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                </div>
                                <div class="col-md-12">
                                </div>
                                {{-- style="overflow-y:scroll;" --}}
                                <div class="col-md-12 orderlist" id="result">
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
                                                <th>Bandwidth</th>
                                                <th>Rate</th>
                                                <th>OTC</th>
                                                <th>Remark</th>
                                                <th>Visit/Phone</th>
                                                <th>Visiting Card</th>
                                                <th>Report Date</th>
                                                <th>Record File</th>
                                            </tr>
                                            @foreach ($reports as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        @if ($item->status == 'approved')
                                                            <a href="#" class="btn btn-success btn-circle col-sm">Approved
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                        @elseif($item->status == 'canceled')
                                                            <a href="#" class="btn btn-danger btn-circle col-sm">Canceled
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                        @elseif($item->ctype == 'followup')
                                                            <a href="#" class="btn btn-success btn-circle col-sm">Approved
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                        @elseif($item->ctype == 'reconnect')
                                                            <a href="#" class="btn btn-success btn-circle col-sm">Approved
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->cname }}</td>
                                                    <td>{{ $item->ctype }} </td>
                                                    <td>{{ $item->isp_type }} </td>
                                                    <td>{{ $item->address }} </td>
                                                    <td>{{ $item->district }} </td>
                                                    <td>{{ $item->upazila }} </td>
                                                    <td>{{ $item->contact_number }}</td>
                                                    <td>{{ $item->contact_person }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->bandwidth }}</td>
                                                    <td>{{ $item->rate }}</td>
                                                    <td>{{ $item->otc }}</td>
                                                    <td>{{ $item->remark }}</td>
                                                    <td>{{ $item->visit_phone }}</td>
                                                    {{-- <td>
                                                        <img class="img-fluid" style="width:100px; height: auto;"
                                                            src="{{ asset('storage/visitingCard/' . $item->visiting_card) }}"
                                            alt="No Image">
                                            </td> --}}
                                                    <td>
                                                        @if (!empty($item->visiting_card))
                                                            @if ($extension = pathinfo(storage_path('storage/visitingCard/' . $item->visiting_card) == 'pdf'))
                                                                {{-- @dd($extension) --}}
                                                                <embed
                                                                    src="{{ asset('storage/visitingCard/' . $item->visiting_card) }}"
                                                                    width="100px" height="100px" />
                                                            @else
                                                                <img class="img-fluid" style="width:100px; height: 100px;"
                                                                    src="{{ asset('storage/visitingCard/' . $item->visiting_card) }}"
                                                                    alt="No Image">
                                                            @endif
                                                        @else
                                                            <h6>Not Found</h6>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        @if (!empty($item->audio))
                                                            <div class="audiofile">
                                                                <audio controls="">
                                                                    <source
                                                                        src="{{ asset('storage/audio/' . $item->audio) }}"
                                                                        type="audio/mpeg">
                                                                </audio>
                                                            </div>
                                                        @else
                                                            <h6>Not Found</h6>
                                                        @endif
                                                        {{-- <div class="audiofile">
                                                            <audio controls="">
                                                                <source
                                                                    src="{{ asset('storage/audio/' . $item->audio) }}"
                                                                    type="audio/mpeg">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        </div> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{ $reports->links() }} --}}
                                </div>


                                <hr>
                                <br>
                                {{-- <div id="result"> --}}
                                {{-- list will show in this box --}}
                                {{-- </div> --}}
                            </div>

                            <div class="row form-control-sm mb-2 ml-2">
                                <ul class="pagination">
                                    <li><a href="" data-ci-pagination-page="20">{{ $reports->links() }} ›</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


@endsection
@section('vendor-css')

    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">


@endsection
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-pickadate.css">
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
    <script type="text/javascript">
        //console.log('error');
        $(document).ready(function() {
            $('#reset').click(function() {
                $('#result').html('');
            });
            $('#searchBtn').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '{{ route('searchResult') }}',
                    data: $('#search').serialize(),
                    // alert(result);
                    success: function(result) {

                        console.log(result);
                        $('#result').html(result);

                    }
                });
            });
            //alert(result);
            $('#details').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '{{ route('searchResult') }}',
                    data: $('#search').serialize(),
                    success: function(result) {
                        $('#result').html(result);

                    }
                });
            });
        });
    </script>

@endpush
