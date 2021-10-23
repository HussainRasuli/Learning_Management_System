@extends('layouts.master')
@section('content')
<section>
    <div class="col-12 p-0">
        <div class="card">
            <div class="card-header p-0 p-1">
                <h4 class="card-title">Add New Course</h4>
                <div class="col-3 d-flex justify-content-xl-end">
                    <button type="button" class="btn btn-icon rounded-circle btn-danger waves-effect waves-light minus" disabled><i class="feather icon-minus"></i></button>
                    <button type="button" class="btn btn-icon rounded-circle btn-info ml-1 waves-effect waves-light plus"><i class="feather icon-plus"></i></button>
                </div>
            </div>
            <div class="div-devider"></div>
            <div class="card-content">
                <div class="card-body">
                    <form method="POST" action="{{route('add-course')}}">
                        @csrf
                        <div class="form-body">
                            <div class="row content-div">
                                <div class="col-12 row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control semester-first" name="semester">
                                                <option value="" selected hidden>Select Semester</option>
                                                @foreach($data as $sem)
                                                    <option value="{{$sem->sem_id}}">{{$sem->sem_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control" name="credit[]">
                                                <option value="" selected hidden>Select Credit</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="6">6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text" name="course[]" placeholder="Course Name" required>
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Course Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 btn-submit">
                                <button type="submit" class="btn btn-primary mr-1 mb-1">Add Course</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    @section('script')
        <script>
            var x = 1;
            $('.plus').click( function(){
                if(x == 1){
                    $('.minus').attr('disabled',false);
                }
                x++;
                var semester = $('.semester-first').val();
                var content = 
                '<div class="col-12 row" id="y-'+x+'">\
                    <div class="col-md-4 col-12">\
                        <div class="form-group">\
                            <select class="form-control semester" disabled name="semester">\
                            <option value="" selected class="semester-value">Semester '+' '+semester+'</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="col-md-4 col-12">\
                        <div class="form-group">\
                            <select class="select2 form-control" name="credit[]">\
                                <option value="" selected hidden>Select Credit</option>\
                                <option value="1">1</option>\
                                <option value="2">2</option>\
                                <option value="3">3</option>\
                                <option value="4">4</option>\
                                <option value="6">6</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="col-md-4 col-12">\
                        <div class="form-label-group position-relative has-icon-left">\
                            <input type="text" class="form-control lm-input-text" name="course[]" placeholder="Course Name" required>\
                                <div class="form-control-position">\
                                    <i class="mdi mdi-message"></i>\
                                </div>\
                            <label for="first-name-floating-icon">Course Name</label>\
                        </div>\
                    </div>\
                </div>';
                $('.content-div').append(content);

                $(".select2").select2({
                    dropdownAutoWidth: true,
                    width: '100%'
                });
            });

            $('.minus').click( function(){
                $("#y-"+x).remove(); 
                x--
                if(x == 1){
                    $('.minus').attr('disabled',true);
                }
            });

            $('.semester-first').change(function() {
                $('.semester-value').text('Semester ' + $(this).val());
            });
        </script>
    @endsection
@endsection