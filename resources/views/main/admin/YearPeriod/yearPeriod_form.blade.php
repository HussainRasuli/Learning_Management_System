@extends('layouts.master')
@section('content')
    @include('layouts.jdf')

    @section('style')
        <link rel="stylesheet" href="{{asset('public/app-assets/datepicker_dari/kamadatepicker.min.css')}}" />
    @endsection


<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header col-12 pr-0">
                    <p class="font-weight-bold" style="font-size: 1.2rem;">Add Year & Period</p>
                    <div class="col-3">
                       <a href="{{route('yearPeriod_list')}}"><button type="button" class="btn btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light float-right new_dep_back"><i class="feather icon-arrow-left"></i></button></a>
                    </div>
                </div>
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="post" action="{{route('add_yearPeriod')}}">
                            @csrf
                            <input type="hidden" name="faculty_id" value="">
                            <div class="form-body">
                                <div class="row content-div">
                                    <div class="col-12 row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <select class="select2 form-control" name="year" id="years">
                                                    <option value="" selected hidden>Select Year</option>
                                                    <option value="<?php echo jdate("Y","","","","en"); ?>"><?php echo jdate("Y","","","","en"); ?> </option>
                                                </select>
                                                <h6 id="year-error" class="error_message">
                                                    Select Year.
                                                </h6>
                                                @error('year')
                                                    <h6 class="error_message">{{ $message }}</h6>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <select class="select2 form-control" name="period" id="period">
                                                    <option value="" selected hidden>Select Period</option>
                                                    <option value="1">Spring</option>
                                                    <option value="2">Fall</option>
                                                </select>
                                                <h6 id="period-error" class="error_message">
                                                    Select Period.
                                                </h6>
                                                @error('period')
                                                    <h6 class="error_message">{{ $message }}</h6>
                                                @enderror
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-12">
                                            <div class="form-label-group position-relative has-icon-left">
                                                <input type="text" class="form-control lm-input-text" name="start-date" autocomplete="off" id="date1">
                                                    <div class="form-control-position">
                                                        <i class="mdi mdi-calendar-month"></i>
                                                    </div>
                                                <label for="first-name-floating-icon">Semester Start Date</label>
                                                <h6 id="start-date-error" class="error_message">
                                                    Select Semester Start Date.
                                                </h6>
                                                @error('start-date')
                                                    <h6 class="error_message">{{ $message }}</h6>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 btn-submit">
                                    <button type="submit" id="year-btn" class="btn btn-primary mr-1 mb-1 col-lg-2 col-md-2 col-sm-12">Add</button>
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
    <script src="{{asset('public/app-assets/datepicker_dari/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('public/app-assets/datepicker_dari/kamadatepicker.holidays.js')}}"></script>
    <script src="{{asset('public/app-assets/validations/yearPeriod.js')}}"></script>

    <script>
		var customOptions = {
			placeholder: "Semester Start Date"
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
		kamaDatepicker('date1', customOptions);
	</script>
@endsection
@endsection