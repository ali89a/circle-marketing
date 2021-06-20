<div class="col-md-12 orderlist" style="overflow-y:scroll;">
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
                <th>Record File</th>
            </tr>
            @foreach ($r as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    @if ($item->ctype == 'new')
                    @can('report-approve')
                    <a href="{{ route('approve', ['id' => $item->id]) }}"
                        class="btn btn-success btn-circle col-sm">Approve
                        <i class="fas fa-check"></i>
                    </a>
                    @endcan
                    <a href="#" class="mt-1 btn btn-primary btn-circle col-sm">Pending
                        <i class="fas fa-check"></i>
                    </a>
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
                    <img class="img-fluid" style="width:100px; height: auto;"
                        src="{{ asset('storage/visitingCard/' . $item->visiting_card) }}" alt="No Image">
                </td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <div class="audiofile">
                        <audio controls="">
                            <source src="{{ asset('storage/audio/' . $item->audio) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>