<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ExamCalendarModel extends Model
{
    use HasFactory;
    protected $table ='exam_calendar';


    static public function getSingle($id)
    {
      return self::find($id);
    }

    static public function getRecordSingle($exam_id, $class_id, $course_id,$activeYear)
    {
        return ExamCalendarModel::where('exam_id','=',$exam_id)->where('class_id','=',$class_id)->where('course_id','=',$course_id)->where('school_year_id','=',$activeYear)->first();
    }

    static public function deleteRecord($exam_id,$class_id,$activeYear)
    {
        ExamCalendarModel::where('exam_id','=',$exam_id)->where('class_id','=',$class_id)->where('school_year_id','=',$activeYear)->delete();
    }

    static public function getExam($class_id,$activeYear)
    {
       return ExamCalendarModel::select('exam_calendar.*','exam.name as exam_name')
            ->join('exam','exam.id','=','exam_calendar.exam_id')
            ->where('exam_calendar.class_id','=',$class_id)
            ->where('exam.school_year_id','=', $activeYear)
            ->groupBy('exam_calendar.exam_id')
            ->orderBy('exam_calendar.id','desc')
            ->get();
    }

    static public function getTeacherExam($teacher_id)
    {
        return ExamCalendarModel::select('exam_calendar.*','exam.name as exam_name')
            ->join('exam','exam.id','=','exam_calendar.exam_id')
            ->join('class_teacher','class_teacher.class_id','=','exam_calendar.class_id')
            ->where('class_teacher.teacher_id','=',$teacher_id)
            ->groupBy('exam_calendar.exam_id')
            ->orderBy('exam_calendar.id','desc')
            ->get();
    }
    static public function getExamTimetable($exam_id, $class_id,$activeYear)
    {
        return ExamCalendarModel::select('exam_calendar.*','course.name as course_name','course.type as course_type')
            ->join('course','course.id','=','exam_calendar.course_id')
            ->where('exam_calendar.exam_id','=',$exam_id)
            ->where('exam_calendar.class_id','=',$class_id)
            ->where('exam_calendar.school_year_id','=', $activeYear)
            ->get();
    }

//     static public function getCourse($exam_id, $class_id, $activeYear)
//    {
//     return ExamCalendarModel::select('exam_calendar.*', 'course.name as course_name', 'course.type as course_type')
//         ->join('course', 'course.id', '=', 'exam_calendar.course_id')
//         ->join('selected_course', 'selected_course.course_id', '=', 'exam_calendar.course_id')
//         ->where('exam_calendar.exam_id', '=', $exam_id)
//         ->where('selected_course.class_id', '=', $class_id)
//         ->where('exam_calendar.school_year_id', '=', $activeYear)
//         ->get();
//    }


    static public function getCourse($exam_id, $class_id,$activeYear)
    {
        return ExamCalendarModel::select('exam_calendar.*','course.name as course_name','course.type as course_type')
            ->join('course','course.id','=','exam_calendar.course_id')
            ->where('exam_calendar.exam_id','=',$exam_id)
            ->where('exam_calendar.class_id','=',$class_id)
            ->where('exam_calendar.school_year_id','=', $activeYear)
            ->get();
    }

    //Faire une opération entre class_course et selected_course et avoir les course_id qui sont dans la table selected_course mais pas dans la table class_course et les passers à la méthode qui va chercher les cours dans la table exam_calendar
    //Définir deux variables $getThisYearMissedCourse and $getPrevYearMissedCourse
    //$getThisYearMissedCourse = ExamCalendarModel::getThisYearMissedCourse($request->get('exam_id'),$request->get('class_id'),$activeYear);
    //$getPrevYearMissedCours = faire une opération entre la table selected_course et exam_calendar pour avoir les courses qui sont dans la table selected_course mais pas dans la table exam_calendar

// public static function getCoursesForRecovery($exam_id, $class_id, $activeYear)
// {
//     // Récupérer les cours non validés de l'année actuelle
//     $thisYearMissedCourses = ExamCalendarModel::select('exam_calendar.*', 'course.name as course_name', 'course.type as course_type')
//         ->join('course', 'course.id', '=', 'exam_calendar.course_id')
//         ->join('mark_register', function($join) {
//             $join->on('mark_register.course_id', '=', 'exam_calendar.course_id')
//                  ->whereRaw('(mark_register.note_devoir + mark_register.note_exam) / 2 < mark_register.passing_mark');
//         })
//         ->where('exam_calendar.exam_id', '=', $exam_id)
//         ->where('exam_calendar.class_id', '=', $class_id)
//         ->where('exam_calendar.school_year_id', '=', $activeYear)
//         ->get();

//     // Récupérer les cours sélectionnés par l'étudiant mais non présents dans exam_calendar
//     $selectedCoursesNotInExamCalendar = SelectedCoursesModel::select('selected_course.*', 'course.name as course_name', 'course.type as course_type','exam_calendar.*')
//         ->leftJoin('exam_calendar', 'exam_calendar.course_id', '=', 'selected_course.course_id')
//         ->join('course', 'course.id', '=', 'selected_course.course_id')
//         ->whereNull('exam_calendar.course_id')
//         ->get();

//     // Fusionner les collections en une seule
//     $combinedCourses = new Collection();
//     $combinedCourses = $combinedCourses->merge($thisYearMissedCourses);
//     $combinedCourses = $combinedCourses->merge($selectedCoursesNotInExamCalendar);

//     return $combinedCourses;
// }

public static function getCoursesForRecovery($exam_id, $class_id, $activeYear, $student_id)
{
    // Récupérer les cours non validés de l'année actuelle
    $thisYearMissedCourses = ExamCalendarModel::select('exam_calendar.*', 'course.name as course_name', 'course.type as course_type')
        ->join('course', 'course.id', '=', 'exam_calendar.course_id')
        ->join('mark_register', function($join) {
            $join->on('mark_register.course_id', '=', 'exam_calendar.course_id')
                 ->whereRaw('(mark_register.note_devoir + mark_register.note_exam) / 2 < mark_register.passing_mark');
        })
        ->where('exam_calendar.exam_id', '=', $exam_id)
        ->where('exam_calendar.class_id', '=', $class_id)
        ->where('exam_calendar.school_year_id', '=', $activeYear)
        ->get();

    $selectedCoursesNotInClassCourse = SelectedCoursesModel::select('selected_course.*', 'course.name as course_name', 'course.type as course_type', 'exam_calendar.*')
    ->join('exam_calendar', 'selected_course.course_id', '=', 'exam_calendar.course_id')
    ->join('course', 'course.id', '=', 'selected_course.course_id')
    ->where('selected_course.student_id', '=', $student_id)
    ->whereNotIn('selected_course.course_id', function($query) use ($class_id) {
        $query->select('class_course.course_id')
              ->from('class_course')
              ->where('class_course.class_id', '=', $class_id);
    })
    ->groupBy('course_name')
    ->get();



    // Fusionner les collections en une seule
    $combinedCourses = new Collection();
    $combinedCourses = $combinedCourses->merge($thisYearMissedCourses);
    $combinedCourses = $combinedCourses->merge($selectedCoursesNotInClassCourse);

    return $combinedCourses;
}



    static public function getThisYearMissedCourse($exam_id, $class_id, $activeYear)
{
    return ExamCalendarModel::select('exam_calendar.*', 'course.name as course_name', 'course.type as course_type')
        ->join('course', 'course.id', '=', 'exam_calendar.course_id')
        ->join('mark_register', function($join) {
            $join->on('mark_register.course_id', '=', 'exam_calendar.course_id')
                 ->whereRaw('(mark_register.note_devoir + mark_register.note_exam) / 2 < mark_register.passing_mark');
        })
        ->where('exam_calendar.exam_id', '=', $exam_id)
        ->where('exam_calendar.class_id', '=', $class_id)
        ->where('exam_calendar.school_year_id', '=', $activeYear)
        ->get();
}


    static public function getTeacherCourseOnly($exam_id, $class_id,$teacher_id)
    {
        // return ExamCalendarModel::select('exam_calendar.*','course_teacher.*','course.name as course_name','course.type as course_type')
        //     ->join('course_teacher','course_teacher.course_id','=','exam_calendar.course_id')
        //     ->join('course','course.id','=','exam_calendar.course_id')
        //     ->where('exam_calendar.exam_id','=',$exam_id)
        //     ->where('exam_calendar.class_id','=',$class_id)
        //     ->get();

        return ExamCalendarModel::select('exam_calendar.*', 'course.name as course_name', 'course.type as course_type')
        ->join('course', 'course.id', '=', 'exam_calendar.course_id')
        ->join('course_teacher', 'course_teacher.course_id', '=', 'exam_calendar.course_id')
        ->where('exam_calendar.exam_id', '=', $exam_id)
        ->where('exam_calendar.class_id', '=', $class_id)
        ->where('course_teacher.teacher_id', '=', $teacher_id)
        ->get();
    }

    static public function getMark($student_id, $exam_id, $class_id, $course_id)
    {
        return MarkRegisterModel::checkAlreadyMark($student_id, $exam_id, $class_id, $course_id);
    }
    

}
