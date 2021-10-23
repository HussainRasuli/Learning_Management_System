@extends('layouts.master')
@section('content')

<style>   
    span.select2-container{
        width: 14.7rem !important;
    }
</style>

<section id="basic-datatable">
    <div class="card">
        <div class="card-header p-2">
            <h4 class="card-title client-title">Set Course</h4>
            <div>
                <button type="button" class="btn btn-icon rounded-circle btn-danger mr-1 mb-1" id="remove" disabled><i class="feather icon-minus"></i></button>
                <button type="button" class="btn btn-icon rounded-circle btn-info mr-1 mb-1" id="new-tr"><i class="feather icon-plus"></i></button>
            </div>
        </div>
        <div class="div-devider"></div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                @if(isset($course))
                <div class="table-responsive-mobile"> 
                    <form action="{{ route('set-course-teacher') }}" method="post">
                        @csrf
                        <table class="table zero-configuration" id="table">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Lecturer</th>
                                    <th>Semester</th>
                                    <th>Shift</th>
                                    <th>Day</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>
                                        <select class="select2 form-control" name="course[]">
                                            <option value="" selected hidden>Select Course</option>
                                            @foreach($course as $cor)
                                                <option value="{{$cor->co_id}}">{{$cor->co_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="select2 form-control" name="tea[]">
                                            <option value="" selected hidden>Select Lecturer</option>
                                            @foreach($teacher as $teach)
                                                <option value="{{$teach->tea_id}}">{{$teach->first_name}} {{$teach->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="select2 form-control" name="semester[]">
                                            <option value="" selected hidden>Select Semester</option>
                                            @foreach($semester as $semes)
                                                <option value="{{$semes->sem_id}}">{{$semes->sem_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="select2 form-control" name="shift[]">
                                            <option value="" selected hidden>Select Shift</option>
                                            @foreach($shift as $shif)
                                                <option value="{{$shif->sh_id}}">{{$shif->sh_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="select2 form-control" name="day[]">
                                            <option value="" selected hidden>Select Day</option>
                                            @foreach($day as $days)
                                                <option value="{{$days->day_id}}">{{$days->day_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary set-course-submit-btn ml-1">Set Course</button>
                    </form>
                </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Warning</h4>
                        <p class="mb-0">{{$msg}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

    @section('script')
        <script>
            var count = 1;
            $('#new-tr').click(function(){
                $.get("{{ route('get-new-tr') }}", function(data){
                    $('#tbody').append(data);
                    count += 1;
                    $('#remove').removeAttr('disabled','');
                });
            });

            $('#remove').on("click", function(){
                if(count != 1){
                    $('#table tr:last').remove();
                    count -= 1;
                }else{
                    $('#remove').attr('disabled','');
                }
            });
        </script>
    @endsection
    @section('resize')
        @if(Request::is('set-course'))
            <script>
                function toggleZoomScreen() {
                document.body.style.zoom = "90%";
                } 
                toggleZoomScreen();
            </script>
        @endif
    @endsection
@endsection