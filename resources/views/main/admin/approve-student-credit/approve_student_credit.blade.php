@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">

@if(Session::has('credit_approved'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">Done</div>
        <div class="toast-message">{{Session::get('credit_approved')}}</div>
    </div>
</div>
@endif
<!-- Zero configuration table -->
<section class="client-table" id="student-credit-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 p-0">
                        <div class="row p-0">
                            <div class="col-6">
                                <h4 class="card-title client-title">Student Credit List</h4>
                            </div>
                            <div class="col-6">
                                <a href="{{route('search_student_credits')}}" class="add-client float-right add-new" >Edit Student Credits</a>
                                <a href="{{route('active_credit_page')}}" class="add-client float-right add-new" style="margin-right:0.5rem;">Active Credit Selection</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-devider" style="margin-top: 13px;"></div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive table-data">
                            @include('main.admin.approve-student-credit.pagination')
                        </div>
                        <div class="table-responsive search-data">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form id="student-credit-selection" hidden>
    @csrf
    <input type="text" name="student" id="stu-data">
</form>

<div id="delails-credit-selection"></div>

@section('script')
    <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
    
 <script>
    $(document).on('click', '.credit-pagination-links .pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: "credit-pagination?page=" + page,
            success: function(data) {
                $('.table-data').html(data);
            }
        });
    });

    $(document).on('click', '.view_credit', function() {
        var student_id = $(this).attr('data-id');
        var id = $('#stu-data').val(student_id);
        $('#student-credit-list').hide();
        $.post("{{ route('delails_credit_selection') }}", $('#student-credit-selection').serialize(), function(response){
            $('#delails-credit-selection').html(response);
        });
    });

    
    setTimeout(function() {
        $('.toast_message').fadeOut('slow');
    }, 3000);

 </script>
@endsection
@endsection
