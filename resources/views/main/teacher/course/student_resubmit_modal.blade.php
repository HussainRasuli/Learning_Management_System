

    <div class="modal-primary mr-1 mb-1 d-inline-block">
        <!-- Modal -->
        <div class="modal fade text-left" id="student_resubmit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary white">
                        <h5 class="modal-title" id="myModalLabel160">Resubmit Assignment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   <form action="{{route('resubmit_assignment')}}" method="post">
                      @csrf
                      <input type="hidden" name="sg_id" value="{{$sg_id}}">
                        <div class="modal-body mt-2">
                            <div class="col-12">
                                <fieldset class="form-label-group">
                                    <textarea class="form-control" id="label-textarea" name="comment" rows="3" placeholder="Write your comment for resubmit Assignment . . ." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="200" required></textarea>
                                    <label for="label-textarea">Your Comment</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

<script>
    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
</script>