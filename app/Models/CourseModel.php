<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;
use Auth;

class CourseModel extends Model
{
    use HasFactory;

    protected $table ='course';

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
        $return = CourseModel::select('course.*','subject.name as subject_name','domain.name as domain_name','mention.nom as mention_name', 'users.name as created_by_name')
            ->join('subject', 'subject.id', 'course.subject_id')
            ->join('domain', 'domain.id', 'course.domain_id')
            ->join('mention', 'mention.id', 'course.mention_id')
            ->join('users', 'users.id', 'course.created_by')
            ->where('course.school_year_id','=', $activeYear);
            
            if(!empty(Request::get('code_ue'))){
                $return = $return->where('course.code_ue','like','%'.Request::get('code_ue') .'%');
            }

            if(!empty(Request::get('name'))){
                $return = $return->where('course.name','like','%'.Request::get('name') .'%');
            }

            if(!empty(Request::get('type'))){
                $return = $return->where('course.type','like','%'.Request::get('type') .'%');
            }

            if(!empty(Request::get('date'))){
                $return = $return->where('course.created_at','=',Request::get('date'));
            }

            $return = $return->where('course.is_deleted', '=', 0)
            ->orderBy('course.id', 'desc')
            ->paginate(20);

            return $return; 
    }


    static public function getProgressYearRecord()
    {
        $return = CourseModel::select('course.*','subject.name as subject_name','domain.name as domain_name', 'users.name as created_by_name')
            ->join('subject', 'subject.id', 'course.subject_id')
            ->join('domain', 'domain.id', 'course.domain_id')
            ->join('users', 'users.id', 'course.created_by');
            
            if(!empty(Request::get('code_ue'))){
                $return = $return->where('course.code_ue','like','%'.Request::get('code_ue') .'%');
            }

            if(!empty(Request::get('name'))){
                $return = $return->where('course.name','like','%'.Request::get('name') .'%');
            }

            if(!empty(Request::get('type'))){
                $return = $return->where('course.type','like','%'.Request::get('type') .'%');
            }

            if(!empty(Request::get('date'))){
                $return = $return->where('course.created_at','=',Request::get('date'));
            }

            $return = $return->where('course.is_deleted', '=', 0)
            ->orderBy('course.id', 'desc')
            ->paginate(20);

            return $return; 
    }

    static public function getMyCourseByDomain($domain_id,$subject_id,$school_year)
    {
        return self::select('course.*')
        ->where('course.domain_id', $domain_id)
        ->where('course.subject_id', $subject_id)
        ->where('course.school_year_id', $school_year)
        ->get(); 
    }


    static public function getCourse($activeYear)
    {
        $return = CourseModel::select('course.*')
            ->join('users', 'users.id','course.created_by','left')
            ->where('course.is_deleted', '=', 0)
            ->where('course.status', '=', 0)
            ->where('course.school_year_id','=', $activeYear)
            ->orderBy('course.name', 'asc')
            ->get();
            return $return;
    } 
    
    static public function getProgressYearCourse()
    {
        $return = CourseModel::select('course.*')
            ->join('users', 'users.id','course.created_by','left')
            ->where('course.is_deleted', '=', 0)
            ->where('course.status', '=', 0)
            ->orderBy('course.name', 'asc')
            ->get();
            return $return;
    } 
}
