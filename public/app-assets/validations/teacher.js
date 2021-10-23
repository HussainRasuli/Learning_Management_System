$(document).ready(function () {
    var reg_name = /^[a-zA-Z\s]*$/; 

    let FirstNameError = true;
    $('.teacher-first-name').keyup(function () {
        firstName();
    });

    function firstName() {
        let data = $('.teacher-first-name').val();
        if (data == '') {
            $('.teacher-firstname-error').show();
            FirstNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.teacher-firstname-error').show();
            $('.teacher-firstname-error').html('First Name Must Be Greter Than 2 Characters.!');
            FirstNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.teacher-firstname-error').show();
            $('.teacher-firstname-error').html('Only alphabets are allowed.!');
            FirstNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.teacher-firstname-error').show();
            $('.teacher-firstname-error').html('Only alphabets are allowed.!');
            FirstNameError = false;
            return false;
        } else {
            $('.teacher-firstname-error').hide();
            FirstNameError = true;
        }
    }


    let LastNameError = true;
    $('.teacher-last-name').keyup(function () {
        lastName();
    });

    function lastName() {
        let data = $('.teacher-last-name').val();
        if (data == '') {
            $('.teacher-lastname-error').show();
            LastNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.teacher-lastname-error').show();
            $('.teacher-lastname-error').html('Last Name Must Be Greter Than 2 Characters.!');
            LastNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.teacher-lastname-error').show();
            $('.teacher-lastname-error').html('Only alphabets are allowed.!');
            LastNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.teacher-lastname-error').show();
            $('.teacher-lastname-error').html('Only alphabets are allowed.!');
            LastNameError = false;
            return false;
        } else {
            $('.teacher-lastname-error').hide();
            LastNameError = true;
        }
    }


    let fatherNameError = true;
    $('.teacher-father-name').keyup(function () {
        fatherName();
    });

    function fatherName() {
        let data = $('.teacher-father-name').val();
        if (data == '') {
            $('.teacher-fathername-error').show();
            fatherNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.teacher-fathername-error').show();
            $('.teacher-fathername-error').html('Father Name Must Be Greter Than 2 Characters.!');
            fatherNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.teacher-fathername-error').show();
            $('.teacher-fathername-error').html('Only alphabets are allowed.!');
            fatherNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.teacher-fathername-error').show();
            $('.teacher-fathername-error').html('Only alphabets are allowed.!');
            fatherNameError = false;
            return false;
        } else {
            $('.teacher-fathername-error').hide();
            fatherNameError = true;
        }
    }


    let idCardError = true;
    $('.teacher-id-card').keyup(function () {
        idCard();
    });

    function idCard() {
        let data = $('.teacher-id-card').val();
        if (data == '') {
            $('.teacher-id-Card-error').show();
            idCardError = false;
            return false;
        } else if ((data.length < 3)) {
            $('.teacher-id-Card-error').show();
            $('.teacher-id-Card-error').html('ID Card Must Be Greter Than 3 Characters.!');
            idCardError = false;
            return false;
        } else {
            $('.teacher-id-Card-error').hide();
            idCardError = true;
        }
    }


    let emailError = true;
    $('.teacher-email').keyup(function(){
        Email();
    });
    function Email(){
        let emailValue = $('.teacher-email').val();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(emailValue == ''){
            $('.teacher-email-error').show();
            emailError = false;
            return false;
        }else if((emailValue.length < 10) || (emailValue.length > 30)){
            $('.teacher-email-error').show();
            $('.teacher-email-error').html('Email Between 10 And 30 Characters');
            emailError = false;
            return false;
        }else if(!regex.test(emailValue)){
            $('.teacher-email-error').show();
            $('.teacher-email-error').html('Invalid E-mail Address');
            emailError = false;
            return false;
        }else if($.isNumeric(emailValue)){
            $('.teacher-email-error').show();
            $('.teacher-email-error').html('Only characters are allowed.!');
            emailError = false;
            return false;
        }else{
            $('.teacher-email-error').hide();
            emailError = true;
        }
    }


    let phoneError = true;
    $('.teacher-phone').keyup(function () {
        Phone();
    });

    function Phone() {
        let phone = $('.teacher-phone').val();
        if (phone == '') {
            $('.teacher-phone-error').show();
            phoneError = false;
            return false;
        } else if ((phone.length <= 9) || (phone.length >= 16)) {
            $('.teacher-phone-error').show();
            $('.teacher-phone-error').html('Phone Number Between 10 To 15 Digits.');
            phoneError = false;
            return false;
        } else {
            $('.teacher-phone-error').hide();
            phoneError = true;
        }
    }


    let dobError = true;
    $('.teacher-dob').keyup(function () {
        dob();
    });

    function dob() {
        let dob = $('.teacher-dob').val();
        if (dob == '') {
            $('.teacher-dob-error').show();
            dobError = false;
            return false;
        } else {
            $('.teacher-dob-error').hide();
            dobError = true;
        }
    }


    let genderError = true;
    $('.teacher-gender').change(function () {
        gender();
    });

    function gender() {
        let gender = $('.teacher-gender').val();
        if (gender == '') {
            $('.teacher-gender-error').show();
            genderError = false;
            return false;
        } else {
            $('.teacher-gender-error').hide();
            genderError = true;
        }
    }


    let educationError = true;
    $('.teacher-education').change(function () {
        education();
    });

    function education() {
        let education = $('.teacher-education').val();
        if (education == '') {
            $('.teacher-education-error').show();
            educationError = false;
            return false;
        } else {
            $('.teacher-education-error').hide();
            educationError = true;
        }
    }


    $('.add-teacher').click(function(){
        firstName();
        lastName();
        fatherName();
        idCard();
        Email();
        Phone();
        dob();
        gender();
        education();

        if((FirstNameError == true) && (LastNameError == true) && (fatherNameError == true) && (idCardError == true) && (emailError == true) && (phoneError == true) && (dobError == true) && (genderError == true) && (educationError == true)){
            return true;
        }else{
            return false;
        }
    });
});