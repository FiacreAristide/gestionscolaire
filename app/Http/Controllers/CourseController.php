<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CourseModel;
use App\Models\ClassCourseModel;
use App\Models\User;
use App\Models\InvalidCourseModel;

class CourseController extends Controller
{
    public function list()
    {
        $data['getRecord'] = CourseModel::getRecord();
        $data['header_title'] = "Liste| Cours";
       return view('admin.course.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Ajouter un Cours";
        return view('admin.course.add', $data);
    }

    public function insert(Request $request)
    {
       $save = new CourseModel;
       $save->code_ue = trim($request->code_ue);
       $save->name = trim($request->name);
       $save->type = trim($request->type);
       $save->status = $request->status;
       $save->created_by = Auth::user()->id;
       $save->save();

       return redirect('admin/course/list')->with('success', "Cours crée avec succès");

    }

    public function edit($id)
    {
        $data['getRecord'] = CourseModel::getSingle($id);

        if(!empty($data['getRecord'])){
            $data['header_title'] = "Modifier| Cours";
        return view('admin.course.edit', $data);
        }
        else
        {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        $save = CourseModel::getSingle($id);
        $save->code_ue = $request->code_ue;
        $save->name = $request->name;
        $save->type = $request->type;
        $save->status = $request->status;
        $save->save();

        return redirect('admin/course/list')->with('success', "Cours modifié avec succès");
    }

    public function delete($id)
    {
        $save = CourseModel::getSingle($id);
        $save->is_deleted = 1;
        $save->save();

        return redirect()->back()->with('success', "Cours supprimé avec succès");
    }



    // Student side
    public function myCourse()
    {
        $data['getRecord'] = ClassCourseModel::getMyCourse(Auth::user()->class_id);
        $data['getInvalidCourse'] = InvalidCourseModel::getInvalidCourse(Auth::user()->id);
        $data['header_title'] = "Mes cours";
        return view('student.my_subject', $data);
    }



    //Parent side
    public function myStudentCourse($student_id)
    {
        $user = User::getSingle($student_id);
        $data['getUser'] = $user;

        $data['getRecord'] = ClassCourseModel::getMyCourse($user->class_id);
        $data['getInvalidCourse'] = InvalidCourseModel::getInvalidCourse($student_id);
        $data['header_title'] = "Cours";
       return view('parent.my_student_subject', $data);
    }
}
