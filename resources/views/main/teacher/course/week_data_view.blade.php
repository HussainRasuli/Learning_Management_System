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
                <span class="badge badge-danger badge-pill badge-custom delete-data" data-i="{{$i}}" data="{{$data->ma_id}}"><i class="mdi mdi-window-close"></i></span>
            </span>
        </li>
        @php $i++ @endphp
        @endforeach
    @else 
        <li class="list-group-item">No Data Available</li>
    @endif
</ul>