@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="card card-body content-body">
            <section class="  modern-horizontal-wizard">
                <div class="wizard-modern modern-wizard-example">
                    <div class="  bs-stepper-content">
                        {{-- class="form" id="user_form" --}}
                        <form method="post" action="{{ route('reportUpdate') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="content-header">
                                <h5 class="mb-0">Followup/Reconnect</h5>
                                <small><b>Entry Daily Report</b></small>
                            </div>
                            <hr style="border: 1px solid">
                            <div class="row" id="vue_app">
                                <div class="alert"></div>
                                <div class="col-md-6">
                                    <div class="details">
                                    </div>
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <input type="hidden" name="createdBy" value="{{ Auth::user()->id }}">
                                            {{-- <input type="hidden" name="id" value="{{ $reports->id }}"> --}}
                                            <tr>
                                                <td>Select Client:</td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="client_id"
                                                        name="report_id" v-model="report_id" @change="fetch_report">
                                                        <option label="">Select One</option>
                                                        @foreach ($reports as $item)
                                                            <option value="{{ $item->id }}">{{ $item->cname }}
                                                                ({{ $item->contact_number }})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            {{-- <input type="text" name="report_id" id="report_id"  v-bind:value="id" > --}}
                                            <tr>
                                                <td width="200">Client/Organization Name:</td>
                                                <td v-html="cname"></td>
                                            </tr>
                                            <tr>
                                                <td>District:</td>
                                                <td v-html="district"></td>
                                            </tr>
                                            <tr>
                                                <td>Location: (Upazila) </td>
                                                <td v-html="upazila"></td>
                                            </tr>
                                            <tr>
                                                <td>Address:</td>
                                                <td v-html="address"> </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Person:</td>
                                                <td v-html="person">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Email:</td>
                                                <td v-html="email">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Visit/Phone:</td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="visit_phone"
                                                        name="visit_phone">
                                                        <option label="">Select One</option>
                                                        <option value="visit">Local Visit</option>
                                                        <option value="Cvisit">Corporate Visit</option>
                                                        <option value="phone">Phone</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Client Type</td>
                                                <td class="ctype">
                                                    <select class="form-control form-control-sm" id="ctype" name="ctype">
                                                        <option label="">Select One</option>
                                                        <option value="followup">Followup</option>
                                                        <option value="reconnect">Reconnect</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <input type="hidden" name="customer_report_id" id="id" v-bind:value="item.id">
                                            <tr>
                                                <td>ISP Type</td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="client_type"
                                                        name="isp_type">
                                                        <option label="">Select One</option>
                                                        <option value="category_a">Category A</option>
                                                        <option value="category_b">Category B</option>
                                                        <option value="category_c">Category C</option>
                                                        {{-- <option value="south_zonal">South zonal</option>
                                                        <option value="north_zonal">North zonal</option>
                                                        <option value="west_zonal">West zonal</option>
                                                        <option value="central_zonal">Central</option>
                                                        <option value="nationwide">Nationwide </option>
                                                        <option value="local">Local Client/Home</option>
                                                        <option value="corporate">Corporate Client</option>
                                                        <option value="non_license">Non License</option>
                                                        <option value="others">Others</option> --}}
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bandwidth:</td>
                                                <td><input type="text" class="form-control form-control-sm" name="bandwidth"
                                                        value=""></td>
                                            </tr>
                                            <tr>
                                                <td>Rate:</td>
                                                <td><input type="text" class="form-control form-control-sm" name="rate"
                                                        value=""></td>
                                            </tr>
                                            <tr>
                                                <td>OTC</td>
                                                <td><input type="number" name="otc" class="form-control form-control-sm"
                                                        value=""></td>
                                            </tr>
                                            <tr>
                                                <td>Remark:</td>
                                                <td><textarea name="remark" class="form-control form-control-sm"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Record file:</td>
                                                <td>
                                                    <input type="file" name="audio" class="form-control form-control-sm"
                                                        value="">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 offset-md-10">
                                    <input type="submit" value="Submit" class="btn btn-primary pull-right">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
@section('vendor-css')

    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/forms/select/select2.min.css">
@endsection
@section('page-css')

    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/forms/form-wizard.css">
@endsection
@push('style')

@endpush
@section('vendor-js')
@endsection
@section('page-js')
    <script src="{{ asset('') }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection

@push('script')

    <script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
    <script src="{{ asset('vue-js/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script>
        //  console.log('error');
        $(document).ready(function() {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    config: {
                        get_url: "{{ url('admin/fetch-report-id') }}",
                    },
                    // sub_category_id: '',
                    report_id: '',
                    report: [],
                    item: '',
                    cname: '',
                    district: '',
                    upazila: '',
                    email: '',
                    address: '',
                    person: '',
                    // id: '',
                },
                methods: {
                    fetch_report() {
                        var vm = this;
                        var slug = vm.report_id;
                        //alert(slug);
                        if (slug) {
                            axios.get(this.config.get_url + '/' + slug).then(
                                function(response) {
                                    // vm.id= response.data.id;
                                    vm.cname = response.data.cname;
                                    vm.district = response.data.district.name;
                                    vm.upazila = response.data.upazila.name;
                                    vm.email = response.data.email;
                                    vm.person = response.data.contact_person;
                                    vm.address = response.data.address;
                                    console.log(response.data);
                                }).catch(function(error) {
                                toastr.error('Something went to wrong', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                return false;
                            });
                        }
                    }
                },
                updated() {
                    $('.bSelect').selectpicker('refresh');
                }
            });
            $('.bSelect').selectpicker({
                liveSearch: true,
                size: 5
            });
        });
    </script>


@endpush
