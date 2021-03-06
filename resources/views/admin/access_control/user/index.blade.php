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
                            <li class="breadcrumb-item active">Admin List
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
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        <a class="dropdown-item" href="{{route('admin.create')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">Add Admin</span></a>
                      
                        
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Admin List</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">#</th>
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col" class="text-nowrap">Email</th>
                                    <th scope="col" class="text-nowrap">Suspended</th>
                                    <th scope="col" class="text-nowrap">Role</th>
                                    <th scope="col" class="text-nowrap text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $row)
                                <tr>
                                    <td class="text-nowrap">{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        @if($row->isActive==0)
                                        <span class="alert alert-danger">Suspended</span>
                                        @else
                                        <span class="alert alert-success">Active</span>
                                        @endif
                                    <td>
                                        @if($row->getRoleNames()->isNotEmpty())
                                        <span class="badge badge-success">
                                            {{ $row->getRoleNames()->implode(" ") }}<br>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            @can('admin-edit')
                                            <a href="{{ route('admin.edit', $row->id) }}" class="btn btn-primary">
                                                <i class="fa fa-pencil-square-o"></i>
                                                Edit
                                            </a>
                                            @endcan
                                            
                                            @can('admin-delete')
                                            <form action="{{route('admin.destroy', $row->id)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                
                                                <button id="btnDelete" class="btn btn-danger">Delete</button>
                                            </form>
                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection
@section('js')

@endsection
@push('script')

@endpush