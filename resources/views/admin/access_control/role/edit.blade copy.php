@extends('admin.layouts.master')

@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-users" aria-hidden="true"></i>Role </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        {{-- <li class="breadcrumb-item"><a href="#">Blank Page</a></li>--}}
    </ul>
</div>
<div class="tile">

    <form action="{{route('role.update',$model)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="tile-title-w-btn">
            <h3 class="title">Edit Role</h3>
            <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('role.index')}}"><i class="fa fa-list"></i>See
                    List</a></p>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input class="form-control" name="name" value="{{$model->name}}" type="text" placeholder="Enter Role Name">
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Permission:</strong><br><br>
                <div class="row">
                    @foreach($permission as $value)
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
              <button type="submit" class="btn btn-success float-right">Submit</button>
            </div>
        </div>

    </form>

</div>

@endsection
@push('script-bottom')



@endpush