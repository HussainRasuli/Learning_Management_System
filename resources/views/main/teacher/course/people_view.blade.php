@if(!$people->isEmpty())    
    <div class="table-responsive">
        <table class="table table-hover-animation">
            <thead>
                <tr>
                    <th>ID Number</th>
                    <th>Photo</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Father Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($people as $people)
                <tr>
                    <td>{{ $people->student->unique_id }}</td>
                    <td class="p-1">
                        <ul class="list-unstyled users-list m-0 ">
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Vinnie Mostowy" class="avatar pull-up">
                                @if($people->student->photo != '')
                                    <img class="media-object rounded-circle" src="storage/app/student/{{ $people->student->photo }}" alt="Avatar" height="40" width="40">
                                @else
                                    <img class="media-object rounded-circle" src="{{asset('public/app-assets/images/portrait/small/user_default.jpg')}}" alt="Avatar" height="40" width="40">
                                @endif
                            </li>
                        </ul>
                    </td>
                    <td>{{ $people->student->first_name }}</td>
                    <td>{{ $people->student->last_name }}</td>
                    <td>{{ $people->student->father_name }}</td>
                    <td>{{ $people->student->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <li class="list-group-item font-weight-bolder">No People Enrolled</li>
@endif