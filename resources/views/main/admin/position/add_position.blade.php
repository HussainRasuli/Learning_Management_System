@extends('layouts.master')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header col-12 pr-0">
                    <p class="font-weight-bold" style="font-size: 1.2rem;">Add Position</p>
                    <div class="col-3">
                        <button type="button" class="btn btn-icon rounded-circle btn-danger mr-1 mb-1 waves-effect waves-light minus" disabled><i class="feather icon-minus"></i></button>
                        <button type="button" class="btn btn-icon rounded-circle btn-info mr-1 mb-1 waves-effect waves-light plus"><i class="feather icon-plus"></i></button>
                       <a href="{{route('position_list')}}"><button type="button" class="btn btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light float-right new_dep_back"><i class="feather icon-arrow-left"></i></button></a>
                    </div>
                </div>
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="post" action="{{route('add_position')}}">
                            @csrf
                            <input type="hidden" name="faculty_id" value="">
                            <div class="form-body">
                                <div class="row content-div">
                                  <div class="col-12 row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text" id="position" name="position[]" placeholder="Position Name">
                                                <div class="form-control-position">
                                                    <i class="feather icon-briefcase"></i>
                                                </div>
                                            <label for="first-name-floating-icon">Position Name</label>
                                            <h6 id="position-error" class="error_message">
                                                Enter Position Name.
                                            </h6>
                                            @error('position')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <select class="select2 form-control position_type" name="position_type[]" id="position-type">
                                                <option value="" selected hidden>Select Position Type</option>
                                                @foreach($position_type as $x)
                                                  <option value="{{$x->position_type_id}}">{{$x->position_type_name}}</option>
                                                @endforeach
                                            </select>
                                            <h6 id="position-type-error" class="error_message">
                                                Select Position Type.
                                            </h6>
                                            @error('position_type')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-12">
                                        <fieldset class="form-label-group has-icon-left">
                                            <textarea class="form-control" id="label-textarea" rows="1" name="description[]" placeholder="Description" style="line-height: 1.4rem;"></textarea>
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-message"></i>
                                                </div>
                                            <label for="label-textarea">Description</label>
                                        </fieldset>
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
<script src="{{asset('public/app-assets/validations/position.js')}}"></script>
<script>
        var x = 1;
       $('.plus').click( function(){
         let position_type_id = $('.position_type').val();
        
         if(x == 1){
            $('.minus').attr('disabled',false);
         }
           x++;
           var content = 
                    '<div class="col-12 row" id="y-'+x+'">\
                    <div class="col-md-4 col-12">\
                    <div class="form-label-group position-relative has-icon-left">\
                    <input type="text" class="form-control lm-input-text" name="position[]" placeholder="Position Name">\
                    <div class="form-control-position"><i class="feather icon-briefcase"></i></div>\
                    <label for="first-name-floating-icon">Position Name</label></div>\
                    </div>\
                    <div class="col-md-4 col-12">\
                        <div class="form-group">\
                            <select class="select2 form-control" name="position_type[]">\
                                <option value="" selected hidden>Select Position Type</option>\
                                @foreach($position_type as $x)\
                                  @if($x->position_type_id != '+1+')\
                                    <option value="{{$x->position_type_id}}">{{$x->position_type_name}}</option>\
                                  @endif\
                                @endforeach\
                            </select>\
                        </div>\
                    </div> \
                    <div class="col-md-4 col-12">\
                         <fieldset class="form-label-group has-icon-left">\
                            <textarea class="form-control" id="label-textarea" rows="1" name="description[]" placeholder="Description" style="line-height: 1.4rem;"></textarea>\
                                <div class="form-control-position">\
                                    <i class="mdi mdi-message"></i>\
                                </div>\
                            <label for="label-textarea">Description</label>\
                        </fieldset>\
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
           ;
       });

</script>
@endsection
@endsection