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
    $return = self::select('class_course.*', 'class.name as class_name', 'course.name as course_name', 'users.name as created_by_name')
        ->join('course', 'course.id', '=', 'class_course.course_id')
        ->join('class', 'class.id', '=', 'class_course.class_id')
        ->join('users', 'users.id', '=', 'class_course.created_by')
        ->where('class_course.is_deleted', '=', 0)
        ->where('class_course.school_year_id','=', $activeYear);;

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

    static public function getProgressYearRecord()
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

//     static public function getMyCourseByDomain($domain_id, $subject_id)
// {
//     return self::select(
//             'class_course.*',
//             'course.name as course_name',
//             'course.code_ue as code_ue',
//             'course.ue as ue',
//             'course.code_ecue as ecue',
//             'course.coeff as coeff',
//             'course.type as course_type'
//         )
//         ->join('course', 'course.id', '=', 'class_course.course_id')
//         ->join('class', 'class.id', '=', 'class_course.class_id')
//         ->join('subject', 'subject.id', '=', 'course.subject_id')
//         ->join('student', 'student.class_id', '=', 'class.id')
//         ->where('class_course.is_deleted', 0)
//         ->where('class_course.status', 0)
//         ->where('course.domain_id', '=', $domain_id)
//         ->where('subject.id', '=', $subject_id)
//         //->where('subject.parcours', '=', $parcours)
//         ->distinct()
//         ->orderBy('class_course.id','desc')
//         ->get();
// }



    // static public function getMyCourseByDomain($domain_id,$subject_id)
    // {

    //   return self::select('class_course.*', 'course.name as course_name', 'course.code_ue as code_ue', 'course.ue as ue', 'course.code_ecue as ecue', 'course.coeff as coeff', 'course.type as course_type')
    //     ->join('course', 'course.id', '=', 'class_course.course_id')
    //     ->join('class', 'class.id', '=', 'class_course.class_id')
    //     ->join('subject', 'subject.id', '=', 'course.subject_id')
    //     ->where('class_course.is_deleted', 0)
    //     ->where('class_course.status', 0)
    //     ->where('course.domain_id', '=', $domain_id)
    //     ->where('subject.id','=',$subject_id)
    //     ->where('subject.parcours','=',$parcours)
    //     ->distinct()
    //     ->orderBy('class_course.id', 'desc')
    //     ->get();
    // // return self::select('class_course.*', 'course.name as course_name','course.code_ue as code_ue','course.ue as ue','course.code_ecue as ecue','course.coeff as coeff', 'course.type as course_type')
    // //     ->join('course', 'course.id', '=', 'class_course.course_id')
    // //     ->join('class', 'class.id', '=', 'class_course.class_id')
    // //     ->join('users', 'users.id', '=', 'class_course.created_by')
    // //     ->join('subject', 'subject.id', '=', 'course.subject_id') // Ajout de la jointure avec la table subject
    // //     ->where('class_course.class_id', '=', $class_id)
    // //     ->where('class_course.is_deleted', 0)
    // //     ->where('class_course.status', 0)
    // //     ->where('course.domain_id', '=', $domain_id) // Ajout de la condition pour filtrer par domaine
    // //     ->orderBy('class_course.id', 'desc')
    // //     ->get();
    // }



    static public function getMyCourse($class_id,$activeYear)
    {
        return self::select('class_course.*', 'course.name as course_name', 'course.type as course_type')
            ->join('course', 'course.id', '=', 'class_course.course_id')
            ->join('class', 'class.id', '=', 'class_course.class_id')
            ->join('users', 'users.id', '=', 'class_course.created_by')
            ->where('class_course.class_id','=', $class_id)
            ->where('class_course.is_deleted', 0)
            ->where('class_course.status', 0)
            ->where('class_course.school_year_id','=', $activeYear)
            ->orderBy('class_course.id', 'desc')
            ->get();
    }

    static public function getMyCourseTimeTable($class_id)
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

static public function getProgressYearMyCourse($class_id)
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
