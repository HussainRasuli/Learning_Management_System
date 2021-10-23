<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">

<div class="modal fade text-left" id="edit_staff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160">Edit {{$data->first_name }} {{$data->last_name}} Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_staff') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$data->staff_id}}" name="staff_id">
                <div class="modal-body p-2 pt-2">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text staff-first-name" name="firstname" placeholder="First Name" value="{{$data->first_name}}">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon">First Name</label>
                                <h6 class="staff-firstname-error error_message">
                                    Enter First Name.
                                </h6>
                            </div>
                        </div>  
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text staff-last-name"
                                    name="lastname" placeholder="Last Name" value="{{$data->last_name}}">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon">Last Name</label>
                                <h6 class="staff-lastname-error error_message">
                                    Enter Last Name.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text staff-father-name" value="{{$data->father_name}}" name="father_name" placeholder="Father Name">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-message"></i>
                                    </div>
                                <label for="first-name-floating-icon">Father Name</label>
                                <h6 class="staff-fathername-error error_message">
                                    Enter Father Name.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="number" class="form-control lm-input-text staff-id-card" value="{{$data->tazkira_id}}" name="id_card" placeholder="ID Card Number">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-numeric"></i>
                                    </div>
                                <label for="first-name-floating-icon">ID Card Number</label>
                                <h6 class="staff-id-Card-error error_message">
                                    Enter ID Card Number.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text staff-email"
                                    name="email" value="{{$data->email}}" placeholder="Email Address">
                                    <div class="form-control-position">
                                            <i class="mdi mdi-email"></i>
                                    </div>
                                <label for="first-name-floating-icon">Email Address</label>
                                <h6 class="staff-email-error error_message">
                                    Enter Email Address.
                                </h6>
                            </div>
                        </div>  
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="number" class="form-control lm-input-text staff-phone"
                                    name="phone" value="{{$data->phone}}" placeholder="Phone Number">
                                    <div class="form-control-position">
                                            <i class="mdi mdi-phone"></i>
                                    </div>
                                <label for="first-name-floating-icon">Phone Number</label>
                                <h6 class="staff-phone-error error_message">
                                    Enter Phone Number.
                                </h6>
                            </div>
                        </div> 
                        <div class="col-md-6 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" id="end_date"
                                    class="form-control pickadate-months-year input-date staff-dob"
                                    placeholder="Date of Birth" name="dob" value="{{$data->date_of_birth}}">
                                <div class="form-control-position">
                                    <i class="mdi mdi-calendar-month"></i>
                                </div>
                                <label for="city-column">Date of Birth</label>
                                <h6 class="staff-dob-error error_message">
                                    Enter Date of Birth.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <select class="select2 form-control staff-education" name="education">
                                    <option value="" selected hidden>Select Education</option>
                                    <option value="1" @if($data->education == 1) selected @endif>Bachelor</option>
                                    <option value="2" @if($data->education == 2) selected @endif>Master</option>
                                    <option value="3" @if($data->education == 3) selected @endif>PHD</option>
                                </select>
                                <h6 class="staff-education-error error_message">
                                    Select Education.
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <select class="select2 form-control staff-gender" name="gender">
                                    <option value="" selected hidden>Select Gender</option>
                                    <option value="1" @if($data->gender == 1) selected @endif>Male</option>
                                    <option value="2" @if($data->gender == 2) selected @endif>Female</option>
                                </select>
                                <h6 class="staff-gender-error error_message">
                                    Select Gender.
                                </h6>
                            </div>
                        </div> 
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <select class="select2 form-control position" name="position">
                                    <option value="" selected hidden>Select Position</option>
                                    @foreach($position as $x);
                                        <option value="{{$x->position_id}}" @if($data->position_id == $x->position_id) selected @endif>{{$x->position_name}}</option>
                                    @endforeach
                                </select>
                                <h6 class="staff-position-error error_message">
                                    Select Position.
                                </h6>
                            </div>
                        </div> 
                        <div class="col-md-12 col-12 pb-2">
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
                    <button type="submit" class="btn btn-primary add-staff">Edit</button>
                </div>
            </form>
        </div>
    </div> 
</div>

<script src="{{ asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
<script src="{{asset('public/app-assets/validations/staff.js')}}"></script>
<script>

$(document).on('click', '.edit-staff-btn', function(){
            $.post("{{ route('update_staff') }}", $('#edit_staff_form').serialize(), function(response){
                if(response == 'Updated'){
                    Swal.fire(
                        'Updated!',
                        'Course Name Successfully Updated.!',
                        'success'
                    );
                    loadPage();
                }else{
                    alert('Error Occured.!');
                }
            });
        });

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