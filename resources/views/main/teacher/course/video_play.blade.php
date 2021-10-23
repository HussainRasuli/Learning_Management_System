<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/videre.css')}}">
<style>
    #player{
        width: 50rem !important;
    }
</style>

<div class="flex justify-center">
    <div id="player"></div>
</div>

<span class="d-none fileName">{{ pathinfo($fileName, PATHINFO_FILENAME) }}</span>

<script src="{{asset('public/app-assets/videre.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#player').videre({
            video: {
            quality: [
                {
                    label: '720p',
                    src: 'storage/app/course/course-data/{{$fileName}}'
                }
            ],
            title: $('.fileName').text()
            },
            dimensions: 1280
        });
    });
</script>