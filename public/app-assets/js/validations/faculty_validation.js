$(document).ready(function(){

  
    let FacultyError = true;
    $('#input_faculty').keyup(function(){ 
        InputFaculty();
    });
  function InputFaculty(){
      let data = $('#input_faculty').val();
      if( data == ''){
          $('#faculty_error_message').show();
          FacultyError = false;
          return false;
      }
      else if(data.match(/[0-9]/g)){
          $('#faculty_error_message').show();
          $('#faculty_error_message').html('Type only letters.');
          FacultyError = false;
          return false;
      }
      else if(data.length <= 2){
        $('#faculty_error_message').show();
        $('#faculty_error_message').html('The Faculty Name Must Be greater than 2 letters.');
        FacultyError = false;
        return false;
     }
      else if((data.length >= 60)){
        $('#faculty_error_message').show();
        $('#faculty_error_message').html('The Faculty Name Must Be less than 60 letters.');
        FacultyError = false;
        return false;
      }
      else{
            $('#faculty_error_message').hide();
            FacultyError = true;
        }
  }


  let DepartmentError = true;
  $('#input_department').keyup(function(){ 
      InputDepartment();
  });
function InputDepartment(){
    let data = $('#input_department').val();
    if( data == ''){
        $('#department_error_message').show();
        DepartmentError = false;
        return false;
    }
    else if(data.match(/[0-9]/g)){
        $('#department_error_message').show();
        $('#department_error_message').html('Type only letters.');
        DepartmentError = false;
        return false;
    }
    else if((data.length <= 1)){
        $('#department_error_message').show();
        $('#department_error_message').html('Department Name Must Be greater than 1 characters.');
        DepartmentError = false;
        return false;
    }
    else if((data.length >= 50)){
        $('#department_error_message').show();
        $('#department_error_message').html('Department Name Must Be less than 50 characters.');
        DepartmentError = false;
        return false;
    }
    else{
          $('#department_error_message').hide();
          DepartmentError = true;
      }
}

let Dep_code_Error = true;
$('#input_dep_code').keyup(function(){ 
    InputDepCode();
});
function InputDepCode(){
  let data = $('#input_dep_code').val();
  if( data == ''){
      $('#dep_code_error_message').show();
      Dep_code_Error = false;
      return false;
  }
  else if((data.length > 2)){
      $('#dep_code_error_message').show();
      $('#dep_code_error_message').html('Department Code Must Be less than 3 digits.');
      Dep_code_Error = false;
      return false;
  }
  else{
        $('#dep_code_error_message').hide();
        Dep_code_Error = true;
    }
}

  
  $('#btn_submit').click(function(){
      InputFaculty();
      InputDepartment();
      InputDepCode();

      if((FacultyError == true) && (DepartmentError == true) && (Dep_code_Error == true)) {
          return true;
      }
      else{
          return false;
      }
  });
});