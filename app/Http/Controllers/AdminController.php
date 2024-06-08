<?php

namespace App\Http\Controllers;

use App\Models\AdministratorModel;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class AdminController extends Controller
{
    public function list(){
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getRecord']  = AdministratorModel::getProgressYearAdmin();
        }
        else
        {
            $data['getRecord']  = AdministratorModel::getAdmin($activeYear);
        }
        $data['header_title'] = "Liste| Administrateur";
        return view('admin.admin.list',$data);
    }

    public function add(){
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        $data['header_title'] = "Ajouter| Administrateur";
        return view('admin.admin.add',$data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email'=> 'required|email|unique:users',
            'password' => 'min:6'
        ]);
        $user = new User;
        $user->school_year_id = trim($request->school_year_id);
        $user->name = trim($request->name);
        $user->prenom = trim($request->prenom);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->created_by = Auth::user()->id;
        $user->user_type = 1;
        $user->save();
        $userId = $user->id;
        $admin = new AdministratorModel;
        $admin->user_id = $userId;
        $admin->save();
        return redirect('admin/admin/list')->with('success', "Administrateur ajouté avec succès");
    }


    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Modifier| Administrateur";
            return view('admin.admin.edit',$data);
        }
        else
        {
          abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
        'email'=> 'required|email|unique:users,email,'.$id
        ]);
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/admin/list')->with('success', "Administrateur modifier avec succès");
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_deleted = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', "Administrateur supprimé avec succès");
    }

    public function impression()
    {
        return view('admin.impression.land');
    }

    public function studentList()
    {
        return view('admin.impression.student_list');
    }

    public function teacherList()
    {
        return view('admin.impression.teacher_list');
    }
}
