<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;
use Auth;

class ClassCourseModel extends Model
{
    use HasFactory;
    protected $table = 'class_course';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
    $return = self::select('class_course.*', 'class.name as class_name', 'course.name as course_name', 'users.name as created_by_name')
        ->join('course', 'course.id', '=', 'class_course.course_id')
        ->join('class', 'class.id', '=', 'class_course.class_id')
        ->join('users', 'users.id', '=', 'class_course.created_by')
        ->where('class_course.is_deleted', '=', 0);

    if (!empty(Request::get('class_name'))) {
        $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
    }

    if (!empty(Request::get('course_name'))) {
        $return = $return->where('course.name', 'like', '%' . Request::get('course_name') . '%');
    }

    if (!empty(Request::get('date'))) {
        $return = $return->where('class_course.created_at', '=', Request::get('date'));
    }

    $return = $return->orderBy('class_course.id', 'desc')
        ->paginate(20);

    return $return;
    }


    static public function getMyCourse($class_id)
    {
        return self::select('class_course.*', 'course.name as course_name', 'course.type as course_type')
            ->join('course', 'course.id', '=', 'class_course.course_id')
            ->join('class', 'class.id', '=', 'class_course.class_id')
            ->join('users', 'users.id', '=', 'class_course.created_by')
            ->where('class_course.class_id','=', $class_id)
            ->where('class_course.is_deleted', 0)
            ->where('class_course.status', 0)
            ->orderBy('class_course.id', 'desc')
            ->get();
    }

    

    static public function getAlreadyFirst($class_id, $course_id)
    {
        return self::where('class_id', '=', $class_id)->where('course_id', '=', $course_id)->first();
    }


    static public function getAssignCourseID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_deleted','=', 0)->get();
    }

    static public function deleteCourse($class_id)
    {
        return self::where('class_id','=',$class_id)->delete();
    }

}
