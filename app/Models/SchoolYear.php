<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    protected $table = 'school_year';

    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }

    public function courses()
    {
        return $this->hasMany(CourseModel::class);
    }

    public function mentions()
    {
        return $this->hasMany(MentionModel::class);
    }

    public function subjects()
    {
        return $this->hasMany(SubjectModel::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }   


    static public function getSingle($id)
    {
      return self::find($id);
    }


    public static function getActiveYear()
    {
        return self::where('status', 0)->first();
    }

    public static function getActiveProgressYear($activeYear)
    {
        return self::select('school_year.inProgress')->where('school_year.id','=', $activeYear)->get();
    }


    static public function getYearStatus()
    {
        return SchoolYear::select('school_year.*','users.name as created_by_name')
        ->join('users', 'users.id', 'school_year.created_by')
        ->orderBy('school_year.id','desc')
        ->get();
    }

    static public function getAllYears()
    {
        return self::all();    
    }

    
}
