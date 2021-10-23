@include('layouts.jdf')
<link rel="stylesheet" href="{{ asset('public/app-assets/vendors/css/dropify/dropify.min.css') }}">
<style>
    .add-material, .remove-material, .add-assignment{
        display: none;
    }
</style>
<section id="nav-justified">
    <div class="row">
        <div class="col-sm-12">
            <div class="card overflow-hidden">
                <div class="card-header mb-1">
                    <h4 class="card-title" style="font-family: sans-serif;">{{$course->co_name}} - <span style="color: #2d6eb4;">{{ $period == 1 ? 'Spring' : 'Fall' }} {{$year}} </span></h4>
                    <div class="d-flex button-container">
                     @can('add_material')
                        <a href="#!" class="add-new mr-1 add-material">Add Material</a>
                     @endcan
                     @can('add_assignment')
                        <a href="#!" class="add-new mr-1 add-assignment">Add Assignment</a>
                     @endcan
                        <a href="#!" class="btn btn-danger mr-1 remove-material" style="padding: .9rem 1rem;height: 2.3rem; line-height:.5;text-align: center;">Remove Drop Zone</a>
                        <button type="button" class="btn btn-icon rounded-circle btn-primary float-right back-to-courses"><i class="feather icon-arrow-left"></i></button>
                    </div>
                </div>
                <input type="hidden" value="{{$course->co_id}}" id="course-id">
                <input type="hidden" value="{{$semester}}" id="sem-id">
                <input type="hidden" id="current-week">
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="syllabus-tab-justified" data-id="{{$course->co_id}}" data-toggle="tab" href="#syllabus-just" role="tab" aria-controls="syllabus-just" aria-selected="false">Syllabus</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="modules-tab-justified" data-toggle="tab" href="#modules-just" role="tab" aria-controls="modules-just" aria-selected="false">Modules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="assignment-tab-justified" data-toggle="tab" href="#assignment-just" role="tab" aria-controls="assignment-just" aria-selected="false">Assignments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="people-tab-justified" data-toggle="tab" href="#people-just" role="tab" aria-controls="people-just" aria-selected="false">People</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="quize-tab-justified" data-toggle="tab" href="#quize-just" role="tab" aria-controls="quize-just" aria-selected="false">Quizzes</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content pt-1">
                            <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
                                <p>
                                    Home Tab...
                                </p>
                            </div>
                            <div class="tab-pane" id="syllabus-just" role="tabpanel" aria-labelledby="syllabus-tab-justified">
                                <!-- Data Come From Syllabus_view -->
                            </div>

                            <input type="hidden" id="current-date" value="<?php echo $out=jdate("Y-m-d","","","","en"); ?>">
                            
                            <div class="tab-pane" id="modules-just" role="tabpanel" aria-labelledby="modules-tab-justified">
                                <!-- Data Come From Modules_view -->
                            </div>
                        
                            <div class="tab-pane" id="assignment-just" role="tabpanel" aria-labelledby="assignment-tab-justified">
                                <!-- Data Come From Assignment_View -->
                            </div>
                            <div class="tab-pane" id="people-just" role="tabpanel" aria-labelledby="people-tab-justified">
                                <!-- Data Come From People_View -->
                            </div>
                            <div class="tab-pane" id="quize-just" role="tabpanel" aria-labelledby="quize-tab-justified">
                                <p>
                                    Quize Tab...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div hidden="">
    <div class="d-flex align-items-center" id="course-loader">
        <div class="spinner-border text-primary m-auto" role="status" aria-hidden="true"></div>
    </div>
</div>

<script>
    $('#home-tab-justified').click(function(){
        $('.add-material').hide();
        $('.remove-material').hide();
        $('.add-assignment').hide();
    });

    $('#syllabus-tab-justified').click(function(){
        let course = $(this).attr('data-id');
        $('.add-material').hide();
        $('.remove-material').hide();
        $('.add-assignment').hide();
        $('#syllabus-just').html($('#course-loader'));  
        $.get("{{ route('get-course-syllabus') }}/" + course, function(response) {
            $('#syllabus-just').html(response);
        });
    });

    $('#modules-tab-justified').click(function(){
        $('.add-assignment').hide();
        let current_date = $('#current-date').val();
        $('#modules-just').html($('#course-loader'));
        $.get("{{ route('get-module') }}/" + current_date + "/" + $('#course-id').val() + "/" + "{{$semester}}", function(response) {
            $('#modules-just').html(response);
            $('.add-material').show();
            $('.remove-material').hide();
        });
    });

    $('#assignment-tab-justified').click(function(){
        $('.add-material').hide();
        $('.remove-material').hide();
        $('.add-assignment').show();
        let current_date = $('#current-date').val();
        $('#assignment-just').html($('#course-loader')); 
        let table = "{{Auth::user()->table_name}}";
        if(table == 1){ // route teacher
            $.get("{{ route('get-assignment') }}/" + current_date + "/" + $('#course-id').val() + "/" + "{{$semester}}", function(response) {
                $('#assignment-just').html(response);
            });
        }else if(table == 2){ // route student 
            $.get("{{ route('get-assignment-student') }}/" + current_date + "/" + $('#course-id').val() + "/" + "{{$semester}}", function(response) {
                $('#assignment-just').html(response);
            });
        }
    });

    $('#people-tab-justified').click(function(){
        $('.add-material').hide();
        $('.remove-material').hide();
        $('.add-assignment').hide();
        $('#people-just').html($('#course-loader'));
        $.get("{{ route('get-people') }}/" + $('#course-id').val() + "/" + "{{$semester}}", function(response) {
            $('#people-just').html(response);
        });
    });

    $('#quize-tab-justified').click(function(){
        $('.add-material').hide();
        $('.remove-material').hide();
        $('.add-assignment').hide();
    });
    
</script>