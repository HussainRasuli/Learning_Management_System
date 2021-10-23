@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">


@if(Session::has('teacher-account'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message" style="right: 12px;bottom: 12px;top: 34.5rem; !important">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">One Teacher</div>
            <div class="toast-message">{{Session::get('teacher-account')}}</div>
        </div>
    </div>
@endif

@if(Session::has('teacher-added'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">One Teacher</div>
            <div class="toast-message">{{Session::get('teacher-added')}}</div>
        </div>
    </div>
@endif

@if(Session::has('teacher-updated'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">One Teacher</div>
            <div class="toast-message">{{Session::get('teacher-updated')}}</div>
        </div>
    </div>
@endif

<div class="col-12 p-0">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-1">
            <h4 class="card-title">Lecturer List</h4>
            @can('add-teacher')
                <a href="{{route('new-lecturer')}}" class="add-new">New Lecturer</a>
            @endcan
        </div>
    </div>
</div>

@if(! $teacher->isEmpty())
<div class="col-12 row p-0 wrapper" id="current_teacher_list">
   @php $i=0; @endphp
    @foreach($teacher as $teacher)
      @if($fac_id == $teacher->dep->fac_id)
        <div class="mb-1 items mr-2 ml-1">
            <div class="card-custom">
                <div>
                    @if($teacher->photo != '')
                        <img src="{{ url('/storage/app/teacher/'.$teacher->photo) }}">
                    @elseif(($teacher->photo == '') && ($teacher->gender == 1))
                        <img src="{{asset('public/app-assets/images/user/male_user.jpg')}}">
                    @elseif(($teacher->photo == '') && ($teacher->gender == 2))
                        <img src="{{asset('public/app-assets/images/user/female_user.jpg')}}">
                    @endif
                    <h5>{{$teacher->first_name}} {{$teacher->last_name}}<br>
                       
                        <span>{{$teacher->dep->dep_name}}</span>
                    
                    </h5>
                    <div>
                        <div><i class="mdi mdi-phone-outline design"></i>{{$teacher->phone}}</div>
                        <div><i class="mdi mdi-email-outline design"></i>{{$teacher->email}}</div>
                    </div>
                    <ul class="p-0">
                            <li><a href="#!" class="view_teacher" id="{{$teacher->tea_id}}" data-id="3" title="Show"><i class="mdi mdi-eye"></i></a></li>
                        @can('edit-teacher')
                            <li><a href="#!" class="teacher-edit" data-id="{{$teacher->tea_id}}"><i class="mdi mdi-square-edit-outline"></i></a></li>
                        @endcan
                        @can('delete-teacher')
                            <li><a href="#!" class="delete-teacher" data-id="{{$teacher->tea_id}}"><i class="mdi mdi-trash-can"></i></a></li>
                        @endcan
                        @can('make-teacher-account')
                            @if($teacher->user == '')
                                <li><a href="#!" class="create-account" data-id="{{$teacher->tea_id}}" data-dep="{{$teacher->dep_id}}"><i class="mdi mdi-account-key-outline"></i></a></li>
                            @endif
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
        @endif
        @php $i++ @endphp
    @endforeach
</div>
@else
    <div class="alert alert-primary" role="alert" style="text-align:center;">
        <span>There is no teacher.</span>
    </div>
@endif
<div class="col-12 row p-0 wrapper teacher_search_data"></div>

<div class="col-md-12 col-sm-12 content_div mt-2" id="current_teacher_pagination">
    <div class="card">
        <div class="card-content">
            <div class="card-body" style="padding-bottom:8px;">
                    <div id="pagination-container" style="float:right;"></div>
            </div>
        </div>
    </div>
</div>

<div id="res"></div>
<form id="teacher-from" hidden="">
    @csrf
    <input type="text" name="data" id="data">
</form>

<form id="teacher-account-form" hidden="">
    @csrf
    <input type="text" name="account_btn" value="2">
    <input type="text" name="teacher" id="tea-data">
    <input type="text" name="department" id="tea-data-dep">
</form>

<form method="post" id="teacher_search_form" hidden>
    @csrf
    <input type="text" name="input_send_data" id="input_send_data">
</form>

    @section('script')
        <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
        <script src="{{asset('public/app-assets/js/scripts/pagination/jquery.simplePagination.js')}}"></script>
        <script src="{{asset('public/app-assets/js/scripts/pagination/customPagination.js')}}"></script>

         <!-- date-pickers -->
        <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
        <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
        <script src="{{asset('public/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>

        <script>

        $(document).on('click','.view_teacher' , function(){ 
            var teacher_id = $(this).attr('id');
            $('#data').val(teacher_id); 
            $.get("{{route('view_teacher_modal')}}", $('#teacher-from').serialize(), function(response) {
                $('#res').html(response);
                $("#view_teacher").modal('show');
            });
        });

        $(document).on('click','.teacher-edit' , function(){ 
            let data_id = $(this).attr('data-id');
            $.get("{{route('edit-teacher')}}/" + data_id, function(response) {
                $('#res').html(response);
                $("#edit-teacher").modal('show');
            });
        });

        $(document).on('click','.delete-teacher' , function(){ 
            Swal.fire({
                title: 'Are you sure?',
                text: "You Want to Delete This Teacher!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).attr('data-id');
                    $('#data').val(id);
                    $.post("{{route('delete-teacher')}}", $('#teacher-from').serialize(), function(response) {
                        if (response == 'Deleted') {
                            Swal.fire(
                                'Deleted!',
                                'Teacher Successfully Deleted.',
                                'success'
                            );
                            loadPage();
                        }
                    });
                }
            });
        });

    $(document).on('click','.create-account' , function(){ 
            Swal.fire({
                title: 'Do you want to create an account?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, create it`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).attr('data-id');
                    let dep = $(this).attr('data-dep');
                    $('#tea-data').val(id);
                    $('#tea-data-dep').val(dep);
                    $.post("{{route('make-account-teacher')}}", $('#teacher-account-form').serialize(), function(response) {
                        if(response == 'created'){
                            Swal.fire('Account Created Successfully!', '', 'success');
                            loadPage();
                        }else{
                            alert('Error');
                        }
                    });
                }
            });
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


 $('.teacher_search_data').hide();  
 $(document).on('keyup','#input_search', function(enter){
       var value = $(this).val();
       $('#input_send_data').val(value);
       
       if(value != '' && enter.keyCode == 13 ){ // 13 is Enter key Code.
        $('.teacher_search_data').show();
        $('#current_teacher_list').hide();
        $('#current_teacher_pagination').hide();
           $.post("{{route('search_teacher')}}", $('#teacher_search_form').serialize(), function(res){
            //    console.log(res);
                $('.teacher_search_data').html(res);
           });
       }
       else {
            $('.teacher_search_data').empty();
            $('#current_teacher_list').show();
            $('#current_teacher_pagination').show();
       }
  });

  $(document).on('click','.search-input-icon', function(enter){
       var value = $('#input_search').val();
       $('#input_send_data').val(value);
       
       if(value != ''){ 
        $('.teacher_search_data').show();
        $('#current_teacher_list').hide();
        $('#current_teacher_pagination').hide();
           $.post("{{route('search_teacher')}}", $('#teacher_search_form').serialize(), function(res){
            //    console.log(res);
                $('.teacher_search_data').html(res);
           });
       }
       else {
            $('.teacher_search_data').empty();
            $('#current_teacher_list').show();
            $('#current_teacher_pagination').show();
       }
  });
        </script>
    @endsection
@endsection

