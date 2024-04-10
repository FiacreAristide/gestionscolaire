<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkRegisterModel extends Model
{
    use HasFactory;
    protected $table = 'mark_register';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function checkAlreadyMark($student_id, $exam_id, $class_id, $course_id)
    {
        return MarkRegisterModel::where('student_id','=', $student_id)->where('exam_id','=', $exam_id)->where('class_id','=', $class_id)->where('course_id','=', $course_id)->first();
    }

    static public function getExam($student_id)
    {
        return MarkRegisterModel::select('mark_register.*','exam.name as exam_name')
                ->join('exam','exam.id','=','mark_register.exam_id')
                ->where('mark_register.student_id','=',$student_id)
                ->groupBy('mark_register.exam_id')
                ->get();
    }

    static public function getExamCourse($exam_id, $student_id)
    {
        return MarkRegisterModel::select('mark_register.*','exam.name as exam_name','course.name as course_name','course.ue as ue','course.code_ue as code_ue','course.coeff as credit','course.code_ecue as ecue','course.semestre as course_semester')
                ->join('exam','exam.id','=','mark_register.exam_id')
                ->join('course','course.id','=','mark_register.course_id')
                ->join('exam_calendar','exam_calendar.exam_id','=','mark_register.exam_id')
                ->join('exam_calendar as exam_class','exam_class.class_id','=','mark_register.class_id')
                ->join('exam_calendar as exam_course','exam_calendar.course_id','=','mark_register.course_id')
                ->where('mark_register.exam_id','=',$exam_id)
                ->where('mark_register.student_id','=',$student_id)
                ->distinct()
                ->groupBy('course.code_ue')
                ->get();
    }

    static public function getClass($exam_id,$student_id)
    {
        return MarkRegisterModel::select('class.name as class_name')
        ->join('exam','exam.id','=','mark_register.exam_id')
        ->join('class','class.id','=','mark_register.class_id')
        ->join('course','course.id','=','mark_register.course_id')
        ->where('mark_register.exam_id','=',$exam_id)
        ->where('mark_register.student_id','=',$student_id)
        ->first();
    }

   
}
