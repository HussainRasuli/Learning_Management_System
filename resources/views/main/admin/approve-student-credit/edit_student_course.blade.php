
<style>
    th.th-tag{
        background:#f8f8f8 !important;
    }
</style>

<section class="client-table" id="role_list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 p-0">
                        <div class="row p-0">
                            <div class="col-6">
                                <h4 class="card-title client-title">Change Course</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-devider" style="margin-top: 13px;"></div>
                <div class="card-content">
              <div class="card-body card-dashboard" style="padding: 1rem .5rem;">
                <div class="table-responsive table-data">
                        <div class="col-12">
                            <table class="table zero-configuration table-hover-animation dataTable no-footer">
                                @if(! $all_course->isEmpty())
                                <thead>
                                    <tr>
                                        <th class="th-tag">Select</th>
                                        <th class="th-tag">Course Name</th>
                                        <th class="th-tag">Teacher Name</th>
                                        <th class="th-tag">Semester</th>
                                        <th class="th-tag">Shift</th>
                                        <th class="th-tag">Department</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data">
                                    @foreach($all_course as $x)
                                    <tr>
                                        <td>
                                            <div class="vs-radio-con vs-radio-primary">
                                                <input type="radio" class="tc_id" name="tc_id" value="{{$x->tc_id}}">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class=""></span>
                                            </div>
                                        </td>
                                        <td>{{$x->course->co_name}}</td>
                                        <td>{{$x->teacher->first_name}} {{$x->teacher->last_name}}</td>
                                        <td>{{$x->sem_id}}</td>
                                        <td>@if($x->shift == 1) Morning @elseif($x->shift == 2) Afternoon @elseif($x->shift == 3) Evening @endif</td>
                                        <td>{{$x->department->dep_name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @else
                                <div>
                                    <div class="alert alert-warning text-center" role="alert">
                                        <p class="mb-0">Not found !</p>
                                    </div>
                                </div>
                                @endif
                            </table>
                            <button type="button" class="btn btn-primary change_student_course">Change Course</button>
                            <div class="col-12 pagination-links">
                            </div>
                    </div>
                    </div>  
               </div>
            </div>
        </div>
    </div>
</section>

<script>
    
    $('.change_student_course').hide();

    $('.tc_id').click(function(){
        $('.change_student_course').show();
    });

</script>


