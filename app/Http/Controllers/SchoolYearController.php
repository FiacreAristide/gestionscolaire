<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\CourseModel;
use App\Models\MentionModel;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Auth;

class SchoolYearController extends Controller
{
    
    public static function list()
    {
        $data['getRecord']  = SchoolYear::getYearStatus(); 
        $data['header_title'] = "Liste|année_scolaire";
        return view('admin.school_year.list',$data);
    }

    public function add()
    {
        $data['header_title'] = "Ajouter| année_scolaire";
        return view('admin.school_year.add',$data);
    }

    public function insert(Request $request)
    {
        $school_year = new SchoolYear;
        $school_year->title = trim($request->title);
        $school_year->inProgress = 1;
        // $school_year->year_start = trim($request->year_start);
        // $school_year->year_end = trim($request->year_end);
        $school_year->status = $request->status;
        $school_year->created_by = Auth::user()->id;
        $school_year->save();
        return redirect('admin/school_year/list')->with('success', "Année ajoutée avec succès");
    }

    public function activate($id)
    {
        // Désactiver toutes les autres années scolaires
        // Activer l'année scolaire sélectionnée
        SchoolYear::where('id', '!=', $id)->update(['status' => 1, 'inProgress' => 1]);
        $schoolYear = SchoolYear::findOrFail($id);
        $schoolYear->status = 0;
        $schoolYear->save();

        // Déterminez le type d'élément à afficher (par exemple, 'classes', 'courses', 'domains', etc.)
        $elementType = 'classes'; // Par défaut, vous pouvez définir cela sur le type d'élément par défaut que vous souhaitez afficher

        // Stockez le type d'élément dans la session
        session(['element_type' => $elementType]);
        return redirect('admin/school_year/list')->with('success', 'Année scolaire activée avec succès');
}
    public function setInProgress($id)
    {
        SchoolYear::where('id','!=',$id)->update(['inProgress' => 1]);
        // Activer l'année scolaire sélectionnée
        $schoolYear = SchoolYear::findOrFail($id);
        $schoolYear->inProgress = 0;
        $schoolYear->save();
        return redirect('admin/school_year/list')->with('success', "Année en cours sélectionnée avec succès");
    }

}
