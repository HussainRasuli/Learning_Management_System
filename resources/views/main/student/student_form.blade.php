@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="font-weight-bold" style="font-size: 1.2rem;">Add Student</p>
                    <a href="{{route('student_list')}}"><button type="button" class="btn btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light float-right"><i class="feather icon-arrow-right"></i></button></a>
                </div>
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="post" action="{{route('add_student')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text student-first-name" name="firstname" placeholder="First Name" value="{{old('firstname')}}">
                                                <div class="form-control-position">
                                                     <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon"> First Name </label>
                                            <h6 class="student-firstname-error error_message">
                                                Enter First Name.
                                            </h6>
                                            @error('firstname')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text student-last-name"
                                                name="lastname" placeholder="Last Name" value="{{old('lastname')}}">
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Last Name</label>
                                            <h6 class="student-lastname-error error_message">
                                                Enter Last Name.
                                            </h6>
                                            @error('lastname')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text student-father-name"
                                                name="father_name" placeholder="Father Name" value="{{old('father_name')}}">
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Father Name</label>
                                            <h6 class="student-fathername-error error_message">
                                                Enter Father Name.
                                            </h6>
                                            @error('father_name')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="end_date"
                                                class="form-control pickadate-months-year input-date student-dob"
                                                placeholder="Date of Birth" name="dob" value="{{old('dob')}}">
                                            <div class="form-control-position">
                                                <i class="mdi mdi-calendar-month"></i>
                                            </div>
                                            <label for="city-column">Date of Birth</label>
                                            <h6 class="student-dob-error error_message">
                                                Enter Date of Birth.
                                            </h6>
                                            @error('dob')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="number" class="form-control lm-input-text student-id-card"
                                                name="tazkira_id" placeholder="Tazkira ID" value="{{old('tazkira_id')}}">
                                                <div class="form-control-position">
                                                     <i class="mdi mdi-account-card-details"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Tazkira ID</label>
                                            <h6 class="student-id-Card-error error_message">
                                                Enter Tazkira ID.
                                            </h6>
                                            @error('tazkira_id')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text student-email"
                                                name="email" placeholder="Email Address" value="{{old('email')}}">
                                                <div class="form-control-position">
                                                     <i class="mdi mdi-email"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Email Address</label>
                                            <h6 class="student-email-error error_message">
                                                Enter Email Address.
                                            </h6>
                                            @error('email')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="number" class="form-control lm-input-text student-phone"
                                                name="phone" placeholder="Phone Number" value="{{old('phone')}}">
                                                <div class="form-control-position">
                                                     <i class="mdi mdi-phone"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Phone Number</label>
                                            <h6 class="student-phone-error error_message">
                                                Enter Phone Number.
                                            </h6>
                                            @error('phone')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control student-gender" name="gender">
                                                <option value="" selected hidden>Select Gender</option>
                                                <option value="1" selected>Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                            <h6 class="student-gender-error error_message">
                                                Select Gender.
                                            </h6>
                                            @error('gender')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control faculty" name="faculty">
                                                <option value="" selected hidden>Select Faculty</option>
                                                @foreach($faculty as $x)
                                                   <option value="{{$x->fac_id}}">{{$x->fac_name}}</option>
                                                @endforeach
                                            </select>
                                            <h6 class="student-faculty-error error_message">
                                                Select Faculty.
                                            </h6>
                                            @error('faculty')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control department" name="department">
                                                <option value="" selected disabled hidden>(Ex: Department, ....)</option>
                                            </select>
                                            <h6 class="student-department-error error_message">
                                                Select Department.
                                            </h6>
                                            @error('department')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control semester" name="semester">
                                                <option value="" selected hidden>Select Semester</option>
                                                @foreach($semester as $x)
                                                   <option value="{{$x->sem_id}}">{{$x->sem_name}}</option>
                                                @endforeach
                                            </select>
                                            <h6 class="student-semester-error error_message">
                                                Select Semester.
                                            </h6>
                                            @error('semester')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control shift" name="shift">
                                                <option value="" selected hidden>Select Shift</option>
                                                @foreach($shift as $x)
                                                <option value="{{$x->sh_id}}">{{$x->sh_name}}</option>
                                                @endforeach
                                            </select>
                                            <h6 class="student-shift-error error_message">
                                                Select Shift.
                                            </h6>
                                            @error('shift')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 col-md-12 pb-2">
                                        <div id="file-upload0" class="section">
                                            <div class="row section">
                                                <div class="col s12 m8 l9">
                                                    <label for="basicInputFile">Attach Photo</label>
                                                    <input type="file" name="photo" class="dropify" data-max-file-size="" data-height="100" data-allowed-file-extensions="JPG jpg PNG png JPEG jpeg" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 pb-2 mt-5">
                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                            <span class="mb-0">Make Account</span>
                                            <input type="checkbox" class="custom-control-input" value="1" name="make_account" id="customSwitch11">
                                            <label class="custom-control-label" for="customSwitch11">
                                                <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                                <span class="switch-icon-right"><i class="feather icon-check"></i></span>
                                            </label>
                                        </div>
                                     </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 col-lg-2 col-md-2 col-sm-12 add-student">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('script')
    <script src="{{asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
    <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
    <script src="{{asset('public/app-assets/validations/student.js')}}"></script>
    <script>
        $('.student-dob').change(function(){
                let date = $(this).val().split(',');
                let year_selected = date[1];
                let d = new Date();
                let current_year = d.getFullYear();
                let sub = (current_year - year_selected);
                
                if((sub > 18) && (sub < 65)){
                    $('.student-dob-error').hide();
                    dobError = true;
                    return false;
                }else{
                    $('.student-dob-error').html('Invalid Age');
                    $('.student-dob-error').show();
                    dobError = false;
                    return false;
                }
            }); 

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.faculty').change(function(){
            let id = $(this).val();
            $.get("{{ route('get_department') }}/" + id, function(response) {
                $('.department').html(response);
            });
        });
    </script>
    @endsection
@endsection