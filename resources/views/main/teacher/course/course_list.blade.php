@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">

@if(Session::has('syllabus-added'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Course Syllabus</div>
            <div class="toast-message">{{Session::get('syllabus-added')}}</div>
        </div>
    </div>
@endif
@if(Session::has('send_student_mark'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Done</div>
            <div class="toast-message">{{Session::get('send_student_mark')}}</div>
        </div>
    </div>
@endif
@if(Session::has('resubmit_assignment'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Done</div>
            <div class="toast-message">{{Session::get('resubmit_assignment')}}</div>
        </div>
    </div>
@endif
@if(Session::has('reject_assignment'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Done</div>
            <div class="toast-message">{{Session::get('reject_assignment')}}</div>
        </div>
    </div>
@endif

@if(Session::has('assignment-added'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Assignment</div>
            <div class="toast-message">{{Session::get('assignment-added')}}</div>
        </div>
    </div>
@endif

@if(Session::has('course-photo'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Course Image</div>
            <div class="toast-message">{{Session::get('course-photo')}}</div>
        </div>
    </div>
@endif

<style>

    .font-weight-bold{
        font-size: 1.1rem;
        color: #000;
    }

    .font-weight-bold:hover{
        color: #000;
    }

    .card-icons{
        font-size: 1.5rem !important;
        color: #2d6eb4 !important;
        margin-top: .7rem;
    }

    .card-icons:hover{
        color: #000 !important;
    }

    .card-image{
        width: 100%;
        height: 11rem;
    }

    .course{
        /* box-shadow: 0px 4px 25px 0px rgb(0 0 0 / 10%); */
        transition: all .3s ease-in-out;
    }

    .course:hover{
        transform: translateY(-5px);
        /* box-shadow: 0 4px 25px 0 rgb(0 0 0/ 25%); */
    }

    .dropdown .fa-ellipsis-v{
        border: none !important;
        background: none !important;
    }

    .dropdown .fa-ellipsis-v:hover{
        background-color: #bec1c563 !important;
        border-color: #bec1c563 !important;
    }
</style>

<div class="col-md-12 course-list p-0">
    <div class="row">
        @foreach($courses as $cor)
            <div class="col-md-4 course mb-1">
                <div>
                    <div class="dropdown d-flex justify-content-end">
                        <button type="button" class="btn btn-primary dropdown-toggle fas fa-ellipsis-v position-absolute mt-1 mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item new_department" href="#"><i class="mdi mdi-image-move"></i>
                            <span class="course-change-photo" data="{{$cor->tc_id}}">Change Photo</span></a>
                        </div>
                    </div>
                    @if($cor->photo != '')
                        <img class="card-image" src="storage/app/course/course-picture/{{$cor->photo}}" />
                    @else
                        <img class="card-image" src="{{ asset('public/app-assets/images/slider/04.jpg')}}" />
                    @endif
                </div>
                <div class="p-1 bg-white">
                    <a href="#!" data-id="{{$cor->course->co_id}}" data-sem="{{$cor->sem_id}}" class="font-weight-bold course-detilas">{{$cor->course->co_name}} - <span style="color: #2d6eb4;">Semester {{$cor->sem_id}} </span></a>
                    <div class="d-flex justify-content-around">
                        <a href="" class="card-icons"><i class="mdi mdi-bullhorn-outline"></i></a>
                        <a href="" class="card-icons"><i class="mdi mdi-clipboard-text-outline"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div id="course-details"></div>

<div class="modal-primary mr-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="change-course-image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary white">
                    <h5 class="modal-title" id="myModalLabel160">Change Course Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('update_picture_course') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tc-id" id="tc-id">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div id="file-upload0" class="section">
                                <div class="row section">
                                    <div class="col s12 m8 l9">
                                        <label for="basicInputFile">Please Attach Course Image.!</label>
                                        <input type="file" name="file" class="dropify" data-max-file-size="2M" data-height="100" data-allowed-file-extensions="jpg JPG jpeg JPEG png PNG" />
                                    </div>
                                </div>
                                <h6 class="assign-file-error error_message">
                                    Attach Course Image.!
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="change-course-image" value="Change">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>

    @section('script')
        <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
        <script src="{{asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
        <script>
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            $('.course-detilas').click(function() {
                let id = $(this).attr('data-id');
                let sem = $(this).attr('data-sem');
                $.get("{{ route('get-course-details') }}/" + id + "/" + sem, function(response) {
                    $('.course-list').hide();
                    $('#course-details').html(response);
                });
            });

            $(document).on('click', '.back-to-courses', function(){
                $('#course-details').empty();
                $('.course-list').show();
            });

            $('.course-change-photo').click(function(){
                $('#tc-id').val($(this).attr('data'));
                $('#change-course-image-modal').modal('show');
            });

            setTimeout(function() {
                $('.toast_message').fadeOut('slow');
            }, 3000);

            function loadPage()
            {
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }

            let fileError = true;
            $('.dropify').change(function () {
                fileValidate();
            });

            function fileValidate() {
                let shift = $('.dropify').val();
                if (shift == '') {
                    $('.assign-file-error').show();
                    fileError = false;
                    return false;
                } else {
                    $('.assign-file-error').hide();
                    fileError = true;
                }
            }

            $('#change-course-image').click(function(){
                fileValidate();

                if((fileError == true)){
                    return true;
                }else{
                    return false;
                }
            });
        </script>
    @endsection

@endsection