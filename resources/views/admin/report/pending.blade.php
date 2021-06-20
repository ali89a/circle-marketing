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
                                <form action="" id="search">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="fp-range">Submitted By</label>
                                            <select class="form-control form-control-sm" name="name">
                                                <option value="">Submitted By</option>
                                                @foreach ($contact as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            From Date
                                            <input type="date" name="from_date" class="form-control ">
                                        </div>
                                        <div class="col-sm-4">
                                            To Date
                                            <input type="date" name="to_date" class="form-control ">
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
                            </div>
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12 orderlist" style="overflow-y:scroll;" id="result">
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
                                            {{-- <th>Contact By</th> --}}
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
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                @can('report-approve')
                                                @if ($item->ctype == 'new')
                                                <a href="{{ route('approve', ['id' => $item->id]) }}"
                                                    class="btn btn-success btn-circle col-sm">Approve
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                @endif
                                                @endcan
                                                <a href="#" class="mt-1 btn btn-primary btn-circle col-sm">Pending
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
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
                                            {{-- <td></td> --}}
                                            <td>{{ $item->bandwidth }}</td>
                                            <td>{{ $item->rate }}</td>
                                            <td>{{ $item->otc }}</td>
                                            <td>{{ $item->remark }}</td>
                                            <td>{{ $item->visit_phone }}</td>
                                            <td>
                                                <img class="img-fluid" style="width:100px; height: auto;"
                                                    src="{{ asset('storage/visitingCard/' . $item->visiting_card) }}"
                                                    alt="No Image">
                                            </td>
                                            <td>{{ $item->created_at }}</td>
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
                            <hr>
                            <br>
                            {{-- <div id="result">--}}
                                {{-- list will show in this box --}}
                           {{-- </div> --}}
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
                    url: '{{ route('pendingSearchResult') }}',
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
                    url: '{{ route('pendingSearchResult') }}',
                    data: $('#search').serialize(),
                    success: function(result) {
                        $('#result').html(result);

                    }
                });
            });
        });

</script>

@endpush