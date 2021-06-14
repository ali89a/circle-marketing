@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-body">
        <section class="modern-horizontal-wizard">
            <div class="bs-stepper wizard-modern modern-wizard-example">
                <div class="bs-stepper-content">
                    <form method="post" action="{{route('report.store')}}">
                        @csrf
                        <input type="hidden" name="createdBy" value="{{ Auth::user()->id }}">
                        <div class="content-header">
                            <h5 class="mb-0">Add Report</h5>
                        </div>
                        <hr style="border: 1px solid">
                        <div class="row">
                            <div class="alert"></div>
                            <div class="col-md-6">
                                <div class="details">
                                </div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Contact Number:</td>
                                            <td><input type="tel" max="11" name="contact_number"
                                                    class="form-control form-control-sm" value="" required=""
                                                    placeholder="Must be unique value."></td>
                                        </tr>
                                        <tr>
                                            <td width="200">Client/Organization Name:</td>
                                            <td><input type="text" name="cname" class="form-control form-control-sm"
                                                    value="" required=""></td>
                                        </tr>
                                        <tr>
                                            <td>Districe:</td>
                                            <td>
                                                <select class="form-control form-control-sm" id="location_district"
                                                    name="location_district">
                                                    <option label="">Select One</option>
                                                    <option value="55">Bagerhat(বাগেরহাট)</option>
                                                    <option value="40">Bandarban(বান্দরবান)</option>
                                                    <option value="34">Barguna(বরগুনা)</option>
                                                    <option value="35">Barishal(বরিশাল)</option>
                                                    <option value="36">Bhola(ভোলা)</option>
                                                    <option value="18">Bogura(বগুড়া)</option>
                                                    <option value="41">Brahmanbaria(ব্রাহ্মণবাড়িয়া)</option>
                                                    <option value="42">Chandpur(চাঁদপুর)</option>
                                                    <option value="22">Chapainawabganj(চাপাইনবাবগঞ্জ)</option>
                                                    <option value="43">Chattogram(চট্টগ্রাম)</option>
                                                    <option value="56">Chuadanga(চুয়াডাঙ্গা)</option>
                                                    <option value="45">Cox's Bazar(কক্স বাজার)</option>
                                                    <option value="44">Cumilla(কুমিল্লা)</option>
                                                    <option value="1">Dhaka(ঢাকা)</option>
                                                    <option value="26">Dinajpur(দিনাজপুর)</option>
                                                    <option value="2">Faridpur(ফরিদপুর)</option>
                                                    <option value="46">Feni(ফেনী)</option>
                                                    <option value="27">Gaibandha(গাইবান্ধা)</option>
                                                    <option value="3">Gazipur(গাজীপুর)</option>
                                                    <option value="4">Gopalganj(গোপালগঞ্জ)</option>
                                                    <option value="51">Habiganj(হবিগঞ্জ)</option>
                                                    <option value="5">Jamalpur(জামালপুর)</option>
                                                    <option value="57">Jashore(যশোর)</option>
                                                    <option value="37">Jhalokati(ঝালকাঠি)</option>
                                                    <option value="58">Jhenaidah(ঝিনাইদহ)</option>
                                                    <option value="19">Joypurhat(জয়পুরহাট)</option>
                                                    <option value="47">Khagrachari(খাগড়াছড়ি)</option>
                                                    <option value="59">Khulna(খুলনা)</option>
                                                    <option value="6">Kishoreganj(কিশোরগঞ্জ)</option>
                                                    <option value="65">Kuakata(কুয়াকাটা)</option>
                                                    <option value="28">Kurigram(কুড়িগ্রাম)</option>
                                                    <option value="60">Kushtia(কুষ্টিয়া)</option>
                                                    <option value="48">Lakshmipur(লক্ষ্মীপুর)</option>
                                                    <option value="29">Lalmonirhat(লালমনিরহাট)</option>
                                                    <option value="7">Madaripur(মাদারীপুর)</option>
                                                    <option value="61">Magura(মাগুরা)</option>
                                                    <option value="8">Manikganj(মানিকগঞ্জ)</option>
                                                    <option value="52">Maulvibazar(মৌলভীবাজার)</option>
                                                    <option value="62">Meherpur(মেহেরপুর)</option>
                                                    <option value="9">Munshiganj(মুন্সিগঞ্জ)</option>
                                                    <option value="10">Mymensingh(ময়মনসিংহ)</option>
                                                    <option value="20">Naogaon(নওগাঁ)</option>
                                                    <option value="63">Narail(নড়াইল)</option>
                                                    <option value="11">Narayanganj(নারায়াণগঞ্জ)</option>
                                                    <option value="12">Narsingdi(নরসিংদী)</option>
                                                    <option value="21">Natore(নাটোর)</option>
                                                    <option value="13">Netrokona(নেত্রকোণা)</option>
                                                    <option value="30">Nilphamari(নীলফামারী)</option>
                                                    <option value="49">Noakhali(নোয়াখালী)</option>
                                                    <option value="23">Pabna(পাবনা)</option>
                                                    <option value="31">Panchagarh(পঞ্চগড়)</option>
                                                    <option value="38">Patuakhali(পটুয়াখালী)</option>
                                                    <option value="39">Pirojpur(পিরোজপুর)</option>
                                                    <option value="14">Rajbari(রাজবাড়ি)</option>
                                                    <option value="24">Rajshahi(রাজশাহী)</option>
                                                    <option value="50">Rangamati(রাঙ্গামাটি)</option>
                                                    <option value="32">Rangpur(রংপুর)</option>
                                                    <option value="64">Satkhira(সাতক্ষীরা)</option>
                                                    <option value="15">Shariatpur(শরীয়তপুর)</option>
                                                    <option value="16">Sherpur(শেরপুর)</option>
                                                    <option value="25">Sirajgonj(সিরাজগঞ্জ)</option>
                                                    <option value="53">Sunamganj(সুনামগঞ্জ)</option>
                                                    <option value="54">Sylhet(সিলেট)</option>
                                                    <option value="17">Tangail(টাঙ্গাইল)</option>
                                                    <option value="33">Thakurgaon(ঠাকুরগাঁও)</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Location: (Upazila) </td>
                                            <td>
                                                <select class="form-control form-control-sm" id="client_type"
                                                    name="location_upazila">
                                                    <option label="">Select One</option>

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Location:</td>
                                            <td>
                                                <textarea name="address" class="form-control form-control-sm"
                                                    value=""></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Contact Person:</td>
                                            <td><input type="text" name="contact_person"
                                                    class="form-control form-control-sm" value="" required=""></td>
                                        </tr>

                                        <tr>
                                            <td>Contact Email:</td>
                                            <td><input type="email" name="email" class="form-control form-control-sm"
                                                    value="" placeholder="Must be unique value."></td>
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
                                                    <option label="">Select One</option>
                                                    <option label="new">New Client</option>
                                                    <option label="followUp">FollowUp</option>
                                                    <option label="reconnect">Reconnect</option>
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
                                                    <option value="south_zonal">South zonal</option>
                                                    <option value="north_zonal">North zonal</option>
                                                    <option value="west_zonal">West zonal</option>
                                                    <option value="central_zonal">Central</option>
                                                    <option value="nationwide">Nationwide </option>
                                                    <option value="local">Local Client/Home</option>
                                                    <option value="corporate">Corporate Client</option>
                                                    <option value="non_license">Non License</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Visiting Card</td>
                                            <td>
                                                <input type="file" name="visiting_card"
                                                    class="form-control form-control-sm" value="">
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
                                            <td><input type="text" name="otc" class="form-control form-control-sm"
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

@endpush