<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class UserController extends Controller
{
    public function change_password()
    {
        $data['header_title'] = "Modifier|Mot de passe";
        return view('profile.change_password',$data);
    }


    public function myAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "Modifier|Mot de passe";

        if (Auth::user()->user_type == 1 ) 
        {
           return view('admin.my_account',$data); 
        }

        else if (Auth::user()->user_type == 2 ) 
        {
           return view('teacher.my_account',$data); 
        }
        elseif (Auth::user()->user_type == 3)
        {
            return view('student.my_account',$data);
        }
        else if (Auth::user()->user_type == 4)
        {
            return view('parent.my_account',$data);
        }
        
    }  


    public function updateMyAccountAdmin(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'email'=>'required|email|unique:users,email,'.$id,
           
        ]);

        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);


        $admin->save();

        return redirect()->back()->with('success', "Compte mis à jour avec succès");


    }

    public function updateMyAccountTeacher(Request $request)
      {

        $id = Auth::user()->id;
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
        $teacher->email = trim($request->email);


        $teacher->save();

        return redirect()->back()->with('success', "Compte mis à jour avec succès");
      }  

    public function updateMyAccountStudent(Request $request)
    {
        //dd($request->all());

        $id = Auth::user()->id;
        $request->validate([
            'email'=>'required|email|unique:users,email,'.$id,
           
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->prenom= trim($request->prenom);

        if(!empty($request->date_naissance)){
            $student->date_naissance = trim($request->date_naissance);
        }
            
        $student->lieu_naissance = trim($request->lieu_naissance);
        $student->pays_naissance = trim($request->pays_naissance);
        $student->nationalite = trim($request->nationalite);
        $student->ethnie = trim($request->ethnie);
        $student->prefecture = trim($request->prefecture);
        $student->sexe = trim($request->sexe);
        $student->situation_matrimoniale = trim($request->situation_matrimoniale);
        $student->adresse = trim($request->adresse);
        $student->boite_postale = trim($request->boite_postale);
        $student->ville = trim($request->ville);
        $student->pays_residence = trim($request->pays_residence);
        $student->telephone = trim($request->telephone);
        $student->nom_pere = trim($request->nom_pere);
        $student->prof_pere = trim($request->prof_pere);
        $student->tel_pere = trim($request->tel_pere);
        $student->nom_mere = trim($request->nom_mere);
        $student->prof_mere = trim($request->prof_mere);
        $student->tel_mere = trim($request->tel_mere);

        $student->religion = trim($request->religion);
        $student->etatPhys = trim($request->etatPhys);
        $student->handicap = trim($request->handicap);
        $student->person_prev = trim($request->person_prev);
        $student->tel_prev = trim($request->tel_prev);
        $student->annee_bac = trim($request->annee_bac);
        $student->mention_bac = trim($request->mention_bac);
        $student->serie = trim($request->serie);
        $student->num_table = trim($request->num_table);
        $student->pays_obtention = trim($request->pays_obtention);
        $student->mention = trim($request->mention);
        //$student->specialite = trim($request->matiere);
        
        $student->email = trim($request->email);
        $student->save();

        return redirect()->back()->with('success', "Compte mis à jour avec succès");

    }

    public function updateMyAccountParent(Request $request)
    {

        $id = Auth::user()->id;
        $request->validate([
            'email'=>'required|email|unique:users,email,'.$id,    
        ]);
        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->prenom = trim($request->prenom);
        $parent->sexe = trim($request->sexe);
        $parent->occupation = trim($request->occupation);
        $parent->adresse = trim($request->adresse);
        $parent->telephone = trim($request->telephone);

        $parent->save();

        return redirect()->back()->with('success', "Compte mis à jour avec succès");



    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', "Mot de passe modifié avec succès");
        }else
        {
            return redirect()->back()->with('error', "Ancien mot de passe incorrect");
        }
    }
}
