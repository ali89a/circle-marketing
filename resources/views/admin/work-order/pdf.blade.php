<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $invoice->invoice_no ?? 'Invoice' }} </title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        td,
        th {
            border: 1px solid #08010C;
        }

        .bb-none {
            border-bottom: 2px solid transparent;
        }

        .br-none {
            border-right: 2px solid #fff;
        }

        .bt-none {
            border-top: 2px solid #fff;
        }

        .bl-none {
            border-left: 2px solid #fff;
        }

        .tc {
            text-align: center;
        }

        .tr {
            text-align: right;
        }

        body {
            font-family: bangla;
            font-size: 13px;
            background-color: red;
        }

        .fs {
            font-size: 12px;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        .gtc {
            text-align: center;
            border-radius: 15px;
        }

        .sgtc {
            background-color: green;
            color: white;
            font-size: 20px;


        }

        .page-break {
            page-break-after: always;
        }
    </style>

</head>

<body>

    <htmlpageheader name="page-header">
        <table style="border: 2px solid #fff;">
            <tr>
                <td class="tc bb-none">
                    Circle Network
                </td>
            </tr>
            <tr>
                <td class="tc" style="font-size: 10px;">
                    Address : 17/1, Monipuripara, Sangshad Avenue, Dhaka-1215
                </td>
            </tr>
        </table>

    </htmlpageheader>
    <br>
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="tc bb-none">
                <p style="font-size: 10px;" class="tc">INVOICE NO# {{ $invoice->invoice_number }}</p>
            </td>
        </tr>
    </table>
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="tc bb-none">
                <p style="font-size: 10px;">D&T: {{ $invoice->created_at }}</p>
            </td>
        </tr>
        <tr>
            <td class="tc" style="border-bottom: 1px solid #000">
                <p style="font-size: 10px;">Served By: {{ $invoice->user->name ?? '' }}</p>
            </td>
        </tr>
    </table>
    <br>
    <table style="border: 2px solid #000;">
        <tr>
            <th class="py-1">Description of Charges</th>
            @can('price-show')
            <th class="py-1">Unit Price</th>
            @endcan
            <th class="py-1">Amount</th>
        </tr>
        @php
        $subtotal=0;
        @endphp
        @foreach($invoice->items as $item)
        <tr>

            <td class="py-1">
                <p class="card-text font-weight-bold">{{ $item->invoice_description }}</p>
            </td>
            @can('price-show')
            <td class="py-1">
                <span class="font-weight-bold">{{ $item->unit_price }}</span>
            </td>
            @endcan
            <td class="py-1">
                <span class="font-weight-bold">{{ $item->amount }}</span>
            </td>
        </tr>
        @php
        $subtotal= $subtotal+$item->amount;
        @endphp
        @endforeach

        <tr>

            <td class="py-1" colspan="2">
                <p class="card-text font-weight-bold">Real IP</p>
            </td>
            <td class="py-1">
                <span class="font-weight-bold">{{ $invoice->real_ip }}</span>
            </td>
        </tr>

    </table>
    <htmlpagefooter name="page-footer">
        <p style=" font-size: 14px;" class="tc">Thank You...........</p>
    </htmlpagefooter>
</body>

</html>