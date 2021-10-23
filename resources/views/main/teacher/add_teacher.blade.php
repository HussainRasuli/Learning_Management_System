@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

<div class="col-12 p-0">
    <div class="card">
        <div class="card-header p-0 p-1">
            <h4 class="card-title">Add Lecturer</h4>
            <a href="{{route('lecturer')}}">
                <button type="button" class="btn btn-icon rounded-circle btn-primary waves-effect waves-light"><i class="feather icon-arrow-right"></i></button>
            </a>
        </div>
        <div class="div-devider"></div>
        <div class="card-content">
            <div class="card-body">
                <form method="post" action="{{ route('add-lecturer') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text" class="form-control lm-input-text teacher-first-name" name="firstname" placeholder="First Name" value="{{ old('firstname')}}">
                                        <div class="form-control-position">
                                                <i class="mdi mdi-message"></i>
                                        </div>
                                    <label for="first-name-floating-icon"> First Name </label>
                                    <h6 class="teacher-firstname-error error_message">
                                        Enter First Name.
                                    </h6>
                                    @error('firstname')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>  
                            <div class="col-md-6 col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text" class="form-control lm-input-text teacher-last-name" name="lastname" placeholder="Last Name" value="{{ old('lastname')}}">
                                        <div class="form-control-position">
                                            <i class="mdi mdi-message"></i>
                                        </div>
                                    <label for="first-name-floating-icon">Last Name</label>
                                    <h6 class="teacher-lastname-error error_message">
                                        Enter Last Name.
                                    </h6>
                                    @error('lastname')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text" class="form-control lm-input-text teacher-father-name" name="father_name" placeholder="Father Name" value="{{ old('father_name')}}">
                                        <div class="form-control-position">
                                            <i class="mdi mdi-message"></i>
                                        </div>
                                    <label for="first-name-floating-icon">Father Name</label>
                                    <h6 class="teacher-fathername-error error_message">
                                        Enter Father Name.
                                    </h6>
                                    @error('father_name')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="number" class="form-control lm-input-text teacher-id-card" name="id_card" placeholder="ID Card Number" value="{{ old('id_card')}}">
                                        <div class="form-control-position">
                                            <i class="mdi mdi-numeric"></i>
                                        </div>
                                    <label for="first-name-floating-icon">ID Card Number</label>
                                    <h6 class="teacher-id-Card-error error_message">
                                        Enter ID Card Number.
                                    </h6>
                                    @error('id_card')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text" class="form-control pickadate-months-year teacher-dob" placeholder="Date of Birth" name="dob" value="{{ old('dob')}}">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-calendar-month"></i>
                                    </div>
                                    <label for="city-column">Date of Birth</label>
                                    <h6 class="teacher-dob-error error_message">
                                        Enter Date of Birth.
                                    </h6>
                                    @error('dob')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="email" class="form-control lm-input-text teacher-email" name="email" placeholder="Email" value="{{ old('email')}}">
                                        <div class="form-control-position">
                                            <i class="mdi mdi-email"></i>
                                        </div>
                                    <label for="first-name-floating-icon">Email</label>
                                    <h6 class="teacher-email-error error_message">
                                        Enter Email Address.
                                    </h6>
                                    @error('email')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="number" class="form-control lm-input-text teacher-phone" name="phone" placeholder="Phone No" value="{{ old('phone')}}">
                                        <div class="form-control-position">
                                            <i class="mdi mdi-phone"></i>
                                        </div>
                                    <label for="first-name-floating-icon">Phone No</label>
                                    <h6 class="teacher-phone-error error_message">
                                        Enter Phone Number.
                                    </h6>
                                    @error('phone')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <select class="select2 form-control teacher-gender" name="gender">
                                        <option value="" selected hidden>Select Gender</option>
                                        <option value="1" selected>Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                    <h6 class="teacher-gender-error error_message">
                                        Select Gender.
                                    </h6>
                                    @error('gender')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <select class="select2 form-control teacher-education" name="education" value="{{ old('education')}}">
                                        <option value="" selected hidden>Select Education</option>
                                        <option value="1">Bachelor</option>
                                        <option value="2">Master</option>
                                        <option value="3">PHD</option>
                                    </select>
                                    <h6 class="teacher-education-error error_message">
                                        Select Education.
                                    </h6>
                                    @error('education')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 pb-2">
                                <div class="custom-control custom-switch custom-switch-success" style="margin-top: 0.6rem;">
                                    <span class="mb-0">Make Account</span>
                                    <input type="checkbox" class="custom-control-input" name="make-account" id="customSwitch11" value="1">
                                    <label class="custom-control-label" for="customSwitch11">
                                        <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                        <span class="switch-icon-right"><i class="feather icon-check"></i></span>
                                    </label>
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
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 add-teacher">Add Lecturer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    @section('script')
        
        <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
        <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
        <script src="{{asset('public/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
        <script src="{{asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
        <script src="{{asset('public/app-assets/validations/teacher.js')}}"></script>
        <script>
            $('.teacher-dob').change(function(){
                let date = $(this).val().split(',');
                let year_selected = date[1];
                let d = new Date();
                let current_year = d.getFullYear();
                let sub = (current_year - year_selected);
                
                if((sub > 18) && (sub < 65)){
                    $('.teacher-dob-error').hide();
                    dobError = true;
                    return false;
                }else{
                    $('.teacher-dob-error').html('Invalid Age');
                    $('.teacher-dob-error').show();
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
        </script>
    @endsection
@endsection