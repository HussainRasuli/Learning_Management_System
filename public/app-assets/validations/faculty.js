$(document).ready(function () {
    var reg_name_lastname = /^[a-zA-Z\s]*$/; 
    
    let FacultyNameError = true;
    $('#faculty').keyup(function () {
        facultyName();
    });

    function facultyName() {
        let data = $('#faculty').val();
        if (data == '') {
            $('#faculty-name-error').show();
            FacultyNameError = false;
            return false;
        } else if ((data.length < 3)) {
            $('#faculty-name-error').show();
            $('#faculty-name-error').html('Faculty Name Must Be Greter Than 3 Characters.!');
            FacultyNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('#faculty-name-error').show();
            $('#faculty-name-error').html('Only alphabets are allowed.!');
            FacultyNameError = false;
            return false;
        } else if(!reg_name_lastname.test(data)){
            $('#faculty-name-error').show();
            $('#faculty-name-error').html('Only alphabets are allowed.!');
            FacultyNameError = false;
            return false;
        } else {
            $('#faculty-name-error').hide();
            FacultyNameError = true;
        }
    }


    let DepartmentNameError = true;
    $('.faculty-department-name').keyup(function () {
        departmentName();
    });

    function departmentName() {
        let data = $('.faculty-department-name').val();
        if (data == '') {
            $('#department-name-error').show();
            DepartmentNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('#department-name-error').show();
            $('#department-name-error').html('Department Name Must Be Greter Than 2 Characters.!');
            DepartmentNameError = false;
            return false;
        } else if($.isNumeric(data)){
            $('#department-name-error').show();
            $('#department-name-error').html('Only alphabets are allowed.!');
            DepartmentNameError = false;
            return false;
        } else if(!reg_name_lastname.test(data)){
            $('#department-name-error').show();
            $('#department-name-error').html('Only alphabets are allowed.!');
            DepartmentNameError = false;
            return false;
        } else {
            $('#department-name-error').hide();
            DepartmentNameError = true;
        }
    }


    let DepartmentCodeError = true;
    $('.dep-code').keyup(function () {
        departmentCode();
    });

    function departmentCode() {
        let data = $('.dep-code').val();
        if (data == '') {
            $('#dep-code-error').show();
            DepartmentCodeError = false;
            return false;
        } else {
            $('#dep-code-error').hide();
            DepartmentCodeError = true;
        }
    }

    $('#btn_submit').click(function(){
        facultyName();
        departmentName();
        departmentCode();

        if((FacultyNameError == true) && (DepartmentNameError == true) && (DepartmentCodeError == true)){
            return true;
        }else{
            return false;
        }
    });
});