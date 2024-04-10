<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class DomainModel extends Model
{
    use HasFactory;

    protected $table ='domain';

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
        $return = DomainModel::select('domain.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'domain.created_by')
            ->where('domain.school_year_id','=', $activeYear);

            if(!empty(Request::get('name'))){
                $return = $return->where('domain.name','like','%'.Request::get('name') .'%');
            }

            if(!empty(Request::get('date'))){
                $return = $return->where('domain.created_at','=',Request::get('date'));
            }

            $return = $return->where('domain.is_deleted', '=', 0)
            ->orderBy('domain.id', 'desc')
            ->paginate(20);

            return $return; 
    }

    static public function getProgressYearRecord()
    {
        $return = DomainModel::select('domain.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'domain.created_by');

            if(!empty(Request::get('name'))){
                $return = $return->where('domain.name','like','%'.Request::get('name') .'%');
            }

            if(!empty(Request::get('date'))){
                $return = $return->where('domain.created_at','=',Request::get('date'));
            }

            $return = $return->where('domain.is_deleted', '=', 0)
            ->orderBy('domain.id', 'desc')
            ->paginate(20);

            return $return; 
    }


    static public function getDomain($activeYear)
    {
        //return self::all()->where('domain.is_deleted', '=', 0)->where('domain.status', '=', 0)->where('domain.school_year_id','=', $activeYear);
        $return = DomainModel::select('domain.*')
            ->join('users', 'users.id','domain.created_by','left')
            ->where('domain.is_deleted', '=', 0)
            ->where('domain.status', '=', 0)
            ->where('domain.school_year_id', '=', $activeYear)
            ->orderBy('domain.name', 'asc')
            ->get();
            return $return;
    }


    static public function getProgressYearDomain()
    {
        return self::all()->where('domain.is_deleted', '=', 0)->where('domain.status', '=', 0);
    }
}

            // ->join('class_subject', 'class_subject.class_id', '=', 'domain.id','left')
            // ->join('subject', 'subject.id', '=', 'class_subject.subject_id','left')