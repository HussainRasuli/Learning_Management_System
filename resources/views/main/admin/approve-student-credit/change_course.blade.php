
<div class="col-12 p-0" id="search_student_div">
    <div class="card">
        <div class="card-header d-flex mb-1">
            <h4 class="card-title">Search Course</h4>
            <a href="{{route('search_student_credits')}}">
               <button type="button" class="btn btn-icon rounded-circle btn-primary waves-effect waves-light back_gc"><i class="feather icon-arrow-left"></i></button>
            </a>
        </div>
        <div class="div-devider"></div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-md-4 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" class="form-control lm-input-text course_name" placeholder="Course Name">
                                <div class="form-control-position">
                                  <i class="mdi mdi-message"></i>
                                </div>
                            <label for="first-name-floating-icon">Course Name</label>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <select class="select2 form-control semester" name="semester">
                            <option value="" selected hidden>Select Semester</option>
                            @foreach($semester as $x)
                                <option value="{{$x->sem_id}}">{{$x->sem_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-12">
                        <button class="search search-course float-left"><i class="feather icon-search"> Search</i></button>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<form id="edit_student_course" hidden>
    @csrf
   <input type="text" name="old_tc_id" class="old_tc_id" value="{{$student_course_id->sc_id}}">
   <input type="text" name="new_tc_id" class="new_tc_id">
</form>

<form id="edit-student-credit" hidden>
    @csrf
    <input type="text" name="course_name" id="course_name">
    <input type="text" name="semester" id="semester">
</form>
<div class="courses"></div>

<script>

    $('.search-course').click(function() {
        var course_name = $('.course_name').val();
        var semester = $('.semester').val();
        $('#course_name').val(course_name);
        $('#semester').val(semester);
        $.post("{{ route('show_student_course') }}", $('#edit-student-credit').serialize(), function(data){
            $('.courses').html(data);
        });
    });

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

    $(document).on('click','.change_student_course', function(){
            Swal.fire({
                title: 'Do you want to change the desired course?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, change it`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var new_course_id  = $('input[name="tc_id"]:checked').val();
                    $('.new_tc_id').val(new_course_id);
                    $.post("{{route('change_student_course')}}", $('#edit_student_course').serialize() , function(response){
                        if(response == 'Updated'){
                            Swal.fire('Course changed successfully', '', 'success');
                            loadPage();
                        }else{
                            alert('Error');
                        }
                    });
                }
            });
        });


</script>