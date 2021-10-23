@if(!isset($file))
@can('add_syllabus')
    <form action="{{ route('add-syllabus') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course" value="{{$course}}">
        <div class="col-lg-12 col-md-12 pb-2">
            <div id="file-upload0" class="section">
                <div class="row section">
                    <div class="col s12 m8 l9">
                        <label for="basicInputFile">Please Attach Syllabus.!</label>
                        <input type="file" name="syllabus-file" class="dropify" data-max-file-size="1M" data-height="100" data-allowed-file-extensions="PDF pdf" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary submit-syllabus" value="Add Syllabus">
        </div>
    </form>
 @endcan
@endif

@if(isset($file))
    <iframe
        src="{{ url('/storage/app/course/course-syllabus/' . $file) }}"
        width="100%"
        height="100%"
        style="width: 100%; height: 40rem; border: none;">
    </iframe>
@can('delete_syllabus')
    <button type="button" class="btn btn-danger mt-1 delete-syllabus" data-id="{{$row}}">Delete</button>
@endcan
@endif

<form id="syllabus-form" hidden="">
    @csrf
    <input type="text" name="data" id="data">
</form>

<script src="{{asset('public/app-assets/vendors/js/dropify/dropify.min.js') }}"></script>
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });

    $('.delete-syllabus').click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You Want to Delete This Syllabus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr('data-id');
                $('#data').val(id);
                $.post("{{route('delete-syllabus')}}", $('#syllabus-form').serialize(), function(response) {
                    if (response == 'Deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Syllabus Successfully Deleted.',
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                });
            }
        });
    });
</script>