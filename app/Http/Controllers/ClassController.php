<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassModel;
use App\Models\DomainModel;
use App\Models\MentionModel;
use App\Models\SchoolYear;

class ClassController extends Controller
{
    public function list()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        //$progressYear = SchoolYear::getActiveProgressYear($activeYear)->inProgress;
        //dd($activeYear,$progressYear);
        if($progressYear == "0")
        {
            $data['getRecord'] = ClassModel::getProgressYearRecord();
            //dd($data['getRecord']);
        }
        else
        {
            $data['getRecord'] = ClassModel::getRecord($activeYear);
        }
        $data['header_title'] = "Liste| Classes";
        return view('admin.class.list', $data);
    }

    public function add()
    {
       $activeYear = SchoolYear::getActiveYear()->id;
       $progressYear = SchoolYear::getActiveYear()->inProgress;
       if($progressYear == "0")
       {
           $data['getMentions'] = MentionModel::getProgressYearMentions();
           $data['getDomain'] = DomainModel::getProgressYearDomain();
       }
       else
       {
            $data['getMentions'] = MentionModel::getMentions($activeYear);
            $data['getDomain'] = DomainModel::getDomain($activeYear);
       }
       $data['getActiveYear'] = SchoolYear::getActiveYear();
       $data['header_title'] = "Ajouter une classe";
       return view('admin.class.add', $data);
    }

    public function insert(Request $request)
    {
       $save = new ClassModel;
       $save->school_year_id = trim($request->school_year_id);
       $save->name = $request->name;
       $save->amount = $request->amount;
       $save->status = $request->status;
       $save->domain_id = $request->domain_id;
       $save->mention_id = $request->mention;
       $save->created_by = Auth::user()->id;
       $save->save();
       return redirect('admin/class/list')->with('success', "Classe créee avec succès");

    }

    public function edit($id)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        $data['getRecord'] = ClassModel::getSingle($id);
        
        if(!empty($data['getRecord'])){
            if($progressYear == "0")
            {
               $data['getDomain'] = DomainModel::getProgressYearDomain(); 
            }
            else
            {
                $data['getDomain'] = DomainModel::getDomain($activeYear);
            }
            $data['header_title'] = "Modifier| classes";
            return view('admin.class.edit', $data);
        }
        else
        {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        $save = classModel::getSingle($id);
        $save->name = $request->name;
        $save->amount = $request->amount;
        $save->status = $request->status;
        $save->domain_id = $request->domain_id;
        $save->mention_id = $request->mention;
        $save->status = $request->status;
        $save->save();
        return redirect('admin/class/list')->with('success', "classe modifiée avec succès");
    }

    public function delete($id)
    {
        $save = classModel::getSingle($id);
        $save->is_deleted = 1;
        $save->save();
        return redirect()->back()->with('success', "classe supprimée avec succès");
    }
}
