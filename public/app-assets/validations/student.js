$(document).ready(function () {
    var reg_name = /^[a-zA-Z\s]*$/; 

    let FirstNameError = true;
    $('.student-first-name').keyup(function () {
        firstName();
    });

    function firstName() {
        let data = $('.student-first-name').val();
        if (data == '') {
            $('.student-firstname-error').show();
            FirstNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.student-firstname-error').show();
            $('.student-firstname-error').html('First Name Must Be Greter Than 2 Characters.!');
            FirstNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.student-firstname-error').show();
            $('.student-firstname-error').html('Only alphabets are allowed.!');
            FirstNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.student-firstname-error').show();
            $('.student-firstname-error').html('Only alphabets are allowed.!');
            FirstNameError = false;
            return false;
        } else {
            $('.student-firstname-error').hide();
            FirstNameError = true;
        }
    }


    let LastNameError = true;
    $('.student-last-name').keyup(function () {
        lastName();
    });

    function lastName() {
        let data = $('.student-last-name').val();
        if (data == '') {
            $('.student-lastname-error').show();
            LastNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.student-lastname-error').show();
            $('.student-lastname-error').html('Last Name Must Be Greter Than 2 Characters.!');
            LastNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.student-lastname-error').show();
            $('.student-lastname-error').html('Only alphabets are allowed.!');
            LastNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.student-lastname-error').show();
            $('.student-lastname-error').html('Only alphabets are allowed.!');
            LastNameError = false;
            return false;
        } else {
            $('.student-lastname-error').hide();
            LastNameError = true;
        }
    }


    let fatherNameError = true;
    $('.student-father-name').keyup(function () {
        fatherName();
    });

    function fatherName() {
        let data = $('.student-father-name').val();
        if (data == '') {
            $('.student-fathername-error').show();
            fatherNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.student-fathername-error').show();
            $('.student-fathername-error').html('Father Name Must Be Greter Than 2 Characters.!');
            fatherNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('.student-fathername-error').show();
            $('.student-fathername-error').html('Only alphabets are allowed.!');
            fatherNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.student-fathername-error').show();
            $('.student-fathername-error').html('Only alphabets are allowed.!');
            fatherNameError = false;
            return false;
        } else {
            $('.student-fathername-error').hide();
            fatherNameError = true;
        }
    }


    let idCardError = true;
    $('.student-id-card').keyup(function () {
        idCard();
    });

    function idCard() {
        let data = $('.student-id-card').val();
        if (data == '') {
            $('.student-id-Card-error').show();
            idCardError = false;
            return false;
        } else if ((data.length < 3)) {
            $('.student-id-Card-error').show();
            $('.student-id-Card-error').html('ID Card Must Be Greter Than 3 Characters.!');
            idCardError = false;
            return false;
        } else {
            $('.student-id-Card-error').hide();
            idCardError = true;
        }
    }


    let emailError = true;
    $('.student-email').keyup(function(){
        Email();
    });
    function Email(){
        let emailValue = $('.student-email').val();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(emailValue == ''){
            $('.student-email-error').show();
            emailError = false;
            return false;
        }else if((emailValue.length < 10) || (emailValue.length > 30)){
            $('.student-email-error').show();
            $('.student-email-error').html('Email Between 10 And 30 Characters');
            emailError = false;
            return false;
        }else if(!regex.test(emailValue)){
            $('.student-email-error').show();
            $('.student-email-error').html('Invalid E-mail Address');
            emailError = false;
            return false;
        }else if($.isNumeric(emailValue)){
            $('.student-email-error').show();
            $('.student-email-error').html('Only characters are allowed.!');
            emailError = false;
            return false;
        }else{
            $('.student-email-error').hide();
            emailError = true;
        }
    }


    let phoneError = true;
    $('.student-phone').keyup(function () {
        Phone();
    });

    function Phone() {
        let phone = $('.student-phone').val();
        if (phone == '') {
            $('.student-phone-error').show();
            phoneError = false;
            return false;
        } else if ((phone.length <= 9) || (phone.length >= 16)) {
            $('.student-phone-error').show();
            $('.student-phone-error').html('Phone Number Between 10 To 15 Digits.');
            phoneError = false;
            return false;
        } else {
            $('.student-phone-error').hide();
            phoneError = true;
        }
    }


    let dobError = true;
    $('.student-dob').keyup(function () {
        dob();
    });

    function dob() {
        let dob = $('.student-dob').val();
        if (dob == '') {
            $('.student-dob-error').show();
            dobError = false;
            return false;
        } else {
            $('.student-dob-error').hide();
            dobError = true;
        }
    }


    let genderError = true;
    $('.student-gender').change(function () {
        gender();
    });

    function gender() {
        let gender = $('.student-gender').val();
        if (gender == '') {
            $('.student-gender-error').show();
            genderError = false;
            return false;
        } else {
            $('.student-gender-error').hide();
            genderError = true;
        }
    }


    let facultyError = true;
    $('.faculty').change(function () {
        faculty();
    });

    function faculty() {
        let faculty = $('.faculty').val();
        if (faculty == '') {
            $('.student-faculty-error').show();
            facultyError = false;
            return false;
        } else {
            $('.student-faculty-error').hide();
            facultyError = true;
        }
    }


    let departmentError = true;
    $('.department').change(function () {
        department();
    });

    function department() {
        let department = $('.department').val();
        if (department == '') {
            $('.student-department-error').show();
            departmentError = false;
            return false;
        } else {
            $('.student-department-error').hide();
            departmentError = true;
        }
    }

    let semesterError = true;
    $('.semester').change(function () {
        semester();
    });

    function semester() {
        let semester = $('.semester').val();
        if (semester == '') {
            $('.student-semester-error').show();
            semesterError = false;
            return false;
        } else {
            $('.student-semester-error').hide();
            semesterError = true;
        }
    }


    let shiftError = true;
    $('.shift').change(function () {
        shift();
    });

    function shift() {
        let shift = $('.shift').val();
        if (shift == '') {
            $('.student-shift-error').show();
            shiftError = false;
            return false;
        } else {
            $('.student-shift-error').hide();
            shiftError = true;
        }
    }


    $('.add-student').click(function(){
        firstName();
        lastName();
        fatherName();
        idCard();
        Email();
        Phone();
        dob();
        gender();
        faculty();
        department();
        semester();
        shift();

        if((FirstNameError == true) && (LastNameError == true) && (fatherNameError == true) && (idCardError == true) && (emailError == true) && (phoneError == true) && (dobError == true) && (genderError == true) && (facultyError == true) && (departmentError == true) && (semesterError == true) && (shiftError == true)){
            return true;
        }else{
            return false;
        }
    });
});