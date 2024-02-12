<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'name',
       'email',
       'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
       'password',
       'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
       'email_verified_at' => 'datetime',
       'password' => 'hashed',
    ];

   static function getEmailSingle($email){
       return User::where('email', '=', $email)->first();
   }


   static function getTokenSingle($remember_token)
   {
     return User::where('remember_token', '=', $remember_token)->first();
   }


   static public function getAdmin()
   {
      $return = self::select('users.*')
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

     $return = $return->orderBy('id','desc')
     ->paginate(20);
     return $return;
  }


   static public function getStudent()
    {

        // $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name' )
                            //->join('class', 'class.id', '=', 'users.class_id', 'left')
                            //->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
        $return = self::select('users.*','class.name as class_name','subject.name as subject_name','domain.name as domain_name','subject.parcours as parcours')
                            ->join('class', 'class.id','users.class_id', 'left')
                            ->join('subject', 'subject.id','users.specialite', 'left')
                            ->join('domain', 'domain.id','users.domain_id', 'left')
                            //->join('course', 'course.id','users.course_id', 'left')
                            ->where('users.user_type','=',3)
                            ->where('users.is_deleted','=',0);

                            if(!empty(Request::get('name')))
                            {
                               $return = $return->where('users.name', 'like','%'.Request::get('name').'%');
                            }

                            if(!empty(Request::get('prenom')))
                            {
                               $return = $return->where('users.prenom', 'like','%'.Request::get('prenom').'%');
                            }

                            if(!empty(Request::get('date_naissance')))
                            {
                               $return = $return->whereDate('users.date_naissance', '=',Request::get('date_naissance'));
                            }                            

                            if(!empty(Request::get('lieu_naissance')))
                            {
                               $return = $return->where('users.lieu_naissance', 'like','%'.Request::get('lieu_naissance').'%');
                            }


                            if(!empty(Request::get('pays_naissance')))
                            {
                               $return = $return->where('users.pays_naissance', 'like','%'.Request::get('pays_naissance').'%');
                            }


                            if(!empty(Request::get('nationalite')))
                            {
                               $return = $return->where('users.nationalite', 'like','%'.Request::get('nationalite').'%');
                            }


                            if(!empty(Request::get('ethnie')))
                            {
                               $return = $return->where('users.ethnie', 'like','%'.Request::get('ethnie').'%');
                            }                            


                            if(!empty(Request::get('prefecture')))
                            {
                               $return = $return->where('users.prefecture', '=', Request::get('prefecture'));
                            }

                            if(!empty(Request::get('sexe')))
                            {
                               $return = $return->where('users.sexe', 'like','%'.Request::get('sexe').'%');
                            }


                            if(!empty(Request::get('religion')))
                            {
                               $return = $return->where('users.religion', 'like','%'.Request::get('religion').'%');
                            } 


                            if(!empty(Request::get('situation_matrimoniale')))
                            {
                               $return = $return->where('users.situation_matrimoniale', 'like','%'.Request::get('situation_matrimoniale').'%');
                            } 

                            if(!empty(Request::get('adresse')))
                            {
                               $return = $return->where('users.adresse', 'like','%'.Request::get('adresse').'%');
                            } 


                            if(!empty(Request::get('boite_postale')))
                            {
                               $return = $return->where('users.boite_postale', 'like','%'.Request::get('boite_postale').'%');
                            }   

                            if(!empty(Request::get('ville')))
                            {
                               $return = $return->where('users.ville', 'like','%'.Request::get('ville').'%');
                            } 



                            if(!empty(Request::get('pays_residence')))
                            {
                               $return = $return->where('users.pays_residence', 'like','%'.Request::get('pays_residence').'%');
                            } 


                            if(!empty(Request::get('telephone')))
                            {
                               $return = $return->where('users.telephone', 'like','%'.Request::get('telephone').'%');
                            } 

                            if(!empty(Request::get('nom_pere')))
                            {
                               $return = $return->where('users.nom_pere', 'like','%'.Request::get('nom_pere').'%');
                            } 


                            if(!empty(Request::get('prof_pere')))
                            {
                               $return = $return->where('users.prof_pere', 'like','%'.Request::get('prof_pere').'%');
                            } 


                            if(!empty(Request::get('tel_pere')))
                            {
                               $return = $return->where('users.tel_pere', 'like','%'.Request::get('tel_pere').'%');
                            } 

                            if(!empty(Request::get('nom_mere')))
                            {
                               $return = $return->where('users.nom_mere', 'like','%'.Request::get('nom_mere').'%');
                            } 


                            if(!empty(Request::get('prof_mere')))
                            {
                               $return = $return->where('users.prof_mere', 'like','%'.Request::get('prof_mere').'%');
                            } 


                            if(!empty(Request::get('tel_mere')))
                            {
                               $return = $return->where('users.tel_mere', 'like','%'.Request::get('tel_mere').'%');
                            }                             


                            if(!empty(Request::get('boursier')))
                            {
                               $return = $return->where('users.boursier', 'like','%'.Request::get('boursier').'%');
                            } 


                            if(!empty(Request::get('organisme')))
                            {
                               $return = $return->where('users.organisme', 'like','%'.Request::get('organisme').'%');
                            } 

                            if(!empty(Request::get('debut_bourse')))
                            {
                               $return = $return->whereDate('users.debut_bourse', '=',Request::get('debut_bourse'));
                            }

                            if(!empty(Request::get('etatPhys')))
                            {
                               $return = $return->where('users.etatPhys', 'like','%'.Request::get('etatPhys').'%');
                            } 


                            if(!empty(Request::get('person_prev')))
                            {
                               $return = $return->where('users.person_prev', 'like','%'.Request::get('person_prev').'%');
                            } 


                            if(!empty(Request::get('tel_prev')))
                            {
                               $return = $return->where('users.tel_prev', 'like','%'.Request::get('tel_prev').'%');
                            } 


                            if(!empty(Request::get('domaine')))
                            {
                               $return = $return->where('users.domaine', 'like','%'.Request::get('domaine').'%');
                            } 

                            if(!empty(Request::get('specialite')))
                            {
                               $return = $return->where('users.specialite', 'like','%'.Request::get('specialite').'%');
                            } 

                            if(!empty(Request::get('semestre')))
                            {
                               $return = $return->where('users.semestre', 'like','%'.Request::get('semestre').'%');
                            } 

                            if(!empty(Request::get('parcours')))
                            {
                               $return = $return->where('users.parcours', 'like','%'.Request::get('parcours').'%');
                            } 

                            if(!empty(Request::get('specialite')))
                            {
                               $return = $return->where('users.specialite', 'like','%'.Request::get('specialite').'%');
                            } 


                            if(!empty(Request::get('date')))
                            {
                               $return = $return->whereDate('users.created_at', '=',Request::get('date'));
                            }

                            if(!empty(Request::get('email')))
                            {
                               $return = $return->where('users.email', 'like','%'.Request::get('email').'%');
                            }

                            if(!empty(Request::get('status')))
                            {
                               $status = (Request::get('status') == 100 ? 0 : 1);
                               $return = $return->where('users.status', '=',$status);
                            }                            

        $return = $return->orderBy('users.id','desc')
                         ->paginate(20);
        return $return;
    }


static public function getSingle($id)
{
 return self::find($id);
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

static public function getParent()
{
 $return = self::select('users.*')
 ->where('user_type','=',4)
 ->where('is_deleted','=',0);

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
  $return = $return->where('users.sexe','=', Request::get('sexe'));
}

if(!empty(Request::get('occupation')))
{
  $return = $return->where('users.occupation', 'like','%'.Request::get('occupation').'%');
}


if(!empty(Request::get('adresse')))
{
  $return = $return->where('users.adresse', 'like','%'.Request::get('adresse').'%');
} 


if(!empty(Request::get('telephone')))
{
  $return = $return->where('users.telephone', 'like','%'.Request::get('telephone').'%');
}                             

if(!empty(Request::get('date')))
{
  $return = $return->whereDate('users.created_at', '=',Request::get('date'));
}

if(!empty(Request::get('status')))
{
 $status = (Request::get('status') == 100 ? 0 : 1);
 $return = $return->whereDate('users.status', '=',$status);
}                            

$return = $return->orderBy('id','desc')
->paginate(20);
return $return;
}

static public function getSearchStudent()
{
 if(!empty(Request::get('id') || !empty(Request::get('name')) || !empty(Request::get('prenom')) || !empty(Request::get('email'))))
 {
    $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name','parent.prenom as parent_prenom')
    ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
    ->join('class', 'class.id', '=', 'users.class_id', 'left')
    ->where('users.user_type','=',3)
    ->where('users.is_deleted','=',0);

    if(!empty(Request::get('id')))
    {
     $return = $return->where('users.id', '=',Request::get('id'));
  }

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

  $return = $return->orderBy('users.id','desc')
  ->limit(50)
  ->get();
  return $return;
}
}


static public function getMyStudent($parent_id)
{
   $return = self::select('users.*', 'class.name as class_name','subject.name as subject_name','domain.name as domain_name','subject.parcours as parcours', 'parent.name as parent_name','parent.prenom as parent_prenom')
     ->join('users as parent', 'parent.id', '=', 'users.parent_id')
     ->join('class', 'class.id', '=', 'users.class_id', 'left')
     ->join('subject', 'subject.id', '=', 'users.specialite', 'left')
     ->join('domain', 'domain.id','users.domain_id', 'left')
     ->where('users.user_type','=',3)
     ->where('users.parent_id', '=', $parent_id)
     ->where('users.is_deleted','=',0);
     $return = $return->orderBy('users.id','desc')
     ->get();
  return $return;
}


static public function getTeacher()
{
 
      $return = self::select('users.*',)
      ->where('users.user_type','=',2)
      ->where('users.is_deleted','=',0);

      if(!empty(Request::get('name')))
      {
        $return = $return->where('users.name', 'like','%'.Request::get('name').'%');
      }

      if(!empty(Request::get('last_name')))
      {
       $return = $return->where('users.last_name', 'like','%'.Request::get('last_name').'%');
      }

      if(!empty(Request::get('email')))
      {
       $return = $return->where('users.email', 'like','%'.Request::get('email').'%');
      }    

      if(!empty(Request::get('gender')))
      {
       $return = $return->where('users.gender', '=', Request::get('gender'));
      }                            

      if(!empty(Request::get('mobile_number')))
      {
       $return = $return->where('users.mobile_number', 'like','%'.Request::get('mobile_number').'%');
      }    

      if(!empty(Request::get('marital_status')))
      {
       $return = $return->where('users.marital_status', '=', Request::get('marital_status'));
      }

      if(!empty(Request::get('address')))
      {
       $return = $return->where('users.address',  'like','%'.Request::get('address').'%');
      }                            

      if(!empty(Request::get('admission_date')))
      {
       $return = $return->where('users.admission_date', '=',Request::get('admission_date'));
      }                                         
      if(!empty(Request::get('date')))
      {
       $return = $return->whereDate('users.created_at', '=',Request::get('date'));
      }

      if(!empty(Request::get('status')))
      {
        $status = (Request::get('status') == 100 ? 0 : 1);
        $return = $return->whereDate('users.status', '=',$status);
      }                                   

      $return = $return->orderBy('users.id','desc')
      ->limit(50)
      ->paginate(20);
      return $return; 
   }


   static public function getTeacherClass()
{
 
      $return = self::select('users.*',)
              ->where('users.user_type','=',2)
              ->where('users.is_deleted','=',0);

      $return = $return->orderBy('users.id','desc')
              ->get();
      return $return; 
   }



   static public function getTeacherStudent($teacher_id)
   {
      $return = self::select('users.*','class.name as class_name','domain.name as domain_name','subject.name as subject_name')
                            ->join('class', 'class.id','=','users.class_id')
                            ->join('class_teacher', 'class_teacher.class_id','=','class.id')
                            ->join('domain','domain.id','=','users.domain_id')
                            ->join('subject', 'subject.id','users.specialite')
                            ->where('class_teacher.status','=',0)
                            ->where('class_teacher.is_deleted','=',0)
                            ->where('class_teacher.teacher_id','=',$teacher_id)
                            ->where('users.user_type','=',3)
                            ->where('users.is_deleted','=',0);      
        $return = $return->orderBy('users.id','desc')
                         ->groupBy('users.id')
                         ->paginate(20);
        return $return;
   }
}
