<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassTeacherModel;
use Illuminate\Http\Request;
use App\Models\CourseTeacherModel;
use App\Models\CourseModel;
use App\Models\SchoolYear;
use App\Models\User;
use Auth;

class CourseTeacherController extends Controller
{
    public function list()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $data['getRecord'] = CourseTeacherModel::getRecord($activeYear);
        $data['header_title'] = "Liste| Cours & profs";
        return view('admin.course_teacher.list', $data);
    }


    public function add()
    {    
        $activeYear = SchoolYear::getActiveYear()->id;
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        $data['getClass'] = ClassModel::getClass($activeYear);
        $data['getCourse'] = CourseModel::getCourse($activeYear);
        $data['getTeacher'] = User::getTeacher($activeYear);
        $data['header_title'] = "Assigner| Cours-Enseignants";
        return view('admin.course_teacher.add', $data);
    }
    public function insert(Request $request)
    {
        if(!empty($request->course_id)){
            foreach($request->course_id as $course_id)
            {
                $getAlreadyFirst= CourseTeacherModel::getAlreadyFirst($request->teacher_id, $course_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();    
                }
                else
                {         
                    $save = new CourseTeacherModel;
                    $save->school_year_id = $request->school_year_id;
                    $save->teacher_id = $request->teacher_id;
                    $save->course_id = $course_id;
                    $save->class_id = $request->class_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

            }

            return redirect('admin/course_teacher/list')->with('success', "cours assigné avec succès ");
        }
        else
        {
            return redirect()->back()->with('error','Ce cours a déjà été assigné à cet enseignant veuillez choisir un autre cours ou un autre enseignant');
        }
    }

    public function delete($id)
    {
        $save = CourseTeacherModel::getSingle($id);
        $save ->is_deleted = 1;
        $save->save();
        return redirect()->back()->with('success', 'suppression réussie');
    }

    public function edit($id)
    {
        $getRecord = CourseTeacherModel::getSingle($id);
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        $data['getAssignCourseID'] =CourseTeacherModel::getAssignTeacherID($getRecord->course_id);
        $activeYear = SchoolYear::getActiveYear()->id;
        if (!empty($getRecord))
        {
            $data['getRecord']= $getRecord;
            $data['getClass'] = ClassModel::getClass($activeYear);
            $data['getCourse'] = CourseModel::getCourse($activeYear);
            $data['getTeacher'] = User::getTeacher($activeYear);
            $data['header_title'] = "Modifier| Classes-Cours";
            return view('admin.course_teacher.edit_single', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id,Request $request)
    {
            CourseTeacherModel::deleteTeacher($request->teacher_id);
            if(!empty($request->course_id))
            {
            foreach($request->course_id as $course_id)
            {
                $getAlreadyFirst= CourseTeacherModel::getAlreadyFirst($request->teacher_id, $request->course_id);
            if (!empty($getAlreadyFirst)) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
                return redirect('admin/course_teacher/list')->with('success', "Status modifié avec succès ");
            }
            else
            {     
                $save = new CourseTeacherModel;
                $save->teacher_id = $request->teacher_id;
                $save->course_id = $request->course_id;
                $save->school_year_id = $request->school_year_id;
                $save->created_by = Auth::user()->id;
                $save->status = $request->status;
                $save->save();
            }
          }
        }
         return redirect('admin/course_teacher/list')->with('success', "modification réussie");
    }
}
