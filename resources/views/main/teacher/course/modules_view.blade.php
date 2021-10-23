<style>
    .list-group-item{
        cursor: pointer;
    }

    .list-group-item:first-child, .list-group-item:last-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .list-group .list-group-item span i {
        font-size: 1rem !important;
    }

    .badge-custom {
        padding-right: 0.4em !important;
        padding-left: 0.4em !important;
        border-radius: 9rem !important;
        cursor: pointer;
    }

    #show{
        display: block;
    }

    #hide{
        display: none;
    }

    .active-week{
        background-color:#2d6eb4; 
        color: white;
    }

    .active-week:hover{
        background-color:#2d6eb4 !important; 
        color: white !important;
    }
</style>

<section class="col-md-12 p-0">
    <div class="divider divider-info">
        <div class="divider-text">Data Week List</div>
    </div>
    <div class="col-md-12 row week-list">
        <div class="col-md-2 p-0">
            <ul class="list-group list-group-flush">
                @foreach($weeks as $week)
                    @if($week->week != 0)
                        @if($current_week == $week->week)
                            <li class="list-group-item active-week week-btn" data-week="{{$week->week}}"><i class="mdi mdi-link-variant mr-1"></i>Week {{$week->week}}</li>
                            <script>
                                $('.current-week-display').removeAttr('id');
                                $('.current-week-display').attr('id', 'hide');
                            </script>
                        @else
                            <li class="list-group-item week-btn" data-week="{{$week->week}}"><i class="mdi mdi-link-variant mr-1"></i>Week {{$week->week}}</li>
                            <script>
                                $('.current-week-display').removeAttr('id');
                                $('.current-week-display').attr('id', 'show');
                            </script>
                        @endif
                    @endif
                @endforeach
                @if($current_week != 'Semester Ended.!')
                    <li class="list-group-item current-week-display active-week week-btn" data-week="{{$current_week}}"><i class="mdi mdi-link-variant mr-1"></i>Week {{$current_week}}</li>
                @else 
                    <li class="list-group-item current-week-display active-week week-btn" data-week="{{$current_week}}"><i class="mdi mdi-link-variant mr-1"></i>{{$current_week}}</li>
                @endif
            </ul>
        </div>
        <div class="col-md-10 p-0 week-data-view">
            <ul class="list-group ml-3">
                <li class="list-group-item font-weight-bolder">Online Lecture Data</li>
                @if(!$materials->isEmpty())
                    @php $i = 1 @endphp
                    @foreach($materials as $data)
                    <li class="list-group-item d-flex justify-content-between align-items-center" id="file-{{$i}}">
                        <span>{{ pathinfo($data->file_path, PATHINFO_FILENAME) }}</span>
                        <?php $ext = pathinfo($data->file_path, PATHINFO_EXTENSION) ?>
                        <span>
                            @if(!in_array($ext, ['jpg','jpeg','docx','pdf','ppt','pptx']))
                                <span class="badge badge-primary badge-pill badge-custom play-data" data="{{$data->file_path}}"><i class="mdi mdi-play-pause"></i></span>
                            @elseif(in_array($ext, ['PDF','pdf']))
                                <span class="badge badge-warning badge-pill badge-custom view-data" data="/storage/app/course/course-data/{{$data->file_path}}"><i class="mdi mdi-eye"></i></span>
                            @endif   
                            <a href="{{ route('download-data') . '/' . $data->file_path}}"><span class="badge badge-info badge-pill badge-custom"><i class="mdi mdi-download"></i></span></a>
                        @can('delete_material')
                            <span class="badge badge-danger badge-pill badge-custom delete-data" data-i="{{$i}}" data="{{$data->ma_id}}"><i class="mdi mdi-window-close"></i></span>
                        @endcan
                        </span>
                    </li>
                    @php $i++ @endphp
                    @endforeach
                @else 
                    <li class="list-group-item">No Data Available</li>
                @endif
            </ul>
        </div>
    </div>
    <div class="col-md-12 dropZone-area">

    </div>
</section>

<form id="material-form" hidden="">
    @csrf
    <input type="text" name="data" id="data-material">
</form>

<script>
    $('.add-material').click(function(){
        $.get("{{ route('get-dropZone') }}", function(response) {
            $('.week-list').hide();
            $('.add-material').hide();
            $('.remove-material').show();
            $('.dropZone-area').html(response);
        });
    });

    $('.remove-material').click(function(){
        $('.week-list').show();
        $('.add-material').show();
        $('.remove-material').hide();
        $('.dropZone-area').empty();
    });

    var week = "{{$current_week}}";

    $('.week-btn').click(function(){
        $('.list-group-item').removeClass('active-week');
        $(this).addClass('active-week');
        let weekNumber = $(this).attr('data-week');
        let course = $('#course-id').val();
        $.get("{{ route('get-week-data') }}/" + weekNumber + "/" + course + "/" + $('#sem-id').val(), function(data){
            $('.week-data-view').html(data);
        });
    });

    $(document).on('click', '.play-data', function(){
        let fileName = $(this).attr('data');
        $.get("{{ route('play-data') }}/" + fileName, function(data){
            $('.week-list').hide();
            $('.dropZone-area').html(data);
        });
    });

    $(document).on('click', '.view-data', function(){
        let filePath = $(this).attr('data');
        $('#data-material').val(filePath);
        $.post("{{ route('view-pdf') }}", $('#material-form').serialize(), function(response) {
            $('.week-list').html(response);
        });
    });
    
    $(document).on('click', '.delete-data', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You Want to Delete This File!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let file = $(this).attr('data');
                let dataI = $(this).attr('data-i');
                $('#data-material').val(file);
                $.post("{{ route('delete-material') }}", $('#material-form').serialize(), function(response) {
                    if (response == 'Deleted') {
                        Swal.fire(
                            'Deleted!',
                            'File Successfully Deleted.',
                            'success'
                        );
                        $('#file-' + dataI).remove();
                    }
                });
            }
        });
    });
</script>