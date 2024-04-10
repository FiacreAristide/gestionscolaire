<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassModel;
use App\Models\DomainModel;
use App\Models\SchoolYear;
use Auth;

class SubjectController extends Controller
{
     public function list()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getClass'] = ClassModel::getProgressYearClass();
            $data['getRecord'] = SubjectModel::getProgressYearRecord();
        }
        else
        {
            $data['getClass'] = ClassModel::getClass($activeYear);
            $data['getRecord'] = SubjectModel::getRecord($activeYear);
            
        }
        $data['header_title'] = "Liste| Spécialités";
        return view('admin.subject.list', $data);
    }

    public function add()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        //dd($progressYear);
        if($progressYear == "0")
        {
            $data['getDomain'] = DomainModel::getProgressYearDomain();
        }
        else
        {
            $data['getDomain'] = DomainModel::getDomain($activeYear);
        }
        //dd($data['getDomain']);
        $data['header_title'] = "Ajouter| Spécialités";
        return view('admin.subject.add', $data);
    }

    public function insert(Request $request)
    {
       $save = new SubjectModel;
       $save->name = trim($request->name);
       $save->domain_id = trim($request->domain_id);
       $save->school_year_id = trim($request->school_year_id);
       $save->parcours = trim($request->parcours);
       $save->status = trim($request->status);
       $save->created_by = Auth::user()->id;
       $save->save();
       return redirect('admin/subject/list')->with('success', "Spécialisation ajouté avec succès");

    }

    public function edit($id)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            if($progressYear == "0")
            {
                $data['getSubject'] = SubjectModel::getProgressYearSubject();
                $data['getDomain'] = DomainModel::getProgressYearDomain();
            }
            else
            {
                $data['getSubject'] = SubjectModel::getSubject($activeYear);
                $data['getDomain'] = DomainModel::getDomain($activeYear);
            }
            $data['header_title'] = "Modifier| Spécialités";
            return view('admin.subject.edit', $data);
        }
        else
        {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
       $save = SubjectModel::getSingle($id);
       $save->name = trim($request->name);
       $save->domain_id = trim($request->domain_id);
       $save->parcours = trim($request->parcours);
       $save->status = trim($request->status);
       $save->save();
       return redirect('admin/subject/list')->with('success', "Spécialité modifié avec succès");
    }

    public function delete($id)
    {
        $save =SubjectModel::getSingle($id);
        $save->is_deleted = 1;
        $save->save();
        return redirect()->back()->with('success', "Spécialité supprimé avec succès");
    }
}
