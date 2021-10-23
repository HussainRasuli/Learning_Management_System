$(document).ready(function () {
    var reg_name = /^[a-zA-Z\s]*$/; 

    let PositionError = true;
    $('#position').keyup(function () {
        PositionValidate();
    });

    function PositionValidate() {
        let data = $('#position').val();
        if (data == '') {
            $('#position-error').show();
            PositionError = false;
            return false;
        } else if ((data.length < 2)) {
            $('#position-error').show();
            $('#position-error').html('First Name Must Be Greter Than 2 Characters.!');
            PositionError = false;
            return false;
        } else if($.isNumeric(data)){
            $('#position-error').show();
            $('#position-error').html('Only alphabets are allowed.!');
            PositionError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('#position-error').show();
            $('#position-error').html('Only alphabets are allowed.!');
            PositionError = false;
            return false;
        } else {
            $('#position-error').hide();
            PositionError = true;
        }
    }


    let TypeError = true;
    $('#position-type').change(function () {
        PositionType();
    });

    function PositionType() {
        let type = $('#position-type').val();
        if (type == '') {
            $('#position-type-error').show();
            TypeError = false;
            return false;
        } else {
            $('#position-type-error').hide();
            TypeError = true;
        }
    }

    $('#btn_submit').click(function(){
        PositionValidate();
        PositionType();

        if((PositionError == true) && (TypeError == true)){
            return true;
        }else{
            return false;
        }
    });
});