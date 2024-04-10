<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class SubjectModel extends Model
{
    use HasFactory;


    protected $table ='subject';

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
        $return = SubjectModel::select('subject.*', 'users.name as created_by_name', 'domain.name as domain_name')
            ->join('users', 'users.id', 'subject.created_by')
            ->join('domain','domain.id', 'subject.domain_id')
            ->where('subject.school_year_id','=', $activeYear);

            if(!empty(Request::get('name'))){
                $return = $return->where('subject.name','like','%'.Request::get('name') .'%');
            }

            if(!empty(Request::get('type'))){
                $return = $return->where('subject.type','=',Request::get('type'));
            }

            if(!empty(Request::get('date'))){
                $return = $return->where('subject.created_at','=',Request::get('date'));
            }

            $return = $return->where('subject.is_deleted', '=', 0)
            ->orderBy('subject.id', 'desc')
            ->paginate(20);

            return $return; 
    }

    static public function getProgressYearRecord()
    {
        $return = SubjectModel::select('subject.*', 'users.name as created_by_name', 'domain.name as domain_name')
            ->join('users', 'users.id', 'subject.created_by')
            ->join('domain','domain.id', 'subject.domain_id');

            if(!empty(Request::get('name'))){
                $return = $return->where('subject.name','like','%'.Request::get('name') .'%');
            }

            if(!empty(Request::get('type'))){
                $return = $return->where('subject.type','=',Request::get('type'));
            }

            if(!empty(Request::get('date'))){
                $return = $return->where('subject.created_at','=',Request::get('date'));
            }

            $return = $return->where('subject.is_deleted', '=', 0)
            ->orderBy('subject.id', 'desc')
            ->paginate(20);

            return $return; 
    }

    static public function getSubject($activeYear)
    {
        //return self::all()->where('subject.is_deleted', '=', 0)->where('subject.status', '=', 0)->where('subject.school_year_id', '=', $activeYear);
        $return = self::select('subject.*')
                ->join('users', 'users.id','subject.created_by','left')
                ->where('subject.is_deleted', '=', 0)
                ->where('subject.status', '=', 0)
                ->where('subject.school_year_id', '=', $activeYear)
                ->orderBy('subject.name', 'asc')
                ->get();
                return $return;
    }

    static public function getProgressYearSubject()
    {
        return self::all()->where('subject.is_deleted', '=', 0)->where('subject.status', '=', 0);
    }
}

