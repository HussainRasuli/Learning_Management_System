<style>
  tr.tr-height{
      height: 2rem !important;
  }
  th.th-tag{
     background:#f8f8f8 !important;
 }
 .custom-switch.switch-lg .custom-control-input:checked ~ .custom-control-label::after {
    transform: translateX(4.5rem) !important;
}
.custom-switch-success .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #28c76f !important;
    color: #fff;
    transition: all .2s ease-out;
    width: 6rem !important;
}
.disable{ 
        pointer-events: not-allowed; 
        cursor: not-allowed; 
    }
.disable:hover {
        cursor:not-allowed;
    }
</style>

<div class="col-12 p-0">
@if((!$stu->isEmpty()) && (! $all_credit->isEmpty()))
    <div class="card mb-1">
        <div class="card-header">
            <div class="card-title">Personal Information</div>
        </div>
        @foreach($stu as $student)
        <div class="div-devider" style="margin-top: 13px;"></div>
        <div class="card-body pb-0 pt-1">
            <div class="row">
                <div class="users-view-image col-md-3">
                    @if($student->photo != '')
                        <img src="{{ url('/storage/app/student/'.$student->photo) }}"  class="users-avatar-shadow w-100 rounded mb-1 pr-2 ml-1" style="height: 14rem" alt="avatar">
                        @elseif($student->gender == 1)
                        <img src="{{asset('public/app-assets/images/user/male_user.jpg')}}"  class="users-avatar-shadow w-100 rounded mb-1 pr-2 ml-1" style="height: 14rem" alt="avatar">
                        @elseif($student->gender == 2)
                        <img src="{{asset('public/app-assets/images/user/female_user.jpg')}}" class="users-avatar-shadow w-100 rounded mb-1 pr-2 ml-1" style="height: 14rem" alt="avatar">
                    @endif
                </div>
                <div class="col-12 col-sm-9 col-md-4 col-lg-4">
                    <table>
                        <tbody>
                        <tr class="tr-height">
                            <td class="font-weight-bold">First Name</td>
                            <td></td>
                            <td>{{$student->first_name}}</td>
                        </tr>
                        <tr class="tr-height">
                            <td class="font-weight-bold">Last Name</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{$student->last_name}}</td>
                        </tr>
                        <tr class="tr-height">
                            <td class="font-weight-bold">Father Name</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{$student->father_name}}</td>
                        </tr>
                        <tr class="tr-height">
                            <td class="font-weight-bold">Date of Birth</td>
                            <td></td>
                            <td>{{$student->date_of_birth}}</td>
                        </tr>
                        <tr class="tr-height">
                            <td class="font-weight-bold">Tazkira ID</td>
                            <td></td>
                            <td>{{$student->tazkira_id}}</td>
                        </tr>
                        <tr class="tr-height">
                            <td class="font-weight-bold">Gender</td>
                            <td></td>
                            <td>@if($student->gender == 1) Male @elseif($student->gender == 2) Female @endif</td>
                        </tr>
                    </tbody></table>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <table class="ml-0 ml-sm-0 ml-lg-0">
                        <tbody>
                        <tr class="tr-height">
                            <td class="font-weight-bold">Email</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{$student->email}}</td>
                        </tr>
                        <tr class="tr-height">
                            <td class="font-weight-bold">Phone Number</td>
                            <td></td>
                            <td>0{{$student->phone}}</td>
                        </tr>
                        <tr class="tr-height">
                            <td class="font-weight-bold">Semester</td>
                            <td></td>
                            <td>{{$student->semester_id}}</td>
                        </tr>
                    </tbody></table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<!-- Zero configuration table -->
<section class="client-table" id="role_list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 p-0">
                        <div class="row p-0">
                            <div class="col-6">
                                <h4 class="card-title client-title">Number of Credits Selection</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-devider" style="margin-top: 13px;"></div>
                <div class="card-content">
                    <div class="card-body card-dashboard" style="padding: 1rem .5rem;">
                        <div class="table-responsive table-data">
                        <div class="col-12">
                        <form id="edit_stu_credits">
                            @csrf
                            @foreach($stu as $student)
                            <input type="text" name="student_id" value="{{$student->stu_id}}" hidden>
                            @endforeach
                            <table class="table zero-configuration table-hover-animation dataTable no-footer" style="margin-bottom:1.5rem;">
                                <thead>
                                <tr>
                                    <th class="th-tag">No</th>
                                    <th class="th-tag">Course</th>
                                    <th class="th-tag">Teacher</th>
                                    <th class="th-tag">Credit</th>
                                    <th class="th-tag">Semester</th>
                                    <th class="th-tag">Shift</th>
                                    <th class="th-tag">Day</th>
                                    <th class="th-tag">Operation</th>
                                    <th class="th-tag">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table_data">
                              @php $i = 100 @endphp
                              @php $r = 1@endphp
                              @foreach($all_credit as $x)
                                <tr id="delete-{{$x->sc_id}}">
                                    <td>{{$r}}</td>
                                    <td>{{$x->semester->course->co_name}}</td>
                                    <td>{{$x->semester->teacher->first_name}} {{$x->semester->teacher->last_name}}</td>
                                    <td>{{$x->semester->course->credit}}</td>
                                    <td>{{$x->semester->sem_id}}</td>
                                    <td>@if($x->semester->shift == 1) Morning @elseif($x->semester->shift == 2) Afternoon @elseif($x->semester->shift == 3) Evening @endif</td>
                                    <td>Morning</td>
                                    <td>
                                        <div class="custom-control custom-switch switch-lg custom-switch-success mr-2">
                                            <input type="checkbox" class="custom-control-input approve-btn edit_checkitem" credit="{{$x->semester->course->credit}}" name="dismiss-or-approve[]" id="customSwitch{{$i}}" value="{{$x->sc_id}}" @if($x->approve == 1) checked @endif>
                                            <label class="custom-control-label" for="customSwitch{{$i}}">
                                                <span class="switch-text-left"><i class="fa fa-check"></i>Approve</span>
                                                <span class="switch-text-right"><i class="fa fa-times"></i> Dismiss</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td style="padding:0px">
                                        <a href="#!" class="account-action-btn mr-0 account_btn change_course" id="{{$x->sc_id}}" title="Settings"><i class="mdi mdi-settings-outline"></i></a>
                                        <a href="#!" class="action-btn remove-btn delete_credit mr-0" id="{{$x->sc_id}}" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                                @php $r++ @endphp
                              @endforeach
                            </tbody>
                        </table>
                        </form>
                        <span style="font-weight: bold;">&nbsp;The Maximum Number of Selected Credits is 21.</span>
                        <div class="div-devider" style="margin-top: 10px; margin-bottom:12px;"></div>
                        <button class="btn btn-primary edit_approve_courses disable">Edit Approve Courses</button>
                        <div class="text-center bg-light colors-container rounded text-black width-350 height-100 d-flex align-items-center justify-content-center mr-1 ml-49 my-1 float-right" style="background-color:#e8e9ea !important;">
                            <span class="align-middle" style="font-weight: bold;">Total Credits :</span>&nbsp;&nbsp;
                            <span class="align-middle edit_total_credit_div" total_credits="{{$total_credit}}" style="font-weight: bold;"> {{$total_credit}}</span>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
    <div>
        <div class="alert alert-warning text-center" role="alert">
            <p class="mb-0">Not Found !!</p>
        </div>
    </div>
@endif
<form id="send-setudent" hidden="">
    @csrf
    <input type="text" name="id" class="id-test">
</form>

<script>

let total_credit_approved = parseInt($('.edit_total_credit_div').attr('total_credits'));
    let first_value = 0;
    let total_credit = 0;
    if(total_credit_approved > 0){
        total_credit = total_credit_approved;
    }
    $('.edit_approve_courses').prop('disabled', false); 
    $('.edit_approve_courses').removeClass('disable');
    $(document).on("click",".edit_checkitem",function () {

        if($(this).prop("checked") == true){
            first_value = parseInt($(this).attr('credit'));
            total_credit = total_credit + first_value;
            $('.edit_total_credit_div').html(total_credit);
        }
        if($(this).prop("checked") == false){
            var Uncheck_value = parseInt($(this).attr('credit'));
            total_credit = total_credit - Uncheck_value;
            $('.edit_total_credit_div').html(total_credit);
        }
        if(total_credit <= 21){
            $('.edit_approve_courses').prop('disabled', false);
            $('.edit_approve_courses').removeClass('disable');
        }
        else{
            $('.edit_approve_courses').prop('disabled', true); 
            $('.edit_approve_courses').addClass('disable');
        }
   });



   $(document).on('click','.edit_approve_courses',function() {
            Swal.fire({
                title: 'Do you want to Edit it?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, Edit it`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{route('edit_student_credit')}}", $('#edit_stu_credits').serialize() , function(response){
                       if(response == 'Edited'){
                        Swal.fire(
                            'Done!',
                            'Successfuly Edit it.',
                            'success'
                        );
                       }
                    });
                }
            });
        });

    $('.delete_credit').click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You Want to Delete This Credit!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('id');
                $('.id-test').val(id);
                $.post("{{route('delete_student_credit')}}", $('#send-setudent').serialize(), function(response) {
                    console.log(response);
                    if (response == 'Deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Successfuly Deleted.',
                            'success'
                        );
                        $('#delete-'+id).fadeOut(1000);
                    }
                });
            }
        });
    });
</script>