@foreach($data as $fac)
    @php $y = 1 @endphp
    @foreach($fac->departments as $dep)
        <section id="accordion-with-margin">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card collapse-icon accordion-icon-rotate">
                        <div class="card-header bg-primary p-1">
                            <h4 class="card-title text-white">{{$dep->dep_name}} Courses</h4>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                @for($i = 1; $i <= 8; $i++)
                                    <div class="collapse-margin">
                                        <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#x-{{$y}}" aria-expanded="false" aria-controls="collapseOne">
                                            <span class="lead collapse-title">
                                                Semester {{$i}}
                                            </span>
                                        </div>
                                        <div id="x-{{$y}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <table class="table table-hover-animation">
                                                    <thead class="thead-custom">
                                                        <tr>
                                                            <th class="text-center">NO</th>
                                                            <th>Course</th>
                                                            <th>Credit</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $j=1 @endphp
                                                        @foreach($dep->course as $cor)
                                                            @if($cor->sem_id == $i)
                                                                <tr>
                                                                    <th class="text-center">{{$j}}</th>
                                                                    <td>{{$cor->co_name}}</td>
                                                                    <td>{{$cor->credit}}</td>
                                                                    <td class="text-center">
                                                                        @can('edit-course')
                                                                            <a href="#!" class="action-btn edit-btn course-edit" data-id="{{$cor->co_id}}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                                                                        @endcan
                                                                        @can('delete-course')
                                                                            <a href="#!" class="action-btn remove-btn course-view-delete" data-id="{{$cor->co_id}}" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                                                        @endcan
                                                                    </td>
                                                                </tr>
                                                                @php $j++ @endphp
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @php $y++ @endphp
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endforeach

<div id="response">

</div>

<form id="form" action="{{route('delete-course')}}" method="post" hidden="">
    @csrf
    <input type="text" name="data" id="data-id">
    <input type="submit" value="">
</form>

<script>

    $('.course-edit').click(function(){
        let data_id = $(this).attr('data-id');
        $.get("{{route('edit-modal')}}/" + data_id, function(response) {
            $('#response').html(response);
            $("#course").modal('show');
        });
    });

    $(document).on('click', '.course-view-edit', function(){
        $.post("{{ route('update-course') }}", $('#edit-view-course').serialize(), function(response){
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

    $('.course-view-delete').click(function() {
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
                $('#data-id').val(id);
                $.post("{{route('delete-course')}}", $('#form').serialize(), function(response) {
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