@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">


@if(Session::has('added'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
  <div class="toast toast-success" aria-live="polite" style="display:block;">
   <div class="toast-title">One Faculty</div>
   <div class="toast-message">{{Session::get('added')}}</div>
  </div>
</div>
@endif

@if(Session::has('new_department'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
  <div class="toast toast-success" aria-live="polite" style="display:block;">
   <div class="toast-title">New Department</div>
   <div class="toast-message">{{Session::get('new_department')}}</div>
  </div>
</div>
@endif

<div class="bg-white p-2" id="faculty_list_div">
    <div class="d-flex justify-content-between">
        <h4 class="card-title">Faculty List</h4>
        <a href="{{route('faculty-form')}}" class="add-new">New Faculty</a>
    </div>
    <div class="div-devider"></div>
    <div class="col-12 p-0">
        <div class="row">
            
 @foreach($all_faculty as $x)
            <div class="col-xl-4 col-md-6 col-sm-12 pt-1" id="faculty-{{$x->fac_id}}">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body d-flex justify-content-between bg-gradient-info">
                            <h5 class="text-white" id="y-{{$x->fac_name}}">{{$x->fac_name}}</h5>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle fas fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item new_department" href="#" id="{{$x->fac_id}}"><i class="far fa-building"></i> New Department</a>
                                    <a class="dropdown-item faculty_value" href="#" data-toggle="modal" data-target="#faculty" data="{{$x->fac_id}}" id="{{$x->fac_name}}"><i class="feather icon-edit"></i> Edit</a>
                                    <a class="dropdown-item delete_faculty" href="#" id="{{$x->fac_id}}"> <i class="feather icon-trash-2"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                        @foreach($x->dep as $y)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between department">
                            <span>{{$y->dep_name}} [ {{$y->dep_code}} ] @if($y->set_admin == 1)<div class="badge badge-success mb-0" style="padding:2px"><i class="feather icon-check" style="font-size:14px;"></i></div>@endif</span>
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-info btn-round btn-sm dropdown-toggle feather icon-settings" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                      @if($y->set_admin != 1)
                                        <a class="dropdown-item set_admin" href="#" data-toggle="modal" id="{{$y->dep_id}}" dep_code="{{$y->dep_code}}" data-target="#set_admin"><i class="feather icon-user"></i> Admin Set </a>
                                      @endif
                                        <a class="dropdown-item edit_department" href="#"  data-toggle="modal" data-target="#department" dep-code="{{$y->dep_code}}" data="{{$y->dep_name}}" id="{{$y->dep_id}}"><i class="feather icon-edit"></i> Edit</a>
                                        <a class="dropdown-item delete_department" href="#" dep_id="{{$y->dep_id}}" id="department-{{$y->dep_id}}"> <i class="feather icon-trash-2"></i> Delete</a>
                                    </div>
                                </div>
                           
                            </li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
 @endforeach
        </div>
    </div>
</div>

    <div class="modal-primary mr-1 mb-1 d-inline-block">
        <!-- Modal -->
        <div class="modal fade text-left" id="faculty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary white">
                        <h5 class="modal-title" id="myModalLabel160">Edit Faculty Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   <form method="post" id="edit_faculty_form">
                      @csrf
                      <input type="hidden" class="fac_id" name="fac_id">
                        <div class="modal-body">
                            <div class="col-md-12 col-12">
                                <div class="form-label-group position-relative has-icon-left mt-2 mb-1">
                                    <input type="text" class="form-control lm-input-text input-faculty"
                                        name="faculty" placeholder="Faculty Name" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="40">
                                        <div class="form-control-position">
                                            <i class="fa fa-university"></i>
                                        </div>
                                    <label for="first-name-floating-icon">Faculty Name
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary edit_faculty_btn">Edit</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal-primary mr-1 mb-1 d-inline-block">
        <!-- Modal -->
        <div class="modal fade text-left" id="department" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary white">
                        <h5 class="modal-title" id="myModalLabel160">Edit Department Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   <form method="post" id="edit_department_form">
                      @csrf
                      <input type="hidden" class="dep_id" name="dep_id">
                        <div class="modal-body">
                            <div class="col-md-12 col-12">
                                <div class="form-label-group position-relative has-icon-left mt-2 mb-2">
                                    <input type="text" class="form-control lm-input-text input-department"
                                        name="department" placeholder="Department Name" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="40">
                                        <div class="form-control-position">
                                            <i class="far fa-building"></i>
                                        </div>
                                    <label for="first-name-floating-icon">Department Name
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="number" class="form-control lm-input-text dep_code"
                                        name="dep_code" placeholder="Department Code" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="2">
                                        <div class="form-control-position">
                                            <i class="mdi mdi-numeric"></i>
                                        </div>
                                    <label for="first-name-floating-icon">Department Code</label>
                             </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary edit_department_btn">Edit</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal-primary mr-1 mb-1 d-inline-block">
        <!-- Modal -->
        <div class="modal fade text-left" id="set_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary white">
                        <h5 class="modal-title" id="myModalLabel160">Set Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   <form method="post" id="set_admin_form" >
                      @csrf
                      <input type="hidden" name="dep_id" class="department_id">
                      <input type="hidden" name="dep_code" class="dep_code">
                        <div class="modal-body mt-2">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <select class="select2 form-control" name="staff">
                                        <option value="" selected hidden>Select Staff</option>
                                        @foreach($staff as $x)
                                            @if($x->user == '')
                                                <option value="{{$x->staff_id}}">{{$x->first_name}} {{$x->last_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <select class="select2 form-control" name="role">
                                        <option value="" selected hidden>Select Role</option>
                                        @foreach($role as $x)
                                        <option value="{{$x->role_id}}">{{$x->role_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary set_admin_btn" data-dismiss="modal">Set Admin</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

<form method="post" hidden id="send_id">
        @csrf
        <input type="text" name="id" class="id">
    </form>
</div>
<div id="test"> </div>
@section('script')

    <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/modal/components-modal.js')}}"></script>


<script>


$('.faculty_value').click(function(){
    var faculty_name = $(this).attr('id');
    var faculty_id   = $(this).attr('data');
    $('.input-faculty').val(faculty_name);
    $('.fac_id').val(faculty_id);
});


$('.edit_faculty_btn').click(function(){
    $.post("{{ route('edit_faculty_name') }}", $('#edit_faculty_form').serialize(), function(response){
        if(response == 'Updated'){
            Swal.fire(
                'Updated!',
                'Faculty Name Successfuly Updated.',
                'success'
            );
            loadPage();
        }else{
            alert('Error Occured.!');
        }
    });
});


$('.edit_department').click(function(){
    var department_id = $(this).attr('id');
    var department_name   = $(this).attr('data');
    var dep_code  = $(this).attr('dep-code');
    $('.input-department').val(department_name);
    $('.dep_id').val(department_id);
    $('.dep_code').val(dep_code);
});

$('.set_admin').click(function(){
    var department_id = $(this).attr('id');
    var dep_code      = $(this).attr('dep_code');
    $('.department_id').val(department_id);
    $('.dep_code').val(dep_code);
});

$('.set_admin_btn').click(function(){
    $.post("{{ route('set_admin') }}", $('#set_admin_form').serialize(), function(response){
        if(response == 'created'){
            Swal.fire(
                'Done',
                'An Admin Created for This Department',
                'success'
            );
            loadPage();
        }else{
            alert('Error Occured.!');
        }
    });
});

$('.edit_department_btn').click(function(){
        $.post("{{ route('edit_department_name') }}", $('#edit_department_form').serialize(), function(response){
            if(response == 'Updated'){
                Swal.fire(
                    'Updated!',
                    'Faculty Name Successfuly Updated.',
                    'success'
                );
                loadPage();
            }else{
                alert('Error Occured.!');
          }
     });
});

   
$('.new_department').click(function(){
        var id = $(this).attr('id');
        $('.id').val(id)
        $('#faculty_list_div').hide();
        $('#test').show();
        $.post("{{route('edit_department')}}", $('#send_id').serialize() ,function(response){
            $('#test').html(response);
        });
    });


 $('.delete_faculty').click(function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You Want to Delete This Faculty!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).attr('id');
            $('.id').val(id);
            $.post("{{route('delete_faculty')}}", $('#send_id').serialize(), function(response) {
                // console.log(response);
                if (response == 'Deleted') {
                    Swal.fire(
                        'Deleted!',
                        'Faculty Successfuly Deleted.',
                        'success'
                    );
                    $('#faculty-'+id).fadeOut(1000);
                }

            });
        }
    });

});


$('.delete_department').click(function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You Want to Delete This Department!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).attr('dep_id');
            $('.id').val(id);
            $.post("{{route('delete_department')}}", $('#send_id').serialize(), function(response) {
                // console.log(response);
                if (response == 'Deleted') {
                    Swal.fire(
                        'Deleted!',
                        'Department Successfuly Deleted.',
                        'success'
                    );
                    loadPage();
                }

            });
        }
    });
});

    setTimeout(function() {
        $('.toast_message').fadeOut('slow');
    }, 3000);


    function loadPage()
    {
        setTimeout(function() {
            location.reload();
        }, 1500);
    }


    </script>

@endsection
@endsection