 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
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
use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\FeesCollectionController;
use App\Http\Controllers\MentionController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SelectedCoursesController;
use App\Http\Controllers\SelectedCoursesPrintController;

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
    Route::get('admin/impression',[AdminController::class, 'impression']);
    Route::get('admin/impression/student_list',[AdminController::class, 'studentList']);
    Route::get('admin/impression/teacher_list',[AdminController::class, 'teacherList']);
    //School year url
    Route::get('admin/school_year/list', [SchoolYearController::class, 'list']);
    Route::get('admin/school_year/add', [SchoolYearController::class, 'add']);
    Route::post('admin/school_year/add', [SchoolYearController::class, 'insert']);
    Route::get('admin/school_year/activate/{year_id}', [SchoolYearController::class, 'activate']);
    //Route::post('admin/school_year/set-in-progress', [SchoolYearController::class, 'setInProgress']);
    Route::get('admin/school_year/update-activate/{year_id}', [SchoolYearController::class, 'setInProgress']);

    //Teacher
    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);
    Route::get('admin/teacher/print_list', [TeacherController::class, 'printList']);
    // Student url
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);
    Route::get('admin/student/print_card/{id}', [ExaminationsController::class, 'printCard']);
    Route::get('admin/student/print_list',[StudentController::class, 'printList']);
    
    
    //Parent url
    // Route::get('admin/parent/list', [ParentController::class, 'list']);
    // Route::get('admin/parent/add', [ParentController::class, 'add']);
    // Route::post('admin/parent/add', [ParentController::class, 'insert']);
    // Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    // Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    // Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    // Route::get('admin/parent/my-student/{id}', [ParentController::class, 'myStudent']);
    // Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'assignStudentParent']);
    // Route::get('admin/parent/assign_student_parent_delete/{id}', [ParentController::class, 'assignStudentParentDelete']);
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
    //mention urls
    Route::get('admin/mention/list', [MentionController::class, 'list']);
    Route::get('admin/mention/add', [MentionController::class, 'add']);
    Route::post('admin/mention/add', [MentionController::class, 'insert']);
    Route::get('admin/mention/edit/{id}', [MentionController::class, 'edit']);
    Route::post('admin/mention/edit/{id}', [MentionController::class, 'update']);
    Route::get('admin/mention/delete/{id}', [MentionController::class, 'delete']);

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

    //Course_teacher url
    Route::get('admin/course_teacher/list', [CourseTeacherController::class, 'list']);
    Route::get('admin/course_teacher/add', [CourseTeacherController::class, 'add']);
    Route::post('admin/course_teacher/add', [CourseTeacherController::class, 'insert']);
    Route::get('admin/course_teacher/edit/{id}', [CourseTeacherController::class, 'edit']);
    Route::post('admin/course_teacher/edit/{id}', [CourseTeacherController::class, 'update']);
    Route::get('admin/course_teacher/delete/{id}', [CourseTeacherController::class, 'delete']);
    Route::get('admin/course_teacher/edit_single/{id}', [CourseTeacherController::class, 'edit_single']);
    Route::post('admin/course_teacher/edit_single/{id}', [CourseTeacherController::class, 'update_single']);
    
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
    Route::get('admin/student_result/print', [ExaminationsController::class, 'printResult']);
    // Notes url Admin
    Route::get('admin/examinations/register', [ExaminationsController::class, 'examRegister']);
    Route::post('admin/examinations/submit_register', [ExaminationsController::class, 'submitRegister']);
    Route::post('admin/examinations/single_submit_register', [ExaminationsController::class, 'singleSubmitRegister']);

    Route::get('admin/examinations/makeup_register', [ExaminationsController::class, 'examMakeUpRegister']);
    Route::post('admin/examinations/single_submit_make_up_register', [ExaminationsController::class, 'singleSubmitRegister']);
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
    //Presence url
    Route::get('admin/attendance/student',[AttendanceController::class, 'studentAttendance']);
    Route::post('admin/attendance/student/save',[AttendanceController::class, 'studentAttendanceSubmit']);
    Route::get('admin/attendance/report',[AttendanceController::class, 'studentAttendanceReport']);
    //Scolarité url
    Route::get('admin/fees_collection/collect',[FeesCollectionController::class, 'feesCollection']);
    Route::get('admin/fees_collection/collect_report',[FeesCollectionController::class, 'feesCollectionReport']);
    Route::get('admin/fees_collection/collect/add/{student_id}',[FeesCollectionController::class, 'feesCollectionAdd']);
    Route::post('admin/fees_collection/collect/add/{student_id}',[FeesCollectionController::class, 'feesCollectionInsert']);
    
});

Route::group(['middleware' => 'teacher'], function(){
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);
    Route::get('teacher/account', [TeacherController::class, 'myAccount']);
    Route::post('teacher/account', [TeacherController::class, 'updateMyAccountTeacher']);
    Route::get('teacher/my_class_course', [ClassTeacherController::class, 'myClassCourse']);
    Route::get('teacher/my_class_course/class_timetable/{class_id}/{course_id}', [ClassTimetableController::class, 'myClassTimetable']);
    Route::get('teacher/my_student', [StudentController::class, 'myStudent']);
    Route::get('teacher/my_exam_calendar', [ExaminationsController::class, 'myExamTimetableTeacher']);
    // Notes url teacher
    Route::get('teacher/register', [ExaminationsController::class, 'teacherRegister']);
    Route::post('teacher/submit_register', [ExaminationsController::class, 'submitRegister']);
    Route::post('teacher/single_submit_register', [ExaminationsController::class, 'singleSubmitRegister']);

    Route::get('teacher/attendance/student',[AttendanceController::class, 'teacherAttendance']);
    Route::post('teacher/attendance/student/save',[AttendanceController::class, 'teacherAttendanceSubmit']);
    Route::get('teacher/attendance/report',[AttendanceController::class, 'teacherAttendanceReport']);

    
});
Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);
    Route::get('student/account', [StudentController::class, 'myAccount']);
    Route::post('student/account', [StudentController::class, 'updateMyAccountStudent']);
    Route::get('student/my_courses', [SelectedCoursesController::class, 'myAllCourses']);
    Route::get('student/my_courses_list_print/{student_id}', [SelectedCoursesController::class,'myCourseList']);
    Route::get('student/my_subject', [SelectedCoursesController::class, 'myCourse']);

    Route::post('student/my_courses', [SelectedCoursesController::class, 'insert']);
    Route::get('student/my_timetable', [ClassTimetableController::class, 'myTimetable']);
    Route::get('student/my_exam_timetable', [ExaminationsController::class, 'myExamTimetable']);
    //Note urls
    Route::get('student/my_exam_result', [ExaminationsController::class, 'myExamResult']);
    //Ajout un cours non validé
    Route::get('student/add_new_course', [InvalidCourseController::class, 'add']);
    Route::post('student/add_new_course', [InvalidCourseController::class, 'insert']);

});
// Route::group(['middleware' => 'parent'], function(){
//     Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
//     Route::get('parent/change_password', [UserController::class, 'change_password']);
//     Route::post('parent/change_password', [UserController::class, 'update_change_password']);
//     Route::get('parent/account', [UserController::class, 'myAccount']);
//     Route::post('parent/account', [UserController::class, 'updateMyAccountParent']); 
//     Route::get('parent/my_student',[ParentController::class, 'myStudentParent']);
//     Route::get('parent/my_student/course/{student_id}',[CourseController::class, 'myStudentCourse']);
//     Route::get('parent/my_student/exam_timetable/{student_id}',[ExaminationsController::class, 'myStudentExamTimetable']);
//     Route::get('parent/my_student/exam_result/{student_id}',[ExaminationsController::class, 'myStudentExamResult']);
//     Route::get('parent/my_student/course/class_timetable/{class_id}/{course_id}/{student_id}',[ClassTimetableController::class, 'myStudentTimetable']);
//     Route::get('parent/my_student/attendance/{student_id}',[AttendanceController::class, 'myStudentAttendance']);
// });