<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\SchoolYear;
use App\Models\TeacherModel;

class TeacherController extends Controller
{
    public function list()
    {
       $activeYear = SchoolYear::getActiveYear()->id;
       $progressYear = SchoolYear::getActiveYear()->inProgress;
       if($progressYear == "0")
       {
          $data['getRecord'] = TeacherModel::getProgressYearTeacher();
       }
       else{
          $data['getRecord'] = TeacherModel::getTeacher($activeYear);
       }
       $data['header_title'] = "Liste|Enseignant";
       return view('admin.teacher.list', $data);
    }


    public function add()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        $data['getClass'] = ClassModel::getClass($activeYear);
        $data['header_title'] = "Ajout|Enseignant";
        return view('admin.teacher.add',$data);
    }


        public function insert(Request $request)
    {
        request()->validate([
            'email'=> 'required|email|unique:users'
        ]);
  
        $user = new User;
        $user->school_year_id = trim($request->school_year_id);
        $user->name = trim($request->name);
        $user->prenom = trim($request->prenom);
        $user->sexe = trim($request->sexe);
        $user->adresse = trim($request->adresse);
        $user->telephone = trim($request->telephone);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->created_by = Auth::user()->id;
        $user->user_type = 2;
        $user->save();

        $userId = $user->id;
        $teacher = new TeacherModel;
        $teacher->user_id = $userId;
        if(!empty($request->date_integration))
        {
            $teacher->date_integration =trim($request->date_integration);
        }
        $teacher->telephone = trim($request->telephone);
        $teacher->situation_matrimoniale = trim($request->situation_matrimoniale);
        $teacher->dernier_diplome = trim($request->dernier_diplome);
        $teacher->grade_universitaire = trim($request->grade_universitaire);
        $teacher->save();
        return redirect('admin/teacher/list')->with('success', "Enseignant ajouté avec succès");
}


    public function edit($id)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $data['getRecord'] = User::getSingleTeacher($id);
        if($progressYear == "0")
        {
            $data['getClass'] = ClassModel::getProgressYearClass();
        }
        else
        {
            $data['getClass'] = ClassModel::getClass($activeYear);
        }
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Modifier|Enseignant";
            return view('admin.teacher.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
    $user = User::find($id);
    if (!$user) {
        return redirect('admin/student/list')->with('error', "Étudiant non trouvé!");
    }
    $user->name = trim($request->name);
    $user->prenom = trim($request->prenom);
    $user->sexe = trim($request->sexe);
    $user->adresse = trim($request->adresse);
    $user->telephone = trim($request->telephone);
    $user->email = trim($request->email);
    if(!empty($request->password))
    {
        $user->password = Hash::make($request->password);
    }
    $user->status = $request->status;
    $user->save();
    $teacher = TeacherModel::where('user_id', $id)->first();
    if ($teacher) {
        if(!empty($request->date_integration))
        {
            $teacher->date_integration =trim($request->date_integration);
        }
        $teacher->situation_matrimoniale = trim($request->situation_matrimoniale);
        $teacher->dernier_diplome = trim($request->dernier_diplome);
        $teacher->grade_universitaire = trim($request->grade_universitaire);
        $teacher->save();
    } else {
        return redirect('admin/teacher/list')->with('error', "Détails de l'enseignant non trouvés!");
    }

    return redirect('admin/teacher/list')->with('success', "Enseignant modifié avec succès!");
}


    public function delete($id)
    {
        $getRecord= User::getSingle($id);

        if(!empty($getRecord))
        {
            $getRecord->is_deleted = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Enseignant supprimé avec succès");
        }
        else
        {
            abort(404);
        }
    }

    public function myAccount()
    {
        $data['getRecord'] = User::getSingleTeacher(Auth::user()->id);
        $data['header_title'] = "Modifier|Mot de passe";
        return view('teacher.my_account',$data);    
    } 

    public function updateMyAccountTeacher(Request $request)
      {
        $id = Auth::user()->id;
        $request->validate([
            'email'=>'required|email|unique:users,email,'.$id,
           
        ]);
        $user = User::find($id);
        $user->name = trim($request->name);
        $user->prenom = trim($request->prenom);
        $user->sexe = trim($request->sexe);
        $user->adresse = trim($request->adresse);
        $user->telephone = trim($request->telephone);
        $user->email = trim($request->email);
        $user->save();

        $teacher = TeacherModel::where('user_id', $id)->first();
        $teacher->situation_matrimoniale = trim($request->situation_matrimoniale);
        $teacher->dernier_diplome = trim($request->dernier_diplome);
        $teacher->grade_universitaire = trim($request->grade_universitaire);
        $teacher->save();

        return redirect()->back()->with('success', "Compte mis à jour avec succès");
      } 
      
      public function printList()
      {
        $data['getTeacherList'] = TeacherModel::getAllTeacher();
        //dd($data['getTeacherList']);
        return view('admin.teacher.print_list',$data);
      }
}
