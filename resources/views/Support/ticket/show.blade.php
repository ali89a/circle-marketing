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
                    <button
                        class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light"
                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg
                            xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></button>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        <a class="dropdown-item" href="{{route('support-ticket.create')}}"><svg
                                xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-check-square mr-1">
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
                        <h2 class="page-header">{{$ticket->customer->name}}</h2>
                        {{$ticket->problem_details}}
                    </div>
                </div>
                @if( isset($ticket->ticketComments))

                <div class="page-header">
                    <h3>Ticket Replies</h3>
                </div>

                        @foreach($ticket->ticketComments as $comment)

                        @if($comment->support_id!='')
                            @include('Support.ticket.commentSupport')
                        @else
                            @include('Support.ticket.commentCustomer')
                        @endif
                        
                        @endforeach
                    
                @endif

                <div class="card p-2">

                    <form action="{{route('support-ticket.update',$ticket->id)}}" method="post" class="form"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="form-group">

                            <textarea name="comment" id="editor" style="height:200px" class="textarea form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-info" type="button" id="addAttachment"><i
                                        class="fa fa-attachment"></i> Attachments</button>
                                <p>Valid file type: jpg, jpeg, gif, png and File size max: 2 MB.</p>

                                <div id="attachmentWrap" class="coattachmentl-md-8">
                                    <p id="maximumMsg" class="text-danger mt-2 hidden">
                                        You can add maximum 5 attachments.
                                    </p>



                                </div>

                            </div>
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
                    Status: <span style="background:{{$ticket->status->color}};padding:2px 5px;color:#fff">
                        {{$ticket->status->name}} </span>
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
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    // Add attachment field
    $('#addAttachment').click(function () {

        let attachments_count = $('.single_attachment').length + 1;

        if (attachments_count <= 5) {
            $("#attachmentWrap").append(
                '<div class="single_attachment mb-1"><div data-repeater-item="" class="row m-b-15"><div class="col-6"><div class="custom-file"><input name="attachments[]" onchange="loadImage(this)" type="file" required></div></div><div class="col-2"><button onclick="removeImageField(this)" data-repeater-delete="" class="btn btn-danger btn-xs waves-effect waves-light" type="button"><i class="ti-close"></i>X</button></div></div></div>'
            );
        } else {
            $('#maximumMsg').removeClass('hidden');
        }
    });

    //Remove Image Field
    function removeImageField(e) {
        $(e).parents('.single_attachment').remove();
        $('#maximumMsg').addClass('hidden');
    }

    function loadImage(e) {

        let file = e.files[0];
        let fileName = file.name
        let reader = new FileReader();

        //check valid image type
        let fileType = file["type"];
        let validImageTypes = ["image/jpg", "image/jpeg", "image/gif", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            alert("Invalid image type! Please chose valid image ( JPG, JPEG, PNG, GIF ).");
            $(e).closest('form').get(0).reset();
            return;
        }

        //check image size
        let limit = 1024 * 1024 * 2; //2 MB
        if (file['size'] > limit) {
            alert('You are uploading a large file. Maximum file size is 2 MB.');
            $(e).closest('form').get(0).reset();
            return;
        }


    }
</script>
@endpush