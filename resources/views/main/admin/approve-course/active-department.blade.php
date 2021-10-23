@extends('layouts.master')
@section('content')


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
                <h4 class="card-title client-title">Department List</h4>
            </div>
        </div>
        <div class="div-devider" style="margin-top: 13px;"></div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="table-responsive">
                    <table class="table table-hover-animation">
                        <thead>
                            <tr>
                                <th class="th-tag">No</th>
                                <th class="th-tag">Faculty</th>
                                <th class="th-tag">Department</th>
                                <th class="th-tag">Set Course</th>
                                <th class="text-center th-tag">Action</th>
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
                                        @if($row->active_set_course == 1) 
                                            <span class="badge badge-success" style="padding: .4rem;">Active</span>
                                        @else
                                            <span class="badge badge-danger" style="padding: .4rem;">Deactive</span>
                                       @endif
                                    </td>
                                    <td class="text-center">
                                        @if($row->active_set_course == 0) 
                                            <a href="#!" class="action-btn edit-btn active-btn" data-id="{{$row->dep_id}}" title="Edit"><i class="mdi mdi-check-bold"></i></a>
                                        @else
                                            <a href="#" class="action-btn remove-btn deactive-btn" data-id="{{$row->dep_id}}" title="Deactive"><i class="mdi mdi-close-outline"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<form id="active-department-form" hidden="">
    @csrf
    <input type="text" name="department" id="dep">
</form>

 @section('script')
    <script>

    $('.active-btn').click(function(){
        Swal.fire({
            title: 'Do you want to activate set course?',
            icon: 'info',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: `Yes, active it`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                let dep = $(this).attr('data-id');
                $('#dep').val(dep);
                $.post("{{route('active-this-department')}}", $('#active-department-form').serialize(), function(response) {
                    if(response == 'activated'){
                        Swal.fire('Set Course Activated Successfully!', '', 'success');
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

    $('.deactive-btn').click(function(){
        Swal.fire({
            title: 'Do you want to deactivate set course?',
            icon: 'info',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: `Yes, deactive it`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                let dep = $(this).attr('data-id');
                $('#dep').val(dep);
                $.post("{{route('deactive-this-department')}}", $('#active-department-form').serialize(), function(response) {
                    if(response == 'deactivated'){
                        Swal.fire('Set Course Deactivated Successfully!', '', 'success');
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
    </script>
 @endsection
@endsection