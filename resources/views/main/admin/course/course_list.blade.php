@extends('layouts.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">

@if(Session::has('course-add'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Courses</div>
            <div class="toast-message">{{Session::get('course-add')}}</div>
        </div>
    </div>
@endif



<div class="card">
    <div class="card-header d-flex mb-1">
        <h4 class="card-title">Course</h4>
    </div>
    <div class="div-devider"></div>
    <div class="card-content">
        <div class="card-body">
            @can('search-course')
                <div class="row">
                    <div class="col-5">
                        <select class="select2 form-control faculty">
                            <option value="" selected hidden>Select Faculty</option>
                            @foreach($data as $fa)
                                <option value="{{$fa->fac_id}}">{{$fa->fac_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-5">
                        <select class="select2 form-control department">
                            <option value="" selected disabled hidden>(Ex: Computer Scinese, Business)</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button class="search"><i class="feather icon-search"></i> Search</button>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>

<div class="data">

</div>

<form id="search-form" hidden="">
    @csrf
    <input type="text" name="fac" id="fac">
    <input type="text" name="dep" id="dep">
</form>

@section('script')
    <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
    <script>
    
        $('.faculty').change(function(){
            let id = $(this).val();
            $.get("{{ route('get-dep') }}/" + id, function(response) {
                $('.department').html(response);
            });
        });

        $('.search').click(function() {
            $('#fac').val($('.faculty').val());
            $('#dep').val($('.department').val());
            loader();
            $.post("{{ route('get-courses') }}", $('#search-form').serialize(), function(data){
                $('.data').html(data);
            });
        });

        setTimeout(function() {
            $('.toast_message').fadeOut('slow');
        }, 3000);

    </script>
@endsection

@endsection