
<style>
 th.th-tag{
     background:#f8f8f8 !important;
 }
 .pagination{
    float: right !important;
 }

</style>
@if(! $data->isEmpty())

<div class="col-12">
    <table class="table table-hover-animation table-1">
        <thead>
            <tr>
                <th class="th-tag">No</th>
                <th class="th-tag">Full Name</th>
                <th class="th-tag">Semester</th>
                <th class="th-tag">Shift</th>
                <th class="th-tag">Action</th>
            </tr>
        </thead>
        <tbody id="table_data">
            @php $i=1 @endphp
            @foreach($data as $row)
             @if($row->active_select_credit == 1)
             <tr>
                <td>{{$i++}}</td>
                <td>{{$row->first_name}} {{$row->last_name}}</td>
                <td>Semester {{$row->semester_id}}</td>
                <td>@if($row->shift_id == 1) Morning @elseif($row->shift_id == 2) Afternoon @elseif($row->shift_id == 3) Evening @endif</td>
                <td><a href="#!" class="action-btn view-btn view_credit" data-id="{{$row->stu_id}}" title="Show"><i class="mdi mdi-eye"></i></a></td>
             </tr>
              @endif
             @php $i++ @endphp
            @endforeach
        </tbody>
    </table>
    <div class="col-12 credit-pagination-links">
        {{ $data->links() }}
    </div>
</div>
@else
    <div>
        <div class="alert alert-primary text-center" role="alert">
            <p class="mb-0">No credit selection have been made so far.</p>
        </div>
    </div>
@endif
<div id="details_client"></div>

