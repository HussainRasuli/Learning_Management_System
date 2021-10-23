<tr class="tr">
    <td>
        <select class="select2 form-control" name="course[]">
            <option value="" selected hidden>Select Lecturer</option>
            @foreach($course as $cor)
                <option value="{{$cor->co_id}}">{{$cor->co_name}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="select2 form-control" name="tea[]">
            <option value="" selected hidden>Select Lecturer</option>
            @foreach($teacher as $teach)
                <option value="{{$teach->tea_id}}">{{$teach->first_name}} {{$teach->last_name}} {{$teach->tea_id}}</option>
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

<script>

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

</script>