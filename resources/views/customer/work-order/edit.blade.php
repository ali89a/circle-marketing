@extends('admin.layouts.master')

@section('content')

<div class="col-md-12" style="overflow-x:scroll;">




    <form action="#" method="post" class="form-inline">
        <table class="table table-bordered table-responsive table-striped" border="1">

            <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table table-responsive table-bordered">
                                    <tbody>
                                        <tr>

                                            <td style="">Customer:</td>
                                            <td>
                                                Md Rezaur Rahman
                                                <br>(T.G Network) </td>
                                            <td>Order ID:</td>
                                            <td>665</td>
                                        </tr>

                                        <tr>
                                            <th colspan="5" class="text-center">Pricing/Capacity</th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Capacity</td>
                                            <td>Buffer</td>
                                            <td>Upgrade</td>
                                            <td>Downgrade</td>
                                            <td class="bg-gray">Total</td>
                                        </tr>
                                        <tr>
                                            <td>Internet</td>
                                            <td>400</td>
                                            <td></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="bg-gray">400</td>
                                        </tr>
                                        <tr>
                                            <td>BDIX</td>
                                            <td>0</td>
                                            <td></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="bg-gray">0</td>
                                        </tr>
                                        <tr>
                                            <td>It Service 1</td>
                                            <td>1000</td>
                                            <td></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="bg-gray">1000</td>
                                        </tr>
                                        <tr>
                                            <td>It Service 2</td>
                                            <td>600</td>
                                            <td></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="bg-gray">600</td>
                                        </tr>
                                        <tr>
                                            <td>Data</td>
                                            <td>0</td>
                                            <td></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="bg-gray">0</td>
                                        </tr>

                                        <tr>
                                            <td>Domain</td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td>Hosting</td>
                                            <td colspan="4"></td>
                                        </tr>

                                        <tr>
                                            <td>OTC</td>
                                            <td colspan="2">0</td>
                                        </tr>
                                        <tr>
                                            <td>Real IP</td>
                                            <td colspan="2">0</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                            <div class="col-sm-3">
                                <table class="table table-responsive table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Link ID:</td>
                                            <td>CN_210531_665</td>
                                        </tr>
                                        <tr>
                                            <td>Location: </td>
                                            <td>
                                                Gazipur(গাজীপুর) </td>
                                        </tr>


                                        <tr>
                                            <td>Connection Type:</td>
                                            <td>
                                                fiber
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Security Money:</td>
                                            <td>0,250000,,0</td>
                                        </tr>
                                        <tr>
                                            <td>Visited/Phone:</td>
                                            <td>
                                                visited </td>
                                        </tr>
                                        <tr>
                                            <td>Order Submission Date</td>
                                            <td>2021-05-31 00:00:00</td>
                                        </tr>
                                        <tr>
                                            <td>Billing Date:</td>
                                            <td>23</td>
                                        </tr>
                                        <tr>
                                            <td>Bill Start Date:</td>
                                            <td>2021-06-01 00:00:00</td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Date:</td>
                                            <td>2021-05-31 00:00:00</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <div class="col-sm-9">
                                <table class="table table bordered">
                                    <tbody>
                                        <tr>
                                            <td class="bg-gray col-sm-1"></td>
                                            <td class="bg-gray">Internet</td>
                                            <td class="bg-gray">GGC</td>
                                            <td class="bg-gray">FB</td>
                                            <td class="bg-gray">BDIX</td>
                                            <td class="bg-gray">DATA</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-gray">VLAN</td>
                                            <td><input type="text" name="internetvlan" value="1001"></td>
                                            <td><input type="text" name="ggcvlan" value="1002"></td>
                                            <td><input type="text" name="fbvlan" value="1003"></td>
                                            <td><input type="text" name="bdvlan" value=""></td>
                                            <td><input type="text" name="datavlan" value=""></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-gray">IP</td>
                                            <td><input type="text" name="internetip" value="10.11.12.166/30"></td>
                                            <td><input type="text" name="ggcip" value="10.201.0.198/30"></td>
                                            <td><input type="text" name="fbip" value="172.20.9.134/30"></td>
                                            <td><input type="text" name="bdip" value=""></td>
                                            <td><input type="text" name="dataip" value=""></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-gray">ASSIGNED BANDWIDTH</td>
                                            <td><input type="text" name="internetbw" value="400MB"></td>
                                            <td><input type="text" name="ggcbw" value="1000MB"></td>
                                            <td><input type="text" name="fbbw" value="600MB"></td>
                                            <td><input type="text" name="bdbw" value=""></td>
                                            <td><input type="text" name="databw" value=""></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-gray">Real IP</td>
                                            <td><input type="text" name="real_ip_noc" value=""></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-gray">Work Progress: </td>
                                            <td><label style="display: flex;">
                                                    <input value="1" name="work_progress" type="hidden" class="disabled"
                                                        style="" checked="">
                                                    Done</label></td>
                                        </tr>
                                    </tbody>
                                </table>



                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td>MRTG Graph Url/Cpanel Hosting Url</td>
                                            <td>User</td>
                                            <td>Password</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="mrtg" value="#" required=""></td>
                                            <td><input type="text" name="mrtg_user" value="tgnet" required=""></td>
                                            <td><input type="text" name="mrtg_pass" value="circle@tgnet" required="">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm-4 pull-left">
                                <a href="#" class="btn btn-default pull-left" style="border:1px solid red;">Cancel or
                                    Back</a>
                            </div>
                            <div class="col-sm-4 pull-right">
                                <input type="hidden" value="665" name="order_id">

                                <input type="submit" value="Submit" class="btn btn-primary pull-right"
                                    style="width:auto;">
                            </div>
                        </div>

                    </td>
                </tr>


            </tbody>
        </table>

    </form>

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

<style>


    element.style {}

    .table-bordered>thead>tr>th,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>tbody>tr>td,
    .table-bordered>tfoot>tr>td {
        border: 1px solid #f4f4f4;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        border-top: 1px solid #f4f4f4;
    }

    .table-bordered>tbody>tr>td,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>td,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th {
        border: 1px solid #ddd;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 4px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .bg-gray {
        color: #000;
        background-color: #d2d6de !important;
    }

    td,
    th {
        padding: 0;
    }

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    user agent stylesheet td {
        display: table-cell;
        vertical-align: inherit;
    }

    table {
        border-spacing: 0;
        border-collapse: collapse;
    }

    user agent stylesheet table {
        border-collapse: separate;
        text-indent: initial;
        border-spacing: 2px;
    }

    user agent stylesheet table {
        border-collapse: separate;
        text-indent: initial;
        border-spacing: 2px;
    }

    body {
        font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-weight: 400;
        overflow-x: hidden;
        overflow-y: auto;
    }

    body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        background-color: #fff;
    }

    html {
        font-size: 10px;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    html {
        font-family: sans-serif;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }

    :after,
    :before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    :after,
    :before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>

@endpush

@section('vendor-js')
<script src="{{ asset('') }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
<script src="{{ asset('') }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{ asset('') }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page-js')
<script src="{{ asset('') }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
@push('script')

@endpush