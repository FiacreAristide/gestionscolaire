<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\DomainModel;
use App\Models\SchoolYear;

class DomainController extends Controller
{
    public function list()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveProgressYear($activeYear);
        if($progressYear == "0")
        {
            $data['getRecord'] = DomainModel::getProgressYearRecord(); 
        }
        else
        {
            $data['getRecord'] = DomainModel::getRecord($activeYear);
        }
        $data['header_title'] = "Liste| Domaines";
       return view('admin.domain.list', $data);
    }

    public function add()
    {
        $data['getActiveYear'] = SchoolYear::getActiveYear();
        $data['header_title'] = "Ajouter un Domaine";
        return view('admin.domain.add', $data);
    }

    public function insert(Request $request)
    {
       $save = new DomainModel;
       $save->school_year_id = trim($request->school_year_id);
       $save->name = $request->name;
       $save->status = $request->status;
       $save->created_by = Auth::user()->id;
       $save->save();
       return redirect('admin/domain/list')->with('success', "Domaine crée avec succès");
    }

    public function edit($id)
    {
        $data['getRecord'] = DomainModel::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = "Modifier| Domaines";
        return view('admin.domain.edit', $data);
        }
        else
        {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        $save = DomainModel::getSingle($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();

        return redirect('admin/domain/list')->with('success', "Domaine modifié avec succès");
    }

    public function delete($id)
    {
        $save = DomainModel::getSingle($id);
        $save->is_deleted = 1;
        $save->save();

        return redirect()->back()->with('success', "Domaine supprimé avec succès");
    }
}
