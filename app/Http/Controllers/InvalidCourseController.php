<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\InvalidCourseModel;
use App\Models\CourseModel;

class InvalidCourseController extends Controller
{
    public function add()
    {
        $id = Auth::user()->id;
        $data['getOthersCourses'] = CourseModel::getOthersCourses($id);
        $data['header_title'] = "Ajouter un nouveau Cours";
        return view('student.add_new_course', $data);
    }

    public function insert(Request $request)
    {
    $student_id = Auth::user()->id;
    $courses = $request->input('course');

    foreach ($courses as $course_id) {
        $save = new InvalidCourseModel;
        $save->student_id = $student_id;
        $save->course_id = $course_id;
        $save->class_id = Auth::user()->class_id;
        $save->save();
    }

    return redirect('student/my_subject')->with('success', "Cours ajouté avec succès");
}


    // public function insert(Request $request)
    // {
    //    $save = new InvalidCourseModel;
    //    $save->student_id = Auth::user()->id;
    //    $save->course_id = $request->course_id;
    //    $save->save();

    //    return redirect('student/my_subject')->with('success', "Cours ajouter avec succès");
    // }
}
