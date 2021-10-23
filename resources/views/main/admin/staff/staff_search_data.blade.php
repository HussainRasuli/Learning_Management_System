
@if(! $all_staff->isEmpty())
 @php $i=0; @endphp
     @foreach($all_staff as $x)
            <div class="card-custom items mb-1" style="margin-right: 2.3rem;" id="staff-{{$x->staff_id}}">
                <div>
                    @if($x->photo != '')
                          <img src="{{ url('/storage/app/staff/'.$x->photo) }}">
                        @elseif($x->gender == 1)
                          <img src="{{asset('public/app-assets/images/user/male_user.jpg')}}">
                        @elseif($x->gender == 2)
                          <img src="{{asset('public/app-assets/images/user/female_user.jpg')}}">
                    @endif
                    <h5>{{$x->first_name}} {{$x->last_name}}<br>
                        <span>{{$x->position->position_name}}</span>
                    </h5>
                    <div>
                        <div><i class="mdi mdi-phone-outline design"></i>0{{$x->phone}}</div>
                        <div><i class="mdi mdi-email-outline design"></i>{{$x->email}}</div>
                    </div>
                    <ul class="p-0">
                            <li><a href="#!" class="view_staff" id="{{$x->staff_id}}" data-id="3" title="Show"><i class="mdi mdi-eye"></i></a></li>
                            <li><a href="#!" class="edit_staff" id="{{$x->staff_id}}"><i class="mdi mdi-square-edit-outline"></i></a></li>
                            <li><a href="#!" class="delete_staff" id="{{$x->staff_id}}"><i class="mdi mdi-trash-can"></i></a></li>
                        @if($x->user == '')
                            <li><a href="#!" class="create-account make_account_btn" data-id="{{$x->staff_id}}"><i class="mdi mdi-account-key-outline"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        @php $i++ @endphp
    @endforeach
@else
    <div class="col-12">  
        <div class="alert alert-warning text-center" role="alert">
            <p class="mb-0">Not Found !!</p>
        </div>
    </div>
@endif