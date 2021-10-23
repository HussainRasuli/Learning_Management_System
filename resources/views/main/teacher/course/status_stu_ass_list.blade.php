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
<button type="button" class="btn btn-icon rounded-circle btn-info mb-1 float-left back_status_studnet_ass" title="Back">
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
                            @foreach($status_assignment as $data)
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
                                        <span class="badge badge-primary badge-pill badge-custom view_student_assignment" title="View" data="/storage/app/course/student-assignment/{{$file->file_path}}"><i class="mdi mdi-eye"></i></span> 
                                        <a href="{{ route('download-student-assignment') . '/' . $file->file_path}}"><span class="badge badge-info badge-pill badge-custom" title="Download"><i class="mdi mdi-download"></i></span></a>
                                        <input type="hidden" value="{{$data->description}}" id="message">
                                        @if($data->status == 2)
                                            <input type="hidden" value="{{$file->ma_id}}" id="material-file">
                                            <input type="hidden" value="{{$data->sg_id}}" id="stu-assign">
                                            <span class="badge badge-warning badge-pill badge-custom resubmit-btn" title="Message"><i class="feather icon-mail"></i></span>
                                        @elseif($data->status == 3)
                                            <span class="badge badge-danger badge-pill badge-custom reject-btn" title="Message"><i class="feather icon-mail"></i></span>
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

<div class="pdf-div"></div>




<div class="modal-primary mr-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="message-view-to-student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary white">
                    <h5 class="modal-title" id="myModalLabel160">Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('resubmit-assignment') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="material" id="material2">
                    <input type="hidden" name="stu-assign" id="stu-assign2">
                    <div class="modal-body">
                        <div class="col-md-12 col-12">
                            <div class="alert alert-dark" role="alert">
                                <h4 class="alert-heading text-dark">Teacher Comment</h4>
                                <p class="mb-0 text-dark" id="message-p">

                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="file-upload0" class="section">
                                <div class="row section">
                                    <div class="col s12 m8 l9">
                                        <label for="basicInputFile">Please Attach Your HomeWork.!</label>
                                        <input type="file" name="file" class="dropify" data-max-file-size="2M" data-height="100" data-allowed-file-extensions="PDF pdf ppt pptx doc docx xlsx xlx csv" />
                                    </div>
                                </div>
                                <h6 class="assign-file-error error_message">
                                    Attach Your HomeWork.!
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary submit-again-btn" value="Submit Again">
                        <button type="button" class="btn btn-danger close-btn" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>



<script src="{{asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
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

    $('.resubmit-btn').click(function(){
        $('#message-p').html($('#message').val());
        $('#material2').val($('#material-file').val());
        $('#stu-assign2').val($('#stu-assign').val());

        $('#message-view-to-student').modal('show');
    });

    $('.reject-btn').click(function(){
        $('#message-p').html($('#message').val());
        $('.submit-again-btn').hide();
        $('#file-upload0').hide();

        $('#message-view-to-student').modal('show');
    });

    let fileError = true;
    $('.dropify').change(function () {
        fileValidate();
    });

    function fileValidate() {
        let shift = $('.dropify').val();
        if (shift == '') {
            $('.assign-file-error').show();
            fileError = false;
            return false;
        } else {
            $('.assign-file-error').hide();
            fileError = true;
        }
    }


    $('.submit-again-btn').click(function(){
        fileValidate();

        if((fileError == true)){
            return true;
        }else{
            return false;
        }
    });

</script>