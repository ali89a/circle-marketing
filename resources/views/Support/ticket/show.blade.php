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
                            <li class="breadcrumb-item active">Support Ticket List
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

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="page-header">{{$ticket->user->name}}</h2>
                        {{$ticket->problem_details}}
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3>Ticket Replies</h3>
                    </div>
                </div>

                <div class="card p-2">              

                    <form action="" method="post" class="form">
                        <div class="form-group">

                            <textarea name="comment" class="textarea form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info" type="button"><i class="fa fa-plus"></i> Attachments</button>
                            
                            <p>Valid file type: jpg, jpeg, gif, png and File size max: 2 MB.</p>
                        </div>
                        <button class="btn btn-success float-right" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Ticket Info</h2>
                        <p>Subject</p>
                        <p>#{{$ticket->id}}-{{$ticket->title}}</p>

                    </div>
                </div>

                <div class="pl-2 pb-2">
                    Status: {{$ticket->status->name}}
                </div>

                <div class="card">
                    <div class="card-body">
                        <p>Opened: {{$ticket->created_at}}</p>
                        <hr>
                        <p>Last Response: {{$ticket->updated_at}}</p>
                        <hr>
                        <a href="#reply" class="btn btn-success">Go To Reply</a>
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