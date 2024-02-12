<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\CourseModel;
use App\Models\ClassCourseModel;
use App\Models\WeekModel;
use App\Models\ClassCourseTimetableModel;
use App\Models\User;
use Auth;



class ClassTimetableController extends Controller
{
    public function list(Request $request)
    {
        $data['header_title'] = "Horaires";
        $data['getClass'] = ClassModel::getClass();

        if(!empty($request->course_id))
        {
        $data['getCourse'] = ClassCourseModel::getMyCourse($request->class_id);
        }

        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach($getWeek as $value)
        {
            $dataW = array();
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;

            if(!empty($request->class_id) && !empty($request->course_id))
            {
                $classCourse = ClassCourseTimetableModel::getRecordClassCourse($request->class_id,$request->course_id,$value->id);
                if(!empty($classCourse))
                {
                    $dataW['start_time'] = $classCourse->start_time;
                    $dataW['end_time'] = $classCourse->end_time;
                    $dataW['room_number'] = $classCourse->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
            }
            else
            {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }

            $week[] = $dataW;
        }

        $data['week'] = $week;
        return view('admin.class_timetable.list', $data);
    }

    public function get_course(Request $request)
    {
       $getCourse = ClassCourseModel::getMyCourse($request->class_id);
       $html = "<option value=''>Selectionner cours</option>";
       foreach($getCourse as $value)
       {
         $html .="<option value='".$value->course_id."'>".$value->course_name."</option>";
       }

       $json['html'] = $html;
       echo json_encode($json);
    }        
        
    public function insert_update(Request $request)
    {
        ClassCourseTimetableModel::where('class_id','=',$request->class_id)->where('course_id','=',$request->course_id)->delete();
        foreach($request->timetable as $timetable)
        {
            if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']))
            {
                $save = new ClassCourseTimetableModel;
                $save->class_id = $request->class_id;
                $save->course_id = $request->course_id;
                $save->week_id = $timetable['week_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->room_number = $timetable['room_number'];
                $save->save();

            }
        }


        return redirect()->back()->with('success',"Emploi du temps enregistré avec succès");
    }

    //Student side

    public function myTimetable()
    {
        $result = array();
       
        $getRecord = ClassCourseModel::getMyCourse(Auth::user()->class_id);

        foreach($getRecord as $value)
        {
            $dataS['name'] = $value->course_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $valueW)
            {

                $dataW = array();
                $dataW['week_id'] = $valueW->id;
                $dataW['week_name'] = $valueW->name;
                $classCourse = ClassCourseTimetableModel::getRecordClassCourse($value->class_id,$value->course_id,$valueW->id);
                if(!empty($classCourse))
                {
                    $dataW['start_time'] = $classCourse->start_time;
                    $dataW['end_time'] = $classCourse->end_time;
                    $dataW['room_number'] = $classCourse->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
                $week[] = $dataW;
            }

            $dataS['week'] = $week;
            $result[] = $dataS;
        }


        $data['getRecord'] = $result;

        $data['header_title'] = "Mes horaires";
        return view('student.my_timetable', $data);


    }

    //teacher side

    public function myClassTimetable($class_id,$course_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id) ;
        $data['getCourse'] = CourseModel::getSingle($course_id) ;


            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $valueW)
            {

                $dataW = array();
               
                $dataW['week_name'] = $valueW->name;
                $classCourse = ClassCourseTimetableModel::getRecordClassCourse($class_id,$course_id,$valueW->id);
                if(!empty($classCourse))
                {
                    $dataW['start_time'] = $classCourse->start_time;
                    $dataW['end_time'] = $classCourse->end_time;
                    $dataW['room_number'] = $classCourse->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
                 $result[] = $dataW;
            }

        $data['getRecord'] = $result;

        $data['header_title'] = "Mes horaires";
        return view('teacher.my_timetable', $data);
    }


    public function myStudentTimetable($class_id, $course_id, $student_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getCourse'] = CourseModel::getSingle($course_id);
        $data['getStudent'] = User::getSingle($student_id);

        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach($getWeek as $valueW)
        {
            $dataW = array();
       
            $dataW['week_name'] = $valueW->name;
            $classCourse = ClassCourseTimetableModel::getRecordClassCourse($class_id,$course_id,$valueW->id);
                if(!empty($classCourse))
                {
                    $dataW['start_time'] = $classCourse->start_time;
                    $dataW['end_time'] = $classCourse->end_time;
                    $dataW['room_number'] = $classCourse->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
                 $result[] = $dataW;
            }

        $data['getRecord'] = $result;

        $data['header_title'] = "Horaires";
        return view('parent.my_student_timetable', $data);
    }


}
