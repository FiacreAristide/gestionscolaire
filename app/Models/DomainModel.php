<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class DomainModel extends Model
{
    use HasFactory;

    protected $table ='domain';

    static public function getSingle($id)
    {
        return self::find($id);
    }

   static public function getRecord()
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


    static public function getDomain()
    {
        $return = DomainModel::select('domain.*')
            ->join('users', 'users.id','domain.created_by','left')
            ->where('domain.is_deleted', '=', 0)
            ->where('domain.status', '=', 0)
            ->orderBy('domain.name', 'asc')
            ->get();

            return $return;
    }
}

            // ->join('class_subject', 'class_subject.class_id', '=', 'domain.id','left')
            // ->join('subject', 'subject.id', '=', 'class_subject.subject_id','left')