<option value="">None</option>
@foreach($data->departments as $dep)
    <option value="{{$dep->dep_id}}">{{$dep->dep_name}}</option>
@endforeach