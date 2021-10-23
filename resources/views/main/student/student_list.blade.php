@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

@if(Session::has('account_created'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message" style="right: 12px;bottom: 12px;top: 36rem; !important">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">Account</div>
   <div class="toast-message">{{Session::get('account_created')}}</div>
  </div>
</div>
@endif

@if(Session::has('student_added'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">One Student</div>
   <div class="toast-message">{{Session::get('student_added')}}</div>
  </div>
</div>
@endif

@if(Session::has('student-updated'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">One Student</div>
   <div class="toast-message">{{Session::get('student-updated')}}</div>
  </div>
</div>
@endif

<!-- Zero configuration table -->
<section class="client-table">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 p-0">
                        <div class="row p-0">
                            <div class="col-6">
                                <h4 class="card-title client-title">Student List</h4>
                            </div>
                            <div class="col-6">
                                <a href="{{route('student_form')}}" class="add-client float-right add-new" >New Student</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-devider" style="margin-top: 13px;"></div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive table-data">
                            @include('main.student.pagination')
                        </div>
                        <div class="table-responsive student_search_data">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form method="post" id="students_list" hidden="">
    @csrf
    <input type="text" name="id" class="id">
</form>

<form id="student-account-form" hidden="">
    @csrf
    <input type="text" name="account_btn" value="2">
    <input type="text" name="student" id="stu-data">
    <input type="text" name="department" id="stu-data-dep">
</form>

<form method="post" id="student_search_form" hidden>
    @csrf
    <input type="text" name="input_send_data" id="input_send_data">
</form>
<div id="edit_form"></div>
<div id="stu-response"></div>

@section('script')
    <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>      
    <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
 <script>
    $(document).on('click', '.pagination-links .pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: "get-pagination?page=" + page,
            success: function(data) {
                $('.table-data').html(data);
            }
        });
    });

    $(document).on('click', '.edit_student', function(){
        var student_id = $(this).attr('id');
        $('.id').val(student_id);
        $("#view_student").modal('hide');
        $.get("{{route('edit_student_modal')}}", $('#students_list').serialize(), function(response) {
            $('#edit_form').html(response);
            $("#edit_student").modal('show');
        });
    });

    $(document).on('click','.view_student' , function(){
        var student_id = $(this).attr('id');
        $('.id').val(student_id);
        $.get("{{route('view_student_modal')}}", $('#students_list').serialize(), function(response) {
            $('#stu-response').html(response);
            $("#view_student").modal('show');
        });
    });


    $(document).on('click','.delete_student', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You Want to Delete This Student!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('id');
                $('.id').val(id);
                $("#view_student").modal('hide');
                $.post("{{route('delete_student')}}", $('#students_list').serialize(), function(response) {
                    // console.log(response);
                    if (response == 'Deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Student Successfuly Deleted.',
                            'success'
                        );
                        loadPage();
                    }
                });
            }
        });
    });

    $(document).on('click','.account_btn',function(){
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
                $('#stu-data').val(id);
                $('#stu-data-dep').val(dep);
                $.post("{{route('make-account-student')}}", $('#student-account-form').serialize(), function(response) {
                    if(response == 'created'){
                        Swal.fire('Account Created Successfully!', '', 'success');
                        loadPage();
                    }else{
                        alert('Error');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
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


  $(document).on('keyup','#input_search', function(enter){
       var value = $(this).val();
       $('#input_send_data').val(value);
       
       if(value != '' && enter.keyCode == 13 ){ // 13 is Enter key Code.
        $('.table-data').hide();
         $('.student_search_data').show();
           $.post("{{route('search_student')}}", $('#student_search_form').serialize(), function(res){
            //    console.log(res);
                $('.student_search_data').html(res);
           });
       }
       else {
            $('.student_search_data').empty();
            $('.table-data').show();
       }
  });

  $(document).on('click','.search-input-icon', function(enter){
       var value = $('#input_search').val();
       $('#input_send_data').val(value);
       
       if(value != ''){ 
        $('.table-data').hide();
           $.post("{{route('search_student')}}", $('#student_search_form').serialize(), function(res){
            //    console.log(res);
                $('.student_search_data').html(res);
           });
       }
       else {
            $('.student_search_data').empty();
            $('.table-data').show();
       }
  });
 </script>
@endsection
@endsection
