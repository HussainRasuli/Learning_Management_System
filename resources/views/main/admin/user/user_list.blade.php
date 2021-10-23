@extends('layouts.master')
@section('content')

<div class="col-12 p-0">
    <div class="card">
        <div class="card-header d-flex mb-1">
            <h4 class="card-title">User Search</h4>
        </div>
        <div class="div-devider"></div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <select class="select2 form-control section">
                            <option value="" selected hidden>Select Section</option>
                            <option value="1">Teacher</option>
                            <option value="2">Student</option>
                            <option value="3">Staff</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" class="form-control lm-input-text user-id" placeholder="ID Number">
                                <div class="form-control-position">
                                    <i class="mdi mdi-numeric"></i>
                                </div>
                            <label for="first-name-floating-icon">ID Number</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="search user-search"><i class="feather icon-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="data">

</div>

<div id="user-modal-show">

</div>

<form id="user-search-form" hidden="">
    @csrf
    <input type="text" name="type" id="type">
    <input type="text" name="id" id="id">
    <input type="submit" name="" id="">
</form>

<form id="user" hidden="">
    @csrf
    <input type="text" name="data-id" id="data-id">
</form>

    @section('script')
        <script>
            $('.user-search').click(function() {
                $('#type').val($('.section').val());
                $('#id').val($('.user-id').val());
                loader();
                $.post("{{ route('get-users') }}", $('#user-search-form').serialize(), function(data){
                    $('.data').html(data);
                });
            });

            $(document).on('click', '.edit-user', function(){
                let data_id = $(this).attr('data-id');
                $.get("{{route('edit-user-modal')}}/" + data_id, function(response) {
                    $('#user-modal-show').html(response);
                    $("#user-modal").modal('show');
                });
            });

            $(document).on('click', '.user-edit-btn', function(){
                $.post("{{ route('update-user') }}", $('#user-edit-modal').serialize(), function(response){
                    console.log(response);
                    if(response == 'Updated'){
                        Swal.fire(
                            'Updated!',
                            'User Successfully Updated.!',
                            'success'
                        );
                        loadPage();
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Password Does Not Matched!'
                        });
                    }
                });
            });

            $(document).on('click', '.delete-user', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You Want to Delete This User!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).attr('data-id');
                        $('#data-id').val(id);
                        $.post("{{route('delete-user')}}", $('#user').serialize(), function(response) {
                            if (response == 'Deleted') {
                                Swal.fire(
                                    'Deleted!',
                                    'Course Successfuly Deleted.',
                                    'success'
                                );
                                loadPage();
                            }
                        });
                    }
                });
            });

            function loadPage()
            {
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }
        </script>
    @endsection
@endsection