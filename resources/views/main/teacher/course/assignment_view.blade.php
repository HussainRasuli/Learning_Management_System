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

    .badge i {
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

<section class="col-md-12 p-0 assignment-week-list">
    <div class="divider divider-info">
        <div class="divider-text">Assignment Week List</div>
        <?php $now_date = jdate("Y-m-j","","","","en") ?>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-2 p-0">
            <ul class="list-group list-group-flush">
                @foreach($weeks as $week)
                    @if($week->week != 0)
                        @if($current_week == $week->week)
                            <li class="list-group-item active-week assgin-week-btn" data-week="{{$week->week}}"><i class="mdi mdi-link-variant mr-1"></i>Week {{$week->week}}</li>
                            <script>
                                $('.current-week-display').removeAttr('id');
                                $('.current-week-display').attr('id', 'hide');
                            </script>
                        @else
                            <li class="list-group-item assgin-week-btn" data-week="{{$week->week}}"><i class="mdi mdi-link-variant mr-1"></i>Week {{$week->week}}</li>
                            <script>
                                $('.current-week-display').removeAttr('id');
                                $('.current-week-display').attr('id', 'show');
                            </script>
                        @endif
                    @endif
                @endforeach
                <li class="list-group-item current-week-display active-week assgin-week-btn" data-week="{{$current_week}}"><i class="mdi mdi-link-variant mr-1"></i>Week {{$current_week}}</li>
            </ul>
        </div>
        <div class="col-md-10 p-0 assignment-data-view">
   
            @if(!$materials->isEmpty())
            <input type="hidden" name="relevant_week" id="relevant_week" value="@foreach($materials as $x) {{$x->week}}  @break @endforeach">
            <input type="hidden" name="relevant_course" id="relevant_course" value="@foreach($materials as $x) {{$x->co_id}}  @break @endforeach">
                <div class="table-responsive ml-3">
                    <table class="table table-hover-animation">
                        <thead>
                            <tr>
                                <th>Assignment</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Full Mark</th>
                                <th>Action</th>
                        </thead>
                        <tbody>
                            @php $j = 1 @endphp
                            @foreach($materials as $data)
                            <tr id="assignment-{{$j}}">
                                <td>{{ pathinfo($data->file_path, PATHINFO_FILENAME) }}</td>
                                <td>{{ $data->assignment_details->start_date }}</td>
                                <td>{{ $data->assignment_details->end_date }}</td>
                                <td>{{ $data->assignment_details->full_mark}}</td>
                                <td>
                                    <span class="badge badge-success badge-pill badge-custom edit-assignment" data="{{$data->assignment_details->as_id}}" start="{{$data->assignment_details->start_date}}" end="{{$data->assignment_details->end_date}}" title="Edit"><i class="mdi mdi-calendar-edit"></i></span>
                                    <span class="badge badge-warning badge-pill badge-custom view-assignment" title="View" data="/storage/app/course/course-assignment/{{$data->file_path}}"><i class="mdi mdi-eye"></i></span> 
                                    @can('view_details_assignment') 
                                        <span class="badge badge-primary badge-pill badge-custom student_assignment_list" data="{{ $data->assignment_details->as_id }}" title="Students Assignments"><i class="mdi mdi-playlist-edit"></i></span> 
                                    @endcan
                                        <a href="{{ route('download-assignment') . '/' . $data->file_path}}"><span class="badge badge-info badge-pill badge-custom" title="Download"><i class="mdi mdi-download"></i></span></a>
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
        </div>
    </div>
</section>



<form id="assignment-form" hidden="">
    @csrf
    <input type="text" name="data" id="material">
    <input type="text" name="data2" id="assignment">
</form>

<form id="student_assignment_form" hidden>
    @csrf
    <input type="text" name="ma_id" id="ma_id">
    <input type="text" name="date" id="date">
    <input type="text" name="ass_week" id="ass_week">
    <input type="text" name="as_id" id="as_id">
</form>

<div class="response"></div>

<link rel="stylesheet" href="{{asset('public/app-assets/datepicker_dari/kamadatepicker.min.css')}}" />

<div class="modal-primary mr-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="edit-assignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary white">
                    <h5 class="modal-title" id="myModalLabel160">Edit Assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-assginment-form">
                    @csrf
                    <input type="hidden" name="ass-id" id="ass-id">
                    <div class="modal-body mt-2">
                        <div class="col-md-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text start" name="start-date" autocomplete="off" id="date4">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-calendar-month"></i>
                                    </div>
                                <label for="first-name-floating-icon">Assignment Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text end" name="end-date" id="date5" autocomplete="off" placeholder="Semester End Date">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-calendar-month"></i>
                                    </div>
                                <label for="first-name-floating-icon">Assignment End Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit-assignment-form" data-dismiss="modal">Edit</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>

<script src="{{asset('public/app-assets/datepicker_dari/kamadatepicker.min.js')}}"></script>
<script>
    $(document).on('click','.back_status_studnet_ass', function(){
        $('.student_assignment_div1').hide();
        $('.pdf-div').hide();
        $('.assignment-week-list').show();
    });

    $(document).on('click', '.edit-assignment', function(){
        $('#ass-id').val($(this).attr('data'));
        $('.start').val($(this).attr('start'));
        $('.end').val($(this).attr('end'));

        $('#edit-assignment').modal('show');
    });

    $(document).on('click', '.edit-assignment-form', function(){
        $.post("{{ route('edit-assignment') }}", $('#edit-assginment-form').serialize(), function(data){
            console.log(data);
            if (data == 'Updated') {
                Swal.fire(
                    'Updated!',
                    'Assignment Successfully Updated.',
                    'success'
                );
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }
        });
    });

    $(document).on('click','.status_assignment_btn' , function(){ 
        var as_id = $(this).attr('data');
        var stu_id = $(this).attr('stu_id');
        $.get("{{route('status_assignment_list')}}/" + stu_id + "/" + as_id , function(response) {
            // console.log(response);
            $('.assignment-week-list').hide();
            $('.response').html(response);
        });
    });

    $(document).on('click','.student_assignment_list' , function(){ 
        var as_id = $(this).attr('data');
        $.get("{{route('student_assignment_list')}}/" + as_id , function(response) {
            // console.log(response);
            $('.assignment-week-list').hide();
            $('.response').html(response);
        });
    });

    $('#current-week').val('{{$current_week}}');

    $('.add-assignment').click(function(){
        $.get("{{ route('get-assignment-form') }}", function(data){
            $('.assignment-week-list').html(data);
        });
    });

    $('.assgin-week-btn').click(function(){
        $('.list-group-item').removeClass('active-week');
        $(this).addClass('active-week');
        let weekNumber = $(this).attr('data-week');
        let course = $('#course-id').val();
        $.get("{{ route('get-week-assignemnt') }}/" + weekNumber + "/" + course + "/" + $('#sem-id').val(), function(data){
            $('.assignment-data-view').html(data);
        });
    });

    $(document).on('click', '.view-assignment', function(){
        let filePath = $(this).attr('data');
        $('#material').val(filePath);
        $.post("{{ route('view-pdf') }}", $('#assignment-form').serialize(), function(response) {
            $('.assignment-week-list').html(response);
        });
    });

    $(document).on('click', '.delete-assignment', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You Want to Delete This Assignment!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let file = $(this).attr('data-material');
                let dataJ = $(this).attr('data-j');
                let assign = $(this).attr('data');
                $('#material').val(file);
                $('#assignment').val(assign);
                $.post("{{ route('delete-assignment') }}", $('#assignment-form').serialize(), function(response) {
                    if (response == 'Deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Assignment Successfully Deleted.',
                            'success'
                        );
                        $('#assignment-' + dataJ).remove();
                    }
                });
            }
        });
    });

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

    var customOptions = {
        placeholder: "Semester End Date"
        , twodigit: true
        , closeAfterSelect: true
        , nextButtonIcon: "fa fa-arrow-circle-right"
        , previousButtonIcon: "fa fa-arrow-circle-left"
        , buttonsColor: "blue"
        , forceFarsiDigits: true
        , markToday: true
        , markHolidays: true
        , highlightSelectedDay: true
        , sync: true
        , gotoToday: true
    }
    kamaDatepicker('date4', customOptions);
    kamaDatepicker('date5', customOptions);

</script>