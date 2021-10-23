@if(! $teacher->isEmpty())
@php $i=0; @endphp
    @foreach($teacher as $teacher)
      @if($fac_id == $teacher->dep->fac_id)
        <div class="col-4 mb-1 items">
            <div class="card-custom">
                <div>
                    @if($teacher->photo != '')
                        <img src="{{ url('/storage/app/teacher/'.$teacher->photo) }}">
                    @elseif(($teacher->photo == '') && ($teacher->gender == 1))
                        <img src="{{asset('public/app-assets/images/user/male_user.jpg')}}">
                    @elseif(($teacher->photo == '') && ($teacher->gender == 2))
                        <img src="{{asset('public/app-assets/images/user/female_user.jpg')}}">
                    @endif
                    <h5>{{$teacher->first_name}} {{$teacher->last_name}}<br>
                       
                        <span>{{$teacher->dep->dep_name}}</span>
                    
                    </h5>
                    <div>
                        <div><i class="mdi mdi-phone-outline design"></i>0{{$teacher->phone}}</div>
                        <div><i class="mdi mdi-email-outline design"></i>{{$teacher->email}}</div>
                    </div>
                    <ul class="p-0">
                            <li><a href="#!" class="view_teacher" id="{{$teacher->tea_id}}" data-id="3" title="Show"><i class="mdi mdi-eye"></i></a></li>
                            <li><a href="#!" class="teacher-edit" data-id="{{$teacher->tea_id}}"><i class="mdi mdi-square-edit-outline"></i></a></li>
                            <li><a href="#!" class="delete-teacher" data-id="{{$teacher->tea_id}}"><i class="mdi mdi-trash-can"></i></a></li>
                            @if($teacher->user == '')
                                <li><a href="#!" class="create-account" data-id="{{$teacher->tea_id}}" data-dep="{{$teacher->dep_id}}"><i class="mdi mdi-account-key-outline"></i></a></li>
                            @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
        @php $i++ @endphp
    @endforeach

@else
    <div class="col-12">  
        <div class="alert alert-warning text-center" role="alert">
            <p class="mb-0">Not Found !!</p>
        </div>
    </div>
@endif