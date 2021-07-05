<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style type="text/css">
        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }

    </style>
</head>

<body onload="window.print()" onfocus="window.close()">
    <style>
        @media print {
            thead th {
                font-size: 15px !important;
                border: 1px solid #ddd;
            }

            #pop,
            button,
            a {
                visibility: hidden;
            }

            table {
                /* width: ; */
            }

            table,
            tr,
            thead th,
            td {
                font-size: 9px !important;
                padding: 2px !important;
                border: 1px solid #010a02;
                border-collapse: collapse;
            }
        }

        .container {
            width: 940px;
            margin: 0 auto;
            padding: 10px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #4CAF50;
        }

        h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #bbb;
            padding: 10px;
            text-align: left;
        }

        tr:hover {
            background-color: #e5e5e5
        }

    </style>

    <div class="content-wrapper">
        <div class="content-body">
            <section class="modern-horizontal-wizard">
                <div class="bs-stepper wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">
                        <div class="card box">
                            <div class=" card-body box-body">
                                <div class="col-md-12" style="margin-bottom:15px;">

                                </div>
                                <div class="col-md-2">
                                    {{-- <button class="btn btn-primary form-control" onclick="window.print()">Print</button> --}}

                                    <a class="btn btn-primary form-control" href="{{ route('printReport') }}"
                                        target="_blank">
                                        <i class="fa fa-print"></i> Print
                                    </a>
                                </div>
                                <br>
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
                                            </tr>
                                            @foreach ($reports as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        @if ($item->status == 'approved')
                                                            Approved

                                                        @elseif($item->status == 'canceled')
                                                            Canceled

                                                        @elseif($item->ctype == 'followup')
                                                            Approved

                                                        @elseif($item->ctype == 'reconnect')
                                                            Approved

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
                                                    <td>
                                                        @if (!empty($item->visiting_card))
                                                            @if ($extension = pathinfo(storage_path('storage/visitingCard/' . $item->visiting_card) == 'pdf'))
                                                                <embed
                                                                    src="{{ asset('storage/visitingCard/' . $item->visiting_card) }}"
                                                                    width="100px" height="100px" />
                                                            @else
                                                                <img class="img-fluid"
                                                                    style="width:100px; height: 100px;"
                                                                    src="{{ asset('storage/visitingCard/' . $item->visiting_card) }}"
                                                                    alt="No Image">
                                                            @endif
                                                        @else
                                                            <h6>Not Found</h6>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function() {
            window.print();
        }
        window.onfocus = function() {
            window.close();
        }
    </script>
</body>

</html>
