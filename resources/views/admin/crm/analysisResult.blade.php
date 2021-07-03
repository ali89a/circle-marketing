<br>
<button onclick="window.print();" class="btn btn-primary noprint"><i class="fa fa-print"></i>
    Print</button>
<caption>
    <h2 class="text-center">{{ $from->format('d M Y') }} to {{ $to->format('d M Y') }}</h2>
</caption>
<table class="table table-bordered table-stripd ana">
    <tbody>
        <tr>
            <th>MAC</th>
            <th>MAC<br> Limit</th>
            <th>MAC %</th>
            <th>Bandwidth</th>
            <th>Bandwidth<br> Limit</th>
            <th>Bandwidth %</th>
            <th>Corporate</th>
            <th>Corporate<br> Limit</th>
            <th>Corporate %</th>
            <th>Local</th>
            <th>Local<br> Limit</th>
            <th>Local %</th>
            <th>Total</th>
        </tr>
        <tr class="">

            <td>
                {{ $total['mac'] }}
            </td>
            <td>
                @php
                    $result = 1;
                    $result = $total['mlimit']->mlimit * $different_days;
                @endphp
                {{ $total['mlimit']->mlimit }}
                {{-- * {{ $different_days }} = {{ $result }} --}}
            </td>
            <td>
                @php
                    $result1 = $total['mac'] * 25;
                    $result2 = $total['mlimit']->mlimit * $different_days;
                    $result3 = $result1 / $result2;
                @endphp
                {{ number_format((float) $result3, 2, '.', '') }}%
            </td>
            <td>
                {{ $total['bandwidth'] }}
            </td>
            <td>
                @php
                    $result = 1;
                    $result = $total['blimit']->blimit * $different_days;
                @endphp
                {{ $total['blimit']->blimit }}
                {{-- * {{ $different_days }} = {{ $result }} --}}
            </td>
            <td>
                @php
                    $result1 = $total['bandwidth'] * 25;
                    $result2 = $total['blimit']->blimit * $different_days;
                    $result4 = $result1 / $result2;
                @endphp
                {{ number_format((float) $result4, 2, '.', '') }}%
            </td>
            <td>
                {{ $total['corporate'] }}
            </td>
            <td>
                @php
                    $result = 1;
                    $result = $total['climit']->climit * $different_days;
                @endphp
                {{ $total['climit']->climit }}
                {{-- * {{ $different_days }} = {{ $result }} --}}
            </td>
            <td>
                @php
                    $result1 = $total['corporate'] * 25;
                    $result2 = $total['climit']->climit * $different_days;
                    $result5 = $result1 / $result2;
                @endphp
                {{ number_format((float) $result5, 2, '.', '') }}%
            </td>
            <td>
                {{ $total['local'] }}
            </td>
            <td>
                @php
                    $result = 1;
                    $result = $total['llimit']->llimit * $different_days;
                @endphp
                {{ $total['llimit']->llimit }}
                {{-- * {{ $different_days }} = {{ $result }} --}}
            </td>
            <td>
                @php
                    $result1 = $total['corporate'] * 25;
                    $result2 = $total['llimit']->llimit * $different_days;
                    $result6 = $result1 / $result2;
                @endphp
                {{ number_format((float) $result5, 2, '.', '') }}%
            </td>
            <td>
                @php
                    $sum = $result3 + $result4 + $result5 + $result6;
                @endphp
                {{ number_format((float) $sum, 2, '.', '') }}%
            </td>

        </tr>

    </tbody>
</table>
