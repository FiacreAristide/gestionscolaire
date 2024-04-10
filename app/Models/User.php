<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Profiler\Profile;

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


   public function schoolYear()
   {
      return $this->belongsTo(SchoolYear::class);
   }

   public function teacher() {
      return $this->hasOne(TeacherModel::class);
    }

   public function student() {
      return $this->hasOne(StudentModel::class);
   }

   public function administrator() {
      return $this->hasOne(AdministratorModel::class);
   }

   public function parent() {
      return $this->hasOne(ParentModel::class);
   }

   static function getEmailSingle($email){
      return User::where('email', '=', $email)->first();
   }

   static public function getSingle($id)
   {
      return self::find($id);
   }

   static public function getSingleTeacher($id)
  {
      return self::select('users.*', 'teacher.*')
        ->join('teacher','teacher.user_id', '=', 'users.id')
        ->where('users.id', '=', $id)
        ->first();
  }

   static public function getSingleStudent($id)
  {
    return self::select('users.*', 'student.*')
        ->join('student','student.user_id', '=', 'users.id')
        ->where('users.id', '=', $id)
        ->first();
  }

// public static function generateMatricule()
//     {
//         $currentYear = date('Y')-1; 
//         $nextYear = $currentYear + 1; 
//         $yearConcatenation = substr($currentYear, -2) . substr($nextYear, -2);

//         $lastMatricule = User::max('matricule'); 

//         if ($lastMatricule) {
//             $matriculeNumber = intval(substr($lastMatricule, 6)) + 1; 
//         } else {
//             $matriculeNumber = 1;
//         }

//         $matriculeNumber = ($matriculeNumber > 999999) ? 1 : $matriculeNumber;

//         $matricule = $yearConcatenation . sprintf('%06d', $matriculeNumber) . '-HEST';

//         return $matricule;
//     }
   static function getTokenSingle($remember_token)
   {
     return User::where('remember_token', '=', $remember_token)->first();
   }


//    static public function getAdmin()
//    {
   //    $return = self::select('users.*')
   //    ->where('user_type','=',1)
   //    ->where('is_deleted','=',0);

   //    if(!empty(Request::get('name')))
   //    {
   //      $return = $return->where('name', 'like','%'.Request::get('name').'%');
   //   } 
   //   if(!empty(Request::get('email')))
   //   {
   //      $return = $return->where('email', 'like','%'.Request::get('email').'%');
   //   }

   //   if(!empty(Request::get('date')))
   //   {
   //      $return = $return->whereDate('created_at', '=',(Request::get('date')));
   //   }

   //   $return = $return->orderBy('id','desc')
   //   ->paginate(20);
   //   return $return;
//   }




   // static public function getStudent()
   //  {

   //      // $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name' )
   //                          //->join('class', 'class.id', '=', 'users.class_id', 'left')
   //                          //->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
   //      $return = self::select('users.*','class.name as class_name','subject.name as subject_name','domain.name as domain_name','subject.parcours as parcours')
   //                          ->join('class', 'class.id','users.class_id', 'left')
   //                          ->join('subject', 'subject.id','users.subject_id', 'left')
   //                          ->join('domain', 'domain.id','users.domain_id', 'left')
   //                          //->join('course', 'course.id','users.course_id', 'left')
   //                          ->where('users.user_type','=',3)
   //                          ->where('users.is_deleted','=',0);

   //                          if(!empty(Request::get('name')))
   //                          {
   //                             $return = $return->where('users.name', 'like','%'.Request::get('name').'%');
   //                          }

   //                          if(!empty(Request::get('prenom')))
   //                          {
   //                             $return = $return->where('users.prenom', 'like','%'.Request::get('prenom').'%');
   //                          }

   //                          if(!empty(Request::get('date_naissance')))
   //                          {
   //                             $return = $return->whereDate('users.date_naissance', '=',Request::get('date_naissance'));
   //                          }                            

   //                          if(!empty(Request::get('lieu_naissance')))
   //                          {
   //                             $return = $return->where('users.lieu_naissance', 'like','%'.Request::get('lieu_naissance').'%');
   //                          }


   //                          if(!empty(Request::get('pays_naissance')))
   //                          {
   //                             $return = $return->where('users.pays_naissance', 'like','%'.Request::get('pays_naissance').'%');
   //                          }


   //                          if(!empty(Request::get('nationalite')))
   //                          {
   //                             $return = $return->where('users.nationalite', 'like','%'.Request::get('nationalite').'%');
   //                          }


   //                          if(!empty(Request::get('ethnie')))
   //                          {
   //                             $return = $return->where('users.ethnie', 'like','%'.Request::get('ethnie').'%');
   //                          }                            


   //                          if(!empty(Request::get('prefecture')))
   //                          {
   //                             $return = $return->where('users.prefecture', '=', Request::get('prefecture'));
   //                          }

   //                          if(!empty(Request::get('sexe')))
   //                          {
   //                             $return = $return->where('users.sexe', 'like','%'.Request::get('sexe').'%');
   //                          }
   //                          if(!empty(Request::get('profile_pic')))
   //                          {
   //                            $return = $return->where('users.profile_pic', 'like','%'.Request::get('profile_pic').'%');
   //                          }


   //                          if(!empty(Request::get('religion')))
   //                          {
   //                             $return = $return->where('users.religion', 'like','%'.Request::get('religion').'%');
   //                          } 


   //                          if(!empty(Request::get('situation_matrimoniale')))
   //                          {
   //                             $return = $return->where('users.situation_matrimoniale', 'like','%'.Request::get('situation_matrimoniale').'%');
   //                          } 

   //                          if(!empty(Request::get('adresse')))
   //                          {
   //                             $return = $return->where('users.adresse', 'like','%'.Request::get('adresse').'%');
   //                          } 


   //                          if(!empty(Request::get('boite_postale')))
   //                          {
   //                             $return = $return->where('users.boite_postale', 'like','%'.Request::get('boite_postale').'%');
   //                          }   

   //                          if(!empty(Request::get('ville')))
   //                          {
   //                             $return = $return->where('users.ville', 'like','%'.Request::get('ville').'%');
   //                          } 



   //                          if(!empty(Request::get('pays_residence')))
   //                          {
   //                             $return = $return->where('users.pays_residence', 'like','%'.Request::get('pays_residence').'%');
   //                          } 


   //                          if(!empty(Request::get('telephone')))
   //                          {
   //                             $return = $return->where('users.telephone', 'like','%'.Request::get('telephone').'%');
   //                          } 

   //                          if(!empty(Request::get('nom_pere')))
   //                          {
   //                             $return = $return->where('users.nom_pere', 'like','%'.Request::get('nom_pere').'%');
   //                          } 


   //                          if(!empty(Request::get('prof_pere')))
   //                          {
   //                             $return = $return->where('users.prof_pere', 'like','%'.Request::get('prof_pere').'%');
   //                          } 


   //                          if(!empty(Request::get('tel_pere')))
   //                          {
   //                             $return = $return->where('users.tel_pere', 'like','%'.Request::get('tel_pere').'%');
   //                          } 

   //                          if(!empty(Request::get('nom_mere')))
   //                          {
   //                             $return = $return->where('users.nom_mere', 'like','%'.Request::get('nom_mere').'%');
   //                          } 


   //                          if(!empty(Request::get('prof_mere')))
   //                          {
   //                             $return = $return->where('users.prof_mere', 'like','%'.Request::get('prof_mere').'%');
   //                          } 


   //                          if(!empty(Request::get('tel_mere')))
   //                          {
   //                             $return = $return->where('users.tel_mere', 'like','%'.Request::get('tel_mere').'%');
   //                          }                             


   //                          if(!empty(Request::get('boursier')))
   //                          {
   //                             $return = $return->where('users.boursier', 'like','%'.Request::get('boursier').'%');
   //                          } 


   //                          if(!empty(Request::get('organisme')))
   //                          {
   //                             $return = $return->where('users.organisme', 'like','%'.Request::get('organisme').'%');
   //                          } 

   //                          if(!empty(Request::get('debut_bourse')))
   //                          {
   //                             $return = $return->whereDate('users.debut_bourse', '=',Request::get('debut_bourse'));
   //                          }

   //                          if(!empty(Request::get('etatPhys')))
   //                          {
   //                             $return = $return->where('users.etatPhys', 'like','%'.Request::get('etatPhys').'%');
   //                          } 


   //                          if(!empty(Request::get('person_prev')))
   //                          {
   //                             $return = $return->where('users.person_prev', 'like','%'.Request::get('person_prev').'%');
   //                          } 


   //                          if(!empty(Request::get('tel_prev')))
   //                          {
   //                             $return = $return->where('users.tel_prev', 'like','%'.Request::get('tel_prev').'%');
   //                          } 


   //                          if(!empty(Request::get('domaine')))
   //                          {
   //                             $return = $return->where('users.domaine', 'like','%'.Request::get('domaine').'%');
   //                          } 

   //                          if(!empty(Request::get('subject_id')))
   //                          {
   //                             $return = $return->where('users.subject_id', 'like','%'.Request::get('subject_id').'%');
   //                          } 

   //                          if(!empty(Request::get('semestre')))
   //                          {
   //                             $return = $return->where('users.semestre', 'like','%'.Request::get('semestre').'%');
   //                          } 

   //                          if(!empty(Request::get('parcours')))
   //                          {
   //                             $return = $return->where('users.parcours', 'like','%'.Request::get('parcours').'%');
   //                          } 

   //                          if(!empty(Request::get('date')))
   //                          {
   //                             $return = $return->whereDate('users.created_at', '=',Request::get('date'));
   //                          }

   //                          if(!empty(Request::get('email')))
   //                          {
   //                             $return = $return->where('users.email', 'like','%'.Request::get('email').'%');
   //                          }

   //                          if(!empty(Request::get('status')))
   //                          {
   //                             $status = (Request::get('status') == 100 ? 0 : 1);
   //                             $return = $return->where('users.status', '=',$status);
   //                          }                            

   //      $return = $return->orderBy('users.id','desc')
   //                       ->paginate(20);
   //      return $return;
   //  }
   

   static public function getSingleClass($id)
   {
      return self::select('users.*','class.amount','class.name as class_name')
      ->join('class','class.id','users.class_id')
      ->where('users.id','=',$id)
      ->first();

   }

   static public function getTotalUser($user_type,$activeYear)
   {
      return self::select('users.id')
      ->where('user_type','=',$user_type)
      ->where('is_deleted','=',0)
      ->where('users.school_year_id','=', $activeYear)
      ->count();
   }

   static public function getProgressYearTotalUser($user_type)
   {
      return self::select('users.id')
      ->where('user_type','=',$user_type)
      ->where('is_deleted','=',0)
      ->count();
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

   static public function getTeacher($activeYear)
   {
      return self::select('users.*')
              ->where('users.user_type','=',2)
              ->where('users.is_deleted','=',0)
              ->where('users.school_year_id','=', $activeYear)
              ->orderBy('users.id','desc')
              ->get(); 
   }

   static public function getProgressYearTeacher()
   {
      return self::select('users.*')
              ->where('users.user_type','=',2)
              ->where('users.is_deleted','=',0)
              ->orderBy('users.id','desc')
              ->get(); 
   }



static public function getTeacherStudent($teacher_id)
{
    // Récupérer toutes les classes de l'enseignant
    $teacherClasses = ClassTeacherModel::where('teacher_id', $teacher_id)
        ->where('status', 0)
        ->where('is_deleted', 0)
        ->pluck('class_id');

    // Requête pour obtenir les étudiants de ces classes
    $students = StudentModel::select(
            'users.*',
            'student.*',
            'class.name as class_name',
            'domain.name as domain_name',
            'subject.name as subject_name'
        )
        ->join('users', 'users.id', '=', 'student.user_id')
        ->join('class', 'class.id', '=', 'student.class_id')
        ->join('domain', 'domain.id', '=', 'student.domain_id')
        ->join('subject', 'subject.id', '=', 'student.subject_id')
        ->whereIn('student.class_id', $teacherClasses)
        ->where('users.user_type', 3)
        ->where('users.is_deleted', 0)
        ->orderBy('users.id','desc')
        ->paginate(20);

    return $students;
}


   // static public function getStudentClass($class_id)
   // {
   //    return self::select('users.id','users.name','users.prenom')
   //                          ->join('student','student.user_id','users.id')
   //                          ->join('class', 'class.id','users.class_id', 'left')
   //                          ->where('users.user_type','=',3)
   //                          ->where('users.is_deleted','=',0)
   //                          ->where('users.class_id','=', $class_id)
   //                          ->orderBy('users.id','desc')
   //                          ->get();
      

   // }

   // static public function getAttendance($student_id,$class_id, $attendance_date)
   // {
   //    return StudentAttendanceModel::checkAlreadyAttendance($student_id,$class_id, $attendance_date);
   // }


}


