<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\ClassTeacherModel;
use App\Models\CourseTeacherModel;
use App\Models\SchoolYear;
use Auth;

class ClassTeacherController extends Controller
{
     public function list(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getRecord'] = ClassTeacherModel::getProgressYearRecord();
        }
        else
        {
            $data['getRecord'] = ClassTeacherModel::getRecord($activeYear);
        }
        $data['header_title'] = "Liste| Classes & Cours";
        return view('admin.class_teacher.list', $data);
    }

    
    public function add(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        if($progressYear == "0")
        {
            $data['getClass'] = ClassModel::getProgressYearClass();
            $data['getTeacher'] = User::getProgressYearTeacher();
        }
        else
        {
            $data['getClass'] = ClassModel::getClass($activeYear);
            $data['getTeacher'] = User::getTeacher($activeYear);
        }
        $data['header_title'] = "Assigner| Classes-Enseignants";
        return view('admin.class_teacher.add', $data);
    }

    public function insert(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        if(!empty($request->teacher_id)){
            foreach($request->teacher_id as $teacher_id)
            {
                $getAlreadyFirst= ClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id,$activeYear);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();    
                }
                else
                {         
                    $save = new ClassTeacherModel;
                    $save->school_year_id = trim($request->school_year_id);
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/class_teacher/list')->with('success', "classe assigné avec succès ");
        }
        else
        {
            return redirect()->back()->with('error','Cette a déjà été assigné à cet enseignant veuillez choisir une autre classe ou un autre enseignant');
        }
    }


    public function edit($id)
    {

        $getRecord = ClassTeacherModel::getSingle($id);
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if (!empty($getRecord))
         {
            $data['getRecord']= $getRecord;
            $data['getAssignTeacherID'] =ClassTeacherModel::getAssignTeacherID($getRecord->class_id);
            if($progressYear == "0")
            {
                $data['getClass'] = ClassModel::getProgressYearClass();
                $data['getTeacher'] = User::getProgressYearTeacher();
            }
            else
            {
                $data['getClass'] = ClassModel::getClass($activeYear);
                $data['getTeacher'] = User::getTeacher($activeYear);
            }
            
            $data['header_title'] = "Modifier| Classes-Enseignants";

        return view('admin.class_teacher.edit', $data);
        }

        else
        {
            abort(404);
        }
    }

    public function update(Request $request)
    {
        ClassTeacherModel::deleteTeacher($request->class_id);
        $activeYear = SchoolYear::getActiveYear()->id;
            if(!empty($request->teacher_id))
            {
            foreach($request->teacher_id as $teacher_id)
            {
                $getAlreadyFirst= ClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id,$activeYear);

                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                    
                }
                else
                {         
                    $save = new ClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

              
            }

        }

         return redirect('admin/class_teacher/list')->with('success', "Enseignant assignée avec succès ");
    }

    public function delete($id)
    {
        $save = ClassTeacherModel::getSingle($id);
        $save ->is_deleted = 1;
        $save->save();


        return redirect()->back()->with('success', 'suppression réussie');
    }

    public function edit_single($id)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $getRecord = ClassTeacherModel::getSingle($id);
        $progressYear = SchoolYear::getActiveYear()->inProgress; 
        if (!empty($getRecord))
         {
            $data['getRecord']= $getRecord;
            if($progressYear == "0")
            {
                $data['getClass'] = ClassModel::getProgressYearClass();
                $data['getTeacher'] = User::getProgressYearTeacher();
            }
            else
            {
                $data['getClass'] = ClassModel::getClass($activeYear);
                $data['getTeacher'] = User::getTeacher($activeYear);
            }
            $data['header_title'] = "Modifier| Classes-Cours";
            return view('admin.class_teacher.edit_single', $data);
        }

        else
        {
            abort(404);
        }
    }


    public function update_single($id,Request $request)
    {
            
            $getAlreadyFirst= ClassTeacherModel::getAlreadyFirst($request->class_id, $request->teacher_id);
            if (!empty($getAlreadyFirst)) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
                return redirect('admin/class_teacher/list')->with('success', "Status modifié avec succès ");
            }
            else
            {     
                $save = ClassTeacherModel::getSingle($id);
                $save->class_id = $request->class_id;
                $save->teacher_id = $request->teacher_id;
                $save->status = $request->status;
                $save->save();
            }
         return redirect('admin/class_teacher/list')->with('success', "Modification réussie");
    }

    public function myClassCourse()
    {
        $data['getRecord'] = CourseTeacherModel::getCoursesForTeacher(Auth::user()->id);
        $data['header_title'] = "Classes & Cours";
        return view('teacher.my_class_course',$data);
    }
}
