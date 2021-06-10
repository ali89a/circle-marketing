@extends('admin.layouts.master')

@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-users" aria-hidden="true"></i> Role</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home fa-lg"></a></i></li>
        <li class="breadcrumb-item">Role List</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="tile">
            <div>
                <a href="{{route('role.create')}}" class="btn btn-primary btn-sm float-right mb-2"><i
                        class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</a>
            </div>

            <div class="tile-body">

                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Guard Name</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name}}</td>
                                <td>{{ $row->guard_name}}</td>

                                <td>
                                    {{--                                            @can('Role Edit')--}}
                                    <div class="btn-group">
                                        <a href="{{ route('role.edit', $row) }}" class="btn btn-success btn-sm">
                                            {{--                                                        <i class="fa fa-pencil-square-o"></i>--}}
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('role.destroy',$row->id)}}"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button data-name="{{ $row->name }}" type="submit"
                                                class="btn btn-danger btn-sm delete-confirm">
                                                <i class="fa fa-lg fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                    {{--                                            @endcan--}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable();
</script>
@endsection
@push('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- page script -->
<script>
    $('.delete-confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete ${name}?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
</script>
@endpush