@extends('layouts.master')
@section('content')
<style>
    .faculty_disable{ 
        pointer-events: not-allowed; 
        cursor: not-allowed; 
    }

    a.faculty_disable:hover {
        cursor:not-allowed;
    }

</style>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
             <div class="card-header col-12 pr-0">
                 <h4>Add Faculty</h4>
                    <div class="col-3">
                        <button type="button" class="btn btn-icon rounded-circle btn-danger mr-1 mb-1 waves-effect waves-light minus" disabled><i class="feather icon-minus"></i></button>
                        <button type="button" class="btn btn-icon rounded-circle btn-info mr-1 mb-1 waves-effect waves-light plus"><i class="feather icon-plus"></i></button>
                        <a href="{{route('faculty')}}"><button type="button" class="btn btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light float-right"><i class="feather icon-arrow-right"></i></button></a>
                   </div>
                </div>
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="post" action="{{route('add-faculty')}}">
                            @csrf
                            <div class="form-body">
                              <div class="content-div row">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text faculty" id="faculty" name="faculty" placeholder="Faculty Name">
                                                <div class="form-control-position">
                                                    <i class="fa fa-university"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Faculty Name</label>
                                            <h6 id="faculty-name-error" class="error_message">
                                                Enter Faculty Name.
                                            </h6>
                                            @error('faculty')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text faculty-department-name" name="department[]" placeholder="Department Name">
                                                <div class="form-control-position">
                                                    <i class="far fa-building"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Department Name</label>
                                            <h6 id="department-name-error" class="error_message">
                                                Enter Department Name.
                                            </h6>
                                            @error('department')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="number" class="form-control lm-input-text dep-code" name="dep_code[]" placeholder="Department Code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="2">
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-numeric"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Department Code</label>
                                            <h6 id="dep-code-error" class="error_message">
                                                Enter Department Code.
                                            </h6>
                                            @error('dep_code')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 btn-submit">
                                    <button type="submit" id="btn_submit" class="btn btn-primary mr-1 mb-1 col-lg-2 col-md-2 col-sm-12">Add</button>
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
    <script src="{{asset('public/app-assets/validations/faculty.js')}}"></script>
    <script>
        var x = 1;
       $('.plus').click( function(){
         if(x == 1){
            $('.minus').attr('disabled',false);
         }
            var faculty = $('.faculty').val();
           x++;
           var content = " <div class='row col-md-12' id='y"+x+"'>\
                         <div class='col-md-4 col-12'>\
                                <div class='form-label-group position-relative has-icon-left'>\
                                    <input type='text' class='form-control lm-input-text faculty_disable'\
                                        name='faculty' placeholder='Faculty Name' value='"+faculty+"' disabled>\
                                        <div class='form-control-position'>\
                                            <i class='fa fa-university'></i>\
                                        </div>\
                                    <label for='first-name-floating-icon'>Faculty Name\
                                    </label>\
                                </div>\
                            </div> \
                            <div class='col-md-4 col-12'>\
                                <div class='form-label-group position-relative has-icon-left'>\
                                  <input type='text' class='form-control lm-input-text' name='department[]' placeholder='Department Name'>\
                                    <div class='form-control-position'>\
                                  <i class='far fa-building'></i>\
                                </div><label for='first-name-floating-icon'>Department Name</label></div>\
                           </div>\
                            <div class='col-md-4 col-12'>\
                                <div class='form-label-group position-relative has-icon-left'>\
                                    <input type='number' class='form-control lm-input-text'\
                                        name='dep_code[]' placeholder='Department Code' oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' maxLength='2'>\
                                        <div class='form-control-position'>\
                                            <i class='mdi mdi-numeric'></i>\
                                        </div>\
                                    <label for='first-name-floating-icon'>Department Code\
                                    </label>\
                                </div>\
                            </div>\
                            </div>\
                            ";

           $('.content-div').append(content);
        });

       $('.minus').click( function(){
           $("#y"+x).remove(); 
           x--
           if(x == 1){
            $('.minus').attr('disabled',true);
           }
           ;
       });

       $('.faculty').keyup(function(){
          var faculty = $(this).val();
          $('.faculty_disable').val(faculty);
       });
    </script>

@endsection
@endsection