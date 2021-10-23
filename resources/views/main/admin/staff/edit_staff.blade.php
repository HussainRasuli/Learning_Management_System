

<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/forms/select/select2.min.css')}}"
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="font-weight-bold" style="font-size: 1.2rem;">Edit Staff</p>
                    <button type="button" class="btn btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light float-right staff_back"><i class="feather icon-arrow-right"></i></button>
                </div>
                
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="post" action="{{route('update_staff')}}" class="form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="staff_id" value="{{$data->staff_id}}">
                            <div class="form-body">
                                <div class="row">
                                <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text"
                                                name="firstname" placeholder="First Name" value="{{$data->first_name}}">
                                                <div class="form-control-position">
                                                   <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon">First Name</label>
                                        </div>
                                    </div>  
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text"
                                                name="lastname" placeholder="Last Name" value="{{$data->last_name}}">
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control" name="position">
                                                <option value="" selected hidden>Select Position</option>
                                                @foreach($position as $x);
                                                  <option value="{{$x->position_id}}" @if($data->position_id == $x->position_id) selected @endif>{{$x->position_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                     <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control" name="gender">
                                                <option value="" selected hidden>Select Gender</option>
                                                <option value="1" @if($data->gender == 1) selected @endif>Male</option>
                                                <option value="2" @if($data->gender == 2) selected @endif>Female</option>
                                            </select>
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
                                        <button type="submit" id="btn_submit"
                                            class="btn btn-primary mr-1 mb-1 col-lg-2 col-md-2 col-sm-12">Edit</button>
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

    <script src="{{ asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>    <script>
       

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

        $('.staff_back').click(function(){
            $('.edit_form').hide();
            $('#staff_list').show();
            $('#staff_header').show();
        });
    </script>