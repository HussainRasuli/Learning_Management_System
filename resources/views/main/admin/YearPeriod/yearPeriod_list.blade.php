@extends('layouts.master')
@section('content')
@include('layouts.jdf')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<style>
    th.th-tag{
        background:#f8f8f8 !important;
    }
    .pagination{
        float: right !important;
    }

    .disable{ 
        pointer-events: not-allowed; 
        cursor: not-allowed; 
        background-color: #e5ffe6;
        color: #4caf507d;
        line-height: 1;
        background-color: rgba(0,255,10,.1);
        border-color: transparent;
        padding: 6px;
        height: 100%;
        border-radius: 5px;
    }
    a.disable:hover {
        cursor:not-allowed;
        background-color: #e5ffe6;
        color: #4caf507d;
        line-height: 1;
        background-color: rgba(0,255,10,.1);
        border-color: transparent;
        padding: 6px;
        height: 100%;
        border-radius: 5px;
    }
</style>

@if(Session::has('yearPeroid_added'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
    <div class="toast toast-success" aria-live="polite" style="display:block;">
        <div class="toast-title">Year and Period</div>
        <div class="toast-message">{{Session::get('yearPeroid_added')}}</div>
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

<section id="nav-justified">
    <div class="row">
        <div class="col-sm-12">
            <div class="card overflow-hidden">
                <div class="card-header mb-1">
                    <h4 class="card-title" style="font-family: sans-serif;">Year Period & Week List</h4>
                    <a href="{{route('yearPeriod_form')}}" class="add-new mr-1" >New Year & Period</a>
                </div>
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive table-data">
                            <div class="col-12">
                                <table class="table zero-configuration table-hover-animation dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th class="th-tag">No</th>
                                            <th class="th-tag">Year</th>
                                            <th class="th-tag">Period</th>
                                            <th class="th-tag">Start Date</th>
                                            <th class="th-tag">End Date</th>
                                            <th class="th-tag">Status</th>
                                            <th class="th-tag">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_data">
                                        @php $i = 1 @endphp
                                        @foreach($PeriodYear as $x)
                                        <tr id="year-{{$x->log_id}}">
                                            <th>{{$i}}</th>
                                            <td>{{$x->year}}</td>
                                            <td>@if($x->period == 1) Spring @else Fall @endif</td>
                                            <td>{{$x->semester_start_date}}</td>
                                            <td>{{$x->semester_end_date != '' ? $x->semester_end_date : 'Null'}}</td>
                                            <td>
                                                @if($x->status == 1) 
                                                <span class="badge badge-success" style="padding: .4rem;">Active</span>
                                                @else
                                                <span class="badge badge-danger" style="padding: .4rem;">Deactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($x->status == 1) 
                                                <a href="#!" class="action-btn edit-btn edit_YearPeriod" id="{{$x->log_id}}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="#!" class="action-btn remove-btn delete_YearPeriod" id="{{$x->log_id}}" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                                @else
                                                <a href="#" class="action-btn edit-btn-year disable" id="{{$x->log_id}}"><i class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="#" class="action-btn remove-btn delete_YearPeriod" id="{{$x->log_id}}" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-12 pagination-links">
                                </div>
                            </div>
                            <div class="table-responsive search-data">
                                {{ $PeriodYear->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form id="send_id" hidden>
    @csrf
    <input type="text" name="id" class="id">
</form>

<div id="edit_modal"></div>


@section('script')
<script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
<script src="{{asset('public/app-assets/js/scripts/modal/components-modal.js')}}"></script>
 <script>

    $('.edit_YearPeriod').click(function(){
        var log_id = $(this).attr('id');
        $('.id').val(log_id);
        $.get("{{route('edit_YearPeriod')}}", $('#send_id').serialize(), function(response) {
            $('#edit_modal').html(response);
            $("#YearPeriod").modal('show');
        });
    });
    
    $(document).on('click', '.edit_YearPeriod_btn', function(){
            $.post("{{ route('update_YearPeriod') }}", $('#edit_YearPeriod_btn').serialize(), function(response){
                if(response == 'Updated'){
                    Swal.fire(
                        'Updated!',
                        'Year and Period Successfully Updated.',
                        'success'
                    );
                    loadPage();
                }else{
                    alert('Error Occured.!');
                }
            });
        });

    $('.delete_YearPeriod').click(function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You Want to Delete This Year and Period!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).attr('id');
            $('.id').val(id);
            $.post("{{route('delete_YearPeriod')}}", $('#send_id').serialize(), function(response) {
                // console.log(response);
                if (response == 'Deleted') {
                    Swal.fire(
                        'Deleted!',
                        'Year and Period Successfuly Deleted.',
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