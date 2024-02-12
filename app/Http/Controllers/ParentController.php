<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;
use App\Models\User;

class ParentController extends Controller
{
    public function list(){

        $data['getRecord']  = User::getParent(); 
        $data['header_title'] = "Liste|Parent";
        return view('admin.parent.list',$data);
    }

    public function add()
    {
        $data['header_title'] = "Ajouter|Parent";
        return view('admin.parent.add',$data);
    }

    public function insert(Request $request)
    {
        // request()->validate([
        //     'email' => 'required|email|unique:users',
        //     'mobile_number' => 'max:8|min:8',
        //     'address' => 'max:255'
        // ]);


        $parent = new User;
        $parent->name = trim($request->name);
        $parent->prenom = trim($request->prenom);
        $parent->sexe = trim($request->sexe);
        $parent->telephone = trim($request->telephone);
        $parent->adresse = trim($request->adresse);
        $parent->occupation = trim($request->occupation);

        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;
        $parent->save();


        return redirect('admin/parent/list')->with('success', "
        parent ajouté avec succès");
    }


    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);

        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Modifier|Parent";
            return view('admin.parent.edit', $data);
        }
        else
        {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
      request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:8|min:8',
            'address' => 'max:255'
        ]);


        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->prenom = trim($request->prenom);
        $parent->sexe = trim($request->sexe);
        $parent->occupation = trim($request->occupation);
        $parent->adresse = trim($request->adresse);
        $parent->telephone = trim($request->mobile_number);
        // if(!empty($request->file('profile_pic')))
        // {
        //     if( !empty($parent->getProfile()))
        //     {
        //         unlink('upload/profile/'.$parent->profile_pic);
        //     }
        //     $ext = $request->file('profile_pic')->getClientOriginalExtension();
        //     $file = $request->file('profile_pic');
        //     $randomStr = date('Ydmhis').Str::random(20);
        //     $filename = strtolower($randomStr).'.'.$ext;
        //     $file->move('upload/profile/', $filename);

        //     $parent->profile_pic = $filename;
        // }

        $parent->status = trim($request->status);
        $parent->email = trim($request->email);

        if(!empty($request->password))
        {
            $parent->password = Hash::make($request->password);
        }
        
        $parent->save();


        return redirect('admin/parent/list')->with('success', "
        parent modifié avec succès");  
    }


    public function delete($id)
    {
        $getRecord= User::getSingle($id);

        if(!empty($getRecord))
        {
            $getRecord->is_deleted = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Parent supprimé avec succès");
        }
        else
        {
            abort(404);
        }
    } 

    public function myStudent($id)
       {
            $data['getParent'] = User::getSingle($id);
            $data['parent_id'] = $id;
            $data['getSearchStudent']  = User::getSearchStudent(); 
            $data['getRecord'] = User::getMyStudent($id);
            $data['header_title'] = "Student Parent List";
            return view('admin.parent.my_student', $data);
       }   


       public function assignStudentParent($student_id, $parent_id)
       {
           $student = User::getSingle($student_id);
           $student->parent_id = $parent_id;
           $student->save();

           return redirect()->back()->with('success', "Etudiant assigné avec succès ");
       }


        public function assignStudentParentDelete($student_id)
       {
           $student = User::getSingle($student_id);
           $student->parent_id = null;
           $student->save();

           return redirect()->back()->with('success', "Etudiant supprimé avec succès ");
       }


       // Côté parent
       public function myStudentParent()
       {

        $id = Auth::user()->id;
            $data['parent_id'] = $id;
            $data['getRecord'] = User::getMyStudent($id);
            $data['header_title'] = "Parent| Etudiant";
            return view('parent.my_student', $data);
       }
}
