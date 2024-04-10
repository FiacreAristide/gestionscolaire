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
use App\Models\StudentModel;

use App\Models\ClassCourseModel;
use App\Models\MentionModel;
use App\Models\SchoolYear;
use Str;

class StudentController extends Controller
{
    public function list()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getRecord']  = StudentModel::getProgressYearStudent();
        }
        else
        {
            $data['getRecord'] = StudentModel::getStudent($activeYear);
            //dd($data['getRecord']);
        }
        $data['header_title'] = "Liste| Etudiant";
        return view('admin.student.list',$data);
    }

    public function add()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $id = Auth::user()->id;
        if($progressYear == "0")
        {
            $data['getMentions'] = MentionModel::getProgressYearMentions();
            $data['getClass'] = ClassModel::getProgressYearClass();
            $data['getCourse'] = ClassCourseModel::getProgressYearMyCourse($id);
            $data['getSubject'] = SubjectModel::getProgressYearSubject();
            $data['getDomain'] = DomainModel::getProgressYearDomain();
        }
        else
        {
            $data['getMentions'] = MentionModel::getMentions($activeYear);
            $data['getClass'] = ClassModel::getClass($activeYear);
            $data['getCourse'] = ClassCourseModel::getMyCourse($id,$activeYear);
            $data['getSubject'] = SubjectModel::getSubject($activeYear);
            $data['getDomain'] = DomainModel::getDomain($activeYear);
        }
        $data['getMatricule'] = StudentModel::generateMatricule();
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        $data['header_title'] = "Ajouter| Etudiant";
        return view('admin.student.add',$data);
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
        $user->user_type = 3;
        $user->save();

    // Récupérez l'ID de l'utilisateur que vous venez de créer
        $userId = $user->id;
        $student = new StudentModel;
        $student->user_id = $userId;
        $student->matricule = StudentModel::generateMatricule();

        if(!empty($request->date_naissance)){
            $student->date_naissance = trim($request->date_naissance);
        }
            
        $student->lieu_naissance = trim($request->lieu_naissance);
        $student->pays_naissance = trim($request->pays_naissance);
        $student->nationalite = trim($request->nationalite);
        $student->ethnie = trim($request->ethnie);
        $student->prefecture = trim($request->prefecture);
        

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ydmhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
        }
        $student->situation_matrimoniale = trim($request->situation_matrimoniale);
        
        $student->boite_postale = trim($request->boite_postale);
        $student->ville = trim($request->ville);
        $student->pays_residence = trim($request->pays_residence);
        
        $student->nom_pere = trim($request->nom_pere);
        $student->prof_pere = trim($request->prof_pere);
        $student->tel_pere = trim($request->tel_pere);
        $student->nom_mere = trim($request->nom_mere);
        $student->prof_mere = trim($request->prof_mere);
        $student->tel_mere = trim($request->tel_mere);
        $student->boursier = trim($request->boursier);
        $student->organisme = trim($request->organisme);

        if(!empty($request->debut_bourse)){
            $student->debut_bourse = trim($request->debut_bourse);
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
        //$student->annee_scolaire = trim($request->annee_scolaire);
        $student->domain_id = trim($request->domain_id);
        $student->class_id = trim($request->class_id);
        $student->parcours = trim($request->parcours);
        $student->mention_id = trim($request->mention);
        $student->subject_id = trim($request->subject_id);
        $student->semestre = trim($request->semestre);
        $student->save();
        return redirect('admin/student/list')->with('success', "Etudiant ajouté avec succès");
}



    // public function insert(Request $request)
    // {
        //dd($request->all());
        // request()->validate([
        //     'email' => 'required|email|unique:users',
        //     'telephone' => 'max:8|min:8',
        //     'password' => 'min:6'
        // ]);


    public function edit($id)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $data['getRecord'] = User::getSingleStudent($id);
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if(!empty($data['getRecord']))
        {
            if($progressYear == "0")
            {
                $data['getMentions'] = MentionModel::getProgressYearMentions();
                $data['getClass'] = ClassModel::getProgressYearClass();
                $data['getSubject'] = SubjectModel::getProgressYearSubject();
                $data['getDomain'] = DomainModel::getProgressYearDomain();
            }
            else
            {
                $data['getMentions'] = MentionModel::getMentions($activeYear);
                $data['getClass'] = ClassModel::getClass($activeYear);
                $data['getSubject'] = SubjectModel::getSubject($activeYear);
                $data['getDomain'] = DomainModel::getDomain($activeYear);
            }
            $data['getYears'] = SchoolYear::getAllYears();
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
    $user = User::find($id);
    if (!$user) {
        return redirect('admin/student/list')->with('error', "Étudiant non trouvé!");
    }
    $user->school_year_id = $request->school_year_id;
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

    // Maintenant, mettez à jour les informations spécifiques à la table student
    $student = StudentModel::where('user_id', $id)->first();

    if ($student) {
        $student->matricule = trim($request->matricule);
        if(!empty($request->date_naissance)){
            $student->date_naissance = trim($request->date_naissance);
        }
            
        $student->lieu_naissance = trim($request->lieu_naissance);
        $student->pays_naissance = trim($request->pays_naissance);
        $student->nationalite = trim($request->nationalite);
        $student->ethnie = trim($request->ethnie);
        $student->prefecture = trim($request->prefecture);
        

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ydmhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
        }


        $student->situation_matrimoniale = trim($request->situation_matrimoniale);
        
        $student->boite_postale = trim($request->boite_postale);
        $student->ville = trim($request->ville);
        $student->pays_residence = trim($request->pays_residence);
        
        $student->nom_pere = trim($request->nom_pere);
        $student->prof_pere = trim($request->prof_pere);
        $student->tel_pere = trim($request->tel_pere);
        $student->nom_mere = trim($request->nom_mere);
        $student->prof_mere = trim($request->prof_mere);
        $student->tel_mere = trim($request->tel_mere);
        $student->boursier = trim($request->boursier);
        $student->organisme = trim($request->organisme);

        if(!empty($request->debut_bourse)){
            $student->debut_bourse = trim($request->debut_bourse);
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
        $student->mention_id = trim($request->mention);
        $student->subject_id = trim($request->subject_id);
        $student->semestre = trim($request->semestre);
        $student->save();

    } else {
        // Gérer le cas où les détails de l'étudiant ne sont pas trouvés
        return redirect('admin/student/list')->with('error', "Détails de l'étudiant non trouvés!");
    }

    return redirect('admin/student/list')->with('success', "Étudiant modifié avec succès!");
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

    public function myAccount()
    {
        $data['getRecord'] = User::getSingleStudent(Auth::user()->id);
        $data['header_title'] = "Modifier|Mot de passe";
        return view('student.my_account',$data);    
    }  

    public function updateMyAccountStudent(Request $request)
    {
        //dd($request->all());

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

        $student = StudentModel::where('user_id', $id)->first();

        if(!empty($request->date_naissance)){
            $student->date_naissance = trim($request->date_naissance);
        }
            
        $student->lieu_naissance = trim($request->lieu_naissance);
        $student->pays_naissance = trim($request->pays_naissance);
        $student->nationalite = trim($request->nationalite);
        $student->ethnie = trim($request->ethnie);
        $student->prefecture = trim($request->prefecture);
        

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ydmhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
        }


        $student->situation_matrimoniale = trim($request->situation_matrimoniale);
        
        $student->boite_postale = trim($request->boite_postale);
        $student->ville = trim($request->ville);
        $student->pays_residence = trim($request->pays_residence);
        
        $student->nom_pere = trim($request->nom_pere);
        $student->prof_pere = trim($request->prof_pere);
        $student->tel_pere = trim($request->tel_pere);
        $student->nom_mere = trim($request->nom_mere);
        $student->prof_mere = trim($request->prof_mere);
        $student->tel_mere = trim($request->tel_mere);
        $student->boursier = trim($request->boursier);
        $student->organisme = trim($request->organisme);

        if(!empty($request->debut_bourse)){
            $student->debut_bourse = trim($request->debut_bourse);
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
        $student->save();
        return redirect()->back()->with('success', "Compte mis à jour avec succès");

    }

    public function printList()
    {
        $data['getAllStudent'] = StudentModel::getAllStudent();
        //dd($data['getAllStudent']);
        return view('admin.student.print_list',$data);
    }

}
