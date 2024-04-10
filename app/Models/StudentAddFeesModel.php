<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class StudentAddFeesModel extends Model
{
    use HasFactory;
    protected $table ='student_fees';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getFees($student_id,$activeYear)
    {
        return self::select('student_fees.*','class.name as class_name','users.name as creator')
        ->join('class','class.id','=','student_fees.class_id')
        ->join('users','users.id','=','student_fees.created_by')
        ->where('student_fees.student_id','=',$student_id)
        ->where('student_fees.school_year_id','=', $activeYear)
        ->get();
    }

    static public function getPaidAmount($student_id, $class_id)
    {
        return self::where('student_fees.class_id','=',$class_id)
        ->where('student_fees.student_id','=',$student_id)
        ->sum('student_fees.paid_amount');
        
    }

    static function getTotalFeesToday($activeYear)
    {
       return self::where('student_fees.school_year_id','=', $activeYear)->whereDate('student_fees.created_at','=',date('Y-m-d'))->sum('student_fees.paid_amount');
    }

    static function getProgressYearTotalFeesToday()
    {
       return self::whereDate('student_fees.created_at','=',date('Y-m-d'))->sum('student_fees.paid_amount');
    }

    static function getTotalFees($activeYear)
    {
       return self::where('student_fees.school_year_id','=', $activeYear)->sum('student_fees.paid_amount');
    }

    static function getProgressYearTotalFees()
    {
       return self::sum('student_fees.paid_amount');
    }


    static public function getRecord($activeYear)
    {
        $return = self::select('student_fees.*', 'class.name as class_name', 'users.name as student_name', 'student.user_id as student_id', 'users.prenom as prenom','admins.name as admin_name')
            ->join('class', 'class.id', '=', 'student_fees.class_id')
            ->join('student', 'student.user_id', '=', 'student_fees.student_id')
            ->join('users', 'users.id', '=', 'student.user_id')
            ->join('users as admins', 'admins.id', '=', 'student_fees.created_by')
            ->where('users.school_year_id','=', $activeYear);
            if(!empty(Request::get('student_id')))
            {
                $return = $return->where('student_fees.student_id','=',Request::get('student_id'));
            }
            if (!empty(Request::get('student_name')))
            {
                $return = $return->where(function($query) {
                    $query->where('users.name', 'like', '%' . Request::get('student_name') . '%');
                });
            }
            if(!empty(Request::get('class_id')))
            {
                $return = $return->where('student_fees.class_id','=',Request::get('class_id'));
            }
            if(!empty(Request::get('start_date')))
            {
                $return = $return->whereDate('student_fees.created_at', '>=', Request::get('start_date'));
            }
            if(!empty(Request::get('end_date')))
            {
                $return = $return->whereDate('student_fees.created_at', '<=', Request::get('end_date'));
            }
            if(!empty(Request::get('payment_type')))
            {
               $return = $return->where('student_fees.payment_type', '=', Request::get('payment_type')); 
            }
            $return = $return->orderBy('student_fees.id', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getProgressYearRecord()
    {
        $return = self::select('student_fees.*', 'class.name as class_name', 'users.name as student_name', 'student.user_id as student_id', 'users.prenom as prenom','admins.name as admin_name')
            ->join('class', 'class.id', '=', 'student_fees.class_id')
            ->join('student', 'student.user_id', '=', 'student_fees.student_id')
            ->join('users', 'users.id', '=', 'student.user_id')
            ->join('users as admins', 'admins.id', '=', 'student_fees.created_by');

            if(!empty(Request::get('student_id')))
            {
                $return = $return->where('student_fees.student_id','=',Request::get('student_id'));
            }
            if (!empty(Request::get('student_name')))
            {
                $return = $return->where(function($query) {
                    $query->where('users.name', 'like', '%' . Request::get('student_name') . '%');
                });
            }

            if(!empty(Request::get('class_id')))
            {
                $return = $return->where('student_fees.class_id','=',Request::get('class_id'));
            }

            if(!empty(Request::get('start_date')))
            {
                $return = $return->whereDate('student_fees.created_at', '>=', Request::get('start_date'));
            }

            if(!empty(Request::get('end_date')))
            {
                $return = $return->whereDate('student_fees.created_at', '<=', Request::get('end_date'));
            }

            if(!empty(Request::get('payment_type')))
            {
               $return = $return->where('student_fees.payment_type', '=', Request::get('payment_type')); 
            }
            $return = $return->orderBy('student_fees.id', 'desc')
            ->paginate(20);
        return $return;
    }
}
