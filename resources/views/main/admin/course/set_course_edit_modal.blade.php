<!-- Modal -->
<div class="modal fade text-left" id="set-course-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160">Edit Set Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-set-course-form">
                @csrf
                <input type="hidden" value="{{$set_course->tc_id}}" name="data-id">
                <div class="modal-body">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <select class="select2 form-control" name="teacher">
                                @foreach($teacher as $teach)
                                    <option value="{{$teach->tea_id}}" {{ $teach->tea_id == $set_course->tea_id ? 'selected' : '' }}>{{$teach->first_name}} {{$teach->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <select class="select2 form-control" name="semester">
                                @foreach($semester as $sems)
                                    <option value="{{$sems->sem_id}}" {{ $sems->sem_id == $set_course->sem_id ? 'selected' : '' }}>{{$sems->sem_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <select class="select2 form-control" name="shift">
                                @foreach($shift as $shif)
                                    <option value="{{$shif->sh_id}}" {{ $shif->sh_id == $set_course->shift ? 'selected' : '' }}>{{$shif->sh_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <select class="select2 form-control" name="day">
                                @foreach($day as $days)
                                    <option value="{{$days->day_id}}" {{ $days->day_id == $set_course->day ? 'selected' : '' }}>{{$days->day_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit-set-course-btn" data-dismiss="modal">Edit</button>
                </div>
            </form>
        </div>
    </div> 
</div>

<script>
    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
</script>