
<style>
 th.th-tag{
     background:#f8f8f8 !important;
 }
 .pagination{
    float: right !important;
 }

</style>

<section>
    <div class="card">
        <div class="card-header">
            <div class="col-12 p-0">
                <h4 class="card-title client-title">User List</h4>
            </div>
        </div>
        <div class="div-devider" style="margin-top: 13px;"></div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="table-responsive">
                    <table class="table table-hover-animation table-1">
                        <thead>
                            <tr>
                                <th class="th-tag">No</th>
                                <th class="th-tag">Full Name</th>
                                <th class="th-tag">Department</th>
                                <th class="th-tag">User Name</th>
                                <th class="th-tag">Role</th>
                                <th class="text-center th-tag">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($data as $row)
                                @if($row->user != '')
                                    <tr>
                                        <th>{{$i}}</th>
                                        <td>{{$row->first_name}} {{$row->last_name}}</td>
                                        <td>
                                            @if(isset($row->dep))
                                                {{$row->dep->dep_name}}
                                            @else 
                                                Null
                                            @endif
                                        </td>
                                        <td>{{$row->user != '' ? $row->user->email : ''}}</td>
                                        <td>
                                            <span class="badge badge-primary" style="padding: .4rem;">{{$row->user != '' ? $row->user->user_role->role_name : ''}}</span>
                                        </td>
                                        <td class="text-center p-0">
                                            @can('edit-user')
                                                <a href="#!" class="action-btn edit-btn edit-user mr-0" data-id="{{$row->user->id}}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                                            @endcan
                                            @can('delete-user')
                                                <a href="#!" class="action-btn remove-btn delete-user mr-0" data-id="{{$row->user->id}}" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @php $i++ @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>