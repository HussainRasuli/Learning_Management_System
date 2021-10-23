@extends('layouts.master')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<style>
 th.th-tag{
    background:#f8f8f8 !important;
 }
   .disable{ 
        pointer-events: not-allowed; 
        cursor: not-allowed; 
    }
    .disable:hover {
        cursor:not-allowed;
    }
</style>

@if(Session::has('credit_submited'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">Your Credit</div>
   <div class="toast-message">{{Session::get('credit_submited')}}</div>
  </div>
</div>
@endif

@if(isset($all_course))
<!-- Zero configuration table -->
<section class="client-table">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 p-0">
                        <div class="row p-0">
                            <div class="col-6">
                                <h4 class="card-title client-title student_semester" stu_semester="{{$student->semester_id}}"><i class="fa fa-info-circle"></i> Select Credit For {{$student->first_name}} {{$student->last_name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-devider" style="margin-top: 13px;"></div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        @if($student->active_select_credit == 1) 
                        @if(! $all_course->isEmpty())
                        @if($student->select_credit != 1)
                        <div class="table-responsive table-data">
                        <div class="col-12">
                            <form id="credit_submit_form">
                                @csrf
                            <table class="table zero-configuration table-hover-animation dataTable no-footer" style="margin-bottom:1.5rem;">
                                <thead>
                                <tr>
                                    <th class="th-tag">Select</th>
                                    <th class="text-center th-tag">No</th>
                                    <th class="th-tag">Course</th>
                                    <th class="th-tag">Teacher</th>
                                    <th class="th-tag">Credit</th>
                                    <th class="th-tag">Semester</th>
                                    <th class="th-tag">Department</th>
                                    <th class="th-tag">Year</th>
                                    <th class="th-tag">Shift</th>
                                </tr>
                                </thead>
                                <tbody id="table_data">
                                @php $i=1 @endphp
                               @foreach($all_course as $x)
                                <tr>
                                    <td>
                                        <fieldset>
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" name="course[]" value="{{$x->tc_id}}" class="checkitem" credit="{{$x->course->credit}}">
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-check"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </fieldset>
                                    </td>
                                    <td class="text-center">{{$i}}</td>
                                    <td>{{$x->course->co_name}}</td>
                                    <td>{{$x->teacher->first_name}} {{$x->teacher->last_name}}</td>
                                    <td>{{$x->course->credit}}</td>
                                    <td>{{$x->sem_id}}</td>
                                    <td>{{$x->department->dep_name}}</td>
                                    <td>{{$year}}</td>
                                    <td>@if($x->shift == 1) Morning @elseif($x->shift == 2) Afternoon @elseif($x->shift == 3) Evening @endif</td>
                                </tr> 
                               @endforeach
                            </tbody>
                        </table>
                        </form>
                         @if($student->semester_id <= 7)
                            <span style="font-weight: bold;"> The Minimum Number of Selected Credits is 17 and The Maximum is 21.</span> 
                         @else
                            <span style="font-weight: bold;"> The Maximum Number of Selected Credits is 21.</span> 
                         @endif
                           <div class="div-devider" style="margin-top: 10px; margin-bottom:10px;"></div>
                        <button class="btn btn-primary send_credit_btn disable">Save</button>
                        <div class="text-center bg-light colors-container rounded text-black width-300 height-100 d-flex align-items-center justify-content-center mr-1 ml-50 my-1 float-right" style="background-color:#e8e9ea !important;">
                            <span class="align-middle" style="font-weight: bold;">Total credits selected :</span>&nbsp;&nbsp;
                            <span class="align-middle total_credit" style="font-weight: bold;"> 0 </span>
                        </div>
                        </div>
                    </div>
                    @else
                        <div>
                            <div class="alert alert-success text-center" role="alert">
                                <p class="mb-0">Your credits is being process in the relevant department.</p>
                            </div>
                        </div>
                    @endif
                    @else
                        <div>
                            <div class="alert alert-warning text-center" role="alert">
                                <p class="mb-0">Credit selection for @if($student->shift_id == 1) Morning @elseif($student->shift_id == 2) Aternoon @elseif($x->shift == 3) Evening @endif time has not been set yet.</p>
                            </div>
                        </div>
                    @endif
                    @elseif($student->active_select_credit == 0 && $student->select_credit == 0)
                        <div>
                            <div class="alert alert-primary text-center" role="alert">
                                <p class="mb-0">The Section Of Credit Selection Is Not Yet Active.</p>
                            </div>
                        </div>
                    @elseif($student->active_select_credit == 0 && $student->select_credit == 1)
                        <div>
                            <div class="alert alert-primary text-center" role="alert">
                                <p class="mb-0">You Have Already Selected Your Credits. If Necessary, Refer To The Relevant Department Or Faculty.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@elseif(isset($all_credit))
<!-- Zero configuration table -->
<section class="client-table">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header">
                    <div class="col-12 p-0">
                        <div class="row p-0">
                            <div class="col-12">
                                <h4 class="card-title client-title">Your Courses that have been Approved or Dismissed</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-devider" style="margin-top: 13px;"></div>
                <div class="card-content">
                    <div class="card-body card-dashboard" style="padding: 1rem .5rem;">
                        <div class="table-responsive table-data">
                        <div class="col-12">
                            <table class="table zero-configuration table-hover-animation dataTable no-footer">
                            <thead>
                                <tr>
                                    <th class="th-tag">No</th>
                                    <th class="th-tag">Course</th>
                                    <th class="th-tag">Teacher</th>
                                    <th class="th-tag">Department</th>
                                    <th class="th-tag">Credit</th>
                                    <th class="th-tag">Semester</th>
                                    <th class="th-tag">Day</th>
                                    <th class="th-tag">Approved or Dismissed</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                                @php $i = 1 @endphp
                                @foreach($all_credit as $x)
                                <tr>
                                    <th>{{$i}}</th>
                                    <td>{{$x->course->co_name}}</td>
                                    <td>{{$x->teacher->first_name}} {{$x->teacher->last_name}}</td>
                                    <td>{{$x->department->dep_name}}</td>
                                    <td>{{$x->course->credit}}</td>
                                    <td style="padding-right: 0px;padding-left: 0px">{{$x->semester->sem_name}}</td>
                                    <td>{{$x->days->day_name}}</td>
                                    <td>
                                     @if($x->approve_or_dismiss->approve == 1)
                                        <div class="badge badge-pill badge-success mr-1 mb-1">Approved</div>
                                     @else
                                        <div class="badge badge-pill badge-danger mr-1 mb-1">Dismissed</div>
                                     @endif
                                    </td>
                                </tr>
                                @php $i++ @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center bg-light colors-container rounded text-black width-350 height-100 d-flex align-items-center justify-content-center mr-1 ml-49 my-1 float-left" style="background-color:#e8e9ea !important;">
                            <span class="align-middle" style="font-weight: bold;">Total Credits That have been Approved :</span>&nbsp;&nbsp;
                            <span class="align-middle" style="font-weight: bold;"> {{$total_credit}}</span>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if($student->active_select_credit == 1 && $student->select_credit == 0)
<div class="col-12 p-0">
    <div class="card">
        <div class="card-header d-flex mb-1">
            <h4 class="card-title admin_approve" admin-approved="{{$student->admin_approve_credits}}">Advance Search</h4>
        </div>
        <div class="div-devider"></div>
        <div class="card-content">
            <div class="card-body">
            <form id="advance_search">
                @csrf
                <div class="row">
                    <div class="col-1"></div>
                    
                    <div class="col-md-3 col-12">
                    <div style="margin-bottom:2px;">Department</div>
                        <select class="select2 form-control department" name="department[]">
                            <option value="" selected hidden></option>
                            @foreach($department as $x)
                                <option value="{{$x->dep_id}}">{{$x->dep_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-12">
                    <div style="margin-bottom:2px;">Course</div>
                        <select class="select2 form-control course_name" name="course">
                            <option value="" selected hidden>(Ex: Software, IT ...)</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-12">
                    <div style="margin-bottom:2px;">Semester</div>
                        <select class="select2 form-control semester" name="semester">
                            <option value="" selected hidden></option>
                            @foreach($semester as $x)
                                <option value="{{$x->sem_id}}">{{$x->sem_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-12" style="padding-top: 1.5rem;">
                        <a href="#" class="search advance_search_btn float-left"><i class="feather icon-search"> Search</i></a>
                    </div>
                 </div>
                 </form>
            </div>
            <div id="advance_search_div"></div>
        </div>
    </div>
</div>
@endif

<form id="select_credits" hidden>
    @csrf
    <input type="text" name="id" class="id">
</form>

<div id="edit_modal"></div>
@section('script')
<script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
<script src="{{asset('public/app-assets/js/scripts/modal/components-modal.js')}}"></script>
 <script>
 
   $('.department').change(function(){
       let id = $(this).val();
       $.get("{{ route('get_courses') }}/" + id, function(res){
        //    console.log(res);
           $('.course_name').html(res);
       });
       
   });

   $('.total_credit_div').hide();
   $('.advance_search_btn').click(function(){
        loader();
        $.get("{{route('advance_search')}}", $('#advance_search').serialize(), function(response) {
            // console.log(response);
            $('.total_credit_div').show();
            $('#advance_search_div').html(response);
        });
    });

    $('.edit_YearPeriod').click(function(){
        var log_id = $(this).attr('id');
        $('.id').val(log_id);
        $.get("{{route('edit_YearPeriod')}}", $('#select_credits').serialize(), function(response) {
            $('#edit_modal').html(response);
            $("#YearPeriod").modal('show');
        });
    });
    
    $(document).on('click', '.edit_YearPeriod_btn', function(){
            $.post("{{ route('update_YearPeriod') }}", $('#edit_YearPeriod_btn').serialize(), function(response){
                if(response == 'Updated'){
                    Swal.fire(
                        'Updated!',
                        'Year and Period Successfully Updated.',
                        'success'
                    );
                    loadPage();
                }else{
                    alert('Error Occured.!');
                }
            });
        });


    $('.delete_YearPeriod').click(function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You Want to Delete This Year and Period!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).attr('id');
            $('.id').val(id);
            $.post("{{route('delete_YearPeriod')}}", $('#select_credits').serialize(), function(response) {
                // console.log(response);
                if (response == 'Deleted') {
                    Swal.fire(
                        'Deleted!',
                        'Year and Period Successfuly Deleted.',
                        'success'
                    );
                    loadPage();
                }
            });
        }
    });

});

 $('.send_credit_btn').click( function(){ 
            Swal.fire({
                title: 'Are you sure, You want to Submit this Credits?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, Submit it`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{route('credit_submited')}}", $('#credit_submit_form').serialize() , function(response){
                        if(response == 'Submited'){
                            Swal.fire('Your Credits successfully Submited', '', 'success');
                            loadPage();
                        }else{
                            alert('Error');
                        }
                    });
                    $.post("{{route('advance_credit_submited')}}", $('#advance_credit_submit_form').serialize() , function(response){
                        
                    });
                }
            });
        });


    $('.send_credit_btn').prop('disabled', true);

    let total_credit_approved = parseInt($('.total_credit').attr('total_credits'));
    let first_value = 0;
    let total_credit = 0;
    if(total_credit_approved > 0){
        total_credit = total_credit_approved;
    }
    let student_semester = $('.student_semester').attr('stu_semester');
    let x = 0;
    $(document).on("click",".checkitem",function () {

        if($(this).prop("checked") == true){
           first_value = parseInt($(this).attr('credit'));
           total_credit = total_credit + first_value;

            x++;
            if(student_semester <= 7){
            if(total_credit >= 17 && total_credit <= 21){
                if(x > 0){
                    $('.send_credit_btn').prop('disabled', false);
                    $('.send_credit_btn').removeClass('disable');
                }
                else{
                    $('.send_credit_btn').prop('disabled', true);
                    $('.send_credit_btn').addClass('disable'); 
                }
            }
            else{
                    $('.send_credit_btn').prop('disabled', true);
                    $('.send_credit_btn').addClass('disable'); 
            }
            }
            else{
                if(total_credit <= 21){
                    if(x > 0){
                        $('.send_credit_btn').prop('disabled', false);
                        $('.send_credit_btn').removeClass('disable');
                    }
                    else{
                        $('.send_credit_btn').prop('disabled', true);
                        $('.send_credit_btn').addClass('disable'); 
                    }
                }
                else{
                    $('.send_credit_btn').prop('disabled', true);
                    $('.send_credit_btn').addClass('disable')
                }
            }
           $('.total_credit').html(total_credit);
        }


        if($(this).prop("checked") == false){
           var Uncheck_value = parseInt($(this).attr('credit'));
           total_credit = total_credit - Uncheck_value;
            x--;
            if(student_semester <= 7){
            if(total_credit >= 17 && total_credit <= 21){
                if(x > 0){
                    $('.send_credit_btn').prop('disabled', false);
                    $('.send_credit_btn').removeClass('disable');
                }
                else{
                    $('.send_credit_btn').prop('disabled', true);
                    $('.send_credit_btn').addClass('disable'); 
                }
            }
            else{
                    $('.send_credit_btn').prop('disabled', true);
                    $('.send_credit_btn').addClass('disable'); 
            }
            }
            else{
                if(total_credit <= 21){
                    if(x > 0){
                        $('.send_credit_btn').prop('disabled', false);
                        $('.send_credit_btn').removeClass('disable');
                    }
                    else{
                        $('.send_credit_btn').prop('disabled', true);
                        $('.send_credit_btn').addClass('disable'); 
                    }
                }
                else{
                    $('.send_credit_btn').prop('disabled', true);
                    $('.send_credit_btn').addClass('disable')
                }
            }
           $('.total_credit').html(total_credit);
        }
    });

    setTimeout(function() {
        $('.toast_message').fadeOut('slow');
    }, 3000);

    function loadPage()
        {
            setTimeout(function() {
                location.reload();
            }, 2000);
        }
    
 </script>
@endsection

@endsection