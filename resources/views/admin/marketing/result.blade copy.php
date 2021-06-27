<br>
<button onclick="window.print();" class="btn btn-primary noprint"><i class="fa fa-print"></i>
    Print</button>
<caption>
    <h2 class="text-center">03-Jan-2021 to 03-Jan-2021</h2>
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

        {{-- @dd($users) --}}
        {{-- @dd($r) --}}
        {{-- @if ($r->createdBy == $users->id) --}}
        @foreach ($users as $user)
            @foreach ($r as $item)
                @if ($user->id == $item->createdBy)

                    {{-- @if ($item->ctype == 'new') --}}
                    {{-- @dd('new') --}}
                    {{-- @elseif($item->ctype == 'followup') --}}
                    {{-- @dd('followup') --}}
                    {{-- @elseif($item->ctype == 'reconnect')
                        @dd('reconnect')
                    @endif --}}


                    {{-- @endforeach
                    @endforeach --}}
                    <tr class="">
                        <td></td>
                        <td>
                            @if ($item->ctype == 'new')
                                @php
                                    $sum = 0;
                                @endphp
                                @for ($i = 0; $i < $count; $i++)
                                    {{ $sum += $i }}
                                @endfor

                                {{-- echo $r->where('ctype', 'new')->count(); --}}
                            @endif
                        </td>
                        <td>(10*1) = 10</td>
                        <td>3.3%</td>
                        <td>
                            @if ($item->ctype == 'followup')

                                {{ 'followup' }}
                                {{-- echo $r->where('ctype', 'new')->count(); --}}

                            @endif
                        </td>
                        <td>(8*1) =8</td>
                        <td>0%</td>
                        <td>
                            @if ($item->ctype == 'reconnect')

                                {{ 'reconnect' }}

                            @endif
                        </td>
                        <td>(5*1)= 5</td>
                        <td>19.8%</td>
                        <td>23.1%</td>
                    </tr>


                @endif
            @endforeach
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
        @foreach ($r as $item)
            <tr>
                <td rowspan="4" style="width: 82px">{{ $item->name }}</td>
            </tr>

            <tr>
                <td>New Client</td>
                <td>1</td>
                <td></td>
                <td>1</td>
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
                <td>Followup</td>
                <td>2</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>4</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Reconnect</td>
                <td></td>
                <td></td>
                <td></td>
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
