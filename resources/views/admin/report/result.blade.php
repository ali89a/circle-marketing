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
                <th>Contact By</th>
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
               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>