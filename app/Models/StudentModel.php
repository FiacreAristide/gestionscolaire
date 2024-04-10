<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\DB;

class StudentModel extends Model
{
    use HasFactory;

    protected $table ='student';

    public function user() {
        return $this->belongsTo(User::class);
    }

   //  public function selectedCourses()
   //  {
   //      return $this->hasMany(SelectedCourse::class, 'student_id');
   //  }

   // static public function getSingle($id)
   // {
   //    return self::find($id);
   // }

   public static function getMyYear()
    {
        return self::select('users.*','student.*','school_year.*')
            ->join('users', 'student.user_id', '=', 'users.id')
            ->join('school_year', 'school_year.id','users.school_year_id')
            ->where('')
            ->get();
    }
    

   static public function getSingle($id)
   {
      return self::select('users.*', 'student.*', 'domain.name as domain_name', 'subject.name as subject_name', 'mention.nom as mention_name')
         ->join('users', 'users.id', '=', 'student.user_id')
         ->join('domain', 'domain.id', '=', 'student.domain_id')
         ->join('subject', 'subject.id', '=', 'student.subject_id')
         ->join('mention', 'mention.id', '=', 'student.mention_id')
         ->where('student.user_id', '=', $id)
         ->first();
   }

   static public function getAllStudent()
   {
      return self::select('users.*', 'student.*','class.name as class_name')
         ->join('users', 'users.id', '=', 'student.user_id')
         ->join('class', 'class.id', '=','student.class_id')
         ->orderBy('class_name')
         ->get();
   }



   public static function generateMatricule()
   {
    // Obtenez le titre de l'année académique active
    $activeYear = SchoolYear::where('status', 0)->first();

    if (!$activeYear) {
        return null; // Gérer le cas où aucune année académique active n'est trouvée
    }

    // Extraire une partie du titre de l'année académique pour inclure dans le matricule
    $yearTitleParts = explode('-', $activeYear->title);
    $yearConcatenation = substr($yearTitleParts[0], -2) . substr($yearTitleParts[1], -2);

    // Obtenez le dernier numéro de matricule pour l'année académique active
      $lastMatricule = self::whereHas('user', function ($query) {
            $query->where('user_type', 3);
         })->max('matricule');
    // Générez le nouveau numéro de matricule
    if ($lastMatricule) {
        $matriculeNumber = intval(substr($lastMatricule, 6)) + 1;
    } else {
        $matriculeNumber = 1;
    }

    // Limitez le numéro de matricule à 999999
    $matriculeNumber = ($matriculeNumber > 999999) ? 1 : $matriculeNumber;

    // Concaténez les parties pour former le matricule complet
    $matricule = $yearConcatenation . sprintf('%06d', $matriculeNumber) . '-HEST';

    return $matricule;
   }


    static function getTokenSingle($remember_token)
   {
     return StudentModel::where('remember_token', '=', $remember_token)->first();
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


   static public function getStudent($activeYear)
    {
                $return = StudentModel::select(
                'users.*',
                'student.*',
                'class.name as class_name',
                'subject.name as subject_name',
                'domain.name as domain_name',
            )
                ->join('users', 'student.user_id', '=', 'users.id')
                ->leftJoin('class', 'class.id', '=', 'student.class_id')
                ->leftJoin('subject', 'subject.id', '=', 'student.subject_id')
                ->leftJoin('domain', 'domain.id', '=', 'student.domain_id')
                ->where('users.user_type', '=', 3)
                ->where('users.is_deleted', '=', 0)
                ->where('users.school_year_id','=',$activeYear);
   
                            if(!empty(Request::get('name')))
                            {
                               $return = $return->where('users.name', 'like','%'.Request::get('name').'%');
                            }

                            if(!empty(Request::get('prenom')))
                            {
                               $return = $return->where('users.prenom', 'like','%'.Request::get('prenom').'%');
                            }                          

                            if(!empty(Request::get('ethnie')))
                            {
                               $return = $return->where('users.ethnie', 'like','%'.Request::get('ethnie').'%');
                            }                            

                            if(!empty(Request::get('sexe')))
                            {
                               $return = $return->where('users.sexe', 'like','%'.Request::get('sexe').'%');
                            }

                            if(!empty(Request::get('telephone')))
                            {
                               $return = $return->where('users.telephone', 'like','%'.Request::get('telephone').'%');
                            } 

                            if(!empty(Request::get('email')))
                            {
                               $return = $return->where('users.email', 'like','%'.Request::get('email').'%');
                            }

                            if(!empty(Request::get('class_id')))
                            {
                               $return = $return->where('student.class_id', '=',Request::get('class_id'));
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

   static public function getProgressYearStudent()
    {
            $return = StudentModel::select(
               'users.*',
               'student.*',
               'class.name as class_name',
               'subject.name as subject_name',
               'domain.name as domain_name'
               //'subject.parcours as parcours'
            )
                ->join('users', 'student.user_id', '=', 'users.id')
                ->leftJoin('class', 'class.id', '=', 'student.class_id')
                ->leftJoin('subject', 'subject.id', '=', 'student.subject_id')
                ->leftJoin('domain', 'domain.id', '=', 'student.domain_id')
                ->where('users.user_type', '=', 3)
                ->where('users.is_deleted', '=', 0);
   
                            if(!empty(Request::get('name')))
                            {
                               $return = $return->where('users.name', 'like','%'.Request::get('name').'%');
                            }

                            if(!empty(Request::get('prenom')))
                            {
                               $return = $return->where('users.prenom', 'like','%'.Request::get('prenom').'%');
                            }                          

                            if(!empty(Request::get('ethnie')))
                            {
                               $return = $return->where('users.ethnie', 'like','%'.Request::get('ethnie').'%');
                            }                            

                            if(!empty(Request::get('sexe')))
                            {
                               $return = $return->where('users.sexe', 'like','%'.Request::get('sexe').'%');
                            }

                            if(!empty(Request::get('telephone')))
                            {
                               $return = $return->where('users.telephone', 'like','%'.Request::get('telephone').'%');
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

    static public function getStudentClass($class_id,$activeYear)
   {
      return StudentModel::select('users.*','student.*')
         ->join('users','student.user_id', '=', 'users.id')
         ->join('class', 'class.id','student.class_id')
         ->where('users.user_type','=',3)
         ->where('users.is_deleted','=',0)
         ->where('student.class_id','=', $class_id)
         ->where('users.school_year_id','=', $activeYear)
         ->orderBy('users.id','desc')
         ->get();
   }

//     static public function getStudentsWithLowAverage($class_id, $activeYear)
// {

//    return DB::table('student as s')
//     ->select('u.name', 's.prenom', DB::raw('AVG(mr.note_devoir, mr.note_exam) as average'))
//     ->join('users as u', 'u.id', '=', 's.user_id') 
//     ->join('mark_register as mr', 'mr.student_id', '=', 's.id')
//     ->groupBy('s.id', 'u.name', 's.prenom')
//     ->having('average', '<', 'mr.passing_mark')
//     ->get();
   //  return StudentModel::select('users.*', 'student.*')
   //      ->join('users', 'student.user_id', '=', 'users.id')
   //      ->join('class', 'class.id', '=', 'student.class_id')
   //      ->join('mark_register', 'mark_register.student_id', '=', 'student.id')
   //      ->where('users.user_type', '=', 3)
   //      ->where('users.is_deleted', '=', 0)
   //      ->where('student.class_id', '=', $class_id)
   //      ->where('users.school_year_id', '=', $activeYear)
   //      ->whereRaw('(mark_register.note_devoir + mark_register.note_exam) / 2 < mark_register.passing_mark')
   //      ->orderBy('users.id', 'desc')
   //      ->get();
//}

//    static public function getStudentMissedCourse($class_id, $activeYear)
// {
//     return StudentModel::select('users.*', 'student.*')
//         ->join('users', 'student.user_id', '=', 'users.id')
//         ->join('class', 'class.id', '=', 'student.class_id')
//         ->leftJoin('mark_register', function ($join) {
//             $join->on('mark_register.student_id', '=', 'student.id')
//                ->on(DB::raw('(mark_register.note_devoir + mark_register.note_exam) / 2'), '<', 'mark_register.passing_mark');
//         })
//         ->where('users.user_type', '=', 3)
//         ->where('users.is_deleted', '=', 0)
//         ->where('student.class_id', '=', $class_id)
//         ->where('users.school_year_id', '=', $activeYear)
//         ->orderBy('users.id', 'desc')
//         ->get();
// }


static public function getStudentWhoMissedCourse($class_id, $activeYear)
{
    return StudentModel::select('users.*', 'student.*')
        ->join('users', 'student.user_id', '=', 'users.id')
        ->join('class', 'class.id', '=', 'student.class_id')
        ->leftJoin('mark_register', function($join) {
            $join->on('mark_register.student_id', '=', 'student.id')
                 ->whereRaw('(mark_register.note_devoir + mark_register.note_exam) / 2 < mark_register.passing_mark');
        })
        ->where('users.user_type', '=', 3)
        ->where('users.is_deleted', '=', 0)
        ->where('student.class_id', '=', $class_id)
        ->where('users.school_year_id', '=', $activeYear)
        ->orderBy('users.id', 'desc')
        ->get();
}




   static public function getProgressYearStudentClass($class_id)
   {
      return StudentModel::select('users.*','student.*')
               ->join('users','student.user_id', '=', 'users.id')
               ->join('class', 'class.id','student.class_id')
               ->where('users.user_type','=',3)
               ->where('users.is_deleted','=',0)
               ->where('student.class_id','=', $class_id)
               ->orderBy('users.id','desc')
               ->get();
   }

   static public function getAttendance($student_id,$class_id, $attendance_date)
   {
      $activeYear = SchoolYear::getActiveYear()->id;
      return StudentAttendanceModel::checkAlreadyAttendance($student_id,$class_id, $attendance_date,$activeYear);
   }

      static public function getStudentFees($activeYear)
    {   
        $return = self::select('users.*','student.*','class.name as class_name', 'class.amount')
               ->join('users', 'student.user_id', '=', 'users.id')
               ->join('class', 'class.id', '=', 'student.class_id')
               ->where('users.user_type', '=', 3)
               ->where('users.is_deleted', '=', 0)
               ->where('users.school_year_id','=', $activeYear);
                if(!empty(Request::get('class_id')))  
                {
                  $return = $return->where('student.class_id','=',Request::get('class_id'));
                }   
                
                if(!empty(Request::get('student_id')))  
                {
                  $return = $return->where('users.id','=',Request::get('student_id'));
                } 
                            
                if(!empty(Request::get('name')))  
                {
                  $return = $return->where('users.name','like','%'.Request::get('name').'%');
                }  

                if(!empty(Request::get('prenom')))  
                {
                  $return = $return->where('users.prenom','like','%'.Request::get('prenom').'%');
                }  

        $return = $return->orderBy('users.name','asc')
                         ->paginate(20);
        return $return;
    }

     static public function getProgressYearStudentFees()
    {   
        $return = self::select('users.*','student.*','class.name as class_name', 'class.amount')
               ->join('users', 'student.user_id', '=', 'users.id')
               ->join('class', 'class.id', '=', 'student.class_id')
               ->where('users.user_type', '=', 3)
               ->where('users.is_deleted', '=', 0);
                if(!empty(Request::get('class_id')))  
                {
                  $return = $return->where('student.class_id','=',Request::get('class_id'));
                }   
                
                if(!empty(Request::get('student_id')))  
                {
                  $return = $return->where('users.id','=',Request::get('student_id'));
                } 
                            
                if(!empty(Request::get('name')))  
                {
                  $return = $return->where('users.name','like','%'.Request::get('name').'%');
                }  

                if(!empty(Request::get('prenom')))  
                {
                  $return = $return->where('users.prenom','like','%'.Request::get('prenom').'%');
                }  

        $return = $return->orderBy('users.name','asc')
                         ->paginate(20);
        return $return;
    }

   static public function getSingleClass($id,$activeYear)
   {
      return StudentModel::select('users.*', 'student.*', 'class.name as class_name', 'class.amount')
               ->join('users', 'student.user_id', '=', 'users.id')
               ->join('class', 'class.id', '=', 'student.class_id')
               ->where('users.id', '=', $id)
               ->where('users.school_year_id','=', $activeYear)
               ->first();
   }

   static function getPaidAmount($student_id,$class_id)
   {
      return StudentAddFeesModel::getPaidAmount($student_id,$class_id);
   }


  static public function getStudentInfos($activeYear, $id)
{
   return StudentModel::select(
        'users.*',
        'student.*',
        'class.name as class_name',
        'subject.name as subject_name',
        'domain.name as domain_name',
        'mention.nom as mention_name',
        'school_year.title as school_year_name'
        )

        ->join('users', 'users.id', '=', 'student.user_id')
        ->join('class', 'class.id', '=', 'student.class_id')
        ->join('subject', 'subject.id', '=', 'student.subject_id')
        ->join('domain', 'domain.id', '=', 'student.domain_id')
        ->join('mention', 'mention.id', '=', 'student.mention_id')
        ->join('school_year', 'school_year.id', '=', 'users.school_year_id')
        ->where('users.id','=', $id)
        ->where('users.school_year_id', $activeYear)
        ->where('school_year.inProgress', 1)
        ->get();  
   }
}
