<?php

namespace App\Http\Controllers;

use App\Models\SelectedCoursesModel;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class SelectedCoursesPrintController extends Controller
{
    public function myCourseList()
    {
        $data['getCourses'] = SelectedCoursesModel::getMyCourses(Auth::user()->id);
        // $pdf = PDF::loadView('student.my_courses_list_print', $data);
        // return $pdf->download('my_courses_list_print.pdf');
    }
}
