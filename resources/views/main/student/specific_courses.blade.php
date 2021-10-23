<option value="">None</option>
@foreach($all_course as $x)
 <option value="{{$x->co_id}}">{{$x->co_name}}</option>
@endforeach
