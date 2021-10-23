@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="font-weight-bold" style="font-size: 1.2rem;">Add Staff</p>
                    <a href="{{route('staff-list')}}"><button type="button" class="btn btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light float-right"><i class="feather icon-arrow-right"></i></button></a>
                </div>
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="post" action="{{route('add_staff')}}" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text staff-first-name" name="firstname" placeholder="First Name" value="{{old('firstname')}}">
                                                <div class="form-control-position">
                                                     <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon"> First Name </label>
                                            <h6 class="staff-firstname-error error_message">
                                                Enter First Name.
                                            </h6>
                                            @error('firstname')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text staff-last-name" name="lastname" placeholder="Last Name" value="{{old('lastname')}}">
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Last Name</label>
                                            <h6 class="staff-lastname-error error_message">
                                                Enter Last Name.
                                            </h6>
                                            @error('lastname')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text staff-father-name" name="father_name" placeholder="Father Name" value="{{old('father_name')}}">
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Father Name</label>
                                            <h6 class="staff-fathername-error error_message">
                                                Enter Father Name.
                                            </h6>
                                            @error('father_name')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="number" class="form-control lm-input-text staff-id-card" name="id_card" placeholder="ID Card Number" value="{{old('id_card')}}">
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-numeric"></i>
                                                </div>
                                            <label for="first-name-floating-icon">ID Card Number</label>
                                            <h6 class="staff-id-Card-error error_message">
                                                Enter ID Card Number.
                                            </h6>
                                            @error('id_card')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="email" class="form-control lm-input-text staff-email" name="email" placeholder="Email Address" value="{{old('email')}}">
                                                <div class="form-control-position">
                                                     <i class="mdi mdi-email"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Email Address</label>
                                            <h6 class="staff-email-error error_message">
                                                Enter Email Address.
                                            </h6>
                                            @error('email')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="number" class="form-control lm-input-text staff-phone" name="phone" placeholder="Phone Number" value="{{old('phone')}}">
                                                <div class="form-control-position">
                                                     <i class="mdi mdi-phone"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Phone Number</label>
                                            <h6 class="staff-phone-error error_message">
                                                Enter Phone Number.
                                            </h6>
                                            @error('phone')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="end_date"
                                                class="form-control pickadate-months-year input-date staff-dob" placeholder="Date of Birth" name="dob" value="{{old('dob')}}">
                                            <div class="form-control-position">
                                                <i class="mdi mdi-calendar-month"></i>
                                            </div>
                                            <label for="city-column">Date of Birth</label>
                                            <h6 class="staff-dob-error error_message">
                                                Enter Date of Birth.
                                            </h6>
                                            @error('dob')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control staff-gender" name="gender">
                                                <option value="" selected hidden>Select Gender</option>
                                                <option value="1" selected>Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                            <h6 class="staff-gender-error error_message">
                                                Select Gender.
                                            </h6>
                                            @error('gender')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control staff-education" name="education">
                                                <option value="" selected hidden>Select Education</option>
                                                <option value="1">Bachelor</option>
                                                <option value="2">Master</option>
                                                <option value="3">PHD</option>
                                            </select>
                                            <h6 class="staff-education-error error_message">
                                                Select Education.
                                            </h6>
                                            @error('education')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control position" name="position">
                                                <option value="" selected hidden>Select Position</option>
                                                @foreach($all_position as $x);
                                                  <option value="{{$x->position_id}}">{{$x->position_name}}</option>
                                                @endforeach
                                            </select>
                                            <h6 class="staff-position-error error_message">
                                                Select Position.
                                            </h6>
                                            @error('position')
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
                                    <div class="col-lg-6 col-md-12 pb-2 mt-5" id="makeAccount">
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
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 col-lg-2 col-md-2 col-sm-12 add-staff">Add</button>
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
    <script src="{{asset('public/app-assets/vendors/js/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
    <script src="{{asset('public/app-assets/validations/staff.js')}}"></script>

    <script>
    $('#makeAccount').hide();

    $('.staff-dob').change(function(){
        let date = $(this).val().split(',');
        let year_selected = date[1];
        let d = new Date();
        let current_year = d.getFullYear();
        let sub = (current_year - year_selected);
        
        if((sub > 18) && (sub < 65)){
            $('.staff-dob-error').hide();
            dobError = true;
            return false;
        }else{
            $('.staff-dob-error').html('Invalid Age');
            $('.staff-dob-error').show();
            dobError = false;
            return false;
        }
    }); 

    $('.position').change(function(){
            let position_id = $(this).val();
            $.get("{{route('check_position_type_id')}}/" + position_id, function(response) {
                if(response == 'staff'){
                   $('#makeAccount').show();
                }
                else if(response == 'head of department'){
                    $('#makeAccount').hide();
                }
            });
        });
    
    $('.edit_staff').click(function(){
        var staff_id = $(this).attr('id');
        $('.id').val(staff_id);
        $.get("{{route('edit_staff_modal')}}", $('#send_id').serialize(), function(response) {
            $('#response').html(response);
            $("#edit_staff").modal('show');
        });
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