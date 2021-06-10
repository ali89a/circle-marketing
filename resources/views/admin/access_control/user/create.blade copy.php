@extends('admin.layouts.master')

@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-users" aria-hidden="true"></i>User</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home fa-lg"></a></i></li>
        <li class="breadcrumb-item">User Create</a></li>
    </ul>
</div>
<div class="tile">
    <form action="{{route('admin.store')}}" method="POST" class="form-group">
        @csrf
        <div class="tile-title-w-btn">
            <h3 class="title">Create New User</h3>
            <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('admin.index')}}"><i class="fa fa-list"></i>See
                    List</a></p>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input class="form-control" name="name" type="text" placeholder="Enter Name">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" name="email" type="text" placeholder="Enter Email">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label">password</label>
                    <input class="form-control" name="password" type="password" placeholder="Enter password">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label">password_confirmation</label>
                    <input class="form-control" name="password_confirmation" type="password" placeholder="Enter password_confirmation">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label">Roles</label>
                    <select class="form-control demoSelect" name="roles[]" id="demoSelect" multiple="">
                        @forelse($roles as $role)
                        <option value="{{$role}}">{{$role}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
        </div>



        <button type="submit">Submit</button>
    </form>


</div>
</section>
<!-- /.content -->


@endsection
@section('js')
<script type="text/javascript" src="{{ asset('assets')}}/js/plugins/select2.min.js"></script>
@endsection
@push('script')

<script type="text/javascript">
    $('#demoSelect').select2();
</script>
@endpush