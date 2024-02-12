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

    static public function getSingle($id)
    {
        return self::find($id);
    }

   static public function getRecord()
    {
        $return = CourseModel::select('course.*', 'users.name as created_by_name')
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


    static public function getOthersCourses($class_id)
    {
        $user_class_id = Auth::user()->class_id;

        $result = DB::table('course as c')
        ->leftJoin('class_course as cc', function ($join) use ($user_class_id) {
        $join->on('c.id', '=', 'cc.course_id')
             ->where('cc.class_id', '=', $user_class_id);
        })
        ->select('c.*')
        ->whereNull('cc.course_id')
        ->get();
        return $result;
    }


    static public function getCourse()
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
