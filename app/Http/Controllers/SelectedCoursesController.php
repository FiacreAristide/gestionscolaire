<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassCourseModel;
use App\Models\CourseModel;
use App\Models\SelectedCoursesModel;
use App\Models\StudentModel;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;

class SelectedCoursesController extends Controller
{
   public function myCourseList()
{
    $userId = Auth::user()->id;
    $selectedCourses = SelectedCoursesModel::getMyCourses($userId);
    if ($selectedCourses->isEmpty()) {
        return redirect()->back()->with('error', 'Veuillez sélectionner au moins une UE avant de voir vos UEs.');
    }
    $data['header_title'] = "Mes UEs";
    $data['getCourses'] = $selectedCourses;
    return view('student.my_courses_list_print', $data);
}


    // public function generatePDF()
    // {
    // $data['getCourses'] = SelectedCoursesModel::getMyCourses(Auth::user()->id);

    // $pdf = PDF::loadView('student.my_courses_list_print', $data);

    // return $pdf->download('mes_ues.pdf');
    // }


    public function add()
    {     
        $data['header_title'] = "Choix UEs";
        return view('student.my_courses', $data);
    }
    
    public function insert(Request $request)
    {
    $student_id = Auth::user()->id;
    //$courses = $request->input('selected_courses');

    foreach ($request->course_id as $course_id) {
        $save = new SelectedCoursesModel;
        $save->student_id = $student_id;
        $save->course_id = $course_id;
        $save->class_id = StudentModel::where('user_id', Auth::id())->value('class_id');
        $save->save();
    }
    return redirect('student/my_courses')->with('success', "Cours ajouté avec succès");
    }


    public function myAllCourses()
    {
        $domainId = StudentModel::where('user_id', Auth::id())->value('domain_id');
        $SubjectId = StudentModel::where('user_id', Auth::id())->value('subject_id');
        $school_year = Auth::user()->school_year_id;
        //$data['getRecord'] = ClassCourseModel::getMyCourseByDomain($domainId,$SubjectId);
        $data['getRecord'] = CourseModel::getMyCourseByDomain($domainId,$SubjectId,$school_year);
        //dd($data['getRecord']);
        $data['header_title'] = "Mes cours";
        return view('student.my_courses', $data);
    }


    public function myCourse()
    {
        $data['getRecord'] = SelectedCoursesModel::getMyCourse(Auth::user()->id);
        //dd($data['getRecord']);
        $data['header_title'] = "Mes cours";
        return view('student.my_subject', $data);
    }
}
