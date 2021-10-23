

<div class="modal-primary mr-1 mb-1 d-inline-block">
        <!-- Modal -->
        <div class="modal fade text-left" id="position" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary white">
                        <h5 class="modal-title" id="myModalLabel160">Edit Position</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   <form action="{{route('update_position')}}" method="post">
                      @csrf
                      <input type="hidden" class="position_id" name="position_id" value="{{$data->position_id}}">
                        <div class="modal-body" style="margin-top:1.8rem !important">
                         <div class="col-md-12 col-12">
                            <div class="form-label-group position-relative has-icon-left">
                                <input type="text" class="form-control lm-input-text input-position" id="position" style="margin-top: .3rem;"
                                    name="position_name" placeholder="Position Name" value="{{$data->position_name}}" pattern=".{2,40}" required title="1 to 40 characters" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="40">
                                    <div class="form-control-position">
                                        <i class="feather icon-briefcase"></i>
                                    </div>
                                <label for="first-name-floating-icon">Position Name</label>
                                <h6 id="position-error" class="error_message">
                                    Enter Position Name.
                                </h6>
                                @error('position')
                                    <h6 class="error_message">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <select class="select2 form-control position_type" name="position_type" id="position-type" required>
                                        <option value="" selected hidden>Select Position Type</option>
                                        @foreach($allPositionType as $y)
                                            <option value="{{$y->position_type_id}}" @if($data->position_type_id == $y->position_type_id) selected @endif>{{$y->position_type_name}}</option>
                                        @endforeach
                                    </select>
                                    <h6 id="position-type-error" class="error_message">
                                        Select Position Type.
                                    </h6>
                                    @error('position_type')
                                        <h6 class="error_message">{{ $message }}</h6>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-12 col-12">
                                <fieldset class="form-label-group has-icon-left">
                                    <textarea class="form-control input-description" id="label-textarea" rows="1" name="description" placeholder="Description" style="line-height: 1.4rem;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="200">{{$data->description}}</textarea>
                                        <div class="form-control-position">
                                            <i class="mdi mdi-message"></i>
                                        </div>
                                    <label for="label-textarea">Description</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn_submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <script src="{{asset('public/app-assets/validations/edit_position.js')}}"></script>
<script>
    
    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
</script>