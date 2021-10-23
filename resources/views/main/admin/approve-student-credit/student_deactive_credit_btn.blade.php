
<div class="col-12 p-0" id="">
    <div class="card mb-1">
        <div class="card-header">
            <div class="card-title">Personal Information</div>
            @foreach($student_info as $y)
              @if(($y->active_select_credit == 1 && $y->select_credit == 1) || ($y->active_select_credit == 0 && $y->select_credit == 1) || ($y->active_select_credit == 0 && $y->select_credit == 0))
            <a href="#" class="add-new active_credit_selection" id="@foreach($student_info as $x){{$x->stu_id}}@endforeach"><i class="mdi mdi-check-bold"></i> Active Credit Selection</a>
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
                    </tbody></table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>