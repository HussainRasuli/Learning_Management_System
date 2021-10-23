@include('layouts.jdf')

@if(!$materials->isEmpty())
<style>
    .badge i {
        font-size: 1rem !important;
    }
</style>
<input type="hidden" name="relevant_week" id="relevant_week" value="@foreach($materials as $x) {{$x->week}}  @break @endforeach">
<input type="hidden" name="relevant_course" id="relevant_course" value="@foreach($materials as $x) {{$x->co_id}}  @break @endforeach">
<?php $now_date = jdate("Y-m-j","","","","en") ?>
<div class="table-responsive ml-3">
    <table class="table table-hover-animation">
        <thead>
            <tr>
                <th>Assignment</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
        </thead>
        <tbody>
            @php $j = 1 @endphp
            @foreach($materials as $data)
            
            <tr id="assignment-{{$j}}">
                <td>{{ pathinfo($data->file_path, PATHINFO_FILENAME) }}</td>
                <td>{{ $data->assignment_details->start_date }}</td>
                <td>{{ $data->assignment_details->end_date }}</td>
                <td>
                    <span class="badge badge-warning badge-pill badge-custom view-assignment" title="View" data="/storage/app/course/course-assignment/{{$data->file_path}}"><i class="mdi mdi-eye"></i></span> 
                @can('view_details_assignment') 
                    <span class="badge badge-primary badge-pill badge-custom student_assignment_list" data="{{ $data->assignment_details->as_id }}" title="Students Assignments"><i class="mdi mdi-playlist-edit"></i></span> 
                @endcan
                    <a href="{{ route('download-assignment') . '/' . $data->file_path}}"><span class="badge badge-info badge-pill badge-custom" title="Download"><i class="mdi mdi-download"></i></span></a>
                @can('student_add_assignment')
                    @if($now_date < $data->assignment_details->end_date)
                    <span class="badge badge-primary badge-pill badge-custom status_assignment_btn" stu_id="{{Auth::user()->record_id}}" data="{{$x->assignment_details->as_id}}" title="Status Assignment"><i class="feather icon-file-text"></i></span>
                        <span class="badge badge-primary badge-pill badge-custom send_assignment_btn" data="{{$data->ma_id}}" date="<?php echo jdate("Y-m-j","","","","en") ?>" title="Send Assignment"><i class="feather icon-navigation"></i></span>
                    @endif
                @endcan
                @can('delete_assignment') 
                    <span class="badge badge-danger badge-pill badge-custom delete-assignment" title="Delete" data-material="{{$data->ma_id}}" data="{{$data->assignment_details->as_id}}" data-j="{{$j}}"><i class="mdi mdi-window-close"></i></span>
                @endcan
                </td>
            </tr>
            @php $j++ @endphp
            @endforeach
        </tbody>
    </table>
</div>
@else 
    <div class="ml-3">
        <li class="list-group-item font-weight-bolder">Online Lecture Assignment</li>
        <li class="list-group-item">No Assignment Available</li>
    </div>
@endif



    