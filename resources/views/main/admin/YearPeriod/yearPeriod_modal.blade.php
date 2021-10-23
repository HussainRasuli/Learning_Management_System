@include('layouts.jdf')

<link rel="stylesheet" href="{{asset('public/app-assets/datepicker_dari/kamadatepicker.min.css')}}" />

<div class="modal-primary mr-1 mb-1 d-inline-block">
    <!-- Modal -->
    <div class="modal fade text-left" id="YearPeriod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary white">
                    <h5 class="modal-title" id="myModalLabel160">Edit Year and Period</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="edit_YearPeriod_btn">
                    @csrf
                    <input type="hidden" value="{{$data->log_id}}" name="log_id">
                    <div class="modal-body mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="select2 form-control year" name="year">
                                    <option value="<?php echo jdate("Y","","","","en"); ?>" @if($data->year == jdate("Y","","","","en") ) selected @endif> <?php echo jdate("Y","","","","en"); ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="select2 form-control period" name="period">
                                    <option value="1" @if($data->period == 1) selected @endif>Spring</option>
                                    <option value="2" @if($data->period == 2) selected @endif>Fall</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text" name="start-date" id="date2" value="{{$data->semester_start_date}}" required>
                                    <div class="form-control-position">
                                        <i class="mdi mdi-calendar-month"></i>
                                    </div>
                                <label for="first-name-floating-icon">Semester Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text" name="end-date" id="date3" value="{{$data->semester_end_date}}" placeholder="Semester End Date" required>
                                    <div class="form-control-position">
                                        <i class="mdi mdi-calendar-month"></i>
                                    </div>
                                <label for="first-name-floating-icon">Semester End Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit_YearPeriod_btn" data-dismiss="modal">Edit</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>

    <script>
    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
    </script>
    <script src="{{asset('public/app-assets/datepicker_dari/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('public/app-assets/datepicker_dari/kamadatepicker.holidays.js')}}"></script>

    <script>
		var customOptions = {
			placeholder: "Semester End Date"
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
        kamaDatepicker('date3', customOptions);
	</script>