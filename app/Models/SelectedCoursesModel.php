<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedCoursesModel extends Model
{
    use HasFactory;
    protected $table = 'selected_course';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public static function getCreditSum($student_id)
    {
        return self::join('course', 'selected_course.course_id', '=', 'course.id')
            ->where('selected_course.student_id', $student_id)
            ->sum('course.coeff');
    }

    static public function getMyCourses($id){
    return self::select('selected_course.*',
        'users.name as student_name',
        'users.prenom as prenom',
        'users.sexe as sexe',
        'student.matricule as matricule',
        'student.profile_pic as photo',
        'student.date_naissance as date_naissance',
        'student.lieu_naissance as lieu_naissance',
        'student.nationalite as nationalite',
        'course.coeff as credit',
        'course.parcours as parcours',
        'course.name as course_name',
        'course.semestre as semestre',
        'course.code_ue as code_ue',
        'course.ue as ue',
        'course.code_ecue as ecue',
        'domain.name as domain_name',
        'subject.name as subject_name')
        ->join('course', 'selected_course.course_id', '=', 'course.id')
        ->join('domain', 'course.domain_id', '=', 'domain.id')      
        ->join('student', 'selected_course.student_id', '=', 'student.user_id')
        ->join('users', 'users.id', '=', 'student.user_id')
        ->join('subject', 'subject.id', '=', 'student.subject_id')
        ->where('student.user_id', '=', $id)
        ->orderBy('course.code_ue')
        ->get();
}


    static public function getMyCourse($student_id)
{
    return self::select('selected_course.*', 'course.name as course_name', 'course.type as course_type')
        //->join('student', 'student.id', '=', 'selected_course.student_id')
        ->join('course', 'course.id', '=', 'selected_course.course_id')
        ->join('class', 'class.id', '=', 'selected_course.class_id')
        ->where('selected_course.student_id', '=', $student_id)
        ->orderBy('selected_course.id', 'desc')
        ->get();
}


}
