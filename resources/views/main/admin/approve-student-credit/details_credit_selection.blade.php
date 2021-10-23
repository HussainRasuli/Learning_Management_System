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
    <div class="card mb-1">
        <div class="card-header">
            <div class="card-title">Personal Information</div>
            <a href="{{route('student_credit_list')}}"><button type="button" class="btn btn-icon rounded-circle btn-primary mr-1 waves-effect waves-light float-right" style="margin-bottom:0.6rem;"><i class="feather icon-arrow-left"></i></button></a>
        </div>
        
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
    </div>
</div>
@if(! $all_credits->isEmpty())
<section class="client-table">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header">
                    <div class="col-12 p-0">
                        <div class="row p-0">
                            <div class="col-12">
                                <h4 class="card-title client-title">All Courses That have been Approved or Dismissed</h4>
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
                                    <th class="th-tag">Course Name</th>
                                    <th class="th-tag">Teacher Name</th>
                                    <th class="th-tag">Department Name</th>
                                    <th class="th-tag">Credit</th>
                                    <th class="th-tag">Day</th>
                                    <th class="th-tag">Approved or Dismissed</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                                @php $i = 1 @endphp
                                @foreach($all_credits as $x)
                                <tr>
                                    <th>{{$i}}</th>
                                    <td>{{$x->course->co_name}}</td>
                                    <td>{{$x->teacher->first_name}} {{$x->teacher->last_name}}</td>
                                    <td>{{$x->department->dep_name}}</td>
                                    <td>{{$x->course->credit}}</td>
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
                        <div class="col-12 student_semester" stu_semester="{{$semester_id}}">
                        <form id="approve_or_dismiss_credits">
                            @csrf
                            <table class="table zero-configuration table-hover-animation dataTable no-footer" style="margin-bottom: 1.5rem;">
                                <thead>
                                <tr>
                                    <th class="th-tag">No</th>
                                    <th class="th-tag">Course</th>
                                    <th class="th-tag">Teacher</th>
                                    <th class="th-tag">Credit</th>
                                    <th class="th-tag">Semester</th>
                                    <th class="th-tag">Shift</th>
                                    <th class="th-tag">Day</th>
                                    <th class="th-tag">Department</th>
                                    <th class="th-tag">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table_data">
                              @php $i = 100 @endphp
                              @php $r = 1@endphp
                              @foreach($all_credit as $x)
                                <tr>
                                    <td>{{$r}}</td>
                                    <td>{{$x->semester->course->co_name}}</td>
                                    <td>{{$x->semester->teacher->first_name}} {{$x->semester->teacher->last_name}}</td>
                                    <td>{{$x->semester->course->credit}}</td>
                                    <td>{{$x->semester->sem_id}}</td>
                                    <td>@if($x->semester->shift == 1) Morning @elseif($x->semester->shift == 2) Afternoon @elseif($x->semester->shift == 3) Evening @endif</td>
                                    <td>{{$x->semester->days->day_name}}</td>
                                    <td>{{$x->semester->department->dep_name}}</td>
                                    <td>
                                        <div class="custom-control custom-switch switch-lg custom-switch-success mr-2">
                                            <input type="checkbox" class="custom-control-input approve-btn checkitem" credit="{{$x->semester->course->credit}}" name="dismiss-or-approve[]" id="customSwitch{{$i}}" value="{{$x->sc_id}}">
                                            <label class="custom-control-label" for="customSwitch{{$i}}">
                                                <span class="switch-text-left"><i class="fa fa-check"></i>Approve</span>
                                                <span class="switch-text-right"><i class="fa fa-times"></i> Dismiss</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                                @php $r++ @endphp
                              @endforeach
                            </tbody>
                        </table>
                        </form>
                        <span style="font-weight: bold;"> The Maximum Number of Selected Credits is 21.</span> 
                        <div class="div-devider" style="margin-top: 10px; margin-bottom:25px;"></div>
                        <button class="btn btn-primary approve-credit-submit-btn" stu_id="{{$student->stu_id}}">Approve Courses</button>
                        <div class="text-center bg-light colors-container rounded text-black width-350 height-100 d-flex align-items-center justify-content-center mr-1 ml-49 my-1 float-right" style="background-color:#e8e9ea !important;">
                            <span class="align-middle" style="font-weight: bold;">Total Credits :</span>&nbsp;&nbsp;
                            <span class="align-middle total_credit" total_credits="{{$total_credit}}" style="font-weight: bold;"> {{$total_credit}}</span>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    let total_credit_approved = parseInt($('.total_credit').attr('total_credits'));
    let first_value = 0;
    let total_credit = 0;
    if(total_credit_approved > 0){
        total_credit = total_credit_approved;
    }
    // let x = 0;
    $(document).on("click",".checkitem",function () {

        if($(this).prop("checked") == true){
            first_value = parseInt($(this).attr('credit'));
            total_credit = total_credit + first_value;
            // x++;
            // if(x > 0){
            //     $('.approve-credit-submit-btn').show();
            // }
            // else{
            //     $('.approve-credit-submit-btn').hide();
            // }
            $('.total_credit').html(total_credit);
        }
        if($(this).prop("checked") == false){
            var Uncheck_value = parseInt($(this).attr('credit'));
            total_credit = total_credit - Uncheck_value;
            // x--;
            // if(x > 0){
            //     $('.approve-credit-submit-btn').show();
            // }
            // else{
            //     $('.approve-credit-submit-btn').hide();
            // }
            $('.total_credit').html(total_credit);
        }

        
    });

    
    $('.approve-credit-submit-btn').click( function(){ 
            Swal.fire({
                title: 'Are you sure,You want to Approve or dismiss this Credits?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, Save it`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var stu_id = $(this).attr('stu_id');
                    $.post("{{route('approve_student_credit')}}/" + stu_id, $('#approve_or_dismiss_credits').serialize() , function(response){
                        if(response == 'Saved'){
                            window.location.href = "{{route('student_credit_list')}}";
                        }
                    });
                }
            });
        });
</script>