@extends('admin.layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-body">
        <section class="card card-body modern-horizontal-wizard">
            <div class=" wizard-modern modern-wizard-example">
                <div class="bs-stepper-content">
                    <form class="form" id="user_form" method="post" action="#" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <th>New Client Visit/Local</th>
                                            <th>Follow UP/Factory Visit</th>
                                            <th>Reconnect/Call</th>
                                        </tr>
                                        <tr class="hide">
                                            <td>Rokibul Hasan</td>
                                            <td><input type="number" name="newclient[1]" value="5"></td>
                                            <td><input type="number" name="followup[1]" value="3"></td>
                                            <td><input type="number" name="reconnect[1]" value="3"></td>
                                        </tr>
                                        <tr class="">
                                            <td>rokibul Hasan</td>
                                            <td><input type="number" name="newclient[23]" value="0"></td>
                                            <td><input type="number" name="followup[23]" value="0"></td>
                                            <td><input type="number" name="reconnect[23]" value="0"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Md.Kawcher Ahmed</td>
                                            <td><input type="number" name="newclient[43]" value="5"></td>
                                            <td><input type="number" name="followup[43]" value="15"></td>
                                            <td><input type="number" name="reconnect[43]" value="5"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Md.Mehedi Hasan</td>
                                            <td><input type="number" name="newclient[45]" value="5"></td>
                                            <td><input type="number" name="followup[45]" value="10"></td>
                                            <td><input type="number" name="reconnect[45]" value="2"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Md.Kawsar ahmed</td>
                                            <td><input type="number" name="newclient[70]" value="0"></td>
                                            <td><input type="number" name="followup[70]" value="0"></td>
                                            <td><input type="number" name="reconnect[70]" value="0"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Robiul Islam Jewel</td>
                                            <td><input type="number" name="newclient[73]" value="10"></td>
                                            <td><input type="number" name="followup[73]" value="5"></td>
                                            <td><input type="number" name="reconnect[73]" value="5"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Md Mostafiq</td>
                                            <td><input type="number" name="newclient[85]" value="5"></td>
                                            <td><input type="number" name="followup[85]" value="15"></td>
                                            <td><input type="number" name="reconnect[85]" value="0"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Afroza</td>
                                            <td><input type="number" name="newclient[86]" value="5"></td>
                                            <td><input type="number" name="followup[86]" value="15"></td>
                                            <td><input type="number" name="reconnect[86]" value="5"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Tanvir</td>
                                            <td><input type="number" name="newclient[88]" value="10"></td>
                                            <td><input type="number" name="followup[88]" value="8"></td>
                                            <td><input type="number" name="reconnect[88]" value="5"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Kasmir Rana</td>
                                            <td><input type="number" name="newclient[90]" value="10"></td>
                                            <td><input type="number" name="followup[90]" value="15"></td>
                                            <td><input type="number" name="reconnect[90]" value="0"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Kowshik Ami</td>
                                            <td><input type="number" name="newclient[106]" value="0"></td>
                                            <td><input type="number" name="followup[106]" value="0"></td>
                                            <td><input type="number" name="reconnect[106]" value="0"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Yasin Arafat</td>
                                            <td><input type="number" name="newclient[108]" value="0"></td>
                                            <td><input type="number" name="followup[108]" value="0"></td>
                                            <td><input type="number" name="reconnect[108]" value="0"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Kawcher Ahmed</td>
                                            <td><input type="number" name="newclient[113]" value="0"></td>
                                            <td><input type="number" name="followup[113]" value="0"></td>
                                            <td><input type="number" name="reconnect[113]" value="0"></td>
                                        </tr>
                                        <tr class="">
                                            <td>Marketing Admin</td>
                                            <td><input type="number" name="newclient[114]" value="0"></td>
                                            <td><input type="number" name="followup[114]" value="0"></td>
                                            <td><input type="number" name="reconnect[114]" value="0"></td>
                                        </tr>
                                        <tr class="">

                                            <td colspan="3"></td>
                                            <td> <input type="submit" value="Save"
                                                    class="btn btn-primary pull-right form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- <div class="form-group row">
                                    <div class="col-md-12 offset-md-7">
                                        <br>
                                        <button type="submit" name="btn" class="btn btn-success">Save</button>
                                    </div>
                                </div> --}}
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