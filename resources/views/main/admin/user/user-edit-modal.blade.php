<!-- Modal -->
<div class="modal fade text-left" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="user-edit-modal">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="data-id">
                <div class="modal-body">
                    <div class="row">
                        @if((isset($staff)) && ($staff->dep_id != ''))
                            <input type="hidden" name="staff" value="{{$staff->staff_id}}">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="" class="drop-down-label">Department</label>
                                    <select class="select2 form-control" name="department">
                                        @foreach($department as $dep)
                                            <option value="{{$dep->dep_id}}" {{ $staff->dep_id == $dep->dep_id ? 'selected' : ''}}>{{$dep->dep_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12 col-12">
                            <div class="form-label-group position-relative has-icon-left mt-2 mb-1">
                                <input type="text" class="form-control lm-input-text" name="new-pass" placeholder="New Password">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-account-key-outline"></i>
                                    </div>
                                <label for="first-name-floating-icon">New Password</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-label-group position-relative has-icon-left mt-2 mb-1">
                                <input type="text" class="form-control lm-input-text" name="conf-pass" placeholder="Confirm Password">
                                    <div class="form-control-position">
                                        <i class="mdi mdi-account-key-outline"></i>
                                    </div>
                                <label for="first-name-floating-icon">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary user-edit-btn" data-dismiss="modal">Edit</button>
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