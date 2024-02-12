<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassCourseModel;
use App\Models\CourseModel;

use Auth;

class ClassCourseController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = ClassCourseModel::getRecord();
        $data['header_title'] = "Liste| Classes & Cours";
        return view('admin.class_course.list', $data);
    }

    
    public function add(Request $request)
    {
        
        $data['getClass'] = ClassModel::getClass();
        $data['getCourse'] = CourseModel::getCourse();
        $data['header_title'] = "Assigner| Classes-Cours";

        return view('admin.class_course.add', $data);
    }

    public function insert(Request $request)
    {
        if(!empty($request->course_id)){
            foreach($request->course_id as $course_id)
            {
                $getAlreadyFirst= ClassCourseModel::getAlreadyFirst($request->class_id, $course_id);

                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                    
                }
                else
                {         
                    $save = new ClassCourseModel;
                    $save->class_id = $request->class_id;
                    $save->course_id = $course_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

              
            }

            return redirect('admin/class_course/list')->with('success', "cours assigné avec succès ");
        }
        else
        {
            return redirect()->back()->with('error','Ce cours a déjà été assigné à cette classe, veuillez choisir un autre cours ou une autre classe');
        }
    }


    public function edit($id)
    {

        $getRecord = ClassCourseModel::getSingle($id);

        if (!empty($getRecord))
         {
            $data['getRecord']= $getRecord;
            $data['getAssignCourseID'] =ClassCourseModel::getAssignCourseID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getCourse'] = CourseModel::getCourse();
            $data['header_title'] = "Modifier| Classes-Cours";

        return view('admin.class_course.edit', $data);
        }

        else
        {
            abort(404);
        }
    }

    public function update(Request $request)
    {
        ClassCourseModel::deleteCourse($request->class_id);

            if(!empty($request->course_id))
            {
            foreach($request->course_id as $course_id)
            {
                $getAlreadyFirst= ClassCourseModel::getAlreadyFirst($request->class_id, $course_id);

                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                    
                }
                else
                {         
                    $save = new ClassCourseModel;
                    $save->class_id = $request->class_id;
                    $save->course_id = $course_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

              
            }

        }

         return redirect('admin/class_course/list')->with('success', "Cours assigné avec succès ");
    }

    public function delete($id)
    {
        $save = ClassCourseModel::getSingle($id);
        $save ->is_deleted = 1;
        $save->save();


        return redirect()->back()->with('success', 'suppression réussie');
    }

    public function edit_single($id)
    {
        $getRecord = ClassCourseModel::getSingle($id);

        if (!empty($getRecord))
         {
            $data['getRecord']= $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getCourse'] = CourseModel::getCourse();
            $data['header_title'] = "Modifier| Classes-Cours";

        return view('admin.class_course.edit_single', $data);
        }

        else
        {
            abort(404);
        }
    }


    public function update_single($id,Request $request)
    {
            
            $getAlreadyFirst= ClassCourseModel::getAlreadyFirst($request->class_id, $request->course_id);

            if (!empty($getAlreadyFirst)) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();

                return redirect('admin/class_course/list')->with('success', "Status modifié avec succès ");

            }
            else
            {     

                $save = ClassCourseModel::getSingle($id);
                $save->class_id = $request->class_id;
                $save->course_id = $request->course_id;
                $save->status = $request->status;
                $save->save();
            }

         return redirect('admin/class_course/list')->with('success', "Spécialité modifiée avec succès");
    }
}
