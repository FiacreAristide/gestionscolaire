<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassTeacherModel;
use App\Models\SchoolYear;
use App\Models\StudentAttendanceModel;
use App\Models\StudentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function studentAttendance(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getClass'] = ClassModel::getProgressYearClass();
            if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
            {
                $data['getStudent'] = StudentModel::getProgressYearStudentClass($request->get('class_id'));
            }
        }
        else
        {
            $data['getClass'] = ClassModel::getClass($activeYear);
            if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
            {
                $data['getStudent'] = StudentModel::getStudentClass($request->get('class_id'),$activeYear);
            }
        }
        $data['header_title']= "Présence";
        return view('admin.attendance.student',$data); 
    }

    public function studentAttendanceSubmit(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $check_attendance = StudentAttendanceModel::checkAlreadyAttendance($request->student_id, $request->class_id, $request->attendance_date,$activeYear);
        if(!empty($check_attendance))
        {
            $attendance = $check_attendance;
        }
        else
        {
            $activeYear = SchoolYear::getActiveYear()->id;
            $attendance = new StudentAttendanceModel;
            $attendance->school_year_id = $activeYear;
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
        }

        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        $json['message']= "Opération effectuée avec succès";
        echo json_encode($json);
    }

    public function studentAttendanceReport(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getClass'] = ClassModel::getProgressYearClass();
            $data['getRecord'] = StudentAttendanceModel::getProgressYearRecord();
        }
        else
        {
            $data['getClass'] = ClassModel::getClass($activeYear);
            $data['getRecord'] = StudentAttendanceModel::getRecord($activeYear);
        }
        $data['header_title']= "Liste de présence";
        return view('admin.attendance.report',$data); 
    }

    //teacher side

    public function teacherAttendance(Request $request)
    {   
       $data['getClass'] = ClassTeacherModel::getMyClassCourseGroup(Auth::user()->id);
        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
        {
            $activeYear = SchoolYear::getActiveYear()->id;
            $data['getStudent'] = StudentModel::getStudentClass($request->get('class_id'),$activeYear);
        }

        $data['header_title']= "Présence";
        return view('teacher.attendance.student',$data);  
    }

    public function teacherAttendanceSubmit(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $check_attendance = StudentAttendanceModel::checkAlreadyAttendance($request->student_id, $request->class_id, $request->attendance_date,$activeYear);
        if(!empty($check_attendance))
        {
            $attendance = $check_attendance;
        }
        else
        {
            $activeYear = SchoolYear::getActiveYear()->id;
            $attendance = new StudentAttendanceModel;
            $attendance->school_year_id = $activeYear;
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
        }

        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        $json['message']= "Opération effectuée avec succès";
        echo json_encode($json);
    }

    public function teacherAttendanceReport(Request $request)
    {
        $getClass = ClassTeacherModel::getMyClassCourseGroup(Auth::user()->id);
        $classArray = array();

        foreach($getClass as $class)
        {
            $classArray[] = $class->class_id;

        }
        $data['getClass'] = $getClass;
        $data['getRecord'] = StudentAttendanceModel::getRecordTeacher($classArray);
        //dd($data['getRecord']);
        $data['header_title']= "Liste de présence";
        return view('teacher.attendance.report',$data); 
    }

}
