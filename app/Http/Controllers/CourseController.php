<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CourseModel;
use App\Models\ClassCourseModel;
use App\Models\User;
use App\Models\SubjectModel;
use App\Models\DomainModel;
use App\Models\InvalidCourseModel;
use App\Models\MentionModel;
use App\Models\SchoolYear;
use App\Models\SelectedCoursesModel;

class CourseController extends Controller
{
    public function list()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getRecord'] = CourseModel::getProgressYearRecord();
        }
        else{
            $data['getRecord'] = CourseModel::getRecord($activeYear);
        }
        $data['header_title'] = "Liste| Cours";
       return view('admin.course.list', $data);
    }

    public function add()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getMentions'] = MentionModel::getProgressYearMentions();
            $data['getSubject'] = SubjectModel::getProgressYearSubject();
            $data['getDomain'] = DomainModel::getProgressYearDomain();
        }
        else{
            $data['getMentions'] = MentionModel::getMentions($activeYear);
            $data['getSubject'] = SubjectModel::getSubject($activeYear);
            $data['getDomain'] = DomainModel::getDomain($activeYear);
        }
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        $data['header_title'] = "Ajouter un Cours";
        return view('admin.course.add', $data);
    }

    public function insert(Request $request)
    {
       $save = new CourseModel;
       $save->school_year_id = trim($request->school_year_id);
       $save->domain_id = trim($request->domain_id);
       $save->subject_id = trim($request->subject_id);
       $save->parcours = trim($request->parcours);
       $save->mention_id = trim($request->mention_id);
       $save->code_ue = trim($request->code_ue);
       $save->ue = trim($request->ue);
       $save->code_ecue = trim($request->code_ecue);
       $save->name = trim($request->name);
       $save->vol_horaire = trim($request->vol_horaire);
       $save->coeff = trim($request->coeff);
       $save->semestre = trim($request->semestre);
       $save->type = trim($request->type);
       $save->status = $request->status;
       $save->created_by = Auth::user()->id;
       $save->save();
       return redirect('admin/course/list')->with('success', "Cours crée avec succès");

    }

    public function edit($id)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $data['getRecord'] = CourseModel::getSingle($id);
        if(!empty($data['getRecord'])){
            if($progressYear == "0")
            {
                $data['getMentions'] = MentionModel::getProgressYearMentions();
                $data['getSubject'] = SubjectModel::getProgressYearSubject();
                $data['getDomain'] = DomainModel::getProgressYearDomain();
            }
            else
            {
                $data['getMentions'] = MentionModel::getMentions($activeYear);
                $data['getSubject'] = SubjectModel::getSubject($activeYear);
                $data['getDomain'] = DomainModel::getDomain($activeYear);
            }
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
       $save->domain_id = trim($request->domain_id);
       $save->subject_id = trim($request->subject_id);
       $save->parcours = trim($request->parcours);
       $save->mention_id = trim($request->mention_id);
       $save->code_ue = trim($request->code_ue);
       $save->ue = trim($request->ue);
       $save->code_ecue = trim($request->code_ecue);
       $save->name = trim($request->name);
       $save->vol_horaire = trim($request->vol_horaire);
       $save->coeff = trim($request->coeff);
       $save->semestre = trim($request->semestre);
       $save->type = trim($request->type);
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
}
