@extends('admin.layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{$title}}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Open New Ticket
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
                        <a class="dropdown-item" href="{{route('support-ticket.create')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">Add New Ticket</span></a>
                      
                        
                      
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
                    
                    <div class="table-responsive table-striped">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    
                                    <th scope="col" class="text-nowrap">Date Opened</th>
                                    <th scope="col" class="text-nowrap">Subject</th>
                                    <th scope="col" class="text-nowrap">Last Response</th>
                                    <th scope="col" class="text-nowrap">Priority</th>
                                    <th scope="col" class="text-nowrap">Status</th>
                                    <th scope="col" class="text-nowrap">Category</th>
                                    <th scope="col" class="text-nowrap text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $row)
                                
                                <tr onclick="window.location='{{route('support-ticket.show',$row->id)}}'" style="cursor:pointer">
                                    <td class="text-nowrap">{{ $row->created_at }}</td>
                                    <td>#{{ $row->id }} - {{ $row->title }}</td>
                                    <td>
                                        @if($row->created_at >= $row->updated_at || empty($row->updated_at))
                                        Unresponded </td>
                                        @else
                                            {{ $row->updated_at->diffForHumans() }}</td>
                                        @endif
                                        
                                        
                                    <td style="background:{{$row->priority->color}}">{{ $row->priority->name }}</td>
                                    <td style="background:{{$row->status->color}}">{{ $row->status->name }}</td>
                                    <td>{{ $row->category->name }}</td>
                                    <td>
                                        <div class="float-right">
                                            <a href="{{ route('support-ticket.show', $row->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-square-o"></i>
                                                View Details
                                            </a>

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