<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Models\StudentAddFeesModel;
use App\Models\StudentModel;
use App\Models\ExamModel;
use App\Models\SchoolYear;

class DashboardController extends Controller
{
 public function dashboard()
 {
    $activeYear = SchoolYear::getActiveYear()->id;
    $progressYear = SchoolYear::getActiveYear()->inProgress;
    if($progressYear == "0")
    {
        $data['getTotalToday'] = StudentAddFeesModel::getProgressYearTotalFeesToday();
        $data['getTotalFees'] = StudentAddFeesModel::getProgressYearTotalFees();    
    }
    else
    {
        $data['getTotalToday'] = StudentAddFeesModel::getTotalFeesToday($activeYear);
        $data['getTotalFees'] = StudentAddFeesModel::getTotalFees($activeYear);
    }
    $data['header_title'] = 'Dashboard';
    if(Auth::user()->user_type == 1)
    {
        if($progressYear == "0")
        {
            $data['totalStudent'] = User::getProgressYearTotalUser(3);
            $data['totalTeacher'] = User::getProgressYearTotalUser(2);
            $data['totalAdmin'] = User::getProgressYearTotalUser(1);
            $data['totalExam'] = ExamModel::getProgressYearTotalExam();
            $data['totalClass'] = ClassModel::getProgressYEarTotalClass();
        }
        else
        {
            $data['totalStudent'] = User::getTotalUser(3,$activeYear);
            $data['totalTeacher'] = User::getTotalUser(2,$activeYear);
            $data['totalAdmin'] = User::getTotalUser(1,$activeYear);
            $data['totalExam'] = ExamModel::getTotalExam($activeYear);
            $data['totalClass'] = ClassModel::getTotalClass($activeYear);
        }
        return view('admin.dashboard',$data);
    }

    else if(Auth::user()->user_type == 2)
    {
        //Ce code ne fonctionne pas encore
        $data['totalStudent'] = User::getTotalUser(3,$activeYear);
        $data['totalTeacher'] = User::getTotalUser(2,$activeYear);
        $data['totalAdmin'] = User::getTotalUser(1,$activeYear);
        $data['totalExam'] = ExamModel::getTotalExam($activeYear);
        $data['totalClass'] = ClassModel::getTotalClass($activeYear);
       return view('teacher.dashboard');               
   }

   else if(Auth::user()->user_type == 3)
   {
       return view('student.dashboard');               
   }                          
}
}
