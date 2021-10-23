@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<style>
 th.th-tag{
     background:#f8f8f8 !important;
 }
 .pagination{
    float: right !important;
 }
</style>

@if(Session::has('add_role'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">Role</div>
        <div class="toast-message">{{Session::get('add_role')}}</div>
    </div>
</div>
@endif
@if(Session::has('updated_role'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">Role</div>
        <div class="toast-message">{{Session::get('updated_role')}}</div>
    </div>
</div>
@endif
<!-- Zero configuration table -->
<section class="client-table" id="role_list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 p-0">
                        <div class="row p-0">
                            <div class="col-6">
                                <h4 class="card-title client-title">Role List</h4>
                            </div>
                            <div class="col-6">
                                <a href="{{route('role_form')}}" class="add-client float-right add-new" >New Role</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-devider" style="margin-top: 13px;"></div>
                <div class="card-content">
                    <div class="card-body card-dashboard" style="padding: 1rem .5rem;">
                        <div class="table-responsive table-data">
                        <div class="col-12">
                            <table class="table zero-configuration table-hover-animation dataTable no-footer">
                                <thead>
                                <tr>
                                    <th class="text-center th-tag">No</th>
                                    <th class="th-tag">Name</th>
                                    <th class="th-tag">Role Type</th>
                                    <th class="th-tag">Permission</th>
                                    <th class="th-tag">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table_data">
                                @foreach($all_role as $x)
                                <tr id="role-{{$x->role_id}}">
                                    <td class="text-center">{{$x->role_id}}</td>
                                    <td>{{$x->role_name}}</td>
                                    @foreach($x->role_type as $y)
                                    <td>{{$y->type}}</td>
                                    @endforeach
                                    <td>
                                    @foreach($x->permission as $y)
                                      <span class="badge badge-primary" style="padding: .4rem;margin-bottom: .3rem;">{{$y->per_name}}</span>
                                    @endforeach
                                    </td>
                                    <td class="p-0">
                                       <a href="#!" class="action-btn edit-btn edit_role mr-0" id="{{$x->role_id}}"title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                                       <a href="#!" class="action-btn remove-btn delete_role mr-0" id="{{$x->role_id}}" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                            <div class="col-12 pagination-links">
                                {{ $all_role->links()}}
                            </div>
                        </div>
                        <div id="details_client"></div>
                        </div>
                        <div class="table-responsive search-data">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form method="post" hidden id="send_id">
    @csrf
    <input type="text" name="id" class="id">
</form>
<div id="role_edit"></div>
@section('script')
<script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
 <script>

    $('.edit_role').click(function(){
        var role_id = $(this).attr('id');
        $('.id').val(role_id);
        $('#role_list').hide();
        $.get("{{route('edit_role')}}", $('#send_id').serialize(), function(response) {
            $('#role_edit').html(response);
        });
    });


    $('.delete_role').click(function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You Want to Delete This Role!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).attr('id');
            $('.id').val(id);
            $.post("{{route('delete_role')}}", $('#send_id').serialize(), function(response) {
                // console.log(response);
                if (response == 'Deleted') {
                    Swal.fire(
                        'Deleted!',
                        'Role Successfuly Deleted.',
                        'success'
                    );
                    $('#role-'+id).fadeOut(1000);
                }
            });
        }
    });

});

  setTimeout(function() {
            $('.toast_message').fadeOut('slow');
        }, 3000);
 </script>
@endsection

@endsection