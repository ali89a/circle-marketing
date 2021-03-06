@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Admin</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Admin Edit
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('admin.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Admin Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.update',$admin->id)}}" method="POST" class="" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" value="{{$admin->name}}" name="name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" value="{{$admin->email}}" name="email" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="password_confirmation">Password Confirmation</label>
                                            <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password Confirmation">
                                        </div>
                                    </div>

                                    @can('admin-edit')
                                    <div class="col-md-6 mb-1">
                                        <label>Role</label>
                                        {!! Form::select('roles[]', $roles,$selected_roles ?? '', array('class' => 'form-control')) !!}
                                    </div>
                                    @endcan

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label for="profile">Profile Image</label>
                                                    <input type="file" class="form-control" id="profile" name="profile_image">
                                                </div>
                                                <div class="col-md-4">                                                    
                                                    @if($admin->admininfo->profile_image)
                                                        <img style="width:100px" src="{{asset('storage/Admins/'.$admin->admininfo->profile_image)}}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile"  value="{{$admin->admininfo->mobile}}">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="alternet_mobile">Alternet Mobile</label>
                                            <input type="text" class="form-control" id="alternet_mobile" name="alternet_mobile" placeholder="Enter Alternet Mobile"  value="{{$admin->admininfo->alternet_mobile}}">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control textarea" name="address" id="address">{{$admin->admininfo->address}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="signature">Signature</label>
                                            <textarea class="form-control textarea" name="signature" id="signature">{{$admin->admininfo->signature}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="active">Active</label>
                                            <select name="isActive" class="form-control">
                                                <option value="">Select User Status</option>
                                                <option value="1" {{ $admin->isActive===1?'selected':''}}>Active</option>
                                                <option value="0" {{ $admin->isActive===0?'selected':''}}>Disable</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection
@section('css')

@endsection
@section('js')

@endsection
@push('script')

@endpush