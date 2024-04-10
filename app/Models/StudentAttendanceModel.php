<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class StudentAttendanceModel extends Model
{
    use HasFactory;
    protected $table ='student_attendance';

    static public function checkAlreadyAttendance($student_id, $class_id, $attendance_date,$activeYear)
    {
        return self::where('student_id','=',$student_id)->where('class_id','=',$class_id)->where('attendance_date','=', $attendance_date)->where('school_year_id','=', $activeYear)->first();
    }


    static public function getRecord($activeYear)
    {
        $return = StudentAttendanceModel::select('student_attendance.*','class.name as class_name','student.name as student_name','student.prenom as student_prenom','createdBy.name as creator')
                ->join('class','class.id','=','student_attendance.class_id')
                ->join('users as student','student.id','=','student_attendance.student_id')
                ->join('users as createdBy','createdBy.id','=','student_attendance.created_by')
                ->where('student.school_year_id','=', $activeYear)
                ->where('class.school_year_id','=', $activeYear);

                if(!empty(Request::get('student_id')))
                {
                    $return = $return->where('student_attendance.student_id','=', Request::get('student_id'));
                }

                if(!empty(Request::get('student_name')))
                {
                    
                    $return = $return->where('student.name','like','%'.Request::get('student_name').'%');
                }

                if(!empty(Request::get('class_id')))
                {
                    $return = $return->where('student_attendance.class_id','=', Request::get('class_id'));
                }

                if(!empty(Request::get('attendance_date')))
                {
                    $return = $return->whereDate('student_attendance.attendance_date','=', Request::get('attendance_date'));
                }

                if(!empty(Request::get('attendance_type')))
                {
                    $return = $return->where('student_attendance.attendance_type','=', Request::get('attendance_type'));
                }


            $return = $return->orderBy('student_attendance.id','desc')
                ->paginate(50);

            return $return;
    }

    static public function getProgressYearRecord()
    {
        $return = StudentAttendanceModel::select('student_attendance.*','class.name as class_name','student.name as student_name','student.prenom as student_prenom','createdBy.name as creator')
                ->join('class','class.id','=','student_attendance.class_id')
                ->join('users as student','student.id','=','student_attendance.student_id')
                ->join('users as createdBy','createdBy.id','=','student_attendance.created_by');

                if(!empty(Request::get('student_id')))
                {
                    $return = $return->where('student_attendance.student_id','=', Request::get('student_id'));
                }

                if(!empty(Request::get('student_name')))
                {
                    
                    $return = $return->where('student.name','like','%'.Request::get('student_name').'%');
                }

                if(!empty(Request::get('class_id')))
                {
                    $return = $return->where('student_attendance.class_id','=', Request::get('class_id'));
                }

                if(!empty(Request::get('attendance_date')))
                {
                    $return = $return->whereDate('student_attendance.attendance_date','=', Request::get('attendance_date'));
                }

                if(!empty(Request::get('attendance_type')))
                {
                    $return = $return->where('student_attendance.attendance_type','=', Request::get('attendance_type'));
                }


            $return = $return->orderBy('student_attendance.id','desc')
                ->paginate(50);
            return $return;
    }

    static public function getRecordTeacher($class_id)
    {
        if(!empty($class_id))
        {
            $return = StudentAttendanceModel::select('student_attendance.*', 'class.name as class_name', 'users.name as student_name', 'users.prenom as student_prenom', 'createdBy.name as creator')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->join('student', 'student.user_id', '=', 'student_attendance.student_id')
            ->join('users', 'users.id', '=', 'student.user_id') // Ajout de la jointure avec la table users pour récupérer les colonnes name et prenom
            ->join('users as createdBy', 'createdBy.id', '=', 'student_attendance.created_by')
            ->whereIn('student_attendance.class_id', $class_id);

                if(!empty(Request::get('student_id')))
                {
                    $return = $return->where('student_attendance.student_id','=', Request::get('student_id'));
                }

                if(!empty(Request::get('student_name')))
                {
                    
                    $return = $return->where('users.name','like','%'.Request::get('student_name').'%');
                }

                if(!empty(Request::get('class_id')))
                {
                    $return = $return->where('student_attendance.class_id','=', Request::get('class_id'));
                }

                if(!empty(Request::get('attendance_date')))
                {
                    $return = $return->whereDate('student_attendance.attendance_date','=', Request::get('attendance_date'));
                }

                if(!empty(Request::get('attendance_type')))
                {
                    $return = $return->where('student_attendance.attendance_type','=', Request::get('attendance_type'));
                }


            $return = $return->orderBy('student_attendance.id','desc')
                ->paginate(50);

            return $return;
        }
        else
        {
            return "";
        }
        
    }

    static public function getClassStudent($student_id)
    {
        return StudentAttendanceModel::select('student_attendance.*', 'class.name as class_name')
        ->join('class','class.id','=','student_attendance.class_id')
        ->where('student_attendance.student_id', '=', $student_id)
        ->groupBy('student_attendance.class_id')
        ->get();
    }

    static public function getRecordStudent($student_id)
    {
        $return = StudentAttendanceModel::select('student_attendance.*', 'class.name as class_name')
            ->join('class','class.id','=','student_attendance.class_id')
            ->where('student_attendance.student_id', '=', $student_id);

        if(!empty(Request::get('class_id')))
        {
            $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));
        }

        if(!empty(Request::get('attendance_type')))
        {
            $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
        }

        if(!empty(Request::get('attendance_date')))
        {
            $return = $return->where('student_attendance.attendance_date', '=', Request::get('attendance_date'));
        }

    $return = $return->orderBy('student_attendance.id', 'desc')
             ->paginate(50);

    return $return;

    }

    
}
