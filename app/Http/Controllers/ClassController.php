<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassModel::getRecord();
        $data['header_title'] = "Liste| Classes";
       return view('admin.class.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Ajouter une classe";
       return view('admin.class.add', $data);
    }

    public function insert(Request $request)
    {
       $save = new ClassModel;
       $save->name = $request->name;
       $save->status = $request->status;
       $save->created_by = Auth::user()->id;
       $save->save();

       return redirect('admin/class/list')->with('success', "Classe créee avec succès");

    }

    public function edit($id)
    {
        $data['getRecord'] = ClassModel::getSingle($id);

        if(!empty($data['getRecord'])){
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
