<br>
<button onclick="window.print();" class="btn btn-primary noprint"><i class="fa fa-print"></i>
    Print</button>
<caption>
    <h2 class="text-center">{{ $from->format('d M Y') }} to {{ $to->format('d M Y') }}</h2>
</caption>
<table class="table table-bordered table-stripd ana">
    <tbody>
        <tr>
            <th>Name</th>
            <th>Newclient<br> Achieve/ local</th>
            <th>Newclient<br> Limit</th>
            <th>Newclient %</th>
            <th>Flowup/<br>Factory Visit<br> Achieve</th>
            <th>Flowup/<br>Factory Visit<br> Limit</th>
            <th>Flowup/<br>Factory Visit %</th>
            <th>Reconnect<br> Achieve/ Call </th>
            <th>Reconnect<br> Limit</th>
            <th>Reconnect %</th>
            <th>Total</th>
        </tr>
        {{-- @dd($total) --}}
        {{-- @dd($users) --}}
        {{-- @dd($r) --}}


        @foreach ($total as $item)

            <tr class="">
                <td> {{ $item['name'] }}</td>
                <td>
                    {{ $item['new'] }}
                </td>
                <td>
                    @php
                        $result = 1;
                        $result = $item['newclient']->newclient * $different_days;
                    @endphp
                    {{ $item['newclient']->newclient }} * {{ $different_days }} = {{ $result }}
                </td>
                <td>
                    @php
                        $result1 = $item['new'] * 33;
                        $result2 = $item['newclient']->newclient * $different_days;
                        $result3 = $result1 / $result2;
                    @endphp
                    {{ number_format((float) $result3, 2, '.', '') }}%
                </td>
                <td>
                    {{ $item['followup'] }}
                    {{-- echo $r->where('ctype', 'new')->count(); --}}
                </td>
                <td>
                    @php
                        $result = 1;
                        $result = $item['followupclient']->followupclient * $different_days;
                    @endphp
                    {{ $item['followupclient']->followupclient }} * {{ $different_days }} = {{ $result }}
                </td>
                <td>
                    @php
                        $result1 = $item['followup'] * 33;
                        $result2 = $item['followupclient']->followupclient * $different_days;
                        $result4 = $result1 / $result2;
                    @endphp
                    {{ number_format((float) $result4, 2, '.', '') }}%
                </td>
                <td>
                    {{ $item['reconnect'] }}
                </td>
                <td>
                    @php
                        $result = 1;
                        $result = $item['reconnectclient']->reconnectclient * $different_days;
                    @endphp
                    {{ $item['reconnectclient']->reconnectclient }} * {{ $different_days }} = {{ $result }}
                </td>
                <td>
                    @php
                        $result1 = $item['reconnect'] * 33;
                        $result2 = $item['reconnectclient']->reconnectclient * $different_days;
                        $result5 = $result1 / $result2;
                    @endphp
                    {{ number_format((float) $result5, 2, '.', '') }}%
                </td>
                <td>
                    @php
                        $sum = $result3 + $result4 + $result5;
                    @endphp
                    {{ number_format((float) $sum, 2, '.', '') }}%
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>
<br>


<table class="table table-bordered tableisp table-stripd table-condensed table-responsive">
    <tbody>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Client Type</th>
            <th class="text-center" colspan="12">ISP Type</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>Cat A</th>
            <th>Cat B</th>
            <th>Cat C</th>
            <th>South</th>
            <th>North</th>
            <th>West</th>
            <th>Central</th>
            <th>Nationwide</th>
            <th>Non license</th>
            <th>Home</th>
            <th>Corporate</th>
            <th>Others</th>
        </tr>

       

        @foreach ($total as $r)
            {{-- @dd($total) --}}

            <tr>
                <td rowspan="4" style="width: 82px">
                    {{ $r['name'] }}
                </td>
            </tr>
            <tr>
                <td>New Client</td>
                <td>
                    {{ $r['new1'] }}
                </td>
                <td>
                    {{ $r['new2'] }}
                </td>
                <td>
                    {{ $r['new3'] }}
                </td>
                <td>
                    {{-- {{ $r['south_zonal'] }} --}}
                </td>
                <td>
                    {{-- {{ $r['north_zonal'] }} --}}
                </td>
                <td>
                    {{-- {{ $r['west_zonal'] }} --}}
                </td>
                <td>
                    {{-- {{ $r['central_zonal'] }} --}}
                </td>
                <td>
                    {{-- {{ $r['nationwide'] }} --}}
                </td>
                <td>
                    {{-- {{ $r['local'] }} --}}
                </td>
                <td>
                    {{-- {{ $r['corporate'] }} --}}
                </td>
                <td>
                    {{-- {{ $r['non_license'] }} --}}
                </td>
                <td>
                    {{-- {{ $r['others'] }} --}}
                </td>
            </tr>
            {{-- @endif --}}

            <tr>
                <td>Followup</td>
                <td>
                    {{ $r['follow1'] }}
                </td>
                <td> {{ $r['follow2'] }}</td>
                <td> {{ $r['follow3'] }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Reconnect</td>
                <td>
                    {{ $r['reconnect1'] }}
                </td>
                <td> {{ $r['reconnect2'] }}</td>
                <td> {{ $r['reconnect3'] }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>


        @endforeach
    </tbody>
</table>
