@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">

<style>
    th.th-tag{
        background:#f8f8f8 !important;
    }
    #DataTables_Table_1_paginate{
        float: right;
    }
</style>

@if(Session::has('set-course-done'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Set Course</div>
            <div class="toast-message">{{Session::get('set-course-done')}}</div>
        </div>
    </div>
@endif

<!-- Nav Justified Starts -->
<section id="nav-justified">
    <div class="row">
        <div class="col-sm-12">
            <div class="card overflow-hidden">
                <div class="card-header p-0 p-1">
                    <div class="col-md-12 row p-0">
                       <div class="col-md-6">
                            <h4 class="card-title">Course List</h4>
                       </div>
                       <div class="col-md-6 p-0">
                            @can('set-course')
                                <a href="{{route('set-course')}}" class="add-new float-right">Set Course</a>
                            @endcan
                            @can('add-course')
                                <a href="{{route('new-course')}}" class="add-new float-right mr-1">New Course</a>
                            @endcan
                       </div> 
                    </div>
                </div>
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">Approved</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="true">Dismissed</a>
                            </li>
                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content pt-1">

                            <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
                            <span class="two_btn">
                            @if(!$approved->isEmpty())
                                @if($deactived->isEmpty())
                                <a href="#" class="add-new float-right btn btn-danger deactive_select_credit"><i class="mdi mdi-close-circle-outline"></i> Deactive Select Credit</a>
                                @else
                                <a href="#" class="add-new float-right btn btn-success active_select_credit"><i class="mdi mdi-check-bold"></i> Active Select Credit</a>
                                @endif
                            @endif
                            </span>
                           
                            <span class="show_btn"></span>

                                @if(!$approved->isEmpty())
                                    <div class="table-responsive-mobile pt-4">
                                        <table class="table zero-configuration table-hover-animation example">
                                            <thead>
                                                <tr>
                                                    <th class="th-tag">No</th>
                                                    <th class="th-tag">Course Name</th>
                                                    <th class="th-tag">Lecturer</th>
                                                    <th class="th-tag">Semester</th>
                                                    <th class="th-tag">Shift</th>
                                                    <th class="th-tag">Day</th>
                                                    <th class="th-tag">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach($approved as $row)
                                                    <tr>
                                                        <th class="text-center">{{$i}}</th>
                                                        <td>{{$row->course->co_name}}</td>
                                                        <td>{{$row->teacher->first_name}} {{$row->teacher->last_name}}</td>
                                                        <td>
                                                            <span class="badge badge-info" style="padding: .5rem 1.7rem; letter-spacing: 1px;">{{$row->sem_id}}</span>
                                                        </td>
                                                        <td>
                                                            @if($row->shift == 1) 
                                                                <span class="badge badge-success" style="padding: .5rem 1.7rem; letter-spacing: 1px;">Morning</span>
                                                            @elseif($row->shift == 2)
                                                                <span class="badge badge-warning" style="padding: .5rem 1.3rem; letter-spacing: 1px;">Afternoon</span>
                                                            @else
                                                                <span class="badge badge-primary" style="padding: .5rem 1.7rem; letter-spacing: 1px;">Evening</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$row->days->day_name}}</td>
                                                        <td>
                                                            <a href="#!" class="action-btn edit-btn edit-set-course" data-id="{{$row->tc_id}}" title="Edit" style="margin-right:0px;"><i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="#!" class="action-btn remove-btn set-course-delete" data-id="{{$row->tc_id}}" title="Delete" style="margin-right:0px;"><i class="mdi mdi-trash-can"></i></a>
                                                        </td>
                                                    </tr>
                                                @php $i++ @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="alert-heading">Warning</h4>
                                        <p class="mb-0">Courses have been successfully submitted and are being reviewed by Student Affairs.!</p>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
                                @if(!$dismissed->isEmpty())
                                    <div class="table-responsive-mobile">
                                        <table class="table zero-configuration table-hover-animation example">
                                            <thead>
                                                <tr>
                                                    <th class="th-tag">No</th>
                                                    <th class="th-tag">Course Name</th>
                                                    <th class="th-tag">Lecturer</th>
                                                    <th class="th-tag">Semester</th>
                                                    <th class="th-tag">Shift</th>
                                                    <th class="th-tag">Day</th>
                                                    <th class="th-tag">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach($dismissed as $row)
                                                    <tr>
                                                        <th class="text-center">{{$i}}</th>
                                                        <td>{{$row->course->co_name}}</td>
                                                        <td>{{$row->teacher->first_name}} {{$row->teacher->last_name}}</td>
                                                        <td>
                                                            <span class="badge badge-info" style="padding: .5rem 1.7rem; letter-spacing: 1px;">{{$row->sem_id}}</span>
                                                        </td>
                                                        <td>
                                                            @if($row->shift == 1) 
                                                                <span class="badge badge-success" style="padding: .5rem 1.7rem; letter-spacing: 1px;">Morning</span>
                                                            @elseif($row->shift == 2)
                                                                <span class="badge badge-warning" style="padding: .5rem 1.3rem; letter-spacing: 1px;">Afternoon</span>
                                                            @else
                                                                <span class="badge badge-primary" style="padding: .5rem 1.7rem; letter-spacing: 1px;">Evening</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$row->days->day_name}}</td>
                                                        <td>
                                                            <a href="#!" class="action-btn edit-btn edit-set-course" data-id="{{$row->tc_id}}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="#!" class="action-btn remove-btn set-course-delete" data-id="{{$row->tc_id}}" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                                        </td>
                                                    </tr>
                                                @php $i++ @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="alert-heading">Warning</h4>
                                        <p class="mb-0">No Records.!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Nav Justified Ends -->

<div class="data-course">

</div>

<form id="set-course-from" hidden="">
    @csrf
    <input type="text" name="data-id" id="del-data-id">
</form>

    @section('script')
        <script src="{{asset('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
        <script src="{{asset('public/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
        <script src="{{asset('public/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
        <script src="{{asset('public/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('public/app-assets/js/scripts/datatables/datatable.js')}}"></script>
        <script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>

        <script>
            

            $('.example').DataTable({
                "searching": false,
                "lengthChange": false
            });

            $('.edit-set-course').click(function() {
                let id = $(this).attr('data-id');
                $.get("{{route('set-course-edit')}}/" + id, function(response) {
                    $('.data-course').html(response);
                    $("#set-course-modal").modal('show');
                });
            });

            $(document).on('click', '.edit-set-course-btn', function(){
                $.post("{{ route('update-set-course') }}", $('#edit-set-course-form').serialize(), function(response){
                    console.log(response);
                    if(response == 'Updated'){
                        Swal.fire(
                            'Updated!',
                            'Course Name Successfully Updated.!',
                            'success'
                        );
                        loadPage();
                    }else{
                        alert('Error Occured.!');
                    }
                });
            });

            $('.set-course-delete').click(function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You Want to Delete This Course!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).attr('data-id');
                        $('#del-data-id').val(id);
                        $.post("{{route('delete-set-course')}}", $('#set-course-from').serialize(), function(response) {
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

            $(document).on('click','.active_select_credit',function(){
                Swal.fire({
                    title: 'Do you want to Active Credit Selection For All Students?',
                    icon: 'info',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Yes, Active it`,
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.get("{{route('active_select_credit')}}", function(response) {
                            if(response){
                                $('.two_btn').hide();
                                $('.show_btn').html(response);
                                Swal.fire('Select Credit Successfully Actived For All Students!', '', 'success');
                            }else{
                                alert('Error');
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });
            });

            $(document).on('click','.deactive_select_credit',function(){
                Swal.fire({
                    title: 'Do you want to Deactive Credit Selection For All Students?',
                    icon: 'info',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Yes, Deactive it`,
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.get("{{route('deactive_select_credit')}}", function(response) {
                            if(response){
                                $('.two_btn').hide();
                                $('.show_btn').html(response);
                                Swal.fire('Select Credit Successfully Deactived For All Students!', '', 'success');
                            }else{
                                alert('Error');
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
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