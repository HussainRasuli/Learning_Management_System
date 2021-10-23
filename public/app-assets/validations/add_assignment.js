$(document).ready(function () {

    let markError = true;
    $('.mark').change(function () {
        mark();
    });

    function mark() {
        let mark = $('.mark').val();
        if (mark == '') {
            $('.mark-error').show();
            markError = false;
            return false;
        } else {
            $('.mark-error').hide();
            markError = true;
        }
    }


    let startDateError = true;
    $('.assign-start-date').change(function () {
        start_date();
    });

    function start_date() {
        let start_date = $('.assign-start-date').val();
        if (start_date == '') {
            $('.assign-start-date-error').show();
            startDateError = false;
            return false;
        } else {
            $('.assign-start-date-error').hide();
            startDateError = true;
        }
    }

    let endDateError = true;
    $('.assign-end-date').change(function () {
        end_date();
    });

    function end_date() {
        let end_date = $('.assign-end-date').val();
        if (end_date == '') {
            $('.assign-end-date-error').show();
            endDateError = false;
            return false;
        } else {
            $('.assign-end-date-error').hide();
            endDateError = true;
        }
    }


    let fileError = true;
    $('.dropify').change(function () {
        fileValidate();
    });

    function fileValidate() {
        let shift = $('.dropify').val();
        if (shift == '') {
            $('.assign-file-error').show();
            fileError = false;
            return false;
        } else {
            $('.assign-file-error').hide();
            fileError = true;
        }
    }


    $('.add-asign').click(function(){
        mark();
        start_date();
        end_date();
        fileValidate();

        if((markError == true) && (startDateError == true) && (endDateError == true) && (fileError == true)){
            return true;
        }else{
            return false;
        }
    });
});