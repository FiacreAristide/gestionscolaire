<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class AdministratorModel extends Model
{
    use HasFactory;

    protected $table ='administrator';

   public function user() {
      return $this->belongsTo(User::class);
   }

   public function schoolYear()
   {
      return $this->belongsTo(SchoolYear::class, 'school_year_id');
   }

   static public function getSingle($id)
   {
      return self::find($id);
   }

   static public function getAdmin($activeYear)
   {
      $return = self::select('users.*','administrator.*')
      ->join('users', 'administrator.user_id', '=', 'users.id')
      ->where('user_type','=',1)
      ->where('is_deleted','=',0)
      ->where('users.school_year_id','=',$activeYear);
      
      if(!empty(Request::get('name')))
      {
        $return = $return->where('name', 'like','%'.Request::get('name').'%');
     } 
     if(!empty(Request::get('email')))
     {
        $return = $return->where('email', 'like','%'.Request::get('email').'%');
     }

     if(!empty(Request::get('date')))
     {
        $return = $return->whereDate('created_at', '=',(Request::get('date')));
     }

     $return = $return->orderBy('users.id','desc')
     ->paginate(20);
     return $return;
  }

  static public function getProgressYearAdmin()
   {
      $return = self::select('users.*','administrator.*')
      ->join('users', 'administrator.user_id', '=', 'users.id')
      ->where('user_type','=',1)
      ->where('is_deleted','=',0);
      
      if(!empty(Request::get('name')))
      {
        $return = $return->where('name', 'like','%'.Request::get('name').'%');
     } 
     if(!empty(Request::get('email')))
     {
        $return = $return->where('email', 'like','%'.Request::get('email').'%');
     }

     if(!empty(Request::get('date')))
     {
        $return = $return->whereDate('created_at', '=',(Request::get('date')));
     }

     $return = $return->orderBy('users.id','desc')
     ->paginate(20);
     return $return;
  }

  static function getTokenSingle($remember_token)
   {
     return AdministratorModel::where('remember_token', '=', $remember_token)->first();
   }

   
}
