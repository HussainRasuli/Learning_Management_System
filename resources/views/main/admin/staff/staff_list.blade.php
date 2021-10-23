@extends('layouts.master')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

@if(Session::has('account_created'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message" style="right: 12px;bottom: 12px;top: 36rem; !important">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">Account</div>
   <div class="toast-message">{{Session::get('account_created')}}</div>
  </div>
</div>
@endif
@if(Session::has('staff_added'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">One Staff</div>
   <div class="toast-message">{{Session::get('staff_added')}}</div>
  </div>
</div>
@endif

@if(Session::has('staff-updated'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">One Staff</div>
        <div class="toast-message">{{Session::get('staff-updated')}}</div>
    </div>
</div>
@endif

<div class="col-12 p-0" id="staff_header">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-1">
            <h4 class="card-title">Staff List</h4>
            @can('add-staff')
                <a href="{{route('staff-form')}}" class="add-new">New Staff</a>
            @endcan
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 row wrapper" id="staff_list">
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
                        <div><i class="mdi mdi-phone-outline design"></i>@if($x->phone != '') {{$x->phone}} @else None @endif</div>
                        <div><i class="mdi mdi-email-outline design"></i>{{$x->email}}</div>
                    </div>
                    <ul class="p-0">
                            <li><a href="#!" class="view_staff" id="{{$x->staff_id}}" data-id="3" title="Show"><i class="mdi mdi-eye"></i></a></li>
                        @can('edit-staff')
                            <li><a href="#!" class="edit_staff" id="{{$x->staff_id}}"><i class="mdi mdi-square-edit-outline"></i></a></li>
                        @endcan
                        @can('delete-staff')
                            <li><a href="#!" class="delete_staff" id="{{$x->staff_id}}"><i class="mdi mdi-trash-can"></i></a></li>
                        @endcan
                        @if($x->user == '')
                            <li><a href="#!" class="create-account make_account_btn" data-id="{{$x->staff_id}}"><i class="mdi mdi-account-key-outline"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        @php $i++ @endphp
    @endforeach
</div>

<div class="staff_search_data"></div>

<div class="col-md-12 col-sm-12 content_div mt-2" id="current_staff_pagination">
    <div class="card">
        <div class="card-content">
            <div class="card-body" style="padding-bottom:8px;">
                    <div id="pagination-container" style="float:right;"></div>
            </div>
        </div>
    </div>
</div>

<form method="post" id="send_id" hidden>
    @csrf
    <input type="text" name="account_btn" value="2">
    <input type="text" name="id" class="id">
</form>

<form method="post" id="staff-account-form" hidden>
    @csrf
    <input type="text" name="account_btn" value="2">
    <input type="text" name="staff_id" class="staff_id">
</form>

<form method="post" id="staff_search_form" hidden>
    @csrf
    <input type="text" name="input_send_data" id="input_send_data">
</form>

<div class="edit_form"></div>
<div id="response"></div>
@section('script')
    <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/modal/components-modal.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/pagination/jquery.simplePagination.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/pagination/customPagination.js')}}"></script>

     <!-- date-pickers -->
    <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>

    <script>

   $(document).on('click','.view_staff' , function(){ 
        var staff_id = $(this).attr('id');
        $('.id').val(staff_id); 
        $.get("{{route('view_staff_modal')}}", $('#send_id').serialize(), function(response) {
            $('#response').html(response);
            $("#view_staff").modal('show');
        });
    });

   $(document).on('click','.edit_staff' , function(){ 
        var staff_id = $(this).attr('id');
        $('.id').val(staff_id);
        $.get("{{route('edit_staff_modal')}}", $('#send_id').serialize(), function(response) {
            $('#response').html(response);
            $("#edit_staff").modal('show');
        });
    });

    setTimeout(function() {
        $('.toast_message').fadeOut('slow');
    }, 3000);


    $(document).on('click','.delete_staff' , function(){ 
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
                var id = $(this).attr('id');
                $('.id').val(id);
                $.post("{{route('delete_staff')}}", $('#send_id').serialize(), function(response) {
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

$(document).on('click','.make_account_btn' , function(){ 
        Swal.fire({
            title: 'Do you want to create an account?',
            icon: 'info',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: `Yes, create it`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr('data-id');
                $('.staff_id').val(id);
                $.post("{{route('make-account-staff')}}", $('#staff-account-form').serialize(), function(response) {
                    if(response == 'created'){
                        Swal.fire('Account Created Successfully!', '', 'success');
                        loadPage();
                    }else{
                        alert('Error');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        });
    });

        function loadPage()
        {
            setTimeout(function() {
                location.reload();
            }, 1500);
        }


 $('.staff_search_data').hide();  
 $(document).on('keyup','#input_search', function(enter){
       var value = $(this).val();
       $('#input_send_data').val(value);
       
       if(value != '' && enter.keyCode == 13 ){ // 13 is Enter key Code.
        $('.staff_search_data').show();
        $('#staff_list').hide();
        $('#current_staff_pagination').hide();
           $.post("{{route('search_staff')}}", $('#staff_search_form').serialize(), function(res){
            //    console.log(res);
                $('.staff_search_data').html(res);
           });
       }
       else {
            $('.staff_search_data').empty();
            $('#staff_list').show();
            $('#current_staff_pagination').show();
       }
  });

  $(document).on('click','.search-input-icon', function(enter){
       var value = $('#input_search').val();
       $('#input_send_data').val(value);
       if(value != ''){ 
        $('.staff_search_data').show();
        $('#staff_list').hide();
        $('#current_staff_pagination').hide();
           $.post("{{route('search_staff')}}", $('#staff_search_form').serialize(), function(res){
            //    console.log(res);
                $('.staff_search_data').html(res);
           });
       }
       else {
            $('.staff_search_data').empty();
            $('#staff_list').show();
            $('#current_staff_pagination').show();
       }
  });

    </script>
@endsection
@endsection