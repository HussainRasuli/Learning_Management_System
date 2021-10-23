<div class="table-responsive-mobile">
    <form action="{{ route('approving-courses') }}" method="post">
        @csrf
        <table class="table zero-configuration table-hover-animation example">
            <thead>
                <tr>
                    <th class="th-tag">No</th>
                    <th class="th-tag">Course Name</th>
                    <th class="th-tag">Lecturer</th>
                    <th class="th-tag">Semester</th>
                    <th class="th-tag">Shift</th>
                    <th class="th-tag">Day</th>
                    <th class="th-tag">Approve</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach($data as $row)
                    <tr>
                        <th>{{$i}}</th>
                        <td>{{$row->course->co_name}}</td>
                        <td>{{$row->teacher->first_name}} {{$row->teacher->last_name}}</td>
                        <td>
                            <span class="badge badge-info" style="padding: .5rem 1.7rem; letter-spacing: 1px;">{{$row->sem_id}}</span>
                        </td>
                        <td>
                            @if($row->shift == 1) 
                                <span class="badge badge-success" style="padding: .5rem 1.7rem; letter-spacing: 1px;">Morning</span>
                            @elseif($row->shift == 2)
                                <span class="badge badge-warning" style="padding: .5rem 1.3rem; letter-spacing: 1px;">Afternoon</span>
                            @else
                                <span class="badge badge-primary" style="padding: .5rem 1.7rem; letter-spacing: 1px;">Evening</span>
                            @endif
                        </td>
                        <td>{{$row->days->day_name}}</td>
                        <td class="text-center">
                            @can('approve-course')
                                <div class="custom-control custom-switch switch-lg custom-switch-success mr-2">
                                    <input type="checkbox" class="custom-control-input approve-btn edit_checkitem" name="course-approve[]" id="customSwitch{{$i}}" value="{{$row->tc_id}}">
                                    <label class="custom-control-label" for="customSwitch{{$i}}">
                                        <span class="switch-text-left"><i class="fa fa-check"></i>Approve</span>
                                        <span class="switch-text-right"><i class="fa fa-times"></i> Dismiss</span>
                                    </label>
                                </div>
                            @endcan
                        </td>
                        <input type="hidden" name="department" value="{{$row->dep_id}}">
                    </tr>
                    @php $i++ @endphp
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary approve-course-submit-btn">Approve Courses</button>
    </form>
</div>





<script>
    $("#check-all").click (function () {
        $(" input[type='checkbox']").prop('checked',this.checked);
    });

    $(".checkitems").change(function () {
        if($(this).prop("checked")==false){
            $("#select-all").prop("checked", false)
        }
        if($(".checkitem:checked").length == $(".checkitem").length){
            $("#select-all").prop("checked", true)
        }
    });

    $('.approve-course-submit-btn').hide();
    let x = 0;
    $(".edit_checkitem").click(function () {
        if($(this).prop("checked") == true){
          
            $('.approve-course-submit-btn').show();
          x++;
        }if($(this).prop("checked") == false){
          x--;
          if(x <= 0){

            $('.approve-course-submit-btn').hide();
          }
        }
    });

  

</script>