<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassModel;
use App\Models\DomainModel;
use Auth;

class SubjectController extends Controller
{
     public function list()
    {

        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = SubjectModel::getRecord();
        $data['header_title'] = "Liste| Spécialités";
       return view('admin.subject.list', $data);
    }

    public function add()
    {
        $data['getDomain'] = DomainModel::getDomain();
        $data['header_title'] = "Ajouter| Spécialités";
       return view('admin.subject.add', $data);
    }

    public function insert(Request $request)
    {
       $save = new SubjectModel;
       $save->name = trim($request->name);
       $save->domain_id = trim($request->domain_id);
       $save->parcours = trim($request->parcours);
       $save->status = trim($request->status);
       $save->created_by = Auth::user()->id;
       $save->save();

       return redirect('admin/subject/list')->with('success', "Spécialisation ajouté avec succès");

    }

    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);

        if(!empty($data['getRecord'])){
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
       $save->type = trim($request->type);
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


    // public function mySubject()
    // {

    //     $data['getRecord'] = ClassCourseModel::getMyCourse(Auth::user()->class_id);
    //     $data['header_title'] = "Mes matières";
    //    return view('student.my_subject', $data);
    // }
}
