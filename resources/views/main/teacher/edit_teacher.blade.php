<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">

<div class="modal fade text-left" id="edit-teacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160">Edit Lecturer Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('update-teacher')}}" method="POST" id="edit-teacher-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$teacher->tea_id}}" name="teacher">
                <div class="modal-body p-2 pt-2">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text teacher-first-name" value="{{$teacher->first_name}}" name="firstname" placeholder="First Name">
                                    <div class="form-control-position">
                                            <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon"> First Name </label>
                                <h6 class="teacher-firstname-error error_message">
                                    Enter First Name.
                                </h6>
                            </div>
                        </div>  
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text teacher-last-name" value="{{$teacher->last_name}}" name="lastname" placeholder="Last Name">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon">Last Name</label>
                                <h6 class="teacher-lastname-error error_message">
                                    Enter Last Name.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text teacher-father-name" name="father_name" value="{{$teacher->father_name}}" placeholder="Father Name">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon">Father Name</label>
                                <h6 class="teacher-fathername-error error_message">
                                    Enter Father Name.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="number" class="form-control lm-input-text teacher-id-card" name="id_card" value="{{$teacher->id_card_number}}" placeholder="ID Card Number">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-numeric"></i>
                                    </div>
                                <label for="first-name-floating-icon">ID Card Number</label>
                                <h6 class="teacher-id-Card-error error_message">
                                    Enter ID Card Number.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control pickadate-months-year teacher-dob"
                                    placeholder="Date of Birth" name="dob" value="{{$teacher->date_of_birth}}">
                                <div class="form-control-position">
                                    <i class="mdi mdi-calendar-month"></i>
                                </div>
                                <label for="city-column">Date of Birth</label>
                                <h6 class="teacher-dob-error error_message">
                                    Enter Date of Birth.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="email" class="form-control lm-input-text teacher-email" value="{{$teacher->email}}" name="email" placeholder="Email">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-email"></i>
                                    </div>
                                <label for="first-name-floating-icon">Email</label>
                                <h6 class="teacher-email-error error_message">
                                    Enter Email Address.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="number" class="form-control lm-input-text teacher-phone" value="{{$teacher->phone}}" name="phone" placeholder="Phone No">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-phone"></i>
                                    </div>
                                <label for="first-name-floating-icon">Phone No</label>
                                <h6 class="teacher-phone-error error_message">
                                    Enter Phone Number.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <select class="select2 form-control teacher-gender" name="gender">
                                    <option value="1" @if($teacher->gender == 1) selected @endif>Male</option>
                                    <option value="2" @if($teacher->gender == 2) selected @endif>Female</option>
                                </select>
                                <h6 class="teacher-gender-error error_message">
                                    Select Gender.
                                </h6>
                            </div>
                        </div> 
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <select class="select2 form-control teacher-education" name="education">
                                    <option value="1" @if($teacher->education == 1) selected @endif>Bachelor</option>
                                    <option value="2" @if($teacher->education == 2) selected @endif>Master</option>
                                    <option value="3" @if($teacher->education == 3) selected @endif>PHD</option>
                                </select>
                                <h6 class="teacher-education-error error_message">
                                    Select Education.
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add-teacher">Edit</button>
                </div>
            </form>
        </div>
    </div> 
</div>

<script src="{{ asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
<script src="{{asset('public/app-assets/validations/teacher.js')}}"></script>
<script>
    
    // Month and Year Select Picker
    $('.pickadate-months-year').pickadate({
        selectYears: true,
        selectMonths: true,
        format: 'dddd dd mmm yyyy',
    });

    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
</script>