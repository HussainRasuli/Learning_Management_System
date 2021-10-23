@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">

<style>
    th.th-tag{
        background:#f8f8f8 !important;
    }
</style>

@if(Session::has('courses-approved'))
    <div id="toast-container" class="toast-container toast-bottom-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">Course Approving</div>
            <div class="toast-message">{{Session::get('courses-approved')}}</div>
        </div>
    </div>
@endif
    
<div class="card">
    <div class="card-header d-flex mb-1">
        <h4 class="card-title">Approve Course</h4>
        @can('active-set-course-view')
            <a href="{{ route('active-course') }}" class="add-new">Active Set Course</a>
        @endcan
    </div>
    <div class="div-devider"></div>
    <div class="card-content">
        <div class="card-body">
            @if(!$data->isEmpty())
                <div class="table-responsive-mobile department-faculty">
                    <table class="table zero-configuration table-hover-animation example">
                        <thead>
                            <tr>
                                <th class="th-tag">No</th>
                                <th class="th-tag">Course Name</th>
                                <th class="th-tag">Lecturer</th>
                                <th class="th-tag">Set Course</th>
                                <th class="th-tag">Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            
                            @foreach($data as $row)
                                <tr>
                                    <th>{{$i}}</th>
                                    <td>{{$row->fac->fac_name}}</td>
                                    <td>{{$row->dep_name}}</td>
                                    <td>
                                        @if($row->set_course_done == 1) 
                                            <span class="badge badge-success" style="padding: .5rem 1.7rem;">Done</span>
                                        @else
                                            <span class="badge badge-info" style="padding: .5rem 1.2rem;">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('check-courses')
                                            @if($row->course_checked == 0)
                                                <a href="#!" class="action-btn view-btn view-courses" data-id="{{$row->dep_id}}" title="Show"><i class="mdi mdi-eye"></i></a>
                                            @else
                                                <i class="mdi mdi-checkbox-marked" style="font-size: 1.9rem; color: #28c76f;"></i>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary" role="alert">
                    <i class="feather icon-info mr-1 align-middle"></i>
                    <span>None Of Departments Done Thier Set Course Yet.!</span>
                </div>
            @endif
        </div>
    </div>
</div>

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

            $('.view-courses').click(function() {
                let id = $(this).attr('data-id');
                $.get("{{route('get-set-courses')}}/" + id, function(response) {
                    $('.department-faculty').hide();
                    $('.card-body').html(response);
                });
            });

            setTimeout(function() {
                $('.toast_message').fadeOut('slow');
            }, 3000);
        </script>
    @endsection

@endsection