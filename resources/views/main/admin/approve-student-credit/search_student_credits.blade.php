@extends('layouts.master')
@section('content')
<div class="col-12 p-0" id="search_student_div">
    <div class="card">
        <div class="card-header d-flex mb-1">
            <h4 class="card-title">Search Student</h4>
            <a href="{{route('student_credit_list')}}">
               <button type="button" class="btn btn-icon rounded-circle btn-primary waves-effect waves-light back_gc"><i class="feather icon-arrow-left"></i></button>
            </a>
        </div>
        <div class="div-devider"></div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5 col-8">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="number" class="form-control lm-input-text student-id" placeholder="ID Number">
                                <div class="form-control-position">
                                    <i class="mdi mdi-numeric"></i>
                                </div>
                            <label for="first-name-floating-icon">ID Number</label>
                        </div>
                    </div>
                    <div class="col-2" style="padding-left: 5px;padding-top: 2px;">
                        <button class="search student-search float-left"><i class="feather icon-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="student-search-form" hidden>
    @csrf
    <input type="text" name="id_number" id="id_number">
</form>
<div class="data"></div>
@section('script')
  <script>
        $('.student-search').click(function() {
            var id = $('.student-id').val();
            $('#id_number').val(id);
            loader();
            $.get("{{ route('get_student_credit') }}", $('#student-search-form').serialize(), function(data){
                $('.data').html(data);
            });
        });

    $(document).on('click','.change_course', function(){
       let sc_id =   $(this).attr('id');
       $('#id_number').val(sc_id);
       $('#search_student_div').hide();
       $('.details_student_credit').hide();
       $.get("{{route('change_course')}}", $('#student-search-form').serialize(), function(response){
           $('.data').html(response);
       });
    });
  </script>
@endsection
@endsection