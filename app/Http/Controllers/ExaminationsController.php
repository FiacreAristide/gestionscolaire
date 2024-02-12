<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamModel;
use Auth;
use App\Models\ClassModel;
use App\Models\ClassCourseModel;
use App\Models\ExamCalendarModel;
use App\Models\ClassTeacherModel;
use App\Models\User;

class ExaminationsController extends Controller
{
    public function examList()
    {
        $data['getRecord']  = ExamModel::getRecord(); 
        $data['header_title'] = "Examens";
        return view('admin.examinations.exam.list',$data);
    }

    public function examAdd()
    {
        $data['header_title'] = "Nouvel examen";
        return view('admin.examinations.exam.add',$data);
    }

    public function examInsert(Request $request)
    {
       $exam = new ExamModel;
       $exam->name = trim($request->name);
       $exam->note = trim($request->note);
       $exam->created_by = Auth::user()->id;
       $exam->save();

       return redirect('admin/examinations/exam/list')->with('success', 'examen crée avec succès');
    }

    public function examEdit($id)
    {
        $data['getRecord']  = ExamModel::getSingle($id);
        if (!empty($data['getRecord'])) 
        {
            $data['header_title'] = "Modifier| examen";
            return view('admin.examinations.exam.edit',$data);

        } else {
           abort(404);
        } 
    }
    

    public function examUpdate($id,Request $request)
    {
       $exam = ExamModel::getSingle($id);
       $exam->name = trim($request->name);
       $exam->note = trim($request->note);
       $exam->save();

       return redirect('admin/examinations/exam/list')->with('success', 'examen modifié avec succès');
    }

    public function examDelete($id)
    {
        $getRecord  = ExamModel::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_deleted = 1;
            $getRecord->save();
            return redirect()->back()->with('success','examen supprimé avec succcès');

        } else
        {
           abort(404);
        }
    }

    public function examCalendar(Request $request)
    {

        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
        $result = array();

        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $getMyCourse = ClassCourseModel::getMyCourse($request->get('class_id'));
            foreach ($getMyCourse as $value)
            {
                $dataS = array();
                $dataS['course_id'] = $value->course_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['course_name'] = $value->course_name;
                $dataS['course_type'] = $value->course_type;

                $examCalendar =ExamCalendarModel::getRecordSingle($request->get('exam_id'),$request->get('class_id'),$value->course_id);

                if(!empty($examCalendar))
                {
                    $dataS['exam_date'] = $examCalendar->exam_date;
                    $dataS['start_time'] = $examCalendar->start_time;
                    $dataS['end_time'] = $examCalendar->end_time;
                    $dataS['room_number'] = $examCalendar->room_number;
                    $dataS['full_mark'] = $examCalendar->full_mark;
                    $dataS['passing_mark'] = $examCalendar->passing_mark;
                }else
                {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['passing_mark'] = '';
                }
                $result[]= $dataS;
            }
        }


        $data['getRecord'] = $result;

        $data['header_title'] = "Calendrier";
        return view('admin.examinations.exam_calendar',$data);
    }

    public function examCalendarInsert(Request $request)
    {
        ExamCalendarModel::deleteRecord($request->exam_id,$request->class_id);

        if(!empty($request->calendar))
        {
            foreach($request->calendar as $calendar)
            {

              if (!empty($calendar['course_id']) && !empty($calendar['exam_date'])  && !empty($calendar['start_time'])  && !empty($calendar['end_time']) && !empty($calendar['room_number']) && !empty($calendar['full_mark']) && !empty($calendar['passing_mark']))
                {
                  $exam = new ExamCalendarModel;
                  $exam->exam_id = $request->exam_id ; 
                  $exam->class_id = $request->class_id ; 
                  $exam->course_id = $calendar['course_id'] ; 
                  $exam->exam_date = $calendar['exam_date'] ; 
                  $exam->start_time = $calendar['start_time'] ; 
                  $exam->end_time = $calendar['end_time'] ; 
                  $exam->room_number = $calendar['room_number'] ; 
                  $exam->full_mark = $calendar['full_mark'] ; 
                  $exam->passing_mark = $calendar['passing_mark'] ; 
                  $exam->created_by = Auth::user()->id;
                  $exam->save();
                }      
                  
            }
        }

        return redirect()->back()->with('success','calendrier ajouter avec succès');
    }

    // student side

    public function myExamTimetable()
    {
        $class_id = Auth::user()->class_id;
        $getExam = ExamCalendarModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] =$value->exam_name; 
            $getExamTimetable = ExamCalendarModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS)
            {
               $dataS = array();
               $dataS['course_name'] = $valueS->course_name;
               $dataS['exam_date'] = $valueS->exam_date;
               $dataS['start_time'] = $valueS->start_time;
               $dataS['end_time'] = $valueS->end_time;
               $dataS['room_number'] = $valueS->room_number;
               $dataS['full_mark'] = $valueS->full_mark;
               $dataS['passing_mark'] = $valueS->passing_mark;
               $resultS[] = $dataS;
            }

            $dataE['exam'] = $resultS;
            $result[] = $dataE;

        }

        $data['getRecord'] = $result;
        $data['header_title'] = "Calendrier| Examens";
        return view('student.my_exam_timetable',$data);
    }

    //Teacher side

    public function myExamTimetableTeacher()
    {

        $result = array();
        $getClass = ClassTeacherModel::getMyClassCourseGroup(Auth::user()->id);

        foreach($getClass as $class)
        {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;
            $getExam = ExamCalendarModel::getExam($class->class_id);
            $examArray = array();
            foreach($getExam as $exam)
            {
                $dataE = array();
                $dataE['exam_name'] = $exam->exam_name;
                $getExamTimetable = ExamCalendarModel::getExamTimetable($exam->exam_id, $class->class_id);
            $courseArray = array();
            foreach ($getExamTimetable as $valueS)
            {
               $dataS = array();
               $dataS['course_name'] = $valueS->course_name;
               $dataS['exam_date'] = $valueS->exam_date;
               $dataS['start_time'] = $valueS->start_time;
               $dataS['end_time'] = $valueS->end_time;
               $dataS['room_number'] = $valueS->room_number;
               $dataS['full_mark'] = $valueS->full_mark;
               $dataS['passing_mark'] = $valueS->passing_mark;
               $courseArray[] = $dataS;
            }

                $dataE['course'] = $courseArray;
                $examArray[]= $dataE;

            }
            $dataC['exam'] = $examArray;
            
            $result[] = $dataC;
        }

       $data['getRecord'] = $result;

        $data['header_title'] = "Calendrier| Examens";
        return view('teacher.my_exam_timetable',$data);
    }



    //parent side

    public function myStudentExamTimetable($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $class_id = $getStudent->class_id;
        $getExam = ExamCalendarModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] =$value->exam_name; 
            $getExamTimetable = ExamCalendarModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS)
            {
               $dataS = array();
               $dataS['course_name'] = $valueS->course_name;
               $dataS['exam_date'] = $valueS->exam_date;
               $dataS['start_time'] = $valueS->start_time;
               $dataS['end_time'] = $valueS->end_time;
               $dataS['room_number'] = $valueS->room_number;
               $dataS['full_mark'] = $valueS->full_mark;
               $dataS['passing_mark'] = $valueS->passing_mark;
               $resultS[] = $dataS;
            }

            $dataE['exam'] = $resultS;
            $result[] = $dataE;

        }

        $data['getStudent'] = $getStudent;
        $data['getRecord'] = $result;
        $data['header_title'] = "Calendrier| Examens";
        return view('parent.my_student_exam_timetable',$data);
    }
}
