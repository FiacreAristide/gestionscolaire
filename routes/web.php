 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ClassCourseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\InvalidCourseController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\ExaminationsController;


/*
|------------------------------------------------------------------s--------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'login']);

Route::post('login', [AuthController::class, 'authlogin']);

Route::get('logout', [AuthController::class, 'logout']);

Route::get('forgot-password', [AuthController::class, 'forgotpassword']);

Route::post('forgot-password', [AuthController::class, 'postforgotpassword']);

Route::get('reset/{token}', [AuthController::class, 'reset']);

Route::post('reset/{token}', [AuthController::class, 'postreset']);

Route::get('admin/dashboard', function(){
    return view('admin.dashboard');
});


Route::group(['middleware' => 'admin'], function(){

    //Admin
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);
    Route::get('admin/account', [UserController::class, 'myAccount']);
    Route::post('admin/account', [UserController::class, 'updateMyAccountAdmin']);


    //Teacher

    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);


    // Student url
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);
 
    //Parent url


    Route::get('admin/parent/list', [ParentController::class, 'list']);
    Route::get('admin/parent/add', [ParentController::class, 'add']);
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    Route::get('admin/parent/my-student/{id}', [ParentController::class, 'myStudent']);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'assignStudentParent']);
    Route::get('admin/parent/assign_student_parent_delete/{id}', [ParentController::class, 'assignStudentParentDelete']);

    //class url

    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);


    //domain url
    Route::get('admin/domain/list', [DomainController::class, 'list']);
    Route::get('admin/domain/add', [DomainController::class, 'add']);
    Route::post('admin/domain/add', [DomainController::class, 'insert']);
    Route::get('admin/domain/edit/{id}', [DomainController::class, 'edit']);
    Route::post('admin/domain/edit/{id}', [DomainController::class, 'update']);
    Route::get('admin/domain/delete/{id}', [DomainController::class, 'delete']);

    //Course

    Route::get('admin/course/list', [CourseController::class, 'list']);
    Route::get('admin/course/add', [CourseController::class, 'add']);
    Route::post('admin/course/add', [CourseController::class, 'insert']);
    Route::get('admin/course/edit/{id}', [CourseController::class, 'edit']);
    Route::post('admin/course/edit/{id}', [CourseController::class, 'update']);
    Route::get('admin/course/delete/{id}', [CourseController::class, 'delete']);
 
    //subject url

    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);


    // class_course url


    Route::get('admin/class_course/list', [ClassCourseController::class, 'list']);
    Route::get('admin/class_course/add', [ClassCourseController::class, 'add']);
    Route::post('admin/class_course/add', [ClassCourseController::class, 'insert']);
    Route::get('admin/class_course/edit/{id}', [ClassCourseController::class, 'edit']);
    Route::post('admin/class_course/edit/{id}', [ClassCourseController::class, 'update']);
    Route::get('admin/class_course/delete/{id}', [ClassCourseController::class, 'delete']);
    Route::get('admin/class_course/edit_single/{id}', [ClassCourseController::class, 'edit_single']);
    Route::post('admin/class_course/edit_single/{id}', [ClassCourseController::class, 'update_single']);

    //Examens url

    Route::get('admin/examinations/exam/list', [ExaminationsController::class, 'examList']);
    Route::get('admin/examinations/exam/add', [ExaminationsController::class, 'examAdd']);
    Route::post('admin/examinations/exam/add', [ExaminationsController::class, 'examInsert']);
    Route::get('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'examEdit']);
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'examUpdate']);
    Route::get('admin/examinations/exam/delete/{id}', [ExaminationsController::class, 'examDelete']);

    Route::get('admin/examinations/calendar', [ExaminationsController::class, 'examCalendar']);
    Route::post('admin/examinations/calendar_insert', [ExaminationsController::class, 'examCalendarInsert']);
   

    





    Route::get('admin/class_timetable/list', [ClassTimetableController::class, 'list']);
    Route::post('admin/class_timetable/get_course', [ClassTimetableController::class, 'get_course']);

    Route::post('admin/class_timetable/add', [ClassTimetableController::class, 'insert_update']);

    


    //class_teacher url

    Route::get('admin/class_teacher/list', [ClassTeacherController::class, 'list']);
    Route::get('admin/class_teacher/add', [ClassTeacherController::class, 'add']);
    Route::post('admin/class_teacher/add', [ClassTeacherController::class, 'insert']);
    Route::get('admin/class_teacher/edit/{id}', [ClassTeacherController::class, 'edit']);
    Route::post('admin/class_teacher/edit/{id}', [ClassTeacherController::class, 'update']);
    Route::get('admin/class_teacher/delete/{id}', [ClassTeacherController::class, 'delete']);
    Route::get('admin/class_teacher/edit_single/{id}', [ClassTeacherController::class, 'edit_single']);
    Route::post('admin/class_teacher/edit_single/{id}', [ClassTeacherController::class, 'update_single']);
    
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);

});

Route::group(['middleware' => 'teacher'], function(){
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);

    Route::get('teacher/account', [UserController::class, 'myAccount']);
    Route::post('teacher/account', [UserController::class, 'updateMyAccountTeacher']);

    Route::get('teacher/my_class_course', [ClassTeacherController::class, 'myClassCourse']);
    Route::get('teacher/my_class_course/class_timetable/{class_id}/{course_id}', [ClassTimetableController::class, 'myClassTimetable']);

    Route::get('teacher/my_student', [StudentController::class, 'myStudent']);

    Route::get('teacher/my_exam_calendar', [ExaminationsController::class, 'myExamTimetableTeacher']);
    


});


    Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);
    Route::get('student/account', [UserController::class, 'myAccount']);
    Route::post('student/account', [UserController::class, 'updateMyAccountStudent']);
    Route::get('student/my_subject', [CourseController::class, 'myCourse']);
    Route::get('student/my_timetable', [ClassTimetableController::class, 'myTimetable']);
    Route::get('student/my_exam_timetable', [ExaminationsController::class, 'myExamTimetable']);
    //Ajout un cours non validé
    Route::get('student/add_new_course', [InvalidCourseController::class, 'add']);
    Route::post('student/add_new_course', [InvalidCourseController::class, 'insert']);


});


Route::group(['middleware' => 'parent'], function(){
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);
    Route::get('parent/account', [UserController::class, 'myAccount']);
    Route::post('parent/account', [UserController::class, 'updateMyAccountParent']); 
    Route::get('parent/my_student',[ParentController::class, 'myStudentParent']);
    Route::get('parent/my_student/course/{student_id}',[CourseController::class, 'myStudentCourse']);
    Route::get('parent/my_student/exam_timetable/{student_id}',[ExaminationsController::class, 'myStudentExamTimetable']);
    Route::get('parent/my_student/course/class_timetable/{class_id}/{course_id}/{student_id}',[ClassTimetableController::class, 'myStudentTimetable']);   
});