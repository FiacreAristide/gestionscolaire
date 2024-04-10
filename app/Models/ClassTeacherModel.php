<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use App\Models\CourseTeacherModel;


class ClassTeacherModel extends Model
{
    use HasFactory;
    protected $table = 'class_teacher';

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
        $return = self::select('class_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name','teacher.prenom as teacher_prenom', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', '=', 'class_teacher.teacher_id')
            ->join('class', 'class.id', '=', 'class_teacher.class_id')
            ->join('users', 'users.id', '=', 'class_teacher.created_by')
            ->where('class_teacher.is_deleted', '=', 0)
            ->where('class_teacher.school_year_id','=', $activeYear);

            if(!empty(Request::get('class_name')))
            {
               $return = $return->where('class.name', 'like','%'.Request::get('class_name').'%');
            }

            if(!empty(Request::get('name')))
            {
               $return = $return->where('teacher.name', 'like','%'.Request::get('name').'%');
            }

            if(!empty(Request::get('status')))
            {
               $status = (Request::get('status') == 100) ? 0 : 1; 
               $return = $return->where('class_teacher.status', '=', $status);
            }

            if(!empty(Request::get('date')))
            {
                $return = $return->whereDate('class_teacher.created_at', '=',Request::get('date'));
            }


        $return = $return->orderBy('class_teacher.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getProgressYearRecord()
    {
        $return = self::select('class_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name','teacher.prenom as teacher_prenom', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', '=', 'class_teacher.teacher_id')
            ->join('class', 'class.id', '=', 'class_teacher.class_id')
            ->join('users', 'users.id', '=', 'class_teacher.created_by')
            ->where('class_teacher.is_deleted', '=', 0);

            if(!empty(Request::get('class_name')))
            {
               $return = $return->where('class.name', 'like','%'.Request::get('class_name').'%');
            }

            if(!empty(Request::get('name')))
            {
               $return = $return->where('teacher.name', 'like','%'.Request::get('name').'%');
            }

            if(!empty(Request::get('status')))
            {
               $status = (Request::get('status') == 100) ? 0 : 1; 
               $return = $return->where('class_teacher.status', '=', $status);
            }

            if(!empty(Request::get('date')))
            {
                $return = $return->whereDate('class_teacher.created_at', '=',Request::get('date'));
            }


        $return = $return->orderBy('class_teacher.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getAlreadyFirst($class_id, $teacher_id)
    {
        return self::where('class_id', '=', $class_id)->where('teacher_id', '=', $teacher_id)->first();
    }


    static public function getAssignTeacherID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_deleted','=', 0)->get();
    }

    static public function deleteTeacher($class_id)
    {
        return self::where('class_id','=',$class_id)->delete();
    }

    static public function getMyClassCourse($teacher_id)
    {
        return self::select('class_teacher.*', 'class.name as class_name','course.name as course_name','course.type as course_type','class.id as class_id','course.id as course_id')
            ->join('class', 'class.id', '=', 'class_teacher.class_id')
            ->join('class_course', 'class_course.class_id', '=', 'class.id')
            ->join('course', 'course.id', '=', 'class_course.course_id')
            ->where('class_teacher.is_deleted', '=', 0)
            ->where('class_teacher.status', '=', 0)
            ->where('course.status', '=', 0)
            ->where('course.is_deleted', '=', 0)
            ->where('class_course.status', '=', 0)
            ->where('class_course.is_deleted', '=', 0) 
            ->where('class_teacher.teacher_id', '=', $teacher_id)
            ->get();
    }

    static public function getMyTimeTable($class_id,$course_id)
    {
        $getWeek = WeekModel::getWeekUsingName(date('l'));
        return ClassCourseTimetableModel::getRecordClassCourse($class_id, $course_id, $getWeek->id);
    }



    static public function getMyClassCourseGroup($teacher_id)
    {
        return self::select('class_teacher.*', 'class.name as class_name','class.id as class_id')
            ->join('class', 'class.id', '=', 'class_teacher.class_id')
            ->where('class_teacher.is_deleted', '=', 0)
            ->where('class_teacher.status', '=', 0)
            ->where('class_teacher.teacher_id', '=', $teacher_id)
            ->groupBy('class_teacher.class_id')
            ->get();
    }
}
