@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<style>
.dropdown{
    padding: .4rem .7rem;
}
 .dropdown-menu a:hover{
    color: white !important;
    background : #2c6db1 !important;
 }
</style>

@if(Session::has('position_added'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
  <div class="toast toast-success" aria-live="polite" style="display:block;">
   <div class="toast-title">Positions</div>
   <div class="toast-message">{{Session::get('position_added')}}</div>
  </div>
</div>
@endif
@if(Session::has('edit_position'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
  <div class="toast toast-success" aria-live="polite" style="display:block;">
   <div class="toast-title">Positions</div>
   <div class="toast-message">{{Session::get('edit_position')}}</div>
  </div>
</div>
@endif

<div class="col-12 p-0" id="staff_list">
    <div class="card mb-2">
        <div class="card-header d-flex justify-content-between">
            <h4 class="mb-1">Position List</h4>
            @can('add-position')
                <a href="{{route('position_form')}}" class="add-new mb-1">New Position</a>
            @endcan
        </div>
    </div>
</div>
<div class="row col-md-12 p-0">
  @foreach($all_position as $x)
<div class="col-md-4 col-sm-12" id="position-{{$x->position_id}}">
    <div class="card">
        <div class="card-header" style="padding-bottom: 1.5rem; padding-right: 34px;border-bottom: 2px solid #f0f0f0;">
            <h4 class="card-title">{{$x->position_name}}</h4>
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle fas fa-ellipsis-v waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                <div class="dropdown-menu dropdown-menu-right">
                    @can('edit-position')
                        <a class="dropdown-item position_value edit_position"  href="#" id="{{$x->position_id}}"><i class="feather icon-edit"></i> Edit</a>
                    @endcan
                    @can('delete-position')
                        <a class="dropdown-item delete_position" href="#" id="{{$x->position_id}}"> <i class="feather icon-trash-2"></i> Delete</a>
                    @endcan
                </div>
            </div>  
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements ele-heading">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse" class="rotate"><i class="feather icon-chevron-down"></i></a></li>
                </ul>
            </div>
         </div>
        <div class="card-content collapse" style="">
            <div class="card-body">
             @if($x->description != '')
                <div class="alert alert-primary" role="alert">               
                    <p class="mb-0 text-center">
                        {{$x->description}}
                        <!-- Tootsie roll lollipop lollipop icing. Wafer cookie danish
                        macaroon. Liquorice fruitcake apple pie I love cupcake cupcake. -->
                    </p>
                </div>
             @else
                <div class="alert alert-warning" role="alert">               
                    <p class="mb-0 text-center">
                       Does Not Have Description !
                    </p>
                </div>
             @endif
            </div>
        </div>
    </div>
</div>
@endforeach
</div>

<form method="post" hidden id="send_id">
        @csrf
        <input type="text" name="id" class="id">
    </form>
</div>
<div class="res"></div>

@section('script')
    <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/modal/components-modal.js')}}"></script>
 <script>

    $('.edit_position').click(function(){
        var position_id   = $(this).attr('id');
        $.get("{{route('edit_position')}}/" + position_id , function(res){
            $('.res').html(res);
            $('#position').modal('show');
        });
        
    });

$('.delete_position').click(function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You Want to Delete This Position!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).attr('id');
            $('.id').val(id);
            $.post("{{route('delete_position')}}", $('#send_id').serialize(), function(response) {
                // console.log(response);
                if (response == 'Deleted') {
                    Swal.fire(
                        'Deleted!',
                        'Position Successfuly Deleted.',
                        'success'
                    );
                    $('#position-'+id).fadeOut(1000);
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