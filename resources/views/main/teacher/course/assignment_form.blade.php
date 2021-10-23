<link rel="stylesheet" href="{{asset('public/app-assets/datepicker_dari/kamadatepicker.min.css')}}" />
<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">

<section>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form method="post" action="{{ route('add-assignment') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row content-div">
                            <div class="col-12 row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <select class="select2 form-control mark" name="mark">
                                            <option value="" selected hidden>Select Mark</option>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{$i}}">{{$i}} Mark</option>                                            
                                            @endfor
                                        </select>
                                        <h6 class="mark-error error_message">
                                            Enter Mark.
                                        </h6>
                                        @error('mark')
                                            <h6 class="error_message">{{ $message }}</h6>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="course" id="assignment-course">
                                <input type="hidden" name="week" id="assignment-current-week">
                                <input type="hidden" name="sem-id" id="assign-sem-id">
                                <div class="col-md-4 col-12">
                                    <div class="form-label-group position-relative has-icon-left">
                                        <input type="text" class="form-control lm-input-text assign-start-date" name="start-date" autocomplete="off" id="date2">
                                            <div class="form-control-position">
                                                <i class="mdi mdi-calendar-month"></i>
                                            </div>
                                        <label for="first-name-floating-icon">Semester Start Date</label>
                                        <h6 class="assign-start-date-error error_message">
                                            Select Start Date.
                                        </h6>
                                        @error('start-date')
                                            <h6 class="error_message">{{ $message }}</h6>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-label-group position-relative has-icon-left">
                                        <input type="text" class="form-control lm-input-text assign-end-date" name="end-date" autocomplete="off" id="date3">
                                            <div class="form-control-position">
                                                <i class="mdi mdi-calendar-month"></i>
                                            </div>
                                        <label for="first-name-floating-icon">Semester End Date</label>
                                        <h6 class="assign-end-date-error error_message">
                                            Select End Date.
                                        </h6>
                                        @error('end-date')
                                            <h6 class="error_message">{{ $message }}</h6>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 pb-2">
                                    <div id="file-upload0" class="section">
                                        <div class="row section">
                                            <div class="col s12 m8 l9">
                                                <label for="basicInputFile">Please Attach Assignment.!</label>
                                                <input type="file" name="assignment-file" class="dropify" data-max-file-size="2M" data-height="100" data-allowed-file-extensions="PDF pdf" />
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="assign-file-error error_message">
                                        Attach File.
                                    </h6>
                                    @error('assignment-file')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 btn-submit">
                            <button type="submit" class="btn btn-primary mr-1 col-lg-2 col-md-2 col-sm-12 add-asign">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
   
<script src="{{asset('public/app-assets/datepicker_dari/kamadatepicker.min.js')}}"></script>
<script src="{{asset('public/app-assets/datepicker_dari/kamadatepicker.holidays.js')}}"></script>

<script src="{{asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
<script src="{{asset('public/app-assets/validations/add_assignment.js')}}"></script>
<script>
    $('#assignment-course').val($('#course-id').val());
    $('#assignment-current-week').val($('#current-week').val());
    $('#assign-sem-id').val($('#sem-id').val());

    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });

    var customOptions = {
        placeholder: "Assignment Start Date"
        , twodigit: true
        , closeAfterSelect: true
        , nextButtonIcon: "fa fa-arrow-circle-right"
        , previousButtonIcon: "fa fa-arrow-circle-left"
        , buttonsColor: "blue"
        , forceFarsiDigits: true
        , markToday: true
        , markHolidays: true
        , highlightSelectedDay: true
        , sync: true
        , gotoToday: true
    }

    var customOptions2 = {
        placeholder: "Assignment End Date"
        , twodigit: true
        , closeAfterSelect: true
        , nextButtonIcon: "fa fa-arrow-circle-right"
        , previousButtonIcon: "fa fa-arrow-circle-left"
        , buttonsColor: "blue"
        , forceFarsiDigits: true
        , markToday: true
        , markHolidays: true
        , highlightSelectedDay: true
        , sync: true
        , gotoToday: true
    }
    kamaDatepicker('date2', customOptions);
    kamaDatepicker('date3', customOptions2);

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
</script>