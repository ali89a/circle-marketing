@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <div class="content-body">
            <section class="card card-body modern-horizontal-wizard">
                <div class=" wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">
                        <form class="form" id="user_form" method="post" action="{{ route('storeWorkLimit') }}"
                            enctype="multipart/form-data">
                            @csrf
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
                                         
                                                @foreach ($workLimit as $item)
                                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                    <tr class="">
                                                        <td>{{ $item->name }}
                                                            <input type="hidden" name="admin_id[]" value="{{ $item->id }}">
                                                        </td>
                                                        <td><input type="number" name="newclient[]" class="form-control-sm"
                                                                value="{{ $item->newclient }}">
                                                        </td>
                                                        <td><input type="number" name="followupclient[]" class="form-control-sm"
                                                                value="{{ $item->followupclient }}">
                                                        </td>
                                                        <td><input type="number" name="reconnectclient[]" class="form-control-sm"
                                                                value="{{ $item->reconnectclient }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                         
                                            <tr class="">
                                                <td colspan="3"></td>
                                                <td> <input type="submit" value="Save"
                                                        class="btn btn-primary pull-right form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
