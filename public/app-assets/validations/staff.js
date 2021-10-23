$(document).ready(function () {
    var reg_name = /^[a-zA-Z\s]*$/; 

    let FirstNameError = true;
    $('.staff-first-name').keyup(function () {
        firstName();
    });

    function firstName() {
        let data = $('.staff-first-name').val();
        if (data == '') {
            $('.staff-firstname-error').show();
            FirstNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.staff-firstname-error').show();
            $('.staff-firstname-error').html('First Name Must Be Greter Than 2 Characters.!');
            FirstNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.staff-firstname-error').show();
            $('.staff-firstname-error').html('Only alphabets are allowed.!');
            FirstNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.staff-firstname-error').show();
            $('.staff-firstname-error').html('Only alphabets are allowed.!');
            FirstNameError = false;
            return false;
        } else {
            $('.staff-firstname-error').hide();
            FirstNameError = true;
        }
    }


    let LastNameError = true;
    $('.staff-last-name').keyup(function () {
        lastName();
    });

    function lastName() {
        let data = $('.staff-last-name').val();
        if (data == '') {
            $('.staff-lastname-error').show();
            LastNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.staff-lastname-error').show();
            $('.staff-lastname-error').html('Last Name Must Be Greter Than 2 Characters.!');
            LastNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.staff-lastname-error').show();
            $('.staff-lastname-error').html('Only alphabets are allowed.!');
            LastNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.staff-lastname-error').show();
            $('.staff-lastname-error').html('Only alphabets are allowed.!');
            LastNameError = false;
            return false;
        } else {
            $('.staff-lastname-error').hide();
            LastNameError = true;
        }
    }


    let fatherNameError = true;
    $('.staff-father-name').keyup(function () {
        fatherName();
    });

    function fatherName() {
        let data = $('.staff-father-name').val();
        if (data == '') {
            $('.staff-fathername-error').show();
            fatherNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.staff-fathername-error').show();
            $('.staff-fathername-error').html('Father Name Must Be Greter Than 2 Characters.!');
            fatherNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.staff-fathername-error').show();
            $('.staff-fathername-error').html('Only alphabets are allowed.!');
            fatherNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.staff-fathername-error').show();
            $('.staff-fathername-error').html('Only alphabets are allowed.!');
            fatherNameError = false;
            return false;
        } else {
            $('.staff-fathername-error').hide();
            fatherNameError = true;
        }
    }


    let idCardError = true;
    $('.staff-id-card').keyup(function () {
        idCard();
    });

    function idCard() {
        let data = $('.staff-id-card').val();
        if (data == '') {
            $('.staff-id-Card-error').show();
            idCardError = false;
            return false;
        } else if ((data.length < 3)) {
            $('.staff-id-Card-error').show();
            $('.staff-id-Card-error').html('ID Card Must Be Greter Than 3 Characters.!');
            idCardError = false;
            return false;
        } else {
            $('.staff-id-Card-error').hide();
            idCardError = true;
        }
    }


    let emailError = true;
    $('.staff-email').keyup(function(){
        Email();
    });
    function Email(){
        let emailValue = $('.staff-email').val();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(emailValue == ''){
            $('.staff-email-error').show();
            emailError = false;
            return false;
        }else if((emailValue.length < 10) || (emailValue.length > 30)){
            $('.staff-email-error').show();
            $('.staff-email-error').html('Email Between 10 And 30 Characters');
            emailError = false;
            return false;
        }else if(!regex.test(emailValue)){
            $('.staff-email-error').show();
            $('.staff-email-error').html('Invalid E-mail Address');
            emailError = false;
            return false;
        }else if($.isNumeric(emailValue)){
            $('.staff-email-error').show();
            $('.staff-email-error').html('Only characters are allowed.!');
            emailError = false;
            return false;
        }else{
            $('.staff-email-error').hide();
            emailError = true;
        }
    }


    let phoneError = true;
    $('.staff-phone').keyup(function () {
        Phone();
    });

    function Phone() {
        let phone = $('.staff-phone').val();
        if (phone == '') {
            $('.staff-phone-error').show();
            phoneError = false;
            return false;
        } else if ((phone.length <= 9) || (phone.length >= 16)) {
            $('.staff-phone-error').show();
            $('.staff-phone-error').html('Phone Number Between 10 To 15 Digits.');
            phoneError = false;
            return false;
        } else {
            $('.staff-phone-error').hide();
            phoneError = true;
        }
    }


    let dobError = true;
    $('.staff-dob').keyup(function () {
        dob();
    });

    function dob() {
        let dob = $('.staff-dob').val();
        if (dob == '') {
            $('.staff-dob-error').show();
            dobError = false;
            return false;
        } else {
            $('.staff-dob-error').hide();
            dobError = true;
        }
    }


    let genderError = true;
    $('.staff-gender').change(function () {
        gender();
    });

    function gender() {
        let gender = $('.staff-gender').val();
        if (gender == '') {
            $('.staff-gender-error').show();
            genderError = false;
            return false;
        } else {
            $('.staff-gender-error').hide();
            genderError = true;
        }
    }


    let educationError = true;
    $('.staff-education').change(function () {
        education();
    });

    function education() {
        let education = $('.staff-education').val();
        if (education == '') {
            $('.staff-education-error').show();
            educationError = false;
            return false;
        } else {
            $('.staff-education-error').hide();
            educationError = true;
        }
    }


    let positionError = true;
    $('.staff-education').change(function () {
        position();
    });

    function position() {
        let position = $('.staff-education').val();
        if (position == '') {
            $('.staff-position-error').show();
            positionError = false;
            return false;
        } else {
            $('.staff-position-error').hide();
            positionError = true;
        }
    }

    $('.add-staff').click(function(){
        firstName();
        lastName();
        fatherName();
        idCard();
        Email();
        Phone();
        dob();
        gender();
        education();
        position();

        if((FirstNameError == true) && (LastNameError == true) && (fatherNameError == true) && (idCardError == true) && (emailError == true) && (phoneError == true) && (dobError == true) && (genderError == true) && (educationError == true) && (positionError == true)){
            return true;
        }else{
            return false;
        }
    });
});