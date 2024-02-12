<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCalendarModel extends Model
{
    use HasFactory;
    protected $table ='exam_calendar';

    static public function getRecordSingle($exam_id, $class_id, $course_id)
    {
        return ExamCalendarModel::where('exam_id','=',$exam_id)->where('class_id','=',$class_id)->where('course_id','=',$course_id)->first();
    }

    static public function deleteRecord($exam_id,$class_id)
    {
        ExamCalendarModel::where('exam_id','=',$exam_id)->where('class_id','=',$class_id)->delete();
    }

    static public function getExam($class_id)
    {
       return ExamCalendarModel::select('exam_calendar.*','exam.name as exam_name')
            ->join('exam','exam.id','=','exam_calendar.exam_id')
            ->where('exam_calendar.class_id','=',$class_id)
            ->groupBy('exam_calendar.exam_id')
            ->orderBy('exam_calendar.id','desc')
            ->get();
    }
    static public function getExamTimetable($exam_id, $class_id)
    {
        return ExamCalendarModel::select('exam_calendar.*','course.name as course_name','course.type as course_type')
            ->join('course','course.id','=','exam_calendar.course_id')
            ->where('exam_calendar.exam_id','=',$exam_id)
            ->where('exam_calendar.class_id','=',$class_id)
            ->get();
    }

}
