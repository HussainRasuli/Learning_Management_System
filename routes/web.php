<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
  Route::view('/dashboard', '/layouts.master')->name('dashboard');
  Route::get('/get-notification', 'DashboardController@getNotification')->name('get-notification');
  Route::get('/notification-readed', 'DashboardController@notificationReaded')->name('notification-readed');

  //----------------- Faculty Route --------------------------//
  Route::get('faculty','FacultyController@index')->name('faculty');
  Route::get('faculty-form','FacultyController@show')->name('faculty-form');
  Route::post('add-faculty','FacultyController@store')->name('add-faculty');
  Route::post('edit_department','FacultyController@edit')->name('edit_department');
  Route::post('add_new_department','FacultyController@add_new_department')->name('add_new_department');
  Route::post('delete_faculty','FacultyController@delete_faculty')->name('delete_faculty');
  Route::post('edit_faculty_name','FacultyController@edit_faculty')->name('edit_faculty_name');
  Route::post('edit_department_name','FacultyController@edit_department_name')->name('edit_department_name');
  Route::post('delete_department','FacultyController@delete_department')->name('delete_department');
  Route::post('set_admin','FacultyController@set_admin')->name('set_admin');

  //----------------- Staff Route --------------------------//
  Route::get('staff-list','StaffController@index')->name('staff-list');
  Route::get('staff-form','StaffController@staff_form')->name('staff-form');
  Route::post('add_staff','StaffController@store')->name('add_staff');
  Route::post('delete_staff','StaffController@delete_staff')->name('delete_staff');
  Route::post('edit_staff','StaffController@edit')->name('edit_staff');
  Route::post('update_staff','StaffController@update_staff')->name('update_staff');
  Route::get('edit_staff_modal','StaffController@edit_staff_model')->name('edit_staff_modal');
  Route::post('make-account-staff','StaffController@store')->name('make-account-staff');
  Route::get('/check_position_type_id/{id?}','StaffController@check_position_type_id')->name('check_position_type_id');
  Route::get('view_staff_modal','StaffController@view_staff_modal')->name('view_staff_modal');
  Route::post('search_staff','StaffController@search_staff')->name('search_staff');
  
  
   //----------------- Position Route --------------------------//
  Route::get('/position_list','PositionController@index')->name('position_list');
  Route::get('/position_form','PositionController@position_form')->name('position_form');
  Route::post('/add_position','PositionController@store')->name('add_position');
  Route::post('/update_position','PositionController@update_position')->name('update_position');
  Route::post('/delete_position','PositionController@delete_position')->name('delete_position');
  Route::get('/edit_position/{position_id?}','PositionController@edit_position')->name('edit_position');

   //----------------- Course Route --------------------------//
  Route::get('/course', 'CourseController@index')->name('course');
  Route::get('/get-dep/{id?}', 'CourseController@getDepartment')->name('get-dep');
  Route::post('/get-courses', 'CourseController@getCourses')->name('get-courses');
  Route::get('/new-course', 'CourseController@addNew')->name('new-course');
  Route::post('/add-course', 'CourseController@store')->name('add-course');
  Route::post('/delete-course', 'CourseController@delete')->name('delete-course');
  Route::post('/update-course', 'CourseController@update')->name('update-course');
  Route::get('/edit-modal/{id?}', 'CourseController@edit')->name('edit-modal');
  Route::get('/active_select_credit', 'CourseAproveController@active_select_credit')->name('active_select_credit');
  Route::get('/deactive_select_credit', 'CourseAproveController@deactive_select_credit')->name('deactive_select_credit');

  //----------------- Set Course Route --------------------------//
  Route::get('/approved-courses', 'CourseController@appreovedCourses')->name('approved-courses');
  Route::get('/set-course', 'CourseController@setCourse')->name('set-course');
  Route::get('/get-new-tr', 'CourseController@getNewTr')->name('get-new-tr');
  Route::post('/set-course-teacher', 'CourseController@setCourseTeacher')->name('set-course-teacher');
  Route::get('/set-course-edit/{id?}', 'CourseController@setCourseEdit')->name('set-course-edit');
  Route::post('/update-set-course', 'CourseController@updateSetCourse')->name('update-set-course');
  Route::post('/delete-set-course', 'CourseController@deleteSetCourse')->name('delete-set-course');

  //----------------- Approve Course Route --------------------------//   
  Route::get('/approve-course', 'CourseAproveController@index')->name('approve-course');
  Route::get('/active-course', 'CourseAproveController@activeCourse')->name('active-course');
  Route::post('/active-this-department', 'CourseAproveController@activeDepartment')->name('active-this-department');
  Route::post('/deactive-this-department', 'CourseAproveController@deactiveDepartment')->name('deactive-this-department');
  Route::get('/get-set-courses/{id?}', 'CourseAproveController@getCourses')->name('get-set-courses');
  Route::post('/approving-courses', 'CourseAproveController@approvingCourses')->name('approving-courses');

  //----------------- Teacher Route --------------------------//
  Route::get('/lecturer', 'TeacherController@index')->name('lecturer');
  Route::get('/new-lecturer', 'TeacherController@addLecturer')->name('new-lecturer');
  Route::post('/add-lecturer', 'TeacherController@store')->name('add-lecturer');
  Route::get('/edit-teacher/{id?}', 'TeacherController@edit')->name('edit-teacher');
  Route::post('/update-teacher', 'TeacherController@update')->name('update-teacher');
  Route::post('/delete-teacher', 'TeacherController@delete')->name('delete-teacher');
  Route::post('/make-account-teacher', 'TeacherController@store')->name('make-account-teacher');
  Route::get('/view_teacher_modal', 'TeacherController@view_teacher_modal')->name('view_teacher_modal');
  Route::post('search_teacher', 'TeacherController@search_teacher')->name('search_teacher');
  

  //----------------- Teacher Course Route --------------------------//
  Route::get('/teacher-course', 'TeacherCourseController@index')->name('teacher-course');
  Route::get('/get-course-details/{id?}/{sem?}', 'TeacherCourseController@home')->name('get-course-details');
  Route::post('/add-syllabus', 'TeacherCourseController@addSyllabus')->name('add-syllabus');
  Route::get('get-course-syllabus/{id?}', 'TeacherCourseController@getSyllabus')->name('get-course-syllabus');
  Route::post('/delete-syllabus', 'TeacherCourseController@deleteSyllabus')->name('delete-syllabus');
  Route::get('/get-module/{date?}/{course?}/{sem?}', 'TeacherCourseController@getModule')->name('get-module');
  Route::get('/get-dropZone', 'TeacherCourseController@getDropZone')->name('get-dropZone');
  Route::post('/addData/{course?}/{week?}/{sem?}', 'TeacherCourseController@addData')->name('addData');
  Route::get('/play-data/{file?}', 'TeacherCourseController@playData')->name('play-data');
  Route::get('/download-data/{data?}', 'TeacherCourseController@downloadData')->name('download-data');
  Route::post('/delete-material', 'TeacherCourseController@deleteData')->name('delete-material');
  Route::get('/get-week-data/{weekNum?}/{course?}/{sem?}', 'TeacherCourseController@getWeekData')->name('get-week-data');
  Route::get('/get-assignment/{date?}/{course?}/{sem?}', 'TeacherCourseController@getAssignment')->name('get-assignment');
  Route::get('/get-assignment-form', 'TeacherCourseController@getAssignmentForm')->name('get-assignment-form');
  Route::post('/add-assignment', 'TeacherCourseController@addAssignment')->name('add-assignment');
  Route::get('/download-assignment/{data?}', 'TeacherCourseController@downloadAssignment')->name('download-assignment');
  Route::post('/delete-assignment', 'TeacherCourseController@deleteAssignment')->name('delete-assignment');
  Route::get('/get-people/{course?}/{semester?}', 'TeacherCourseController@getPeople')->name('get-people');
  Route::post('/view-pdf', 'TeacherCourseController@viewPDF')->name('view-pdf');
  Route::get('/get-week-assignemnt/{weekNum?}/{course?}/{sem?}', 'TeacherCourseController@getWeekAssignment')->name('get-week-assignemnt');
  Route::post('/edit-assignment', 'TeacherCourseController@editAssignment')->name('edit-assignment');
  
  Route::get('student_assignment_list/{as_id?}', 'TeacherCourseController@student_assignment_list')->name('student_assignment_list');
  Route::post('/student_assignment/{course?}/{week?}/{date?}/{ma_id?}/{sem?}', 'TeacherCourseController@student_assignment')->name('student_assignment');
  Route::get('send_assignment', 'TeacherCourseController@send_assignment')->name('send_assignment');
  Route::get('view_student_assignment/{stu_id?}/{as_id?}', 'TeacherCourseController@view_student_assignment')->name('view_student_assignment');
  Route::post('view_pdf_student_ass', 'TeacherCourseController@view_pdf_student_ass')->name('view_pdf_student_ass');
  Route::get('download-student-assignment/{data?}', 'TeacherCourseController@download_student_assignment')->name('download-student-assignment');
  Route::get('status_assignment_list/{stu_id?}/{as_id?}', 'TeacherCourseController@status_assignment_list')->name('status_assignment_list');
  Route::get('student_mark_modal/{sg_id?}/{mark?}', 'TeacherCourseController@student_mark_modal')->name('student_mark_modal');
  Route::post('send_student_mark', 'TeacherCourseController@send_student_mark')->name('send_student_mark');
  Route::get('student_resubmit_modal/{sg_id?}', 'TeacherCourseController@student_resubmit_modal')->name('student_resubmit_modal');
  Route::post('resubmit_assignment', 'TeacherCourseController@resubmit_assignment')->name('resubmit_assignment');
  Route::get('student_reject_modal/{sg_id?}', 'TeacherCourseController@student_reject_modal')->name('student_reject_modal');
  Route::post('reject_assignment', 'TeacherCourseController@reject_assignment')->name('reject_assignment');
  Route::post('update_picture_course', 'TeacherCourseController@update_picture_course')->name('update_picture_course');

  //----------------- Student Route --------------------------//
  Route::get('student_list', 'StudentController@index')->name('student_list');
  Route::get('student_form','StudentController@student_form')->name('student_form');
  Route::post('add_student','StudentController@add_student')->name('add_student');
  Route::post('delete_student','StudentController@delete_student')->name('delete_student');
  Route::get('edit_student_modal','StudentController@edit_student_modal')->name('edit_student_modal');
  Route::post('update_student','StudentController@update_student')->name('update_student');
  Route::get('view_student_modal','StudentController@view_student_modal')->name('view_student_modal');
  Route::get('/get-pagination', 'StudentController@getPage')->name('get-pagination');
  Route::get('/get_department/{id?}', 'StudentController@getDepartment')->name('get_department');
  Route::post('/make-account-student', 'StudentController@add_student')->name('make-account-student');
  Route::post('search_student', 'StudentController@search_student')->name('search_student');
  

  //----------------- Student Credit Selection Route --------------------------//
  Route::get('select_credit', 'StudentCourseController@index')->name('select_credit');
  Route::post('credit_submited', 'StudentCourseController@credit_submited')->name('credit_submited');
  Route::get('student_credit_list', 'StudentCourseController@student_credit_list')->name('student_credit_list');
  Route::get('/credit-pagination', 'StudentCourseController@getPage')->name('credit-pagination');
  Route::post('delails_credit_selection', 'StudentCourseController@delails_credit_selection')->name('delails_credit_selection');
  Route::post('approve_student_credit/{stu_id?}', 'StudentCourseController@approve_student_credit')->name('approve_student_credit');
  Route::get('search_student_credits', 'StudentCourseController@student_credits_page')->name('search_student_credits');
  Route::get('/get_student_credit', 'StudentCourseController@get_student_credit')->name('get_student_credit');
  Route::post('delete_student_credit', 'StudentCourseController@delete_student_credit')->name('delete_student_credit');
  Route::get('/change_course', 'StudentCourseController@change_course')->name('change_course');
  Route::post('/show_student_course', 'StudentCourseController@show_student_course')->name('show_student_course');
  Route::post('/edit_student_credit', 'StudentCourseController@edit_student_credit')->name('edit_student_credit');
  Route::post('change_student_course', 'StudentCourseController@change_student_course')->name('change_student_course');
  Route::get('active_credit_page', 'StudentCourseController@active_credit_page')->name('active_credit_page');
  Route::get('show_student_info', 'StudentCourseController@show_student_info')->name('show_student_info');
  Route::get('activeCreditFor_one_student', 'StudentCourseController@activeCreditFor_one_student')->name('activeCreditFor_one_student');
  Route::post('deactiveCreditFor_one_student', 'StudentCourseController@deactiveCreditFor_one_student')->name('deactiveCreditFor_one_student');
  Route::get('advance_search', 'StudentCourseController@advance_search')->name('advance_search');
  Route::get('/get_courses/{id?}', 'StudentCourseController@get_courses')->name('get_courses');
  Route::post('advance_credit_submited', 'StudentCourseController@advance_credit_submited')->name('advance_credit_submited');

  //----------------- Student Courses Route --------------------------//
  Route::get('/student-course', 'StudentPrivateCourseController@index')->name('student-course');
  Route::get('/student_get_course_details/{id?}/{sem?}', 'StudentPrivateCourseController@get_course_details')->name('student_get_course_details');
  Route::get('/get-assignment-student/{date?}/{course?}/{sem?}', 'StudentPrivateCourseController@getAssignments')->name('get-assignment-student');
  Route::get('/get-student-week-assignemnt/{week?}/{course?}/{sem?}', 'StudentPrivateCourseController@getStudentWeekAssignment')->name('get-student-week-assignemnt');
  Route::post('/resubmit-assignment', 'StudentPrivateCourseController@resubmitAssignment')->name('resubmit-assignment');
  
  
  //----------------- Role Route --------------------------//
  Route::get('role_list', 'RoleController@index')->name('role_list');
  Route::get('role_form','RoleController@role_form')->name('role_form');
  Route::post('add_role','RoleController@add_role')->name('add_role');
  Route::get('edit_role','RoleController@edit_role')->name('edit_role');
  Route::post('update_role','RoleController@update_role')->name('update_role');
  Route::post('delete_role','RoleController@delete_role')->name('delete_role');
  Route::get('select_all','RoleController@select_all')->name('select_all');
  Route::get('deselect_all','RoleController@deselect_all')->name('deselect_all');

  //----------------- Year & Period Week Route --------------------------//
  Route::get('yearPeriod_list', 'YearPeriodController@index')->name('yearPeriod_list');
  Route::get('yearPeriod_form', 'YearPeriodController@yearPeriod_form')->name('yearPeriod_form');
  Route::post('add_yearPeriod', 'YearPeriodController@add_yearPeriod')->name('add_yearPeriod');
  Route::get('edit_YearPeriod', 'YearPeriodController@edit_YearPeriod')->name('edit_YearPeriod');
  Route::post('delete_YearPeriod', 'YearPeriodController@delete_YearPeriod')->name('delete_YearPeriod');
  Route::post('update_YearPeriod', 'YearPeriodController@update_YearPeriod')->name('update_YearPeriod');

  //----------------- User Route --------------------------//
  Route::get('user_list', 'UserController@index')->name('user_list');
  Route::get('/user-pagination', 'UserController@user_pagination')->name('user-pagination');
  Route::post('/get-users', 'UserController@getUsers')->name('get-users'); 
  Route::post('/delete-user', 'UserController@deleteUser')->name('delete-user');
  Route::get('/edit-user-modal/{id?}', 'UserController@editUser')->name('edit-user-modal');
  Route::post('/update-user', 'UserController@updateUser')->name('update-user');
});

  //----------------- User Profile --------------------------//
  Route::get('user_profile', 'UserProfileController@index')->name('user_profile');
  Route::post('change_password', 'UserProfileController@change_password')->name('change_password');
  Route::post('update_picture', 'UserProfileController@update_picture')->name('update_picture');
  