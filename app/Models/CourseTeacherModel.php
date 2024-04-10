<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class CourseTeacherModel extends Model
{
    use HasFactory;
    protected $table = 'course_teacher';

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord($activeYear)
    {
        $return = self::select('course_teacher.*', 'course.name as course_name', 'teacher.name as teacher_name','teacher.prenom as teacher_prenom', 'users.name as created_by_name','class.name as class_name')
            ->join('users as teacher', 'teacher.id', '=', 'course_teacher.teacher_id')
            ->join('course', 'course.id', '=', 'course_teacher.course_id')
            ->join('class','class.id','=', 'course_teacher.class_id')
            ->join('users', 'users.id', '=', 'course_teacher.created_by')
            ->where('course_teacher.is_deleted', '=', 0)
            ->where('course_teacher.school_year_id','=', $activeYear);

            if(!empty(Request::get('course_name')))
            {
               $return = $return->where('course.name', 'like','%'.Request::get('course_name').'%');
            }

            if(!empty(Request::get('name')))
            {
               $return = $return->where('teacher.name', 'like','%'.Request::get('name').'%');
            }

            if(!empty(Request::get('status')))
            {
               $status = (Request::get('status') == 100) ? 0 : 1; 
               $return = $return->where('course_teacher.status', '=', $status);
            }

            if(!empty(Request::get('date')))
            {
                $return = $return->whereDate('course_teacher.created_at', '=',Request::get('date'));
            }

        $return = $return->orderBy('course_teacher.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getMyTimeTable($class_id,$course_id)
    {
        $getWeek = WeekModel::getWeekUsingName(date('l'));
        return ClassCourseTimetableModel::getRecordClassCourse($class_id, $course_id, $getWeek->id);
    }    

    static public function getCoursesForTeacher($teacher_id)
    {
    return self::select('course_teacher.*', 'course.id as course_id', 'course.name as course_name','class.name as class_name')
        ->join('course', 'course_teacher.course_id', '=', 'course.id')
        ->join('class', 'course_teacher.class_id', '=', 'class.id')
        ->where('course_teacher.teacher_id', '=', $teacher_id)
        ->where('course_teacher.is_deleted', '=', 0)
        ->where('course_teacher.status', '=', 0)
        ->where('course.is_deleted', '=', 0)
        ->where('course.status', '=', 0)
        ->orderBy('course_teacher.id', 'desc')
        ->get();
    }


    static public function getMyClassCourse($teacher_id)
    {
        return self::select('course_teacher.*', 'class.id as class_id', 'class.name as class_name', 'course.id as course_id', 'course.name as course_name')
            ->join('course', 'course_teacher.course_id', '=', 'course.id')
            ->join('class_course', 'course.id', '=', 'class_course.course_id')
            ->join('class', 'class_course.class_id', '=', 'class.id')
            ->where('course_teacher.is_deleted', '=', 0)
            ->where('course_teacher.status', '=', 0)
            ->where('course.status', '=', 0)
            ->where('course.is_deleted', '=', 0)
            ->where('class_course.status', '=', 0)
            ->where('class_course.is_deleted', '=', 0)
            ->where('course_teacher.teacher_id', '=', $teacher_id)
            ->get();

    }

    static public function getAlreadyFirst($teacher_id, $course_id)
    {
        return self::where('teacher_id', '=', $teacher_id)->where('course_id', '=', $course_id)->first();
    }


    static public function getAssignTeacherID($course_id)
    {
        return self::where('course_id', '=', $course_id)->where('is_deleted','=', 0)->get();
    }

    static public function deleteTeacher($course_id)
    {
        return self::where('course_id','=',$course_id)->delete();
    }  


    static public function getMyClassCourseGroup($teacher_id)
    {
        return self::select(
            'course_teacher.*',
            'class.id as class_id',
            'class.name as class_name'
            )
            ->join('course', 'course_teacher.course_id', '=', 'course.id')
            ->join('class_course', 'course.id', '=', 'class_course.course_id')
            ->join('class', 'class_course.class_id', '=', 'class.id')
            ->where('course_teacher.is_deleted', '=', 0)
            ->where('course_teacher.status', '=', 0)
            ->where('class_course.status', '=', 0)
            ->where('class_course.is_deleted', '=', 0)
            ->where('course_teacher.teacher_id', '=', $teacher_id)
            ->groupBy('class.id')
            ->get();
    }
    
}


