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
        <div class="card">
            <div class="card-body">

            
        <form action="{{route('support-ticket.store')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col-md-12">
                    
                    <label for="customer">Select Customer</label>
                    <select name="customer_id" id="customer" class="select2 form-control">
                        <option value="">Select Customer</option>

                        @foreach($customers as $row)
                        <option value="{{$row->id}}" {{old('customer_id')==$row->id ?'selected':''}}>{{$row->name}} - {{$row->email}} ({{$row->phone}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="cc">CC Recipients</label>
                    <input type="text" name="cc" id="cc" class="form-control" value="{{old('cc')}}">
                    
                </div>
                <div class="col-md-12">
                    <label for="subject">Subject</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                    
                </div>

                <div class="col-md-4">
                        <label for="category">Category</label>
                        <select name="category_id" id="category" class="select2 form-control" required>
                            <option value="">Select Problem Type</option>
                            @foreach($categories as $row)
                            <option value="{{$row->id}}"  {{old('category_id')==$row->id ?'selected':''}} >{{$row->name}}</option>
                            @endforeach                        
                       </select>    
                </div>
                <div class="col-md-4">
                    <label for="priority">Priority</label>
                    <select name="priority_id" id="priority" class="select2 form-control">
                        <option value="">Select Priority</option>
                        @foreach($priorities as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach                        
                   </select> 
                </div>
                
                <div class="col-md-12">
                    <label for="message">Message</label>
                    <textarea name="problem_details" class="form-control" style="height:200px">{{old('problem_details')}}</textarea>
                </div>
                <div class="col-md-12 mt-2">
                        <button class="btn btn-info" type="button" id="addAttachment"><i class="fa fa-attachment"></i> Attachments</button>                        
                        <p>Valid file type: jpg, jpeg, gif, png and File size max: 2 MB.</p>

                        <div id="attachmentWrap" class="coattachmentl-md-8">
                            <p id="maximumMsg" class="text-danger mt-2 hidden">
                                You can add maximum 5 attachments.
                            </p>

                            
                        
                    </div>
                    
                </div>

                <div class="col-md-12">
                    <div class="form-group float-right">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </div>



            </div>
        
        </form>
    </div>
</div>
    </div>
</div>
@endsection
@section('js')

@endsection
@push('script')


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    span.select2-selection__arrow {
    display: none;
}
</style>
<script>

$(document).ready(function() {
    $('.select2').select2();
});


    // Add attachment field
    $('#addAttachment').click(function(){

        let attachments_count = $('.single_attachment').length+1;

        if (attachments_count <= 5){
            $("#attachmentWrap").append('<div class="single_attachment mb-1"><div data-repeater-item="" class="row m-b-15"><div class="col-6"><div class="custom-file"><input name="attachments[]" onchange="loadImage(this)" type="file" required></div></div><div class="col-2"><button onclick="removeImageField(this)" data-repeater-delete="" class="btn btn-danger btn-xs waves-effect waves-light" type="button"><i class="ti-close"></i>X</button></div></div></div>');
        }else {
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
        let limit = 1024*1024*2; //2 MB
        if(file['size'] > limit){
            alert('You are uploading a large file. Maximum file size is 2 MB.');
            $(e).closest('form').get(0).reset();
            return;
        }

     
    }
</script>

@endpush