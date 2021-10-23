
@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">

@if(Session::has('assignment_submitted'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Done</div>
            <div class="toast-message">{{Session::get('assignment_submitted')}}</div>
        </div>
    </div>
@endif
@if(Session::has('assignment_not_submitted'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-warning" aria-live="polite" style="display:block;">
            <div class="toast-title">Warning</div>
            <div class="toast-message">{{Session::get('assignment_not_submitted')}}</div>
        </div>
    </div>
@endif

@if(Session::has('resubmited'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Resubmited</div>
            <div class="toast-message">{{Session::get('resubmited')}}</div>
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
@if(! $all_course->isEmpty())
<div class="col-md-12 course-list p-0">
    <div class="row">
        @foreach($all_course as $cor)
        <div class="col-md-4 course mb-1">
            <div>
                <img class="card-image" src="{{ asset('public/app-assets/images/slider/04.jpg')}}" />
            </div>
            <div class="p-1 bg-white">
                <a href="#!" data-id="{{$cor->course->co_id}}" data-sem="{{$cor->sem_id}}" class="font-weight-bold course-detilas">{{$cor->course->co_name}}</a>
                <div class="d-flex justify-content-around">
                    <a href="" class="card-icons"><i class="mdi mdi-bullhorn-outline"></i></a>
                    <a href="" class="card-icons"><i class="mdi mdi-clipboard-text-outline"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
    <div>
        <div class="alert alert-warning text-center" role="alert">
            <p class="mb-0">You have not selected any credit yet. Please select your credits.</p>
        </div>
    </div>
@endif
<div id="course-details">

</div>


    @section('script')
        <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
        <script>
            $('.course-detilas').click(function() {
                let id = $(this).attr('data-id');
                let sem = $(this).attr('data-sem');
                $.get("{{ route('student_get_course_details') }}/" + id+ "/" + sem, function(response) {
                    $('.course-list').hide();
                    $('#course-details').html(response);
                });
            });

            $(document).on('click', '.back-to-courses', function(){
                $('#course-details').empty();
                $('.course-list').show();
            });

            setTimeout(function() {
                $('.toast_message').fadeOut('slow');
            }, 5000);
        </script>
    @endsection

@endsection