
<style>
    .disable{ 
        pointer-events: not-allowed; 
        cursor: not-allowed; 
    }
    .disable:hover {
        cursor:not-allowed;
    }
</style>
<div class="col-12 p-0" id="student_active_credit_page">
@if(! $student_info->isEmpty())
    <div class="card mb-1">
        <div class="card-header">
            <div class="card-title">Personal Information</div>
            @foreach($student_info as $y)
              @if(($y->active_select_credit == 1 && $y->select_credit == 1) || ($y->active_select_credit == 0 && $y->select_credit == 1) || ($y->active_select_credit == 0 && $y->select_credit == 0))
            <a href="#" class="add-new active_credit_selection active_credit_select" total_credit="{{$total_credit}}" id="@foreach($student_info as $x){{$x->stu_id}}@endforeach"><i class="mdi mdi-check-bold"></i> Active Credit Selection</a>
              @else
            <a href="#" class="deactive_btn btn btn-danger deactive_credit_selection" id="@foreach($student_info as $x){{$x->stu_id}}@endforeach"><i class="mdi mdi-close-circle-outline"></i> Deactive Credit Selection</a>
              @endif
            @endforeach
        </div>
        @foreach($student_info as $student)
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
                            <td class="font-weight-bold">ID Number</td>
                            <td></td>
                            <td>{{$student->unique_id}}</td>
                        </tr>
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
                    </tbody>
                </table>
                 @if($total_credit >= 21)
                    <div class="text-center bg-primary colors-container rounded text-black width-350 height-100 d-flex align-items-center justify-content-center mr-1 ml-49 my-1 float-left" style="background-color:#e8e9ea !important;">
                        <span class="align-middle" style="font-weight: bold;">Total Credits That have been Approved :</span>&nbsp;&nbsp;
                        <span class="align-middle" style="font-weight: bold;"> {{$total_credit}}</span>
                    </div>
                 @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
 @else
    <div>
        <div class="alert alert-warning text-center" role="alert">
            <p class="mb-0">Not Found !!</p>
        </div>
    </div>
 @endif
</div>
<div class="student_deactive_credit"></div>
<form id="active_credit_for_one_student" hidden>
    @csrf
  <input type="text" name="stu_id_number" id="stu_id_number">
</form>
<script>
        let total_credit = $('.active_credit_select').attr('total_credit');
             if(total_credit >= 21){
                 $('.active_credit_select').css('background-color', '#2d6eb480');
                 $('.active_credit_select').addClass('disable');
                 $('.active_credit_select').removeClass('active_credit_selection');
             }

    $(document).on('click','.active_credit_selection',function() {
            Swal.fire({
                title: 'Do you want to Active Credit Selection for this Student?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, Active it`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var stu_id_number = $(this).attr('id');
                    $('#stu_id_number').val(stu_id_number);
                    $.get("{{route('activeCreditFor_one_student')}}", $('#active_credit_for_one_student').serialize() , function(response){
                        $('#student_active_credit_page').hide();
                        $('.student_deactive_credit').html(response);
                        Swal.fire(
                            'Done!',
                            'Successfuly Actived.',
                            'success'
                        );
                    });
                }
            });
        });

        $(document).on('click','.deactive_credit_selection',function() {
            Swal.fire({
                title: 'Do you want to Deactive Credit Selection for this Student?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, Deactive it`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var stu_id_number = $(this).attr('id');
                    $('#stu_id_number').val(stu_id_number);
                    $.post("{{route('deactiveCreditFor_one_student')}}", $('#active_credit_for_one_student').serialize() , function(response){
                        $('#student_active_credit_page').hide();
                        $('.student_deactive_credit').html(response);
                        Swal.fire(
                            'Done!',
                            'Successfuly Actived.',
                            'success'
                        );
                    });
                }
            });
        });

        function loadPage()
        {
            setTimeout(function() {
                location.reload();
            }, 2000);
        }

</script>