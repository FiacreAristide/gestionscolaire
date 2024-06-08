<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamModel;
use Auth;
use App\Models\ClassModel;
use App\Models\ClassCourseModel;
use App\Models\ExamCalendarModel;
use App\Models\ClassTeacherModel;
use App\Models\CourseModel;
use App\Models\CourseTeacherModel;
use App\Models\User;
use App\Models\MarkRegisterModel;
use App\Models\SchoolYear;
use App\Models\SelectedCoursesModel;
use App\Models\StudentModel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;


class ExaminationsController extends Controller
{
    public function examList()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getRecord']  = ExamModel::getProgressYearRecord();
        }
        else
        {
            $data['getRecord']  = ExamModel::getRecord($activeYear);
        }
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
       $activeYear = SchoolYear::getActiveYear()->id;
       $exam = new ExamModel;
       $exam->school_year_id = $activeYear;
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
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getClass'] = ClassModel::getProgressYearClass();
            $data['getExam'] = ExamModel::getProgressYearExam();
        }
        else
        {
            $data['getClass'] = ClassModel::getClass($activeYear);
            $data['getExam'] = ExamModel::getExam($activeYear);
        }
        $result = array();
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $getMyCourse = ClassCourseModel::getMyCourse($request->get('class_id'),$activeYear);
            foreach ($getMyCourse as $value)
            {
                $dataS = array();
                $dataS['course_id'] = $value->course_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['course_name'] = $value->course_name;
                $dataS['course_type'] = $value->course_type;
                $examCalendar = ExamCalendarModel::getRecordSingle($request->get('exam_id'),$request->get('class_id'),$value->course_id,$activeYear);

                if(!empty($examCalendar))
                {
                    $dataS['exam_date'] = $examCalendar->exam_date;
                    $dataS['start_time'] = $examCalendar->start_time;
                    $dataS['end_time'] = $examCalendar->end_time;
                    $dataS['room_number'] = $examCalendar->room_number;
                    $dataS['full_mark'] = $examCalendar->full_mark;
                    $dataS['passing_mark'] = $examCalendar->passing_mark;
                }
                else
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
        $activeYear = SchoolYear::getActiveYear()->id;
        ExamCalendarModel::deleteRecord($request->exam_id,$request->class_id,$activeYear);
        if(!empty($request->calendar))
        {
            foreach($request->calendar as $calendar)
            {
              if (!empty($calendar['course_id']) && !empty($calendar['exam_date'])  && !empty($calendar['start_time'])  && !empty($calendar['end_time']) && !empty($calendar['room_number']) && !empty($calendar['full_mark']) && !empty($calendar['passing_mark']))
                {
                  $activeYear = SchoolYear::getActiveYear()->id;
                  $exam = new ExamCalendarModel;
                  $exam->school_year_id = $activeYear;
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

//     public function myExamTimetable()
// {
//     $activeYear = SchoolYear::getActiveYear()->id;
//     $student_id = Auth::id();

//     // Récupérer les cours de l'étudiant à partir de la table selected_course
    
//     $selected_courses = SelectedCoursesModel::where('student_id', $student_id)
//         ->leftJoin('exam_calendar', 'selected_course.course_id', '=', 'exam_calendar.course_id')
//         ->select('exam_calendar.*')
//         ->get();

//     $result = array();

//     foreach ($selected_courses as $value) {
//         $dataE = array();
//         $dataE['name'] = $value->exam_name; 
//         $getExamTimetable = ExamCalendarModel::getExamTimetable($value->exam_id, $value->class_id, $activeYear);
//         $resultS = array();

//         foreach ($getExamTimetable as $valueS) {
//            $dataS = array();
//            $dataS['course_name'] = $valueS->course_name;
//            $dataS['exam_date'] = $valueS->exam_date;
//            $dataS['start_time'] = $valueS->start_time;
//            $dataS['end_time'] = $valueS->end_time;
//            $dataS['room_number'] = $valueS->room_number;
//            $dataS['full_mark'] = $valueS->full_mark;
//            $dataS['passing_mark'] = $valueS->passing_mark;
//            $resultS[] = $dataS;
//         }

//         $dataE['exam'] = $resultS;
//         $result[] = $dataE;
//     }

//     $data['getRecord'] = $result;
//     dd($data['getRecord']);
//     $data['header_title'] = "Calendrier| Examens";
//     return view('student.my_exam_timetable', $data);
// }

// public function myExamTimetable()
// {
//     $activeYear = SchoolYear::getActiveYear()->id;
//     $student_id = Auth::id();

//     // Récupérer tous les cours sélectionnés par l'étudiant
//     $selected_courses = SelectedCoursesModel::where('student_id', $student_id)
//         ->leftJoin('exam_calendar', 'selected_course.course_id', '=', 'exam_calendar.course_id')
//         ->select('exam_calendar.*')
//         ->get();

//     $result = array();

//     foreach ($selected_courses as $value) {
//         $dataE = array();
//         $dataE['name'] = $value->exam_name; 
//         $getExamTimetable = ExamCalendarModel::getExamTimetable($value->exam_id, $value->class_id, $activeYear);
//         $resultS = array();

//         foreach ($getExamTimetable as $valueS) {
//            $dataS = array();
//            $dataS['course_name'] = $valueS->course_name;
//            $dataS['exam_date'] = $valueS->exam_date;
//            $dataS['start_time'] = $valueS->start_time;
//            $dataS['end_time'] = $valueS->end_time;
//            $dataS['room_number'] = $valueS->room_number;
//            $dataS['full_mark'] = $valueS->full_mark;
//            $dataS['passing_mark'] = $valueS->passing_mark;
//            $resultS[] = $dataS;
//         }

//         $dataE['exam'] = $resultS;
//         $result[] = $dataE;
//     }

//     $data['getRecord'] = $result;
//     $data['header_title'] = "Calendrier| Examens";
//     return view('student.my_exam_timetable', $data);
// }





    public function myExamTimetable()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $class_id = StudentModel::where('user_id', Auth::id())->value('class_id');
        $getExam = ExamCalendarModel::getExam($class_id,$activeYear);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] =$value->exam_name; 
            $getExamTimetable = ExamCalendarModel::getExamTimetable($value->exam_id, $class_id,$activeYear);
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
        $getClass = CourseTeacherModel::getMyClassCourseGroup(Auth::user()->id);

        foreach($getClass as $class)
        {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;
            $activeYear = SchoolYear::getActiveYear()->id;
            $getExam = ExamCalendarModel::getExam($class->class_id,$activeYear);
            $examArray = array();
            foreach($getExam as $exam)
            {
                $dataE = array();
                $dataE['exam_name'] = $exam->exam_name;
                $getExamTimetable = ExamCalendarModel::getExamTimetable($exam->exam_id, $class->class_id,$activeYear);
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


//     public function examRegister(Request $request)
// {
//     $activeYear = SchoolYear::getActiveYear()->id;
//     $data['getClass'] = ClassModel::getClass($activeYear);
//     $data['getExam'] = ExamModel::getExam($activeYear);

//     // Récupérer les cours associés à la classe de l'étudiant
//     if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
//     {
//         $class_id = $request->get('class_id');
//         $exam_id = $request->get('exam_id');
//         $data['getCourse'] = ExamCalendarModel::getCourse($exam_id, $class_id, $activeYear);

//         // Récupérer les cours sélectionnés par l'étudiant
//         $selected_courses = SelectedCoursesModel::where('student_id', Auth::id())->pluck('course_id')->toArray();

//         // Récupérer les cours supplémentaires non associés à la classe de l'étudiant
//         $additional_courses = SelectedCoursesModel::where('student_id', Auth::id())
//             ->whereNotIn('course_id', function($query) use ($class_id) {
//                 $query->select('course_id')->from('exam_calendar')->where('class_id', $class_id);
//             })
//             ->pluck('course_id')
//             ->toArray();

//         // Fusionner les cours associés à la classe et les cours supplémentaires
//         $courses = array_merge($selected_courses, $additional_courses);

//         // Récupérer les détails des cours à partir de leurs IDs
//         $additional_courses_details = CourseModel::whereIn('id', $courses)->get();

//         // Fusionner les cours associés à la classe et les cours supplémentaires dans un seul tableau
//         $data['additional_courses'] = $additional_courses_details->merge($data['getCourse']);

//         // Récupérer les étudiants de la classe
//         $data['getStudent'] = StudentModel::getStudentClass($class_id, $activeYear);
//     }

//     $data['header_title'] = "NotesM";
//     return view('admin.examinations.register', $data);
// }

    public function examRegister(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $data['getClass'] = ClassModel::getClass($activeYear);
        $data['getExam'] = ExamModel::getExam($activeYear);
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $data['getCourse'] = ExamCalendarModel::getCourse($request->get('exam_id'),$request->get('class_id'),$activeYear);
            $data['getStudent'] = StudentModel::getStudentClass($request->get('class_id'),$activeYear);
        }
        $data['header_title'] = "Notes|Normale";
        return view('admin.examinations.register',$data);
    }

    public function examMakeUpRegister(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $data['getClass'] = ClassModel::getClass($activeYear);
        $data['getExam'] = ExamModel::getExam($activeYear);

        if (!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
        $data['getStudent'] = StudentModel::getStudentWhoMissedCourse($request->get('class_id'), $activeYear);
        // dd($data['getStudent']);
        $studentId = $data['getStudent']->pluck('user_id');

        $coursesByStudent = [];

        foreach ($studentId as $student_id) {
            $coursesByStudent[$student_id] = ExamCalendarModel::getCoursesForRecovery($request->get('exam_id'), $request->get('class_id'), $activeYear, $student_id);
        }

        $data['coursesByStudent'] = $coursesByStudent;
        //dd($data['coursesByStudent']);
    }

        // if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        // {
        //     $data['getStudent'] = StudentModel::getStudentWhoMissedCourse($request->get('class_id'),$activeYear);
        //     //dd($data['getStudent']);
        //     $studentId = $data['getStudent']->pluck('user_id');
        //     dd($studentId);
        //     foreach($studentId as $student_id)
        //     {
        //         $data['getCourse'] = ExamCalendarModel::getCoursesForRecovery($request->get('exam_id'),$request->get('class_id'),$activeYear,$student_id);
        //     }         
        //     //dd($data['getCourse']);
        // }
        $data['header_title'] = "Notes|Rattrapage";
        return view('admin.examinations.makeupregister',$data);
    }



    public function submitRegister(Request $request)
    {
        $validation = 0;
        $activeYear = SchoolYear::getActiveYear()->id;
        if(!empty($request->mark))
        {
            foreach ($request->mark as $mark)
            {
               $getExamSchedule = ExamCalendarModel::getSingle($mark['id']); 
               $note_devoir = !empty($mark['note_devoir']) ? $mark['note_devoir'] : 0;
               $note_exam = !empty($mark['note_exam']) ? $mark['note_exam'] : 0;
               $full_mark = !empty($mark['full_mark']) ? $mark['full_mark'] : 0;
               $passing_mark = !empty($mark['passing_mark']) ? $mark['passing_mark'] : 0;
               $full_mark = $getExamSchedule->full_mark;
               $average = ($note_devoir + $note_exam)/2;
               if($full_mark >= $average)
               {
               $getMark = MarkRegisterModel::checkAlreadyMark($request->student_id,$request->exam_id,$request->class_id, $mark['course_id']);
               if(!empty($getMark))
                {
                    $save = $getMark;
                }
                else
                {
                    $save = new MarkRegisterModel;
                    //Ligne récemment ajoutée
                    $save->school_year_id = $activeYear;
                    $save->created_by = Auth::user()->id;
                }
               //Ligne récemment ajoutée
               $save->school_year_id = $activeYear;
               $save->student_id = $request->student_id;
               $save->exam_id = $request->exam_id;
               $save->class_id = $request->class_id;
               $save->course_id = $mark['course_id'];
               $save->note_devoir = $note_devoir;
               $save->note_exam = $note_exam;
               $save->full_mark = $full_mark;
               $save->passing_mark = $passing_mark;
               $save ->save();
            }
            else
            {
               $validation = 1;
            }

            }
        }

        if($validation == 0)
        {
            $json['message']="notes enregistrée avec succès";
        }
        else
        {
            $json['message']="notes enregistrée! certaines notes sont supérieures à la note totale, veuillez vérifier vos notes";
        }
       
       echo json_encode($json); 
    }


    public function singleSubmitRegister(Request $request)
    {
        $id = $request->id;
        $getExamSchedule = ExamCalendarModel::getSingle($id);
        $full_mark = $getExamSchedule->full_mark;
        $note_devoir = !empty($request->note_devoir) ? $request->note_devoir : 0;
        $note_exam = !empty($request->note_exam) ? $request->note_exam: 0;

        $average = ($note_devoir + $note_exam)/2;

        if($full_mark >= $average)
        {
            $getMark = MarkRegisterModel::checkAlreadyMark($request->student_id,$request->exam_id,$request->class_id, $request->course_id);
        if(!empty($getMark))
        {
            $save = $getMark;
        }
        else
        {
            $save = new MarkRegisterModel;
            $save->created_by = Auth::user()->id;
        }       
            $save->student_id = $request->student_id;
            $save->exam_id = $request->exam_id;
            $save->class_id = $request->class_id;
            $save->course_id = $request->course_id;
            $save->note_devoir = $note_devoir;
            $save->note_exam = $note_exam;
            $save->full_mark = $getExamSchedule->full_mark;
            $save->passing_mark = $getExamSchedule->passing_mark;   
            $save->save();
            $json['message']="note enregistrée avec succès!!";
        }
        else
        {
            $json['message']="Impossible note supérieure à la note totale";
        }
        echo json_encode($json);
    }

    public function teacherRegister(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $data['getClass'] = ClassTeacherModel::getMyClassCourseGroup(Auth::user()->id);
        $data['getExam'] = ExamCalendarModel::getTeacherExam(Auth::user()->id);
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            //$data['getCourse'] = ExamCalendarModel::getCourse($request->get('exam_id'),$request->get('class_id'));
            $data['getCourse'] = ExamCalendarModel::getTeacherCourseOnly($request->get('exam_id'),$request->get('class_id'),Auth::user()->id);
            $data['getStudent'] = StudentModel::getStudentClass($request->get('class_id'),$activeYear);
        }
        $data['header_title'] = "Notes";
        return view('teacher.register',$data);
    }

    //Student side
    public function myExamResult()
    {
        $result = array();
        $getExam = MarkRegisterModel::getExam(Auth::user()->id);
        foreach($getExam as $value)
        {
            
            $dataE = array();
            $dataE['exam_name'] = $value->exam_name;
            $getExamCourse = MarkRegisterModel::getExamCourse($value->exam_id,Auth::user()->id);
            $dataCourse = array();
            foreach($getExamCourse as $exam)
            {
                $average = ($exam['note_devoir'] + $exam['note_exam'])/2;
                $dataS = array();
                $dataS['course_name'] = $exam['course_name'];
                $dataS['note_devoir'] = $exam['note_devoir'];
                $dataS['note_exam'] = $exam['note_exam'];
                $dataS['average'] = $average;
                $dataS['full_mark'] = $exam['full_mark'];
                $dataS['passing_mark'] = $exam['passing_mark'];
                $dataCourse[] = $dataS;
            }
            $dataE['course'] = $dataCourse;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = "Mes notes";
        return view('student.my_exam_result',$data);
    }

    public function myStudentExamResult($student_id)
    {
        $data['getStudent'] = User::getSingle($student_id);
        $result = array();
        $getExam = MarkRegisterModel::getExam($student_id);
        foreach($getExam as $value)
        {
            $dataE = array();
            $dataE['exam_name'] = $value->exam_name;
            $getExamCourse = MarkRegisterModel::getExamCourse($value->exam_id,$student_id);
            $dataCourse = array();
            foreach($getExamCourse as $exam)
            {
                $average = ($exam['note_devoir'] + $exam['note_exam'])/2;
                $dataS = array();
                $dataS['course_name'] = $exam['course_name'];
                $dataS['note_devoir'] = $exam['note_devoir'];
                $dataS['note_exam'] = $exam['note_exam'];
                $dataS['average'] = $average;
                $dataS['full_mark'] = $exam['full_mark'];
                $dataS['passing_mark'] = $exam['passing_mark'];
                $dataCourse[] = $dataS;
            }
            $dataE['course'] = $dataCourse;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = "Notes examens";
        return view('parent.my_student_exam_result',$data);
    }

    public function printCard($id)
    {   
        $user = User::find($id);
        $activeYear = SchoolYear::getActiveYear()->id;
        $studentInfos = StudentModel::getStudentInfos($activeYear,$user->id);
        $student = $studentInfos->first();
        $nom = $student->name;
        $prenom = $student->prenom;
        $matricule = $student->matricule;
        $nomPrenom = $nom . ' ' . $prenom;
        $nomMatricule = $nomPrenom . PHP_EOL . $matricule;

        //$data['header_title'] = "Carte étudiant";
        $data['getInfos'] = $studentInfos;
        $data['qrCodeInfos'] = $nomMatricule;

        $pdf = PDF::loadView('admin.student.card',$data);
        $filename = 'carte_etudiant_' . $user->name . '.pdf';
        return $pdf->download($filename);
        //return view('admin.student.card', $data);
    }

   public function printResult(Request $request)
{
    $exam_id = $request->exam_id;
    $student_id = $request->student_id;
    $activeYear = SchoolYear::getActiveYear()->id;
    // Récupération des autres données...
    $data['getTotalCredit'] = SelectedCoursesModel::getCreditSum($student_id);
    $data['getStudent'] = StudentModel::getSingle($student_id);
    $getExamCourse = MarkRegisterModel::getExamCourse($exam_id, $student_id,$activeYear);

    // Regroupement des cours par UE
    $coursesByUE = [];
    foreach ($getExamCourse as $exam) {
        $ue = $exam['ue'];
        if (!isset($coursesByUE[$ue])) {
            $coursesByUE[$ue] = [
                'courses' => [],
                'credits' => 0,
                'totalAverage' => 0,
                'valid' => false,
                'code_ue' => $exam['code_ue'],
                'ue' => $exam['ue'],
                'course_semester' => $exam['course_semester']
            ];
        }
        $average = ($exam['note_devoir'] + $exam['note_exam']) / 2;
        $coursesByUE[$ue]['courses'][] = [
            'course_name' => $exam['course_name'],
            'note_devoir' => $exam['note_devoir'],
            'note_exam' => $exam['note_exam'],
            'average' => $average,
            'credit' => $exam['credit'],
            'ecue' => $exam['ecue'],
            'course_semester' => $exam['course_semester'] 
        ];
        $coursesByUE[$ue]['credits'] += $exam['credit'];
        $coursesByUE[$ue]['totalAverage'] += $average;
        if ($average >= 10) {
            $coursesByUE[$ue]['valid'] = true;
        }
    }

    // Calcul de la moyenne pour chaque UE
    foreach ($coursesByUE as &$ue) {
        if (count($ue['courses']) > 0) {
            $ue['average'] = $ue['totalAverage'] / count($ue['courses']);
        } else {
            $ue['average'] = 0;
        }
    }
    // Regroupement des cours par semestre
    $coursesBySemester = [];
    //dd($coursesByUE);
    foreach ($coursesByUE as $ueData) {
        $semester = $ueData['course_semester']; 
        if (!isset($coursesBySemester[$semester])) {
            $coursesBySemester[$semester] = [];
        }
        $coursesBySemester[$semester][] = $ueData;
    }

    // Tri des clés de $coursesBySemester dans l'ordre croissant
    ksort($coursesBySemester);
    $data['coursesBySemester'] = $coursesBySemester;
    // Génération du PDF
    $pdf = PDF::loadView('admin.examinations.student_exam_result', $data);
    $filename = 'relevé_notes.pdf';
    return $pdf->download($filename);
}


//     public function printResult(Request $request)
// {
//     $exam_id = $request->exam_id;
//     $student_id = $request->student_id;

//     // Récupération des autres données...
//     $data['getTotalCredit'] = SelectedCoursesModel::getCreditSum($student_id);
//     $data['getStudent'] = StudentModel::getSingle($student_id);
//     $getExamCourse = MarkRegisterModel::getExamCourse($exam_id, $student_id);

//     // Regroupement des cours par UE
//     $coursesByUE = [];
//     foreach ($getExamCourse as $exam) {
//         $ue = $exam['ue'];
//         if (!isset($coursesByUE[$ue])) {
//             $coursesByUE[$ue] = [
//                 'courses' => [],
//                 'credits' => 0,
//                 'totalAverage' => 0,
//                 'valid' => false,
//                 'code_ue' => $exam['code_ue'],
//                 'ue' => $exam['ue'],
//             ];
//         }
//         $average = ($exam['note_devoir'] + $exam['note_exam']) / 2;
//         $coursesByUE[$ue]['courses'][] = [
//             'course_name' => $exam['course_name'],
//             'note_devoir' => $exam['note_devoir'],
//             'note_exam' => $exam['note_exam'],
//             'average' => $average,
//             'credit' => $exam['credit'],
//             'ecue' => $exam['ecue']
//         ];
//         $coursesByUE[$ue]['credits'] += $exam['credit'];
//         $coursesByUE[$ue]['totalAverage'] += $average;
//         if ($average >= 10) {
//             $coursesByUE[$ue]['valid'] = true;
//         }
//     }

//     // Calcul de la moyenne pour chaque UE
//     foreach ($coursesByUE as &$ue) {
//         if (count($ue['courses']) > 0) {
//             $ue['average'] = $ue['totalAverage'] / count($ue['courses']);
//         } else {
//             $ue['average'] = 0;
//         }
//     }

//     $data['coursesByUE'] = $coursesByUE;
//     $pdf = PDF::loadView('admin.examinations.student_exam_result',$data);
//     $filename = 'relevé_notes.pdf';
//     return $pdf->download($filename);
//     //return view('admin.examinations.student_exam_result', $data);
// }
}




