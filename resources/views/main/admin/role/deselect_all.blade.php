
<label for="first-name-icon">Roles : </label>
<button type="button" class="btn mr-1 btn-success btn-sm waves-effect waves-light badge badge-primary select_all" style="margin-bottom: 0.5rem !important;margin-right: 0.5rem !important;"><i class="mdi mdi-check-bold"></i> Select all</button>
    <select class="select2 form-control" multiple="multiple" name="permission[]">
        @foreach($all_permission as $x)
        <option value="{{$x->per_id}}" class="multiple-option">{{$x->per_name}}</option>
        @endforeach
    </select>
<script>

$(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
</script>