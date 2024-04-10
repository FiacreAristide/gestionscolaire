<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class TeacherModel extends Model
{
    use HasFactory;

    protected $table ='teacher';

    public function user() {
        return $this->belongsTo(User::class);
    }

    static public function getSingle($id)
   {
      //return self::find($id);
      return self::select('teacher.*')
            ->where('teacher.user_id','=',$id);
   }

   static public function getAllTeacher()
   {
      return self::select('users.*','teacher.*')
      ->join('users', 'teacher.user_id', '=', 'users.id')
      ->get();
   }



   static function getTokenSingle($remember_token)
   {
     return TeacherModel::where('remember_token', '=', $remember_token)->first();
   }

   static public function getTeacher($activeYear)
   { 
      $return = self::select('users.*','teacher.*')
      ->join('users', 'teacher.user_id', '=', 'users.id')
      ->where('users.user_type','=',2)
      ->where('users.is_deleted','=',0)
      ->where('users.school_year_id','=',$activeYear);

      if(!empty(Request::get('name')))
      {
        $return = $return->where('users.name', 'like','%'.Request::get('name').'%');
      }

      if(!empty(Request::get('prenom')))
      {
       $return = $return->where('users.prenom', 'like','%'.Request::get('prenom').'%');
      }

      if(!empty(Request::get('email')))
      {
       $return = $return->where('users.email', 'like','%'.Request::get('email').'%');
      }    

      if(!empty(Request::get('sexe')))
      {
       $return = $return->where('users.sexe', '=', Request::get('sexe'));
      }                              

      if(!empty(Request::get('status')))
      {
        $status = (Request::get('status') == 100 ? 0 : 1);
        $return = $return->where('teacher.status', '=',$status);
      }                                   

      $return = $return->orderBy('users.id','desc')
      ->limit(50)
      ->paginate(20);
      return $return; 
   }

   static public function getProgressYearTeacher()
   { 
      $return = self::select('users.*','teacher.*')
      ->join('users', 'teacher.user_id', '=', 'users.id')
      ->where('users.user_type','=',2)
      ->where('users.is_deleted','=',0);

      if(!empty(Request::get('name')))
      {
        $return = $return->where('users.name', 'like','%'.Request::get('name').'%');
      }

      if(!empty(Request::get('prenom')))
      {
       $return = $return->where('users.prenom', 'like','%'.Request::get('prenom').'%');
      }

      if(!empty(Request::get('email')))
      {
       $return = $return->where('users.email', 'like','%'.Request::get('email').'%');
      }    

      if(!empty(Request::get('sexe')))
      {
       $return = $return->where('users.sexe', '=', Request::get('sexe'));
      }                              

      if(!empty(Request::get('status')))
      {
        $status = (Request::get('status') == 100 ? 0 : 1);
        $return = $return->where('teacher.status', '=',$status);
      }                                   

      $return = $return->orderBy('users.id','desc')
      ->limit(50)
      ->paginate(20);
      return $return; 
   }
   
    public function getProfile()
   {
      if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
      {
         return url('upload/profile/'.$this->profile_pic);
      }
      else
      {
         return "";
      }
   }

}
