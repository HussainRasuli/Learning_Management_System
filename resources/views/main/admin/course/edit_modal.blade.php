<!-- Modal -->
<div class="modal fade text-left" id="course" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160">Edit Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="edit-view-course">
                @csrf
                <input type="hidden" value="{{$data->co_id}}" name="data-id">
                <div class="modal-body">
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left mt-2 mb-1">
                            <input type="text" class="form-control lm-input-text input-course" value="{{$data->co_name}}" name="course" placeholder="Course Name" required>
                                <div class="form-control-position">
                                    <i class="mdi mdi-google-classroom"></i>
                                </div>
                            <label for="first-name-floating-icon">Course Name</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <select class="select2 form-control" name="semester">
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{$i}}" @if($i == $data->sem_id) selected @endif>Semester {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <select class="select2 form-control" name="credit">
                                <option value="">None</option>
                                <option value="1" @if($data->credit == 1) selected @endif>1</option>
                                <option value="2" @if($data->credit == 2) selected @endif>2</option>
                                <option value="3" @if($data->credit == 3) selected @endif>3</option>
                                <option value="4" @if($data->credit == 4) selected @endif>4</option>
                                <option value="6" @if($data->credit == 6) selected @endif>6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary course-view-edit" data-dismiss="modal">Edit</button>
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