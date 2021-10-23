

<style>
 th.th-tag{
     background:#f8f8f8 !important;
 }

</style>
<div id="student_assignment_table">
@if(! $data->isEmpty())
<div class="col-12">
    <table class="table table-hover-animation table-1">
        <thead>
            <tr>
            <th class="text-center th-tag">No</th>
                <th class="th-tag">ID Number</th>
                <th class="th-tag">Full Name</th>
                <th class="th-tag">Photo</th>
                <th class="th-tag">Action</th>
            </tr>
        </thead>
        <tbody id="table_data">
            @php $i=1 @endphp
            @foreach($data as $row)
                <tr id="student-{{$row->stu_id}}">
                <td class="text-center">{{$i}}</td>
                <td>{{$row->unique_id}}</td>
                <td>{{$row->first_name}} {{$row->last_name}}</td>
                
                @if($row->photo != '')
                        <td><img  class="media-object rounded-circle" src="{{ url('/storage/app/student/'.$row->photo) }}" height="40px" width="40px"></td>
                    @elseif($row->gender == 1)
                        <td><img class="media-object rounded-circle" src="{{asset('public/app-assets/images/user/male_user.jpg')}}" height="40px" width="40px"></td>
                    @elseif($row->gender == 2)
                        <td><img class="media-object rounded-circle" src="{{asset('public/app-assets/images/user/female_user.jpg')}}" height="40px" width="40px"></td>
                @endif
                <td>
                    <a href="#" class="action-btn view-btn view_student_assignment" id="{{$row->stu_id}}" as_id="{{$as_id}}" title="Show"><i class="mdi mdi-eye"></i></a>
                </td>
            </tr>
            @php $i++ @endphp
            @endforeach
        </tbody>
    </table>
</div>
@else
    <div>
        <div class="alert alert-warning text-center" role="alert">
            <p class="mb-0">No Assignments Available.</p>
        </div>
    </div>
@endif
</div>

<div class="student_assignment_div"></div>
<script>
    $(document).on('click','.view_student_assignment' , function(){ 
        var stu_id = $(this).attr('id');
        var as_id = $(this).attr('as_id');
        $.get("{{route('view_student_assignment')}}/" + stu_id + "/" + as_id, function(response) {
            // console.log(response);
            $('#student_assignment_table').hide();
            $('.student_assignment_div').html(response);
        });
    });

    $(document).on('click','.back_form_ass_details', function(){
    $('.student_assignment_div1').hide();
    $('.pdf-div').hide();
    $('#student_assignment_table').show();
 });
</script>

