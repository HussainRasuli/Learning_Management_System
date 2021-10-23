$(document).ready(function () {
    var reg_name = /^[a-zA-Z\s]*$/; 

    let CourseNameError = true;
    $('#course-name').keyup(function () {
        courseName();
    });

    function courseName() {
        let data = $('#course-name').val();
        if (data == '') {
            $('#course-name-error').show();
            CourseNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('#course-name-error').show();
            $('#course-name-error').html('Course Name Must Be Greter Than 2 Characters.!');
            CourseNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('#course-name-error').show();
            $('#course-name-error').html('Only alphabets are allowed.!');
            CourseNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('#course-name-error').show();
            $('#course-name-error').html('Only alphabets are allowed.!');
            CourseNameError = false;
            return false;
        } else {
            $('#course-name-error').hide();
            CourseNameError = true;
        }
    }


    let SemesterError = true;
    $('#course-semester').change(function () {
        semester();
    });

    function semester() {
        let gender = $('#course-semester').val();
        if (gender == '') {
            $('#course-semester-error').show();
            SemesterError = false;
            return false;
        } else {
            $('#course-semester-error').hide();
            SemesterError = true;
        }
    }


    let CreditError = true;
    $('#course-credit').change(function () {
        credit();
    });

    function credit() {
        let education = $('#course-credit').val();
        if (education == '') {
            $('#course-credit-error').show();
            CreditError = false;
            return false;
        } else {
            $('#course-credit-error').hide();
            CreditError = true;
        }
    }


    $('#add-course').click(function(){
        courseName();
        credit();
        semester();

        if((CourseNameError == true) && (SemesterError == true) && (CreditError == true)){
            return true;
        }else{
            return false;
        }
    });
});