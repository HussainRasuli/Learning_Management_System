@if(!$noti_data->isEmpty())
    @foreach($noti_data as $x)
        @if(($x->notification->event == 1) || ($x->notification->event == 4))
            <a class="d-flex justify-content-between" href="javascript:void(0)">
                <div class="media d-flex align-items-start">
                    <div class="media-left"><i class="feather icon-check-circle font-medium-5 success"></i></div>
                    <div class="media-body">
                        <h6 class="dark media-heading">{{$x->notification->message}}</h6>
                    </div>
                    <small><time class="media-meta">{{$x->notification->created_at}}</time></small>
                </div>
            </a>
        @elseif(($x->notification->event == 2) || ($x->notification->event == 3))
            <a class="d-flex justify-content-between" href="javascript:void(0)">
                <div class="media d-flex align-items-start">
                    <div class="media-left"><i class="feather icon-file-text font-medium-5 primary"></i></div>
                    <div class="media-body">
                        <h6 class="dark media-heading">{{$x->notification->message}}</h6>
                    </div><small>
                        <time class="media-meta">{{$x->notification->created_at}}</time></small>
                </div>
            </a>
        @endif
    @endforeach

    <script>
        $('.badge-up').show();
        var noti_number = "{{$noti_count}}";
        if(noti_number == 0){
            $('.badge-up').hide();
            noti_number = 0;
        }else{
            $('.badge-up').show();
        }
    </script>
@else
<h6 class="text-center pt-1 pb-1">You Have No Notification</h6>
@endif