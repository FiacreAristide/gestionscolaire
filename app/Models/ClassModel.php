<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table ='class';

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
        $return = ClassModel::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.school_year_id','=', $activeYear);
            if(!empty(Request::get('name'))){
                $return = $return->where('class.name','like','%'.Request::get('name') .'%');
            }
            if(!empty(Request::get('date'))){
                $return = $return->where('class.created_at','=',Request::get('date'));
            }
            $return = $return->where('class.is_deleted', '=', 0)
            ->orderBy('class.id', 'desc')
            ->paginate(20);
            return $return; 
    }

    static public function getProgressYearRecord()
    {
        $return = ClassModel::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'class.created_by');
            if(!empty(Request::get('name'))){
                $return = $return->where('class.name','like','%'.Request::get('name') .'%');
            }
            if(!empty(Request::get('date'))){
                $return = $return->where('class.created_at','=',Request::get('date'));
            }
            $return = $return->where('class.is_deleted', '=', 0)
            ->orderBy('class.id', 'desc')
            ->paginate(20);
            return $return; 
    }

    static public function getClass($activeYear)
    {
        $return = ClassModel::select('class.*')
            ->where('class.is_deleted', '=', 0)
            ->where('class.status', '=', 0)
            ->where('class.school_year_id','=', $activeYear)
            ->orderBy('class.name', 'asc')
            ->get();
            return $return;
    }

   

    static public function getProgressYearClass()
    {
        $return = ClassModel::select('class.*')
            ->where('class.is_deleted', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')
            ->get();
            return $return;
    }


    // static public function getClass()
    // {
    //     $return = ClassModel::select('class.*')
    //         ->join('student', 'student.class_id', 'class.id')
    //         ->where('class.is_deleted', '=', 0)
    //         ->where('class.status', '=', 0)
    //         ->orderBy('class.name', 'asc')
    //         ->distinct()
    //         ->get();
    //         return $return;
    // }

    static function getTotalClass($activeYear)
    {
          return ClassModel::select('class.id')
            ->where('class.is_deleted', '=', 0)
            ->where('class.status', '=', 0)
            ->where('class.school_year_id','=', $activeYear)
            ->count(); 
    }

    static function getProgressYearTotalClass()
    {
          return ClassModel::select('class.id')
            ->where('class.is_deleted', '=', 0)
            ->where('class.status', '=', 0)
            ->count(); 
    }

}
