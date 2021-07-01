 {{-- style="overflow-y:scroll;" --}}
 <div class="col-md-12 orderlist">
     <table class="table table-bordered table-striped table-responsive">
         <tbody>
             <tr>
                 <th>ID</th>
                 <th>Action</th>
                 <th>Issue Status</th>
                 <th>Current<br> Status</th>
                 <th>Customer</th>
                 <th>Client Type</th>
                 <th>Mobile</th>
                 <th>Uplink POP</th>
                 <th>Issue Type</th>
                 <th>Issue Details</th>
                 <th>Issue Start Date</th>
                 <th>Assigned to</th>
                 <th>Create Date</th>
                 <th>Created By</th>
                 <th>Remark</th>
                 <th>Feedback</th>
                 <th>Rating</th>
                 <th>Review</th>
             </tr>
             @foreach ($crms as $item)
                 <tr>
                     <td>{{ $item->id }}</td>
                     <td>
                         <a href="{{ route('crmModify', ['id' => $item->id]) }}"
                             class="btn btn-success btn-circle col-sm">Modify
                             <i class="fas fa-check"></i>
                         </a>
                     </td>
                     <td>
                         @if ($item->issue_type == 'no_issue' || $item->issue_type == 'not_responding')
                             <a href="#" class="btn btn-danger btn-circle col-sm">Closed
                                 <i class="fas fa-check"></i>
                             </a>
                         @else
                             <a href="#" class="btn btn-warning btn-circle col-sm">Pending
                                 <i class="fas fa-check"></i>
                             </a>
                         @endif
                     </td>
                     <td></td>
                     <td>{{ $item->userName }}</td>
                     <td>{{ $item->client_type }}</td>
                     <td>{{ $item->mobile }}</td>
                     <td>{{ $item->uplink }}</td>
                     <td>{{ $item->issue_type }}</td>
                     <td>{{ $item->issue_details }}</td>
                     <td>{{ date('d-M-Y g:i: a ', strtotime($item->start_date)) }}</td>
                     <td>{{ $item->adminName }}</td>
                     <td>{{ date('d-M-Y g:i: a ', strtotime($item->created_at)) }}</td>
                     <td>{{ $item->adminName }}</td>
                     <td>{{ $item->remark }}</td>
                     <td></td>
                     <td></td>
                     <td></td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
