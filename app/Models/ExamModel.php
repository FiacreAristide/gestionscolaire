<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;


class ExamModel extends Model
{
    use HasFactory;

    protected $table ='exam';

    static public function getSingle($id)
    {
        return self::find($id);
    }    

    static public function getRecord($activeYear)
    {
        $return = self::select('exam.*','users.name as creator_name')
                    ->join('users','users.id','=','exam.created_by')
                    ->where('exam.school_year_id','=',$activeYear);

                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('exam.name','like','%'.Request::get('name').'%');
                    }


                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('exam.created_at','=',Request::get('name'));
                    }


                   $return = $return->where('exam.is_deleted','=', 0)
                    ->orderBy('exam.id','desc')
                    ->paginate(50);
        return $return;
    }

    static public function getProgressYearRecord()
    {
        $return = self::select('exam.*','users.name as creator_name')
                    ->join('users','users.id','=','exam.created_by');

                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('exam.name','like','%'.Request::get('name').'%');
                    }


                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('exam.created_at','=',Request::get('name'));
                    }


                   $return = $return->where('exam.is_deleted','=', 0)
                    ->orderBy('exam.id','desc')
                    ->paginate(50);
        return $return;
    }

    static public function getExam($activeYear)
    {
        $return = self::select('exam.*')
                    ->join('users','users.id','=','exam.created_by')
                    ->where('exam.is_deleted','=', 0)
                    ->where('exam.school_year_id','=', $activeYear)
                    ->orderBy('exam.name','asc')
                    ->get();
        return $return;
    }

    static public function getProgressYearExam()
    {
        $return = self::select('exam.*')
                    ->join('users','users.id','=','exam.created_by')
                    ->where('exam.is_deleted','=', 0)
                    ->orderBy('exam.name','asc')
                    ->get();
        return $return;
    }

    static public function getTotalExam($activeYear)
    {
        return self::select('exam.id')
                    ->join('users','users.id','=','exam.created_by')
                    ->where('exam.is_deleted','=', 0)
                    ->where('exam.school_year_id','=', $activeYear)
                    ->count();
    }

    static public function getProgressYearTotalExam()
    {
        return self::select('exam.id')
                    ->join('users','users.id','=','exam.created_by')
                    ->where('exam.is_deleted','=', 0)
                    ->count();
    }

}
