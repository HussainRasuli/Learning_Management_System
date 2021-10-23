$(document).ready(function () {
    var reg_name = /^[a-zA-Z\s]*$/; 

    let RoleNameError = true;
    $('.role_name').keyup(function () {
        roleName();
    });

    function roleName() {
        let data = $('.role_name').val();
        if (data == '') {
            $('.role-name-error').show();
            RoleNameError = false;
            return false;
        } else if ((data.length < 2)) {
            $('.role-name-error').show();
            $('.role-name-error').html('Role Name Must Be Greater Than 2 Characters.!');
            RoleNameError = false;
            return false;
        } else if(!reg_name.test(data)){
            $('.role-name-error').show();
            $('.role-name-error').html('Only alphabets are allowed.!');
            RoleNameError = false;
            return false;
        } else {
            $('.role-name-error').hide();
            RoleNameError = true;
        }
    }

    let RoleTypeError = true;
    $('.role_type').change(function () {
        role_type();
    });

    function role_type() {
        let data = $('.role_type').val();
        if (data == '') {
            $('.role-type-error').show();
            RoleTypeError = false;
            return false;
        } else {
            $('.role-type-error').hide();
            RoleTypeError = true;
        }
    }

    let PermissionError = true;
    $('.permission').change(function () {
        permission();
    });

    function permission() {
        let data = $('.permission').val();
        if (data == '') {
            $('.permission-error').show();
            PermissionError = false;
            return false;
        } else {
            $('.permission-error').hide();
            PermissionError = true;
        }
    }

    $('.submit_btn').click(function(){
        roleName();
        role_type();
        permission();
       
        if((RoleNameError == true) && (RoleTypeError == true) && (PermissionError == true)){
            return true;
        }else{
            return false;
        }
    });
});