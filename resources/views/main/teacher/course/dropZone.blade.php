<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/dropZone.css')}}">

<style>
    /* -----------------------------------------------------
        CSS Progress Bars
    -------------------------------------------------------- */
    .cssProgress {
    width: 100%;
    margin-bottom: 20px;
    }
    .cssProgress .progress3 {
    position: relative;
    overflow: hidden;
    width: 100%;
    font-family: "Roboto", sans-serif;
    }
    .cssProgress .cssProgress-bar {
        display: block;
        float: left;
        width: 0%;
        height: 100%;
        background: #3798d9;
        box-shadow: inset 0px -1px 2px rgba(0, 0, 0, 0.1);
        transition: width 0.25s ease-in-out;
    }
    .cssProgress .cssProgress-label {
    position: absolute;
    overflow: hidden;
    left: 0px;
    right: 0px;
    color: rgba(0, 0, 0, 0.6);
    font-size: 0.7em;
    text-align: center;
    text-shadow: 0px 1px rgba(0, 0, 0, 0.3);
    }
    .cssProgress .cssProgress-color {
    background-color: #868e96 !important;
    }
    .cssProgress .cssProgress-active {
    background-image: linear-gradient(-45deg, rgba(255, 255, 255, 0.125) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.125) 50%, rgba(255, 255, 255, 0.125) 75%, transparent 75%, transparent);
    background-size: 35px 35px;
    }
    .cssProgress .cssProgress-active {
    -webkit-animation: cssProgressActive 2s linear infinite;
    animation: cssProgressActive 2s linear infinite;
    }
    
    @-webkit-keyframes cssProgressActive {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: 35px 35px;
        }
    }
    @keyframes cssProgressActive {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: 35px 35px;
        }
    }
    @-webkit-keyframes cssProgressActiveRight {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: -35px -35px;
        }
    }
    @keyframes cssProgressActiveRight {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: -35px -35px;
        }
    }
    /* -----------------------------------------------------
        Progress Bar 3
    -------------------------------------------------------- */
    .progress3 {
    width: auto !important;
    padding: 4px;
    background-color: rgba(0, 0, 0, 0.1);
    box-shadow: inset 0px 1px 2px rgba(0, 0, 0, 0.2);
    border-radius: 3px;
    }
    .progress3 .cssProgress-bar {
    height: 16px;
    border-radius: 3px;
    }
    .progress3 .cssProgress-label {
    line-height: 16px;
    }
</style>


<div class="col-md-12">
    <div class="alert alert-warning" role="alert">
        <i class="feather icon-info mr-1 align-middle"></i>
        <span id="alert-message"></span>
    </div>
    <div id="drop-zone">
        <p class="mt-2">Drop Multiple Files Here...</p>
        <div id="clickHere">Click me to select Files <i class="mdi mdi-download-multiple"></i>
            <input type="file" name="file[]" id="select_file" multiple />
        </div>
        <div id='filename'></div>
    </div>

    <div class="col-md-12 p-0">
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-primary mt-1" onclick="uploadFile()">Upload</button>
                <button class="btn btn-danger mt-1" id="cancel-btn" style="display: none;">Cancel</button>
            </div>
            <div class="col-md-8">
                <!-- Progress View -->
                <div class="cssProgress mt-2" style="display: none;">
                    <div class="progress3">
                        <div class="cssProgress-bar cssProgress-color cssProgress-active" style="width:0%;">
                            <span class="cssProgress-label">0%</span>
                        </div>
                    </div>
                </div>
                <!-- Error View -->
                <div id="message">

                </div> 
            </div>
        </div>
    </div>   
</div>

<script src="{{asset('public/app-assets/dropZone.js')}}"></script>

<script>
    var course = $('#course-id').val();

    $('#alert-message').html('Every File Will Store In Week ' + week);

    function _(element)
    {
        return document.getElementById(element);
    }

    var Files = [];
    var totalSize;
    $('#select_file').on('change', function(){
        $.each(this.files, (i, file) => Files.push(file));
        totalSize = 0;
        Files.map((file) => totalSize += file.size);
        Files = [];
    });  

    var ajax_request;
    function uploadFile(){
        var form_data = new FormData();

        var image_number = 1;

        var error = '';

        var totalMB = (totalSize/1024/1024).toFixed(1);
        
        if(_('select_file').files.length > 0){
            if(totalMB >= 150.0){
                error += '<h5 class="float-right text-danger font-weight-bold mt-1" style="font-size: 1rem;">Selected Files Are To Big.</h5>';
            }else{
                for(var count = 0; count < _('select_file').files.length; count++)  
                {
                    if(['application/x-msdownload'].includes(_('select_file').files[count].type))
                    {
                        error += '<h5 class="float-right text-danger font-weight-bold mt-1" style="font-size: 1rem;">The File '+ image_number +' Is Invalid, Please Select Again.!</h5>';
                    }else{
                        form_data.append("images[]", _('select_file').files[count]);
                    }

                    image_number++;
                }
            }
        }else{
            error += '<h5 class="float-right text-danger font-weight-bold mt-1" style="font-size: 1rem;">Select File Please.</h5>';
        }


        if(error != '')
        {
            _('message').innerHTML = error;

            _('select_file').value = '';
        }
        else
        {
            $('.cssProgress').show();
            $('#cancel-btn').show();

            ajax_request = new XMLHttpRequest();

            ajax_request.open("POST", "{{route('addData')}}/" + course + "/" + week + "/" + $('#sem-id').val()); // Variable Week comes from modules view

            ajax_request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            ajax_request.upload.addEventListener('progress', function(event){

                var percent_completed = Math.round((event.loaded / event.total) * 100);

                $('.cssProgress-bar').css("width", percent_completed + '%');
                $('.cssProgress-label').html(percent_completed + '% completed');

                if(percent_completed == 100){
                    $('#filename').empty();
                    $('.cssProgress').hide();
                    $('#cancel-btn').hide();
                    loadPage();
                }

            });

            ajax_request.addEventListener('load', function(event){

                _('message').innerHTML = '<h5 class="float-right text-success font-weight-bold mt-1" style="font-size: 1rem;">Files Uploaded Successfully.!</h5>';

                _('select_file').value = '';

            });

            ajax_request.send(form_data);
        }
    }


    $('#cancel-btn').click(function(){
        $('.cssProgress').hide();
        $('#filename').empty();
        $('#select_file').val("");
        $('#message').html('<h5 class="float-right text-info font-weight-bold mt-1" style="font-size: 1rem;">Files Upload Canceled.!</h5>');
        ajax_request.abort();
    });

    function loadPage()
    {
        setTimeout(function() {
            location.reload();
        }, 1500);
    }
</script>