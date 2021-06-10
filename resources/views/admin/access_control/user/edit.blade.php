@extends('admin.layouts.master')

@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-users" aria-hidden="true"></i>User</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home fa-lg"></a></i></li>
        <li class="breadcrumb-item">User Edit</a></li>
    </ul>
</div>
<div class="tile">
    <form action="{{route('user.update',$user->id)}}" method="POST" class="form-group">
        @csrf
        @method('put')
        <div class="tile-title-w-btn">
            <h3 class="title">Edit User</h3>
            <p>
                <a class="btn btn-primary btn-sm icon-btn" href="{{route('user.index')}}"><i class="fa fa-list"></i>See
                    List</a>
            </p>
        </div>

        {{ Form::text('name', null, $user->name, ['class'=>'form-control input-sm']) }}
        {{ Form::text('email', null,  $user->email, ['class'=>'form-control input-sm']) }}
        {{ Form::password('password', null, ['class'=>'form-control input-sm']) }}
        {{ Form::password('password_confirmation', null, ['class'=>'form-control input-sm']) }}
        {{ Form::select('roles[]', 'Roles', $roles, $selected_roles ?? '', ['class'=>'form-control input-sm demoSelect']) }}

        {{ Form::submit('Submit') }}
    </form>


</div>
@endsection
@section('js')
<script type="text/javascript" src="{{url(asset('assets/js/plugins/bootstrap-datepicker.min.js'))}}'))}}">
</script>
<script type="text/javascript" src="{{url(asset('assets/js/plugins/select2.min.js'))}}"></script>
<script type="text/javascript" src="{{url(asset('assets/js/plugins/bootstrap-datepicker.min.js'))}}"></script>
<script type="text/javascript">
    $('#sl').on('click', function () {
            $('#tl').loadingBtn();
            $('#tb').loadingBtn({text: "Signing In"});
        });

        $('#el').on('click', function () {
            $('#tl').loadingBtnComplete();
            $('#tb').loadingBtnComplete({html: "Sign In"});
        });

        $('#demoDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

        $('#demoSelect').select2();
</script>
@endsection