

@include('layouts.jdf')
<style>
    .list-group-item{
        cursor: pointer;
    }

    .list-group-item:first-child, .list-group-item:last-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .list-group .list-group-item span i {
        font-size: 1rem !important;
    }

    .badge-custom {
        padding-right: 0.4em !important;
        padding-left: 0.4em !important;
        border-radius: 9rem !important;
        cursor: pointer;
    }

    #show{
        display: block;
    }

    #hide{
        display: none;
    }

    .active-week{
        background-color:#2d6eb4; 
        color: white;
    }

    .active-week:hover{
        background-color:#2d6eb4 !important; 
        color: white !important;
    }
</style>

<section class="col-md-12 p-0 student_assignment_div1">
<button type="button" class="btn btn-icon rounded-circle btn-info mb-1 float-left back_form_ass_details" title="Back">
    <i class="feather icon-arrow-left"></i>
</button>
    <div class="col-md-12 row">
    <div class="col-md-3 mb-2 mb-md-0 pt-1" style="background-color: #f7f7f7f2; border-radius: 5px;">
        <div id="profile-container" class="users-view-image col-md-11">
            @if($student_data->photo != '')
                <img class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{ url('/storage/app/student/'.$student_data->photo) }}" alt="{{$student_data->first_name}}'s photo">
            @elseif($student_data->gender == 1)
            <img class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{asset('public/app-assets/images/user/male_user.jpg')}}" alt="{{$student_data->first_name}}'s photo">
            @elseif($student_data->gender == 2)
                <img class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{asset('public/app-assets/images/user/female_user.jpg')}}" alt="{{$student_data->first_name}}'s photo">
            @endif
        </div>  
        <div class="col-md-11 pb-1" style="text-align: center;font-weight: bold;">Name: {{$student_data->first_name}} {{$student_data->last_name}}</div>
        <div class="col-md-11 pb-1" style="text-align: center;font-weight: bold;">ID: {{$student_data->unique_id}}</div>
    </div>

        <div class="col-md-9 p-0 assignment-data-view">
                <div class="table-responsive ml-3">
                    <table class="table table-hover-animation">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Assignment</th>
                                <th>Sent Date</th>
                                <th>Status</th>
                                <th>Mark</th>
                                <th>Action</th>
                        </thead>
                        <tbody>
                            @php $j = 1 @endphp
                            @foreach($student_assignments as $data)
                                @foreach($data->material as $file)
                                    <tr>
                                        <td>{{$j}}</td>
                                        <td>{{ pathinfo($file->file_path, PATHINFO_FILENAME) }}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td>
                                            @if($data->status == 0)
                                            <div class="badge badge-pill badge-info mr-1">Not check yet</div>
                                            @elseif($data->status == 1)
                                            <div class="badge badge-pill badge-success mr-1">Confirmed</div>
                                            @elseif($data->status == 2)
                                            <div class="badge badge-pill badge-warning mr-1">Submit again</div>
                                            @elseif($data->status == 3)
                                            <div class="badge badge-pill badge-danger mr-1">Rejected</div>
                                            @endif
                                        </td>
                                        <td>@if($data->mark == '') NA @else {{$data->mark}} @endif</td>
                                        <td>
                                            <span class="badge badge-warning badge-pill badge-custom view_student_assignment" title="View" data="/storage/app/course/student-assignment/{{$file->file_path}}"><i class="mdi mdi-eye"></i></span> 
                                            <a href="{{ route('download-student-assignment') . '/' . $file->file_path}}"><span class="badge badge-info badge-pill badge-custom" title="Download"><i class="mdi mdi-download"></i></span></a>
                                        @if($data->status == 0)
                                            <span class="badge badge-primary badge-pill badge-custom mark" sg_id="{{$data->sg_id}}" assign_mark="{{$data->assignment->full_mark}}" title="Mark"><i class="feather icon-check-square"></i></span>
                                            <span class="badge badge-warning badge-pill badge-custom resubmit" sg_id="{{$data->sg_id}}" title="Report for resubmit"><i class="feather icon-info"></i></span>
                                            <span class="badge badge-danger badge-pill badge-custom reject" sg_id="{{$data->sg_id}}" title="Reject"><i class="feather icon-slash"></i></span>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @php $j++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
           </div>
       </div>
</section>
    
<form id="student_ass_form" hidden="">
    @csrf
    <input type="text" name="file_path" id="file_path">
</form>

<div class="modals"></div>
<div class="pdf-div"></div>
<script>

   $('.mark').click( function(){
        var sg_id = $(this).attr('sg_id');
        let mark  = $(this).attr('assign_mark');
        $.get("{{ route('student_mark_modal') }}/" + sg_id + "/" + mark, function(response) {
            $('.modals').html(response);
            $('#student_mark_modal').modal('show');
        });
    });

    $('.resubmit').click( function(){
     var sg_id = $(this).attr('sg_id');
        $.get("{{ route('student_resubmit_modal') }}/" + sg_id, function(response) {
            $('.modals').html(response);
            $('#student_resubmit_modal').modal('show');
        });
    });

    $('.reject').click( function(){
     var sg_id = $(this).attr('sg_id');
        $.get("{{ route('student_reject_modal') }}/" + sg_id, function(response) {
            $('.modals').html(response);
            $('#student_reject_modal').modal('show');
        });
    });
    

$('.pdf-div').hide();
$('.view_student_assignment').click( function(){
        let filePath = $(this).attr('data');
        $('#file_path').val(filePath);
        $('.student_assignment_div1').hide();
        $('.pdf-div').show();
        $.post("{{ route('view_pdf_student_ass') }}", $('#student_ass_form').serialize(), function(response) {
            // console.log(response);
        
         $('.pdf-div').html(response);

        });
    });

 $(document).on('click','.close_ass_viewer',function(){
    $('.pdf-div').hide();
    $('.student_assignment_div1').show();
    
 });

 
</script>