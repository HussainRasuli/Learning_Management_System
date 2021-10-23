

<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">

<div class="modal fade text-left" id="edit_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" style="padding-right: 17px; display: block;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160" style="font-weight:bold;">Edit <span>{{$data->first_name }} {{$data->last_name}}</span> Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_student') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$data->stu_id}}" name="student_id">
                <div class="modal-body p-2 pt-3">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text student-first-name"
                                    name="firstname" placeholder="First Name" value="{{$data->first_name}}">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon">First Name</label>
                                <h6 class="student-firstname-error error_message">
                                    Enter First Name.
                                </h6>
                            </div>
                        </div>  
                        <div class="col-md-4 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text student-last-name"
                                    name="lastname" placeholder="Last Name" value="{{$data->last_name}}">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon">Last Name</label>
                                <h6 class="student-lastname-error error_message">
                                    Enter Last Name.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text student-father-name"
                                    name="father_name" placeholder="Father Name" value="{{$data->father_name}}">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon">Father Name</label>
                                <h6 class="student-fathername-error error_message">
                                    Enter Father Name.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" id="end_date"
                                    class="form-control pickadate-months-year input-date student-dob"
                                    placeholder="Date of Birth" name="dob" value="{{$data->date_of_birth}}">
                                <div class="form-control-position">
                                    <i class="mdi mdi-calendar-month"></i>
                                </div>
                                <label for="city-column">Date of Birth</label>
                                <h6 class="student-dob-error error_message">
                                    Enter Date of Birth.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="number" class="form-control lm-input-text student-id-card"
                                    name="tazkira_id" placeholder="Tazkira ID" value="{{$data->tazkira_id}}">
                                    <div class="form-control-position">
                                            <i class="mdi mdi-account-card-details"></i>
                                    </div>
                                <label for="first-name-floating-icon">Tazkira ID</label>
                                <h6 class="student-id-Card-error error_message">
                                    Enter Tazkira ID.
                                </h6>
                            </div>
                        </div>  
                        <div class="col-md-4 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text student-email"
                                    name="email" value="{{$data->email}}" placeholder="Email Address">
                                    <div class="form-control-position">
                                            <i class="mdi mdi-email"></i>
                                    </div>
                                <label for="first-name-floating-icon">Email Address</label>
                                <h6 class="student-email-error error_message">
                                    Enter Email Address.
                                </h6>
                            </div>
                        </div>  
                        <div class="col-md-4 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text student-phone"
                                    name="phone" value="{{$data->phone}}" placeholder="Phone Number">
                                    <div class="form-control-position">
                                            <i class="mdi mdi-phone"></i>
                                    </div>
                                <label for="first-name-floating-icon">Phone Number</label>
                                <h6 class="student-phone-error error_message">
                                    Enter Phone Number.
                                </h6>
                            </div>
                        </div> 
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <select class="select2 form-control student-gender" name="gender">
                                    <option value="" selected hidden>Select Gender</option>
                                    <option value="1" @if($data->gender == 1) selected @endif>Male</option>
                                    <option value="2" @if($data->gender == 2) selected @endif>Female</option>
                                </select>
                                <h6 class="student-gender-error error_message">
                                    Select Gender.
                                </h6>
                            </div>
                        </div> 
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <select class="select2 form-control faculty" name="faculty">
                                    <option value="" selected hidden>Select Faculty</option>
                                    @foreach($faculty as $x)
                                        <option value="{{$x->fac_id}}" @if($data->faculty_id == $x->fac_id) selected @endif>{{$x->fac_name}}</option>
                                    @endforeach
                                </select>
                                <h6 class="student-faculty-error error_message">
                                    Select Faculty.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <select class="select2 form-control department" name="department">
                                    @foreach($all_department as $x)
                                        @if($x->fac_id == $data->dep->fac_id)
                                            <option value="{{$x->dep_id}}" @if($data->dep_id == $x->dep_id ) selected @endif>{{$x->dep_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <h6 class="student-department-error error_message">
                                    Select Department.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <select class="select2 form-control semester" name="semester">
                                    <option value="" selected hidden>Select Semester</option>
                                    @foreach($semester as $x)
                                        <option value="{{$x->sem_id}}" @if($data->semester_id == $x->sem_id ) selected @endif>{{$x->sem_name}}</option>
                                    @endforeach
                                </select>
                                <h6 class="student-semester-error error_message">
                                    Select Semester.
                                </h6>
                            </div>
                        </div> 
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <select class="select2 form-control shift" name="shift">
                                    <option value="" selected hidden>Select Shift</option>
                                    @foreach($shift as $x)
                                    <option value="{{$x->sh_id}}" @if($data->shift_id == $x->sh_id ) selected @endif>{{$x->sh_name}}</option>
                                    @endforeach
                                </select>
                                <h6 class="student-shift-error error_message">
                                    Select Shift.
                                </h6>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-md-12 pb-2">
                            <div id="file-upload0" class="section">
                                <div class="row section">
                                    <div class="col s12 m8 l9">
                                        <label for="basicInputFile">Attach Photo</label>
                                        <input type="file" name="photo" class="dropify" data-max-file-size="" data-height="100" data-allowed-file-extensions="JPG jpg PNG png JPEG jpeg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div> 
    </div>
</div>

<script src="{{ asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
<script src="{{asset('public/app-assets/validations/student.js')}}"></script>
<script>

        
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
   // Month and Year Select Picker
   $('.pickadate-months-year').pickadate({
        selectYears: true,
        selectMonths: true,
        format: 'dddd dd mmm yyyy',
    });
   
    
    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

    $('.faculty').change(function(){
            let id = $(this).val();

            $.get("{{ route('get_department') }}/" + id, function(response) {
                $('.department').html(response);
            });
        });
</script>