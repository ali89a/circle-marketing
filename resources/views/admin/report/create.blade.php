@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section class="card card-body modern-horizontal-wizard">
                <div class=" wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">
                        <form method="post" action="{{ route('report.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="createdBy" value="{{ Auth::user()->id }}">
                            <div class="content-header">
                                <h5 class="mb-0">Add Report</h5>
                            </div>
                            <hr style="border: 1px solid">
                            <div class="row" id="vue_app">
                                <div class="alert"></div>
                                <div class="col-md-6">
                                    <div class="details">
                                    </div>
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Contact Number:</td>
                                                <td><input type="tel" max="11" name="contact_number"
                                                        class="form-control form-control-sm"
                                                        value="{{ old('contact_number') }}" required=""
                                                        placeholder="Must be unique value.">
                                                    {{-- <span
                                                    class="text-danger">{{$errors->has('contact_number') ? $errors->first('contact_number') : ''}}</span> --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="200">Client/Organization Name:</td>
                                                <td><input type="text" name="cname" class="form-control form-control-sm"
                                                        value="{{ old('cname') }}" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>District:</td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="location_district"
                                                        name="location_district" v-model="district_id"
                                                        @change="fetch_upazila">
                                                        <option value="">Select One</option>
                                                        @foreach ($districts as $upazilas)
                                                            <option value="{{ $upazilas->id }}">
                                                                {{ $upazilas->name }}({{ $upazilas->bn_name }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            {{-- <input type="text" name="id" id="id"  v-bind:value="upazilas.id" > --}}
                                            <tr>
                                                <td>Location: (Upazila) </td>
                                                <td>
                                                    <select name="location_upazila" id="location_upazila"
                                                        class="form-control form-control-sm" v-model="upazila_id">
                                                        <option value="">Select one</option>
                                                        <option :value="row.id" v-for="row in upazilas" v-html="row.name"
                                                            style="max-width: 200px">
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Address:</td>
                                                <td>
                                                    <textarea name="address" class="form-control form-control-sm"
                                                        value="{{ old('address') }}"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Person:</td>
                                                <td><input type="text" name="contact_person"
                                                        class="form-control form-control-sm"
                                                        value="{{ old('contact_person') }}" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Contact Email:</td>
                                                <td><input type="email" name="email" class="form-control form-control-sm"
                                                        value="{{ old('email') }}" placeholder="Must be unique value.">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Visit/Phone:</td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="client_type"
                                                        name="visit_phone">
                                                        <option label="">Select One</option>
                                                        <option value="visit">Local Visit</option>
                                                        <option value="Cvisit">Corporate Visit</option>
                                                        <option value="phone">Phone</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr type="hidden">
                                                <td>Status:</td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="status"
                                                        name="status">
                                                        <option value="new">New</option>
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
                                                    <select class="form-control form-control-sm" id="client_type"
                                                        name="ctype">
                                                        <option value="{{ old('cname') }}"></option>
                                                        <option value="new">New Client</option>
                                                        {{-- <option value="followUp">FollowUp</option>
                                                    <option value="reconnect">Reconnect</option> --}}
                                                    </select>
                                                </td>
                                            </tr>
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
                                                <td>Visiting Card</td>
                                                <td>
                                                    <input type="file" name="visiting_card"
                                                        class="form-control form-control-sm"
                                                        value="{{ old('visiting_card') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bandwidth:</td>
                                                <td><input type="number" class="form-control form-control-sm"
                                                        name="bandwidth" value="{{ old('bandwidth') }}"></td>
                                            </tr>
                                            <tr>
                                                <td>Rate:</td>
                                                <td><input type="number" class="form-control form-control-sm" name="rate"
                                                        value="{{ old('rate') }}"></td>
                                            </tr>
                                            <tr>
                                                <td>OTC</td>
                                                <td><input type="number" name="otc" class="form-control form-control-sm"
                                                        value="{{ old('otc') }}"></td>
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

    <link rel="stylesheet" type="text/css"
        href="{{ asset('') }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
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
                        get_url: "{{ url('admin/fetch-district-id') }}",
                    },
                    district_id: '',
                    upazila_id: '',
                    upazilas: [],
                },
                methods: {
                    fetch_upazila() {
                        var vm = this;
                        var slug = vm.district_id;
                        //check
                        // alert(slug);

                        if (slug) {
                            axios.get(this.config.get_url + '/' + slug).then(
                                function(response) {
                                    vm.upazilas = response.data;
                                    console.log(vm.upazilas);
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
