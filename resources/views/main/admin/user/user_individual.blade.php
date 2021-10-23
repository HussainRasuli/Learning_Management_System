
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
                            <tr>
                                <th>1</th>
                                <td>{{$data->first_name}} {{$data->last_name}}</td>
                                <td>
                                    @if(isset($data->dep))
                                        {{$data->dep->dep_name}}
                                    @else 
                                        Null
                                    @endif
                                </td>
                                <td>{{$data->user != '' ? $data->user->email : ''}}</td>
                                <td>
                                    <span class="badge badge-primary" style="padding: .4rem;">{{$data->user != '' ? $data->user->user_role->role_name : ''}}</span>
                                </td>
                                <td class="text-center">
                                    <a href="#!" class="action-btn edit-btn edit-user" data-id="{{$data->user->id}}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="#!" class="action-btn remove-btn delete-user" data-id="{{$data->user->id}}" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>