<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;
use App\Models\User;

class TeacherController extends Controller
{
    public function list()
    {
       $data['getRecord'] = User::getTeacher();
       $data['header_title'] = "Liste|Enseignant";

       return view('admin.teacher.list', $data);
    }


    public function add()
    {
        $data['header_title'] = "Ajout|Enseignant";
         return view('admin.teacher.add',$data);
    }



    public function insert(Request $request)
    {


        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->prenom = trim($request->prenom);
        $teacher->sexe = trim($request->sexe);


        if(!empty($request->date_integration))
        {
            $teacher->date_integration =trim($request->date_integration);
        }


        // if(!empty($request->file('profile_pic')))
        // {
        //     $ext = $request->file('profile_pic')->getClientOriginalExtension();
        //     $file = $request->file('profile_pic');
        //     $randomStr = date('Ydmhis').Str::random(20);
        //     $filename = strtolower($randomStr).'.'.$ext;
        //     $file->move('upload/profile/', $filename);

        //     $teacher->profile_pic = $filename;
        // }
        $teacher->telephone = trim($request->telephone);
        $teacher->situation_matrimoniale = trim($request->situation_matrimoniale);
        $teacher->adresse = trim($request->adresse);
        $teacher->dernier_diplome = trim($request->dernier_diplome);
        $teacher->grade_universitaire = trim($request->grade_universitaire);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Enseignant ajouté avec succès");

    }


    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
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
        $request->validate([
            'email'=>'required|email|unique:users,email,'.$id,
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->prenom = trim($request->prenom);
        $teacher->sexe = trim($request->sexe);


        if(!empty($request->date_integration))
        {
            $teacher->date_integration =trim($request->date_integration);
        }

  

        // if(!empty($request->file('profile_pic')))
        // {
        //     $ext = $request->file('profile_pic')->getClientOriginalExtension();
        //     $file = $request->file('profile_pic');
        //     $randomStr = date('Ydmhis').Str::random(20);
        //     $filename = strtolower($randomStr).'.'.$ext;
        //     $file->move('upload/profile/', $filename);

        //     $teacher->profile_pic = $filename;
        // }
        $teacher->situation_matrimoniale = trim($request->situation_matrimoniale);
        $teacher->telephone = trim($request->telephone);
        $teacher->adresse = trim($request->adresse);
        $teacher->dernier_diplome = trim($request->dernier_diplome);
        $teacher->grade_universitaire = trim($request->grade_universitaire);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);

        if(!empty($request->password))
        {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Enseignant modifié avec succès");

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


}
