<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\DomainModel;
use App\Models\CourseModel;

use App\Models\ClassCourseModel;
use Str;

class StudentController extends Controller
{
    public function list(){

        $data['getRecord']  = User::getStudent(); 
        $data['header_title'] = "Liste| Etudiant";
        return view('admin.student.list',$data);
    }

    public function add()
    {
        $id = Auth::user()->id;

        $data['getClass'] = ClassModel::getClass();
        $data['getCourse'] = ClassCourseModel::getMyCourse($id);
        $data['getSubject'] = SubjectModel::getSubject();
        $data['getDomain'] = DomainModel::getDomain();
        $data['header_title'] = "Ajouter| Etudiant";
        return view('admin.student.add',$data);
    }


    public function insert(Request $request)
    {
        //dd($request->all());
        // request()->validate([
        //     'email' => 'required|email|unique:users',
        //     'telephone' => 'max:8|min:8',
        //     'password' => 'min:6'
        // ]);

        $student = new User;
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
        $student->boursier = trim($request->boursier);
        $student->organisme = trim($request->organisme);

        if(!empty($request->debut_bourse)){
            $student->date_naissance = trim($request->debut_bourse);
        }

        $student->religion = trim($request->religion);
        $student->salaire = trim($request->salaire);
        $student->prof_salaire = trim($request->prof_salaire);
        $student->etatPhys = trim($request->etatPhys);
        $student->handicap = trim($request->handicap);
        $student->person_prev = trim($request->person_prev);
        $student->tel_prev = trim($request->tel_prev);
        $student->annee_bac = trim($request->annee_bac);
        $student->mention_bac = trim($request->mention_bac);
        $student->serie = trim($request->serie);
        $student->num_table = trim($request->num_table);
        $student->pays_obtention = trim($request->pays_obtention);
        $student->annee_scolaire = trim($request->annee_scolaire);
        $student->domain_id = trim($request->domain_id);
        $student->class_id = trim($request->class_id);
        $student->parcours = trim($request->parcours);
        $student->mention = trim($request->mention);
        $student->specialite = trim($request->matiere);
        $student->semestre = trim($request->semestre);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();




        // if(!empty($request->file('profile_pic')))
        // {
        //     $ext = $request->file('profile_pic')->getClientOriginalExtension();
        //     $file = $request->file('profile_pic');
        //     $randomStr = date('Ydmhis').Str::random(20);
        //     $filename = strtolower($randomStr).'.'.$ext;
        //     $file->move('upload/profile/', $filename);

        //     $student->profile_pic = $filename;
        // }

    

        return redirect('admin/student/list')->with('success', "Etudiant ajouté avec succès");
    }


    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);

        if(!empty($data['getRecord']))
        {
            $data['getClass'] = ClassModel::getClass();
            $data['getCourse'] = CourseModel::getRecord();
            $data['getDomain'] = DomainModel::getDomain();
            $data['header_title'] = "Modifier| Etudiant";

            return view('admin.student.edit', $data);
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
            'height' => 'max:10',
            'weight' => 'max:10',
            'mobile_number' => 'max:8|min:8',
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
        $student->boursier = trim($request->boursier);
        $student->organisme = trim($request->organisme);

        if(!empty($request->debut_bourse)){
            $student->date_naissance = trim($request->debut_bourse);
        }
        
        $student->religion = trim($request->religion);
        $student->salaire = trim($request->salaire);
        $student->prof_salaire = trim($request->prof_salaire);
        $student->etatPhys = trim($request->etatPhys);
        $student->handicap = trim($request->handicap);
        $student->person_prev = trim($request->person_prev);
        $student->tel_prev = trim($request->tel_prev);
        $student->annee_bac = trim($request->annee_bac);
        $student->mention_bac = trim($request->mention_bac);
        $student->serie = trim($request->serie);
        $student->num_table = trim($request->num_table);
        $student->pays_obtention = trim($request->pays_obtention);
        $student->annee_scolaire = trim($request->annee_scolaire);
        $student->class_id = trim($request->class_id);//domaine
        $student->parcours = trim($request->parcours);
        $student->mention = trim($request->mention);
        $student->specialite = trim($request->matiere);
        $student->semestre = trim($request->semestre);
        $student->email = trim($request->email);

        if(!empty($request->password))
        {
            $student->password = Hash::make($request->password);
        }
        
        $student->save();
        return redirect('admin/student/list')->with('success', "Etudiant modifié avec succès!");   
    }


    public function delete($id)
    {
        $getRecord= User::getSingle($id);

        if(!empty($getRecord))
        {
            $getRecord->is_deleted = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Etudiant supprimé avec succès!");
        }
        else
        {
            abort(404);
        }
    }


    //Teacher side

    public function myStudent()
    {
        $data['getRecord']  = User::getTeacherStudent(Auth::user()->id); 
        $data['header_title'] = "Mes étudiant";
        return view('teacher.my_student',$data);
    }

}
