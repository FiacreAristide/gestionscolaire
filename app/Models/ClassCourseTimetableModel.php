<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SelectedCoursesModel;

class ClassCourseTimetableModel extends Model
{
    use HasFactory;

    protected $table ='class_course_timetable';

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    static public function getRecordClassCourse($class_id,$course_id,$week_id)
    {
        return self::where('class_id','=',$class_id)
        ->where('course_id','=',$course_id)
        ->where('week_id','=',$week_id)->first();
        
    }
}
