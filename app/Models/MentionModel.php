<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentionModel extends Model
{
    use HasFactory;
    protected $table = 'mention';

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    static public function getSingle($id)
    {
      return self::find($id);
    }

    static public function getSavedMentions($activeYear)
    {
        return self::select('mention.*','domain.name as domain_name', 'users.name as created_by_name')
            ->join('domain', 'domain.id', 'mention.domain_id')
            ->join('users', 'users.id', 'mention.created_by')
            ->where('mention.is_deleted', '=', 0)
            ->where('mention.school_year_id','=', $activeYear)
            ->orderBy('mention.id', 'desc')
            ->get();
    }

    static public function getProgressYearSavedMentions()
    {
        return self::select('mention.*','domain.name as domain_name', 'users.name as created_by_name')
            ->join('domain', 'domain.id', 'mention.domain_id')
            ->join('users', 'users.id', 'mention.created_by')
            ->where('mention.is_deleted', '=', 0)
            ->orderBy('mention.id', 'desc')
            ->get();
    }

    static public function getMentions($activeYear)
    {
        //return self::all()->where('mention.school_year_id','=', $activeYear); 
        return self::select('mention.*','domain.name as domain_name', 'users.name as created_by_name')
            ->join('domain', 'domain.id', 'mention.domain_id')
            ->join('users', 'users.id', 'mention.created_by')
            ->where('mention.is_deleted', '=', 0)
            ->where('mention.school_year_id','=', $activeYear)
            ->orderBy('mention.id', 'desc')
            ->get();   
    }


    static public function getProgressYearMentions()
    {
        return self::all();    
    }
}
