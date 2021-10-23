$(document).ready(function () {

    let DateError = true;
    $('#date1').change(function () {
        dateValidate();
    });

    function dateValidate() {
        let data = $('#date1').val();
        if (data == '') {
            $('#start-date-error').show();
            DateError = false;
            return false;
        } else {
            $('#start-date-error').hide();
            DateError = true;
        }
    }


    let YearError = true;
    $('#years').change(function () {
        yearValidate();
    });

    function yearValidate() {
        let type = $('#years').val();
        if (type == '') {
            $('#year-error').show();
            YearError = false;
            return false;
        } else {
            $('#year-error').hide();
            YearError = true;
        }
    }

    let PeriodError = true;
    $('#period').change(function () {
        periodValidate();
    });

    function periodValidate() {
        let type = $('#period').val();
        if (type == '') {
            $('#period-error').show();
            PeriodError = false;
            return false;
        } else {
            $('#period-error').hide();
            PeriodError = true;
        }
    }

    $('#year-btn').click(function(){
        yearValidate();
        periodValidate();
        dateValidate();

        if((PeriodError == true) && (YearError == true) && (DateError == true)){
            return true;
        }else{
            return false;
        }
    });
});