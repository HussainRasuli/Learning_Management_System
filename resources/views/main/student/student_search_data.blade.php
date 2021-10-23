
@if(! $data->isEmpty())
<div class="col-12">
    <table class="table table-hover-animation">
        <thead>
            <tr>
                <th class="text-center th-tag">No</th>
                <th class="th-tag">Full Name</th>
                <th class="th-tag">Email Address</th>
                <th class="th-tag">Phone Number</th>
                <th class="th-tag">Photo</th>
                <th class="th-tag">Action</th>
            </tr>
        </thead>
        <tbody id="table_data">
            @php $i = 1 @endphp
            @foreach($data as $row)
                <tr id="student-{{$row->stu_id}}">
                <td class="text-center">{{$i}}</td>
                <td>{{$row->first_name}} {{$row->last_name}}</td>
                <td>{{$row->email}}</td>
                <td>0{{$row->phone}}</td>
                
                   @if($row->photo != '')
                         <td><img  class="media-object rounded-circle" src="{{ url('/storage/app/student/'.$row->photo) }}" height="45px" width="45pxs"></td>
                        @elseif($row->gender == 1)
                          <td><img class="media-object rounded-circle" src="{{asset('public/app-assets/images/user/male_user.jpg')}}" height="45px" width="45pxs"></td>
                        @elseif($row->gender == 2)
                          <td><img class="media-object rounded-circle" src="{{asset('public/app-assets/images/user/female_user.jpg')}}" height="45px" width="45pxs"></td>
                    @endif

                <td class="student-action-btn">
                    @if($row->user == '')
                        <a href="#!" class="account-action-btn account_btn" data-id="{{$row->stu_id}}" data-dep="{{$row->dep_id}}" title="Add Service"><i class="mdi mdi-account-key-outline"></i></a>
                    @endif
                    <a href="#" class="action-btn view-btn view_student" id="{{$row->stu_id}}" title="Show"><i class="mdi mdi-eye"></i></a>
                </td>
            </tr>
            @php $i++ @endphp
            @endforeach
        </tbody>
  </table>
@else
    <div>
        <div class="alert alert-warning text-center" role="alert">
            <p class="mb-0">Not Found !!</p>
        </div>
    </div>
@endif





