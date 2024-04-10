<?php

namespace App\Http\Controllers;

use App\Models\DomainModel;
use App\Models\MentionModel;
use App\Models\SchoolYear;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Auth;

class MentionController extends Controller
{
    public function list()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getRecord'] = MentionModel::getProgressYearSavedMentions();
        }
        else
        {
            $data['getRecord'] = MentionModel::getSavedMentions($activeYear);
        }
        $data['header_title'] = "Liste| Mention";
        return view('admin.mention.list', $data);
    }

    public function add()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        if($progressYear == "0")
        {
            $data['getDomain'] = DomainModel::getProgressYearDomain();
            $data['getSubject'] = SubjectModel::getProgressYearSubject();
        }
        else
        {
            $data['getDomain'] = DomainModel::getDomain($activeYear);
            $data['getSubject'] = SubjectModel::getSubject($activeYear);
        }
        $data['header_title'] = "Ajouter une mention";
        return view('admin.mention.add', $data);
    }

    public function insert(Request $request)
    {
        $mention = new MentionModel;
        $mention->domain_id = trim($request->domain_id);
        $mention->subject_id = trim($request->subject_id);
        $mention->school_year_id = trim($request->school_year_id);
        $mention->nom = trim($request->nom);
        $mention->status = $request->status;
        $mention->created_by = Auth::user()->id;
        $mention->save();
        return redirect('admin/mention/list')->with('success', "Mention ajoutée avec succès");
    }

     public function edit($id)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $data['getRecord'] = MentionModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            if($progressYear == "0")
            {
               $data['getDomain'] = DomainModel::getProgressYearDomain(); 
            }
            else
            {
                $data['getDomain'] = DomainModel::getDomain($activeYear);
            }
            $data['header_title'] = "Modifier| Mention";
            return view('admin.mention.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $mention = MentionModel::getSingle($id);
        $mention->domain_id = trim($request->domain_id);
        $mention->nom = trim($request->nom);
        $mention->status = $request->status;
        $mention->save();
        return redirect('admin/mention/list')->with('success', "Mention ajoutée avec succès");
    }

    public function delete($id)
    {
        $save = MentionModel::getSingle($id);
        $save->is_deleted = 1;
        $save->save();
        return redirect()->back()->with('success', "Mention supprimé avec succès");
    }

  

}
