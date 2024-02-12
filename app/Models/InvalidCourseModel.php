<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class InvalidCourseModel extends Model
{
    use HasFactory;
    protected $table ='invalid_course';


    static public function getInvalidCourse($id)
    {
        return self::select('invalid_course.*','course.name as course_name', 'course.type as course_type')
                ->join('course', 'course.id', '=', 'invalid_course.course_id')
                ->where('student_id','=', $id)
                ->get();     
    }
}
